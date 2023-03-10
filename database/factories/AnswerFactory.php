<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $question_ids = DB::table('questions')->pluck('id')->toArray();
        $question_id = $this->faker->randomElement($question_ids);

        $options_ids = Question::find($question_id)->options->pluck('id')->toArray();

        return [
            'question_id' => $question_id,
            'option_id' => $this->faker->randomElement($options_ids),
        ];
    }
}
