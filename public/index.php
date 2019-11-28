<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
$dependencies = require __DIR__ . '/../src/dependencies.php';
$dependencies($app);

// Register middleware
$middleware = require __DIR__ . '/../src/middleware.php';
$middleware($app);

// index route
$routes = require __DIR__ . '/../src/routes/indexRoute.php';
$routes($app);

// cadastro route

$routes = require __DIR__ . '/../src/routes/cadastroRoute.php';
$routes($app);

// Mostra a tabela com os regsitros

$routes = require __DIR__ . '/../src/routes/consultarRoute.php';
$routes($app);

// edita os regsitros

$routes = require __DIR__ . '/../src/routes/editarRoute.php';
$routes($app);







// Run app
$app->run();
