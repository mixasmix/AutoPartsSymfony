<?php

namespace App\Enum;

enum ApiErrorCode: string implements Enum
{
    /**
     * Сущность не уникальна
     */
    case ENTITY_NOT_UNIQUE = 'entity-not-unique';

    /**
     * Неверно указано/не указано поле/несколько полей
     */
    case VALIDATION_ERROR = 'validation-error';

    /**
     * Не передан токен
     */
    case AUTHENTICATION_TOKEN_ABSENCE = 'authentication-token-absence';

    /**
     * Неверный токен
     */
    case WRONG_TOKEN = 'wrong-token';

    /**
     * Сущность не найдена
     */
    case ENTITY_NOT_FOUND = 'entity-not-found';

    /**
     * Доступ запрещен
     */
    case ACCESS_DENIED = 'access-denied';

    /**
     * Некорректный запрос
     */
    case BAD_REQUEST = 'bad-request';

    /**
     * Техническая ошибка на сервере
     */
    case TECHNICAL_ERROR = 'technical-error';

    /**
     * Некорректный код верификации
     */
    case WRONG_VERIFICATION_CODE = 'wrong-verification-code';

    /**
     * Допустимые значения кода ошибки
     */
    public const VALID_VALUES = [
        self::ENTITY_NOT_UNIQUE,
        self::VALIDATION_ERROR,
        self::AUTHENTICATION_TOKEN_ABSENCE,
        self::WRONG_TOKEN,
        self::ENTITY_NOT_FOUND,
        self::BAD_REQUEST,
        self::ACCESS_DENIED,
        self::TECHNICAL_ERROR,
        self::WRONG_VERIFICATION_CODE,
    ];

    public static function getValidValues(): array
    {
        return self::VALID_VALUES;
    }

    public function translated(): string
    {
        return match ($this) {
            self::ENTITY_NOT_UNIQUE => 'Сущность не уникальна',
            self::VALIDATION_ERROR => 'Неверно указано/не указано поле/несколько полей',
            self::AUTHENTICATION_TOKEN_ABSENCE => 'Не передан токен',
            self::WRONG_TOKEN => 'Неверный токен',
            self::ENTITY_NOT_FOUND => 'Сущность не найдена',
            self::BAD_REQUEST => 'Некорректный запрос',
            self::ACCESS_DENIED => 'Доступ запрещен',
            self::TECHNICAL_ERROR => 'Техническая ошибка на сервере',
            self::WRONG_VERIFICATION_CODE => 'Некорректный код верификации',
        };
    }
}
