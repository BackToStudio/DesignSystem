<?php

namespace BackTo\DesignSystem\Tests\Component\ListTest;

use BackTo\DesignSystem\Component\List\ListDecorator;
use BackTo\DesignSystem\Foundation\Grid\Decorator\AlignDecorator;
use PHPUnit\Framework\TestCase;

class ListDecoratorTest extends TestCase
{
    public function testGetClassNameReturnsAlignClass(): void
    {
        $align = $this->createMock(AlignDecorator::class);
        $align->method('getClassName')->willReturn('text-center');

        $decorator = new ListDecorator($align);
        $this->assertSame('text-center', $decorator->getClassName());
    }
}
