<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Option;
use App\Models\Question;
use App\Models\Response;
use App\Models\Taker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosisController extends Controller
{
    public function index() 
    {
        // Retrieve all diagnoses with associated depression type and responses
        $diagnoses = Diagnosis::with(['depressionType', 'responses.option'])->get();

        // Check if there are diagnoses
        if ($diagnoses->count() > 0) {
            // Transform diagnoses to include depression type, sum of scores, and other information
            $diagnosesWithDetails = $diagnoses->map(function ($diagnosis) {
                $sumOfScores = $this->calculateSumOfScores($diagnosis);
                $depressionType = $this->getDepressionType($sumOfScores);

                return [
                    'id' => $diagnosis->id,
                    'taker' => $diagnosis->taker->first_name . ' ' . $diagnosis->taker->last_name,
                    'depression_type' => $depressionType,
                    'total_score' => $sumOfScores,
                    'responses' => $diagnosis->responses->map(function ($response) {
                        return [
                            'question' => $response->question->question,
                            'answer' => $response->option->option,
                            'score' => optional($response->option)->score,
                        ];
                    }),
                ];
            });

            return response()->json(['Diagnosis' => $diagnosesWithDetails]);
        } else {
            return response()->json(['diagnoses' => 'No Diagnosis Found']);
        }
    }

    private function calculateSumOfScores($diagnosis)
    {
        // Calculate the sum of scores for the associated options
        $sumOfScores = $diagnosis->responses->sum(function ($response) {
            return optional($response->option)->score ?? 0;
        });

        return $sumOfScores;
    }

    private function getDepressionType($sumOfScores)
    {
        // Retrieve the depression type based on the score range
        $depressionType = DB::table('depression_types')
            ->where('scoreRangeStart', '<=', $sumOfScores)
            ->where('scoreRangeEnd', '>=', $sumOfScores)
            ->value('type');

        return $depressionType;
    }    

    public function create(Request $request, $id)
    {
        $taker = Taker::find($id);

        if (!$taker) {
            return response()->json([
                'message' => 'Taker not found',
            ]);
        }

        $takerID = $taker->id;

        $selectedOptions = array_values($request->all()); // Extract only the values

        // Get the number of questions in the database
        $numberOfQuestions = Question::count();

        // Validate the minimum size of selectedOptions
        if (count($selectedOptions) < $numberOfQuestions) {
            return response()->json([
                'message' => 'Invalid number of selected options. You need to select options for all questions.',
            ]);
        }

        // Get all options with a single query
        $options = Option::whereIn('id', $selectedOptions)->get();

        $diagnosis = Diagnosis::create(['takerID' => $takerID]);

        foreach ($options as $option) {
            // Create Response record
            Response::create([
                'diagnosisID' => $diagnosis->id,
                'questionID' => $option->questionID,
                'optionID' => $option->id,
            ]);
        }
        
        return response()->json([
            'message' => 'Diagnosis created successfully',
        ], 201);
    }

    public function read_recent()
    {
        // Retrieve the latest diagnosis with associated depression type and responses
        $latestDiagnosis = Diagnosis::with(['depressionType', 'responses.option'])
            ->latest('created_at')
            ->first();

        if ($latestDiagnosis) {
            // Transform the latest diagnosis to include details
            $diagnosisWithDetails = [
                'id' => $latestDiagnosis->id,
                'taker' => $latestDiagnosis->taker->first_name . ' ' . $latestDiagnosis->taker->last_name,
                'taken_at' => $latestDiagnosis->created_at->format('m/d/Y H:i A'),
                'depression_type' => $this->getDepressionType($this->calculateSumOfScores($latestDiagnosis)),
                'total_score' => $this->calculateSumOfScores($latestDiagnosis),
                'responses' => $latestDiagnosis->responses->map(function ($response) {
                    return [
                        'question' => $response->question->question,
                        'answer' => $response->option->option,
                        'score' => optional($response->option)->score,
                    ];
                }),
            ];

            return response()->json(['Recent Diagnosis' => $diagnosisWithDetails]);
        } else {
            return response()->json(['message' => 'No recent diagnosis found']);
        }
    }

}
