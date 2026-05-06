<?php

declare(strict_types=1);

final class UserRepositoryMySQLTest extends IntegrationTestCase
{
    private UserRepositoryMySQL $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new UserRepositoryMySQL($this->pdo, new UserPersistenceMapper());
    }

    public function testShouldSaveAndGetAUser(): void
    {
        $user = UserModel::create(
            new UserId('test-123'),
            new UserName('Integration Test'),
            new UserEmail('integration@test.com'),
            UserPassword::fromPlainText('password123'),
            'USER'
        );

        $this->repository->save($user);

        $savedUser = $this->repository->getById(new UserId('test-123'));

        $this->assertNotNull($savedUser);
        $this->assertEquals('Integration Test', $savedUser->name()->value());
        $this->assertEquals('integration@test.com', $savedUser->email()->value());
    }

    public function testShouldReturnNullWhenUserNotFound(): void
    {
        $user = $this->repository->getById(new UserId('non-existent'));
        $this->assertNull($user);
    }

    public function testShouldDeleteAUser(): void
    {
        $userId = new UserId('test-delete');
        $user = UserModel::create(
            $userId,
            new UserName('To Delete'),
            new UserEmail('delete@test.com'),
            UserPassword::fromPlainText('password123'),
            'USER'
        );

        $this->repository->save($user);
        $this->assertNotNull($this->repository->getById($userId));

        $this->repository->delete($userId);
        $this->assertNull($this->repository->getById($userId));
    }
}
