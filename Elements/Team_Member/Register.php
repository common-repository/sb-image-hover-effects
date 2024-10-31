<?php

return [
    'get_name' => 'sa_el_team_member',
    'name' => 'Team_Member',
    'class' => '\SA_EL_ADDONS\Elements\Team_Member\Team_Member',
    'dependency' => [
        'css' => [
            'Team_Member.css' => SA_EL_ADDONS_PATH . 'Elements/Team_Member/assets/index.min.css',
        ]
    ],
    'preview' => 'https://www.sa-elementor-addons.com/elements/team-member/',
    'docs' => 'https://www.sa-elementor-addons.com/docs/content-elements/team-member/',
    'category' => 'Content Elements',
    'Premium' => FALSE,
    'condition' => '',
];
