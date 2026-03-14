<?php

namespace BackTo\DesignSystem\Tests\Component\ListTest;

use BackTo\DesignSystem\Component\List\ListComponent;
use PHPUnit\Framework\TestCase;

class ListComponentTest extends TestCase
{
    public function testDefaultsToUnorderedList(): void
    {
        $list = new ListComponent();
        $list->addChild('<li>Item</li>');
        $markup = $list->getMarkup();
        $this->assertStringContainsString('<ul', $markup);
        $this->assertStringContainsString('</ul>', $markup);
    }

    public function testOrderedList(): void
    {
        $list = new ListComponent();
        $list->ordered(true);
        $list->addChild('<li>Item</li>');
        $markup = $list->getMarkup();
        $this->assertStringContainsString('<ol', $markup);
        $this->assertStringContainsString('</ol>', $markup);
    }

    public function testStartAttributeOnlyWhenGreaterThanOne(): void
    {
        $list = new ListComponent();
        $list->ordered(true);
        $list->setStart(5);
        $list->addChild('<li>Item</li>');
        $markup = $list->getMarkup();
        $this->assertStringContainsString('start="5"', $markup);
    }

    public function testStartDefaultDoesNotAddAttribute(): void
    {
        $list = new ListComponent();
        $list->addChild('<li>Item</li>');
        $markup = $list->getMarkup();
        $this->assertStringNotContainsString('start=', $markup);
    }
}
