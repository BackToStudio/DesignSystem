<?php

namespace BackTo\DesignSystem\Component\List;

use BackTo\DesignSystem\Component\TokenComponent;

class ListComponent extends TokenComponent
{
    private bool $ordered = false;
	private string $type = 'disc';
	private int $start = 1;

	public function ordered(bool $ordered = true): void
	{
		$this->ordered = $ordered;
	}

	public function isOrdered(): bool
	{
		return $this->ordered;
	}

	public function setType(string $type): void
	{
		$this->type = $type;
	}

	public function getType(): string
	{
		return $this->type;
	}

	public function setStart(int $start): void
	{
		$this->start = $start;
	}

	public function getStart(): int
	{
		return $this->start;
	}

    public function __construct()
    {
        $this->setTagName('ul');

        $type = $this->getType();
		$start = $this->getStart();

		if ($this->isOrdered()) {
			$this->setTagName('ol');

			if ($start > 1) {
				$this->addAttribute('start', $start);
			}
		}
    }
}