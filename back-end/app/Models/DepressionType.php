<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepressionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'scoreRangeStart',
        'scoreRangeEnd'
    ];
}
