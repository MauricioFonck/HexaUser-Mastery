<?php

declare(strict_types=1);

final class InvalidUserNameException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('El nombre de usuario no puede estar vacío.');
    }

    public static function becauseValueIsTooShort(int $min): self
    {
        return new self(sprintf('El nombre de usuario debe tener al menos %d caracteres.', $min));
    }
}
