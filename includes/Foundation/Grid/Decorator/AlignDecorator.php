<?php 

namespace BackTo\DesignSystem\Foundation\Grid\Decorator;

use BackTo\DesignSystem\Foundation\TailwindConfig;
use BackTo\DesignSystem\Contracts\StyleDecorator;

class AlignDecorator implements StyleDecorator
{
    private TailwindConfig $config;
    private string $align;

    public function __construct(array $aligns)
    {
        if( empty($aligns)){
            throw new \Exception('Aligns are not defined.');
        }
        $this->config = new TailwindConfig($aligns);
    }

    public function setAlign(string $align)
    {
        $this->align = $align;
    }

    public function getClassName(): string
    {
        if( empty($this->align)){
            throw new \Exception('Align is not set');
        }
        return $this->config->getValue($this->align);
    }
}
