<?php declare(strict_types=1);


namespace Platform\Datafixtures;


use Carbon\Carbon;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Platform\Models\Author;

/**
 * Class PlatformFixtures
 * @package Platform\Datafixtures
 */
class PlatformFixtures implements FixtureInterface
{
    public function load(ObjectManager $objectManager): void
    {
        $author = new Author();
        $author->setUserName('Pepito Perez')
            ->setEmail('pepe-perez@digitalvirgoamericas.com')
            ->setCreatedAt(Carbon::now())
            ->setPassword('mi-contraseña')
            ->setProfile('Writer');

        $objectManager->persist($author);
        $objectManager->flush();
    }
}