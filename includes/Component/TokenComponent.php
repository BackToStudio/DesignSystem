<?php

namespace BackTo\DesignSystem\Component;

use BackTo\DesignSystem\Contracts\Component;
use BackTo\DesignSystem\Contracts\StyleDecorator;

class TokenComponent implements Component
{
    private string $tagName = 'div';
    private array $attributes = [];
    private array $children = [];
    private array $classes = [];

    public function addClass(string $classnames): static
    {
        $arrayClassnames = $this->convertClassesToArray($classnames);
        foreach ($arrayClassnames as $classname) {
            if (!$this->hasClass($classname)) {
                $this->classes[] = $classname;
            }
        }

        return $this;
    }

    public function getClasses(): array
    {
        return $this->classes;
    }

    public function removeClass(string $classnameToRemove): static
    {
        if ($this->hasClass($classnameToRemove)) {
            $this->classes = array_filter($this->classes, function ($classname) use (
                $classnameToRemove
            ) {
                return $classname !== $classnameToRemove;
            });
        }

        return $this;
    }

    public function hasClass(string $classname): bool
    {
        return in_array($classname, $this->getClasses());
    }

    public function convertClassesToString(array $classes): string
    {
        return join(' ', $classes);
    }

    public function convertClassesToArray(string $classes): array
    {
        return explode(' ', $classes);
    }

    public function clearClasses(): static
    {
        $this->classes = [];

        return $this;
    }

    public function addChild(string $html): static
    {
        $this->children[] = $html;

        return $this;
    }

    public function clearChildren(): static
    {
        $this->children = [];

        return $this;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function addAttribute(string $attribute, string $value): static
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    public function hasAttribute(string $attributeName): bool
    {
        return array_key_exists($attributeName, $this->attributes);
    }

    protected function getAttributes(): array
    {
        return $this->attributes;
    }

    protected function clearAttributes(): static
    {
        $this->attributes = [];

        return $this;
    }

    /**
     * @var StyleDecorator[]
     */
    private array $decorators = [];

    public function addDecorator(StyleDecorator $decorator): void
    {
        $this->decorators[] = $decorator;
    }

    public function applyDecorators(): void
    {
        foreach ($this->decorators as $decorator) {
            $this->addClass($decorator->getClassName());
        }
    }

    public function getTagName(): string
    {
        return $this->tagName;
    }

    public function setTagName(string $tagName): static
    {
        $this->tagName = $tagName;

        return $this;
    }

    public function getMarkup(): string
    {
        $attributes = $this->prepareAttributes();
        $tagName = $this->getTagName();

        $markup = '<' . $tagName . ' ' . $attributes . '>';
        $markup .= join(' ', $this->getChildren());
        $markup .= '</' . $tagName . '>';

        return $markup;
    }

    public function prepareAttributes(): string
    {
        $this->applyDecorators();

        $classes = $this->getClasses();

        if (count($classes) > 0) {
            $this->addAttribute('class', join(' ', $classes));
        }

        $attributes = '';
        foreach ($this->getAttributes() as $attribute => $value) {
            $attributes .=
                $this->escapeAttribute($attribute) .
                '="' .
                $this->escapeAttribute($value) .
                '" ';
        }

        return $attributes;
    }

    public function escapeAttribute(string $value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
