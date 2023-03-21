<?php

namespace App\Entity\Setting;

use App\Entity\EntityInterface;
use App\Entity\User\User;
use App\Repository\UserSetting\SettingRepository;
use Doctrine\DBAL\Types\Types;
use JsonSerializable;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingRepository::class)]
#[ORM\Table(name: 'setting')]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'discr', type: Types::STRING)]
#[ORM\DiscriminatorMap([
    Setting::TYPE => Setting::class,
    NotificationSetting::TYPE => NotificationSetting::class
])]
#[Schema]
abstract class Setting implements EntityInterface, JsonSerializable
{
    public const ENTITY_NAME = 'Настройки';

    public const TYPE = 'setting';

    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    #[Property]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'settings')]
    private ?User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public static function getEntityName(): string
    {
        return static::ENTITY_NAME;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getType(): string
    {
        return static::TYPE;
    }

    public function updateUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'user' => $this->getUser(),
            'type' => $this->getType(),
        ];
    }
}
