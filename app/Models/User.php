<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = "vendor";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'status',
        'type',
        'company_name',
        'cr_number',
        'total_car',
        'available_car',
        'rating',
        'percentage',
        'image',
        'provider_address',
        'lan',
        'lat',
        'company_icon',
        'city',
        'country',
        'reason_block',
        'id_number',
        'id_identify_image',
        'cr_image',
        'manager_company'
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function car()
    {
        return $this->hasMany('App\Models\Car','provider_name','id');
    }
    public function booking()
    {
        return $this->hasMany('App\Models\Booking','provider_id','id');
    }
    public function booking_user()
    {
        return $this->hasMany('App\Models\Booking','user_id','id');
    }
    public function countries()
    {
        return $this->belongsTo('App\Models\Country', 'country', 'id');
    }
    public function cities()
    {
        return $this->belongsTo('App\Models\City', 'city', 'id');
    }
    public function rental()
    {
        return $this->hasMany('App\Models\MunualRental','provider_id','id');
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
