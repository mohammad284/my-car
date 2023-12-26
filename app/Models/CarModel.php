<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'model',
        'type',
        'image'
    ];
    public function car_type()
    {
        return $this->belongsTo('App\Models\CarType', 'type', 'id');
    }
}
