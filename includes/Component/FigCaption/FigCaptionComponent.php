<?php

namespace BackTo\DesignSystem\Component\FigCaption;

use BackTo\DesignSystem\Component\TokenComponent;

class FigCaptionComponent extends TokenComponent
{
    protected string $tagName = 'figcaption';

    public function setCaption(string $caption): self
    {
        $this->clearChildren();
        $this->addChild($caption);
        return $this;
    }
}
