<?php

return [
    'get_name' => 'sa_el_product_360',
    'name' => '360_Product_View',
    'class' => '\SA_EL_ADDONS\Elements\Product_360\Product_360',
    'dependency' => [
        'css' => [
            'Product_360.css' => SA_EL_ADDONS_PATH . 'Elements/Product_360/assets/index.min.css',
        ],
        'js' => [
            'spritespin.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/spritespin/js/spritespin.min.js',
            'Product_360.js' => SA_EL_ADDONS_PATH . 'Elements/Product_360/assets/index.min.js',
        ],
    ],
    'category' => 'Content Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/360-product-view/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/marketing-elements/360-product-view/',
];

