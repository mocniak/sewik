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
    /**
     * @var string
     */
    public $category;

    public function __construct(UuidInterface $templateId, string $name, string $category, string $sqlQuery)
    {
        $this->name = $name;
        $this->sqlQuery = $sqlQuery;
        $this->category = $category;
        $this->templateId = $templateId;
    }

    public static function fromTemplate(QueryTemplate $template): self
    {
        return new self($template->getId(), $template->getName(), $template->getCategory(), $template->getSqlQuery());
    }
}