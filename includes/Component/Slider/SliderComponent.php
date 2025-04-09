<?php

namespace BackTo\DesignSystem\Component\Slider;

use BackTo\DesignSystem\Component\Slider\SliderSettings;
use BackTo\DesignSystem\Component\TokenComponent;

class SliderComponent extends TokenComponent
{
	private ?SliderSettings $mobile = null;
	private ?SliderSettings $desktop = null;
	private TokenComponent $slideContainer;
	private TokenComponent $sliderControls;
	private TokenComponent $sliderPagination;
	private string $id;

	public function __construct()
	{
		$uniqueId = wp_generate_uuid4();
		$this->setId('slider-' . $uniqueId);
		$this->addAttribute('id', $this->getId());
		$this->addClass('wp-block-slider');

		$this->mobile = new SliderSettings();
		$this->desktop = new SliderSettings();

		$this->slideContainer = new SliderContainer();
		$this->slideContainer->addClass('wp-block-slider__slides');

		$this->sliderControls = new SliderControls();
		$this->sliderControls->addClass('wp-block-slider__controls');

		$this->sliderPagination = new TokenComponent();
		$this->sliderPagination->addClass('wp-block-slider__pagination');
	}

	public function setId(string $id): static
	{
		$this->id = $id;
		return $this;
	}

	public function getId(): string
	{
		return $this->id;
	}

	public function setMobileSettings(SliderSettings $settings): static
	{
		$this->mobile = $settings;
		return $this;
	}

	public function getMobileSettings(): SliderSettings
	{
		return $this->mobile;
	}

	public function setDesktopSettings(SliderSettings $desktopSettings): static
	{
		$this->desktop = $desktopSettings;
		return $this;
	}

	public function getDesktopSettings(): SliderSettings
	{
		return $this->desktop;
	}

	public function getSlidesContainer(): SliderContainer
	{
		return $this->slideContainer;
	}

	public function getSliderControls(): SliderControls
	{
		return $this->sliderControls;
	}

	public function getSliderPagination(): TokenComponent
	{
		return $this->sliderPagination;
	}

	public function getMarkup(): string
	{
		$hasSlides = count($this->getSlidesContainer()->getSlides()) > 1;

		if (!$hasSlides) {
			return '';
		}

		$this->addChild($this->getSlidesContainer()->getMarkup());

		$hasMobileControls =
			$this->getMobileSettings()->enable() &&
			$this->getMobileSettings()->hasControls();
		$hasDesktopControls =
			$this->getDesktopSettings()->enable() &&
			$this->getDesktopSettings()->hasControls();

		if (($hasMobileControls || $hasDesktopControls) && $hasSlides) {
			$this->addChild($this->getSliderControls()->getMarkup());
		}

		$hasMobilePagination =
			$this->getMobileSettings()->enable() &&
			$this->getMobileSettings()->hasPagination();
		$hasDesktopPagination =
			$this->getDesktopSettings()->enable() &&
			$this->getDesktopSettings()->hasPagination();

		if (($hasMobilePagination || $hasDesktopPagination) && $hasSlides) {
			$this->addChild($this->getSliderPagination()->getMarkup());
		}

		return parent::getMarkup();
	}
}
