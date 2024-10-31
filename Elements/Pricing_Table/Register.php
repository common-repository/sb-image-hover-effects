<?php

return [
    'get_name' => 'sa_el_pricing_table',
    'name' => 'Pricing_Table',
    'class' => '\SA_EL_ADDONS\Elements\Pricing_Table\Pricing_Table',
    'dependency' => [
        'css' => [
            'tooltipster.bundle.min.css' => SA_EL_ADDONS_PATH . 'assets/vendor/tooltipster/css/tooltipster.bundle.min.css',
            'Pricing_Table.css' => SA_EL_ADDONS_PATH . 'Elements/Pricing_Table/assets/index.min.css',
        ],
        'js' => [
            'tooltipster.bundle.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/tooltipster/js/tooltipster.bundle.min.js',
            'Pricing_Table.js' => SA_EL_ADDONS_PATH . 'Elements/Pricing_Table/assets/index.min.js',
        ],
    ],
    'category' => 'Marketing Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/pricing-table/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/marketing-elements/pricing-table/',
];
