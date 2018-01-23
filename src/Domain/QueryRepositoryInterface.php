<?php
namespace Sewik\Domain;

interface QueryRepositoryInterface
{
    /**
     * @return Query[]
     */
    public function getAll(): array;
}