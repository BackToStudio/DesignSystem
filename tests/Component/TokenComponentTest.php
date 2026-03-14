<?php

namespace BackTo\DesignSystem\Tests\Component;

use BackTo\DesignSystem\Component\TokenComponent;
use BackTo\DesignSystem\Contracts\StyleDecorator;
use PHPUnit\Framework\TestCase;

class TokenComponentTest extends TestCase
{
    public function testDefaultTagNameIsDiv(): void
    {
        $component = new TokenComponent();
        $this->assertSame('div', $component->getTagName());
    }

    public function testSetTagName(): void
    {
        $component = new TokenComponent();
        $result = $component->setTagName('section');
        $this->assertSame('section', $component->getTagName());
        $this->assertSame($component, $result);
    }

    public function testAddClass(): void
    {
        $component = new TokenComponent();
        $result = $component->addClass('foo');
        $this->assertTrue($component->hasClass('foo'));
        $this->assertSame($component, $result);
    }

    public function testAddClassDoesNotDuplicate(): void
    {
        $component = new TokenComponent();
        $component->addClass('foo');
        $component->addClass('foo');
        $this->assertCount(1, $component->getClasses());
    }

    public function testAddMultipleClassesFromString(): void
    {
        $component = new TokenComponent();
        $component->addClass('foo bar baz');
        $this->assertTrue($component->hasClass('foo'));
        $this->assertTrue($component->hasClass('bar'));
        $this->assertTrue($component->hasClass('baz'));
    }

    public function testRemoveClass(): void
    {
        $component = new TokenComponent();
        $component->addClass('foo bar');
        $result = $component->removeClass('foo');
        $this->assertFalse($component->hasClass('foo'));
        $this->assertTrue($component->hasClass('bar'));
        $this->assertSame($component, $result);
    }

    public function testRemoveNonExistentClassDoesNothing(): void
    {
        $component = new TokenComponent();
        $component->addClass('foo');
        $component->removeClass('nonexistent');
        $this->assertTrue($component->hasClass('foo'));
    }

    public function testClearClasses(): void
    {
        $component = new TokenComponent();
        $component->addClass('foo bar');
        $result = $component->clearClasses();
        $this->assertEmpty($component->getClasses());
        $this->assertSame($component, $result);
    }

    public function testAddAttribute(): void
    {
        $component = new TokenComponent();
        $result = $component->addAttribute('data-id', '42');
        $this->assertTrue($component->hasAttribute('data-id'));
        $this->assertSame($component, $result);
    }

    public function testRemoveAttribute(): void
    {
        $component = new TokenComponent();
        $component->addAttribute('data-id', '42');
        $result = $component->removeAttribute('data-id');
        $this->assertFalse($component->hasAttribute('data-id'));
        $this->assertSame($component, $result);
    }

    public function testRemoveNonExistentAttributeDoesNothing(): void
    {
        $component = new TokenComponent();
        $component->removeAttribute('nonexistent');
        $this->assertFalse($component->hasAttribute('nonexistent'));
    }

    public function testAddChild(): void
    {
        $component = new TokenComponent();
        $result = $component->addChild('<span>Hello</span>');
        $this->assertCount(1, $component->getChildren());
        $this->assertSame($component, $result);
    }

    public function testClearChildren(): void
    {
        $component = new TokenComponent();
        $component->addChild('one');
        $component->addChild('two');
        $result = $component->clearChildren();
        $this->assertEmpty($component->getChildren());
        $this->assertSame($component, $result);
    }

    public function testGetMarkupRendersBasicDiv(): void
    {
        $component = new TokenComponent();
        $component->addChild('Hello');
        $markup = $component->getMarkup();
        $this->assertStringContainsString('<div', $markup);
        $this->assertStringContainsString('Hello', $markup);
        $this->assertStringContainsString('</div>', $markup);
    }

    public function testGetMarkupRendersAttributes(): void
    {
        $component = new TokenComponent();
        $component->addAttribute('id', 'test');
        $markup = $component->getMarkup();
        $this->assertStringContainsString('id="test"', $markup);
    }

    public function testGetMarkupRendersClasses(): void
    {
        $component = new TokenComponent();
        $component->addClass('foo bar');
        $markup = $component->getMarkup();
        $this->assertStringContainsString('class="foo bar"', $markup);
    }

    public function testGetMarkupEscapesAttributes(): void
    {
        $component = new TokenComponent();
        $component->addAttribute('data-value', '<script>alert("xss")</script>');
        $markup = $component->getMarkup();
        $this->assertStringNotContainsString('<script>', $markup);
        $this->assertStringContainsString('&lt;script&gt;', $markup);
    }

    public function testSelfClosingElement(): void
    {
        $component = new class extends TokenComponent {
            protected string $tagName = 'br';
            protected bool $selfClosing = true;
        };
        $markup = $component->getMarkup();
        $this->assertStringContainsString('<br', $markup);
        $this->assertStringContainsString('/>', $markup);
        $this->assertStringNotContainsString('</br>', $markup);
    }

    public function testDecoratorsApplyClasses(): void
    {
        $decorator = $this->createMock(StyleDecorator::class);
        $decorator->method('getClassName')->willReturn('text-red-500');

        $component = new TokenComponent();
        $component->addDecorator($decorator);
        $markup = $component->getMarkup();
        $this->assertStringContainsString('text-red-500', $markup);
    }

    public function testChildrenConcatenatedWithoutSpaces(): void
    {
        $component = new TokenComponent();
        $component->addChild('<span>A</span>');
        $component->addChild('<span>B</span>');
        $markup = $component->getMarkup();
        $this->assertStringContainsString('<span>A</span><span>B</span>', $markup);
    }
}
