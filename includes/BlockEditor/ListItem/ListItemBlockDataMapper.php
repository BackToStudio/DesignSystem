<?php

namespace BackTo\DesignSystem\BlockEditor\ListItem;

use BackTo\DesignSystem\BlockEditor\ComponentDataMapper;
use BackTo\DesignSystem\Component\ListItem\ListItemComponent;
use BackTo\DesignSystem\Component\TokenComponent;
use WP_Block;

class ListItemBlockDataMapper extends ComponentDataMapper
{
    const BLOCK_NAME = 'core/list-item';

    public function getComponent(array $block): TokenComponent
    {
        return new ListItemComponent();
    }

    public function applyData($component, string $blockContent, array $block, WP_Block $instance): void
    {
        /** @var ListItemComponent $component */
        // TODO : add real content
        $component->addChild('Fake content');
    }

    public function applyStyles($component, string $blockContent, array $block, WP_Block $instance): void
    {
        /** @var ListItemComponent $component */

        if (isset($block['attrs']['className'])) {
            $component->addClass($block['attrs']['className']);
        }
    }
}
