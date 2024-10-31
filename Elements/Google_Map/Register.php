<?php

return [
    'get_name' => 'sa_el_google_map',
    'name' => 'Google_Map',
    'class' => '\SA_EL_ADDONS\Elements\Google_Map\Google_Map',
    'dependency' => [
         'js' => [
            'countdown.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/gmap/js/gmap.min.js',
            'Google_Map.index.js' => SA_EL_ADDONS_PATH . 'Elements/Google_Map/assets/index.min.js',
        ],
    ],
    'category' => 'Dynamic Contents',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/google-map/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/dynamic-contents/google-map/',
    'Control' => [
        'sa-el-google-map-api' => [
            'name' => 'GOOGLE API',
            'default' => '',
            'type' => 'text',
            'placeholder'=> 'Set Your Google API CODE'
        ],
      
    ],
];
