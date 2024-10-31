<?php

return [
    'get_name' => 'sa_el_buddypress_member',
    'name' => 'Buddypress_Member',
    'class' => '\SA_EL_ADDONS\Elements\Buddypress_Member\Buddypress_Member',
    'dependency' => [
        'css' => [
            'Buddypress_Member.css' => SA_EL_ADDONS_PATH . 'Elements/Buddypress_Member/assets/index.min.css',
        ],
    ],
    'category' => 'Buddypress',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://sa-elementor-addons.com/third-party/buddypress-member/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/buddypress-elements/buddypress-member/',
];
