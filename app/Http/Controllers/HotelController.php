<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Http\Resources\DataResource;
use App\Models\Hotel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class HotelController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $hotels = QueryBuilder::for(Hotel::class)
            ->where('is_deleted', false)
            ->with(['hotel_types','province','district','location_links'])
            ->paginate(10)
            ->onEachSide(1);
        return DataResource::collection($hotels);
    }

    public function store(HotelRequest $request): JsonResponse|DataResource
    {
        try {
            $hotel = Hotel::create($request->except('type', 'province', 'district','location_link'));
            $type = $request->input('type');
            $province = $request->input('province');
            $district = $request->input('district');
            $location_link = $request->input('location_link');

            $hotel->hotel_types()->create([
                'name' => $type,
                'hotel_id' => $hotel->id,
            ]);
            $hotel->province()->create
            ([
                'name' => $province,
                'hotel_id' => $hotel->id,
            ]);
            $hotel->district()->create
            ([
                'name' => $district,
                'hotel_id' => $hotel->id,
            ]);

            if($location_link){
                $hotel->location_links()->create([
                    'name' => $location_link,
                    'hotel_id' => $hotel->id,
                ]);
            }
            return new DataResource($hotel);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function show($hotel_id): JsonResponse|DataResource
    {
        try {
            $hotel = QueryBuilder::for(Hotel::class)
                ->where('id', $hotel_id)
                ->with(['hotel_types','province','district','location_links'])
                ->firstOrFail();
            return new DataResource($hotel);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($hotel_id): JsonResponse
    {
        try {
            $course = Hotel::findOrFail($hotel_id);
            $course->update(['is_deleted' => true]);
            return response()->json(['message' => 'Hotel remove successfully!'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(HotelRequest $request, $hotel_id): JsonResponse|DataResource
    {
        try {
            $course = Hotel::findOrFail($hotel_id);
            $course->update($request->validated());
            return new DataResource($course);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
