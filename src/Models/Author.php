<?php declare(strict_types=1);


namespace Platform\Models;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\ORMException;
use JsonSerializable;

/**
 * Class Author
 * @Entity
 * @package Platform\Models
 */
class Author implements JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private string $id;

    /** @ORM\Column(type="string")  */
    private string $username;

    /** @ORM\Column(type="string")  */
    private string $password;

    /** @ORM\Column(type="string")  */
    private string $email;

    /** @ORM\Column(type="string")  */
    private string $profile;

    /** @ORM\Column(type="datetime", name="created_at")  */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="author")
     * @var Article[]
     */
    private $articles;

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setUserName(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getUserName(): string
    {
        return $this->username;
    }

    public function setPassword(string $password): self
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setEmail(string $email): self
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return $this;
        }

        throw new ORMException('Invalid email provided');
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setProfile(string $profile): self
    {
        $this->profile = $profile;
        return $this;
    }

    public function getProfile(): string
    {
        return $this->profile;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getArticles()
    {
        return $this->articles;
    }

    public function setArticles($articles): self
    {
        $this->articles = $articles;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'profile' => $this->profile,
            'createdAt' => $this->createdAt,
        ];
    }
}