<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RetailerProduct;

class ProductController extends Controller
{
    public function index()
   {
    $products = RetailerProduct::latest()->get(); // ✅ Get products from retailer_products table

    return view('customer.products.index', compact('products'));

   }
}