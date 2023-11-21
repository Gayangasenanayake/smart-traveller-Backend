<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Review extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'description',
        'rate',
        'location',
        'is_deleted',
    ];

    public function consumer(): BelongsTo
    {
        return $this->belongsTo(Consumer::class, 'consumer_id', 'id');
    }
}
