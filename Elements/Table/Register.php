<?php

return [
    'get_name' => 'sa_el_table',
    'name' => 'Table',
    'class' => '\SA_EL_ADDONS\Elements\Table\Table',
    'dependency' => [
        'css' => [
            'Table.css' => SA_EL_ADDONS_PATH . 'Elements/Table/assets/index.min.css',
        ],
        'js' => [
            'jquery.tablesorter.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/table-sorter/js/jquery.tablesorter.min.js',
            'Table.js' => SA_EL_ADDONS_PATH . 'Elements/Table/assets/index.min.js',
        ],
    ],
    'preview' => 'https://www.sa-elementor-addons.com/elements/table/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/dynamic-contents/table/',
    'category' => 'Dynamic Contents',
    'Premium' => TRUE,
    'condition' => '',
];
