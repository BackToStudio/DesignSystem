<?php

namespace BackTo\DesignSystem\Component\Fake;

use BackTo\DesignSystem\Component\TokenComponent;

class FakeButtonComponent extends TokenComponent
{
    protected string $tagName = 'div';

    public function __construct()
    {
        $this->addAttribute('role', 'button');
        $this->addAttribute('tabindex', '0');
    }
}
