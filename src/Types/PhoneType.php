<?php

namespace App\Types;

use App\VO\PhoneNumber;

class PhoneType extends Type
{
    /**
     * Имя типа данных
     */
    protected const TYPE_NAME = 'phone';

    public function getSupportsClass(): string
    {
        return PhoneNumber::class;
    }
}
