<?php

namespace BackTo\DesignSystem\Tests\Component\Slider;

use BackTo\DesignSystem\Component\Slider\SlideComponent;
use BackTo\DesignSystem\Component\Slider\SliderComponent;
use PHPUnit\Framework\TestCase;

class SliderComponentTest extends TestCase
{
    public function testReturnsEmptyStringWithNoSlides(): void
    {
        $slider = new SliderComponent();
        $this->assertSame('', $slider->getMarkup());
    }

    public function testReturnsEmptyStringWithOnlyOneSlide(): void
    {
        $slider = new SliderComponent();
        $slide = new SlideComponent();
        $slide->addChild('Only slide');
        $slider->getSlidesContainer()->addSlide($slide);
        $this->assertSame('', $slider->getMarkup());
    }

    public function testRendersMarkupWithMultipleSlides(): void
    {
        $slider = new SliderComponent();
        $slide1 = new SlideComponent();
        $slide1->addChild('Slide 1');
        $slide2 = new SlideComponent();
        $slide2->addChild('Slide 2');
        $slider->getSlidesContainer()->addSlide($slide1);
        $slider->getSlidesContainer()->addSlide($slide2);

        $markup = $slider->getMarkup();
        $this->assertStringContainsString('Slide 1', $markup);
        $this->assertStringContainsString('Slide 2', $markup);
        $this->assertStringContainsString('ds-slider', $markup);
    }

    public function testHasUniqueId(): void
    {
        $slider = new SliderComponent();
        $this->assertStringStartsWith('slider-', $slider->getId());
    }

    public function testDoesNotRenderControlsWhenDisabled(): void
    {
        $slider = new SliderComponent();
        $slider->getMobileSettings()->withControls();
        // enable() not called — controls should not render

        $slide1 = new SlideComponent();
        $slide1->addChild('Slide 1');
        $slide2 = new SlideComponent();
        $slide2->addChild('Slide 2');
        $slider->getSlidesContainer()->addSlide($slide1);
        $slider->getSlidesContainer()->addSlide($slide2);

        $markup = $slider->getMarkup();
        $this->assertStringNotContainsString('ds-slider__controls', $markup);
    }

    public function testRendersControlsWhenEnabledWithControls(): void
    {
        $slider = new SliderComponent();
        $slider->getMobileSettings()->enable()->withControls();

        $slide1 = new SlideComponent();
        $slide1->addChild('Slide 1');
        $slide2 = new SlideComponent();
        $slide2->addChild('Slide 2');
        $slider->getSlidesContainer()->addSlide($slide1);
        $slider->getSlidesContainer()->addSlide($slide2);

        $markup = $slider->getMarkup();
        $this->assertStringContainsString('ds-slider__controls', $markup);
    }

    public function testRendersPaginationWhenEnabledWithPagination(): void
    {
        $slider = new SliderComponent();
        $slider->getDesktopSettings()->enable()->withPagination();

        $slide1 = new SlideComponent();
        $slide1->addChild('Slide 1');
        $slide2 = new SlideComponent();
        $slide2->addChild('Slide 2');
        $slider->getSlidesContainer()->addSlide($slide1);
        $slider->getSlidesContainer()->addSlide($slide2);

        $markup = $slider->getMarkup();
        $this->assertStringContainsString('ds-slider__pagination', $markup);
    }

    public function testDoesNotRenderPaginationWhenDisabled(): void
    {
        $slider = new SliderComponent();
        $slider->getDesktopSettings()->withPagination();
        // enable() not called

        $slide1 = new SlideComponent();
        $slide1->addChild('Slide 1');
        $slide2 = new SlideComponent();
        $slide2->addChild('Slide 2');
        $slider->getSlidesContainer()->addSlide($slide1);
        $slider->getSlidesContainer()->addSlide($slide2);

        $markup = $slider->getMarkup();
        $this->assertStringNotContainsString('ds-slider__pagination', $markup);
    }
}
