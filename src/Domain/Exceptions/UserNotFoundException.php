<?php

declare(strict_types=1);

final class UserNotFoundException extends DomainException
{
    public static function becauseIdWasNotFound(string $id): self
    {
        return new self(sprintf('No se encontró ningún usuario con el ID "%s".', $id));
    }

    public static function becauseEmailWasNotFound(string $email): self
    {
        return new self(sprintf('No se encontró ningún usuario con el correo electrónico "%s".', $email));
    }
}
