<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class UpdateUserServiceTest extends TestCase
{
    private $updateUserPort;
    private $getUserByIdPort;
    private $mapper;
    private $service;

    protected function setUp(): void
    {
        $this->updateUserPort = $this->createMock(UpdateUserPort::class);
        $this->getUserByIdPort = $this->createMock(GetUserByIdPort::class);
        $this->mapper = new UserApplicationMapper();
        
        $this->service = new UpdateUserService(
            $this->updateUserPort,
            $this->getUserByIdPort,
            $this->mapper
        );
    }

    public function testShouldUpdateUserSuccessfully(): void
    {
        $command = new UpdateUserCommand(
            '123',
            'Juan Actualizado',
            'juan@example.com',
            null, // No cambiar password
            'ADMIN',
            'ACTIVE'
        );

        $existingUser = new UserModel(
            new UserId('123'),
            new UserName('Juan Perez'),
            new UserEmail('juan@example.com'),
            UserPassword::fromPlainText('password123'),
            'USER',
            'PENDING'
        );

        $this->getUserByIdPort->method('getById')->willReturn($existingUser);
        
        $this->updateUserPort->expects($this->once())
            ->method('update')
            ->willReturnCallback(function (UserModel $user) {
                return $user;
            });

        $user = $this->service->execute($command);

        $this->assertEquals('Juan Actualizado', $user->name()->value());
        $this->assertEquals('ADMIN', $user->role());
        $this->assertEquals('ACTIVE', $user->status());
    }

    public function testShouldThrowExceptionWhenUserNotFound(): void
    {
        $command = new UpdateUserCommand('non-existent', 'Name', 'email@test.com', null, 'USER', 'ACTIVE');
        $this->getUserByIdPort->method('getById')->willReturn(null);

        $this->expectException(UserNotFoundException::class);
        $this->service->execute($command);
    }
}
