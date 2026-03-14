<?php

namespace BackTo\DesignSystem\Tests\Component\Button;

use BackTo\DesignSystem\Component\Button\ButtonComponent;
use PHPUnit\Framework\TestCase;

class ButtonComponentTest extends TestCase
{
    public function testRendersButtonTag(): void
    {
        $button = new ButtonComponent();
        $markup = $button->getMarkup();
        $this->assertStringContainsString('<button', $markup);
        $this->assertStringContainsString('</button>', $markup);
    }

    public function testDefaultTypeIsButton(): void
    {
        $button = new ButtonComponent();
        $markup = $button->getMarkup();
        $this->assertStringContainsString('type="button"', $markup);
    }

    public function testSetType(): void
    {
        $button = new ButtonComponent();
        $button->setType('submit');
        $markup = $button->getMarkup();
        $this->assertStringContainsString('type="submit"', $markup);
    }

    public function testDisabledButton(): void
    {
        $button = new ButtonComponent();
        $button->disable();
        $markup = $button->getMarkup();
        $this->assertStringContainsString('disabled="disabled"', $markup);
        $this->assertStringContainsString('aria-disabled="true"', $markup);
    }

    public function testEnabledButtonHasNoDisabledAttribute(): void
    {
        $button = new ButtonComponent();
        $markup = $button->getMarkup();
        $this->assertStringNotContainsString('disabled', $markup);
        $this->assertStringNotContainsString('aria-disabled', $markup);
    }

    public function testReEnableButton(): void
    {
        $button = new ButtonComponent();
        $button->disable();
        $button->enable();
        $markup = $button->getMarkup();
        $this->assertStringNotContainsString('disabled="disabled"', $markup);
    }

    public function testButtonWithChildren(): void
    {
        $button = new ButtonComponent();
        $button->addChild('Click me');
        $markup = $button->getMarkup();
        $this->assertStringContainsString('Click me', $markup);
    }
}
