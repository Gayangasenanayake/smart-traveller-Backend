<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'img',
    ];

    public function hotel_types(): HasOne
    {
        return $this->hasOne(HotelType::class, 'hotel_id', 'id');
    }

    public function province(): HasOne
    {
        return $this->hasOne(Province::class, 'hotel_id', 'id');
    }

    public function district(): HasOne
    {
        return $this->hasOne(District::class, 'hotel_id', 'id');
    }

    public function location_links(): HasOne
    {
        return $this->hasOne(LocationLinks::class, 'hotel_id', 'id');
    }
}
