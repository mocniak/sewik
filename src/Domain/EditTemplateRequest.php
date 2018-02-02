<?php
namespace Sewik\Domain;

use Ramsey\Uuid\UuidInterface;

class EditTemplateRequest
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $sqlQuery;
    /**
     * @var UuidInterface
     */
    public $templateId;

    public function __construct(UuidInterface $templateId, string $name, string $sqlQuery)
    {
        $this->name = $name;
        $this->sqlQuery = $sqlQuery;
        $this->templateId = $templateId;
    }

    public static function fromTemplate(QueryTemplate $template): self
    {
        return new self($template->getId(), $template->getName(), $template->getSqlQuery());
    }
}