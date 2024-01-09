<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;

class QuestionOptionController extends Controller
{
    public function index() 
    {
        $questions = Question::with('options')->get();

        if ($questions->count() > 0) {
            return response()->json(['questions' => $questions]);
        } else {
            return response()->json([
                'questions' => 'No Questions Found'
            ]);
        }
    }
}
