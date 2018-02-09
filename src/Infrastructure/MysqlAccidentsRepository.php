<?php
namespace Sewik\Infrastructure;

use Sewik\Domain\Accident;
use Sewik\Domain\AccidentsRepositoryInterface;
use Sewik\Domain\Filter;

class MysqlAccidentsRepository implements AccidentsRepositoryInterface
{
    private $link;

    public function __construct(string $host, string $user, string $password, string $database)
    {
        $this->link = new \mysqli($host, $user, $password, $database);
        $this->link->set_charset('utf8');
        if ($this->link->connect_errno) {
            throw new \RuntimeException("Connect failed: %s\n", $this->link->connect_error);
        }
    }

    /**
     * @param Filter $filter
     * @return Accident[]
     */
    public function findFilteredAccidents(Filter $filter): array
    {
        $filter->getAccidentsFilter();
    }
}