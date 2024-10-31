<?php

return [
    'get_name' => 'sa_el_download_monitor',
    'name' => 'Download_Monitor',
    'class' => '\SA_EL_ADDONS\Elements\Download_Monitor\Download_Monitor',
    'dependency' => [
        'css' => [
            'document.viewer.css' => SA_EL_ADDONS_PATH . 'Elements/Download_Monitor/assets/index.min.css',
        ]
    ],
    'category' => '3rd Party Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://sa-elementor-addons.com/third-party/download-monitor/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/3rd-party-elements/download-monitor/',
];
