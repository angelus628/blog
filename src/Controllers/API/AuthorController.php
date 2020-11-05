<?php declare(strict_types=1);


namespace Platform\Controllers\API;

use Carbon\Carbon;
use Laminas\Diactoros\Exception\InvalidArgumentException;
use League\Route\Http\Exception as HttpException;
use Platform\Controllers\BaseController;
use Platform\Models\Author;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AuthorController
 * @package Platform\Controllers\API
 */
class AuthorController extends BaseController
{
    public function authors(ServerRequestInterface $request): array
    {
        $repository = $this->getRepository(Author::class);
        return $repository->findAll() ?? [];
    }

    public function new(ServerRequestInterface $request): Author
    {
        try {
            $jsonObject = json_decode($request->getBody()->getContents());

            if (empty($jsonObject->username) || empty($jsonObject->password) || empty($jsonObject->email) || empty($jsonObject->profile)) {
                throw new InvalidArgumentException('Invalid arguments suplied');
            }

            $repository = $this->getRepository(Author::class);
            $author = $repository->findOneByEmail($jsonObject->email);

            if ($author instanceof Author && $author->getEmail() === $jsonObject->email) {
                throw new InvalidArgumentException('There\'s a user already registered with that email');
            }

            $author = new Author();
            $author->setUserName($jsonObject->username)
                ->setPassword($jsonObject->password)
                ->setEmail($jsonObject->email)
                ->setProfile($jsonObject->profile)
                ->setCreatedAt(Carbon::now());

            $this->getEntityManager()->persist($author);
            $this->getEntityManager()->flush();

            return $repository->findOneById($author->getId());
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage(), $e);
        }
    }

    public function author(ServerRequestInterface $request, array $args): Author
    {
        $repository = $this->getRepository(Author::class);
        $author = $repository->findOneById($args['id']);

        if (empty($author)) {
            throw new HttpException(404, 'User not found');
        }

        return $author;
    }

    public function update(ServerRequestInterface $request, array $args): Author
    {
        $author = $this->author($request, $args);
        $jsonObject = json_decode($request->getBody()->getContents());

        if (!empty($jsonObject->username)) {
           $author->setUserName($jsonObject->username);
        }

        if (!empty($jsonObject->password)) {
            $author->setPassword($jsonObject->password);
        }

        if (!empty($jsonObject->email)) {
            $author->setEmail($jsonObject->email);
        }

        if (!empty($jsonObject->profile)) {
            $author->setProfile($jsonObject->profile);
        }

        $this->getEntityManager()->persist($author);
        $this->getEntityManager()->flush();
        $this->getEntityManager()->refresh($author);

        return $author;
    }
}