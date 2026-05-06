<?php

declare(strict_types=1);

final class InvalidUserPasswordException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('La contraseña no puede estar vacía.');
    }

    public static function becauseValueIsTooShort(int $min): self
    {
        return new self(sprintf('La contraseña debe tener al menos %d caracteres.', $min));
    }
}
