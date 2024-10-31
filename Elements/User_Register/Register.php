<?php

return [
    'get_name' => 'sa-el-user-register',
    'name' => 'User_Register',
    'class' => '\SA_EL_ADDONS\Elements\User_Register\User_Register',
    'dependency' => [
        'css' => [
            'User_Register.css' => SA_EL_ADDONS_PATH . 'Elements/User_Register/assets/index.min.css',
        ],
    ],
    'preview' => 'https://www.sa-elementor-addons.com/elements/user-register/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/user-elements/user-register/',
    'category' => 'User Elements',
    'Premium' => TRUE,
    'condition' => '',
];
