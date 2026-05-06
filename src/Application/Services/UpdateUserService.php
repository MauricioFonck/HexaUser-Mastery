<?php

declare(strict_types=1);

final class UpdateUserService implements UpdateUserUseCase
{
    private UpdateUserPort $updateUserPort;
    private GetUserByIdPort $getUserByIdPort;
    private UserApplicationMapper $mapper;

    public function __construct(
        UpdateUserPort $updateUserPort,
        GetUserByIdPort $getUserByIdPort,
        UserApplicationMapper $mapper
    ) {
        $this->updateUserPort  = $updateUserPort;
        $this->getUserByIdPort = $getUserByIdPort;
        $this->mapper          = $mapper;
    }

    public function execute(UpdateUserCommand $command): UserModel
    {
        $userId = new UserId($command->getId());
        $existingUser = $this->getUserByIdPort->getById($userId);

        if ($existingUser === null) {
            throw UserNotFoundException::becauseIdWasNotFound($userId->value());
        }

        $user = $this->mapper->fromUpdateCommandToModel($command, $existingUser);
        return $this->updateUserPort->update($user);
    }
}
