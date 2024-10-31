<?php

return [
    'get_name' => 'sael-3d-effects',
    'name' => '3D_Css_Effect',
    'class' => '\SA_EL_ADDONS\Extensions\CSS_3D_effect\CSS_3D_effect',
    'dependency' => [
        'js' => [
            '3d.effects.js' => SA_EL_ADDONS_PATH . 'Extensions/CSS_3D_effect/assets/index.min.js',
        ],
    ],
    'category' => 'Extension',
    'Premium' => FALSE,
    'condition' => '',
    'Extension' => 'Elements Layouts',
    'API' => ''
];
