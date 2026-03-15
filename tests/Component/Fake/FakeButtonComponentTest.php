<?php

namespace BackTo\DesignSystem\Tests\Component\Fake;

use BackTo\DesignSystem\Component\Fake\FakeButtonComponent;
use PHPUnit\Framework\TestCase;

class FakeButtonComponentTest extends TestCase
{
    public function testRendersDivTag(): void
    {
        $fake = new FakeButtonComponent();
        $markup = $fake->getMarkup();
        $this->assertStringContainsString('<div', $markup);
        $this->assertStringContainsString('</div>', $markup);
    }

    public function testHasRoleButton(): void
    {
        $fake = new FakeButtonComponent();
        $markup = $fake->getMarkup();
        $this->assertStringContainsString('role="button"', $markup);
    }

    public function testHasTabindex(): void
    {
        $fake = new FakeButtonComponent();
        $markup = $fake->getMarkup();
        $this->assertStringContainsString('tabindex="0"', $markup);
    }
}
