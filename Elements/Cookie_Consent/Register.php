<?php

return [
    'get_name' => 'sa_el_cookie_consent',
    'name' => 'Cookie_Consent',
    'class' => '\SA_EL_ADDONS\Elements\Cookie_Consent\Cookie_Consent',
    'dependency' => [
        'css' => [
            'cookieconsent.css' => SA_EL_ADDONS_PATH . 'assets/vendor/cookieconsent/css/cookieconsent.css',
        ],
        'js' => [
            'cookieconsent.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/cookieconsent/js/cookieconsent.min.js',
            'cookie.consent.index.js' => SA_EL_ADDONS_PATH . 'Elements/Cookie_Consent/assets/index.min.js',
        ],
    ],
    'category' => 'Marketing Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/cookie-consent/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/marketing-elements/cookie-consent/',
];
