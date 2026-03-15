<?php

namespace BackTo\DesignSystem\Component\Image;

use BackTo\DesignSystem\Component\TokenComponent;

class ImageComponent extends TokenComponent
{
    protected string $tagName = 'img';
    protected bool $selfClosing = true;
    protected string $title = '';
    protected string $alt = '';
    protected string $src = '';
    private bool $altWasSet = false;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getAlt(): string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;
        $this->altWasSet = true;
        return $this;
    }

    public function getSrc(): string
    {
        return $this->src;
    }

    public function setSrc(string $src): self
    {
        $this->src = $src;
        return $this;
    }

    public function getMarkup(): string
    {
        if (!$this->altWasSet) {
            throw new \InvalidArgumentException('The alt attribute must be set on ImageComponent. Use setAlt("") for decorative images.');
        }

        if (!empty($this->getSrc())) {
            $this->addAttribute('src', $this->getSrc());
        }

        $this->addAttribute('alt', $this->getAlt());

        if (!empty($this->getTitle())) {
            $this->addAttribute('title', $this->getTitle());
        }

        return parent::getMarkup();
    }
}
