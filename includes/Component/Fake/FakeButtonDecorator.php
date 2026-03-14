<?php

namespace BackTo\DesignSystem\Component\Fake;

use BackTo\DesignSystem\Foundation\Color\ComplementaryColor;
use BackTo\DesignSystem\Contracts\CompoundDecorator;
use BackTo\DesignSystem\Foundation\Color\Decorator\BackgroundColorDecorator;
use BackTo\DesignSystem\Foundation\Color\Decorator\BorderColorDecorator;
use BackTo\DesignSystem\Foundation\Color\Decorator\RingColorDecorator;
use BackTo\DesignSystem\Foundation\Color\Decorator\TextColorDecorator;

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
        ComplementaryColor $complementaryColor
    ) {
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
        $this->ringColorDecorator->setColor($this->getColor());
        return $this->ringColorDecorator->getClassName();
    }

    public function getBorderColor(): string
    {
        $this->borderColorDecorator->setColor($this->getColor());
        return $this->borderColorDecorator->getClassName();
    }

    public function getTextColor(): string
    {
        $complementColor = $this->complementaryColor->getColorName($this->getColor());
        $this->textColorDecorator->setColor($complementColor);
        return $this->textColorDecorator->getClassName();
    }

    public function getClassName(): string
    {
        $classNames = [];
        $classNames[] = $this->getBackgroundColor();
        $classNames[] = $this->getRingColor();
        $classNames[] = $this->getBorderColor();
        $classNames[] = $this->getTextColor();

        return join(' ', $classNames);
    }
}