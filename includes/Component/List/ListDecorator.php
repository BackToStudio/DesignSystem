<?php

namespace BackTo\DesignSystem\Component\List;

use BackTo\DesignSystem\Contracts\StyleDecorator;
use BackTo\DesignSystem\Foundation\Decorator\AlignDecorator;

class ListDecorator implements StyleDecorator
{

    // TODO : add behaviour decorator
    // TODO : add ordered decorator
    // TODO : add override gutenberg decorator
    private AlignDecorator $alignDecorator;
 
    public function __construct(
        AlignDecorator $alignDecorator
    ){
        $this->alignDecorator = $alignDecorator;
    }    

    public function getClassName(): string
    {
        $className = [];
        $className[] = $this->alignDecorator->getClassName();
        return implode(' ', $className);
    }
}