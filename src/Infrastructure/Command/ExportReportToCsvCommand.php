<?php

namespace Sewik\Infrastructure\Command;

use Sewik\Infrastructure\MysqlReports\AccidentsPerYearPerCountyReport;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExportReportToCsvCommand extends Command
{
    protected static $defaultName = 'app:export-to-csv';
    protected static $defaultDescription = 'Export a report to csv file';

    public function __construct(
        private readonly AccidentsPerYearPerCountyReport $report
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $report = $this->report->generate();
        if (count($report) > 0) {
            $headerRow = array_keys(array_values($report)[0]);
        } else {
            $headerRow = [];
        }
        $resultWithKeyAsFirstColumn = [];

        foreach ($report as $year => $row) {
            $resultWithKeyAsFirstColumn[] = array_merge([$year], array_values($row));
        }

        $fp = fopen('persons.csv', 'w');
        fputcsv($fp, array_merge(['rok'], $headerRow));
        foreach ($resultWithKeyAsFirstColumn as $row) {
            fputcsv($fp, $row);
        }

        fclose($fp);
        return Command::SUCCESS;
    }
}
