<?php

namespace Sewik\Infrastructure\FieldType;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class QueryResultType extends Type
{
    const NAME = 'queryResultType';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'text';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return unserialize($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return serialize($value);
    }

    public function getName()
    {
        return self::NAME;
    }
}