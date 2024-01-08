<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            "How often do you feel sad?",
            "How do you feel about the future?",
            "How do you perceive your past successes and failures?",
            "How much satisfaction do you get from daily activities?",
            "How often do you feel guilty?",
            "How do you perceive the possibility of punishment?",
            "How do you feel about yourself?",
            "How do you compare yourself to others?",
            "Have you had thoughts of self-harm or suicide?",
            "How often do you cry?",
            "How easily do you get irritated?",
            "How interested are you in other people?",
            "How well can you make decisions?",
            "How do you perceive your appearance?",
            "How well can you work or be productive?",
            "How is your sleep quality?",
            "How tired do you feel?",
            "How is your appetite?",
            "Have you experienced significant weight loss?",
            "How much do you worry about your physical health?",
            "How has your interest in sex changed?"
        ];

        foreach ($questions as $questionText) {
            Question::create([
                'adminID' => 1,
                'question' => $questionText
            ]);
        }
    }
}
