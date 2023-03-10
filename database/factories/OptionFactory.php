<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $question_ids = DB::table('questions')->pluck('id')->toArray();

        return [
            'option' => $this->faker->realText(),
            'question_id' => $this->faker->randomElement($question_ids),
        ];
    }
}
