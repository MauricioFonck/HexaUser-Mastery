<?php

declare(strict_types=1);

final class InvalidUserEmailException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('El correo electrónico no puede estar vacío.');
    }

    public static function becauseValueIsInvalid(string $email): self
    {
        return new self(sprintf('El correo electrónico "%s" no tiene un formato válido.', $email));
    }
}
