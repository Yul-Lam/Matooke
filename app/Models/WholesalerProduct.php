<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class WholesalerProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'grade',
        'quantity',
        'price',
        'wholesaler_id',
    ];

    public function wholesaler()
    {
        return $this->belongsTo(User::class, 'wholesaler_id');
    }
}
