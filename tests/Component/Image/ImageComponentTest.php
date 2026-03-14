<?php

namespace BackTo\DesignSystem\Tests\Component\Image;

use BackTo\DesignSystem\Component\Image\ImageComponent;
use PHPUnit\Framework\TestCase;

class ImageComponentTest extends TestCase
{
    public function testRendersSelfClosingTag(): void
    {
        $image = new ImageComponent();
        $image->setSrc('photo.jpg')->setAlt('A photo');
        $markup = $image->getMarkup();
        $this->assertStringContainsString('<img', $markup);
        $this->assertStringContainsString('/>', $markup);
        $this->assertStringNotContainsString('</img>', $markup);
    }

    public function testRendersAttributes(): void
    {
        $image = new ImageComponent();
        $image->setSrc('photo.jpg')->setAlt('A photo')->setTitle('Title');
        $markup = $image->getMarkup();
        $this->assertStringContainsString('src="photo.jpg"', $markup);
        $this->assertStringContainsString('alt="A photo"', $markup);
        $this->assertStringContainsString('title="Title"', $markup);
    }

    public function testAltIsRequired(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $image = new ImageComponent();
        $image->setSrc('photo.jpg');
        $image->getMarkup();
    }

    public function testEmptyAltIsAllowedForDecorativeImages(): void
    {
        $image = new ImageComponent();
        $image->setSrc('decoration.png')->setAlt('');
        $markup = $image->getMarkup();
        $this->assertStringContainsString('alt=""', $markup);
    }

    public function testTitleIsOptional(): void
    {
        $image = new ImageComponent();
        $image->setSrc('photo.jpg')->setAlt('Photo');
        $markup = $image->getMarkup();
        $this->assertStringNotContainsString('title=', $markup);
    }

    public function testFluentInterface(): void
    {
        $image = new ImageComponent();
        $result = $image->setSrc('a.jpg');
        $this->assertSame($image, $result);
        $result = $image->setAlt('alt');
        $this->assertSame($image, $result);
        $result = $image->setTitle('title');
        $this->assertSame($image, $result);
    }
}
