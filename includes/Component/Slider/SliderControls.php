<?php

namespace BackTo\DesignSystem\Component\Slider;

use BackTo\DesignSystem\Component\Button\ButtonComponent;
use BackTo\DesignSystem\Component\Svg\SvgFactory;
use BackTo\DesignSystem\Component\TokenComponent;

class SliderControls extends TokenComponent
{
	private ButtonComponent $sliderPrev;
	private ButtonComponent $sliderNext;

	public function __construct(?SvgFactory $svgFactory = null)
	{
		$this->addClass('ds-slider__controls');

		$this->sliderPrev = new ButtonComponent();
		$this->sliderPrev->addClass('is-style-link is-style-icon');
		$this->sliderPrev->addClass('ds-slider__prev');
		if ($svgFactory !== null) {
			$arrowLeftComponent = $svgFactory->getComponent('arrow_left');
			$this->sliderPrev->addChild($arrowLeftComponent->getMarkup());
		}
		$this->sliderPrev->addChild('<span class="sr-only">Previous</span>');

		$this->sliderNext = new ButtonComponent();
		$this->sliderNext->addClass('is-style-link is-style-icon');
		$this->sliderNext->addClass('ds-slider__next');
		if ($svgFactory !== null) {
			$arrowRightComponent = $svgFactory->getComponent('arrow_right');
			$this->sliderNext->addChild($arrowRightComponent->getMarkup());
		}
		$this->sliderNext->addChild('<span class="sr-only">Next</span>');
	}

	public function getSliderPrev(): ButtonComponent
	{
		return $this->sliderPrev;
	}

	public function getSliderNext(): ButtonComponent
	{
		return $this->sliderNext;
	}

	public function getMarkup(): string
	{
		$this->addChild($this->sliderPrev->getMarkup());
		$this->addChild($this->sliderNext->getMarkup());

		return parent::getMarkup();
	}
}
