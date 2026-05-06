<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class CreateUserServiceTest extends TestCase
{
    private $saveUserPort;
    private $getUserByEmailPort;
    private $mapper;
    private $service;

    protected function setUp(): void
    {
        $this->saveUserPort = $this->createMock(SaveUserPort::class);
        $this->getUserByEmailPort = $this->createMock(GetUserByEmailPort::class);
        $this->mapper = new UserApplicationMapper();
        
        $this->service = new CreateUserService(
            $this->saveUserPort,
            $this->getUserByEmailPort,
            $this->mapper
        );
    }

    public function testShouldCreateUserSuccessfully(): void
    {
        $command = new CreateUserCommand(
            '123',
            'Juan Perez',
            'juan@example.com',
            'password123',
            'USER'
        );

        $this->getUserByEmailPort->method('getByEmail')->willReturn(null);
        
        $this->saveUserPort->expects($this->once())
            ->method('save')
            ->willReturnCallback(function (UserModel $user) {
                return $user;
            });

        $user = $this->service->execute($command);

        $this->assertEquals('123', $user->id()->value());
        $this->assertEquals('juan@example.com', $user->email()->value());
    }

    public function testShouldThrowExceptionWhenEmailAlreadyExists(): void
    {
        $command = new CreateUserCommand(
            '123',
            'Juan Perez',
            'juan@example.com',
            'password123',
            'USER'
        );

        $existingUser = UserModel::create(
            new UserId('123'),
            new UserName('Juan Perez'),
            new UserEmail('juan@example.com'),
            UserPassword::fromPlainText('password123'),
            'USER'
        );
        $this->getUserByEmailPort->method('getByEmail')->willReturn($existingUser);

        $this->expectException(UserAlreadyExistsException::class);
        
        $this->service->execute($command);
    }
}
