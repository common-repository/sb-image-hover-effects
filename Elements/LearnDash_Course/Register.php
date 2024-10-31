<?php

return [
    'get_name' => 'sa_el_learndash_course',
    'name' => 'LearnDash_Course',
    'class' => '\SA_EL_ADDONS\Elements\LearnDash_Course\LearnDash_Course',
    'dependency' => [
        'css' => [
            'LearnDash_Course.css' => SA_EL_ADDONS_PATH . 'Elements/LearnDash_Course/assets/index.min.css',
        ],
        'js' => [
            'imagesloaded.pkgd.min' => SA_EL_ADDONS_PATH . 'assets/vendor/imagesLoaded/js/imagesloaded.pkgd.min.js',
            'isotope.pkgd.min' => SA_EL_ADDONS_PATH . 'assets/vendor/isotope/js/isotope.pkgd.min.js',
            'LearnDash_Course.js' => SA_EL_ADDONS_PATH . 'Elements/LearnDash_Course/assets/index.min.js',
        ],
    ],
    'category' => '3rd Party Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://sa-elementor-addons.com/third-party/learndash-course/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/3rd-party-elements/learndash-course/',
];
