<?php

namespace BackTo\DesignSystem\Component\Image;

use BackTo\DesignSystem\Component\FigCaption\FigCaptionComponent;
use BackTo\DesignSystem\Component\Figure\FigureComponent;
use BackTo\DesignSystem\Component\Link\LinkComponent;
use BackTo\DesignSystem\Component\TokenComponent;

class ImageCompoundComponent extends TokenComponent
{
    private FigureComponent $figure;
    private ImageComponent $image;
    private FigCaptionComponent $figCaption;
    private LinkComponent $link;

    public function __construct()
    {
        $this->figure = new FigureComponent();
        $this->image = new ImageComponent();
        $this->figCaption = new FigCaptionComponent();
        $this->link = new LinkComponent();
    }

    public function getFigureComponent(): FigureComponent
    {
        return $this->figure;
    }

    public function getImageComponent(): ImageComponent
    {
        return $this->image;
    }

    public function getFigCaptionComponent(): FigCaptionComponent
    {
        return $this->figCaption;
    }

    public function getLinkComponent(): LinkComponent
    {
        return $this->link;
    }

    public function getMarkup(): string
    {
        if (empty($this->getImageComponent()->getSrc())) {
            return '';
        }

        if (!empty($this->getLinkComponent()->getHref())) {
            $this->getLinkComponent()->addChild(
                $this->getImageComponent()->getMarkup()
            );
            $this->getFigureComponent()->addChild(
                $this->getLinkComponent()->getMarkup()
            );
        } else {
            $this->getFigureComponent()->addChild(
                $this->getImageComponent()->getMarkup()
            );
        }

        if (!empty($this->getFigCaptionComponent()->getChildren())) {
            $this->getFigureComponent()->addChild(
                $this->getFigCaptionComponent()->getMarkup()
            );
        }

        return $this->getFigureComponent()->getMarkup();
    }
}
