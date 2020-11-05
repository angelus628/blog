<?php declare(strict_types=1);

require_once DOCUMENT_ROOT . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$connection = [
    'driver' => 'pdo_pgsql',
    'user' => 'cursophp',
    'password' => 'cursophp',
    'dbname' => 'cursophp',
    'host' => 'postgres'
];

$model_paths = [
    DOCUMENT_ROOT . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Models',
];

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($model_paths, true, null, null, false);
$config->setAutoGenerateProxyClasses(true);
$entityManager = \Doctrine\ORM\EntityManager::create($connection, $config);
