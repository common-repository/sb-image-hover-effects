<?php

return [
    'get_name' => 'sa_el_countdown',
    'name' => 'Count_Down',
    'class' => '\SA_EL_ADDONS\Elements\Count_Down\Count_Down',
    'dependency' => [
        'css' => [
            'count-down.index.css' => SA_EL_ADDONS_PATH . 'Elements/Count_Down/assets/index.min.css',
        ],
        'js' => [
            'countdown.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/countdown/js/countdown.min.js',
            'count-down.index.js' => SA_EL_ADDONS_PATH . 'Elements/Count_Down/assets/index.min.js',
        ],
    ],
    'category' => 'Creative Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/count-down/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/creative-elements/count-down/',
];
