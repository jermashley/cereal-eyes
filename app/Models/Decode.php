<?php

namespace App\Models;

use Auth;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Decode extends Model
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function (Decode $decode) {
            if (base64_decode($decode->data, true) !== false) {
                $decoded = base64_decode($decode->data);
                ray($decoded);
                // If the property is base64_encoded, we decode it
                $decode->data = base64_decode($decode->data);
            }
        });

        static::creating(function ($model) {
            // Always set the user ID to the currently authenticated user
            $model->user_id = Auth::id();
        });
    }

    protected $fillable = [
        'raw',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
