<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionCollection;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use Illuminate\Http\JsonResponse;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $questions = Question::inRandomOrder()->get();

        return response()->json([
            "status" => "success",
            "length" => count($questions),
            "data" => new QuestionCollection($questions),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreQuestionRequest $request
     * @return JsonResponse
     */
    public function store(StoreQuestionRequest $request): JsonResponse
    {
        $question = Question::create($request->all());

        return response()->json([
           "status" => "success",
            "message" => "question created successfully",
            "data" => $question,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return JsonResponse
     */
    public function show(Question $question): JsonResponse
    {
        $question->options;

        return response()->json([
            "status" => "success",
            "data" => new QuestionResource($question),
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return JsonResponse
     */
    public function show_answers(Question $question): JsonResponse
    {
        $answers = $question->answers->pluck('id')->toArray();

        return response()->json([
            "status" => "success",
            "data" => $answers,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateQuestionRequest $request
     * @param Question $question
     * @return JsonResponse
     */
    public function update(UpdateQuestionRequest $request, Question $question): JsonResponse
    {
        $question->update($request->all());

        return response()->json([
            "status" => "success",
            "message" => "question updated successfully",
            "data" => $question,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @return JsonResponse
     */
    public function destroy(Question $question): JsonResponse
    {
        $question->delete();

        return response()->json([
            "status" => "success",
            "message" => "question deleted successfully",
            "data" => $question,
        ], 200);
    }
}
