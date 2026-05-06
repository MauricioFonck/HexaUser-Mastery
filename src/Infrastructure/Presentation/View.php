<?php

declare(strict_types=1);

final class View
{
    private static string $viewsPath = __DIR__ . '/Views/';

    public static function render(string $template, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        
        $templatePath = self::$viewsPath . $template . '.php';
        
        if (!file_exists($templatePath)) {
            throw new RuntimeException("Vista no encontrada: " . $template);
        }

        require_once $templatePath;
    }

    public static function redirect(string $route): void
    {
        header("Location: ?route=" . $route);
        exit;
    }
}
