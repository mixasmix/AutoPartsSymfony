<?php

namespace App\VO;

class Password
{
    private const ALGO = PASSWORD_BCRYPT;

    public function __construct(private string $value)
    {
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function hash(string $password): string
    {
        return password_hash($password, self::ALGO);
    }

    public function verify(string $verifiablePassword): bool
    {
        return password_verify($verifiablePassword, $this->getValue());
    }

    public function needRehash(): bool
    {
        return password_needs_rehash(
            hash: $this->value,
            algo: self::ALGO
        );
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
