<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payout extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return ['paid_at' => 'datetime'];
    }

    /**
     * The tutor/user who receives this payout.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}