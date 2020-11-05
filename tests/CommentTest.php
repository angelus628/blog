<?php declare(strict_types=1);


namespace Tests;


use PHPUnit\Framework\TestCase;
use Platform\Models\Comment;

/**
 * Class CommentTest
 * @package Tests
 * @coversDefaultClass \Platform\Models\Comment
 */
class CommentTest extends TestCase
{
    /**
     * @covers ::getContent
     */
    public function testSetComment()
    {
        $comment = new Comment();
        $comment->setComment('mi súper comentario');
        $this->assertEquals('mi súper comentario', $comment->getComment());
    }
}