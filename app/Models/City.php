<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'city',
        'country_id'
    ];
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }
    public function provider()
    {
        return $this->hasMany('App\Models\User','country','id');
    }
    public function rental()
    {
        return $this->hasMany('App\Models\MunualRental','city_id','id');
    }
    public function car()
    {
        return $this->hasMany('App\Models\Car','city_id','id');
    }

}
