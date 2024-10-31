<?php

return [
    'get_name' => 'sa_el_filterable_gallery',
    'name' => 'Filterable_Gallery',
    'class' => '\SA_EL_ADDONS\Elements\Filterable_Gallery\Filterable_Gallery',
    'dependency' => [
        'css' => [
            'magnific-popup.css' => SA_EL_ADDONS_PATH . 'assets/vendor/magnific-popup/css/index.min.css',
            'filterable.gallery.css' => SA_EL_ADDONS_PATH . 'Elements/Filterable_Gallery/assets/index.min.css',
        ],
        'js' => [
            'imagesloaded.pkgd.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/imagesLoaded/js/imagesloaded.pkgd.min.js',
            'isotope.pkgd.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/isotope/js/isotope.pkgd.min.js',
            'jquery.magnific-popup.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/magnific-popup/js/jquery.magnific-popup.min.js',
            'filterable.gallery.js' => SA_EL_ADDONS_PATH . 'Elements/Filterable_Gallery/assets/index.min.js',
        ],
    ],
    'category' => 'Creative Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/filterable-gallery/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/creative-elements/filterable-gallery/',
];
