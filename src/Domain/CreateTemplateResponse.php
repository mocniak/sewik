<?php

namespace Sewik\Domain;

use Ramsey\Uuid\UuidInterface;

class CreateTemplateResponse
{
    private $templateId;

    public function __construct(UuidInterface $templateId)
    {
        $this->templateId = $templateId;
    }

    public function getTemplateId(): UuidInterface
    {
        return $this->templateId;
    }
}