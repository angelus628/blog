<?php declare(strict_types=1);


namespace Platform\Models;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * Class Comment
 * @Entity
 * @package Platform\Models
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private string $id;

    /** @ORM\Column(type="string")  */
    private string $comment;

    /** @ORM\Column(type="string")  */
    private string $status;

    /** @ORM\Column(type="datetime", name="created_at")  */
    private string $createdAt;

    /** @ORM\Column(type="string")  */
    private string $author;

    /** @ORM\Column(type="string")  */
    private string $email;

    /** @ORM\Column(type="string")  */
    private string $url;

    /** @ORM\ManyToOne(targetEntity="Article", inversedBy="comments") **/
    private $article;

    public function setComment(string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    public function getComment(): string
    {
        return $this->comment;
    }
}