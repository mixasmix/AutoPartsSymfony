<?php

namespace App\Types;

use App\VO\Inn;

class InnType extends Type
{
    protected const TYPE_NAME = 'inn_type';

    public function getSupportsClass(): string
    {
        return Inn::class;
    }
}
