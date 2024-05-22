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
        'decode_type_id',
    ];

    protected $hidden = [
        'data',
    ];

    protected $with = [
        'type',
    ];

    protected $appends = [
        'print_r',
        'var_export',
        'json',
        'base64',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(DecodeType::class, 'decode_type_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPrintRAttribute()
    {
        $decodeType = $this->type;

        return $decodeType->name === DecodeTypeEnum::SERIAL->value ? print_r(Crypt::decrypt($this->data), true) : null;
    }

    public function getVarExportAttribute()
    {
        $decodeType = $this->type;

        return $decodeType->name === DecodeTypeEnum::SERIAL->value ? var_export(Crypt::decrypt($this->data), true) : null;
    }

    public function getJsonAttribute()
    {
        $decodeType = $this->type;

        if ($decodeType->name === DecodeTypeEnum::SERIAL->value) {
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

    public function getBase64Attribute()
    {
        $decodeType = $this->type;

        return $decodeType->name === DecodeTypeEnum::BASE64->value ? Crypt::decrypt($this->data) : null;
    }
}
