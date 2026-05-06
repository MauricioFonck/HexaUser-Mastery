<?php

declare(strict_types=1);

final class UserName
{
    private string $value;

    public function __construct(string $value)
    {
        $this->ensureIsValid($value);
        $this->value = trim($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(UserName $other): bool
    {
        return $this->value === $other->value();
    }

    private function ensureIsValid(string $value): void
    {
        $trimmed = trim($value);
        if (empty($trimmed)) {
            throw InvalidUserNameException::becauseValueIsEmpty();
        }

        if (strlen($trimmed) < 3) {
            throw InvalidUserNameException::becauseValueIsTooShort(3);
        }
    }
}
