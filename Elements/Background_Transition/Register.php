<?php

return [
    'get_name' => 'sa_el_background_transition',
    'name' => 'Background_Transition',
    'class' => '\SA_EL_ADDONS\Elements\Background_Transition\Background_Transition',
    'dependency' => [
        'css' => [
          'background_transition.css' =>  SA_EL_ADDONS_PATH . 'Elements/Background_Transition/assets/index.min.css',
        ],
        'js' => [
          'background_transition.js' =>  SA_EL_ADDONS_PATH . 'Elements/Background_Transition/assets/index.min.js',
        ],
    ],
    'category' => 'Creative Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/background-transition/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/creative-elements/background-transition/',
];
