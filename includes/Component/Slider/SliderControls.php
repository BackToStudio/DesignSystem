<?php

namespace BackTo\DesignSystem\Component\Slider;

use BackTo\DesignSystem\Component\Button\ButtonComponent;
use BackTo\DesignSystem\Component\Icon\IconComponent;
use BackTo\DesignSystem\Component\TokenComponent;

class SliderControls extends TokenComponent
{
	private ButtonComponent $sliderPrev;
	private ButtonComponent $sliderNext;

	public function __construct()
	{
		$this->addClass('wp-block-slider__controls');

		$this->sliderPrev = new ButtonComponent();
		$this->sliderPrev->addClass('is-style-link is-style-icon');
		$this->sliderPrev->addClass('wp-block-slider__prev');
		// $this->sliderPrev->addClass('!static');
		$this->sliderPrev->addChild((new IconComponent('arrow_left'))->getMarkup());
		$this->sliderPrev->addChild('<span class="sr-only">Previous</span>');

		$this->sliderNext = new ButtonComponent();
		$this->sliderNext->addClass('is-style-link is-style-icon');
		$this->sliderNext->addClass('wp-block-slider__next');
		// $this->sliderNext->addClass('!static');
		$this->sliderNext->addChild(
			(new IconComponent('arrow_right'))->getMarkup()
		);
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
