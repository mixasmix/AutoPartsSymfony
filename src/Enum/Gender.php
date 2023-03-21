<?php

namespace App\Enum;

use Exception;

enum Gender: string
{
    case MALE = 'male';
    case FEMALE = 'female';

    public const VALID_VALUES = [
        self::MALE,
        self::FEMALE,
    ];

    public function translate(): string
    {
        return match ($this) {
            self::MALE => 'мужской',
            self::FEMALE => 'женский',
        };
    }

    public function getShort(): string
    {
        return match ($this) {
            self::MALE => 'M',
            self::FEMALE => 'F',
        };
    }

    /**
     * @throws Exception
     */
    public static function getByShort(string $shortMane): Gender
    {
        return match ($shortMane) {
            'M', 'М', 'm', 'м' => self::MALE,
            'F', 'Ж', 'f', 'ж' => self::FEMALE,
            default => throw new Exception('Неизвестное значение пола'),
        };
    }

    public static function getValidValues(): array
    {
        return array_map(
            fn (Gender $gender): string => $gender->value,
            self::VALID_VALUES,
        );
    }
}
