<?php

namespace BackTo\DesignSystem\BlockEditor\Image;

use BackTo\DesignSystem\BlockEditor\ComponentDataMapper;
use BackTo\DesignSystem\Component\Image\ImageCompoundComponent;
use WP_Block;

class ImageCompoundBlockDataMapper extends ComponentDataMapper
{
    const BLOCK_NAME = 'core/image';

    public function getComponent(array $block): ImageCompoundComponent
    {
        return new ImageCompoundComponent();
    }

    public function applyData($component, string $blockContent, array $block, WP_Block $instance): void
    {
        // TODO : add real data mapping
        $component->addChild('Fake content');
    }

    public function applyStyles($component, string $blockContent, array $block, WP_Block $instance): void
    {
    }
}
