<?php

namespace BackTo\DesignSystem\Tests\Component\Slider;

use BackTo\DesignSystem\Component\Slider\SlideComponent;
use BackTo\DesignSystem\Component\Slider\SliderContainer;
use PHPUnit\Framework\TestCase;

class SliderContainerTest extends TestCase
{
    public function testAddSlideReturnsFluentInterface(): void
    {
        $container = new SliderContainer();
        $slide = new SlideComponent();
        $result = $container->addSlide($slide);
        $this->assertSame($container, $result);
    }

    public function testGetSlidesReturnsAddedSlides(): void
    {
        $container = new SliderContainer();
        $slide1 = new SlideComponent();
        $slide2 = new SlideComponent();
        $container->addSlide($slide1)->addSlide($slide2);
        $this->assertCount(2, $container->getSlides());
    }

    public function testGetMarkupRendersAllSlides(): void
    {
        $container = new SliderContainer();
        $slide1 = new SlideComponent();
        $slide1->addChild('First');
        $slide2 = new SlideComponent();
        $slide2->addChild('Second');
        $container->addSlide($slide1)->addSlide($slide2);

        $markup = $container->getMarkup();
        $this->assertStringContainsString('First', $markup);
        $this->assertStringContainsString('Second', $markup);
    }
}
