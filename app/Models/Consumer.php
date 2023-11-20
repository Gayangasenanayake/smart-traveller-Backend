<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $except)
 */
class Consumer extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'review_id',
        'is_deleted',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'review_id', 'id');
    }
}
