<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelRequest;
use App\Http\Requests\TravelLocationRequest;
use App\Http\Resources\DataResource;
use App\Models\TravelLocation;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;

class TravelLocationController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $travel_locations = QueryBuilder::for(TravelLocation::class)
            ->where('is_deleted', false)
            ->with(['hotel_types','province','district','location_links'])
            ->paginate(10)
            ->onEachSide(1);
        return DataResource::collection($travel_locations);
    }

    public function store(TravelLocationRequest $request): JsonResponse|DataResource
    {
        try {
            $travel_location = TravelLocation::create($request->except('type', 'province', 'district','location_link'));
            $type = $request->input('type');
            $province = $request->input('province');
            $district = $request->input('district');
            $location_link = $request->input('location_link');

            $travel_location->type()->create([
                    'name' => $type,
                    'travel_location_id' => $travel_location->id,
            ]);
            $travel_location->province()->create([
                    'name' => $type,
                    'travel_location_id' => $travel_location->id,
            ]);
            $travel_location->district()->create([
                    'name' => $type,
                    'travel_location_id' => $travel_location->id,
            ]);

            if($location_link){
                $travel_location->location_links()->district([
                    'name' => $type,
                    'travel_location_id' => $travel_location->id,
                ]);
            }
            return new DataResource($travel_location);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function show($travel_location_id): JsonResponse|DataResource
    {
        try {
            $travel_location = QueryBuilder::for(TravelLocation::class)
                ->where('id', $travel_location_id)
                ->with(['hotel_types','province','district','location_links'])
                ->firstOrFail();
            return new DataResource($travel_location);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($travel_location_id): JsonResponse
    {
        try {
            $course = TravelLocation::findOrFail($travel_location_id);
            $course->update(['is_deleted' => true]);
            return response()->json(['message' => 'Travel location remove successfully!'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(HotelRequest $request, $hotel_id): JsonResponse|DataResource
    {
        try {
            $travel_location = TravelLocation::findOrFail($hotel_id);
            $travel_location->update($request->validated());
            return new DataResource($travel_location);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
