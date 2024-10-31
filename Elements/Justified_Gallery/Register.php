<?php

return [
    'get_name' => 'sa_el_justified_gallery',
    'name' => 'Justified_Gallery',
    'class' => '\SA_EL_ADDONS\Elements\Justified_Gallery\Justified_Gallery',
    'dependency' => [
        'css' => [
            'justifiedGallery.min.css' => SA_EL_ADDONS_PATH . 'assets/vendor/justifiedGallery/css/justifiedGallery.min.css',
            'Justified_Gallery.css' => SA_EL_ADDONS_PATH . 'Elements/Justified_Gallery/assets/index.min.css',
        ],
        'js' => [
            'jquery.justifiedGallery.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/justifiedGallery/js/jquery.justifiedGallery.min.js',
            'Justified_Gallery.js' => SA_EL_ADDONS_PATH . 'Elements/Justified_Gallery/assets/index.min.js',
        ],
    ],
    'category' => 'Creative Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/justified-gallery/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/creative-elements/justified-gallery/',
];
