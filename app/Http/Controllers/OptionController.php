<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use Illuminate\Http\JsonResponse;

class OptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOptionRequest $request
     * @return JsonResponse
     */
    public function store(StoreOptionRequest $request): JsonResponse
    {
        $option = Option::create($request->all());

        return response()->json([
            "status" => "success",
            "message" => "option created successfully",
            "data" => $option,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOptionRequest $request
     * @param Option $option
     * @return JsonResponse
     */
    public function update(UpdateOptionRequest $request, Option $option): JsonResponse
    {
        $option->update($request->all());

        return response()->json([
            "status" => "success",
            "message" => "option updated successfully",
            "data" => $option,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Option $option
     * @return JsonResponse
     */
    public function destroy(Option $option): JsonResponse
    {
        $option->delete();

        return response()->json([
            "status" => "success",
            "message" => "option deleted successfully",
            "data" => $option,
        ], 200);
    }
}
