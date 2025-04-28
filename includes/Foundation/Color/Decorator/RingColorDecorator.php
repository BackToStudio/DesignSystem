<?php 

namespace BackTo\DesignSystem\Foundation\Color\Decorator;

use BackTo\DesignSystem\Contracts\StyleDecorator;
use BackTo\DesignSystem\Foundation\Color\Decorator\ColorDecorator;
use DiplomaEducation\Foundation\Color\Configurator\RingColorConfigurator;

class RingColorDecorator implements StyleDecorator
{
    private ColorDecorator $colorDecorator;

    public function __construct(RingColorConfigurator $configurator)
    {
        $colors = $configurator->configure();
        if( empty($colors)){
            throw new \Exception('Ring colors are not defined.');
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
            throw new \Exception('Ring color is not set');
        }
        return $this->colorDecorator->getClassName();
    }
}
