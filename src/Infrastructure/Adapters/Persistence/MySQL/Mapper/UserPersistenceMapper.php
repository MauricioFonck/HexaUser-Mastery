<?php

declare(strict_types=1);

final class UserPersistenceMapper
{
    public function fromModelToDto(UserModel $user): UserPersistenceDto
    {
        return new UserPersistenceDto(
            $user->id()->value(),
            $user->name()->value(),
            $user->email()->value(),
            $user->password()->value(),
            $user->role(),
            $user->status()
        );
    }

    public function fromRowToEntity(array $row): UserEntity
    {
        return new UserEntity(
            $row['id'],
            $row['name'],
            $row['email'],
            $row['password'],
            $row['role'],
            $row['status'],
            $row['created_at'] ?? null,
            $row['updated_at'] ?? null
        );
    }

    public function fromEntityToModel(UserEntity $entity): UserModel
    {
        return new UserModel(
            new UserId($entity->getId()),
            new UserName($entity->getName()),
            new UserEmail($entity->getEmail()),
            UserPassword::fromHash($entity->getPassword()),
            $entity->getRole(),
            $entity->getStatus()
        );
    }

    public function fromRowsToModels(array $rows): array
    {
        return array_map(function (array $row) {
            return $this->fromEntityToModel($this->fromRowToEntity($row));
        }, $rows);
    }
}
