<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = ['color','color_ar','color_en'];

    public function car()
    {
        return $this->hasMany('App\Models\Car','color_id','id');
    }
}
