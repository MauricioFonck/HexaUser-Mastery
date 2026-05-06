<?php

declare(strict_types=1);

final class WebRoutes
{
    private static array $routes = [
        'home'         => ['method' => 'GET',  'action' => 'index'],
        'users.list'   => ['method' => 'GET',  'action' => 'index'],
        'users.create' => ['method' => 'GET',  'action' => 'create'],
        'users.store'  => ['method' => 'POST', 'action' => 'store'],
        'users.show'   => ['method' => 'GET',  'action' => 'show'],
        'users.edit'   => ['method' => 'GET',  'action' => 'edit'],
        'users.update' => ['method' => 'POST', 'action' => 'update'],
        'users.delete' => ['method' => 'POST', 'action' => 'delete'],
        'auth.login'   => ['method' => 'GET',  'action' => 'loginForm'],
        'auth.post'    => ['method' => 'POST', 'action' => 'login'],
        'auth.logout'  => ['method' => 'GET',  'action' => 'logout'],
    ];

    public static function get(string $name): ?array
    {
        return self::$routes[$name] ?? null;
    }

    public static function all(): array
    {
        return self::$routes;
    }
}
