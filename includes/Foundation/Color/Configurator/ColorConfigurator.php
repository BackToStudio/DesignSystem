<?php

namespace BackTo\DesignSystem\Foundation\Color\Configurator;

abstract class ColorConfigurator
{
    private string $colorsDirectory;
    private string $fileName;

    public function __construct(string $colorsDirectory)
    {
        $this->colorsDirectory = $colorsDirectory;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }
    
    public function getResourceFile(string $fileName): string
    {
        return file_get_contents($this->colorsDirectory . DIRECTORY_SEPARATOR . $fileName);
    }

    public function hasResourceFile(): bool
    {
        return file_exists($this->colorsDirectory . DIRECTORY_SEPARATOR . $this->getFileName());
    }

    public function isNotEmptyResourceFile(): bool
    {
        return !empty(json_decode($this->getResourceFile($this->getFileName()), true));
    }

    public function configure(): array
    {
        $colors = [];
        
        if( $this->hasResourceFile() && $this->isNotEmptyResourceFile()){
            $colors = array_merge($colors, json_decode($this->getResourceFile($this->getFileName()), true));
        }
    
        return $colors;
    }
    
}