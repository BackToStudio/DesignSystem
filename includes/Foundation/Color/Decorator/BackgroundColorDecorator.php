<?php 

namespace BackTo\DesignSystem\Foundation\Color\Decorator;

use BackTo\DesignSystem\Contracts\StyleDecorator;
use BackTo\DesignSystem\Foundation\Color\Decorator\ColorDecorator;
use DiplomaEducation\Foundation\Color\Configurator\BackgroundColorConfigurator;

class BackgroundColorDecorator implements StyleDecorator
{
    private ColorDecorator $colorDecorator;

    public function __construct(BackgroundColorConfigurator $configurator)
    {
        $colors = $configurator->configure();
        if( empty($colors)){
            throw new \Exception('Background colors are not defined.');
        }
        $this->colorDecorator = new ColorDecorator($colors);
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
