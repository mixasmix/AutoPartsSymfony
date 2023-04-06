<?php

namespace App\Entity\User;

use App\Entity\Basket\Basket;
use App\Entity\EntityInterface;
use App\Entity\Position\OrderPosition;
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
class User implements EntityInterface
{
    public const ENTITY_NAME = 'Пользователь';

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

    #[ORM\OneToOne(mappedBy: 'user', targetEntity: Basket::class)]
    private ?Basket $basket;

    /**
     * @param string                 $firstName
     * @param string                 $LastName
     * @param UserStatus             $status
     * @param PhoneNumber|null       $phone
     * @param EmailAddress|null      $email
     * @param Gender|null            $gender
     * @param Basket|null            $basket
     * @param string|null            $middleName
     * @param array                  $positions
     * @param array                  $settings
     * @param DateTimeImmutable|null $lastEntryDate
     * @param DateTimeImmutable|null $createdAt
     * @param bool                   $isDeleted
     */
    public function __construct(
        string $firstName,
        string $LastName,
        UserStatus $status,
        ?PhoneNumber $phone,
        ?EmailAddress $email,
        ?Gender $gender,
        ?Basket $basket = null,
        ?string $middleName = null,
        array $settings = [],
        ?DateTimeImmutable $lastEntryDate = null,
        ?DateTimeImmutable $createdAt = null,
        bool $isDeleted = false,
    ) {
        $this->firstName = $firstName;
        $this->LastName = $LastName;
        $this->middleName = $middleName;
        $this->status = $status;
        $this->isDeleted = $isDeleted;
        $this->lastEntryDate = $lastEntryDate ?? new DateTimeImmutable();
        $this->createdAt = $createdAt ?? new DateTimeImmutable();
        $this->settings = new ArrayCollection(array_unique($settings, SORT_REGULAR));
        $this->phone = $phone;
        $this->email = $email;
        $this->gender = $gender;
        $this->basket = $basket;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Basket|null
     */
    public function getBasket(): ?Basket
    {
        return $this->basket;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return UserStatus
     */
    public function getStatus(): UserStatus
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getLastEntryDate(): DateTimeImmutable
    {
        return $this->lastEntryDate;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return Collection
     */
    public function getSettings(): Collection
    {
        return $this->settings;
    }

    /**
     * @return PhoneNumber|null
     */
    public function getPhone(): ?PhoneNumber
    {
        return $this->phone;
    }

    /**
     * @return EmailAddress|null
     */
    public function getEmail(): ?EmailAddress
    {
        return $this->email;
    }

    /**
     * @return Gender|null
     */
    public function getGender(): ?Gender
    {
        return $this->gender;
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

    public static function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }
}
