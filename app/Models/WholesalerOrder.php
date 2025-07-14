<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WholesalerOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'retailer_id', 'status', 'total', 'delivery_address'
    ];

    public function items()
    {
        return $this->hasMany(WholesalerOrderItem::class);
    }

    public function retailer()
    {
        return $this->belongsTo(User::class, 'retailer_id');

    }

}