<?php

namespace BackTo\DesignSystem\Tests\Component\Paragraph;

use BackTo\DesignSystem\Component\Paragraph\ParagraphComponent;
use PHPUnit\Framework\TestCase;

class ParagraphComponentTest extends TestCase
{
    public function testRendersParagraphTag(): void
    {
        $p = new ParagraphComponent();
        $markup = $p->getMarkup();
        $this->assertStringContainsString('<p', $markup);
        $this->assertStringContainsString('</p>', $markup);
    }

    public function testRendersWithContent(): void
    {
        $p = new ParagraphComponent();
        $p->addChild('Hello world');
        $markup = $p->getMarkup();
        $this->assertStringContainsString('Hello world', $markup);
    }

    public function testRendersWithClass(): void
    {
        $p = new ParagraphComponent();
        $p->addClass('intro');
        $p->addChild('Content');
        $markup = $p->getMarkup();
        $this->assertStringContainsString('class="intro"', $markup);
    }
}
