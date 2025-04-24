<?php

namespace BackTo\DesignSystem\Foundation\Decorator;

use BackTo\DesignSystem\Config\TailwindConfig;
use BackTo\DesignSystem\Contracts\StyleDecorator;

class FontFamilyDecorator implements StyleDecorator
{

    private TailwindConfig $config;
    private string $currentFontFamily = '';

    public function __construct(array $fontFamilies)
    {   
        if( empty($fontFamilies)){
            throw new \Exception('Font families settings are not defined.');
        }
        $this->config = new TailwindConfig($fontFamilies);
    }

    public function setFontFamily(string $fontFamily)
    {
        $this->currentFontFamily = $fontFamily;
    }

    public function getFontFamily(): string
    {
        return $this->currentFontFamily;
    }

    public function getClassName(): string
    {
        if( empty($this->getFontFamily())){
            throw new \Exception('No current font family defined.');
        }
        return $this->config->getValue($this->getFontFamily());
    }

}