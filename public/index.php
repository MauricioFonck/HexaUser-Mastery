<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/Common/DependencyInjection.php';

DependencyInjection::boot();

$route = $_GET['route'] ?? 'home';
$method = $_SERVER['REQUEST_METHOD'];

$routeConfig = WebRoutes::get($route);

if (!$routeConfig || $routeConfig['method'] !== $method) {
    http_response_code(404);
    echo "404 - Ruta no encontrada o método no permitido";
    exit;
}

try {
    $controller = DependencyInjection::getUserController();

    switch ($route) {
        case 'home':
            View::render('home', ['pageTitle' => 'Inicio - HexaUser Mastery']);
            break;

        case 'users.list':
            $users = $controller->index();
            View::render('users/list', ['pageTitle' => 'Lista de Usuarios', 'users' => $users]);
            break;

        case 'users.create':
            View::render('users/create', ['pageTitle' => 'Nuevo Usuario']);
            break;

        case 'users.store':
            $request = new CreateUserRequest($_POST);
            $controller->store($request);
            Flash::setSuccess('Usuario creado correctamente.');
            View::redirect('users.list');
            break;

        case 'users.edit':
            $id = $_GET['id'] ?? '';
            $user = $controller->show($id);
            View::render('users/edit', ['pageTitle' => 'Editar Usuario', 'user' => $user]);
            break;

        case 'users.update':
            $request = new UpdateUserRequest($_POST);
            $controller->update($request);
            Flash::setSuccess('Usuario actualizado correctamente.');
            View::redirect('users.list');
            break;

        case 'users.delete':
            $id = $_POST['id'] ?? '';
            $controller->delete($id);
            Flash::setSuccess('Usuario eliminado correctamente.');
            View::redirect('users.list');
            break;

        default:
            View::redirect('home');
            break;
    }
} catch (Exception $e) {
    Flash::setError($e->getMessage());
    $redirectRoute = (strpos($route, 'users.update') !== false) ? 'users.edit&id=' . ($_POST['id'] ?? '') : $route;
    
    // Si falla el store, redirigimos a create
    if ($route === 'users.store') $redirectRoute = 'users.create';
    
    header("Location: ?route=" . $redirectRoute);
    exit;
}
