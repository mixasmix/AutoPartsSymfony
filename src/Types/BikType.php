<?php

namespace App\Types;

use App\VO\Bik;

class BikType extends Type
{
    protected const TYPE_NAME = 'bik';

    public function getSupportsClass(): string
    {
        return Bik::class;
    }
}
