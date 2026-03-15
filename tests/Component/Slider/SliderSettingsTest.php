<?php

namespace BackTo\DesignSystem\Tests\Component\Slider;

use BackTo\DesignSystem\Component\Slider\SliderSettings;
use PHPUnit\Framework\TestCase;

class SliderSettingsTest extends TestCase
{
    public function testDefaultsDisabled(): void
    {
        $settings = new SliderSettings();
        $this->assertFalse($settings->isEnable());
        $this->assertFalse($settings->hasPagination());
        $this->assertFalse($settings->hasControls());
        $this->assertFalse($settings->hasAutoplay());
        $this->assertSame(1, $settings->getPerPage());
    }

    public function testEnableDisable(): void
    {
        $settings = new SliderSettings();
        $settings->enable();
        $this->assertTrue($settings->isEnable());
        $settings->disable();
        $this->assertFalse($settings->isEnable());
    }

    public function testWithPagination(): void
    {
        $settings = new SliderSettings();
        $settings->withPagination();
        $this->assertTrue($settings->hasPagination());
    }

    public function testWithControls(): void
    {
        $settings = new SliderSettings();
        $settings->withControls();
        $this->assertTrue($settings->hasControls());
    }

    public function testWithAutoplay(): void
    {
        $settings = new SliderSettings();
        $settings->withAutoplay();
        $this->assertTrue($settings->hasAutoplay());
    }

    public function testSetPerPage(): void
    {
        $settings = new SliderSettings();
        $settings->setPerPage(3);
        $this->assertSame(3, $settings->getPerPage());
    }

    public function testToArray(): void
    {
        $settings = new SliderSettings();
        $settings->enable()->withPagination()->withControls()->setPerPage(2);
        $array = $settings->toArray();

        $this->assertTrue($array['isEnable']);
        $this->assertTrue($array['hasPagination']);
        $this->assertTrue($array['hasControls']);
        $this->assertFalse($array['hasAutoplay']);
        $this->assertSame(2, $array['perPage']);
    }

    public function testFluentInterface(): void
    {
        $settings = new SliderSettings();
        $this->assertSame($settings, $settings->enable());
        $this->assertSame($settings, $settings->disable());
        $this->assertSame($settings, $settings->withPagination());
        $this->assertSame($settings, $settings->withControls());
        $this->assertSame($settings, $settings->withAutoplay());
        $this->assertSame($settings, $settings->setPerPage(1));
    }
}
