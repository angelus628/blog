<?php

declare(strict_types=1);


namespace Tests;


use PHPUnit\Framework\TestCase;
use Platform\Models\Article;

/**
 * Class ArticleTest
 * @package Tests
 * @coversDefaultClass \Platform\Models\Article
 */
class ArticleTest extends TestCase
{
    /**
     * @covers ::setTitle
     */
    public function testNewArticle()
    {
        $article = new Article();
        $article->setTitle('Mi nuevo artículo');

        $this->assertEquals('Mi nuevo artículo', $article->getTitle());
    }
}