<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['country'];

    public function city()
    {
        return $this->hasMany('App\Models\City','country_id','id');
    }
    public function provider()
    {
        return $this->hasMany('App\Models\User','country','id');
    }
    public function rental()
    {
        return $this->hasMany('App\Models\MunualRental','country_id','id');
    }
    public function car()
    {
        return $this->hasMany('App\Models\Car','country_id','id');
    }
    
}
