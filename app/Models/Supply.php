<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id', 'coffee_id', 'quantity', 'supply_date'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function coffee()
    {
        return $this->belongsTo(Coffee::class);
    }
}
