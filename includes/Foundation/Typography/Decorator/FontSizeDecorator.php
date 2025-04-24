<?php

namespace BackTo\DesignSystem\Foundation\Typography\Decorator;

use BackTo\DesignSystem\Config\TailwindConfig;
use BackTo\DesignSystem\Contracts\StyleDecorator;

class FontSizeDecorator implements StyleDecorator
{

    private TailwindConfig $config;
    private string $currentFontSize = '';

    public function __construct(array $fontSizes)
    {
        if( empty($fontSizes)){
            throw new \Exception('Font sizes are not defined.');
        }
        $this->config = new TailwindConfig($fontSizes);
    }

    public function setFontSize(string $fontSize)
    {
        $this->currentFontSize = $fontSize;
    }

    public function getFontSize(): string
    {
        return $this->currentFontSize;
    }

    public function getClassName(): string
    {
        if( empty($this->getFontSize())){
            throw new \Exception('No current font size defined.');
        }
        return $this->config->getValue($this->getFontSize());
    }

}