<?php

namespace BackTo\DesignSystem\BlockEditor;

use DOMDocument;
use DOMElement;

class HasInnerHtml
{

    public function getElements(string $html): array
    {
        $dom = new DOMDocument();
        $wrappedHtml = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>' . $html . '</body></html>';

        libxml_use_internal_errors(true);  // Ignorer les erreurs de parsing pour les HTML non bien formés

        $dom->loadHTML($wrappedHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $body = $dom->getElementsByTagName("body")->item(0);

        $elements = [];

        foreach ($body->childNodes as $element) {
            if ($element instanceof DOMElement) {
                $elements[] = $element;
            }
        }

        libxml_clear_errors();  // Nettoyer les erreurs après traitement
        return $elements;
    }

    public function getElement(string $html): ?DOMElement
    {
        $elements = $this->getElements($html);

        $element = current($elements);

        if (empty($element)) {
            return null;
        }

        return $element;
    }

    public function getInnerHtml(string $html): string
    {
        if (trim($html) === '') {
            return '';  // Retourner une chaîne vide si le HTML fourni est vide
        }

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);  // Ignorer les erreurs de parsing pour les HTML non bien formés

        $wrappedHtml = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>' . $html . '</body></html>';

        $dom->loadHTML($wrappedHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $body = $dom->getElementsByTagName("body")->item(0);

        $innerHtml = '';

        if ($body instanceof DOMElement) {
            foreach ($body->childNodes as $element) {
                if ($element instanceof DOMElement) {
                    foreach ($element->childNodes as $child) {
                        $innerHtml .= $dom->saveHTML($child);
                    }
                }
            }
        }

        libxml_clear_errors();  // Nettoyer les erreurs après traitement
        return $innerHtml;
    }

    public function getInnerHtmlFromTagName($html, $tagName): string
    {
        if (trim($html) === '') {
            return '';  // Retourner une chaîne vide si le HTML fourni est vide
        }

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);  // Ignorer les erreurs de parsing pour les HTML non bien formés

        $wrappedHtml = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>' . $html . '</body></html>';

        $dom->loadHTML($wrappedHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $elements = $dom->getElementsByTagName($tagName);

        if ($elements->length > 0) {
            $summary = $elements->item(0);
            return $summary->textContent;
        }

        libxml_clear_errors();
        return '';
    }

    public function getElementFromTagName($html, $tagName): ?DOMElement
    {
        if (trim($html) === '') {
            return null;  // Retourner une chaîne vide si le HTML fourni est vide
        }

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);  // Ignorer les erreurs de parsing pour les HTML non bien formés

        $wrappedHtml = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>' . $html . '</body></html>';

        $dom->loadHTML($wrappedHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $elements = $dom->getElementsByTagName($tagName);

        if ($elements->length > 0) {
            $summary = $elements->item(0);
            return $summary;
        }

        libxml_clear_errors();
        return null;
    }


    public function deleteInnerHtmlFromTagName(string $html, string $tagName)
    {
        if (trim($html) === '') {
            return '';  // Retourner une chaîne vide si le HTML fourni est vide
        }

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);  // Ignorer les erreurs de parsing pour les HTML non bien formés

        $wrappedHtml = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>' . $html . '</body></html>';

        $dom->loadHTML($wrappedHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $elements = $dom->getElementsByTagName($tagName);

        if ($elements->length > 0) {
            $summary = $elements->item(0);  // Récupère le premier élément <summary>
            $summary->parentNode->removeChild($summary);  // Supprime le noeud <summary> du DOM
        }

        $body = $dom->getElementsByTagName("body")->item(0);

        $innerHtml = '';

        if ($body instanceof DOMElement) {
            foreach ($body->childNodes as $element) {
                if ($element instanceof DOMElement) {
                    foreach ($element->childNodes as $child) {
                        $innerHtml .= $dom->saveHTML($child);
                    }
                }
            }
        }

        libxml_clear_errors();  // Nettoyer les erreurs après traitement
        return $innerHtml;
    }
}