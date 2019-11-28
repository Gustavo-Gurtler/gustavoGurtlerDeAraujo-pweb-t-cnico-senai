<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/consultar/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/consultar/' route");

        $conection=$container->get('pdo');

         $sql = 'SELECT  * FROM carro';
        // $sql = 'SELECT veiculo_patio.id, placa, modelo_veiculo, marca_veiculo, tipo_veiculo.tipo FROM veiculo_patio INNER JOIN tipo_veiculo WHERE veiculo_patio.tipo = tipo_veiculo.id';

        $args['carro']=$conection->query($sql)->fetchAll();

        // Render index view
        return $container->get('renderer')->render($response, 'consultar.phtml', $args);


    });

};

