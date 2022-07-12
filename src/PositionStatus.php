<?php

namespace App\Enum;

enum PositionStatus: string
{
    /**
     * Отказ поставщика
     */
    case DECLINED = 'declined';

    /**
     * Отказ менеджера
     */
    case DECLINED_MANAGER = 'declined_manager';

    /**
     * Отказ пользователя
     */
    case DECLINED_USER = 'declined_user';

    /**
     * Добавлен в корзину
     */
    case ADD_BASKET = 'add_basket';

    /**
     * В обработке
     */
    case PROCESSING = 'processing';

    /**
     * Ожидает оплаты
     */
    case WAIT_PAYMENT = 'wait_payment';

    /**
     * Исключительная ситуация
     */
    case EXCEPTION = 'exception';

    /**
     * Передан курьеру
     */
    case HANDED_COURIER = 'handed_courier';

    /**
     * Транзит
     */
    case TRANSIT = 'transit';

    /**
     * @return array
     */
    protected function getValidValues(): array
    {
        return [
            PositionStatus::DECLINED,
            PositionStatus::WAIT_PAYMENT,
            PositionStatus::DECLINED_MANAGER,
            PositionStatus::DECLINED_USER,
            PositionStatus::ADD_BASKET,
            PositionStatus::HANDED_COURIER,
            PositionStatus::EXCEPTION,
            PositionStatus::PROCESSING,
            PositionStatus::TRANSIT,
        ];
    }

    /**
     * @return string
     */
    public function returnTranslated(): string
    {
        return match ($this) {
            self::ADD_BASKET => 'Добавлен в корзину',
            self::DECLINED => 'Отказ поставщика',
            self::DECLINED_USER => 'Отказ пользователя',
            self::DECLINED_MANAGER => 'Отказ менеджера',
            self::PROCESSING => 'В обработке',
            self::WAIT_PAYMENT => 'Ожидает оплаты',
            self::EXCEPTION => 'Исключительная ситуация',
            self::HANDED_COURIER => 'Передан курьеру',
            self::TRANSIT => 'Транзит',
        };
    }
}
