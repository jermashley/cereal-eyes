<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DecodeType extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'name',
    ];

    public function decodes(): HasMany
    {
        return $this->hasMany(Decode::class);
    }
}
