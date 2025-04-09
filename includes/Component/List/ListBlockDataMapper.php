<?php

namespace BackTo\DesignSystem\BlockEditor\BlockDataMapper;

use BackTo\DesignSystem\Component\List\ListComponent;
use BackTo\DesignSystem\Component\List\ListDecorator;
use BackTo\DesignSystem\Component\TokenComponent;
use WP_Block;

class ListBlockDataMapper extends BlockDataMapper
{
    const BLOCK_NAME = 'core/list';
    private ListDecorator $listDecorator;

    public function __construct(
        ListDecorator $listDecorator
    ){
        $this->listDecorator = $listDecorator;
    }

    public function getComponent(array $block): TokenComponent
    {
        return new ListComponent();
    }

    public function applyData($component, string $blockContent, array $block, WP_Block $instance): void {
        /** @var ListComponent $component */

        // TODO : add content

        // TODO : add has_parent_layout and parent_layout_constrained
        // TODO : add condition to add align decorator
        $align = $block['attrs']['align'] ?? 'default';

        if (isset($block['attrs']['ordered'])) {
            $component->ordered($block['attrs']['ordered']);
        }

        if (isset($block['attrs']['type'])) {
            $component->setType($block['attrs']['type']);
        }
    
        if (isset($block['attrs']['start'])) {
            $component->setStart($block['attrs']['start']);
        }
    
        if (isset($block['attrs']['className'])) {
            $component->addClass($block['attrs']['className']);
        }

        // TODO : add real content
        $component->addChild('Fake content');
    }

    public function applyStyles($component, string $blockContent, array $block, WP_Block $instance): void {
        /** @var ListComponent $component */
        $component->addDecorator($this->listDecorator);
    }
    

}