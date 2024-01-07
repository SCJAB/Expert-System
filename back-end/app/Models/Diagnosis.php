<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;
     
    protected $fillable = ['takerID', 'score', 'depression_level'];

    public function user()
    {
        return $this->belongsTo(Taker::class, 'taker');
    }
}
