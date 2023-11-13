<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consumer extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price_per_person',
        'open_time',
        'close_time',
        'is_deleted',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'review_id', 'id');
    }
}
