<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(mixed $validated)
 * @method static findOrFail($course_id)
 */
class Hotel extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price_per_person',
        'open_time',
        'close_time',
        'is_deleted',
    ];

    public function hotel_types(): HasMany
    {
        return $this->hasMany(HotelType::class, 'hotel_id', 'id');
    }

    public function province(): HasMany
    {
        return $this->hasMany(Province::class, 'hotel_id', 'id');
    }

    public function district(): HasMany
    {
        return $this->hasMany(District::class, 'hotel_id', 'id');
    }

    public function location_links(): HasMany
    {
        return $this->hasMany(LocationLinks::class, 'hotel_id', 'id');
    }
}
