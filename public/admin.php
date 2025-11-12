<?php

declare(strict_types=1);

use App\Presentation\Controller\Admin\Auth\LoginController;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

// Bootstrap da aplicação (autoload, .env, sessão, config...)
$config = require __DIR__ . '/../bootstrap/app.php';

// Dispatcher de rotas (FastRoute)
$dispatcher = simpleDispatcher(function (RouteCollector $r): void {
    // Login administrativo
    $r->addRoute('GET',  '/admin/login', [LoginController::class, 'showLoginForm']);
    $r->addRoute('POST', '/admin/login', [LoginController::class, 'handleLogin']);
});

$r->addRoute('GET', '/admin', function () {
    echo '<div style="font-family:system-ui;padding:2rem">
            <h2>Bem-vindo ao NimbusDocs Admin</h2>
            <p>Login efetuado com sucesso.</p>
          </div>';
});

// Descobre método e URI
$httpMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$uri        = $_SERVER['REQUEST_URI']    ?? '/';

// Remove query string
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

// Faz o dispatch
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo '404 - Página não encontrada';
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo '405 - Método não permitido';
        break;

    case FastRoute\Dispatcher::FOUND:
        [$class, $method] = $routeInfo[1];
        $vars             = $routeInfo[2];

        $controller = new $class($config);
        $response   = $controller->$method($vars);

        // Se o controller retornar algo, exibimos
        if (is_string($response)) {
            echo $response;
        }
        break;
}
