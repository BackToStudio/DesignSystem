<?php

namespace BackTo\DesignSystem\Component\Heading;

use BackTo\DesignSystem\BlockEditor\BlockDataMapper\BlockDataMapper;
use BackTo\DesignSystem\Component\Heading\HeadingComponent;
use BackTo\DesignSystem\Component\Heading\HeadingDecorator;
use WP_Block;

class HeadingBlockDataMapper extends BlockDataMapper
{
    const BLOCK_NAME = 'core/heading';
    private HeadingDecorator $headingDecorator;

    public function __construct(
        HeadingDecorator $headingDecorator
    ){
        $this->headingDecorator = $headingDecorator;
    }

    public function getComponent(array $block): HeadingComponent
    {
        return new HeadingComponent();
    }

    public function applyData($component, string $blockContent, array $block, WP_Block $instance): void {
        /** @var HeadingComponent $component */
        if( isset($block['attrs']['level']) ){
            $component->setLevel($block['attrs']['level']);
        }

        // TODO : add real content
        $component->addChild('Fake content');
    }

    public function applyStyles($component, string $blockContent, array $block, WP_Block $instance): void {
        /** @var HeadingComponent $component */
        $component->addDecorator($this->headingDecorator);
    }
    
}