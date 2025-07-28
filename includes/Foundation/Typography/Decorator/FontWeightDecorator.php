<?php

namespace BackTo\DesignSystem\Foundation\Typography\Decorator;

use BackTo\DesignSystem\Foundation\TailwindConfig;
use BackTo\DesignSystem\Contracts\StyleDecorator;

class FontWeightDecorator implements StyleDecorator
{
    private TailwindConfig $config;
    private string $currentFontWeight = '';

    public function __construct(array $fontWeights)
    {
        if( empty($fontWeights)){
            throw new \Exception('Font weights are not defined.');
        }
        $this->config = new TailwindConfig($fontWeights);
    }

    public function setFontWeight(string $fontWeight)
    {
        $this->currentFontWeight = $fontWeight;
    }

    public function getFontWeight(): string
    {
        return $this->currentFontWeight;
    }

    public function getClassName(): string
    {
        if( empty($this->getFontWeight())){
            throw new \Exception('No current font weight defined.');
        }
        return $this->config->getValue($this->getFontWeight());
    }

}