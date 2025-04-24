<?php

namespace BackTo\DesignSystem\Foundation\Typography\Decorator;

use BackTo\DesignSystem\Config\TailwindConfig;
use BackTo\DesignSystem\Contracts\StyleDecorator;

class LineHeightDecorator implements StyleDecorator
{

    private TailwindConfig $config;
    private string $currentLineHeight = '';

    public function __construct(array $lineHeights)
    {
        if( empty($lineHeights)){
            throw new \Exception('Line heights settings are not defined.');
        }
        $this->config = new TailwindConfig($lineHeights);
    }

    public function setLineHeight(string $lineHeight)
    {
        $this->currentLineHeight = $lineHeight;
    }

    public function getLineHeight(): string
    {
        return $this->currentLineHeight;
    }

    public function getClassName(): string
    {
        if( empty($this->getLineHeight())){
            throw new \Exception('No current line height defined.');
        }
        return $this->config->getValue($this->getLineHeight());
    }

}