<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    /**
     * @var int
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private string $firstName;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private string $LastName;

    /**
     * @var string | null
     */
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $middleName;

    /**
     * @param string        $firstName
     * @param string        $LastName
     * @param string | null $middleName
     */
    public function __construct(string $firstName, string $LastName, ?string $middleName = null)
    {
        $this->firstName = $firstName;
        $this->LastName = $LastName;
        $this->middleName = $middleName;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->LastName;
    }

    /**
     * @return string | null
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }
}
