<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var Collection<OrderPosition>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: OrderPosition::class)]
    private Collection $baskets;

    /**
     * @param string        $firstName
     * @param string        $LastName
     * @param string | null $middleName
     * @param array         $baskets
     */
    public function __construct(
        string $firstName,
        string $LastName,
        ?string $middleName = null,
        array $baskets = []
    ) {
        $this->firstName = $firstName;
        $this->LastName = $LastName;
        $this->middleName = $middleName;
        $this->baskets = new ArrayCollection(array_unique($baskets, SORT_REGULAR));
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

    /**
     * @return Collection<OrderPosition>
     */
    public function getBaskets(): Collection
    {
        return $this->baskets;
    }
}
