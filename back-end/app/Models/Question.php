<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'adminID',
        'question'
    ];

    public function admins()
    {
        return $this->belongsTo(Admin::class, 'admin');
    }

    public function options()
    {
        return $this->hasMany(Option::class, 'questionID');
    }
}
