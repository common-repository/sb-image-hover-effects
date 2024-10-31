<?php

return [
    'get_name' => 'sa_el_weform',
    'name' => 'WeForm',
    'class' => '\SA_EL_ADDONS\Elements\WeForm\WeForm',
    'dependency' => [
        'css' => [
            'WeForm.css' => SA_EL_ADDONS_PATH . 'Elements/WeForm/assets/index.min.css',
        ]
    ],
    'category' => 'Form Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://sa-elementor-addons.com/third-party/weform/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/form-elements/weform/',
//    'Control' => [
//        'sa-el-google-map-api' => [
//            'name' => 'GOOGLE API',
//            'default' => 'new',
//            'type' => 'text',
//            'placeholder'=> 'Set Your Google API CODE'
//        ],
//        'sa-el-google-map-api-1' => [
//            'name' => 'GOOGLE CONSOLE',
//            'default' => 'select-3',
//            'type' => 'select',
//            'options' => [
//                'select-1' => 'Select 01',
//                'select-2' => 'Select 02',
//                'select-3' => 'Select 03',
//                'select-4' => 'Select 04',
//            ]
//        ]
//    ],
];
