<?php

namespace App\Types;

use App\VO\Password;

class PasswordType extends Type
{
    /**
     * Имя типа данных
     */
    protected const TYPE_NAME = 'password';

    public function getSupportsClass(): string
    {
        return Password::class;
    }
}
