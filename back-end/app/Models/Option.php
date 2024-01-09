<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'adminID',
        'questionID',
        'option',
        'score'
    ];

    public function admins()
    {
        return $this->belongsTo(Admin::class, 'admin');
    }

    public function questions()
    {
        return $this->belongsTo(Question::class, 'questionID');
    }

}
