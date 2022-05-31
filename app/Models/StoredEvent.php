<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoredEvent extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'event_properties' => 'array',
    ];

    public function scopeHistory(Builder $query, string $accountId): Builder
    {
        return $query->select([
            'event_class',
            'event_properties',
            'created_at',
        ])
            ->whereIn('event_class', [
                'Money Deposited',
                'Money Withdrew',
            ])
            ->whereJsonContains('event_properties->uuid', $accountId)
            ->latest();
    }
}
