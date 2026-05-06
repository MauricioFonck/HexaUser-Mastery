<?php

declare(strict_types=1);

final class UserWebMapper
{
    public function fromCreateRequestToCommand(CreateUserRequest $request): CreateUserCommand
    {
        return new CreateUserCommand(
            $request->getId(),
            $request->getName(),
            $request->getEmail(),
            $request->getPassword(),
            $request->getRole()
        );
    }

    public function fromUpdateRequestToCommand(UpdateUserRequest $request): UpdateUserCommand
    {
        return new UpdateUserCommand(
            $request->getId(),
            $request->getName(),
            $request->getEmail(),
            $request->getPassword(),
            $request->getRole(),
            $request->getStatus()
        );
    }

    public function fromModelToResponse(UserModel $user): UserResponse
    {
        return new UserResponse(
            $user->id()->value(),
            $user->name()->value(),
            $user->email()->value(),
            $user->role(),
            $user->status()
        );
    }

    public function fromModelsToResponses(array $users): array
    {
        return array_map([$this, 'fromModelToResponse'], $users);
    }
}
