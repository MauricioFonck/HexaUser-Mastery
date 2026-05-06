<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class UserModelTest extends TestCase
{
    private UserId $id;
    private UserName $name;
    private UserEmail $email;
    private UserPassword $password;

    protected function setUp(): void
    {
        $this->id = new UserId('123');
        $this->name = new UserName('Juan Perez');
        $this->email = new UserEmail('juan@example.com');
        $this->password = UserPassword::fromPlainText('password123');
    }

    public function testShouldCreateUserWithPendingStatusByDefault(): void
    {
        $user = UserModel::create(
            $this->id,
            $this->name,
            $this->email,
            $this->password,
            UserRoleEnum::USER
        );

        $this->assertEquals(UserStatusEnum::PENDING, $user->status());
        $this->assertEquals('USER', $user->role());
    }

    public function testShouldActivateUser(): void
    {
        $user = UserModel::create(
            $this->id,
            $this->name,
            $this->email,
            $this->password,
            UserRoleEnum::USER
        );

        $activatedUser = $user->activate();

        $this->assertEquals(UserStatusEnum::ACTIVE, $activatedUser->status());
    }

    public function testShouldThrowExceptionWithInvalidRole(): void
    {
        $this->expectException(InvalidUserRoleException::class);
        
        new UserModel(
            $this->id,
            $this->name,
            $this->email,
            $this->password,
            'INVALID_ROLE',
            UserStatusEnum::ACTIVE
        );
    }
}
