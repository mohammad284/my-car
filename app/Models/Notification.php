<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['notification','user_id','lan','status','sender','type'];
    
    // 1 : register
    // 2 : update 
    // 3 : add car 
    // 4 : advertising
    // 5 : admin
    // 6 : booking
}
