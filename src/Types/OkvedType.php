<?php

namespace App\Types;

use App\VO\Okved;

class OkvedType extends Type
{
    protected const TYPE_NAME = 'okved';

    public function getSupportsClass(): string
    {
        return Okved::class;
    }
}
