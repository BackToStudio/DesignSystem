<?php

namespace BackTo\DesignSystem\Component\Slider;

use BackTo\DesignSystem\Component\TokenComponent;

class SliderContainer extends TokenComponent
{
	/** @var SlideComponent[] */
	private array $slides = [];

	public function addSlide(SlideComponent $slide): static
	{
		$this->slides[] = $slide;
		return $this;
	}

	public function getSlides(): array
	{
		return $this->slides;
	}

	public function getMarkup(): string
	{
		foreach ($this->slides as $slide) {
			$this->addChild($slide->getMarkup());
		}

		return parent::getMarkup();
	}
}
