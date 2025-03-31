<?php 

namespace BackTo\DesignSystem\Decorator;

use BackTo\DesignSystem\Contracts\StyleDecorator;
use BackTo\DesignSystem\Foundation\Decorator\ColorDecorator;

class TextColorDecorator implements StyleDecorator
{
    private ColorDecorator $colorDecorator;

    public function __construct(array $textColors)
    {
        if( empty($textColors)){
            throw new \Exception('Text colors are not defined.');
        }
        $this->colorDecorator = new ColorDecorator($textColors);
    }

    public function setColor(string $color)
    {
        return $this->colorDecorator->setCurrentColor($color);
    }

    public function getClassName(): string
    {
        if( empty($this->colorDecorator->getCurrentColor())){
            throw new \Exception('Text color is not set');
        }
        return $this->colorDecorator->getClassName();
    }
}
