<?php

namespace BackTo\DesignSystem\Component\Slider;

class SliderSettings
{
	private bool $isEnable = false;
	private bool $hasPagination = false;
	private bool $hasControls = false;
	private bool $isAutoplay = false;
	private int $perPage = 1;

	public function enable(): self
	{
		$this->isEnable = true;

		return $this;
	}

	public function disable(): self
	{
		$this->isEnable = false;

		return $this;
	}

	public function isEnable(): bool
	{
		return $this->isEnable;
	}

	public function withPagination(): self
	{
		$this->hasPagination = true;

		return $this;
	}

	public function hasPagination(): bool
	{
		return $this->hasPagination;
	}

	public function withControls(): self
	{
		$this->hasControls = true;

		return $this;
	}

	public function hasControls(): bool
	{
		return $this->hasControls;
	}

	public function withAutoplay(): self
	{
		$this->isAutoplay = true;

		return $this;
	}

	public function hasAutoplay(): bool
	{
		return $this->isAutoplay;
	}

	public function setPerPage(int $perPage): self
	{
		$this->perPage = $perPage;

		return $this;
	}

	public function getPerPage(): int
	{
		return $this->perPage;
	}

	public function toArray(): array
	{
		return [
			'isEnable' => $this->isEnable(),
			'hasPagination' => $this->hasPagination(),
			'hasControls' => $this->hasControls(),
			'hasAutoplay' => $this->hasAutoplay(),
			'perPage' => $this->getPerPage(),
		];
	}
}
