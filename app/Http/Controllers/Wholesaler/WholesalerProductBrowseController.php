<?php

namespace App\Http\Controllers\Wholesaler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WholesalerProduct;

class WholesalerProductBrowseController extends Controller
{
    public function showWholesalerProducts()
    {
        $products = WholesalerProduct::latest()->get();
        return view('retailer.wholesaler_products', compact('products'));

    }

}