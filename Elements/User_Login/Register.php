<?php

return [
    'get_name' => 'sa-el-user-login',
    'name' => 'User_Login',
    'class' => '\SA_EL_ADDONS\Elements\User_Login\User_Login',
    'dependency' => [
        'css' => [
            'User_Login.css' => SA_EL_ADDONS_PATH . 'Elements/User_Login/assets/index.min.css',
        ],
    ],
    'category' => 'User Elements',
    'preview' => 'https://www.sa-elementor-addons.com/elements/user-login/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/user-elements/user-login/',
    'Premium' => TRUE,
    'condition' => '',
];
