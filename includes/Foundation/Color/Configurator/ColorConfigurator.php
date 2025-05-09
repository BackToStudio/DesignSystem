<?php

namespace BackTo\DesignSystem\Foundation\Color\Configurator;

abstract class ColorConfigurator
{
    private string $colorsFileName;

    public function __construct(string $colorsFileName)
    {
        $this->colorsFileName = $colorsFileName;
    }

    public function getFileName(): string
    {
        return $this->colorsFileName;
    }
    
    public function getResourceFile(): string
    {
        return file_get_contents($this->getFileName());
    }

    public function hasResourceFile(): bool
    {
        return file_exists($this->getFileName());
    }

    public function isNotEmptyResourceFile(): bool
    {
        return !empty(json_decode($this->getResourceFile(), true));
    }

    public function configure(): array
    {
        $colors = [];
        
        if( $this->hasResourceFile() && $this->isNotEmptyResourceFile()){
            $colors = array_merge($colors, json_decode($this->getResourceFile(), true));
        }
    
        return $colors;
    }
    
}