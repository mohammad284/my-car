<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MunualRental extends Model
{
    use HasFactory;
    protected $fillable = ['car_id','user_name','provider_id','status','start_date','end_date','price','country_id','city_id','type_id'];

    public function car()
    {
        return $this->belongsTo('App\Models\Car', 'car_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }
}
