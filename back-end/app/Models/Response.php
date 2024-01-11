<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
     
    protected $fillable = [
        'takerID', 
        'questionID', 
        'answerID'
    ];

    public function taker()
    {
        return $this->belongsTo(Taker::class, 'takerID');
    }

    public function question()
    {
        return $this->hasMany(Question::class, 'responseID');
    }

    public function option()
    {
        return $this->hasMany(Option::class, 'responseID');
    }
}
