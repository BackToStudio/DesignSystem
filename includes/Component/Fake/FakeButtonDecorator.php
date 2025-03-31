<?php

namespace BackTo\DesignSystem\Component\Fake;

use BackTo\DesignSystem\Config\ComplementaryColor;
use BackTo\DesignSystem\Contracts\CompoundDecorator;
use BackTo\DesignSystem\Decorator\BackgroundColorDecorator;
use BackTo\DesignSystem\Decorator\RingColorDecorator;
use BackTo\DesignSystem\Decorator\TextColorDecorator;

class FakeButtonDecorator implements CompoundDecorator
{
    private BackgroundColorDecorator $backgroundDecorator;
    private RingColorDecorator $ringColorDecorator;
    private BorderColorDecorator $borderColorDecorator;
    private TextColorDecorator $textColorDecorator;
    private ComplementaryColor $complementaryColor;
    private string $color = 'red';

    public function __construct(
        BackgroundColorDecorator $backgroundDecorator,
        RingColorDecorator $ringColorDecorator,
        BorderColorDecorator $borderColorDecorator,
        TextColorDecorator $textColorDecorator,
        ComplementaryColor $complementaryColor)
    {
        $this->backgroundDecorator = $backgroundDecorator;
        $this->ringColorDecorator = $ringColorDecorator;
        $this->borderColorDecorator = $borderColorDecorator;
        $this->textColorDecorator = $textColorDecorator;
        $this->complementaryColor = $complementaryColor;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getBackgroundColor(): string
    {
        $this->backgroundDecorator->setColor($this->getColor());
        return $this->backgroundDecorator->getClassName();
    }

    public function getRingColor(): string
    {
        return $this->ringConfig->getValue($this->getColor());
    }

    public function getBorderColor(): string
    {
        return $this->borderConfig->getValue($this->getColor());
    }

    public function getTextColor(): string
    {
        $complementColor = $this->complementaryColor->getColorName($this->getColor());
        return $this->textColorConfig->getValue($complementColor);
    }

    public function getClassName(): string
    {
        $classNames = [];
        $classNames[] = $this->getRingColor();
        $classNames[] = $this->getBorderColor();

        $this->backgroundDecorator->setColor($this->getColor());
        $className[] = $this->backgroundDecorator->getClassName();

        $classNames[] = $this->getTextColor();
        
        return join(' ', $classNames);
    }
}