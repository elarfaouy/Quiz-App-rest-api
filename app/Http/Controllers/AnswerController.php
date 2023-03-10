<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Question;
use Illuminate\Http\JsonResponse;

class AnswerController extends Controller
{
    private function isOptionForThisQuestion(int $question_id, int $option_id): bool
    {
        // to get all options ids related to this question
        $options_ids = Question::find($question_id)->options->pluck('id')->toArray();

        return in_array($option_id, $options_ids);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAnswerRequest $request
     * @return JsonResponse
     */
    public function store(StoreAnswerRequest $request): JsonResponse
    {
        if (!$this->isOptionForThisQuestion($request->question_id, $request->option_id)) {
            return response()->json([
                "status" => "not found",
                "message" => "this option not related to this question",
            ], 404);
        }

        $answer = Answer::create($request->all());

        return response()->json([
            "status" => "success",
            "message" => "answer created successfully",
            "data" => $answer,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAnswerRequest $request
     * @param Answer $answer
     * @return JsonResponse
     */
    public function update(UpdateAnswerRequest $request, Answer $answer): JsonResponse
    {
        if (!$this->isOptionForThisQuestion($request->question_id, $request->option_id)) {
            return response()->json([
                "status" => "not found",
                "message" => "this option not related to this question",
            ], 404);
        }

        $answer->update($request->all());

        return response()->json([
            "status" => "success",
            "message" => "answer updated successfully",
            "data" => $answer,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Answer $answer
     * @return JsonResponse
     */
    public function destroy(Answer $answer): JsonResponse
    {
        $answer->delete();

        return response()->json([
            "status" => "success",
            "message" => "answer deleted successfully",
            "data" => $answer,
        ], 200);
    }
}
