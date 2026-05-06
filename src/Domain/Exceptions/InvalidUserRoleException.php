<?php

declare(strict_types=1);

final class InvalidUserRoleException extends InvalidArgumentException
{
    public static function becauseValueIsInvalid(string $role): self
    {
        return new self(sprintf('El rol "%s" no es válido.', $role));
    }
}
