<?php
namespace Sewik\Domain;

class FilterFactory
{
    public function createFromRequest(ShowAllReportsRequest $request): Filter
    {
        $filters = [];
        if (null !== $request->getLocality()) {
            $filters[] = Filter::COLUMN_LOCALITY . ' = \'' . $request->getLocality().'\'';
        }
        if (null !== $request->getStreet()) {
            $filters[] = Filter::COLUMN_STREET . ' = \'' . $request->getStreet().'\'';
        }
        if (null !== $request->getFromDate()) {
            $filters[] = Filter::COLUMN_DATE . ' = \'' . $request->getFromDate()->format('Y-m-d').'\'';
        }
        if (null !== $request->getToDate()) {
            $filters[] = Filter::COLUMN_DATE . ' = \'' . $request->getToDate()->format('Y-m-d').'\'';
        }
        return new Filter($filters);
    }
}