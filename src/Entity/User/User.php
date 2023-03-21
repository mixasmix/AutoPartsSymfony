<?php

namespace App\Entity\User;

use App\Entity\OrderPosition;
use App\Entity\Setting\Setting;
use App\Enum\Gender;
use App\Enum\UserStatus;
use App\Repository\User\UserRepository;
use App\VO\EmailAddress;
use App\VO\PhoneNumber;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use OpenApi\Attributes\Property;

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

    #[ORM\Column(name: 'status', type: Types::STRING, enumType: UserStatus::class)]
    private UserStatus $status;

    #[ORM\Column(type: Types::BOOLEAN, nullable: false, options: ['default' => false])]
    private bool $isDeleted;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    #[Property(property: 'last_entry_date')]
    private DateTimeImmutable $lastEntryDate;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    #[Property(property: 'created_at')]
    private DateTimeImmutable $createdAt;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Setting::class)]
    private Collection $settings;

    #[ORM\Column(type: 'phone', nullable: true)]
    #[Property]
    private ?PhoneNumber $phone;

    #[ORM\Column(type: 'email', unique: true, nullable: true)]
    #[Property]
    private ?EmailAddress $email;

    #[ORM\Column(type: Types::STRING, nullable: true, enumType: Gender::class)]
    #[Property]
    private ?Gender $gender;

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
