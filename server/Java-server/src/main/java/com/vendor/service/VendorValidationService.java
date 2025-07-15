package com.vendor.service;

import com.vendor.model.VendorRequest;
import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.text.PDFTextStripper;
import org.springframework.stereotype.Service;

import java.io.*;
import java.net.HttpURLConnection;
import java.net.URL;
import java.nio.file.Files;
import java.nio.file.StandardCopyOption;
import java.util.HashMap;
import java.util.Map;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

@Service
public class VendorValidationService {

    public void process(VendorRequest request) {
        File tempFile = null;

        try (InputStream in = new URL(request.getPdfUrl()).openStream()) {
            tempFile = File.createTempFile("vendor_app", ".pdf");
            Files.copy(in, tempFile.toPath(), StandardCopyOption.REPLACE_EXISTING);

            try (PDDocument document = PDDocument.load(tempFile)) {
                PDFTextStripper stripper = new PDFTextStripper();
                String text = stripper.getText(document).toLowerCase();

                Map<String, Double> financialData = extractFinancialData(text);
                double revenue = financialData.getOrDefault("revenue", 0.0);
                double debt = financialData.getOrDefault("debt", 0.0);
                double balance = financialData.getOrDefault("balance", 0.0);

                double debtRatio = (balance != 0) ? (debt / balance) : 1.0;

                boolean hasGoodRevenue = revenue > 250000;
                boolean hasGoodDebtRatio = debtRatio < 0.4;
                boolean hasLicense = text.contains("license") || text.contains("iso 9001");

                if (hasGoodRevenue && hasGoodDebtRatio && hasLicense) {
                    System.out.println("Vendor " + request.getVendorId() + " PASSED all checks.");
                    scheduleVisit(request.getVendorId());
                    sendCallback(request.getCallbackUrl(), request.getVendorId(), "passed");
                } else {
                    System.out.println("Vendor " + request.getVendorId() + " FAILED checks:");
                    if (!hasGoodRevenue) System.out.println("- Revenue too low");
                    if (!hasGoodDebtRatio) System.out.println("- Debt ratio too high");
                    if (!hasLicense) System.out.println("- Missing valid license");
                    sendCallback(request.getCallbackUrl(), request.getVendorId(), "failed");
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            if (tempFile != null && tempFile.exists()) {
                tempFile.delete();
            }
        }
    }

    private Map<String, Double> extractFinancialData(String text) {
        Map<String, Double> data = new HashMap<>();

        Pattern revenuePattern = Pattern.compile("revenue[^\\d]*(\\d+[\\d,\\.]+)");
        Pattern debtPattern = Pattern.compile("debt[^\\d]*(\\d+[\\d,\\.]+)");
        Pattern balancePattern = Pattern.compile("balance[^\\d]*(\\d+[\\d,\\.]+)");

        Matcher m;

        m = revenuePattern.matcher(text);
        if (m.find()) {
            data.put("revenue", parseNumber(m.group(1)));
        }

        m = debtPattern.matcher(text);
        if (m.find()) {
            data.put("debt", parseNumber(m.group(1)));
        }

        m = balancePattern.matcher(text);
        if (m.find()) {
            data.put("balance", parseNumber(m.group(1)));
        }

        return data;
    }

    private double parseNumber(String raw) {
        try {
            return Double.parseDouble(raw.replaceAll(",", "").replaceAll("\\$", ""));
        } catch (Exception e) {
            return 0;
        }
    }

    private void scheduleVisit(Long vendorId) {
        System.out.println("Scheduled facility visit for vendor: " + vendorId);
    }

    private void sendCallback(String callbackUrl, Long vendorId, String status) {
        try {
            URL url = new URL(callbackUrl);
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();

            connection.setRequestMethod("POST");
            connection.setDoOutput(true);
            connection.setRequestProperty("Content-Type", "application/json");

            String jsonBody = String.format("{\"vendor_id\":%d,\"status\":\"%s\"}", vendorId, status);

            try (OutputStream os = connection.getOutputStream()) {
                os.write(jsonBody.getBytes());
            }

            int responseCode = connection.getResponseCode();
            System.out.println("Callback response: " + responseCode);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}