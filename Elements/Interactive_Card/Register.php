<?php

return [
    'get_name' => 'sa_el_interactive_card',
    'name' => 'Interactive_Card',
    'class' => '\SA_EL_ADDONS\Elements\Interactive_Card\Interactive_Card',
    'dependency' => [
        'css' => [
            'interactive-cards.min.css' => SA_EL_ADDONS_PATH . 'assets/vendor/interactive-cards/css/interactive-cards.min.css',
        ],
        'js' => [
            'jquery.nicescroll.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/nicescroll/js/jquery.nicescroll.min.js',
            'interactive-cards.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/interactive-cards/js/interactive-cards.min.js',
            'Interactive_Card.js' => SA_EL_ADDONS_PATH . 'Elements/Interactive_Card/assets/index.min.js',
        ],
    ],
    'category' => 'Creative Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/interactive-card/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/creative-elements/interactive-card/',
];
