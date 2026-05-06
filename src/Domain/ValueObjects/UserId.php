<?php

declare(strict_types=1);

final class UserId
{
    private string $value;

    public function __construct(string $value)
    {
        $this->ensureIsValid($value);
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(UserId $other): bool
    {
        return $this->value === $other->value();
    }

    private function ensureIsValid(string $value): void
    {
        if (empty(trim($value))) {
            throw InvalidUserIdException::becauseValueIsEmpty();
        }
    }
}
