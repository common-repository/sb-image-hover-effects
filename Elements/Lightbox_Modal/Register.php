<?php

return [
    'get_name' => 'sa_el_lightbox',
    'name' => 'Lightbox_Modal',
    'class' => '\SA_EL_ADDONS\Elements\Lightbox_Modal\Lightbox_Modal',
    'dependency' => [
        'css' => [
            'magnific-popup.css' => SA_EL_ADDONS_PATH . 'assets/vendor/magnific-popup/css/index.min.css',
            'Lightbox_Modal.css' => SA_EL_ADDONS_PATH . 'Elements/Lightbox_Modal/assets/index.min.css',
        ],
        'js' => [
            'jquery.magnific-popup.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/magnific-popup/js/jquery.magnific-popup.min.js',
            'jquery.cookie.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/cookie/js/jquery.cookie.min.js',
            'Lightbox_Modal.js' => SA_EL_ADDONS_PATH . 'Elements/Lightbox_Modal/assets/index.min.js',
        ],
    ],
    'category' => 'Creative Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/lightbox-and-modal/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/creative-elements/lightbox-and-modal/',
];
