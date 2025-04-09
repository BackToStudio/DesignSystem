## Example of config/svg.php

```php
return [
    'arrow_bottom' => ArrowBottomIcon::class,
    'arrow_right' => ArrowRightIcon::class,
    'arrow_left' => ArrowLeftIcon::class,
    'facebook' => FacebookIcon::class,
    'linkedin' => LinkedinIcon::class,
    'youtube' => YoutubeIcon::class,
    'burger_menu' => BurgerMenuIcon::class,
    'close' => CloseIcon::class,
    'arrow_bottom_details' => ArrowBottomDetailsIcon::class,
    'monogram_pqp' => MonogramPqpIcon::class,
    'quote' => QuoteIcon::class,
    'check' => CheckIcon::class,
    'youtube_player' => YoutubePlayerIcon::class,
    'logo_pqp' => LogoPqpIcon::class,
    'wave' => WavePatternIcon::class,
];
```

## How to get SVG component?

```php
$svgFactory = new SvgFactory();
$svgFactory->getComponent('arrow_bottom');
```