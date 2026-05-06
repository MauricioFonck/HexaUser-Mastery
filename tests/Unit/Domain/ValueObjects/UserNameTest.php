<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class UserNameTest extends TestCase
{
    public function testShouldCreateValidUserName(): void
    {
        $name = 'Juan Perez';
        $userName = new UserName($name);

        $this->assertEquals($name, $userName->value());
    }

    public function testShouldThrowExceptionWhenNameIsTooShort(): void
    {
        $this->expectException(InvalidUserNameException::class);
        new UserName('Jo');
    }

    public function testShouldThrowExceptionWhenNameIsEmpty(): void
    {
        $this->expectException(InvalidUserNameException::class);
        new UserName('');
    }
}
