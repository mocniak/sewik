<?php
namespace Sewik\Domain;

interface TemplateRepositoryInterface
{
    /**
     * @return QueryTemplate[]
     */
    public function getAll(): array;

    public function save(QueryTemplate $template): void;
}