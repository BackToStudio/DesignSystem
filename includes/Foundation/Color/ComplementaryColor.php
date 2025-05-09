<?php

namespace BackTo\DesignSystem\Foundation\Color;

class ComplementaryColor
{
    /**
     * @var array<string, string>
     */
    private array $complementaryColors = [];

    /**
     * 
     */
    public function __construct(array $complementaryColors = [])
    {
        if( empty($complementaryColors)){
            throw new \Exception('Complementary colors are not defined.');
        }
        $this->complementaryColors = $complementaryColors;
    }

    public function getColorName(string $colorName): string
    {
        return $this->colors[$colorName] ?? '';
    }
}