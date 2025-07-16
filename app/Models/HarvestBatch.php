<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HarvestBatch;

class HarvestBatch extends Model
{
    


    use HasFactory;
    // ...existing code...

    use HasFactory;

    protected $fillable = [
        'farm_id',
        'coffee_grade_id',
        'harvest_date',
        'quantity_kg',
        'status',
        'processing_method',
        'image'
        
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function coffeeGrade()
    {
        return $this->belongsTo(CoffeeGrade::class);
    }

    public function transactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }

    public function roasts()
    {
        return $this->hasMany(Roast::class);
    }
    public function dashboard()
{
    $batches = HarvestBatch::orderBy('harvest_date', 'desc')->get();
    return view('cooperative', compact('batches'));
}
protected $casts = [
    'harvest_date' => 'date',
];


}