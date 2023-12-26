<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentScreen extends Model
{
    use HasFactory;
    protected $fillable = ['card_number','name_card','expiry_date','CVV_Code'];
}
