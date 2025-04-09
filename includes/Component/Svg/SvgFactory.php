<?php

namespace BackTo\DesignSystem\Component\Svg;

use Exception;

class SvgFactory
{
    private array $svgList = [];

    public function __construct($svgList)
    {
        $this->svgList = $svgList;
    }

    public function getSvgList(): array
    {
        return $this->svgList;
    }

    public function getSvg(string $name): string
    {
        if (!array_key_exists($name, $this->getSvgList())) {
			throw new Exception(
				sprintf(
					'The svg "%s" does not exist. If you want to use a new SVG file, please add this SVG in <code>/config/svg.php</code>',
					$name
				)
			);
		}

        return $this->svgList[$name];
    }

    public function getComponent(string $name): SvgComponent
    {

		$svgClassName = $this->getSvgList()[$name];
		$svgComponent = new $svgClassName();

        return $svgComponent;
    }
}