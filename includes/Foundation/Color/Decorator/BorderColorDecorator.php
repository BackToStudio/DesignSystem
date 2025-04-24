<?php 

namespace BackTo\DesignSystem\Foundation\Color\Decorator;

use BackTo\DesignSystem\Contracts\StyleDecorator;
use BackTo\DesignSystem\Foundation\Decorator\ColorDecorator;

class BorderColorDecorator implements StyleDecorator
{
    private ColorDecorator $colorDecorator;

    public function __construct(array $borderColors)
    {
        if( empty($borderColors)){
            throw new \Exception('Border colors are not defined.');
        }
        $this->colorDecorator = new ColorDecorator($borderColors);
    }

    public function setColor(string $color)
    {
        return $this->colorDecorator->setCurrentColor($color);
    }

    public function getClassName(): string
    {
        if( empty($this->colorDecorator->getCurrentColor())){
            throw new \Exception('Border color is not set');
        }
        return $this->colorDecorator->getClassName();
    }
}
