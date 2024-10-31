<?php

return [
    'get_name' => 'sa_el_link_effects',
    'name' => 'Link_Effects',
    'class' => '\SA_EL_ADDONS\Elements\Link_Effects\Link_Effects',
    'dependency' => [
        'css' => [
            'Link_Effects.css' => SA_EL_ADDONS_PATH . 'Elements/Link_Effects/assets/index.min.css',
        ],
    ],
    'category' => 'Creative Elements',
    'Premium' => false,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/link-effects/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/creative-elements/link-effects/',
];
