<?php

namespace SA_EL_ADDONS\Elements\Whatsapp_Chat;

// If this file is called directly, abort.
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
use Elementor\Core\Responsive\Responsive;

class Whatsapp_Chat extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_whatsapp_chat';
    }

    public function get_title() {
        return esc_html__('Whatsapp Chat', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-site-title oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    public function check_rtl() {
        return is_rtl();
    }

    protected function _register_controls() {

        $this->start_controls_section('chat',
                [
                    'label' => __('Chat', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('chat_type',
                [
                    'label' => __('Chat', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'private' => __('Private', SA_EL_ADDONS_TEXTDOMAIN),
                        'group' => __('Group', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'private',
                    'label_block' => true,
                ]
        );

        $this->add_control('number',
                [
                    'label' => __('Phone Number', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => 'Example: +1123456789',
                    'dynamic' => ['active' => true],
                    'condition' => [
                        'chat_type' => 'private'
                    ],
                    'type' => Controls_Manager::TEXT,
                ]
        );

        $this->add_control('group_id',
                [
                    'label' => __('Group ID', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'description' => 'click <a href="https://www.youtube.com/watch?time_continue=13&v=Vx53spbt_qk" target="_blank"> here</a> to know how to get the group id',
                    'dynamic' => ['active' => true],
                    'default' => '9EHSSAJask6AVtE8AvXiA',
                    'condition' => [
                        'chat_type' => 'group'
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('settings',
                [
                    'label' => __('Button', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('button_float',
                [
                    'label' => __('Float', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER
                ]
        );

        $this->add_responsive_control('horizontal_position',
                [
                    'label' => __('Horizontal Offset', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em', '%'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 300,
                        ]
                    ],
                    'condition' => [
                        'button_float' => 'yes',
                        'position' => 'right'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control('horizontal_position_left',
                [
                    'label' => __('Horizontal Offset', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em', '%'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 300,
                        ]
                    ],
                    'condition' => [
                        'button_float' => 'yes',
                        'position' => 'left'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control('vertical_position',
                [
                    'label' => __('Vertical Offset', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em', '%'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 300,
                        ]
                    ],
                    'condition' => [
                        'button_float' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control('button_text',
                [
                    'label' => __('Text', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => ['active' => true],
                    'default' => __('Contact us', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_block' => true,
                ]
        );

        $this->add_control('icon_switcher',
                [
                    'label' => __('Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('Enable or disable button icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => 'yes',
                    'separator' => 'before',
                ]
        );

        $this->add_control('icon_selection_updated',
                [
                    'label' => __('Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon_selection',
                    'default' => [
                        'value' => 'fab fa-whatsapp',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'icon_switcher' => 'yes',
                    ],
                    'label_block' => true,
                ]
        );

        $this->add_control('icon_position',
                [
                    'label' => __('Icon Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'row-reverse' => __('Before', SA_EL_ADDONS_TEXTDOMAIN),
                        'row' => __('After', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'condition' => [
                        'icon_switcher' => 'yes',
                        'icon_selection_updated!' => '',
                        'button_text!' => ''
                    ],
                    'default' => 'row',
                    'label_block' => true,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link' => '-webkit-flex-direction: {{VALUE}}; flex-direction: {{VALUE}};'
                    ]
                ]
        );

        $this->add_responsive_control('icon_size',
                [
                    'label' => __('Icon Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'condition' => [
                        'icon_switcher' => 'yes',
                        'icon_selection_updated!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link .sa-el-whatsapp-icon' => 'font-size: {{SIZE}}px',
                    ]
                ]
        );

        $this->add_responsive_control('icon_spacing',
                [
                    'label' => __('Icon Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'condition' => [
                        'icon_switcher' => 'yes',
                        'icon_position' => 'row',
                        'icon_selection_updated!' => '',
                        'button_text!' => ''
                    ],
                    'default' => [
                        'size' => 15
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link i' => 'margin-left: {{SIZE}}px',
                    ],
                    'separator' => 'after',
                ]
        );

        $this->add_responsive_control('icon_before_spacing',
                [
                    'label' => __('Icon Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'condition' => [
                        'icon_switcher' => 'yes',
                        'icon_position' => 'row-reverse',
                        'icon_selection_updated!' => '',
                        'button_text!' => ''
                    ],
                    'default' => [
                        'size' => 15
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link i' => 'margin-right: {{SIZE}}px',
                    ],
                    'separator' => 'after',
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
                    'separator' => 'before'
                ]
        );

        $this->add_responsive_control('button_alignment',
                [
                    'label' => __('Button Alignment', SA_EL_ADDONS_TEXTDOMAIN),
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
                    'toggle' => false,
                    'condition' => [
                        'button_float!' => 'yes',
                        'button_size!' => 'block'
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link-wrap' => 'text-align: {{VALUE}}',
                    ],
                ]
        );

        $this->add_responsive_control('text_alignment',
                [
                    'label' => __('Text Alignment', SA_EL_ADDONS_TEXTDOMAIN),
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
                    'toggle' => false,
                    'condition' => [
                        'button_float!' => 'yes',
                        'icon_position' => 'row',
                        'button_size' => 'block'
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link-wrap .sa-el-whatsapp-link' => 'justify-content: {{VALUE}}',
                    ],
                ]
        );

        $this->add_responsive_control('text_alignment_after',
                [
                    'label' => __('Text Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'right' => [
                            'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-center',
                        ],
                        'left' => [
                            'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'toggle' => false,
                    'condition' => [
                        'button_float!' => 'yes',
                        'icon_position' => 'row-reverse',
                        'button_size' => 'block'
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link-wrap .sa-el-whatsapp-link' => 'justify-content: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control('position',
                [
                    'label' => __('Button Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'right' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'left' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'condition' => [
                        'button_float' => 'yes'
                    ],
                    'toggle' => false,
                    'default' => 'right',
                    'label_block' => true,
                ]
        );

        $this->add_control('button_hover_animation',
                [
                    'label' => __('Hover Animation', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HOVER_ANIMATION,
                ]
        );

        $this->add_control('link_new_tab',
                [
                    'label' => __('Open Link in New Tab', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('advanced',
                [
                    'label' => __('Advanced Settings', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('hide_tabs',
                [
                    'label' => __('Hide on Tabs', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('This will hide the chat button on tablets', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('hide_mobiles',
                [
                    'label' => __('Hide on Mobiles', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('This will hide the chat button on mobile phones', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('tooltips',
                [
                    'label' => __('Tooltips', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('This will show a tooltip next to the button when hovered', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('tooltips_msg',
                [
                    'label' => __('Tooltip Message', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => ['active' => true],
                    'default' => __('Message us', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'tooltips' => 'yes'
                    ]
                ]
        );

        $this->add_control('tooltips_anim',
                [
                    'label' => __('Animation', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'fade' => __('Fade', SA_EL_ADDONS_TEXTDOMAIN),
                        'grow' => __('Grow', SA_EL_ADDONS_TEXTDOMAIN),
                        'swing' => __('Swing', SA_EL_ADDONS_TEXTDOMAIN),
                        'slide' => __('Slide', SA_EL_ADDONS_TEXTDOMAIN),
                        'fall' => __('Fall', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'condition' => [
                        'tooltips' => 'yes'
                    ],
                    'default' => 'fade',
                    'label_block' => true,
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();

        $this->start_controls_section('sa_el_button_style_section',
                [
                    'label' => __('Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'condition' => [
                        'button_text!' => ''
                    ],
                    'selector' => '{{WRAPPER}} .sa-el-whatsapp-link span',
                ]
        );

        $this->start_controls_tabs('button_style_tabs');

        $this->start_controls_tab('button_style_normal',
                [
                    'label' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('text_color_normal',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'condition' => [
                        'button_text!' => ''
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link span' => 'color: {{VALUE}};',
                    ]
                ]
        );

        $this->add_control('button_icon_color_normal',
                [
                    'label' => __('Icon Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link i' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'icon_switcher' => 'yes',
                        'icon_selection_updated!' => ''
                    ]
                ]
        );

        $this->add_control('button_background_normal',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_4,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link' => 'background-color: {{VALUE}};',
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'button_border_normal',
                    'selector' => '{{WRAPPER}} .sa-el-whatsapp-link',
                ]
        );

        $this->add_control('button_border_radius_normal',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'label' => __('Icon Shadow', SA_EL_ADDONS_TEXTDOMAIN),
                    'name' => 'button_icon_shadow_normal',
                    'selector' => '{{WRAPPER}} .sa-el-whatsapp-link i',
                    'condition' => [
                        'icon_switcher' => 'yes',
                        'icon_switcher!' => ''
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'label' => __('Text Shadow', SA_EL_ADDONS_TEXTDOMAIN),
                    'name' => 'button_text_shadow_normal',
                    'condition' => [
                        'button_text!' => ''
                    ],
                    'selector' => '{{WRAPPER}} .sa-el-whatsapp-link span',
                ]
        );


        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'label' => __('Button Shadow', SA_EL_ADDONS_TEXTDOMAIN),
                    'name' => 'button_box_shadow_normal',
                    'selector' => '{{WRAPPER}} .sa-el-whatsapp-link',
                ]
        );

        $this->add_responsive_control('button_margin_normal',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('button_padding_normal',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('button_style_hover',
                [
                    'label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('tooltips_background',
                [
                    'label' => __('Tooltips Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '.tooltipster-sidetip div.tooltipster-box-{{ID}} .tooltipster-content' => 'background-color:{{VALUE}};'
                    ],
                    'condition' => [
                        'tooltips' => 'yes'
                    ]
                ]
        );

        $this->add_control('text_color_hover',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link:hover span' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'button_text!' => ''
                    ]
                ]
        );

        $this->add_control('icon_color_hover',
                [
                    'label' => __('Icon Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link:hover i' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'icon_selection_updated!' => '',
                        'icon_switcher' => 'yes',
                    ]
                ]
        );

        $this->add_control('button_background_hover',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_4
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'button_border_hover',
                    'selector' => '{{WRAPPER}} .sa-el-whatsapp-link:hover',
                ]
        );

        $this->add_control('button_border_radius_hover',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link:hover' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'label' => __('Icon Shadow', SA_EL_ADDONS_TEXTDOMAIN),
                    'name' => 'button_icon_shadow_hover',
                    'selector' => '{{WRAPPER}} .sa-el-whatsapp-link:hover i',
                    'condition' => [
                        'icon_switcher' => 'yes',
                        'icon_selection_updated!' => '',
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'label' => __('Text Shadow', SA_EL_ADDONS_TEXTDOMAIN),
                    'name' => 'button_text_shadow_hover',
                    'selector' => '{{WRAPPER}} .sa-el-button:hover span',
                    'condition' => [
                        'button_text!' => ''
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'label' => __('Button Shadow', SA_EL_ADDONS_TEXTDOMAIN),
                    'name' => 'button_shadow_hover',
                    'selector' => '{{WRAPPER}} .sa-el-whatsapp-link:hover',
                ]
        );

        $this->add_responsive_control('button_margin_hover',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('button_padding_hover',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-whatsapp-link:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * renders the HTML content of the widget
     * @return void
     */
    protected function render() {

        $settings = $this->get_settings_for_display();

        $breakpoints = Responsive::get_breakpoints();

        $pa_whats_chat_settings = array(
            'tooltips' => $settings['tooltips'],
            'anim' => $settings['tooltips_anim'],
            'hideMobile' => $settings['hide_mobiles'] == 'yes' ? true : false,
            'hideTab' => $settings['hide_tabs'] == 'yes' ? true : false,
            'mob' => $breakpoints['md'],
            'tab' => $breakpoints['lg'],
            'id' => $this->get_id()
        );

        $target = 'yes' == $settings['link_new_tab'] ? "_blank" : "_self";

        $id = ( 'private' == $settings['chat_type'] ) ? $settings['number'] : $settings['group_id'];

        $is_mobile = ( wp_is_mobile() ) ? 'api' : 'web';

        $browser = $_SERVER['HTTP_USER_AGENT'];

        $is_firefox = ( false !== strpos($browser, 'Firefox') ) ? 'web' : 'chat';

        $prefix = ( 'private' == $settings['chat_type'] ) ? $is_mobile : $is_firefox;

        $suffix = ( 'private' == $settings['chat_type'] ) ? 'send?phone=' : '';

        $href = sprintf('https://%s.whatsapp.com/%s%s', $prefix, $suffix, $id);

        $pos = 'yes' == $settings['button_float'] ? 'sa-el-button-float' : '';

        $button_size = 'sa-el-button-' . $settings['button_size'];

        $this->add_render_attribute('whatsapp', 'class', 'sa-el-whatsapp-container');

        $this->add_render_attribute('whatsapp', 'data-settings', wp_json_encode($pa_whats_chat_settings));

        $this->add_render_attribute('button_link', 'class', ['sa-el-whatsapp-link', $button_size, $pos, $settings['position'], 'elementor-animation-' . $settings['button_hover_animation']]);

        $this->add_render_attribute('button_link', 'data-tooltip-content', '#tooltip_content');

        $this->add_render_attribute('button_link', 'href', esc_attr($href));

        $this->add_render_attribute('button_link', 'target', $target);

        if ('yes' === $settings['icon_switcher']) {

            if (!empty($settings['icon_selection'])) {
                $this->add_render_attribute('icon', 'class', array(
                    'sa-el-whatsapp-icon',
                    $settings['icon_selection']
                ));
                $this->add_render_attribute('icon', 'aria-hidden', 'true');
            }

            $migrated = isset($settings['__fa4_migrated']['icon_selection_updated']);
            $is_new = empty($settings['icon_selection']) && Icons_Manager::is_migration_allowed();
        }
        ?>

        <div <?php echo $this->get_render_attribute_string('whatsapp'); ?>>
            <div class="sa-el-whatsapp-link-wrap">
                <a <?php echo $this->get_render_attribute_string('button_link'); ?>>
                    <?php if (!empty($settings['button_text'])) : ?>
                        <span class="sa-el-whatsapp-text"><?php echo esc_html($settings['button_text']); ?></span>
                    <?php endif; ?>
                    <?php
                    if ('yes' === $settings['icon_switcher']) :
                        if ($is_new || $migrated) :
                            Icons_Manager::render_icon($settings['icon_selection_updated'], ['class' => 'sa-el-whatsapp-icon', 'aria-hidden' => 'true']);
                        else:
                            ?>
                            <i <?php echo $this->get_render_attribute_string('icon'); ?>></i>
                        <?php
                        endif;
                    endif;
                    ?>
                    <?php if ('yes' == $settings['tooltips']) : ?>
                        <div id="tooltip_content">
                            <span><?php echo esc_html($settings['tooltips_msg']); ?></span>
                        </div>
                    <?php endif; ?>
                </a>

            </div>

        </div>

        <?php
    }

}
