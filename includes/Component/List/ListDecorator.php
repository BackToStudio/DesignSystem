<?php

namespace BackTo\DesignSystem\Component\List;

use BackTo\DesignSystem\Contracts\StyleDecorator;
use BackTo\DesignSystem\Foundation\Decorator\AlignDecorator;

class ListDecorator implements StyleDecorator
{

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