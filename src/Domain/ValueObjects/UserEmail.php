<?php

declare(strict_types=1);

final class UserEmail
{
    private string $value;

    public function __construct(string $value)
    {
        $this->ensureIsValid($value);
        $this->value = strtolower(trim($value));
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(UserEmail $other): bool
    {
        return $this->value === $other->value();
    }

    private function ensureIsValid(string $value): void
    {
        $trimmed = trim($value);
        if (empty($trimmed)) {
            throw InvalidUserEmailException::becauseValueIsEmpty();
        }

        if (!filter_var($trimmed, FILTER_VALIDATE_EMAIL)) {
            throw InvalidUserEmailException::becauseValueIsInvalid($trimmed);
        }
    }
}
