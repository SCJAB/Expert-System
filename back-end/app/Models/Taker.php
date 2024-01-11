<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taker extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'email',
        'password'
    ];

    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class, 'takerID');
    }
}
