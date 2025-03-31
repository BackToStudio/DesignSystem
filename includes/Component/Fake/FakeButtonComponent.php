<?php

namespace BackTo\DesignSystem\Component;

use BackTo\DesignSystem\Component\Fake\FakeButtonDecorator;

class FakeButtonComponent extends TokenComponent
{

    public function getMarkup(): string
    {
        return 'Hello World';
    }
}
