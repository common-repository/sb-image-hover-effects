<?php

namespace SA_EL_ADDONS\Elements\Behance_Feed;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Behance_Feed
 *
 * @author biplo
 * 
 */
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Responsive\Responsive;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

class Behance_Feed extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_behance_feed';
    }

    public function get_title() {
        return esc_html__('Behance Feed', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-user-circle-o  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {

        /* Start Access Credentials Section */
        $this->start_controls_section('access_credentials_section',
                [
                    'label' => __('Access Credentials', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control('api_key',
                [
                    'label' => __('API key', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'default' => '',
                    'description' => '<a href="https://www.behance.net/dev" target="_blank">Get API Key.</a> Create or select an app and grab the API Key',
                ]
        );

        $this->add_control('username',
                [
                    'label' => __('Username', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'default' => 'jabirhasan88',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('display',
                [
                    'label' => __('Display Options', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control('feed_column_number',
                [
                    'label' => __('Number of Columns', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'col-1' => __('1 Column', SA_EL_ADDONS_TEXTDOMAIN),
                        'col-2' => __('2 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        'col-3' => __('3 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        'col-4' => __('4 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        'col-5' => __('5 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        'col-6' => __('6 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        'col-7' => __('7 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        'col-8' => __('8 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'col-3',
                ]
        );

        $this->add_control('hover_effect',
                [
                    'label' => __('Hover Image Effect', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'none' => __('None', SA_EL_ADDONS_TEXTDOMAIN),
                        'zoomin' => __('Zoom In', SA_EL_ADDONS_TEXTDOMAIN),
                        'zoomout' => __('Zoom Out', SA_EL_ADDONS_TEXTDOMAIN),
                        'scale' => __('Scale', SA_EL_ADDONS_TEXTDOMAIN),
                        'gray' => __('Grayscale', SA_EL_ADDONS_TEXTDOMAIN),
                        'blur' => __('Blur', SA_EL_ADDONS_TEXTDOMAIN),
                        'bright' => __('Bright', SA_EL_ADDONS_TEXTDOMAIN),
                        'sepia' => __('Sepia', SA_EL_ADDONS_TEXTDOMAIN),
                        'trans' => __('Translate', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'zoomin',
                    'label_block' => true
                ]
        );

        $this->add_responsive_control('img_align',
                [
                    'label' => __('Image Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wrap-project .wrap-cover-outer' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                ]
        );

        $this->add_responsive_control('name_align',
                [
                    'label' => __('Name Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'condition' => [
                        'project_name' => 'yes'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wrap-project .wrap-title-text' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control('author_align',
                [
                    'label' => __('Author Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'condition' => [
                        'owner' => 'yes'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wrap-owners-outer' => 'justify-content: {{VALUE}};',
                    ],
                    'condition' => [
                        'owner' => 'yes'
                    ]
                ]
        );

        $this->add_responsive_control('info_align',
                [
                    'label' => __('Info Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'appreciate',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'views',
                                'value' => 'yes'
                            ]
                        ],
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .wrap-project' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('advanced',
                [
                    'label' => __('Advanced Settings', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control('project_name',
                [
                    'label' => __('Show Project Name', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'default' => 'yes',
                ]
        );

        $this->add_control('owner',
                [
                    'label' => __('Show Author', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'default' => 'yes',
                ]
        );

        $this->add_control('appreciate',
                [
                    'label' => __('Show Apprectiations', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'default' => 'yes',
                ]
        );

        $this->add_control('views',
                [
                    'label' => __('Show Views', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'default' => 'yes',
                ]
        );

        $this->add_control('heading',
                [
                    'label' => __('Lightbox', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING
                ]
        );

        $this->add_control('date',
                [
                    'label' => __('Show Date', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'default' => 'yes',
                ]
        );

        $this->add_control('url',
                [
                    'label' => __('Project URL', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'default' => 'yes',
                ]
        );

        $this->add_control('caption',
                [
                    'label' => __('Image Caption', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'default' => 'yes',
                ]
        );

        $this->add_control('desc',
                [
                    'label' => __('Description', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                ]
        );

        $this->add_control('number',
                [
                    'label' => __('Number of Projects', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'default' => 9
                ]
        );

        $this->add_control('load',
                [
                    'label' => __('Load More', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('button',
                [
                    'label' => __('Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'load' => 'yes'
                    ]
                ]
        );

        $this->add_control('button_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'lg',
                    'options' => [
                        'sm' => __('Small', SA_EL_ADDONS_TEXTDOMAIN),
                        'md' => __('Medium', SA_EL_ADDONS_TEXTDOMAIN),
                        'lg' => __('Large', SA_EL_ADDONS_TEXTDOMAIN),
                        'block' => __('Block', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'label_block' => true,
                ]
        );

        $this->add_responsive_control('button_align',
                [
                    'label' => __('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .sa-el-behance-btn' => 'text-align: {{VALUE}}',
                    ],
                    'default' => 'center',
                ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();
        $this->start_controls_section('img',
                [
                    'label' => __('Image', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control('image_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', "em"],
                    'range' => [
                        'px' => [
                            'min' => 50,
                            'max' => 500,
                        ],
                        'em' => [
                            'min' => 1,
                            'max' => 100,
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wrap-cover' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'img_border',
                    'selector' => '{{WRAPPER}} .wrap-project .wrap-cover',
                ]
        );

        $this->add_control('img_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .wrap-project .wrap-cover' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'img_box_shadow',
                    'selector' => '{{WRAPPER}} .wrap-project .wrap-cover',
                ]
        );

        $this->add_group_control(
                Group_Control_Css_Filter::get_type(),
                [
                    'name' => 'css_filters',
                    'selector' => '{{WRAPPER}} .wrap-project .wrap-cover img',
                ]
        );

        $this->add_responsive_control('img_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wrap-project .wrap-cover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('overlay_style',
                [
                    'label' => __('Overlay', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'caption' => 'yes'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'overlay_background',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-project .wrap-cover .fields-in-cover',
                ]
        );

        $this->start_controls_tabs('overlay_tabs');

        $this->start_controls_tab('overlay_icon_tab',
                [
                    'label' => __('Icon', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control('overlay_icon_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover > svg path' => 'fill: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control('overlay_icon_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', "em"],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover > svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_control('overlay_icon_background',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover > svg' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'overlay_icon_border',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover > svg'
                ]
        );

        $this->add_control('overlay_icon_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', "em", '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover > svg' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'label' => __('Box Shadow', SA_EL_ADDONS_TEXTDOMAIN),
                    'name' => 'overlay_icon_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover > svg'
                ]
        );

        $this->add_responsive_control('overlay_icon_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover > svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('overlay_icon_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover > svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('overlay_text_tab',
                [
                    'label' => __('Tags', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control('overlay_num_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover .single' => '    color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'overlay_num_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover .single'
                ]
        );

        $this->add_control('overlay_num_background',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover .single' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'overlay_num_border',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover .single'
                ]
        );

        $this->add_control('overlay_num_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', "em", '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover .single' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'label' => __('Box Shadow', SA_EL_ADDONS_TEXTDOMAIN),
                    'name' => 'overlay_num_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover .single'
                ]
        );

        $this->add_responsive_control('overlay_num_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover .single' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('overlay_num_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-projects li .wrap-cover .fields-in-cover .single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('project',
                [
                    'label' => __('Project', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'project_background',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .wrap-projects .wrap-project',
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'project_border',
                    'selector' => '{{WRAPPER}} .wrap-projects .wrap-project',
                ]
        );

        $this->add_control('project_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .wrap-projects .wrap-project' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'project_box_shadow',
                    'selector' => '{{WRAPPER}} .wrap-projects .wrap-project',
                ]
        );

        $this->add_responsive_control('project_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wrap-projects .wrap-project' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('project_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wrap-projects .wrap-project' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('title',
                [
                    'label' => __('Name', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'project_name' => 'yes'
                    ]
                ]
        );

        $this->add_control('title_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wrap-projects .wrap-title-text' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control('title_color_hover',
                [
                    'label' => __('Text Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wrap-title-text:hover' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-project .wrap-title-text',
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'title_text_shadow',
                    'selector' => '{{WRAPPER}} .wrap-title-text',
                ]
        );

        $this->add_control('title_background',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}  .wrap-title-text' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'title_border',
                    'selector' => '{{WRAPPER}} .wrap-title-text',
                ]
        );

        $this->add_control('title_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', "em", '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wrap-title-text' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('title_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wrap-title-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('title_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wrap-title-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('author',
                [
                    'label' => __('Author', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'owner' => 'yes'
                    ]
                ]
        );

        $this->start_controls_tabs('author_tabs');

        $this->start_controls_tab('author_label_tab',
                [
                    'label' => __('Label', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control('author_label_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-label' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'author_label_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-label',
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'author_label_text_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-label',
                ]
        );

        $this->add_control('author_label_background',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-label' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'author_label_border',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-label',
                ]
        );

        $this->add_control('author_label_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', "em", '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-label' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('author_label_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('author_label_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('author_name_tab',
                [
                    'label' => __('Name', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control('author_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .owner-full-name a' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control('author_color_hover',
                [
                    'label' => __('Text Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .owner-full-name:hover a' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'author_text_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .owner-full-name',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'author_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .owner-full-name a',
                ]
        );

        $this->add_control('author_background',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .owner-full-name' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'author_border',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .owner-full-name',
                ]
        );

        $this->add_control('author_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', "em", '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .owner-full-name' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('author_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .owner-full-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('author_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .owner-full-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section('app',
                [
                    'label' => __('Apprectiations', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'appreciate' => 'yes'
                    ]
                ]
        );

        $this->start_controls_tabs('app_tabs');

        $this->start_controls_tab('app_icon_tab',
                [
                    'label' => __('Icon', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control('app_icon_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-label svg g path' => 'fill: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control('app_icon_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', "em"],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-label svg' => 'width: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_control('app_icon_background',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-label' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'app_icon_border',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-label',
                ]
        );

        $this->add_control('app_icon_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', "em", '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-label' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'app_icon_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-label'
                ]
        );

        $this->add_responsive_control('app_icon_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('app_icon_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('app_num_tab',
                [
                    'label' => __('Number', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control('app_num_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-app-value' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'app_num_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-app-value'
                ]
        );

        $this->add_control('app_num_background',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-value' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'app_num_border',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-value',
                ]
        );

        $this->add_control('app_num_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', "em", '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-value' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'app_num_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-value'
                ]
        );

        $this->add_responsive_control('app_num_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('app_num_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-appreciations-outer .wrap-value' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('views_style',
                [
                    'label' => __('Views', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'views' => 'yes'
                    ]
                ]
        );

        $this->start_controls_tabs('views_tabs');

        $this->start_controls_tab('views_icon_tab',
                [
                    'label' => __('Icon', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control('views_icon_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-label svg g path' => 'fill: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control('views_icon_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', "em"],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-label svg' => 'width: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_control('views_icon_background',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-label' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'views_icon_border',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-label',
                ]
        );

        $this->add_control('views_icon_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', "em", '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-label' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'views_icon_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-label'
                ]
        );

        $this->add_responsive_control('views_icon_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('views_icon_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('views_num_tab',
                [
                    'label' => __('Number', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control('views_num_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-view-value' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'views_num_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-view-value'
                ]
        );

        $this->add_control('views_num_background',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-value' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'views_num_border',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-value',
                ]
        );

        $this->add_control('views_num_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', "em", '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-value' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'views_num_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-value'
                ]
        );

        $this->add_responsive_control('views_num_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('views_num_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-container .wrap-views-outer .wrap-value' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('button_style_settings',
                [
                    'label' => __('Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'load' => 'yes',
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button span',
                ]
        );

        $this->start_controls_tabs('button_style_tabs');

        $this->start_controls_tab('button_style_normal',
                [
                    'label' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('button_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button span' => 'color: {{VALUE}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'button_text_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button',
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'button_background',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button',
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'button_border',
                    'selector' => '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button',
                ]
        );

        $this->add_control('button_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button',
                ]
        );

        $this->add_responsive_control('button_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('button_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('button_style_hover',
                [
                    'label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('button_hover_color',
                [
                    'label' => __('Text Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button:hover span' => 'color: {{VALUE}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'button_text_shadow_hover',
                    'selector' => '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button:hover',
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'button_background_hover',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button:hover',
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'button_border_hover',
                    'selector' => '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button:hover',
                ]
        );

        $this->add_control('button_border_radius_hover',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button:hover' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_shadow_hover',
                    'selector' => '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button:hover',
                ]
        );

        $this->add_responsive_control('button_margin_hover',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('button_padding_hover',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-behance-btn .eb-pagination-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * returns the responsive style based on Elementor Breakpoints
     * @access protected
     * @return string
     */
    protected function get_behance_responsive_style() {

        $breakpoints = Responsive::get_breakpoints();
        $style = '<style>';
        $style .= '@media ( max-width: ' . $breakpoints['lg'] . 'px ) {';
        $style .= '.sa-el-behance-container .wrap-project {';
        $style .= 'flex-basis: 50% !important; -ms-flex-preferred-size: 50% !important';
        $style .= '}';
        $style .= '}';
        $style .= '@media ( max-width: ' . $breakpoints['md'] . 'px ) {';
        $style .= '.sa-el-behance-container .wrap-project {';
        $style .= 'flex-basis: 100% !important; -ms-flex-preferred-size: 100% !important';
        $style .= '}';
        $style .= '}';
        $style .= '</style>';

        return $style;
    }

    /**
     * renders the HTML content of the widget
     * @return void
     */
    protected function render() {

        $settings = $this->get_settings();

        $id = $this->get_id();

        $api_key = $settings['api_key'];

        $username = $settings['username'];

        $project = 'yes' == $settings['project_name'] ? true : false;

        $owner = 'yes' == $settings['owner'] ? true : false;

        $appreciations = 'yes' == $settings['appreciate'] ? true : false;

        $views = 'yes' == $settings['views'] ? true : false;

        $date = 'yes' == $settings['date'] ? true : false;

        $url = 'yes' == $settings['url'] ? true : false;

        $desc = 'yes' == $settings['desc'] ? true : false;

        $caption = 'yes' == $settings['caption'] ? true : false;

        $load_more = 'yes' == $settings['load'] ? '' : 'button-none';

        $hover_effect = $settings['hover_effect'];

        $photos_num = !empty($settings['number']) ? $settings['number'] : 1;

        $col_num = $settings['feed_column_number'];

        $button_size = $settings['button_size'];

        $behance_settings = [
            'api_key' => $api_key,
            'username' => $username,
            'project' => $project,
            'owner' => $owner,
            'apprectiations' => $appreciations,
            'views' => $views,
            'fields' => $caption,
            'date' => $date,
            'url' => $url,
            'desc' => $desc,
            'id' => $id,
            'number' => $photos_num
        ];

        $this->add_render_attribute('behance', 'id', 'sa-el-behance-container-' . $id);

        $this->add_render_attribute('behance', 'class', ['sa-el-behance-container', 'sa-el-behance-' . $col_num, $button_size, $load_more, $hover_effect]);

        $this->add_render_attribute('behance', 'data-settings', wp_json_encode($behance_settings));

        if (empty($settings['api_key']) || empty($settings['username'])) :
            ?>

            <div class="sa-el-alert-warning">
                <?php echo __('Please fill the required fields: App ID & Access Token', SA_EL_ADDONS_TEXTDOMAIN); ?>
            </div>

        <?php else: ?>

            <div <?php echo $this->get_render_attribute_string('behance'); ?>></div>
            <div class="sa-el-loading-feed">
                <div class="sa-el-loader"></div>
            </div>

            <?php
            echo $this->get_behance_responsive_style();

        endif;
    }

}
