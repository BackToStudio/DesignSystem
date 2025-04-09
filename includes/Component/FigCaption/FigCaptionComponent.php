<?php

namespace BackTo\DesignSystem\Component\FigCaption;

use BackTo\DesignSystem\Component\TokenComponent;

class FigCaptionComponent extends TokenComponent
{
    private string $tagName = 'figcaption';
    private string $children = '';

    public function setChildren(string $children): self
    {
        $this->children = $children;
        return $this;
    }

    public function getChildren(): string
    {
        return $this->children;
    }

    public function getMarkup(): string
    {
        $this->addChild($this->getChildren());

        return parent::getMarkup();
    }
}
