<?php

return [
    'get_name' => 'sa-el-showcase',
    'name' => 'Showcase',
    'class' => '\SA_EL_ADDONS\Elements\Showcase\Showcase',
    'dependency' => [
        'css' => [
            'jquery.fancybox.min.css' => SA_EL_ADDONS_PATH . 'assets/vendor/fancybox/css/jquery.fancybox.min.css',
            'Showcase' => SA_EL_ADDONS_PATH . 'Elements/Showcase/assets/index.min.css',
        ],
        'js' => [
            'jquery.fancybox.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/fancybox/js/jquery.fancybox.min.js',
            'Showcase' => SA_EL_ADDONS_PATH . 'Elements/Showcase/assets/index.min.js',
        ],
    ],
    'category' => 'Marketing Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/showcase/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/marketing-elements/showcase/',
];
