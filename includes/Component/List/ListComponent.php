<?php

namespace BackTo\DesignSystem\Component\List;

use BackTo\DesignSystem\Component\TokenComponent;

class ListComponent extends TokenComponent
{
    private bool $ordered = false;
	private int $start = 1;
	protected string $tagName = 'ul';

	public function ordered(bool $ordered = true): void
	{
		$this->ordered = $ordered;
	}

	public function isOrdered(): bool
	{
		return $this->ordered;
	}

	public function setStart(int $start): void
	{
		$this->start = $start;
	}

	public function getStart(): int
	{
		return $this->start;
	}

	public function getMarkup(): string
	{
		$start = $this->getStart();

		if ($this->isOrdered()) {
			$this->setTagName('ol');
		}
		
		if ($start > 1) {
			$this->addAttribute('start', $start);
		}

		return parent::getMarkup();
	}
}