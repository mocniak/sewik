<?php
namespace Sewik\Domain;

class ShowAllReportResponse
{
    private $reports;

    /**
     * @param Report[] $reports
     */
    public function __construct(array $reports)
    {
        $this->reports = $reports;
    }

    /**
     * @return Report[]
     */
    public function getReports()
    {
        return $this->reports;
    }
}