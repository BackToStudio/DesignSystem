# Décorateurs de Couleur

Ce dossier contient les décorateurs de couleur utilisés dans le design system. Les décorateurs permettent d'appliquer dynamiquement des classes CSS de couleur (background, border, texte, etc.) à vos composants, en fonction d'une couleur de base.

## Utilisation des décorateurs de couleur

Pour utiliser les décorateurs de couleur, vous devez instancier les différents décorateurs (par exemple : `BackgroundColorDecorator`, `BorderColorDecorator`, etc.) et les injecter dans votre composant ou décorateur composé.

### Exemple d'utilisation avec `FakeButtonDecorator`

Supposons que vous souhaitez créer un bouton dont la couleur peut être changée dynamiquement. Voici comment vous pouvez utiliser les décorateurs de couleur, en vous basant sur l'exemple de la classe `FakeButtonDecorator` :

```php
use BackTo\DesignSystem\Foundation\Color\Decorator\BackgroundColorDecorator;
use BackTo\DesignSystem\Foundation\Color\Decorator\BorderColorDecorator;
use BackTo\DesignSystem\Foundation\Color\Decorator\RingColorDecorator;
use BackTo\DesignSystem\Foundation\Color\Decorator\TextColorDecorator;
use BackTo\DesignSystem\Foundation\Color\ComplementaryColor;
use BackTo\DesignSystem\Component\Fake\FakeButtonDecorator;

class FakeButtonDecorator implements CompoundDecorator
{
    private BackgroundColorDecorator $backgroundDecorator;
    private RingColorDecorator $ringColorDecorator;
    private BorderColorDecorator $borderColorDecorator;
    private TextColorDecorator $textColorDecorator;
    private ComplementaryColor $complementaryColor;
    private string $color = 'red';

    public function __construct(
        BackgroundColorDecorator $backgroundDecorator,
        RingColorDecorator $ringColorDecorator,
        BorderColorDecorator $borderColorDecorator,
        TextColorDecorator $textColorDecorator,
        ComplementaryColor $complementaryColor)
    {
        $this->backgroundDecorator = $backgroundDecorator;
        $this->ringColorDecorator = $ringColorDecorator;
        $this->borderColorDecorator = $borderColorDecorator;
        $this->textColorDecorator = $textColorDecorator;
        $this->complementaryColor = $complementaryColor;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getBackgroundColor(): string
    {
        $this->backgroundDecorator->setColor($this->getColor());
        return $this->backgroundDecorator->getClassName();
    }

    public function getRingColor(): string
    {
        return $this->ringConfig->getValue($this->getColor());
    }

    public function getBorderColor(): string
    {
        return $this->borderConfig->getValue($this->getColor());
    }

    public function getTextColor(): string
    {
        $complementColor = $this->complementaryColor->getColorName($this->getColor());
        return $this->textColorConfig->getValue($complementColor);
    }

    public function getClassName(): string
    {
        $classNames = [];
        $classNames[] = $this->getRingColor();
        $classNames[] = $this->getBorderColor();

        $this->backgroundDecorator->setColor($this->getColor());
        $className[] = $this->backgroundDecorator->getClassName();

        $classNames[] = $this->getTextColor();
        
        return join(' ', $classNames);
    }
}
```

### Méthodes principales

- `setColor(string $color)`: Définit la couleur principale à utiliser.
- `getClassName()`: Retourne la liste des classes CSS à appliquer au composant.
- `getBackgroundColor()`, `getBorderColor()`, `getRingColor()`, `getTextColor()`: Retourne la classe CSS correspondante pour chaque type de couleur.

## Ajout de nouveaux décorateurs

Pour ajouter un nouveau décorateur de couleur, créez une nouvelle classe dans le dossier qui implémente la logique souhaitée, puis injectez-la dans vos composants comme montré ci-dessus.

---

N'hésitez pas à consulter les fichiers existants pour plus d'exemples d'implémentation.