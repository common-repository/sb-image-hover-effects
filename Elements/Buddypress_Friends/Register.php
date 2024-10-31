<?php

return [
    'get_name' => 'sa_el_buddypress_friends',
    'name' => 'Buddypress_Friends',
    'class' => '\SA_EL_ADDONS\Elements\Buddypress_Friends\Buddypress_Friends',
    'dependency' => [
        'css' => [
            'Buddypress_Friends.css' => SA_EL_ADDONS_PATH . 'Elements/Buddypress_Friends/assets/index.min.css',
        ],
    ],
    'category' => 'Buddypress',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://sa-elementor-addons.com/third-party/buddypress-friends/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/buddypress-elements/buddypress-friends/',
];
