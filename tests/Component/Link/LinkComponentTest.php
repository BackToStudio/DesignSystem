<?php

namespace BackTo\DesignSystem\Tests\Component\Link;

use BackTo\DesignSystem\Component\Link\LinkComponent;
use PHPUnit\Framework\TestCase;

class LinkComponentTest extends TestCase
{
    public function testRendersAnchorTag(): void
    {
        $link = new LinkComponent();
        $link->setHref('https://example.com');
        $markup = $link->getMarkup();
        $this->assertStringContainsString('<a', $markup);
        $this->assertStringContainsString('</a>', $markup);
    }

    public function testRendersHref(): void
    {
        $link = new LinkComponent();
        $link->setHref('https://example.com');
        $markup = $link->getMarkup();
        $this->assertStringContainsString('href="https://example.com"', $markup);
    }

    public function testHrefIsRequired(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $link = new LinkComponent();
        $link->getMarkup();
    }

    public function testRendersTarget(): void
    {
        $link = new LinkComponent();
        $link->setHref('/page')->setTarget('_blank');
        $markup = $link->getMarkup();
        $this->assertStringContainsString('target="_blank"', $markup);
    }

    public function testRendersRel(): void
    {
        $link = new LinkComponent();
        $link->setHref('/page')->setRel('noopener');
        $markup = $link->getMarkup();
        $this->assertStringContainsString('rel="noopener"', $markup);
    }

    public function testTargetAndRelOptional(): void
    {
        $link = new LinkComponent();
        $link->setHref('/page');
        $markup = $link->getMarkup();
        $this->assertStringNotContainsString('target=', $markup);
        $this->assertStringNotContainsString('rel=', $markup);
    }

    public function testFluentInterface(): void
    {
        $link = new LinkComponent();
        $this->assertSame($link, $link->setHref('/'));
        $this->assertSame($link, $link->setTarget('_self'));
        $this->assertSame($link, $link->setRel('nofollow'));
    }

    public function testWithChildren(): void
    {
        $link = new LinkComponent();
        $link->setHref('/page');
        $link->addChild('Click here');
        $markup = $link->getMarkup();
        $this->assertStringContainsString('Click here', $markup);
    }
}
