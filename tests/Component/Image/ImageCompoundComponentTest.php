<?php

namespace BackTo\DesignSystem\Tests\Component\Image;

use BackTo\DesignSystem\Component\Image\ImageCompoundComponent;
use PHPUnit\Framework\TestCase;

class ImageCompoundComponentTest extends TestCase
{
    public function testReturnsEmptyWithoutSrc(): void
    {
        $compound = new ImageCompoundComponent();
        $compound->getImageComponent()->setAlt('test');
        $this->assertSame('', $compound->getMarkup());
    }

    public function testRendersImageInsideFigure(): void
    {
        $compound = new ImageCompoundComponent();
        $compound->getImageComponent()->setSrc('photo.jpg')->setAlt('Photo');
        $markup = $compound->getMarkup();
        $this->assertStringContainsString('<figure', $markup);
        $this->assertStringContainsString('<img', $markup);
        $this->assertStringContainsString('src="photo.jpg"', $markup);
        $this->assertStringContainsString('</figure>', $markup);
    }

    public function testWrapsImageInLinkWhenHrefSet(): void
    {
        $compound = new ImageCompoundComponent();
        $compound->getImageComponent()->setSrc('photo.jpg')->setAlt('Photo');
        $compound->getLinkComponent()->setHref('https://example.com');
        $markup = $compound->getMarkup();
        $this->assertStringContainsString('<a', $markup);
        $this->assertStringContainsString('href="https://example.com"', $markup);
    }

    public function testNoLinkWhenHrefEmpty(): void
    {
        $compound = new ImageCompoundComponent();
        $compound->getImageComponent()->setSrc('photo.jpg')->setAlt('Photo');
        $markup = $compound->getMarkup();
        $this->assertStringNotContainsString('<a', $markup);
    }

    public function testRendersCaptionWhenSet(): void
    {
        $compound = new ImageCompoundComponent();
        $compound->getImageComponent()->setSrc('photo.jpg')->setAlt('Photo');
        $compound->getFigCaptionComponent()->setCaption('A caption');
        $markup = $compound->getMarkup();
        $this->assertStringContainsString('<figcaption', $markup);
        $this->assertStringContainsString('A caption', $markup);
    }

    public function testNoCaptionWhenEmpty(): void
    {
        $compound = new ImageCompoundComponent();
        $compound->getImageComponent()->setSrc('photo.jpg')->setAlt('Photo');
        $markup = $compound->getMarkup();
        $this->assertStringNotContainsString('<figcaption', $markup);
    }
}
