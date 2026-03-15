<?php

namespace BackTo\DesignSystem\Tests\Component\Svg;

use BackTo\DesignSystem\Component\Svg\SvgFactory;
use PHPUnit\Framework\TestCase;

class SvgFactoryTest extends TestCase
{
    public function testGetSvgListReturnsProvidedList(): void
    {
        $list = ['arrow' => 'ArrowClass', 'close' => 'CloseClass'];
        $factory = new SvgFactory($list);
        $this->assertSame($list, $factory->getSvgList());
    }

    public function testGetSvgReturnsClassName(): void
    {
        $factory = new SvgFactory(['arrow' => 'ArrowClass']);
        $this->assertSame('ArrowClass', $factory->getSvg('arrow'));
    }

    public function testGetSvgThrowsExceptionForUnknownName(): void
    {
        $factory = new SvgFactory(['arrow' => 'ArrowClass']);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The svg "unknown" does not exist');
        $factory->getSvg('unknown');
    }
}
