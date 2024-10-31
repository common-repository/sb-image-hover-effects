<?php

return [
    'get_name' => 'sa_el_price_menu',
    'name' => 'Price_Menu',
    'class' => '\SA_EL_ADDONS\Elements\Price_Menu\Price_Menu',
    'dependency' => [
        'css' => [
            'Price_Menu.css' => SA_EL_ADDONS_PATH . 'Elements/Price_Menu/assets/index.min.css',
        ],
    ],
    'category' => 'Marketing Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/price-menu/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/marketing-elements/price-menu/',
];
