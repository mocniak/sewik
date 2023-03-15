<?php

declare(strict_types=1);

namespace Sewik\Tests\Behat;

use Behat\Behat\Context\Context;
use Sewik\Domain\Dto\QueryResult;
use Sewik\Domain\Entity\Accident;
use Sewik\Infrastructure\MysqlReports\AccidentsOnPedestrianCrossingsPerYearPerCountyReport;
use Sewik\Infrastructure\MysqlReports\AccidentsPerYearPerCountyReport;
use Sewik\Infrastructure\MysqlReports\AccidentsPerYearReport;
use Sewik\Infrastructure\Repository\AccidentRepository;
use Sewik\Tests\Kit\AccidentMother;
use Webmozart\Assert\Assert;

final class ReportContext implements Context
{
    private ?QueryResult $result;
    private array $arrayResult;

    public function __construct(
        private readonly AccidentRepository $accidentRepository,
        private readonly AccidentsPerYearReport $perYearReport,
        private readonly AccidentsPerYearPerCountyReport $perYearPerCountyReport,
        private readonly AccidentsOnPedestrianCrossingsPerYearPerCountyReport $pedestrianCrossingsPerYearPerCountyReport,
    )
    {
        $this->result = null;
        $this->arrayResult = [];
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
        $this->result = $this->perYearReport->generate();
    }

    /**
     * @Then I see :arg1 accidents in :arg2
     */
    public function iSeeAccidentsIn(string $numberOfAccidents, string $year)
    {
        $expectedHeaders = ['rok', 'zdarzenia'];
        $expectedRows = [[2020, 2]];

        Assert::eq($this->result->getTableHeaders(), $expectedHeaders);
        Assert::eq(array_values($this->result->getTable()), $expectedRows);
    }

    /**
     * @Given there was an accident :arg3 on :arg1 in :arg2
     */
    public function thereWasAnAccidentOnDateInCounty($id, $date, $county)
    {
        $this->accidentRepository->add(
            new Accident(id: (int)$id, county: $county, date: new \DateTimeImmutable($date))
        );
    }

    /**
     * @Given there was an accident :arg3 on :arg1 in :arg2 voivodeship :voivodeship
     */
    public function thereWasAnAccidentOnInVoivodeship($id, $date, $county, $voivodeship)
    {
        $this->accidentRepository->add(
            new Accident(id: (int)$id, voivodeship: $voivodeship, county: $county, date: new \DateTimeImmutable($date))
        );
    }

    /**
     * @When I ask for accidents per year per county report
     */
    public function iAskForAccidentsPerYearPerCountyReport()
    {
        $this->arrayResult = $this->perYearPerCountyReport->generate();
    }

    /**
     * @When I ask for accidents on pedestrian crossings per year per county report
     */
    public function iAskForAccidentsOnPedestrianCrossingsPerYearPerCountyReport()
    {
        $this->arrayResult = $this->pedestrianCrossingsPerYearPerCountyReport->generate();
    }

    /**
     * @Then I see :arg2 accidents in :arg3 in :arg1
     */
    public function iSeeAccidentsInYearInCounty($expectedNumberOfAccidents, $year, $county)
    {
        var_dump($this->arrayResult);
        Assert::eq($this->arrayResult[(int)$year][$county], $expectedNumberOfAccidents);
    }

}
