<?php

namespace Database\Seeders;

use App\Enums\DecodeTypeEnum;
use App\Models\DecodeType;
use Illuminate\Database\Seeder;

class DecodeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (DecodeTypeEnum::cases() as $decodeType) {
            DecodeType::create([
                'name' => $decodeType->value,
            ]);
        }
    }
}
