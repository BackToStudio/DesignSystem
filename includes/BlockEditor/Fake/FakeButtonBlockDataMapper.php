<?php

namespace BackTo\DesignSystem\BlockEditor\Fake;

use BackTo\DesignSystem\BlockEditor\ComponentDataMapper;
use BackTo\DesignSystem\Component\Fake\FakeButtonComponent;
use BackTo\DesignSystem\Component\Fake\FakeButtonDecorator;
use BackTo\DesignSystem\Component\TokenComponent;
use WP_Block;

class FakeButtonBlockDataMapper extends ComponentDataMapper
{
    const BLOCK_NAME = 'core/button';
    private FakeButtonDecorator $fakeButtonDecorator;

    public function __construct(FakeButtonDecorator $fakeButtonDecorator)
    {
        $this->fakeButtonDecorator = $fakeButtonDecorator;
    }

    public function getComponent(array $block): TokenComponent
    {
        return new FakeButtonComponent();
    }

    public function applyData($component, string $blockContent, array $block, WP_Block $instance): void
    {
    }

    public function applyStyles($component, string $blockContent, array $block, WP_Block $instance): void
    {
        /** @var FakeButtonComponent $component */
        $color = $block['attrs']['color'] ?? 'red';
        $this->fakeButtonDecorator->setColor($color);
        $component->addDecorator($this->fakeButtonDecorator);
    }
}
