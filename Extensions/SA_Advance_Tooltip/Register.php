<?php

return [
    'get_name' => 'sael-advance-tooltip',
    'name' => 'Advance_Tooltip',
    'class' => '\SA_EL_ADDONS\Extensions\SA_Advance_Tooltip\SA_Advance_Tooltip',
    'dependency' => [
        'css' => [
            'tippy.min.css' => SA_EL_ADDONS_PATH . 'assets/vendor/tippy/css/tippy.min.css',
        ],
        'js' => [
            'popper.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/popper/js/popper.min.js',
            'tippy.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/tippy/js/tippy.min.js',
            'advance.tooltip.js' => SA_EL_ADDONS_PATH . 'Extensions/SA_Advance_Tooltip/assets/index.min.js',
        ],
    ],
    'category' => 'Extension',
    'Extension' => 'Elements Layouts',
    'Premium' => TRUE,
    'condition' => '',
    'API' => ''
];
