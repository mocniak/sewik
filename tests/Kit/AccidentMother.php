<?php

namespace Sewik\Tests\Kit;

use Sewik\Domain\Entity\Accident;

class AccidentMother
{
    public static function createAny(): Accident
    {
        return new Accident(1);
    }

    public static function createWithIdAndDate(int $id, \DateTimeImmutable $dateTime): Accident
    {
        return new Accident(id: $id, date: $dateTime);
    }
}
