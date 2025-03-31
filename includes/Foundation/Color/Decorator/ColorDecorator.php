<?php

namespace BackTo\DesignSystem\Foundation\Decorator;

use BackTo\DesignSystem\Config\TailwindConfig;
use BackTo\DesignSystem\Contracts\StyleDecorator;

class ColorDecorator implements StyleDecorator
{

    private TailwindConfig $config;
    private string $currentColor = '';

    public function __construct(array $colors)
    {
        if( empty($colors)){
            throw new \Exception('Colors are not defined.');
        }
        $this->config = new TailwindConfig($colors);
    }

    public function setCurrentColor(string $color)
    {
        $this->currentColor = $color;
    }

    public function getCurrentColor(): string
    {
        return $this->currentColor;
    }

    public function getClassName(): string
    {
        if( empty($this->getCurrentColor())){
            throw new \Exception('No current color defined.');
        }
        return $this->config->getValue($this->getCurrentColor());
    }

}