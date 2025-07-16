<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{

    protected $fillable = [
    'harvest_batch_id',
    'to_location_id',
    'quantity_kg',
    'transaction_type',
    'notes',
];

 public function harvestBatch()
{
    return $this->belongsTo(HarvestBatch::class);
}

public function fromLocation()
{
    return $this->belongsTo(InventoryLocation::class, 'from_location_id');
}

public function toLocation()
{
    return $this->belongsTo(InventoryLocation::class, 'to_location_id');
}   //
}
