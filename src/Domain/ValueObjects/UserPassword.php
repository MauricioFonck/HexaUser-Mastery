<?php

declare(strict_types=1);

final class UserPassword
{
    private string $value;

    public function __construct(string $hash)
    {
        $this->value = $hash;
    }

    public static function fromPlainText(string $plainText): self
    {
        self::ensureIsValid($plainText);
        return new self(password_hash($plainText, PASSWORD_BCRYPT));
    }

    public static function fromHash(string $hash): self
    {
        return new self($hash);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function verifyPlain(string $plainText): bool
    {
        return password_verify($plainText, $this->value);
    }

    private static function ensureIsValid(string $value): void
    {
        if (empty($value)) {
            throw InvalidUserPasswordException::becauseValueIsEmpty();
        }

        if (strlen($value) < 8) {
            throw InvalidUserPasswordException::becauseValueIsTooShort(8);
        }
    }
}
