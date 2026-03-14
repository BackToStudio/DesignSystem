<?php

namespace BackTo\DesignSystem\BlockEditor\ListBlock;

use BackTo\DesignSystem\BlockEditor\ComponentDataMapper;
use BackTo\DesignSystem\Component\TokenComponent;
use WP_Block;

class ListBlockDataMapper extends ComponentDataMapper
{
    const BLOCK_NAME = 'core/list';

    /** @var \BackTo\DesignSystem\Component\List\ListDecorator */
    private $listDecorator;

    public function __construct($listDecorator)
    {
        $this->listDecorator = $listDecorator;
    }

    public function getComponent(array $block): TokenComponent
    {
        return new \BackTo\DesignSystem\Component\List\ListComponent();
    }

    public function applyData($component, string $blockContent, array $block, WP_Block $instance): void
    {
        if (isset($block['attrs']['ordered'])) {
            $component->ordered($block['attrs']['ordered']);
        }

        if (isset($block['attrs']['start'])) {
            $component->setStart($block['attrs']['start']);
        }

        // TODO : add real content
        $component->addChild('Fake content');
    }

    public function applyStyles($component, string $blockContent, array $block, WP_Block $instance): void
    {
        $component->addDecorator($this->listDecorator);

        // TODO : add has_parent_layout and parent_layout_constrained
        // TODO : add condition to add align decorator

        if (isset($block['attrs']['className'])) {
            $component->addClass($block['attrs']['className']);
        }
    }
}
