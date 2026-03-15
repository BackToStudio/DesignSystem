<?php

namespace BackTo\DesignSystem\Tests\Component\Slider;

use BackTo\DesignSystem\Component\Slider\SliderControls;
use PHPUnit\Framework\TestCase;

class SliderControlsTest extends TestCase
{
    public function testRendersWithControlsClass(): void
    {
        $controls = new SliderControls();
        $markup = $controls->getMarkup();
        $this->assertStringContainsString('ds-slider__controls', $markup);
    }

    public function testRendersPrevAndNextButtons(): void
    {
        $controls = new SliderControls();
        $markup = $controls->getMarkup();
        $this->assertStringContainsString('ds-slider__prev', $markup);
        $this->assertStringContainsString('ds-slider__next', $markup);
    }

    public function testRendersAccessibleLabels(): void
    {
        $controls = new SliderControls();
        $markup = $controls->getMarkup();
        $this->assertStringContainsString('Previous', $markup);
        $this->assertStringContainsString('Next', $markup);
    }

    public function testGetSliderPrevReturnsButtonComponent(): void
    {
        $controls = new SliderControls();
        $prev = $controls->getSliderPrev();
        $markup = $prev->getMarkup();
        $this->assertStringContainsString('<button', $markup);
    }
}
