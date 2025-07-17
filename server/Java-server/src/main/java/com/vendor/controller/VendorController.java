package com.vendor.controller;

import com.vendor.model.VendorRequest;
import com.vendor.service.VendorValidationService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/vendors")
public class VendorController {

    @Autowired
    private VendorValidationService validationService;

    @PostMapping("/validate")
    public ResponseEntity<String> validateVendor(@RequestBody VendorRequest request) {
        validationService.process(request);
        return ResponseEntity.ok("Validation started");
    }
}