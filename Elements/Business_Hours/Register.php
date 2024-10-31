<?php

return [
    'get_name' => 'sa_el_business_hours',
    'name' => 'Business_Hours',
    'class' => '\SA_EL_ADDONS\Elements\Business_Hours\Business_Hours',
    'dependency' => [
        'css' => [
            'business.hours.css' => SA_EL_ADDONS_PATH . 'Elements/Business_Hours/assets/index.min.css',
        ],
    ],
    'category' => 'Marketing Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/business-hours/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/marketing-elements/business-hours/',
];
