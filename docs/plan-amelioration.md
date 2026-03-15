# Plan d'amélioration du Design System BackTo Studio

## Principe directeur

**Les composants sont framework-agnostiques.** Toute intégration WordPress reste dans `BlockEditor/`.

---

## Phase 1 — Corriger les fondations (bugs critiques)

### 1.1 Corriger `FakeButtonDecorator` (crash à l'exécution)
- **Fichier :** `includes/Component/Fake/FakeButtonDecorator.php`
- `$this->ringConfig` → `$this->ringColorDecorator` (ligne 52)
- `$this->borderConfig` → `$this->borderColorDecorator` (ligne 57)
- `$this->textColorConfig` → `$this->textColorDecorator` (ligne 64)
- `$className[]` → `$classNames[]` (ligne 73)

### 1.2 Corriger `FakeButtonComponent`
- **Fichier :** `includes/Component/Fake/FakeButtonComponent.php`
- Retourne `'Hello World'` au lieu d'un vrai markup HTML. Implémenter un vrai rendu ou supprimer.

### 1.3 Corriger `FigCaptionComponent` (conflit de type)
- **Fichier :** `includes/Component/FigCaption/FigCaptionComponent.php`
- `private string $children = ''` entre en conflit avec `private array $children = []` du parent `TokenComponent`. Aligner le type ou utiliser un nom de propriété différent.

### 1.4 Corriger `FigureComponent` (visibilité)
- **Fichier :** `includes/Component/Figure/FigureComponent.php`
- `private string $tagName` → `protected string $tagName` pour respecter l'héritage de `TokenComponent`.

### 1.5 Renommer le fichier `CoumpoundDecorator.php`
- **Fichier :** `includes/Contracts/CoumpoundDecorator.php` → `CompoundDecorator.php`

---

## Phase 2 — Découpler WordPress des composants

### 2.1 Supprimer `wp_generate_uuid4()` de `SliderComponent`
- **Fichier :** `includes/Component/Slider/SliderComponent.php`, ligne 19
- Remplacer par un générateur d'UUID PHP natif ou injecter l'ID via un setter :
  ```php
  // Option A : PHP natif
  $this->setId('slider-' . bin2hex(random_bytes(16)));

  // Option B : injection
  public function setId(string $id): static { ... }
  ```

### 2.2 Supprimer les préfixes CSS `wp-block-*` des composants
- **Fichiers :** `SliderComponent.php` (ligne 22), `SliderControls.php` (lignes 16, 20, 29)
- Remplacer par des noms de classe génériques (ex: `ds-slider`, `ds-slider__controls`)
- Les classes `wp-block-*` seront ajoutées dans la couche `BlockEditor/` lors du mapping.

### 2.3 Déplacer les BlockDataMappers dans `BlockEditor/`
Les fichiers suivants sont des mappers WordPress mais vivent dans `Component/` :

| Fichier actuel | Destination |
|---|---|
| `Component/Heading/HeadingBlockDataMapper.php` | `BlockEditor/Heading/HeadingBlockDataMapper.php` |
| `Component/Paragraph/ParagraphBlockDataMapper.php` | `BlockEditor/Paragraph/ParagraphBlockDataMapper.php` |
| `Component/Image/ImageCompoundBlockDataMapper.php` | `BlockEditor/Image/ImageCompoundBlockDataMapper.php` |
| `Component/List/ListBlockDataMapper.php` | `BlockEditor/List/ListBlockDataMapper.php` |
| `Component/ListItem/ListIemBlockDataMapper.php` | `BlockEditor/ListItem/ListItemBlockDataMapper.php` |
| `Component/Fake/FakeButtonBlockDataMapper.php` | `BlockEditor/Fake/FakeButtonBlockDataMapper.php` |

> Note : corriger aussi le typo `ListIemBlockDataMapper` → `ListItemBlockDataMapper`.

---

## Phase 3 — Gérer correctement le HTML

### 3.1 Support des void elements dans `TokenComponent`
- **Fichier :** `includes/Component/TokenComponent.php`, lignes 147-157
- Ajouter une propriété `protected bool $selfClosing = false` et adapter `getMarkup()` :
  ```php
  public function getMarkup(): string
  {
      $attributes = $this->prepareAttributes();
      $tagName = $this->getTagName();

      if ($this->selfClosing) {
          return '<' . $tagName . ' ' . $attributes . '/>';
      }

      $markup = '<' . $tagName . ' ' . $attributes . '>';
      $markup .= join('', $this->getChildren());
      $markup .= '</' . $tagName . '>';
      return $markup;
  }
  ```

### 3.2 Marquer `ImageComponent` comme self-closing
- `protected bool $selfClosing = true;`

---

## Phase 4 — Renforcer l'accessibilité

### 4.1 Rendre `alt` obligatoire sur `ImageComponent`
- Lancer une exception si `getMarkup()` est appelé sans `alt` défini (même une chaîne vide explicite pour les images décoratives via `setAlt('')`).

### 4.2 Ajouter `aria-disabled` sur `ButtonComponent`
- Quand `disable()` est appelé, ajouter automatiquement `aria-disabled="true"`.

### 4.3 Valider les attributs requis
- `LinkComponent` : avertir ou lever une exception si `href` est vide au moment du rendu.
- `HeadingComponent` : déjà correct (validation 1-6) — servir de modèle pour les autres.

---

## Phase 5 — Ajouter les tests

### 5.1 Setup PHPUnit
- Ajouter `phpunit/phpunit` en dépendance dev dans `composer.json`
- Créer `phpunit.xml` à la racine
- Créer le dossier `tests/` avec la structure miroir de `includes/`

### 5.2 Tests unitaires prioritaires
Par ordre d'importance :

| Composant | Tests à écrire |
|---|---|
| `TokenComponent` | addClass, removeClass, addAttribute, getMarkup, escapeAttribute, self-closing |
| `ButtonComponent` | enable/disable, aria-disabled, rendu HTML |
| `HeadingComponent` | validation level 1-6, exception hors limites, rendu sémantique |
| `ImageComponent` | self-closing, alt obligatoire, rendu sans src |
| `ImageCompoundComponent` | composition figure/image/link/caption, rendu conditionnel |
| `SliderComponent` | settings mobile/desktop, rendu conditionnel contrôles/pagination |
| `FakeButtonDecorator` | composition des couleurs, getClassName() |
| Color Decorators | chaque décorateur retourne la bonne classe Tailwind |
| Typography Decorators | idem |

### 5.3 Objectif couverture
- Viser **90%+ sur `Component/`** et **80%+ sur `Foundation/`**

---

## Phase 6 — Compléter la bibliothèque de composants

D'après le README, les composants suivants manquent :

| Composant | Priorité | Description |
|---|---|---|
| `InputComponent` | Haute | Champ de saisie (text, email, password, etc.) — void element |
| `SelectComponent` | Haute | Liste déroulante avec options |
| `FormComponent` | Haute | Conteneur de formulaire |
| `CheckboxComponent` | Moyenne | Case à cocher avec label |
| `RadioComponent` | Moyenne | Bouton radio avec label |
| `InnerContainerComponent` | Moyenne | Conteneur interne |
| `ColumnComponent` | Basse | Colonne dans une grille |
| `ColumnsComponent` | Basse | Conteneur de colonnes |
| `CoverComponent` | Basse | Section avec image de fond |

Chaque nouveau composant doit :
- Étendre `TokenComponent`
- Être framework-agnostique
- Avoir ses tests unitaires
- Gérer correctement les void elements si applicable

---

## Phase 7 — Outillage et qualité

### 7.1 Analyse statique
- Ajouter **PHPStan** (niveau 6 minimum) dans `composer.json`
- Créer `phpstan.neon` à la racine

### 7.2 Linting / Formatting
- Ajouter **PHP-CS-Fixer** avec les règles PSR-12
- Créer `.php-cs-fixer.php`

### 7.3 CI/CD
- Ajouter un workflow GitHub Actions :
  - PHPUnit
  - PHPStan
  - PHP-CS-Fixer (check)

---

## Ordre d'exécution recommandé

```
Phase 1 (bugs critiques)     ████████░░  ~1 jour
Phase 2 (découplage WP)      ████████░░  ~1 jour
Phase 3 (void elements)      ████░░░░░░  ~0.5 jour
Phase 4 (accessibilité)      ████░░░░░░  ~0.5 jour
Phase 5 (tests)              ████████████ ~2-3 jours
Phase 6 (nouveaux composants)████████████ ~3-5 jours
Phase 7 (outillage)          ██████░░░░  ~1 jour
```

**Les phases 1 à 4 sont les fondations — à faire en premier, dans l'ordre.**
La phase 5 (tests) devrait démarrer dès la phase 2 terminée pour valider chaque changement.
