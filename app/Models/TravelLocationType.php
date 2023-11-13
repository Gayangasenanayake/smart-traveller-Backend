<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TravelLocationType extends Model
{
    protected $fillable = [
        'name',
        'travel_location_id',
    ];

    public function travel_location(): BelongsTo
    {
        return $this->belongsTo(TravelLocation::class, 'travel_location_id', 'id');
    }
}
