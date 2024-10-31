<?php

return [
    'get_name' => 'sa_el_buddypress_group',
    'name' => 'Buddypress_Group',
    'class' => '\SA_EL_ADDONS\Elements\Buddypress_Group\Buddypress_Group',
    'dependency' => [
        'css' => [
            'Buddypress_Group.css' => SA_EL_ADDONS_PATH . 'Elements/Buddypress_Group/assets/index.min.css',
        ],
    ],
    'category' => 'Buddypress',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://sa-elementor-addons.com/third-party/buddypress-group/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/buddypress-elements/buddypress-group/',
];
