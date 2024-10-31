<?php

return [
    'get_name' => 'sa-el-progress-bar',
    'name' => 'Progress_Bar',
    'class' => '\SA_EL_ADDONS\Elements\Progress_Bar\Progress_Bar',
    'dependency' => [
        'css' => [
            'Progress_Bar.css' => SA_EL_ADDONS_PATH . 'Elements/Progress_Bar/assets/index.min.css',
        ],
        'js' => [
            'inview.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/inview/js/inview.min.js',
            'progress-bar.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/progress-bar/js/progress-bar.min.js',
            'Progress_Bar.js' => SA_EL_ADDONS_PATH . 'Elements/Progress_Bar/assets/index.min.js',
        ],
    ],
    'category' => 'Creative Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/progress-bar/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/creative-elements/progress-bar/',
];
