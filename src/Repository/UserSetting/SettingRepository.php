<?php

namespace App\Repository\UserSetting;

use App\Entity\UserSetting\NotificationSetting;
use App\Entity\UserSetting\Setting;
use App\Repository\AbstractRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;

class SettingRepository extends AbstractRepository implements SettingRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Setting::class);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getNotificationSettingByIdAndUserId(
        int $settingId,
        string $userId,
    ): NotificationSetting {
        $setting = $this->getSettingByIdAndUserId($settingId, $userId);

        if (!$setting instanceof NotificationSetting) {
            throw new EntityNotFoundException(
                sprintf('Настройка оповещения с id %d не найдена', $settingId),
            );
        }

        return $setting;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getById(int $settingId): Setting
    {
        $setting = $this->find($settingId);

        if (is_null($setting)) {
            throw new EntityNotFoundException(
                sprintf('Настройка с id %d не найдена', $settingId),
            );
        }

        return $setting;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getSettingByIdAndUserId(int $settingId, string $userId): Setting
    {
        $setting = $this->getById($settingId);

        if ($setting->getUser()->getId() !== $userId) {
            throw new EntityNotFoundException(
                sprintf(
                    'Настройка оповещения с id %d пользователя %s не найдена',
                    $settingId,
                    $userId,
                ),
            );
        }

        return $setting;
    }

    public function getSettingsByUserId(string $userId): array
    {
        return $this->createQueryBuilder('s')
            ->where('s.user = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    }
}
