<?php

namespace App\Types;

use App\VO\Rs;

class RsType extends Type
{
    protected const TYPE_NAME = 'rs';

    public function getSupportsClass(): string
    {
        return Rs::class;
    }
}
