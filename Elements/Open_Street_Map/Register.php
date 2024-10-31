<?php

return [
    'get_name' => 'sa_el_open_street_map',
    'name' => 'Open_Street_Map',
    'class' => '\SA_EL_ADDONS\Elements\Open_Street_Map\Open_Street_Map',
    'dependency' => [
        'css' => [
            'Open_Street_Map' => SA_EL_ADDONS_PATH . 'Elements/Open_Street_Map/assets/index.min.css',
        ],
        'js' => [
            'leaflet.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/leaflet/js/leaflet.min.js',
            'Open_Street_Map.js' => SA_EL_ADDONS_PATH . 'Elements/Open_Street_Map/assets/index.min.js',
        ],
    ],
    'category' => 'Dynamic Contents',
    'Premium' => TRUE,
    'preview' => 'https://www.sa-elementor-addons.com/elements/open-street-map/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/dynamic-contents/open-street-map/',
    'Control' => [
        'sa-el-open-street-map' => [
            'name' => 'Open Street Map API',
            'default' => '',
            'type' => 'text',
            'placeholder' => 'Set Your Open Street Map API CODE'
        ],
    ],
];
