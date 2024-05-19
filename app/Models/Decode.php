<?php

namespace App\Models;

use App\Enums\DecodeTypeEnum;
use App\Observers\DecodeObserver;
use App\Traits\HasUuid;
use Crypt;
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
        'type',
    ];

    protected $casts = [
        'type' => DecodeTypeEnum::class,
    ];

    protected $appends = [
        'print_r',
        'var_export',
        'json',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(DecodeType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPrintRAttribute()
    {
        return $this->data ? print_r(Crypt::decrypt($this->data), true) : null;
    }

    public function getVarExportAttribute()
    {
        return $this->data ? var_export(Crypt::decrypt($this->data), true) : null;
    }

    public function getJsonAttribute()
    {
        if ($this->data) {
            // Decrypt the data
            $decrypted = Crypt::decrypt($this->data);

            $json = json_encode($decrypted, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            // Clean the data by removing \n and \t
            $cleanedJson = preg_replace('/[\n\t]/', '', $json);

            // Return JSON encoded data
            return json_decode($cleanedJson);
        }

        return null;
    }
}
