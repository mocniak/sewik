<?php
namespace Sewik\Domain;

class QueryFactory
{
    public function createQuery(Filter $filter, QueryTemplate $template): Query
    {
        if (!empty($filter->getAccidentsFilter())) {
            $subquery = ' WHERE ' . implode(' AND ', $filter->getAccidentsFilter());
        } else {
            $subquery = '';
        }
        $query = str_replace(Filter::ACCIDENTS_PLACEHOLDER, $subquery, $template->getSqlQuery());
        $query = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $query); //delete multiple spaces, newlines, etc.
        $query = trim($query);
        return new Query($query);
    }
}