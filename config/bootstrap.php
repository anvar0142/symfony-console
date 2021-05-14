<?php
// bootstrap.php
require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("src/App/Entity");
$isDevMode = TRUE;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'sp',
);

$config = Setup::createAnnotationMetadataConfiguration(
    $paths, $isDevMode, null, null, false
);
$config->setQueryCacheImpl(new \Doctrine\Common\Cache\ArrayCache());
global $entityManager;
$entityManager = EntityManager::create($dbParams, $config);


//-- This I had to add to support the Mysql enum type.
$platform = $entityManager->getConnection()->getDatabasePlatform();
$platform->registerDoctrineTypeMapping('enum', 'string');
