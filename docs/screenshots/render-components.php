<?php

/**
 * Renders each component as a standalone HTML file for screenshot capture.
 * Usage: php docs/screenshots/render-components.php
 */

require_once __DIR__ . '/../../vendor/autoload.php';

use BackTo\DesignSystem\Component\Button\ButtonComponent;
use BackTo\DesignSystem\Component\Heading\HeadingComponent;
use BackTo\DesignSystem\Component\Paragraph\ParagraphComponent;
use BackTo\DesignSystem\Component\Link\LinkComponent;
use BackTo\DesignSystem\Component\Image\ImageComponent;
use BackTo\DesignSystem\Component\FigCaption\FigCaptionComponent;
use BackTo\DesignSystem\Component\Figure\FigureComponent;
use BackTo\DesignSystem\Component\Image\ImageCompoundComponent;
use BackTo\DesignSystem\Component\List\ListComponent;
use BackTo\DesignSystem\Component\ListItem\ListItemComponent;

$outputDir = __DIR__ . '/html';

function wrapHtml(string $componentName, string $body): string
{
    return <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{$componentName}</title>
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                padding: 24px;
                background: #ffffff;
                color: #1a1a1a;
            }
            .component-label {
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                color: #6b7280;
                margin-bottom: 12px;
            }
            .component-wrapper {
                display: flex;
                flex-direction: column;
                gap: 16px;
            }
            .variant {
                display: flex;
                align-items: center;
                gap: 12px;
            }
            .variant-label {
                font-size: 10px;
                color: #9ca3af;
                min-width: 80px;
                text-align: right;
            }
            /* Base component styles (unopinionated defaults) */
            button {
                padding: 8px 16px;
                border: 1px solid #d1d5db;
                border-radius: 6px;
                background: #f9fafb;
                font-size: 14px;
                cursor: pointer;
            }
            button:hover { background: #f3f4f6; }
            button[disabled] {
                opacity: 0.5;
                cursor: not-allowed;
            }
            a { color: #2563eb; text-decoration: underline; }
            img { max-width: 200px; border-radius: 4px; }
            figure { display: inline-block; }
            figcaption { font-size: 12px; color: #6b7280; margin-top: 4px; }
            ul, ol { padding-left: 20px; }
            li { margin-bottom: 4px; }
        </style>
    </head>
    <body>
        <div class="component-label">{$componentName}</div>
        <div class="component-wrapper">
            {$body}
        </div>
    </body>
    </html>
    HTML;
}

// --- Button ---
$variants = [];

$btn = new ButtonComponent();
$btn->addChild('Default Button');
$variants[] = '<div class="variant"><span class="variant-label">default</span>' . $btn->getMarkup() . '</div>';

$btnSubmit = new ButtonComponent();
$btnSubmit->setType('submit');
$btnSubmit->addChild('Submit');
$variants[] = '<div class="variant"><span class="variant-label">type=submit</span>' . $btnSubmit->getMarkup() . '</div>';

$btnDisabled = new ButtonComponent();
$btnDisabled->addChild('Disabled');
$btnDisabled->disable();
$variants[] = '<div class="variant"><span class="variant-label">disabled</span>' . $btnDisabled->getMarkup() . '</div>';

file_put_contents($outputDir . '/button.html', wrapHtml('ButtonComponent', implode("\n", $variants)));

// --- Heading ---
$variants = [];
for ($i = 1; $i <= 6; $i++) {
    $h = new HeadingComponent();
    $h->setLevel($i);
    $h->addChild("Heading Level {$i}");
    $variants[] = '<div class="variant"><span class="variant-label">h' . $i . '</span>' . $h->getMarkup() . '</div>';
}
file_put_contents($outputDir . '/heading.html', wrapHtml('HeadingComponent', implode("\n", $variants)));

// --- Paragraph ---
$p = new ParagraphComponent();
$p->addChild('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
file_put_contents($outputDir . '/paragraph.html', wrapHtml('ParagraphComponent', $p->getMarkup()));

// --- Link ---
$variants = [];

$link = new LinkComponent();
$link->setHref('https://example.com');
$link->addChild('Simple link');
$variants[] = '<div class="variant"><span class="variant-label">default</span>' . $link->getMarkup() . '</div>';

$linkBlank = new LinkComponent();
$linkBlank->setHref('https://example.com');
$linkBlank->setTarget('_blank');
$linkBlank->setRel('noopener noreferrer');
$linkBlank->addChild('External link (target=_blank)');
$variants[] = '<div class="variant"><span class="variant-label">external</span>' . $linkBlank->getMarkup() . '</div>';

file_put_contents($outputDir . '/link.html', wrapHtml('LinkComponent', implode("\n", $variants)));

// --- Image ---
$img = new ImageComponent();
$img->setSrc('https://picsum.photos/200/120')->setAlt('Sample image')->setTitle('A sample image');
file_put_contents($outputDir . '/image.html', wrapHtml('ImageComponent', $img->getMarkup()));

// --- Figure + FigCaption ---
$fig = new FigureComponent();
$imgInner = new ImageComponent();
$imgInner->setSrc('https://picsum.photos/200/120')->setAlt('Figure image');
$fc = new FigCaptionComponent();
$fc->setCaption('This is a figure caption');
$fig->addChild($imgInner->getMarkup());
$fig->addChild($fc->getMarkup());
file_put_contents($outputDir . '/figure.html', wrapHtml('FigureComponent + FigCaptionComponent', $fig->getMarkup()));

// --- ImageCompoundComponent ---
$compound = new ImageCompoundComponent();
$compound->getImageComponent()->setSrc('https://picsum.photos/200/120')->setAlt('Compound image');
$compound->getFigCaptionComponent()->setCaption('Image with link and caption');
$compound->getLinkComponent()->setHref('https://example.com');
file_put_contents($outputDir . '/image-compound.html', wrapHtml('ImageCompoundComponent', $compound->getMarkup()));

// --- List (unordered) ---
$ul = new ListComponent();
$li1 = new ListItemComponent();
$li1->addChild('First item');
$li2 = new ListItemComponent();
$li2->addChild('Second item');
$li3 = new ListItemComponent();
$li3->addChild('Third item');
$ul->addChild($li1->getMarkup());
$ul->addChild($li2->getMarkup());
$ul->addChild($li3->getMarkup());

$ol = new ListComponent();
$ol->ordered(true);
$oli1 = new ListItemComponent();
$oli1->addChild('Step one');
$oli2 = new ListItemComponent();
$oli2->addChild('Step two');
$oli3 = new ListItemComponent();
$oli3->addChild('Step three');
$ol->addChild($oli1->getMarkup());
$ol->addChild($oli2->getMarkup());
$ol->addChild($oli3->getMarkup());

$body = '<div class="variant"><span class="variant-label">unordered</span>' . $ul->getMarkup() . '</div>';
$body .= '<div class="variant"><span class="variant-label">ordered</span>' . $ol->getMarkup() . '</div>';
file_put_contents($outputDir . '/list.html', wrapHtml('ListComponent', $body));

echo "HTML files generated in {$outputDir}/\n";
$files = glob($outputDir . '/*.html');
foreach ($files as $file) {
    echo "  - " . basename($file) . "\n";
}
