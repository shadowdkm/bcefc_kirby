<?php

/**
 * The config file is optional. It accepts a return array with config options
 * Note: Never include more than one return statement, all options go within this single return array
 * In this example, we set debugging to true, so that errors are displayed onscreen. 
 * This setting must be set to false in production.
 * All config options: https://getkirby.com/docs/reference/system/options
 */
return [
    'debug' => true,
    'yaml.handler' => 'symfony',
    
    // Set homepage
    'home' => 'homepage',
    
    // Enable multilingual support
    'languages' => true,
    'languages.detect' => true,

    // Shared password for pages with "Password Protect This Page" enabled
    // (e.g. Sermons). Change here to update the password for all protected pages.
    'bcefc.protectPassword' => '6112',

    // Preserve the main public URLs from the current BCEFC site during migration.
    'routes' => [
        [
            'pattern' => 'english/about-us',
            'action'  => fn() => go('/about', 301),
        ],
        [
            'pattern' => 'english/about-us/worship-with-us',
            'action'  => fn() => go('/worship', 301),
        ],
        [
            'pattern' => 'english/people',
            'action'  => fn() => go('/about/pastoral-staff', 301),
        ],
        [
            'pattern' => 'english/events',
            'action'  => fn() => go('/events', 301),
        ],
        [
            'pattern' => 'english/sermons',
            'action'  => fn() => go('/worship/sermons', 301),
        ],
    ],

];