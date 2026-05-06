<?php

declare(strict_types=1);

final class DependencyInjection
{
    public static function boot(): void
    {
        require_once __DIR__ . '/ClassLoader.php';
        ClassLoader::register();
    }

    public static function getUserController(): UserController
    {
        return new UserController(
            self::getCreateUserUseCase(),
            self::getUpdateUserUseCase(),
            self::getDeleteUserUseCase(),
            self::getGetUserByIdUseCase(),
            self::getGetAllUsersUseCase(),
            self::getUserWebMapper()
        );
    }

    public static function getCreateUserUseCase(): CreateUserUseCase
    {
        return new CreateUserService(
            self::getUserRepository(),
            self::getUserRepository(),
            self::getUserApplicationMapper()
        );
    }

    public static function getUpdateUserUseCase(): UpdateUserUseCase
    {
        return new UpdateUserService(
            self::getUserRepository(),
            self::getUserRepository(),
            self::getUserApplicationMapper()
        );
    }

    public static function getDeleteUserUseCase(): DeleteUserUseCase
    {
        return new DeleteUserService(
            self::getUserRepository(),
            self::getUserRepository()
        );
    }

    public static function getGetUserByIdUseCase(): GetUserByIdUseCase
    {
        return new GetUserByIdService(
            self::getUserRepository()
        );
    }

    public static function getGetAllUsersUseCase(): GetAllUsersUseCase
    {
        return new GetAllUsersService(
            self::getUserRepository()
        );
    }

    private static function getUserRepository(): UserRepositoryMySQL
    {
        $connection = new Connection();
        return new UserRepositoryMySQL(
            $connection->createPdo(),
            new UserPersistenceMapper()
        );
    }

    private static function getUserApplicationMapper(): UserApplicationMapper
    {
        return new UserApplicationMapper();
    }

    private static function getUserWebMapper(): UserWebMapper
    {
        return new UserWebMapper();
    }
}
