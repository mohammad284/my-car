<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WelcomeEmail extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'email_ar',
        'email_en'
    ];
}
