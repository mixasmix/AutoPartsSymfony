<?php

namespace App\Types;

use App\VO\Ks;

class KsType extends Type
{
    protected const TYPE_NAME = 'ks';

    public function getSupportsClass(): string
    {
        return Ks::class;
    }
}
