<?php

namespace BackTo\DesignSystem\Foundation\Typography\Configurator;

abstract class TypographyConfigurator
{
    protected string $fileName = '';
    private string $configDirectory = '';

    public function __construct(string $configDirectory)
    {
        $this->configDirectory = $configDirectory;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }
    
    public function getResourceFile(): string
    {
        return file_get_contents($this->configDirectory . DIRECTORY_SEPARATOR . $this->getFileName());
    }

    public function hasResourceFile(): bool
    {
        return file_exists($this->configDirectory . DIRECTORY_SEPARATOR . $this->getFileName());
    }

    public function isNotEmptyResourceFile(): bool
    {
        return !empty(json_decode($this->getResourceFile(), true));
    }

    public function configure(): array
    {
        $config = [];
        
        if( $this->hasResourceFile() && $this->isNotEmptyResourceFile()){
            $config = array_merge($config, json_decode($this->getResourceFile(), true));
        }
    
        return $config;
    }
} 