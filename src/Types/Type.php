<?php

namespace App\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type as DbalType;
use InvalidArgumentException;

abstract class Type extends DbalType
{
    /**
     * @var string
     */
    protected const TYPE_NAME = 'abstract_type';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL($column);
    }

    abstract public function getSupportsClass(): string;

    /**
     * @param mixed            $value
     * @param AbstractPlatform $platform
     *
     * @return mixed
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        return empty($value) ? null : new ($this->getSupportsClass())($value);
    }

    /**
     * @param mixed            $value
     * @param AbstractPlatform $platform
     *
     * @return string|null
     *
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null == $value) {
            return null;
        }

        if (!$value instanceof ($this->getSupportsClass())) {
            throw new InvalidArgumentException(
                sprintf('Недопустимый тип значения `%s`', $this->getName())
            );
        }

        return $value->getValue();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::TYPE_NAME;
    }
}
