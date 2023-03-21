<?php

namespace App\VO;

use JsonSerializable;

class EmailAddress implements JsonSerializable
{
    private string $value;

    /**
     * @param string $value
     */
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

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
