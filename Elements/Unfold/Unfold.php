<?php

namespace SA_EL_ADDONS\Elements\Unfold;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Icons_Manager;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

class Unfold extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_unfold';
    }

    public function get_title() {
        return esc_html__('Unfold', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-table  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {

        $this->start_controls_section('sa_el_unfold_general_settings',
                [
                    'label' => __('Content', 'sa-el-addons-pro'),
                ]
        );

        $this->add_control('sa_el_unfold_title_switcher',
                [
                    'label' => __('Title', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes'
                ]
        );

        $this->add_control('sa_el_unfold_title',
                [
                    'label' => __('Title', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => ['active' => true],
                    'default' => 'Premium Unfold',
                    'condition' => [
                        'sa_el_unfold_title_switcher' => 'yes'
                    ]
                ]
        );

        $this->add_control('sa_el_unfold_title_heading',
                [
                    'label' => __('Title Heading', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'h3',
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                    ],
                    'condition' => [
                        'sa_el_unfold_title_switcher' => 'yes'
                    ]
                ]
        );

        $this->add_control('sa_el_unfold_content',
                [
                    'type' => Controls_Manager::WYSIWYG,
                    'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                    'dynamic' => ['active' => true],
                ]
        );

        $this->add_responsive_control('sa_el_unfold_content_align',
                [
                    'label' => __('Alignment', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', 'sa-el-addons-pro'),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', 'sa-el-addons-pro'),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', 'sa-el-addons-pro'),
                            'icon' => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => __('Justify', 'sa-el-addons-pro'),
                            'icon' => 'fa fa-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-content,{{WRAPPER}} .sa-el-unfold-heading' => 'text-align: {{VALUE}}',
                    ],
                    'default' => 'left',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_unfold_button_settings',
                [
                    'label' => __('Button', 'sa-el-addons-pro'),
                ]
        );

        $this->add_control('sa_el_unfold_button_fold_text',
                [
                    'label' => __('Unfold Text', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => ['active' => true],
                    'default' => __('Show more', 'sa-el-addons-pro'),
                ]
        );

        $this->add_control('sa_el_unfold_button_unfold_text',
                [
                    'label' => __('Fold Text', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => ['active' => true],
                    'default' => __('Show Less', 'sa-el-addons-pro'),
                ]
        );

        $this->add_control('sa_el_unfold_button_icon_switcher',
                [
                    'label' => __('Icon', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('Enable or disable button icon', 'sa-el-addons-pro'),
                    'separator' => 'before'
                ]
        );

        $this->add_control('sa_el_unfold_button_icon_updated',
                [
                    'label' => __('Fold Icon', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'sa_el_unfold_button_icon',
                    'default' => [
                        'value' => 'fas fa-arrow-up',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'sa_el_unfold_button_icon_switcher' => 'yes',
                    ],
                    'label_block' => true,
                ]
        );

        $this->add_control('sa_el_unfold_button_icon_unfolded_updated',
                [
                    'label' => __('Unfold Icon', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'sa_el_unfold_button_icon_unfolded',
                    'default' => [
                        'value' => 'fas fa-arrow-down',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'sa_el_unfold_button_icon_switcher' => 'yes',
                    ],
                    'label_block' => true,
                ]
        );

        $this->add_control('sa_el_unfold_button_icon_position',
                [
                    'label' => __('Icon Position', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'before',
                    'options' => [
                        'before' => __('Before', 'sa-el-addons-pro'),
                        'after' => __('After', 'sa-el-addons-pro'),
                    ],
                    'condition' => [
                        'sa_el_unfold_button_icon_switcher' => 'yes',
                    ],
                    'label_block' => true,
                ]
        );

        $this->add_control('sa_el_unfold_button_size',
                [
                    'label' => __('Button Size', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'sm',
                    'options' => [
                        'sm' => __('Small', 'sa-el-addons-pro'),
                        'md' => __('Medium', 'sa-el-addons-pro'),
                        'lg' => __('Large', 'sa-el-addons-pro'),
                        'block' => __('Block', 'sa-el-addons-pro'),
                    ],
                    'label_block' => true,
                    'separator' => 'before',
                ]
        );

        $this->add_control('sa_el_unfold_button_position',
                [
                    'label' => __('Button Position', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'inside',
                    'options' => [
                        'inside' => __('Inside', 'sa-el-addons-pro'),
                        'outside' => __('Outside', 'sa-el-addons-pro'),
                    ],
                    'label_block' => true,
                    'separator' => 'before',
                ]
        );

        $this->add_responsive_control('sa_el_unfold_button_align',
                [
                    'label' => __('Alignment', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', 'sa-el-addons-pro'),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', 'sa-el-addons-pro'),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', 'sa-el-addons-pro'),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-button-container' => 'text-align: {{VALUE}}',
                    ],
                    'default' => 'center',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_unfold_sep_settings',
                [
                    'label' => __('Fade Effect', 'sa-el-addons-pro'),
                ]
        );

        $this->add_control('sa_el_unfold_sep_switcher',
                [
                    'label' => __('Faded Content', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control('sa_el_unfold_sep_height',
                [
                    'label' => __('Fade Height', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'description' => __('Increase or decrease fade height. The default value is 30px', 'sa-el-addons-pro'),
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 400,
                        ],
                    ],
                    'default' => [
                        'size' => 30,
                        'unit' => 'px'
                    ],
                    'condition' => [
                        'sa_el_unfold_sep_switcher' => 'yes'
                    ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_unfold_adv_settings',
                [
                    'label' => __('Advanced Settings', 'sa-el-addons-pro'),
                ]
        );

        $this->add_control('sa_el_unfold_fold_height_select',
                [
                    'label' => __('Fold Height', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'percent',
                    'options' => [
                        'percent' => __('Percentage', 'sa-el-addons-pro'),
                        'pixel' => __('Pixels', 'sa-el-addons-pro'),
                    ],
                    'label_block' => true,
                    'separator' => 'before'
                ]
        );

        $this->add_control('sa_el_unfold_fold_height',
                [
                    'label' => __('Fold Height', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __('How much of the folded content should be shown, default is 60%', 'sa-el-addons-pro'),
                    'min' => 0,
                    'default' => 60,
                    'condition' => [
                        'sa_el_unfold_fold_height_select' => 'percent'
                    ]
        ]);

        $this->add_control('sa_el_unfold_fold_height_pix',
                [
                    'label' => __('Fold Height', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __('How much of the folded content should be shown, default is 100px', 'sa-el-addons-pro'),
                    'min' => 0,
                    'default' => 100,
                    'condition' => [
                        'sa_el_unfold_fold_height_select' => 'pixel'
                    ]
        ]);

        $this->add_control('sa_el_unfold_fold_dur_select',
                [
                    'label' => __('Fold Duration', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'fast',
                    'options' => [
                        'slow' => __('Slow', 'sa-el-addons-pro'),
                        'fast' => __('Fast', 'sa-el-addons-pro'),
                        'custom' => __('Custom', 'sa-el-addons-pro'),
                    ],
                    'label_block' => true,
                    'separator' => 'before'
                ]
        );

        $this->add_control('sa_el_unfold_fold_dur',
                [
                    'label' => __('Number of Seconds', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __('How much time does it take for the fold, default is 0.5s', 'sa-el-addons-pro'),
                    'min' => 0.1,
                    'default' => 0.5,
                    'condition' => [
                        'sa_el_unfold_fold_dur_select' => 'custom'
                    ]
        ]);

        $this->add_control('sa_el_unfold_fold_easing',
                [
                    'label' => __('Fold Easing', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'swing',
                    'options' => [
                        'swing' => 'Swing',
                        'linear' => 'Linear',
                    ],
                    'label_block' => true,
                ]
        );

        $this->add_control('sa_el_unfold_unfold_dur_select',
                [
                    'label' => __('Unfold Duration', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'fast',
                    'options' => [
                        'slow' => 'Slow',
                        'fast' => 'Fast',
                        'custom' => 'Custom',
                    ],
                    'label_block' => true,
                    'separator' => 'before',
                ]
        );

        $this->add_control('sa_el_unfold_unfold_dur',
                [
                    'label' => __('Number of Seconds', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __('How much time does it take for the unfold, default is 0.5s', 'sa-el-addons-pro'),
                    'min' => 0.1,
                    'default' => 0.5,
                    'condition' => [
                        'sa_el_unfold_unfold_dur_select' => 'custom'
                    ]
        ]);

        $this->add_control('sa_el_unfold_unfold_easing',
                [
                    'label' => __('Unfold Easing', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SELECT,
                    'description' => __('Choose the animation style', 'sa-el-addons-pro'),
                    'default' => 'swing',
                    'options' => [
                        'swing' => 'Swing',
                        'linear' => 'Linear',
                    ],
                    'label_block' => true,
                ]
        );

        $this->end_controls_section();
        
        $this->Sa_El_Support();

        /* Start Box Style Settings */
        $this->start_controls_section('sa_el_unfold_style_settings',
                [
                    'label' => __('Box Settings', 'sa-el-addons-pro'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs('sa_el_unfold_box_style_tabs');

        $this->start_controls_tab('sa_el_unfold_box_style_normal',
                [
                    'label' => __('Normal', 'sa-el-addons-pro'),
                ]
        );

        /* Box Background */
        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'sa_el_unfold_box_background',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .sa-el-unfold-container',
                ]
        );

        /* Box Border */
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_unfold_box_border',
                    'selector' => '{{WRAPPER}} .sa-el-unfold-container',
                ]
        );

        /* Box Border Radius */
        $this->add_control('sa_el_unfold_box_border_radius',
                [
                    'label' => __('Border Radius', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        /* Button Shadow */
        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'sa_el_unfold_box_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-unfold-container',
                ]
        );

        /* Box Margin */
        $this->add_responsive_control('sa_el_unfold_box_margin',
                [
                    'label' => __('Margin', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
        ]);

        /* Box Padding */
        $this->add_responsive_control('sa_el_unfold_box_padding',
                [
                    'label' => __('Padding', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab('sa_el_unfold_box_style_hover',
                [
                    'label' => __('Hover', 'sa-el-addons-pro'),
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'sa_el_unfold_box_background_hover',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .sa-el-unfold-container:hover',
                ]
        );


        /* Box Border */
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_unfold_box_border_hover',
                    'selector' => '{{WRAPPER}} .sa-el-unfold-container:hover',
                ]
        );

        /* Box Border Radius */
        $this->add_control('sa_el_unfold_box_border_radius_hover',
                [
                    'label' => __('Border Radius', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-container:hover' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        /* Box Shadow */
        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'sa_el_unfold_box_shadow_hover',
                    'selector' => '{{WRAPPER}} .sa-el-unfold-container:hover',
                ]
        );

        /* Box Margin */
        $this->add_responsive_control('sa_el_unfold_box_margin_hover',
                [
                    'label' => __('Margin', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-container:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
        ]);

        /* Box Padding */
        $this->add_responsive_control('sa_el_unfold_box_padding_hover',
                [
                    'label' => __('Padding', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-container:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
        ]);


        $this->end_controls_tab();

        $this->end_controls_tabs();

        /* End Box Style Settings */
        $this->end_controls_section();

        $this->start_controls_section('sa_el_unfold_title_style',
                [
                    'label' => __('Title', 'sa-el-addons-pro'),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'sa_el_unfold_title_switcher' => 'yes'
                    ]
                ]
        );

        /* Title Color */
        $this->add_control('sa_el_unfold_heading_color',
                [
                    'label' => __('Color', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-heading' => 'color: {{VALUE}};'
                    ]
                ]
        );

        /* Title Typography */
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sa_el_unfold_heading_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .sa-el-unfold-heading',
                ]
        );

        /* Title Background */
        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'sa_el_unfold_heading_background',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .sa-el-unfold-heading',
                ]
        );

        /* Title Border */
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_unfold_title_border',
                    'selector' => '{{WRAPPER}} .sa-el-unfold-heading',
                ]
        );

        /* Title Border Radius */
        $this->add_control('sa_el_unfold_title_border_radius',
                [
                    'label' => __('Border Radius', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-heading' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'label' => __('Shadow', 'sa-el-addons-pro'),
                    'name' => 'sa_el_unfold_title_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-unfold-heading',
                ]
        );

        /* TItle Margin */
        $this->add_responsive_control('sa_el_unfold_title_margin',
                [
                    'label' => __('Margin', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
        );

        /* Title Padding */
        $this->add_responsive_control('sa_el_unfold_title_padding',
                [
                    'label' => __('Padding', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
        );

        /* End Content Style Settings */
        $this->end_controls_section();

        $this->start_controls_section('sa_el_unfold_content_style',
                [
                    'label' => __('Content', 'sa-el-addons-pro'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        /* Description Color */
        $this->add_control('sa_el_pricing_desc_color',
                [
                    'label' => __('Color', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-content' => 'color: {{VALUE}};'
                    ]
                ]
        );

        /* Description Typography */
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'unfold_content_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .sa-el-unfold-content',
                ]
        );

        /* Description Background */
        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'sa_el_unfold_content_background',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .sa-el-unfold-content',
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'label' => __('Shadow', 'sa-el-addons-pro'),
                    'name' => 'sa_el_unfold_content_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-unfold-content',
                ]
        );

        /* Description Margin */
        $this->add_responsive_control('sa_el_unfold_content_margin',
                [
                    'label' => __('Margin', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
        );

        /* Description Padding */
        $this->add_responsive_control('sa_el_unfold_content_padding',
                [
                    'label' => __('Padding', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
        );

        /* End Content Style Settings */
        $this->end_controls_section();

        /* Start Styling Section */
        $this->start_controls_section('sa_el_unfold_button_style_section',
                [
                    'label' => __('Button', 'sa-el-addons-pro'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control('sa_el_unfold_button_icon_size',
                [
                    'label' => __('Icon Size', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'sa_el_unfold_button_icon_switcher' => 'yes'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sa_el_unfold_button_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .sa-el-button',
                ]
        );

        $this->start_controls_tabs('sa_el_unfold_button_style_tabs');

        $this->start_controls_tab('sa_el_unfold_button_style_normal',
                [
                    'label' => __('Normal', 'sa-el-addons-pro'),
                ]
        );

        $this->add_control('sa_el_unfold_button_text_color_normal',
                [
                    'label' => __('Text Color', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-button span' => 'color: {{VALUE}};',
                    ]
        ]);

        $this->add_control('sa_el_unfold_button_icon_color_normal',
                [
                    'label' => __('Icon Color', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-button i' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'sa_el_unfold_button_icon_switcher' => 'yes',
                    ]
        ]);

        $this->add_control('sa_el_unfold_button_background_normal',
                [
                    'label' => __('Background Color', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-button' => 'background-color: {{VALUE}};',
                    ]
                ]
        );

        /* Button Border */
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_unfold_button_border_normal',
                    'selector' => '{{WRAPPER}} .sa-el-button',
                ]
        );

        /* Button Border Radius */
        $this->add_control('sa_el_unfold_button_border_radius_normal',
                [
                    'label' => __('Border Radius', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-button' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        /* Icon Shadow */
        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'label' => __('Icon Shadow', 'sa-el-addons-pro'),
                    'name' => 'sa_el_unfold_button_icon_shadow_normal',
                    'selector' => '{{WRAPPER}} .sa-el-button i',
                    'condition' => [
                        'sa_el_unfold_button_icon_switcher' => 'yes',
                    ]
                ]
        );

        /* Text Shadow */
        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'label' => __('Text Shadow', 'sa-el-addons-pro'),
                    'name' => 'sa_el_unfold_button_text_shadow_normal',
                    'selector' => '{{WRAPPER}} .sa-el-button span',
                ]
        );

        /* Button Shadow */
        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'label' => __('Button Shadow', 'sa-el-addons-pro'),
                    'name' => 'sa_el_unfold_button_box_shadow_normal',
                    'selector' => '{{WRAPPER}} .sa-el-button',
                ]
        );

        /* Button Margin */
        $this->add_responsive_control('sa_el_unfold_button_margin_normal',
                [
                    'label' => __('Margin', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
        ]);

        /* Button Padding */
        $this->add_responsive_control('sa_el_unfold_button_padding_normal',
                [
                    'label' => __('Padding', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab('sa_el_unfold_button_style_hover',
                [
                    'label' => __('Hover', 'sa-el-addons-pro'),
                ]
        );

        $this->add_control('sa_el_unfold_button_text_color_hover',
                [
                    'label' => __('Text Color', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-button:hover span' => 'color: {{VALUE}};',
                    ],
        ]);

        $this->add_control('sa_el_unfold_button_icon_color_hover',
                [
                    'label' => __('Icon Color', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-button:hover i' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'sa_el_unfold_button_icon_switcher' => 'yes',
                    ]
        ]);

        $this->add_control('sa_el_unfold_button_background_hover',
                [
                    'label' => __('Background Color', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_3
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-button:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        /* Button Border */
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_unfold_button_border_hover',
                    'selector' => '{{WRAPPER}} .sa-el-button:hover',
                ]
        );

        /* Button Border Radius */
        $this->add_control('sa_el_unfold_button_border_radius_hover',
                [
                    'label' => __('Border Radius', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-button:hover' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        /* Icon Shadow */
        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'label' => __('Icon Shadow', 'sa-el-addons-pro'),
                    'name' => 'sa_el_unfold_button_icon_shadow_hover',
                    'selector' => '{{WRAPPER}} .sa-el-button:hover i',
                    'condition' => [
                        'sa_el_unfold_button_icon_switcher' => 'yes',
                    ]
                ]
        );

        /* Text Shadow */
        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'label' => __('Text Shadow', 'sa-el-addons-pro'),
                    'name' => 'sa_el_unfold_button_text_shadow_hover',
                    'selector' => '{{WRAPPER}} .sa-el-button:hover span',
                ]
        );

        /* Button Shadow */
        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'label' => __('Button Shadow', 'sa-el-addons-pro'),
                    'name' => 'sa_el_unfold_button_box_shadow_hover',
                    'selector' => '{{WRAPPER}} .sa-el-button:hover',
                ]
        );

        /* Button Margin */
        $this->add_responsive_control('sa_el_unfold_button_margin_hover',
                [
                    'label' => __('Margin', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-button:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
        ]);

        /* Button Padding */
        $this->add_responsive_control('sa_el_unfold_button_padding_hover',
                [
                    'label' => __('Padding', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        /* End Button Style Section */
        $this->end_controls_section();

        $this->start_controls_section('sa_el_unfold_grad_style',
                [
                    'label' => __('Fade Color', 'sa-el-addons-pro'),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'sa_el_unfold_sep_switcher' => 'yes',
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'sa_el_unfold_sep_background',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .sa-el-unfold-gradient',
                ]
        );

        /* Separator Border */
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_unfold_sep_border',
                    'selector' => '{{WRAPPER}} .sa-el-unfold-gradient',
                ]
        );

        /* Separator Border Radius */
        $this->add_control('sa_el_unfold_sep_border_radius',
                [
                    'label' => __('Border Radius', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-gradient' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        /* Separator Padding */
        $this->add_responsive_control('sa_el_unfold_sep_padding',
                [
                    'label' => __('Padding', 'sa-el-addons-pro'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-unfold-gradient' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
        ]);


        $this->end_controls_section();
    }

    protected function get_unfold_button() {
        $settings = $this->get_settings_for_display();
        $button_size = 'sa-el-button-' . $settings['sa_el_unfold_button_size'];
        ?>
        <div class="sa-el-unfold-button-container">
            <a id='sa-el-unfold-button-<?php echo esc_attr($this->get_id()); ?>' class="sa-el-button <?php echo esc_attr($button_size); ?>">
                <?php if ($settings['sa_el_unfold_button_icon_switcher'] && $settings['sa_el_unfold_button_icon_position'] == 'before') : ?>
                    <i class="sa-el-unfold-before"></i>
                <?php endif; ?>
                <span id="sa-el-unfold-button-text-<?php echo esc_attr($this->get_id()); ?>" class="sa-el-unfold-button-text"></span>
                <?php if ($settings['sa_el_unfold_button_icon_switcher'] && $settings['sa_el_unfold_button_icon_position'] == 'after') : ?>
                    <i class="sa-el-unfold-after"></i>
                <?php endif; ?>
            </a>
        </div>
        <?php
    }

    protected function render() {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('sa_el_unfold_title', 'class', 'sa-el-unfold-heading');

        $this->add_inline_editing_attributes('sa_el_unfold_title', 'basic');

        $this->add_render_attribute('sa_el_unfold_content', 'class', 'sa-el-unfold-editor-content');

        $this->add_inline_editing_attributes('sa_el_unfold_content', 'advanced');

        $fold_migrated = isset($settings['__fa4_migrated']['sa_el_unfold_button_icon_updated']);
        $fold_is_new = empty($settings['sa_el_unfold_button_icon']) && Icons_Manager::is_migration_allowed();

        if ($fold_migrated || $fold_is_new) {
            $button_icon = $settings['sa_el_unfold_button_icon_updated']['value'];
        } else {
            $button_icon = $settings['sa_el_unfold_button_icon'];
        }

        $unfold_migrated = isset($settings['__fa4_migrated']['sa_el_unfold_button_icon_unfolded_updated']);
        $unfold_is_new = empty($settings['sa_el_unfold_button_icon_unfolded']) && Icons_Manager::is_migration_allowed();

        if ($unfold_migrated || $unfold_is_new) {
            $button_icon_unfolded = $settings['sa_el_unfold_button_icon_unfolded_updated']['value'];
        } else {
            $button_icon_unfolded = $settings['sa_el_unfold_button_icon_unfolded'];
        }

        if ($settings['sa_el_unfold_fold_height_select'] == 'percent') {
            $fold_height = $settings['sa_el_unfold_fold_height'];
        } else {
            $fold_height = $settings['sa_el_unfold_fold_height_pix'];
        }


        if ($settings['sa_el_unfold_fold_dur_select'] == 'custom') {
            $fold_dur = $settings['sa_el_unfold_fold_dur'] * 1000;
        } else {
            $fold_dur = $settings['sa_el_unfold_fold_dur_select'];
        }

        if ($settings['sa_el_unfold_unfold_dur_select'] == 'custom') {
            $unfold_dur = $settings['sa_el_unfold_unfold_dur'] * 1000;
        } else {
            $unfold_dur = $settings['sa_el_unfold_unfold_dur_select'];
        }

        if (!empty($settings['sa_el_unfold_sep_height'])) {
            $sep_height = $settings['sa_el_unfold_sep_height']['size'] . 'px';
        }

        $fold_ease = $settings['sa_el_unfold_fold_easing'];
        $unfold_ease = $settings['sa_el_unfold_unfold_easing'];

        $unfold_settings = [
            'buttonIcon' => $button_icon,
            'buttonUnfoldIcon' => $button_icon_unfolded,
            'foldSelect' => $settings['sa_el_unfold_fold_height_select'],
            'foldHeight' => $fold_height,
            'foldDur' => $fold_dur,
            'unfoldDur' => $unfold_dur,
            'foldEase' => $fold_ease,
            'unfoldEase' => $unfold_ease,
            'foldText' => $settings['sa_el_unfold_button_fold_text'],
            'unfoldText' => $settings['sa_el_unfold_button_unfold_text'],
        ];
        ?>

        <div class="sa-el-unfold-wrap" data-settings='<?php echo wp_json_encode($unfold_settings); ?>'>
            <div class='sa-el-unfold-container'>
                <div class='sa-el-unfold-folder'>
                    <?php if ($settings['sa_el_unfold_title_switcher'] == 'yes' && !empty($settings['sa_el_unfold_title'])) : ?>
                        <<?php echo $settings['sa_el_unfold_title_heading'] . ' ' . $this->get_render_attribute_string('sa_el_unfold_title'); ?>><?php echo $settings['sa_el_unfold_title']; ?></<?php echo $settings['sa_el_unfold_title_heading']; ?>>
                    <?php endif; ?>
                    <div id="sa-el-unfold-content-<?php echo $this->get_id(); ?>" class="sa-el-unfold-content toggled">
                        <div <?php echo $this->get_render_attribute_string('sa_el_unfold_content'); ?>><?php echo $this->parse_text_editor($settings['sa_el_unfold_content']); ?></div>
                    </div>
                    <?php if ($settings['sa_el_unfold_sep_switcher'] == 'yes') : ?>
                        <div id="sa-el-unfold-gradient-<?php echo esc_attr($this->get_id()); ?>" class="sa-el-unfold-gradient toggled" style="<?php echo 'height:' . $sep_height; ?>"></div>
                    <?php endif; ?>
                </div>
                <?php if ($settings['sa_el_unfold_button_position'] == 'inside') $this->get_unfold_button(); ?>
            </div>
            <?php if ($settings['sa_el_unfold_button_position'] == 'outside') $this->get_unfold_button(); ?>
        </div>
        <?php
    }

}
