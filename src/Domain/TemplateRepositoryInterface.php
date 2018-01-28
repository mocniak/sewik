<?php
namespace Sewik\Domain;

interface TemplateRepositoryInterface
{
    /**
     * @return QueryTemplate[]
     */
    public function getAll(): array;
}