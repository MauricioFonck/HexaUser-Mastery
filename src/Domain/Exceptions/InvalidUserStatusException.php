<?php

declare(strict_types=1);

final class InvalidUserStatusException extends InvalidArgumentException
{
    public static function becauseValueIsInvalid(string $status): self
    {
        return new self(sprintf('El estado "%s" no es válido.', $status));
    }
}
