<?php

namespace BackTo\DesignSystem\BlockEditor;

use BackTo\Framework\Contracts\Hooks;
use BackTo\DesignSystem\Component\TokenComponent;
use WP_Block;

class BlockDataMapper implements Hooks
{
    const BLOCK_NAME = 'custom-block';

    public function hooks(): void
    {
        add_action('render_block', [$this, 'render'], 10, 3);
    }

    public function render(string $blockContent, array $block, WP_Block $instance): string
    {
        if( $block['blockName'] !== self::BLOCK_NAME ) {
            return $blockContent;
        }

        $component = $this->getComponent($block);
        
        $this->applyData($component, $blockContent, $block, $instance);
        $this->applyStyles($component, $blockContent, $block, $instance);
        $this->applyInteractions($component, $blockContent, $block, $instance);

        return $component->getMarkup();
    }

    public function getComponent(array $block): TokenComponent
    {
        return new TokenComponent();
    }

    public function applyData($component, string $blockContent, array $block, WP_Block $instance): void {}

    public function applyStyles($component, string $blockContent, array $block, WP_Block $instance): void {}

    public function applyInteractions($component, string $blockContent, array $block, WP_Block $instance): void {}
    
}