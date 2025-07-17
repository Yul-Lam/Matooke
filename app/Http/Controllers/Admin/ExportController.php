<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\WholesalerOrderItem;
use Illuminate\Http\Response;

class ExportController extends Controller
{
    public function exportOrderData()
{
    $retailerData = collect(OrderItem::with('product')->get()->map(function ($item) {
        return [
            'source' => 'Retailer',
            'product_name' => $item->product->name ?? 'N/A',
            'quantity' => $item->quantity,
            'date' => $item->created_at->toDateString(),
        ];
    }));

    $wholesalerData = collect(WholesalerOrderItem::with('product')->get()->map(function ($item) {
        return [
            'source' => 'Wholesaler',
            'product_name' => $item->product->name ?? 'N/A',
            'quantity' => $item->quantity,
            'date' => $item->created_at->toDateString(),
        ];
    }));

    $allData = $retailerData->merge($wholesalerData);

    $csv = "source,product_name,quantity,date\n";
    foreach ($allData as $row) {
        $csv .= "{$row['source']},{$row['product_name']},{$row['quantity']},{$row['date']}\n";
    }

    return response ($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename=all_orders.csv',
    ]);
    
}

    
}
