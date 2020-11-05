<?php declare(strict_types=1);

require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Platform\Datafixtures\PlatformFixtures;

$connection = [
    'driver' => 'pdo_pgsql',
    'user' => 'cursophp',
    'password' => 'cursophp',
    'dbname' => 'blog_tests',
    'host' => 'postgres'
];

$model_paths = [
    __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Models',
];

$config = Setup::createAnnotationMetadataConfiguration($model_paths, true, null, null, false);
$config->setAutoGenerateProxyClasses(true);
$entityManager = EntityManager::create($connection, $config);

$load = new Loader();
$load->addFixture(new PlatformFixtures());
$ex = new ORMExecutor($entityManager, new ORMPurger());
$ex->execute($load->getFixtures());