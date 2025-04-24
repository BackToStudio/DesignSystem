<?php

namespace BackTo\DesignSystem\Foundation\Typography\Decorator;

use BackTo\DesignSystem\Config\TailwindConfig;
use BackTo\DesignSystem\Contracts\StyleDecorator;

class LetterSpacingDecorator implements StyleDecorator
{

    private TailwindConfig $config;
    private string $currentLetterSpacing = '';

    public function __construct(array $letterSpacings)
    {
        if( empty($letterSpacings)){
            throw new \Exception('Letter spacings settings are not defined.');
        }
        $this->config = new TailwindConfig($letterSpacings);
    }

    public function setLetterSpacing(string $letterSpacing)
    {
        $this->currentLetterSpacing = $letterSpacing;
    }

    public function getLetterSpacing(): string
    {
        return $this->currentLetterSpacing;
    }

    public function getClassName(): string
    {
        if( empty($this->getLetterSpacing())){
            throw new \Exception('No current letter spacing defined.');
        }
        return $this->config->getValue($this->getLetterSpacing());
    }

}