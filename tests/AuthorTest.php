<?php declare(strict_types=1);


namespace Tests;


use PHPUnit\Framework\TestCase;
use Platform\Models\Article;
use Platform\Models\Author;

/**
 * Class AuthorTest
 * @package Tests
 * @coversDefaultClass \Platform\Models\Author
 */
class AuthorTest extends TestCase
{
    /**
     * @covers ::setUserName
     */
    public function testCreateAuthor()
    {
        $author = new Author();
        $author->setUserName('María');
        $this->assertEquals('María', $author->getUserName());
    }
}