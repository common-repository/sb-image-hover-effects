<?php

return [
    'get_name' => 'sa_el_fancy_text',
    'name' => 'Fancy_Text',
    'class' => '\SA_EL_ADDONS\Elements\Fancy_Text\Fancy_Text',
    'dependency' => [
        'css' => [
            'fancy.text.index.css' => SA_EL_ADDONS_PATH . 'Elements/Fancy_Text/assets/index.min.css',
        ],
        'js' => [
            'fancy-text.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/fancy-text/js/fancy-text.min.js',
            'fancy.text.index.js' => SA_EL_ADDONS_PATH . 'Elements/Fancy_Text/assets/index.min.js',
        ],
    ],
    'category' => 'Creative Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/fancy-text/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/creative-elements/fancy-text/',
];
