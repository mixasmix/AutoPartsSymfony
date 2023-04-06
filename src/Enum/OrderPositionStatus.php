<?php

namespace App\Enum;

enum OrderPositionStatus: string
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
     * Новый
     */
    case NEW = 'new';

    /**
     * @return array
     */
    protected function getValidValues(): array
    {
        return [
            OrderPositionStatus::DECLINED,
            OrderPositionStatus::WAIT_PAYMENT,
            OrderPositionStatus::DECLINED_MANAGER,
            OrderPositionStatus::DECLINED_USER,
            OrderPositionStatus::ADD_BASKET,
            OrderPositionStatus::HANDED_COURIER,
            OrderPositionStatus::EXCEPTION,
            OrderPositionStatus::PROCESSING,
            OrderPositionStatus::TRANSIT,
            OrderPositionStatus::NEW,
        ];
    }

    /**
     * @return string
     */
    public function translated(): string
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
            self::NEW => 'Новый',
        };
    }
}
