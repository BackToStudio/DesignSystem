<?php

namespace BackTo\DesignSystem\Tests\Component\Slider;

use BackTo\DesignSystem\Component\Slider\SlideComponent;
use PHPUnit\Framework\TestCase;

class SlideComponentTest extends TestCase
{
    public function testRendersArticleTag(): void
    {
        $slide = new SlideComponent();
        $slide->addChild('Content');
        $markup = $slide->getMarkup();
        $this->assertStringContainsString('<article', $markup);
        $this->assertStringContainsString('</article>', $markup);
    }

    public function testRendersWithChildren(): void
    {
        $slide = new SlideComponent();
        $slide->addChild('<h2>Title</h2>');
        $markup = $slide->getMarkup();
        $this->assertStringContainsString('<h2>Title</h2>', $markup);
    }
}
