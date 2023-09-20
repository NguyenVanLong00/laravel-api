<?php

namespace App\Enums;

enum Role
{
    case ADMIN;
    case USER;


    /**
     * @param Role $role
     * @return array
     */
    public static function getPermission(Role $role): array
    {
        return match ($role) {
            Role::ADMIN => self::adminPermissions(),
            Role::USER => self::userPermissions()
        };
    }

    /**
     * @return array
     */
    public static function adminPermissions(): array
    {
        return Permission::cases();
    }

    /**
     * @return array
     */
    public static function userPermissions(): array
    {
        return [
        ];
    }
}