<?php

namespace App\Types;

use App\VO\EmailAddress;

class EmailType extends Type
{
    /**
     * Имя типа данных
     */
    protected const TYPE_NAME = 'email';

    public function getSupportsClass(): string
    {
        return EmailAddress::class;
    }
}
