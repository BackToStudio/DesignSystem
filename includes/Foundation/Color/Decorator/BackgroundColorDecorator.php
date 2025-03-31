<?php 

namespace BackTo\DesignSystem\Decorator;

use BackTo\DesignSystem\Contracts\StyleDecorator;
use BackTo\DesignSystem\Config\BackgroundColorConfig;
use BackTo\DesignSystem\Config\TailwindConfig;
use BackTo\DesignSystem\Foundation\Decorator\ColorDecorator;

class BackgroundColorDecorator implements StyleDecorator
{
    private ColorDecorator $colorDecorator;

    public function __construct(array $backgroundColors)
    {
        if( empty($backgroundColors)){
            throw new \Exception('Background colors are not defined.');
        }
        $this->colorDecorator = new ColorDecorator($backgroundColors);
    }

    public function setColor(string $color)
    {
        return $this->colorDecorator->setCurrentColor($color);
    }

    public function getClassName(): string
    {
        if( empty($this->colorDecorator->getCurrentColor())){
            throw new \Exception('Background color is not set');
        }
        return $this->colorDecorator->getClassName();
    }
}
