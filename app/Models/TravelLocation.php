<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static findOrFail($hotel_id)
 * @method static create(mixed $validated)
 */
class TravelLocation extends Model
{
    protected $fillable = [
        'name',
        'description',
        'ticket_price',
        'open_time',
        'close_time',
        'is_deleted',
        'img',
    ];

    public function type(): HasOne
    {
        return $this->hasOne(TravelLocationType::class, 'travel_location_id', 'id');
    }

    public function province(): HasOne
    {
        return $this->hasOne(Province::class, 'travel_location_id', 'id');
    }

    public function district(): HasOne
    {
        return $this->hasOne(District::class, 'travel_location_id', 'id');
    }

    public function location_links(): HasMany
    {
        return $this->hasMany(LocationLinks::class, 'travel_location_id', 'id');
    }
}
