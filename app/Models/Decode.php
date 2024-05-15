<?php

namespace App\Models;

use App\Observers\DecodeObserver;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([DecodeObserver::class])]
class Decode extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'user_id',
        'data',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
