<?php

namespace BackTo\DesignSystem\Tests\Component\Heading;

use BackTo\DesignSystem\Component\Heading\HeadingComponent;
use PHPUnit\Framework\TestCase;

class HeadingComponentTest extends TestCase
{
    public function testDefaultLevelIsH2(): void
    {
        $heading = new HeadingComponent();
        $this->assertSame(2, $heading->getLevel());
        $markup = $heading->getMarkup();
        $this->assertStringContainsString('<h2', $markup);
        $this->assertStringContainsString('</h2>', $markup);
    }

    public function testSetLevel(): void
    {
        $heading = new HeadingComponent();
        $heading->setLevel(1);
        $markup = $heading->getMarkup();
        $this->assertStringContainsString('<h1', $markup);
    }

    /**
     * @dataProvider validLevelsProvider
     */
    public function testValidLevels(int $level): void
    {
        $heading = new HeadingComponent();
        $heading->setLevel($level);
        $this->assertSame($level, $heading->getLevel());
    }

    public static function validLevelsProvider(): array
    {
        return [[1], [2], [3], [4], [5], [6]];
    }

    public function testInvalidLevelTooLow(): void
    {
        $this->expectException(\Exception::class);
        $heading = new HeadingComponent();
        $heading->setLevel(0);
    }

    public function testInvalidLevelTooHigh(): void
    {
        $this->expectException(\Exception::class);
        $heading = new HeadingComponent();
        $heading->setLevel(7);
    }

    public function testHeadingWithContent(): void
    {
        $heading = new HeadingComponent();
        $heading->setLevel(3);
        $heading->addChild('My Title');
        $markup = $heading->getMarkup();
        $this->assertStringContainsString('<h3', $markup);
        $this->assertStringContainsString('My Title', $markup);
        $this->assertStringContainsString('</h3>', $markup);
    }
}
