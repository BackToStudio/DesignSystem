<?php

namespace BackTo\DesignSystem\Component\Svg;

use BackTo\DesignSystem\Component\TokenComponent;

abstract class SvgComponent extends TokenComponent
{
    public function __construct()
    {
        $this->setTagName('svg');
    }
}