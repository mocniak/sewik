<?php

declare(strict_types=1);

namespace Sewik\Tests\Behat;

use Behat\Behat\Context\Context;
use Sewik\Infrastructure\MysqlReports\AccidentsPerYearReport;
use Sewik\Infrastructure\Repository\AccidentRepository;
use Sewik\Tests\Kit\AccidentMother;
use Webmozart\Assert\Assert;

final class ReportContext implements Context
{
    private $result;

    public function __construct(
        private readonly AccidentRepository $accidentRepository,
        private readonly AccidentsPerYearReport $report,
    )
    {
        $this->result = null;
    }

    /**
     * @Given there was an accident :accidentId on :accidentDate
     */
    public function thereWasAnAccidentOn(string $accidentId, string $accidentDate)
    {
        $this->accidentRepository->add(
            AccidentMother::createWithIdAndDate((int)$accidentId, new \DateTimeImmutable($accidentDate))
        );
    }

    /**
     * @When I ask for accidents per year report
     */
    public function iAskForAccidentsPerYearReport()
    {
        $this->result = $this->report->generate();
    }

    /**
     * @Then I see :arg1 accidents in :arg2
     */
    public function iSeeAccidentsIn(string $numberOfAccidents, string $year)
    {
        $expectedResult = [
            ['rok', 'zdarzenia'],
            ['2020', '2'],
        ];
        Assert::eq($this->result, $expectedResult);
    }
}
