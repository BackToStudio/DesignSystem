<?php

namespace BackTo\DesignSystem\Component\Heading;

use BackTo\DesignSystem\Contracts\StyleDecorator;
use BackTo\DesignSystem\Foundation\Typography\Decorator\FontFamilyDecorator;
use BackTo\DesignSystem\Foundation\Typography\Decorator\FontSizeDecorator;
use BackTo\DesignSystem\Foundation\Typography\Decorator\LineHeightDecorator;
use BackTo\DesignSystem\Foundation\Typography\Decorator\LetterSpacingDecorator;

class HeadingDecorator implements StyleDecorator
{

    private FontFamilyDecorator $fontFamilyDecorator;
    private FontSizeDecorator $fontSizeDecorator;
    private LineHeightDecorator $lineHeightDecorator;
    private LetterSpacingDecorator $letterSpacingDecorator;

    public function __construct(
        FontFamilyDecorator $fontFamilyDecorator, 
        FontSizeDecorator $fontSizeDecorator, 
        LineHeightDecorator $lineHeightDecorator, 
        LetterSpacingDecorator $letterSpacingDecorator
    ){
        $this->fontFamilyDecorator = $fontFamilyDecorator;
        $this->fontSizeDecorator = $fontSizeDecorator;
        $this->lineHeightDecorator = $lineHeightDecorator;
        $this->letterSpacingDecorator = $letterSpacingDecorator;
    }    

    public function getClassName(): string
    {
        $className = [];
        $className[] = $this->fontFamilyDecorator->getClassName();
        $className[] = $this->fontSizeDecorator->getClassName();
        $className[] = $this->lineHeightDecorator->getClassName();
        $className[] = $this->letterSpacingDecorator->getClassName();
        return implode(' ', $className);
    }
}