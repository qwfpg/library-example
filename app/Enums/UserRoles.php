<?php

namespace App\Enums;

enum UserRoles: string
{
    case Employee = 'employee';
    case Reader = 'reader';

    public static function getValues(): array
    {
        return array_map(function ($item) {
            return $item->value;
        }, self::cases());
    }
}
