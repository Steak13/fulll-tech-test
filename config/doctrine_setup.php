<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$config = ORMSetup::createAnnotationMetadataConfiguration([__DIR__ . '/../src/Domain']);
$connection = [
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/../database.sqlite',
];
$GLOBALS['APP']['ENTITY_MANAGER'] = EntityManager::create($connection, $config);
