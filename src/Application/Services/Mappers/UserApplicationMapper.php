<?php

declare(strict_types=1);

final class UserApplicationMapper
{
    public function fromCreateCommandToModel(CreateUserCommand $command): UserModel
    {
        return UserModel::create(
            new UserId($command->getId()),
            new UserName($command->getName()),
            new UserEmail($command->getEmail()),
            UserPassword::fromPlainText($command->getPassword()),
            $command->getRole()
        );
    }

    public function fromUpdateCommandToModel(UpdateUserCommand $command, UserModel $existingUser): UserModel
    {
        $password = $command->getPassword();
        $userPassword = (!empty($password))
            ? UserPassword::fromPlainText($password)
            : $existingUser->password();

        return new UserModel(
            new UserId($command->getId()),
            new UserName($command->getName()),
            new UserEmail($command->getEmail()),
            $userPassword,
            $command->getRole(),
            $command->getStatus()
        );
    }

    public function fromModelToArray(UserModel $user): array
    {
        return [
            'id'     => $user->id()->value(),
            'name'   => $user->name()->value(),
            'email'  => $user->email()->value(),
            'role'   => $user->role(),
            'status' => $user->status(),
        ];
    }

    public function fromModelsToArray(array $users): array
    {
        return array_map([$this, 'fromModelToArray'], $users);
    }
}
