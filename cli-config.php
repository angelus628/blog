<?php declare(strict_types=1);

define('DOCUMENT_ROOT', __DIR__);

require_once __DIR__ . DIRECTORY_SEPARATOR. 'src' . DIRECTORY_SEPARATOR . 'Bootstrap' . DIRECTORY_SEPARATOR . 'bootstrap.php';
#require_once __DIR__ . DIRECTORY_SEPARATOR . 'fixtures.php';

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);