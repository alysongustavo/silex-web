<?php

require_once "../bootstrap.php";

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Silex\Provider\TwigServiceProvider;
use App\Service\UserService;
use App\Service\RoleService;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Role;
use Silex\Provider\SessionServiceProvider;

$app = new Application();
$app['debug'] = true;

$app['user_service'] = $app->factory(function () use ($entityManager) {
    return new UserService($entityManager);
});

$app['role_service'] = $app->factory(function () use ($entityManager) {
    return new RoleService($entityManager);
});

$userController = $app['controllers_factory'];
$roleController = $app['controllers_factory'];

$roleController->get('/list', function () use ($app) {

    $roleService = $app['role_service'];
    $roles = $roleService->findAll();

    return $app['twig']->render('roles/list.twig', [
        'roles' => $roles
    ]);
});

$userController->get('/list', function () use ($app) {

    $userService = $app['user_service'];
    $users = $userService->findAll();

    return $app['twig']->render('users/list.twig', [
       'users' => $users
    ]);
})->bind('user-list');

$userController->get('/insert', function (Request $request) use ($app){
    $roleService = $app['role_service'];
    $roles = $roleService->findAll();

    return $app['twig']->render('users/insert.twig', [
        'roles' => $roles
    ]);
})->bind('user-form');

$userController->post('/insert', function (Request $request) use ($app){
    $userService = $app['user_service'];
    $roleService = $app['role_service'];

    $data = $request->request->all();

    $role = $roleService->find($data['roles']);

    $user = new User($data);
    $user->addRole($role);

    $userService->save($user);

    if($user->getId()){
        return $app->redirect($app["url_generator"]->generate("user-list"));
    }else {
        $app->abort(500, 'Erro de processamento');
    }

})->bind('user-add');

$app->get("/hello/{name}", function ($name){
   return new Response("Hello " . $name);
});

// Controllers
$app->mount('/users', $userController);
$app->mount('/roles', $roleController);

// Providers
$app->register(new TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/../views'
]);

$app->register(new SessionServiceProvider());

$app->run();