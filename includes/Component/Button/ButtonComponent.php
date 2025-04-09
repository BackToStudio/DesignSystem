<?php

namespace BackTo\DesignSystem\Component\Button;

use BackTo\DesignSystem\Component\TokenComponent;

class ButtonComponent extends TokenComponent
{
    private string $type = 'button';
    private bool $disabled = false;

	public function setType(string $type): void
	{
		$this->type = $type;
    }

    public function disable(): void
    {
        $this->disabled = true;
    }

    public function enable(): void
    {
        $this->disabled = false;
    }   
    

	public function getMarkup(): string
	{
        if( $this->disabled ){
            $this->addAttribute('disabled', 'disabled');
        }

        $this->addAttribute('type', $this->type);

		$this->setTagName('button');

		return parent::getMarkup();
	}
}
