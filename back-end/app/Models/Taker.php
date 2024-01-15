<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Taker extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'email',
        'password'
    ];
}
