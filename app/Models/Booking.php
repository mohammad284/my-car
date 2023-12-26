<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['car_id','user_id','provider_id','status','start_date','end_date','price','location','latitude','longitude'];


    public function provider()
    {
        return $this->belongsTo('App\Models\User', 'provider_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function car()
    {
        return $this->belongsTo('App\Models\Car', 'car_id', 'id');
    }
}
