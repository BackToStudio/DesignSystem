<?php 

namespace BackTo\DesignSystem\Foundation\Color\Decorator;

use BackTo\DesignSystem\Contracts\StyleDecorator;
use BackTo\DesignSystem\Foundation\Color\Decorator\ColorDecorator;
use DiplomaEducation\Foundation\Color\Configurator\TextColorConfigurator;

class TextColorDecorator implements StyleDecorator
{
    private ColorDecorator $colorDecorator;

    public function __construct(TextColorConfigurator $configurator)
    {
        $colors = $configurator->configure();
        if( empty($colors)){
            throw new \Exception('Text colors are not defined.');
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
            throw new \Exception('Text color is not set');
        }
        return $this->colorDecorator->getClassName();
    }
}
