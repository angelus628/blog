<?php declare(strict_types=1);


namespace Platform\Controllers\API;

use Carbon\Carbon;
use Laminas\Diactoros\Exception\InvalidArgumentException;
use League\Route\Http\Exception as HttpException;
use Platform\Controllers\BaseController;
use Platform\Models\Article;
use Platform\Models\Author;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class ArticleController
 * @package Platform\Controllers\API
 */
class ArticleController extends BaseController
{
    public function articles(ServerRequestInterface $request): array
    {
        $repository = $this->getRepository(Article::class);
        return $repository->findAll() ?? [];
    }

    public function new(ServerRequestInterface $request): Article
    {
        try {
            $jsonObject = json_decode($request->getBody()->getContents());

            if (empty($jsonObject->author)) {
                throw new HttpException(401, 'No author given');
            }

            $authorRepository = $this->getRepository(Author::class);
            $author = $authorRepository->findOneByEmail($jsonObject->author);

            if (empty($author)) {
                throw new HttpException(404, 'Author not found');
            }

            if (empty($jsonObject->title) || empty($jsonObject->content)) {
                throw new InvalidArgumentException('Invalid arguments suplied');
            }

            $articleRepository = $this->getRepository(Article::class);
            $article = new Article();
            $article->setTitle($jsonObject->title)
                ->setContent($jsonObject->content)
                ->setCreatedAt(Carbon::now())
                ->setUpdatedAt(Carbon::now())
                ->setStatus(1)
                ->setAuthor($author);

            $this->getEntityManager()->persist($article);
            $this->getEntityManager()->flush();

            return $articleRepository->findOneById($article->getId());
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage(), $e);
        }
    }

    public function article(ServerRequestInterface $request, array $args): Article
    {
        $repository = $this->getRepository(Article::class);
        return $repository->findOneById($args['id']);
    }
}