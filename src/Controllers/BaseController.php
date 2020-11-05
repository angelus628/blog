<?php declare(strict_types=1);


namespace Platform\Controllers;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;

/**
 * Class BaseController
 * @package Platform\Controllers\API
 */
class BaseController
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $className
     * @return EntityRepository|ObjectRepository
     */
    public function getRepository(string $className)
    {
        return $this->entityManager->getRepository($className);
    }

    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }
}