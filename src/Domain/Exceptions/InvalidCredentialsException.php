<?php

declare(strict_types=1);

final class InvalidCredentialsException extends RuntimeException
{
    public static function becauseCredentialsAreInvalid(): self
    {
        return new self('Correo electrónico o contraseña incorrectos.');
    }

    public static function becauseUserIsNotActive(): self
    {
        return new self('La cuenta no está activa. Por favor, contacta al administrador.');
    }
}
