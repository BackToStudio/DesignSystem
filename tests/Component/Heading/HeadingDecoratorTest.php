<?php

namespace BackTo\DesignSystem\Tests\Component\Heading;

use BackTo\DesignSystem\Component\Heading\HeadingDecorator;
use BackTo\DesignSystem\Foundation\Typography\Decorator\FontFamilyDecorator;
use BackTo\DesignSystem\Foundation\Typography\Decorator\FontSizeDecorator;
use BackTo\DesignSystem\Foundation\Typography\Decorator\LineHeightDecorator;
use BackTo\DesignSystem\Foundation\Typography\Decorator\LetterSpacingDecorator;
use PHPUnit\Framework\TestCase;

class HeadingDecoratorTest extends TestCase
{
    public function testGetClassNameCombinesAllDecorators(): void
    {
        $fontFamily = $this->createMock(FontFamilyDecorator::class);
        $fontFamily->method('getClassName')->willReturn('font-serif');

        $fontSize = $this->createMock(FontSizeDecorator::class);
        $fontSize->method('getClassName')->willReturn('text-3xl');

        $lineHeight = $this->createMock(LineHeightDecorator::class);
        $lineHeight->method('getClassName')->willReturn('leading-tight');

        $letterSpacing = $this->createMock(LetterSpacingDecorator::class);
        $letterSpacing->method('getClassName')->willReturn('tracking-tight');

        $decorator = new HeadingDecorator($fontFamily, $fontSize, $lineHeight, $letterSpacing);
        $this->assertSame('font-serif text-3xl leading-tight tracking-tight', $decorator->getClassName());
    }
}
