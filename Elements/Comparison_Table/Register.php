<?php

return [
    'get_name' => 'sa-el-comparison-table',
    'name' => 'Comparison_Table',
    'class' => '\SA_EL_ADDONS\Elements\Comparison_Table\Comparison_Table',
    'dependency' => [
        'css' => [
            'comparison.table.css' => SA_EL_ADDONS_PATH . 'Elements/Comparison_Table/assets/index.min.css',
        ],
        'js' => [
            'comparison.table.js' => SA_EL_ADDONS_PATH . 'Elements/Comparison_Table/assets/index.min.js',
        ],
    ],
    'category' => 'Marketing Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/comparison-table/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/marketing-elements/comparison-table/',
];
