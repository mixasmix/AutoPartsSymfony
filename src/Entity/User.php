<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    /**
     * @var string
     */
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $firstName;

    /**
     * @var string
     */
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $LastName;

    /**
     * @var string | null
     */
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $middleName;

    /**
     * @var Collection<OrderPosition>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: OrderPosition::class)]
    private Collection $positions;

    /**
     * @param string        $firstName
     * @param string        $LastName
     * @param string | null $middleName
     * @param array         $positions
     */
    public function __construct(
        string $firstName,
        string $LastName,
        ?string $middleName = null,
        array $positions = []
    ) {
        $this->firstName = $firstName;
        $this->LastName = $LastName;
        $this->middleName = $middleName;
        $this->positions = new ArrayCollection(array_unique($positions, SORT_REGULAR));
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
    public function getPositions(): Collection
    {
        return $this->positions;
    }
}
