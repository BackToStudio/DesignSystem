<?php

namespace BackTo\DesignSystem\Tests\Component\FigCaption;

use BackTo\DesignSystem\Component\FigCaption\FigCaptionComponent;
use PHPUnit\Framework\TestCase;

class FigCaptionComponentTest extends TestCase
{
    public function testRendersFigcaptionTag(): void
    {
        $fc = new FigCaptionComponent();
        $fc->setCaption('Legend');
        $markup = $fc->getMarkup();
        $this->assertStringContainsString('<figcaption', $markup);
        $this->assertStringContainsString('Legend', $markup);
        $this->assertStringContainsString('</figcaption>', $markup);
    }

    public function testSetCaptionReplacesChildren(): void
    {
        $fc = new FigCaptionComponent();
        $fc->setCaption('First');
        $fc->setCaption('Second');
        $markup = $fc->getMarkup();
        $this->assertStringNotContainsString('First', $markup);
        $this->assertStringContainsString('Second', $markup);
    }

    public function testFluentInterface(): void
    {
        $fc = new FigCaptionComponent();
        $this->assertSame($fc, $fc->setCaption('text'));
    }
}
