<?php
namespace Sewik\Domain;

use Ramsey\Uuid\UuidInterface;

interface TemplateRepositoryInterface
{
    /**
     * @return QueryTemplate[]
     */
    public function getAll(): array;

    public function save(QueryTemplate $template): void;

    public function get(UuidInterface $templateId): QueryTemplate;
}