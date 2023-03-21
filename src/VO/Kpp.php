<?php

namespace App\VO;

use JsonSerializable;

class Kpp implements JsonSerializable
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return $this->getValue();
    }
}
