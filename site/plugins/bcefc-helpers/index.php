<?php
/**
 * BCEFC Helpers
 * pageUrl() — resolves a stored URL string to a language-aware Kirby page URL.
 * External URLs (http/https/mailto/tel) pass through unchanged.
 */
Kirby::plugin('bcefc/helpers', [
    'helpers' => [
        'pageUrl' => function (string $raw): string {
            $raw = trim($raw);
            if ($raw === '' || $raw === '#') return '#';
            if (
                str_starts_with($raw, 'http')   ||
                str_starts_with($raw, 'mailto:') ||
                str_starts_with($raw, 'tel:')    ||
                str_starts_with($raw, '//')
            ) {
                return $raw;
            }
            $slug = trim($raw, '/');
            $p = page($slug);
            return $p ? $p->url() : $raw;
        }
    ]
]);
