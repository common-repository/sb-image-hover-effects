<?php

return [
    'get_name' => 'sa_el_person',
    'name' => 'Person',
    'class' => '\SA_EL_ADDONS\Elements\Person\Person',
    'dependency' => [
        'css' => [
            'Person.css' => SA_EL_ADDONS_PATH . 'Elements/Person/assets/index.min.css',
        ],
    ],
    'category' => 'Content Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/person/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/content-elements/person/',
];
