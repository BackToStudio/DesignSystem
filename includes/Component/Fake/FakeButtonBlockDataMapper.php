<?php

namespace BackTo\DesignSystem\Component;

use BackTo\DesignSystem\Component\Fake\FakeButtonDecorator;

class FakeButtonBlockDataMapper extends TokenComponent
{
    private FakeButtonDecorator $fakeButtonDecorator;

    public function __construct(FakeButtonDecorator $fakeButtonDecorator)
    {
        $this->fakeButtonDecorator = $fakeButtonDecorator;
    }

    public function render(){
        $component = new FakeButtonComponent();
        /* IF : Que si le style est a définir : */
        $this->fakeButtonDecorator->setColor('red');
        $component->addDecorator($this->fakeButtonDecorator);
        /* ENDIF : Que si le style est a définir : */

        return $component->getMarkup();
    }
}
