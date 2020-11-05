<?php declare(strict_types=1);


namespace Platform\Models;


use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use JsonSerializable;

/**
 * Class Article
 * @Entity
 * @package Platform\Models
 */
class Article implements JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /** @ORM\Column(type="string") */
    private string $title;

    /** @ORM\Column(type="string") */
    private string $content;

    /** @ORM\Column(type="integer") */
    private int $status;

    /** @ORM\Column(type="datetime", name="created_at") */
    private DateTimeInterface $createdAt;

    /** @ORM\Column(type="datetime", name="updated_at") */
    private DateTimeInterface $updatedAt;

    /** @ORM\ManyToOne(targetEntity="Author", inversedBy="articles") */
    private Author $author;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="article")
     * @var Comment[]
     */
    private $comments;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setAuthor(Author $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments): self
    {
        $this->comments = $comments;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'author' => $this->author,
            'comments' => $this->comments
        ];
    }
}