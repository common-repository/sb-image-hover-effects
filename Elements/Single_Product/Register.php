<?php

return [
    'get_name' => 'sa_el_single_product',
    'name' => 'Single_Product',
    'class' => '\SA_EL_ADDONS\Elements\Single_Product\Single_Product',
    'dependency' => [
        'css' => [
            'Single_Product.css' => SA_EL_ADDONS_PATH . 'Elements/Single_Product/assets/index.min.css',
            'overlay.min.css' => SA_EL_ADDONS_PATH . 'Elements/Single_Product/assets/overlay.min.css',
        ],
    ],
    'category' => 'Marketing Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/single-product/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/marketing-elements/single-product/',
];
