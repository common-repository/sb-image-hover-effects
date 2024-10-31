<?php

return [
    'get_name' => 'sael-section-particle',
    'name' => 'Section_Particle',
    'class' => '\SA_EL_ADDONS\Extensions\Section_Particle\Section_Particle',
    'dependency' => [
        'css' => [
            'particle.index.css' => SA_EL_ADDONS_PATH . 'Extensions/Section_Particle/assets/index.min.css',
        ],
        'js' => [
            'particles.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/particles/js/particles.min.js',
            'particle.index.js' => SA_EL_ADDONS_PATH . 'Extensions/Section_Particle/assets/index.min.js',
        ],
    ],
    'category' => 'Extension',
    'Extension' => 'Section Layouts',
    'Premium' => TRUE,
    'condition' => '',
    'API' => ''
];
