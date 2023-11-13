<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Province extends Model
{
    protected $fillable = [
        'name',
        'hotel_id',
        'travel_location_id',
        'is_deleted',
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }

    public function travel_location(): BelongsTo
    {
        return $this->belongsTo(TravelLocation::class, 'travel_location_id', 'id');
    }
}
