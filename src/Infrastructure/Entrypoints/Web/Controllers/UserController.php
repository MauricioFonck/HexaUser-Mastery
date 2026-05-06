<?php

declare(strict_types=1);

final class UserController
{
    private CreateUserUseCase $createUseCase;
    private UpdateUserUseCase $updateUseCase;
    private DeleteUserUseCase $deleteUseCase;
    private GetUserByIdUseCase $getByIdUseCase;
    private GetAllUsersUseCase $getAllUseCase;
    private UserWebMapper $mapper;

    public function __construct(
        CreateUserUseCase $createUseCase,
        UpdateUserUseCase $updateUseCase,
        DeleteUserUseCase $deleteUseCase,
        GetUserByIdUseCase $getByIdUseCase,
        GetAllUsersUseCase $getAllUseCase,
        UserWebMapper $mapper
    ) {
        $this->createUseCase = $createUseCase;
        $this->updateUseCase = $updateUseCase;
        $this->deleteUseCase = $deleteUseCase;
        $this->getByIdUseCase = $getByIdUseCase;
        $this->getAllUseCase = $getAllUseCase;
        $this->mapper        = $mapper;
    }

    public function index(): array
    {
        $users = $this->getAllUseCase->execute(new GetAllUsersQuery());
        return $this->mapper->fromModelsToResponses($users);
    }

    public function show(string $id): UserResponse
    {
        $user = $this->getByIdUseCase->execute(new GetUserByIdQuery($id));
        return $this->mapper->fromModelToResponse($user);
    }

    public function store(CreateUserRequest $request): UserResponse
    {
        $command = $this->mapper->fromCreateRequestToCommand($request);
        $user = $this->createUseCase->execute($command);
        return $this->mapper->fromModelToResponse($user);
    }

    public function update(UpdateUserRequest $request): UserResponse
    {
        $command = $this->mapper->fromUpdateRequestToCommand($request);
        $user = $this->updateUseCase->execute($command);
        return $this->mapper->fromModelToResponse($user);
    }

    public function delete(string $id): void
    {
        $this->deleteUseCase->execute(new DeleteUserCommand($id));
    }
}
