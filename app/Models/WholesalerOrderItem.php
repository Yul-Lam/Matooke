<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WholesalerOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'wholesaler_order_id', 'wholesaler_product_id', 'quantity', 'price'
    ];

    public function order()
    {
        return $this->belongsTo(WholesalerOrder::class, 'wholesaler_order_id');
    }

    public function product()
    {
        return $this->belongsTo(WholesalerProduct::class, 'wholesaler_product_id');

    }

}