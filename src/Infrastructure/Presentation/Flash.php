<?php

declare(strict_types=1);

final class Flash
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set(string $key, $value): void
    {
        self::start();
        $_SESSION['_flash'][$key] = $value;
    }

    public static function get(string $key, $default = null)
    {
        self::start();
        $value = $_SESSION['_flash'][$key] ?? $default;
        unset($_SESSION['_flash'][$key]);
        return $value;
    }

    public static function setSuccess(string $message): void { self::set('success', $message); }
    public static function success(): ?string { return self::get('success'); }

    public static function setError(string $message): void { self::set('error', $message); }
    public static function error(): ?string { return self::get('error'); }
}
