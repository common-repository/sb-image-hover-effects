<?php

return [
    'get_name' => 'sa_el_video_gallery',
    'name' => 'Video_Gallery',
    'class' => '\SA_EL_ADDONS\Elements\Video_Gallery\Video_Gallery',
    'dependency' => [
        'css' => [
            'video-gallery.min' => SA_EL_ADDONS_PATH . 'assets/vendor/video-gallery/css/video-gallery.css',
            'Video_Gallery.css' => SA_EL_ADDONS_PATH . 'Elements/Video_Gallery/assets/index.min.css',
        ],
        'js' => [
            'rvslider.min' => SA_EL_ADDONS_PATH . 'assets/vendor/rvslider/js/rvslider.min.js',
            'Video_Gallery.js' => SA_EL_ADDONS_PATH . 'Elements/Video_Gallery/assets/index.min.js',
        ],
    ],
    'category' => 'Content Elements',
    'Premium' => TRUE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/video-gallery/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/content-elements/video-gallery/',
];
