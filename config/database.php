<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../', '.config');
$dotenv->load();

$paths = array("src/App/Entity/");
$proxyDir =  __DIR__ .  "../data";
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => $_ENV['USER'],
    'password' => $_ENV['PASSWORD'],
    'dbname'   => $_ENV['DATABASE'],
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $proxyDir, null, false);
$entityManager = EntityManager::create($dbParams, $config);