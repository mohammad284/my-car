<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Car extends Model
{
    use HasFactory;
    protected $fillable = [
    'ar_id',
    'name',
    'type',
    'weekly_price',
    'price_for_day',
    'num_of_day',
    'provider_name',
    'specification',
    'rating',
    'car_location',
    'important_information',
    'security_deposit',
    'damage_excess',
    'fuel_policy',
    'mileage',
    'extra_information',
    'lan',
    'review_count',
    'color_id',
    'automatic',
    'site',
    'door',
    'number_of_car',
    'manufacturing',
    'available',
    'booking_status',
    'country_id',
    'city_id',
    'monthly_price'
    ];
    public function color()
    {
        return $this->belongsTo('App\Models\Color', 'color_id', 'id');
    }
    public function provider()
    {
        return $this->belongsTo('App\Models\Color', 'provider_name', 'id');
    }
    public function rental()
    {
        return $this->hasMany('App\Models\Car','car_id','id');
    }
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }
}