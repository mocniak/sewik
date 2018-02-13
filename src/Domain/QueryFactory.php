<?php

namespace Sewik\Domain;

class QueryFactory
{
    public function createQuery(Filter $filter, QueryTemplate $template): Query
    {
        if (empty($filter->getAccidentsFilterSql())) {
            $query = str_replace(Filter::ACCIDENTS_PLACEHOLDER . ' AND ', 'WHERE ', $template->getSqlQuery());
            $query = str_replace(Filter::ACCIDENTS_PLACEHOLDER, '', $query);
        } else {
            $query = str_replace(Filter::ACCIDENTS_PLACEHOLDER, 'WHERE ' . $filter->getAccidentsFilterSql(), $template->getSqlQuery());
        }
        $query = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $query); //delete multiple spaces, newlines, etc.
        $query = str_replace('WHERE AND ', 'WHERE ', $query);
        $query = trim($query);

        return new Query($query);
    }
}