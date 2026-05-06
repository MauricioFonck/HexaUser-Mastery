<?php

declare(strict_types=1);

final class CreateUserService implements CreateUserUseCase
{
    private SaveUserPort $saveUserPort;
    private GetUserByEmailPort $getUserByEmailPort;
    private UserApplicationMapper $mapper;

    public function __construct(
        SaveUserPort $saveUserPort,
        GetUserByEmailPort $getUserByEmailPort,
        UserApplicationMapper $mapper
    ) {
        $this->saveUserPort       = $saveUserPort;
        $this->getUserByEmailPort = $getUserByEmailPort;
        $this->mapper             = $mapper;
    }

    public function execute(CreateUserCommand $command): UserModel
    {
        $email = new UserEmail($command->getEmail());
        $existingUser = $this->getUserByEmailPort->getByEmail($email);

        if ($existingUser !== null) {
            throw UserAlreadyExistsException::becauseEmailAlreadyExists($email->value());
        }

        $user = $this->mapper->fromCreateCommandToModel($command);
        return $this->saveUserPort->save($user);
    }
}
