<?php

return [

    // Add any language you want to support
    'locales' => [
        'en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB'],
        'ar' => ['name' => 'Arabic', 'script'  => 'Arab', 'native' => 'العربية', 'regional' => 'ar_AE'],
        'tr' => ['name' => 'Turkish', 'script' => 'Latn', 'native' => 'Türkçe', 'regional'  => 'tr_TR'],
    ],

    // Default locale will not be shown in the url.
    // If enabled and 'en' is the default language:
    // / -> English page, /de -> German page
    // /en -> English Page, /de -> German page
    // If disabled:
    'hide_default_locale_in_url' => true,

    // Use query parameter if there are no localized routes available.
    // Set it to null to disable usage of query parameter.
    'locale_query_parameter' => 'hl',

    // Enable redirect if there is a localized route available and the user locale was detected (via HTTP header or session)
    'redirect_to_localized_route' =>  true,

    // Try to detect user locale via Accept-Language header.
    'detect_via_http_header' => true,

    // Remember the user locale using session.
    'detect_via_session' => true,

];
