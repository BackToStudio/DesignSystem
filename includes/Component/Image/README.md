# ImageComponent

![ImageComponent](../../../docs/screenshots/png/image.png)

## Usage

```php
$image = new ImageComponent();
$image->setSrc('photo.jpg')->setAlt('A landscape photo');
$image->getMarkup();
// <img src="photo.jpg" alt="A landscape photo" />
```

## Accessibility

The `alt` attribute is **required**. An `InvalidArgumentException` is thrown if `setAlt()` is never called.

For decorative images, explicitly set an empty alt:

```php
$image->setAlt(''); // Allowed — marks image as decorative
```

## Options

```php
$image->setTitle('Optional tooltip');
```

## Inherited methods

All [TokenComponent](../TokenComponent.php) methods are available.

---

# ImageCompoundComponent

![ImageCompoundComponent](../../../docs/screenshots/png/image-compound.png)

Composes `FigureComponent`, `ImageComponent`, `LinkComponent`, and `FigCaptionComponent` into a single semantic block.

## Usage

```php
$compound = new ImageCompoundComponent();
$compound->getImageComponent()->setSrc('photo.jpg')->setAlt('Photo');
$compound->getFigCaptionComponent()->setCaption('A beautiful sunset');
$compound->getLinkComponent()->setHref('https://example.com');
$compound->getMarkup();
```

## Conditional rendering

- Returns empty string if no `src` is set
- Link wrapping is only applied if `href` is set
- Caption is only rendered if children are present
