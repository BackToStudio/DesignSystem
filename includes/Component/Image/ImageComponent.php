<?php

namespace BackTo\DesignSystem\Component\Image;

use BackTo\DesignSystem\Component\TokenComponent;

class ImageComponent extends TokenComponent
{
    protected string $title = '';
    protected string $alt = '';
    protected string $src = '';

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
        if (!empty($this->getSrc())) {
            $this->addAttribute('src', $this->src);
        }

        if (!empty($this->alt)) {
            $this->addAttribute('alt', $this->alt);
        }
        if (!empty($this->title)) {
            $this->addAttribute('title', $this->title);
        }

        $attributes = $this->prepareAttributes();
        return '<img ' . $attributes . '>';
    }
}