<?php

declare(strict_types=1);

namespace App\Enums;

class RoleEnum
{
    public const SUPER_ADMIN = 'super_admin';
    public const ADMIN = 'admin';
    public const STAFF = 'staff';

    public static function getValues(): array
    {
        return [
            self::SUPER_ADMIN,
            self::ADMIN,
            self::STAFF,
        ];
    }

    public static function getLabels(): array
    {
        return [
            self::SUPER_ADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
            self::STAFF => 'Staff',
        ];
    }
}
