<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Admin;

class RelationshipController extends Controller
{
    public function questionOption() 
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

    public function adminQuestion() 
    {
        $admins = Admin::with('questions')->get();

        if ($admins->count() > 0) {
            return response()->json(['admins' => $admins]);
        } else {
            return response()->json([
                'admins' => 'No Admins Found'
            ]);
        }
    }

    public function adminOption() 
    {
        $admins = Admin::with('options')->get();

        if ($admins->count() > 0) {
            return response()->json(['admins' => $admins]);
        } else {
            return response()->json([
                'admins' => 'No Admins Found'
            ]);
        }
    }
}
