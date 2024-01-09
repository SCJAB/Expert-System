<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'email',
        'password'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class, 'adminID');
    }

    public function options()
    {
        return $this->hasMany(Option::class, 'adminID');
    }
}
