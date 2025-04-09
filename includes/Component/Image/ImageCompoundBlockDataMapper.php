<?php

namespace BackTo\DesignSystem\Component\Image;

use BackTo\DesignSystem\BlockEditor\BlockDataMapper\BlockDataMapper;
use WP_Block;

class ImageCompoundBlockDataMapper extends BlockDataMapper
{
    const BLOCK_NAME = 'core/image';
    private ImageCompoundDecorator $imageDecorator;

    public function __construct(
        ImageCompoundDecorator $imageDecorator
    ){
        $this->imageDecorator = $imageDecorator;
    }

    public function getComponent(array $block): ImageCompoundComponent
    {
        return new ImageCompoundComponent();
    }

    public function applyData($component, string $blockContent, array $block, WP_Block $instance): void {
        // @TODO Add real data mapping
        // TODO : add real content
        $component->addChild('Fake content');
    }

    public function applyStyles($component, string $blockContent, array $block, WP_Block $instance): void {
        /** @var ImageCompoundComponent $component */
        $component->addDecorator($this->imageDecorator);
    }
    
}