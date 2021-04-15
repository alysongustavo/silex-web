<?php

require_once "../bootstrap.php";

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Silex\Provider\TwigServiceProvider;
use App\Service\UserService;

$app = new Application();
$app['debug'] = true;

$app['user_service'] = $app->factory(function () use ($entityManager) {
    return new UserService($entityManager);
});

$userController = $app['controllers_factory'];

$userController->get('/list', function () use ($app) {

    $userService = $app['user_service'];
    $users = $userService->findAll();

    return $app['twig']->render('users/list.twig', [
       'users' => $users
    ]);
});

$app->get("/hello/{name}", function ($name){
   return new Response("Hello " . $name);
});

// Controllers
$app->mount('/users', $userController);

// Providers
$app->register(new TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/../views'
]);

$app->run();