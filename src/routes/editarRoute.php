<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/editar/[{action}]', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/editar/' route");

        $conection = $container->get('pdo');

        $sql = "SELECT * FROM carro";


        $args['id'] = '';

        $args['ano'] = '';

        $args['marca'] = '';

        $args['modelo'] = '';


        if (isset($_GET['id'])) {


            $sql = 'SELECT  ano, modelo, marca FROM carro';

            $resultSet = $conection->query($sql)->fetchAll();

            $args['id'] = $_GET['id'];

            $args['ano'] = $resultSet[0]['ano'];

            $args['marca'] = $resultSet[0]['marca'];

            $args['modelo'] = $resultSet[0]['modelo'];

           
        }


        // Render index view
        return $container->get('renderer')->render($response, 'editar.phtml', $args);
    });

    $app->post('/editar-veiculo/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/editar/' route");

        $conection = $container->get('pdo');

        $params = $request->getParsedBody();

        $sql = 'UPDATE caroo SET ano = "' . $params['ano'] . '", modelo= "' . $params['modelo'] . '", marca = "' . $params['marca'] . '",tipo= ' . $params['tipo'] . ' WHERE id = ' . $params['carro'];

        $conection->query($sql)->fetchAll();



        // Render index view
        return $response->withRedirect('/editar/');
    });

   
   
};
