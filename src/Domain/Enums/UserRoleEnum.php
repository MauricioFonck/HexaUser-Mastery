<?php

declare(strict_types=1);

final class UserRoleEnum
{
    public const ADMIN = 'ADMIN';
    public const USER  = 'USER';

    public static function values(): array
    {
        return [self::ADMIN, self::USER];
    }

    public static function isValid(string $role): bool
    {
        return in_array(strtoupper($role), self::values(), true);
    }

    public static function ensureIsValid(string $role): void
    {
        if (!self::isValid($role)) {
            throw InvalidUserRoleException::becauseValueIsInvalid($role);
        }
    }
}
