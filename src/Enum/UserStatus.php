<?php

namespace App\Enum;

enum UserStatus: string
{
    case ACTIVE = 'active';

    case INACTIVE = 'inactive';

    case BLOCKED = 'blocked';

    public const VALID_VALUES = [
        self::ACTIVE,
        self::INACTIVE,
        self::BLOCKED,
    ];

    public const STATUS_MAP = [
        'active' => self::ACTIVE,
        'inactive' => self::INACTIVE,
        'blocked' => self::BLOCKED,
    ];

    public static function getValidValues(): array
    {
        return array_map(
            fn (UserStatus $status): string => $status->value,
            self::cases(),
        );
    }

    public function translated(): string
    {
        return match ($this) {
            self::ACTIVE => 'Активен',
            self::INACTIVE => 'Не активен',
            self::BLOCKED => 'Заблокирован',
        };
    }

    public function isInactive(): bool
    {
        return $this === self::INACTIVE;
    }

    public function isActive(): bool
    {
        return $this === self::ACTIVE;
    }

    public function isBlocked(): bool
    {
        return $this === self::BLOCKED;
    }
}
