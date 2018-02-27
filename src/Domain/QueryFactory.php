<?php

namespace Sewik\Domain;

class QueryFactory
{
    public function createQuery(Filter $filter, QueryTemplate $template): Query
    {
        $query = $template->getSqlQuery();
        $query = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $query); //delete multiple spaces, newlines, etc.

        if (empty($filter->getAccidentsFilterSql())) {
            $query = str_replace(Filter::PARTICIPANTS_PLACEHOLDER . ' AND ', 'WHERE ', $query);
            $query = str_replace(Filter::PARTICIPANTS_PLACEHOLDER, '', $query);
            $query = str_replace(Filter::VEHICLES_PLACEHOLDER . ' AND ', 'WHERE ', $query);
            $query = str_replace(Filter::VEHICLES_PLACEHOLDER, '', $query);
            $query = str_replace(Filter::ACCIDENTS_PLACEHOLDER . ' AND ', 'WHERE ', $query);
            $query = str_replace(Filter::ACCIDENTS_PLACEHOLDER, '', $query);
        } else {
            $query = str_replace(
                Filter::VEHICLES_PLACEHOLDER,
                'WHERE pojazdy.zszd_id IN (SELECT id FROM zdarzenie ' . Filter::ACCIDENTS_PLACEHOLDER . ')',
                $query
            );
            $query = str_replace(
                Filter::PARTICIPANTS_PLACEHOLDER,
                'WHERE uczestnicy.zszd_id IN (SELECT id FROM zdarzenie ' . Filter::ACCIDENTS_PLACEHOLDER . ')',
                $query
            );
            $query = str_replace(Filter::ACCIDENTS_PLACEHOLDER, 'WHERE ' . $filter->getAccidentsFilterSql(), $query);
        }

        $query = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $query); //delete multiple spaces, newlines, etc.
        $query = str_replace('WHERE AND ', 'WHERE ', $query);
        $query = trim($query);

        return new Query($query);
    }
}