<?php

namespace BackTo\DesignSystem\Component\Icon;

use Exception;
use PQP\Components\Icons\ArrowBottomIcon;
use PQP\Components\Icons\ArrowLeftIcon;
use PQP\Components\Icons\ArrowRightIcon;
use PQP\Components\Icons\FacebookIcon;
use PQP\Components\Icons\LinkedinIcon;
use PQP\Components\Icons\YoutubeIcon;
use PQP\Components\Icons\BurgerMenuIcon;
use PQP\Components\Icons\CloseIcon;
use PQP\Components\Icons\ArrowBottomDetailsIcon;
use PQP\Components\Icons\MonogramPqpIcon;
use PQP\Components\Icons\IsStyleCursorLeftIcon;
use PQP\Components\Icons\IsStyleCursorRightIcon;
use PQP\Components\Icons\LogoPqpIcon;
use PQP\Components\Icons\LogoPqpFullWhiteIcon;
use PQP\Components\Icons\ArrowTopIcon;
use BackTo\DesignSystem\Component\TokenComponent;

class IconComponent extends TokenComponent
{
	private string $icon = '';

	public function __construct(string $icon)
	{
		$this->icon = $icon;
	}

	public function getIcon(): string
	{
		return $this->icon;
	}

	public function getMarkup(): string
	{
		$iconComponents = [
			'arrow_bottom' => ArrowBottomIcon::class,
			'arrow_right' => ArrowRightIcon::class,
			'arrow_left' => ArrowLeftIcon::class,
			'arrow_top' => ArrowTopIcon::class,
			'facebook' => FacebookIcon::class,
			'linkedin' => LinkedinIcon::class,
			'youtube' => YoutubeIcon::class,
			'burger_menu' => BurgerMenuIcon::class,
			'close' => CloseIcon::class,
			'arrow_bottom_details' => ArrowBottomDetailsIcon::class,
			'monogram_pqp' => MonogramPqpIcon::class,
			'cursor_left' => IsStyleCursorLeftIcon::class,
			'cursor_right' => IsStyleCursorRightIcon::class,
			'logo_pqp' => LogoPqpIcon::class,
			'logo_pqp_full_white' => LogoPqpFullWhiteIcon::class,
		];

		if (!array_key_exists($this->getIcon(), $iconComponents)) {
			throw new Exception(
				sprintf(
					'The icon %s does not exist in IconComponent. If you want to use a new icon, please add this icon in <code>IconComponent</code>',
					$this->getIcon()
				)
			);
		}

		$iconClassName = $iconComponents[$this->getIcon()];
		$iconComponent = new $iconClassName();

		foreach ($this->getClasses() as $class) {
			$iconComponent->addClass($class);
		}

		foreach ($this->getAttributes() as $attribute => $value) {
			$iconComponent->addAttribute($attribute, $value);
		}

		return $iconComponent->getMarkup();
	}
}
