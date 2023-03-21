<?php

namespace App\Repository\UserSetting;

use App\Entity\UserSetting\NotificationSetting;
use App\Entity\UserSetting\Setting;

interface SettingRepositoryInterface
{
    public function getById(int $settingId): Setting;

    public function getNotificationSettingByIdAndUserId(
        int $settingId,
        string $userId,
    ): NotificationSetting;

    public function getSettingByIdAndUserId(
        int $settingId,
        string $userId,
    ): Setting;

    /**
     * @param string $userId
     *
     * @return array<Setting>
     */
    public function getSettingsByUserId(string $userId): array;
}
