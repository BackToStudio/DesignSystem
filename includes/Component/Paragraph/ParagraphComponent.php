<?php

namespace BackTo\DesignSystem\Component\Paragraph;

use BackTo\DesignSystem\Component\TokenComponent;

class ParagraphComponent extends TokenComponent
{

    public function __construct()
    {
        $this->setTagName('p');
    }

}