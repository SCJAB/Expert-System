<?php

namespace Database\Seeders;

use App\Models\DepressionType;
use Illuminate\Database\Seeder;

class DepressionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $depressionTypes = [
            ['type' => 'Normal', 'scoreRangeStart' => 1, 'scoreRangeEnd' => 10],
            ['type' => 'Mild', 'scoreRangeStart' => 11, 'scoreRangeEnd' => 16],
            ['type' => 'Borderline', 'scoreRangeStart' => 17, 'scoreRangeEnd' => 20],
            ['type' => 'Moderate', 'scoreRangeStart' => 21, 'scoreRangeEnd' => 30],
            ['type' => 'Severe', 'scoreRangeStart' => 31, 'scoreRangeEnd' => 40],
            ['type' => 'Extreme', 'scoreRangeStart' => 41, 'scoreRangeEnd' => 100],
        ];

        foreach ($depressionTypes as $type) {
            DepressionType::create($type);
        }
    }

}
