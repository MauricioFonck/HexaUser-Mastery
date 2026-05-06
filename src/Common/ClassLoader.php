<?php

declare(strict_types=1);

final class ClassLoader
{
    private static array $map = [];

    public static function register(): void
    {
        spl_autoload_register([self::class, 'load']);
        self::initMap();
    }

    private static function load(string $className): void
    {
        if (isset(self::$map[$className])) {
            require_once self::$map[$className];
        }
    }

    private static function initMap(): void
    {
        $baseDir = dirname(__DIR__);
        self::$map = [
            // Domain
            'InvalidUserIdException'       => $baseDir . '/Domain/Exceptions/InvalidUserIdException.php',
            'InvalidUserNameException'     => $baseDir . '/Domain/Exceptions/InvalidUserNameException.php',
            'InvalidUserEmailException'    => $baseDir . '/Domain/Exceptions/InvalidUserEmailException.php',
            'InvalidUserPasswordException' => $baseDir . '/Domain/Exceptions/InvalidUserPasswordException.php',
            'InvalidUserRoleException'     => $baseDir . '/Domain/Exceptions/InvalidUserRoleException.php',
            'InvalidUserStatusException'   => $baseDir . '/Domain/Exceptions/InvalidUserStatusException.php',
            'UserAlreadyExistsException'   => $baseDir . '/Domain/Exceptions/UserAlreadyExistsException.php',
            'UserNotFoundException'        => $baseDir . '/Domain/Exceptions/UserNotFoundException.php',
            'InvalidCredentialsException'  => $baseDir . '/Domain/Exceptions/InvalidCredentialsException.php',
            'UserRoleEnum'                 => $baseDir . '/Domain/Enums/UserRoleEnum.php',
            'UserStatusEnum'               => $baseDir . '/Domain/Enums/UserStatusEnum.php',
            'UserId'                       => $baseDir . '/Domain/ValueObjects/UserId.php',
            'UserName'                     => $baseDir . '/Domain/ValueObjects/UserName.php',
            'UserEmail'                    => $baseDir . '/Domain/ValueObjects/UserEmail.php',
            'UserPassword'                 => $baseDir . '/Domain/ValueObjects/UserPassword.php',
            'UserModel'                    => $baseDir . '/Domain/Models/UserModel.php',
            'DomainEvent'                  => $baseDir . '/Domain/Events/DomainEvent.php',
            'UserCreatedDomainEvent'       => $baseDir . '/Domain/Events/UserCreatedDomainEvent.php',

            // Application Ports
            'SaveUserPort'           => $baseDir . '/Application/Ports/Out/SaveUserPort.php',
            'UpdateUserPort'         => $baseDir . '/Application/Ports/Out/UpdateUserPort.php',
            'DeleteUserPort'         => $baseDir . '/Application/Ports/Out/DeleteUserPort.php',
            'GetUserByIdPort'        => $baseDir . '/Application/Ports/Out/GetUserByIdPort.php',
            'GetUserByEmailPort'     => $baseDir . '/Application/Ports/Out/GetUserByEmailPort.php',
            'GetAllUsersPort'        => $baseDir . '/Application/Ports/Out/GetAllUsersPort.php',
            'CreateUserUseCase'      => $baseDir . '/Application/Ports/In/CreateUserUseCase.php',
            'UpdateUserUseCase'      => $baseDir . '/Application/Ports/In/UpdateUserUseCase.php',
            'DeleteUserUseCase'      => $baseDir . '/Application/Ports/In/DeleteUserUseCase.php',
            'GetUserByIdUseCase'     => $baseDir . '/Application/Ports/In/GetUserByIdUseCase.php',
            'GetAllUsersUseCase'     => $baseDir . '/Application/Ports/In/GetAllUsersUseCase.php',

            // Application Services
            'UserApplicationMapper'  => $baseDir . '/Application/Services/Mappers/UserApplicationMapper.php',
            'CreateUserService'      => $baseDir . '/Application/Services/CreateUserService.php',
            'UpdateUserService'      => $baseDir . '/Application/Services/UpdateUserService.php',
            'DeleteUserService'      => $baseDir . '/Application/Services/DeleteUserService.php',
            'GetUserByIdService'     => $baseDir . '/Application/Services/GetUserByIdService.php',
            'GetAllUsersService'     => $baseDir . '/Application/Services/GetAllUsersService.php',
            'CreateUserCommand'      => $baseDir . '/Application/Services/Dto/Commands/CreateUserCommand.php',
            'UpdateUserCommand'      => $baseDir . '/Application/Services/Dto/Commands/UpdateUserCommand.php',
            'DeleteUserCommand'      => $baseDir . '/Application/Services/Dto/Commands/DeleteUserCommand.php',
            'GetUserByIdQuery'       => $baseDir . '/Application/Services/Dto/Queries/GetUserByIdQuery.php',
            'GetAllUsersQuery'       => $baseDir . '/Application/Services/Dto/Queries/GetAllUsersQuery.php',

            // Infrastructure Persistence
            'Connection'             => $baseDir . '/Infrastructure/Adapters/Persistence/MySQL/Config/Connection.php',
            'UserPersistenceDto'     => $baseDir . '/Infrastructure/Adapters/Persistence/MySQL/Dto/UserPersistenceDto.php',
            'UserEntity'             => $baseDir . '/Infrastructure/Adapters/Persistence/MySQL/Entity/UserEntity.php',
            'UserPersistenceMapper'  => $baseDir . '/Infrastructure/Adapters/Persistence/MySQL/Mapper/UserPersistenceMapper.php',
            'UserRepositoryMySQL'    => $baseDir . '/Infrastructure/Adapters/Persistence/MySQL/Repository/UserRepositoryMySQL.php',

            // Infrastructure Web
            'UserController'         => $baseDir . '/Infrastructure/Entrypoints/Web/Controllers/UserController.php',
            'WebRoutes'              => $baseDir . '/Infrastructure/Entrypoints/Web/Config/WebRoutes.php',
            'CreateUserRequest'      => $baseDir . '/Infrastructure/Entrypoints/Web/Dto/CreateUserRequest.php',
            'UpdateUserRequest'      => $baseDir . '/Infrastructure/Entrypoints/Web/Dto/UpdateUserRequest.php',
            'UserResponse'           => $baseDir . '/Infrastructure/Entrypoints/Web/Dto/UserResponse.php',
            'UserWebMapper'          => $baseDir . '/Infrastructure/Entrypoints/Web/Mapper/UserWebMapper.php',
            'Flash'                  => $baseDir . '/Infrastructure/Presentation/Flash.php',
            'View'                   => $baseDir . '/Infrastructure/Presentation/View.php',
        ];
    }
}
