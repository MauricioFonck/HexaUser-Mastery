<?php

declare(strict_types=1);

final class UserStatusEnum
{
    public const ACTIVE   = 'ACTIVE';
    public const INACTIVE = 'INACTIVE';
    public const PENDING  = 'PENDING';

    public static function values(): array
    {
        return [self::ACTIVE, self::INACTIVE, self::PENDING];
    }

    public static function isValid(string $status): bool
    {
        return in_array(strtoupper($status), self::values(), true);
    }

    public static function ensureIsValid(string $status): void
    {
        if (!self::isValid($status)) {
            throw InvalidUserStatusException::becauseValueIsInvalid($status);
        }
    }
}
