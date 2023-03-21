<?php

namespace App\Enum;

enum NotificationType: string
{
    case EMAIL = 'email';
    case PHONE = 'phone';
    case TELEGRAM = 'telegram';

    public const VALID_VALUES = [
        self::EMAIL,
        self::PHONE,
        self::TELEGRAM,
    ];

    public function translated(): string
    {
        return match ($this) {
            self::EMAIL => 'Email',
            self::PHONE => 'Телефон',
            self::TELEGRAM => 'Telegram messenger',
        };
    }

    public static function getValidValues(): array
    {
        return array_map(
            fn (NotificationType $type): string => $type->value,
            self::VALID_VALUES,
        );
    }
}
