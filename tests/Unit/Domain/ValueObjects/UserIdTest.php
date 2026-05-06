<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class UserIdTest extends TestCase
{
    public function testShouldCreateValidUserId(): void
    {
        $id = 'user-123';
        $userId = new UserId($id);

        $this->assertEquals($id, $userId->value());
    }

    public function testShouldThrowExceptionWhenIdIsEmpty(): void
    {
        $this->expectException(InvalidUserIdException::class);
        new UserId('');
    }

    public function testShouldThrowExceptionWhenIdIsOnlyWhitespace(): void
    {
        $this->expectException(InvalidUserIdException::class);
        new UserId('   ');
    }

    public function testShouldBeEqualtoOtherUserId(): void
    {
        $userId1 = new UserId('123');
        $userId2 = new UserId('123');
        $userId3 = new UserId('456');

        $this->assertTrue($userId1->equals($userId2));
        $this->assertFalse($userId1->equals($userId3));
    }
}
