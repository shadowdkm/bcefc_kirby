<?php

/**
 * English language configuration
 * Default language for the church website
 */

return [
    'code'      => 'en',
    'default'   => true,
    'direction' => 'ltr',
    'locale'    => 'en_US.utf8',
    'name'      => 'English',
    'url'       => '/',
    
    // UI translations for templates
    'translations' => [
        // Site
        'site.subtitle'      => 'BURNABY CHINESE EVANGELICAL FREE CHURCH',
        'site.tagline'       => 'Deepening Faith Together · Extending Light in Life',
        
        // Navigation
        'nav.home'           => 'Home',
        'nav.about'          => 'About Us',
        'nav.worship'        => 'Worship',
        'nav.ministries'     => 'Ministries',
        'nav.fellowship'     => 'Fellowship',
        'nav.school'         => 'Chinese School',
        'nav.events'         => 'Events',
        'nav.news'           => 'News',
        'nav.new_here'       => 'New Here',
        'nav.giving'         => 'Giving',
        'nav.resources'      => 'Resources',
        'nav.more'           => 'More',
        
        // Header
        'menu.toggle'        => 'Toggle menu',
        
        // Common UI elements
        'ui.language'        => 'Language',
        'ui.readmore'        => 'Read More',
        'ui.viewall'         => 'View All',
        'ui.learnmore'       => 'Learn More',
        'ui.viewdetails'     => 'View Details',
        'ui.register'        => 'Register Now',
        'ui.contact'         => 'Contact Us',
        'ui.submit'          => 'Submit',
        'ui.download'        => 'Download',
        'ui.livestream'      => 'Watch Livestream',
        'ui.directions'      => 'Get Directions',
        'ui.goto'            => 'Go',
        
        // Worship times
        'worship.thisweek'   => 'This Week\'s Worship Times',
        'worship.joinus'     => 'Join Us for Worship This Sunday',
        'worship.schedule'   => 'View Full Schedule',
        'worship.cantonese'  => 'Cantonese Worship',
        'worship.mandarin'   => 'Mandarin Worship',
        'worship.english'    => 'English Worship',
        'worship.bulletin'   => 'This Week\'s Bulletin',
        
        // Footer
        'footer.contact'     => 'Contact Us',
        'footer.quicklinks'  => 'Quick Links',
        'footer.connect'     => 'Connect',
        'footer.office_hours'=> 'Office: Mon-Fri 9am-5pm',
        'footer.view_map'    => 'View on Google Maps',
        'footer.rights'      => 'All rights reserved.',
        'footer.privacy'     => 'Privacy Policy',
        'footer.about'       => 'Committed to building a transforming spiritual family, leading all nations to become disciples of our Lord Jesus Christ.',
        'footer.sunday_services' => 'Sunday Services',
        'footer.kids_youth'  => 'Children & Youth Sunday School',
        'footer.map'         => 'Map',
        'footer.copyright'   => '&copy; ' . date('Y') . ' Burnaby Chinese Evangelical Free Church. All Rights Reserved.',

        // Pastor's Corner
        'pastor.updates.eyebrow' => 'Pastor\'s Corner',
        'pastor.updates.empty'   => 'No updates yet. Check back soon.',
        'pastor.updates.back'    => 'Back to Pastor\'s Corner',

        // Pagination
        'pagination.prev'    => 'Previous',
        'pagination.next'    => 'Next',
        'pagination.newer'   => 'Newer',
        'pagination.older'   => 'Older',

        // Calendar
        'cal.no_embed'       => 'Calendar not set up yet. Paste the Google Calendar embed URL in the Panel.',

        // Password protection
        'protect.prompt'         => 'This page is password protected. Please enter the password to continue.',
        'protect.password_label' => 'Password',
        'protect.submit'         => 'Enter',
        'protect.error'          => 'Incorrect password. Please try again.',
        'protect.locked'         => 'Too many incorrect attempts. Please wait a minute before trying again.',
        
        // Forms
        'form.guestcard'     => 'Fill Guest Card',
        'form.signup'        => 'Sign Up',
        'form.subscribe'     => 'Subscribe',
        
        // Dates
        'date.sunday'        => 'Sunday',
        'date.weekly'        => 'Every Sunday',
    ]
];
