<?php

return [
    'get_name' => 'sa_el_document_viewer',
    'name' => 'Document_Viewer',
    'class' => '\SA_EL_ADDONS\Elements\Document_Viewer\Document_Viewer',
    'dependency' => [
        'css' => [
            'recliner.min.js' => SA_EL_ADDONS_PATH . 'assets/vendor/recliner/js/recliner.min.js',
            'document.viewer.css' => SA_EL_ADDONS_PATH . 'Elements/Document_Viewer/assets/index.min.css',
        ]
    ],
    'category' => 'Creative Elements',
    'Premium' => FALSE,
    'condition' => '',
    'preview' => 'https://www.sa-elementor-addons.com/elements/document-viewer/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/creative-elements/document-viewer/',
];
