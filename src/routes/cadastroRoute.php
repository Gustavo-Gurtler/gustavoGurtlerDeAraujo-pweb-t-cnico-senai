<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/cadastro-carro/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/cadastro-carro/' route");

         
        // Render index view
        return $container->get('renderer')->render($response, 'cadastro.phtml', $args);

        
    });

    
    
    $app->post('/cadastro-carro/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/cadastro-carro/' route");

        $conection=$container->get("pdo");
        $params=$request->getParsedBody(); 
        
        // $sql='INSERT INTO carro (modelo, marca, ano) VALUES("'.$params['modelo'].'", "'.$params['marca'];"','".$params['ano'];
        
        $sql='INSERT INTO carro(modelo, marca, ano) VALUES("'.$params['modelo'].'", "'.$params['marca'].'","'.$params['ano'].'", "'.$params['tipo'].'") ';
        
        $conection->query($sql)->fetchAll();

        
        // Render index view
        return $response->withRedirect('/');

    });

};
