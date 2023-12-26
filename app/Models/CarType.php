<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    use HasFactory;
    protected $fillable = ['type','image','ar_id','lan'];


    public function model()
    {
        return $this->belongsTo('App\Models\CarModel', 'type', 'id');
    }
}