<?php

namespace Sewik\Tests\Kit;

use Sewik\Domain\Entity\Accident;

class AccidentMother
{
    public static function createAny(): Accident
    {
        return new Accident(1);
    }

    public static function createWithIdAndDate(int $param, \DateTimeImmutable $param1): Accident
    {
        return new Accident(1);
    }
}
