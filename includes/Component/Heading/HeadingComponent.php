<?php

namespace BackTo\DesignSystem\Component\Heading;

use BackTo\DesignSystem\Component\TokenComponent;

class HeadingComponent extends TokenComponent
{
    private int $level = 2;
    
    public function setLevel(int $level): void
    {
        if( $level < 1 || $level > 6 ){
            throw new \Exception('Heading level must be between 1 and 6');
        }
        $this->level = $level;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function getTagName(): string
    {
        return 'h' . $this->level;
    }

}