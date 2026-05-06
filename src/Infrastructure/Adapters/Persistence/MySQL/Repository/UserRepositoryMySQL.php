<?php

declare(strict_types=1);

final class UserRepositoryMySQL implements 
    SaveUserPort, 
    UpdateUserPort, 
    DeleteUserPort, 
    GetUserByIdPort, 
    GetUserByEmailPort, 
    GetAllUsersPort
{
    private PDO $pdo;
    private UserPersistenceMapper $mapper;

    public function __construct(PDO $pdo, UserPersistenceMapper $mapper)
    {
        $this->pdo    = $pdo;
        $this->mapper = $mapper;
    }

    public function save(UserModel $user): UserModel
    {
        $dto = $this->mapper->fromModelToDto($user);
        
        $sql = "INSERT INTO users (id, name, email, password, role, status) 
                VALUES (:id, :name, :email, :password, :role, :status)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dto->toArray());

        return $this->getById($user->id());
    }

    public function update(UserModel $user): UserModel
    {
        $dto = $this->mapper->fromModelToDto($user);
        
        $sql = "UPDATE users SET name = :name, email = :email, password = :password, 
                role = :role, status = :status WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dto->toArray());

        return $this->getById($user->id());
    }

    public function delete(UserId $userId): void
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $userId->value()]);
    }

    public function getById(UserId $userId): ?UserModel
    {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $userId->value()]);
        
        $row = $stmt->fetch();
        if (!$row) {
            return null;
        }

        return $this->mapper->fromEntityToModel($this->mapper->fromRowToEntity($row));
    }

    public function getByEmail(UserEmail $email): ?UserModel
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email->value()]);
        
        $row = $stmt->fetch();
        if (!$row) {
            return null;
        }

        return $this->mapper->fromEntityToModel($this->mapper->fromRowToEntity($row));
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM users ORDER BY created_at DESC";
        $stmt = $this->pdo->query($sql);
        
        $rows = $stmt->fetchAll();
        return $this->mapper->fromRowsToModels($rows);
    }
}
