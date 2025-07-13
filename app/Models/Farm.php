<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{

protected $fillable = [
    'name',
    'region',
    'altitude',
    'certification',
    'description'
];
  public function harvestBatches()
{
    return $this->hasMany(HarvestBatch::class);
}  //
}
