<?php

namespace BackTo\DesignSystem\Component\Link;

use BackTo\DesignSystem\Component\TokenComponent;

class LinkComponent extends TokenComponent
{
    protected string $href = '';
    protected string $target = '';
    protected string $rel = '';

    public function getHref(): string
    {
        return $this->href;
    }

    public function setHref(string $href): self
    {
        $this->href = $href;
        return $this;
    }

    public function getTarget(): string
    {
        return $this->target;
    }

    public function setTarget(string $target): self
    {
        $this->target = $target;
        return $this;
    }

    public function getRel(): string
    {
        return $this->rel;
    }

    public function setRel(string $rel): self
    {
        $this->rel = $rel;
        return $this;
    }

    public function getMarkup(): string
    {
        $this->setTagName('a');

        if (!empty($this->href)) {
            $this->addAttribute('href', $this->getHref());
        }

        if (!empty($this->target)) {
            $this->addAttribute('target', $this->getTarget());
        }

        if (!empty($this->rel)) {
            $this->addAttribute('rel', $this->getRel());
        }

        return parent::getMarkup();
    }
}