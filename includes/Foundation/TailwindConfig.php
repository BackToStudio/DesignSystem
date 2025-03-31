<?php

namespace BackTo\DesignSystem\Config;

class TailwindConfig
{
    private array $settings = [];

    public function __construct(array $settings = [])
    {
        $this->settings = $settings;
    }

    public function getSettings(): array
    {
        return $this->settings;
    }

    public function getValue(string $name): string
    {
        return $this->settings[$name] ?? '';
    }
}