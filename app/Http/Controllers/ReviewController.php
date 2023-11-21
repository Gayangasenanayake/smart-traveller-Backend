<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\DataResource;
use App\Models\Review;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ReviewController extends Controller
{
    public function index(): DataResource
    {
        $travel_locations = QueryBuilder::for(Review::class)
            ->where('is_deleted', false)
            ->get();
        return new DataResource($travel_locations);
    }

    public function store(ReviewRequest $request): JsonResponse|DataResource
    {
        try {
            $travel_location = Review::create($request->validated());
            return new DataResource($travel_location);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function show($travel_location_id): JsonResponse|DataResource
    {
        try {
            $travel_location = QueryBuilder::for(Review::class)
                ->where('id', $travel_location_id)
                ->firstOrFail();
            return new DataResource($travel_location);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
