<?php

return [
    'get_name' => 'sa_el_audio_player',
    'name' => 'Audio_Player',
    'class' => '\SA_EL_ADDONS\Elements\Audio_Player\Audio_Player',
    'dependency' => [
        'css' => [
            'Audio_Player.css' => SA_EL_ADDONS_PATH . 'Elements/Audio_Player/assets/index.min.css',
        ],
        'js' => [
            'jquery.jplayer.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/jplayer/js/jquery.jplayer.min.js',
            'Audio_Player.js' => SA_EL_ADDONS_PATH . 'Elements/Audio_Player/assets/index.min.js',
        ],
    ],
    'category' => 'Dynamic Contents',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/audio-player/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/dynamic-contents/audio-player/',
];
