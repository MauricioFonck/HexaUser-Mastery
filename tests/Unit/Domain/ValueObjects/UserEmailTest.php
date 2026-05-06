<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class UserEmailTest extends TestCase
{
    public function testShouldCreateValidUserEmail(): void
    {
        $email = 'test@example.com';
        $userEmail = new UserEmail($email);

        $this->assertEquals($email, $userEmail->value());
    }

    public function testShouldNormalizeEmailToLowerCase(): void
    {
        $userEmail = new UserEmail('TEST@Example.COM');
        $this->assertEquals('test@example.com', $userEmail->value());
    }

    public function testShouldThrowExceptionWhenEmailIsInvalid(): void
    {
        $this->expectException(InvalidUserEmailException::class);
        new UserEmail('invalid-email');
    }

    public function testShouldThrowExceptionWhenEmailIsEmpty(): void
    {
        $this->expectException(InvalidUserEmailException::class);
        new UserEmail('');
    }
}
