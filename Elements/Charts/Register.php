<?php

return [
    'get_name' => 'sa-el-chart',
    'name' => 'Charts',
    'class' => '\SA_EL_ADDONS\Elements\Charts\Charts',
    'dependency' => [
        'css' => [
            'charts.index.css' => SA_EL_ADDONS_PATH . 'Elements/Charts/assets/index.min.css',
        ],
        'js' => [
            'charts.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/chart-js/js/charts.min.js',
            'charts.index.js' => SA_EL_ADDONS_PATH . 'Elements/Charts/assets/index.min.js',
        ],
    ],
    'category' => 'Marketing Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/charts/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/marketing-elements/charts/',
];
