<?php

declare(strict_types=1);

final class UserAlreadyExistsException extends DomainException
{
    public static function becauseEmailAlreadyExists(string $email): self
    {
        return new self(sprintf('Ya existe un usuario registrado con el correo electrónico "%s".', $email));
    }
}
