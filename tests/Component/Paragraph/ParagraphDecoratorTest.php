<?php

namespace BackTo\DesignSystem\Tests\Component\Paragraph;

use BackTo\DesignSystem\Component\Paragraph\ParagraphDecorator;
use BackTo\DesignSystem\Foundation\Typography\Decorator\FontFamilyDecorator;
use BackTo\DesignSystem\Foundation\Typography\Decorator\FontSizeDecorator;
use BackTo\DesignSystem\Foundation\Typography\Decorator\LineHeightDecorator;
use BackTo\DesignSystem\Foundation\Typography\Decorator\LetterSpacingDecorator;
use PHPUnit\Framework\TestCase;

class ParagraphDecoratorTest extends TestCase
{
    public function testGetClassNameCombinesAllDecorators(): void
    {
        $fontFamily = $this->createMock(FontFamilyDecorator::class);
        $fontFamily->method('getClassName')->willReturn('font-sans');

        $fontSize = $this->createMock(FontSizeDecorator::class);
        $fontSize->method('getClassName')->willReturn('text-base');

        $lineHeight = $this->createMock(LineHeightDecorator::class);
        $lineHeight->method('getClassName')->willReturn('leading-normal');

        $letterSpacing = $this->createMock(LetterSpacingDecorator::class);
        $letterSpacing->method('getClassName')->willReturn('tracking-normal');

        $decorator = new ParagraphDecorator($fontFamily, $fontSize, $lineHeight, $letterSpacing);
        $this->assertSame('font-sans text-base leading-normal tracking-normal', $decorator->getClassName());
    }
}
