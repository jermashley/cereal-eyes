<?php

namespace App\Helpers\DataTransformation\Codecs;

class Base64
{
    public static function isBase64Encoded($data): bool
    {
        return base64_encode(base64_decode($data)) === $data;
    }

    public static function decode(string $data)
    {
        if (self::isBase64Encoded($data)) {
            return base64_decode($data);
        } else {
            return null;
        }
    }
}
