<?php

namespace App\Types;

use App\VO\Ogrn;

class OgrnType extends Type
{
    protected const TYPE_NAME = 'ogrn';

    public function getSupportsClass(): string
    {
        return Ogrn::class;
    }
}
