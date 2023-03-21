<?php

namespace App\Types;

use App\VO\Kpp;

class KppType extends Type
{
    protected const TYPE_NAME = 'kpp';

    public function getSupportsClass(): string
    {
        return Kpp::class;
    }
}
