<?php

namespace App\Helpers\DataTransformation\Serializers;

class Serialized
{
    public static function isSerialized(string $data): bool
    {
        // Trim any whitespace around the string to ensure accurate regex matching
        $data = trim($data);

        // Check the simplest serialized form: null
        if ($data === 'N;') {
            return true;
        }

        // Regular expression to check the format starting with type:length:
        if (! preg_match('/^([adObis]):/', $data, $matches)) {
            return false;
        }

        // Validate based on type
        switch ($matches[1]) {
            case 'a':  // Array: a:length:{key definition;value definition;(repeated per element)}
            case 'O':  // Object: O:length:"class name":length:{property definition;property definition;...}
            case 's':  // String: s:length:"data";
                return preg_match("/^{$matches[1]}:[0-9]+:.*[;}]\$/s", $data);
            case 'b':  // Boolean: b:0; or b:1;
            case 'i':  // Integer: i:number;
            case 'd':  // Decimal: d:number;
                return preg_match("/^{$matches[1]}:[0-9.E-]+;\$/", $data);
        }

        return false;
    }

    public static function decode(string $data)
    {
        if (self::isSerialized($data)) {
            return unserialize($data);
        } else {
            return null;
        }
    }
}
