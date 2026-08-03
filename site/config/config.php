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

        // 35th anniversary moved from Events (活動回顧) to News (最新消息).
        [
            'pattern' => 'events/35th-anniversary',
            'action'  => fn() => go('/news/35th-anniversary', 301),
        ],
        [
            'pattern' => 'zh-cn/events/35th-anniversary',
            'action'  => fn() => go('/zh-cn/news/35th-anniversary', 301),
        ],
        [
            'pattern' => 'zh-tw/events/35th-anniversary',
            'action'  => fn() => go('/zh-tw/news/35th-anniversary', 301),
        ],

        // Calendar moved from Resources (常用資料) to Worship (崇拜與聚會).
        [
            'pattern' => 'resources/calendar',
            'action'  => fn() => go('/worship/calendar', 301),
        ],
        [
            'pattern' => 'zh-cn/resources/calendar',
            'action'  => fn() => go('/zh-cn/worship/calendar', 301),
        ],
        [
            'pattern' => 'zh-tw/resources/calendar',
            'action'  => fn() => go('/zh-tw/worship/calendar', 301),
        ],
    ],

];