<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class UserPasswordTest extends TestCase
{
    public function testShouldCreatePasswordFromPlainText(): void
    {
        $plain = 'password123';
        $password = UserPassword::fromPlainText($plain);

        $this->assertTrue($password->verifyPlain($plain));
        $this->assertNotEquals($plain, $password->value()); // Debe estar hasheada
    }

    public function testShouldThrowExceptionWhenPasswordIsTooShort(): void
    {
        $this->expectException(InvalidUserPasswordException::class);
        UserPassword::fromPlainText('short');
    }

    public function testShouldCreateFromHash(): void
    {
        $hash = password_hash('secret123', PASSWORD_BCRYPT);
        $password = UserPassword::fromHash($hash);

        $this->assertEquals($hash, $password->value());
        $this->assertTrue($password->verifyPlain('secret123'));
    }
}
