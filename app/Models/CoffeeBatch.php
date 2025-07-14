<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoffeeBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_name',
        'quantity',
        'quality_grade',
        'uploaded_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
