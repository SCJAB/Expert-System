<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Taker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiagnosisController extends Controller
{
    public function index() 
    {
        $diagnoses = Diagnosis::all();

        if ($diagnoses->count() > 0) {
            return response()->json(['diagnosis' => $diagnoses]);
        } else {
            return response()->json([
                'diagnoses' => 'No Diagnosis Found'
            ]);
        }
        
    }

    public function create(Request $request, $id) 
    {
        $taker = Taker::find($id);

        if (!$taker) {
            return response()->json([
                'message' => 'Taker is required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'score' => 'required|numeric|min:1',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->messages(),
                ]);
            } else {
                $totalScore = $request->score; // might be computed 
    
                $takerDiagnosis = Diagnosis::create([
                    'takerID' => $taker->id,
                    'score' => $totalScore,
                    'depression_level' => match (true) {
                        $totalScore >= 0 && $totalScore <= 10 => 'NORMAL',
                        $totalScore >= 11 && $totalScore <= 16 => 'MILD',
                        $totalScore >= 17 && $totalScore <= 20 => 'BORDERLINE',
                        $totalScore >= 21 && $totalScore <= 30 => 'MODERATE',
                        $totalScore >= 31 && $totalScore <= 40 => 'SEVERE',
                        default => 'EXTREME',
                    },
                ]);
    
                if ($takerDiagnosis) {
                    return response()->json([
                        'message' => 'Taker Diagnosis Created Successfully',
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Something Went Wrong',
                    ]);
                }
                }
        }
    }

    public function read($id) 
    {
        $diagnosis = Diagnosis::find($id);

        if ($diagnosis) {
            $taker = Taker::find($diagnosis->takerID);

            return response()->json([
                'diagnosis' => $diagnosis,
                'taker' => $taker
            ]);
        } else {
            return response()->json([
                'message' => 'Diagnosis Not Found'
            ]);
        }
    }

    public function delete($id) {
        $diagnosis = Diagnosis::find($id);

        if ($diagnosis) {
            $diagnosis->delete();

            return response()->json([
                'message' => 'Diagnosis Deleted Successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Diagnosis Not Found'
            ]);
        }
    }
}
