<?php

namespace BackTo\DesignSystem\Component\Image;

use BackTo\DesignSystem\Contracts\StyleDecorator;
use BackTo\DesignSystem\Foundation\Decorator\FontFamilyDecorator;
use BackTo\DesignSystem\Foundation\Decorator\FontSizeDecorator;
use BackTo\DesignSystem\Foundation\Decorator\LineHeightDecorator;
use BackTo\DesignSystem\Foundation\Decorator\LetterSpacingDecorator;

class ImageCompoundDecorator implements StyleDecorator
{

    public function __construct(){
    }

    public function getClassName(): string
    {
        $className = [];
        return implode(' ', $className);
    }
}