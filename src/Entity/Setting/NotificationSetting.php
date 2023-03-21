<?php

namespace App\Entity\Setting;

use App\Entity\User\User;
use App\Enum\NotificationType;
use App\Repository\UserSetting\SettingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingRepository::class)]
class NotificationSetting extends Setting
{
    public const TYPE = 'notification_setting';

    public const ENTITY_NAME = 'Настройки оповещений';

    #[ORM\Column(type: Types::STRING, nullable: false, enumType: NotificationType::class)]
    private NotificationType $type;

    #[ORM\Column(type: Types::STRING, nullable: false)]
    private string $target;

    public function __construct(
        User $user,
        NotificationType $type,
        string $target,
    ) {
        parent::__construct($user);
        $this->type = $type;
        $this->target = $target;
    }

    public function getNotificationType(): NotificationType
    {
        return $this->type;
    }

    public function getTarget(): string
    {
        return $this->target;
    }

    public function updateTarget(string $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function updateNotificationType(NotificationType $notificationType): self
    {
        $this->type = $notificationType;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return array_merge(
            parent::jsonSerialize(),
            [
                'notification_type' => $this->getNotificationType(),
                'target' => $this->getTarget(),
            ],
        );
    }
}
