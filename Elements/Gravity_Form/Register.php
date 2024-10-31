<?php

return [
    'get_name' => 'sa_el_gravity_form',
    'name' => 'Gravity_Form',
    'class' => '\SA_EL_ADDONS\Elements\Gravity_Form\Gravity_Form',
    'dependency' => [
        'css' => [
            'gravity_form.css' => SA_EL_ADDONS_PATH . 'Elements/Gravity_Form/assets/index.min.css',
        ]
    ],
    'category' => 'Form Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://sa-elementor-addons.com/third-party/gravity-form/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/form-elements/gravity-form/',
];
