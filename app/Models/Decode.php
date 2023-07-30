<?php

namespace App\Models;

use App\Traits\HasUuid;
use Auth;
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

        static::saving(function (Decode $model) {
            if (base64_decode($model->data, true) !== false) {
                $decoded = base64_decode($model->data);
                ray($decoded);
                // If the property is base64_encoded, we decode it
                $model->data = base64_decode($model->data);
            }
        });

        static::creating(function ($model) {
            // Always set the user ID to the currently authenticated user
            $model->user_id = Auth::id();
        });
    }

    protected $fillable = [
        'data',
        'user_id'
    ];

    protected $appends = [
        'print_r',
        'var_export',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getDecodedDataAttribute()
    {
        // $serialized = base64_decode($this->data);
        $unserialized = unserialize($this->data);

        return $unserialized;
    }

    public function getPrintRAttribute(): string
    {
        $print_r = print_r($this->decoded_data, true);

        return $print_r;
    }

    public function getVarExportAttribute(): string
    {
        $var_export = var_export($this->decoded_data, true);

        ray($var_export);

        return $var_export;
    }
}
