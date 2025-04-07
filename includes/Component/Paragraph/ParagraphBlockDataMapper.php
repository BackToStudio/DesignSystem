<?php

namespace BackTo\DesignSystem\BlockEditor\BlockDataMapper;

use BackTo\DesignSystem\Component\Paragraph\ParagraphComponent;
use BackTo\DesignSystem\Component\Paragraph\ParagraphDecorator;
use BackTo\DesignSystem\Component\TokenComponent;
use WP_Block;

class ParagraphBlockDataMapper extends BlockDataMapper
{
    const BLOCK_NAME = 'core/paragraph';
    private ParagraphDecorator $paragraphDecorator;

    public function __construct(
        ParagraphDecorator $paragraphDecorator
    ){
        $this->paragraphDecorator = $paragraphDecorator;
    }

    public function getComponent(array $block): TokenComponent
    {
        return new ParagraphComponent();
    }

    public function applyData($component, string $blockContent, array $block, WP_Block $instance): void {
        /** @var ParagraphComponent $component */
        // TODO : add content
        $component->addChild('Fake content');
    }

    public function applyStyles($component, string $blockContent, array $block, WP_Block $instance): void {
        /** @var ParagraphComponent $component */
        $component->addDecorator($this->paragraphDecorator);
    }
    
}