<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Response;
use App\Models\Option;

class ResponseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //     $takerID = 1; 

    //     $selectedAnswers = [
    //         1, 7, 9, 13, 17, 21, 25, 29, 33, 37, 41, 45, 49, 53, 57, 61, 65, 69, 73, 77, 81
    //     ];

    //     foreach ($selectedAnswers as $selectedAnswerID) {
    //         $ResponseData = $this->getResponseData($takerID, $selectedAnswerID);

    //         if ($ResponseData) {
    //             Response::create($ResponseData);
    //         }
    //     }
    // }

    // private function getResponseData($takerID, $selectedAnswerID)
    // {
    //     $option = Option::find($selectedAnswerID);

    //     if ($option) {
    //         return [
    //             'takerID' => $takerID,
    //             'questionID' => $option->questionID,
    //             'answer' => $option->id,
    //         ];
    //     }

    //     return null;
    }
}
