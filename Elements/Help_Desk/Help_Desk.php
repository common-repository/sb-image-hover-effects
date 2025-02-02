<?php

namespace SA_EL_ADDONS\Elements\Help_Desk;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Image Accordion
 *
 * @author biplo
 * 
 */
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

class Help_Desk extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_help_desk';
    }

    public function get_title() {
        return esc_html__('Help Desk', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-help  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
                'section_helpdesk_layout', [
            'label' => esc_html__('Layout', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'helpdesk_position', [
            'label' => __('Position', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'left' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                'right' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'default' => 'right',
            'selectors' => [
                '{{WRAPPER}} .sa-el-helpdesk-icons' => '{{VALUE}} : 30px;',
            ],
                ]
        );

        $this->add_control(
                'helpdesk_icon', [
            'label' => esc_html__('Icon', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::ICON,
            'label_block' => true,
            'default' => "fa fa-support",
                ]
        );

        $this->add_responsive_control(
                'helpdesk_size', [
            'label' => esc_html__('Icon Size', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 35,
                    'max' => 100,
                    'step' => 5,
                ],
            ],
            'default' => [
                'size' => 50,
            ],
            'size_units' => ['px'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-helpdesk .sa-el-helpdesk-icons-item, {{WRAPPER}} .sa-el-helpdesk .sa-el-helpdesk-icons-open-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_responsive_control(
                'helpdesk_space', [
            'label' => esc_html__('Icon Space', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                ],
            ],
            'size_units' => ['px'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-helpdesk-icons-open:checked ~ .sa-el-helpdesk-icons-item:nth-child(3)' => 'transform: translate3d(0, calc(-{{SIZE}}{{UNIT}} - {{helpdesk_size.SIZE}}{{UNIT}}), 0);',
                '{{WRAPPER}} .sa-el-helpdesk-icons-open:checked ~ .sa-el-helpdesk-icons-item:nth-child(4)' => 'transform: translate3d(0, calc(-{{SIZE}}{{UNIT}} * 2 - {{helpdesk_size.SIZE}}{{UNIT}} * 2), 0);',
                '{{WRAPPER}} .sa-el-helpdesk-icons-open:checked ~ .sa-el-helpdesk-icons-item:nth-child(5)' => 'transform: translate3d(0, calc(-{{SIZE}}{{UNIT}} * 3 - {{helpdesk_size.SIZE}}{{UNIT}} * 3), 0);',
                '{{WRAPPER}} .sa-el-helpdesk-icons-open:checked ~ .sa-el-helpdesk-icons-item:nth-child(6)' => 'transform: translate3d(0, calc(-{{SIZE}}{{UNIT}} * 4 - {{helpdesk_size.SIZE}}{{UNIT}} * 4), 0);',
            ],
                ]
        );

        $this->add_control(
                'helpdesk_title', [
            'label' => esc_html__('Main Icon Title', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'render_type' => 'template',
            'default' => 'Need help? Contact us with your favorite way.',
            'dynamic' => ['active' => true],
                ]
        );

        $this->add_control(
                'messenger_show', [
            'label' => esc_html__('Messenger', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'whatsapp_show', [
            'label' => esc_html__('WhatsApp', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'telegram_show', [
            'label' => esc_html__('Telegram', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
                ]
        );


        $this->add_control(
                'custom_show', [
            'label' => esc_html__('Custom', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
                ]
        );

        $this->add_control(
                'mailto_show', [
            'label' => esc_html__('Email', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_helpdesk_messenger', [
            'label' => esc_html__('Messenger', SA_EL_ADDONS_TEXTDOMAIN),
            'condition' => [
                'messenger_show' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'messenger_title', [
            'label' => esc_html__('Title', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'render_type' => 'template',
            'default' => 'Chat on messenger',
            'dynamic' => ['active' => true],
                ]
        );

        $this->add_control(
                'messenger_link', [
            'label' => esc_html__('Link/ID', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::URL,
            'dynamic' => ['active' => true],
            'placeholder' => esc_html__('themes', SA_EL_ADDONS_TEXTDOMAIN),
            'default' => [
                'url' => 'themes',
            ],
                ]
        );

        $this->add_control(
                'messenger_onclick', [
            'label' => esc_html__('OnClick', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
                ]
        );

        $this->add_control(
                'messenger_onclick_event', [
            'label' => esc_html__('OnClick Event', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'placeholder' => 'myFunction()',
            'description' => sprintf(__('For details please look <a href="%s" target="_blank">here</a>'), 'https://www.w3schools.com/jsref/event_onclick.asp'),
            'condition' => [
                'messenger_onclick' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'messenger_icon', [
            'label' => esc_html__('Icon', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::ICON,
            'label_block' => true,
            'default' => "fa fa-comment",
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_helpdesk_whatsapp', [
            'label' => esc_html__('WhatsApp', SA_EL_ADDONS_TEXTDOMAIN),
            'condition' => [
                'whatsapp_show' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'whatsapp_title', [
            'label' => esc_html__('Title', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'render_type' => 'template',
            'default' => 'Call via whatsapp',
            'dynamic' => ['active' => true],
                ]
        );

        $this->add_control(
                'whatsapp_link', [
            'label' => esc_html__('Number', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::URL,
            'dynamic' => ['active' => true],
            'placeholder' => esc_html__('+8801720000010', SA_EL_ADDONS_TEXTDOMAIN),
            'default' => [
                'url' => '+8801720000010',
            ],
                ]
        );

        $this->add_control(
                'whatsapp_onclick', [
            'label' => esc_html__('OnClick', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
                ]
        );

        $this->add_control(
                'whatsapp_onclick_event', [
            'label' => esc_html__('OnClick Event', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'placeholder' => 'myFunction()',
            'description' => sprintf(__('For details please look <a href="%s" target="_blank">here</a>'), 'https://www.w3schools.com/jsref/event_onclick.asp'),
            'condition' => [
                'whatsapp_onclick' => 'yes'
            ],
                ]
        );

        $this->add_control(
                'whatsapp_icon', [
            'label' => esc_html__('Icon', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::ICON,
            'label_block' => true,
            'default' => "fa fa-whatsapp",
                ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
                'section_helpdesk_telegram', [
            'label' => esc_html__('Telegram', SA_EL_ADDONS_TEXTDOMAIN),
            'condition' => [
                'telegram_show' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'telegram_title', [
            'label' => esc_html__('Title', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'render_type' => 'template',
            'default' => 'Chat on telegram',
            'dynamic' => ['active' => true],
                ]
        );

        $this->add_control(
                'telegram_link', [
            'label' => esc_html__('User ID', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::URL,
            'dynamic' => ['active' => true],
            'placeholder' => esc_html__('themes', SA_EL_ADDONS_TEXTDOMAIN),
            'default' => [
                'url' => 'themes',
            ],
                ]
        );

        $this->add_control(
                'telegram_onclick', [
            'label' => esc_html__('OnClick', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
                ]
        );

        $this->add_control(
                'telegram_onclick_event', [
            'label' => esc_html__('OnClick Event', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'placeholder' => 'myFunction()',
            'description' => sprintf(__('For details please look <a href="%s" target="_blank">here</a>'), 'https://www.w3schools.com/jsref/event_onclick.asp'),
            'condition' => [
                'telegram_onclick' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'telegram_icon', [
            'label' => esc_html__('Icon', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::ICON,
            'label_block' => true,
            'default' => "fa fa-telegram",
                ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
                'section_helpdesk_custom', [
            'label' => esc_html__('Custom', SA_EL_ADDONS_TEXTDOMAIN),
            'condition' => [
                'custom_show' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'custom_title', [
            'label' => esc_html__('Title', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'render_type' => 'template',
            'default' => 'Chat with us',
            'dynamic' => ['active' => true],
                ]
        );

        $this->add_control(
                'custom_link', [
            'label' => esc_html__('Link', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::URL,
            'dynamic' => ['active' => true],
            'placeholder' => esc_html__('https://sample.com', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'custom_onclick', [
            'label' => esc_html__('OnClick', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
                ]
        );

        $this->add_control(
                'custom_onclick_event', [
            'label' => esc_html__('OnClick Event', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'placeholder' => 'myFunction()',
            'default' => 'Intercom("show");',
            'description' => sprintf(__('For details please look <a href="%s" target="_blank">here</a>'), 'https://www.w3schools.com/jsref/event_onclick.asp'),
            'condition' => [
                'custom_onclick' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'custom_icon', [
            'label' => esc_html__('Icon', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::ICON,
            'label_block' => true,
            'default' => "fa fa-custom",
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_helpdesk_mailto', [
            'label' => esc_html__('Email', SA_EL_ADDONS_TEXTDOMAIN),
            'condition' => [
                'mailto_show' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'mailto_title', [
            'label' => esc_html__('Title', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'render_type' => 'template',
            'default' => 'Email Us',
            'dynamic' => ['active' => true],
                ]
        );


        $default_email = get_bloginfo('admin_email');

        $this->add_control(
                'mailto_link', [
            'label' => esc_html__('Email Address', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::URL,
            'dynamic' => ['active' => true],
            'placeholder' => $default_email,
            'default' => [
                'url' => $default_email,
            ],
                ]
        );

        $this->add_control(
                'mailto_subject', [
            'label' => esc_html__('Subject', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Support related issue', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'mailto_body', [
            'label' => esc_html__('Body Text', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Hello, I am contact with you because ', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'mailto_onclick', [
            'label' => esc_html__('OnClick', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
                ]
        );


        $this->add_control(
                'mailto_onclick_event', [
            'label' => esc_html__('OnClick Event', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'placeholder' => 'myFunction()',
            'description' => sprintf(__('For details please look <a href="%s" target="_blank">here</a>'), 'https://www.w3schools.com/jsref/event_onclick.asp'),
            'condition' => [
                'mailto_onclick' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'mailto_icon', [
            'label' => esc_html__('Icon', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::ICON,
            'label_block' => true,
            'default' => "fa fa-envelope",
                ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
                'section_helpdesk_additional', [
            'label' => esc_html__('Additional', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );


        $this->add_control(
                'helpdesk_horizontal_offset', [
            'label' => esc_html__('Horizontal Offset', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                    'step' => 5,
                ],
            ],
            'size_units' => ['px'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-helpdesk .sa-el-helpdesk-icons-item, {{WRAPPER}} .sa-el-helpdesk .sa-el-helpdesk-icons-open-button' => '{{helpdesk_position.VALUE}}: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'helpdesk_vertical_offset', [
            'label' => esc_html__('Vertical Offset', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                    'step' => 5,
                ],
            ],
            'size_units' => ['px'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-helpdesk .sa-el-helpdesk-icons' => 'bottom: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'helpdesk_tooltip', [
            'label' => esc_html__('Title as Tooltip', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'helpdesk_tooltip_placement', [
            'label' => esc_html__('Placement', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'left',
            'options' => [
                'top' => esc_html__('Top', SA_EL_ADDONS_TEXTDOMAIN),
                'bottom' => esc_html__('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                'left' => esc_html__('Left', SA_EL_ADDONS_TEXTDOMAIN),
                'right' => esc_html__('Right', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'render_type' => 'template',
            'condition' => [
                'helpdesk_tooltip' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'helpdesk_tooltip_animation', [
            'label' => esc_html__('Animation', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'shift-toward',
            'options' => [
                'shift-away' => esc_html__('Shift-Away', SA_EL_ADDONS_TEXTDOMAIN),
                'shift-toward' => esc_html__('Shift-Toward', SA_EL_ADDONS_TEXTDOMAIN),
                'fade' => esc_html__('Fade', SA_EL_ADDONS_TEXTDOMAIN),
                'scale' => esc_html__('Scale', SA_EL_ADDONS_TEXTDOMAIN),
                'perspective' => esc_html__('Perspective', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'render_type' => 'template',
            'condition' => [
                'helpdesk_tooltip' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'helpdesk_tooltip_x_offset', [
            'label' => esc_html__('Offset', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::NUMBER,
            'default' => 0,
            'min' => -1000,
            'max' => 1000,
            'step' => 1,
            'condition' => [
                'helpdesk_tooltip' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'helpdesk_tooltip_y_offset', [
            'label' => esc_html__('Distance', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::NUMBER,
            'default' => 0,
            'min' => -1000,
            'max' => 1000,
            'step' => 1,
            'condition' => [
                'helpdesk_tooltip' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'helpdesk_tooltip_arrow', [
            'label' => esc_html__('Arrow', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'condition' => [
                'helpdesk_tooltip' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'helpdesk_tooltip_trigger', [
            'label' => __('Trigger on Click', SA_EL_ADDONS_TEXTDOMAIN),
            'description' => __('Don\'t set yes when you set lightbox image with marker.', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'condition' => [
                'helpdesk_tooltip' => 'yes'
            ]
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();
        
        $this->start_controls_section(
                'section_style_helpdesk_main_icon', [
            'label' => esc_html__('Main Icons', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs('tabs_style_helpdesk');

        $this->start_controls_tab(
                'tab_style_helpdesk_normal', [
            'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control(
                'helpdesk_main_icon_color', [
            'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sa-el-helpdesk .sa-el-helpdesk-icons-open-button' => 'color: {{VALUE}};',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(), [
            'name' => 'helpdesk_main_icon_background',
            'selector' => '{{WRAPPER}} .sa-el-helpdesk .sa-el-helpdesk-icons-open-button'
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_style_helpdesk_main_icon_hover', [
            'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control(
                'helpdesk_main_icon_hover_color', [
            'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sa-el-helpdesk .sa-el-helpdesk-icons-open-button:hover' => 'color: {{VALUE}};',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(), [
            'name' => 'helpdesk_main_icon_hover_background',
            'selector' => '{{WRAPPER}} .sa-el-helpdesk .sa-el-helpdesk-icons-open-button:hover'
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
                'section_style_helpdesk_icons', [
            'label' => esc_html__('Icons Style', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs('tabs_style_helpdesk_icons');

        $this->start_controls_tab(
                'tab_style_helpdesk_icons_normal', [
            'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control(
                'helpdesk_icons_color', [
            'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sa-el-helpdesk .sa-el-helpdesk-icons-item' => 'color: {{VALUE}};',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(), [
            'name' => 'helpdesk_icons_background',
            'selector' => '{{WRAPPER}} .sa-el-helpdesk .sa-el-helpdesk-icons-item'
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_style_helpdesk_icons_hover', [
            'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control(
                'helpdesk_icons_hover_color', [
            'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sa-el-helpdesk .sa-el-helpdesk-icons-item:hover' => 'color: {{VALUE}};',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(), [
            'name' => 'helpdesk_icons_hover_background',
            'selector' => '{{WRAPPER}} .sa-el-helpdesk .sa-el-helpdesk-icons-item:hover'
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
                'section_style_tooltip', [
            'label' => esc_html__('Tooltip', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'helpdesk_tooltip' => 'yes'
            ]
                ]
        );

        $this->add_responsive_control(
                'helpdesk_tooltip_width', [
            'label' => esc_html__('Width', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [
                'px', 'em',
            ],
            'range' => [
                'px' => [
                    'min' => 50,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .tippy-tooltip' => 'width: {{SIZE}}{{UNIT}};',
            ],
            'render_type' => 'template',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'helpdesk_tooltip_typography',
            'selector' => '{{WRAPPER}} .tippy-tooltip .tippy-content',
                ]
        );

        $this->add_control(
                'helpdesk_tooltip_color', [
            'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tippy-tooltip' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'helpdesk_tooltip_text_align', [
            'label' => esc_html__('Text Alignment', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::CHOOSE,
            'default' => 'center',
            'options' => [
                'left' => [
                    'title' => esc_html__('Left', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'fa fa-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'fa fa-align-center',
                ],
                'right' => [
                    'title' => esc_html__('Right', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'fa fa-align-right',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .tippy-tooltip .tippy-content' => 'text-align: {{VALUE}};',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(), [
            'name' => 'helpdesk_tooltip_background',
            'selector' => '{{WRAPPER}} .tippy-tooltip, {{WRAPPER}} .tippy-tooltip .tippy-backdrop',
                ]
        );

        $this->add_control(
                'helpdesk_tooltip_arrow_color', [
            'label' => esc_html__('Arrow Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tippy-popper[x-placement^=left] .tippy-arrow' => 'border-left-color: {{VALUE}}',
                '{{WRAPPER}} .tippy-popper[x-placement^=right] .tippy-arrow' => 'border-right-color: {{VALUE}}',
                '{{WRAPPER}} .tippy-popper[x-placement^=top] .tippy-arrow' => 'border-top-color: {{VALUE}}',
                '{{WRAPPER}} .tippy-popper[x-placement^=bottom] .tippy-arrow' => 'border-bottom-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_responsive_control(
                'helpdesk_tooltip_padding', [
            'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .tippy-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'render_type' => 'template',
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(), [
            'name' => 'helpdesk_tooltip_border',
            'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
            'placeholder' => '1px',
            'default' => '1px',
            'selector' => '{{WRAPPER}} .tippy-tooltip',
                ]
        );

        $this->add_responsive_control(
                'helpdesk_tooltip_border_radius', [
            'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .tippy-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(), [
            'name' => 'helpdesk_tooltip_box_shadow',
            'selector' => '{{WRAPPER}} .tippy-tooltip',
                ]
        );

        $this->add_control(
                'tooltip_size', [
            'label' => esc_html__('Tooltip Size', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                '' => esc_html__('Default', SA_EL_ADDONS_TEXTDOMAIN),
                'large' => esc_html__('Large', SA_EL_ADDONS_TEXTDOMAIN),
                'small' => esc_html__('small', SA_EL_ADDONS_TEXTDOMAIN),
            ],
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $id = 'sa-el-helpdesk-icons-' . $this->get_id();
        ?>

        <div class="sa-el-helpdesk">
            <nav class="sa-el-helpdesk-icons">
                <input type="checkbox" href="#" class="sa-el-helpdesk-icons-open" name="sa-el-helpdesk-icons-open" id="<?php echo $id; ?>"/>
                <label class="sa-el-helpdesk-icons-open-button" for="<?php echo $id; ?>" title="<?php echo $settings['helpdesk_title']; ?>">
                    <i class="<?php echo esc_attr($settings['helpdesk_icon']); ?>" aria-hidden="true"></i>
                </label>
        <?php $this->sa_el_messenger(); ?>
        <?php $this->sa_el_whatsapp(); ?>
        <?php $this->sa_el_mailto(); ?>
        <?php $this->sa_el_telegram(); ?>
        <?php $this->sa_el_custom(); ?>
            </nav>


            <!-- filters -->
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="sa-el-hidden">
                <defs>
                    <filter id="sa-el-helpdesk-icon-wrapper">
                        <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="10" />
                        <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
                        <feGaussianBlur in="goo" stdDeviation="3" result="shadow" />
                        <feColorMatrix in="shadow" mode="matrix" values="0 0 0 0 0  0 0 0 0 0  0 0 0 0 0  0 0 0 0 -0.2" result="shadow" />
                        <feOffset in="shadow" dx="1" dy="1" result="shadow" />
                        <feComposite in2="shadow" in="goo" result="goo" />
                        <feComposite in2="goo" in="SourceGraphic" result="mix" />
                    </filter>
                    <filter id="goo">
                        <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="10" />
                        <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
                        <feComposite in2="goo" in="SourceGraphic" result="mix" />
                    </filter>
                </defs>
            </svg>
        </div>

        <?php
    }

    protected function sa_el_messenger() {
        $settings = $this->get_settings();

        if ('yes' != $settings['messenger_show']) {
            return;
        }

        $this->add_render_attribute('messenger', 'class', ['sa-el-helpdesk-icons-item', 'sa-el-hdi-messenger']);

        if (!empty($settings['messenger_link']['url'])) {

            $final_link = 'https://m.me/' . $settings['messenger_link']['url'];

            $this->add_render_attribute('messenger', 'href', $final_link);

            if ($settings['messenger_link']['is_external']) {
                $this->add_render_attribute('messenger', 'target', '_blank');
            }

            if ($settings['messenger_link']['nofollow']) {
                $this->add_render_attribute('messenger', 'rel', 'nofollow');
            }
        }

        if ($settings['messenger_link']['nofollow']) {
            $this->add_render_attribute('messenger', 'rel', 'nofollow');
        }

        if ($settings['messenger_onclick']) {
            $this->add_render_attribute('messenger', 'href', '#', true);
            $this->add_render_attribute('messenger', 'onclick', $settings['messenger_onclick_event']);
        }

        $this->add_render_attribute('messenger', 'data-tippy-content', $settings['messenger_title']);

        $this->sa_el_tooltip('messenger');
        ?>


        <a <?php echo $this->get_render_attribute_string('messenger'); ?>>
            <i class="<?php echo esc_attr($settings['messenger_icon']); ?>" aria-hidden="true"></i>
        </a>		

        <?php
    }

    protected function sa_el_whatsapp() {
        $settings = $this->get_settings();

        if ('yes' != $settings['whatsapp_show']) {
            return;
        }

        $this->add_render_attribute('whatsapp', 'class', ['sa-el-helpdesk-icons-item', 'sa-el-hdi-whatsapp']);

        if (!empty($settings['whatsapp_link']['url'])) {

            $final_link = 'https://wa.me/' . $settings['whatsapp_link']['url'];

            $this->add_render_attribute('whatsapp', 'href', $final_link);

            if ($settings['whatsapp_link']['is_external']) {
                $this->add_render_attribute('whatsapp', 'target', '_blank');
            }

            if ($settings['whatsapp_link']['nofollow']) {
                $this->add_render_attribute('whatsapp', 'rel', 'nofollow');
            }
        }

        if ($settings['whatsapp_link']['nofollow']) {
            $this->add_render_attribute('whatsapp', 'rel', 'nofollow');
        }

        if ($settings['whatsapp_onclick']) {
            $this->add_render_attribute('whatsapp', 'onclick', $settings['whatsapp_onclick_event']);
        }

        $this->add_render_attribute('whatsapp', 'data-tippy-content', $settings['whatsapp_title']);

        $this->sa_el_tooltip('whatsapp');
        ?>


        <a <?php echo $this->get_render_attribute_string('whatsapp'); ?>>
            <i class="<?php echo esc_attr($settings['whatsapp_icon']); ?>" aria-hidden="true"></i>
        </a>


        <?php
    }

    protected function sa_el_telegram() {
        $settings = $this->get_settings();

        if ('yes' != $settings['telegram_show']) {
            return;
        }

        $this->add_render_attribute('telegram', 'class', ['sa-el-helpdesk-icons-item', 'sa-el-hdi-telegram']);

        if (!empty($settings['telegram_link']['url'])) {

            $final_link = 'https://telegram.me/' . $settings['telegram_link']['url'];

            $this->add_render_attribute('telegram', 'href', esc_url($final_link));

            if ($settings['telegram_link']['is_external']) {
                $this->add_render_attribute('telegram', 'target', '_blank');
            }

            if ($settings['telegram_link']['nofollow']) {
                $this->add_render_attribute('telegram', 'rel', 'nofollow');
            }
        }

        if ($settings['telegram_link']['nofollow']) {
            $this->add_render_attribute('telegram', 'rel', 'nofollow');
        }

        if ($settings['telegram_onclick']) {
            $this->add_render_attribute('telegram', 'onclick', $settings['telegram_onclick_event']);
        }

        $this->add_render_attribute('telegram', 'data-tippy-content', $settings['telegram_title']);

        $this->sa_el_tooltip('telegram');
        ?>


        <a <?php echo $this->get_render_attribute_string('telegram'); ?>>
            <i class="<?php echo esc_attr($settings['telegram_icon']); ?>" aria-hidden="true"></i>
        </a>


        <?php
    }

    protected function sa_el_custom() {
        $settings = $this->get_settings();

        if ('yes' != $settings['custom_show']) {
            return;
        }

        $this->add_render_attribute('custom', 'class', ['sa-el-helpdesk-icons-item', 'sa-el-hdi-custom']);

        if (!empty($settings['custom_link']['url'])) {

            $final_link = $settings['custom_link']['url'];

            $this->add_render_attribute('custom', 'href', esc_url($final_link));

            if ($settings['custom_link']['is_external']) {
                $this->add_render_attribute('custom', 'target', '_blank');
            }

            if ($settings['custom_link']['nofollow']) {
                $this->add_render_attribute('custom', 'rel', 'nofollow');
            }

            $this->sa_el_tooltip('custom');
        }

        if ($settings['custom_link']['nofollow']) {
            $this->add_render_attribute('custom', 'rel', 'nofollow');
        }

        if ($settings['custom_onclick']) {
            $this->add_render_attribute('custom', 'onclick', $settings['custom_onclick_event']);
        }

        $this->add_render_attribute('custom', 'data-tippy-content', $settings['custom_title']);

        $this->sa_el_tooltip('custom');
        ?>


        <a <?php echo $this->get_render_attribute_string('custom'); ?>>
            <i class="<?php echo esc_attr($settings['custom_icon']); ?>" aria-hidden="true"></i>
        </a>


        <?php
    }

    protected function sa_el_mailto() {
        $settings = $this->get_settings();

        if ('yes' != $settings['mailto_show']) {
            return;
        }

        $this->add_render_attribute('mailto', 'class', ['sa-el-helpdesk-icons-item', 'sa-el-hdi-mailto']);

        if (!empty($settings['mailto_link']['url'])) {

            $final_link = 'mailto:';
            $final_link .= $settings['mailto_link']['url'];

            if ($settings['mailto_subject']) {

                $final_link .= '?subject=' . $settings['mailto_subject'];

                if ($settings['mailto_body']) {
                    $final_link .= '&amp;body=' . $settings['mailto_body'];
                }
            }

            $this->add_render_attribute('mailto', 'href', esc_url($final_link));

            if ($settings['mailto_link']['is_external']) {
                $this->add_render_attribute('mailto', 'target', '_blank');
            }

            if ($settings['mailto_link']['nofollow']) {
                $this->add_render_attribute('mailto', 'rel', 'nofollow');
            }
        }

        if ($settings['mailto_link']['nofollow']) {
            $this->add_render_attribute('mailto', 'rel', 'nofollow');
        }

        if ($settings['mailto_onclick']) {
            $this->add_render_attribute('mailto', 'onclick', $settings['mailto_onclick_event']);
        }

        $this->add_render_attribute('mailto', 'data-tippy-content', $settings['mailto_title']);

        $this->sa_el_tooltip('mailto');
        ?>


        <a <?php echo $this->get_render_attribute_string('mailto'); ?>>
            <i class="<?php echo esc_attr($settings['mailto_icon']); ?>" aria-hidden="true"></i>
        </a>


        <?php
    }

    public function sa_el_tooltip($icon) {
        $settings = $this->get_settings();

        if ('yes' != $settings['helpdesk_tooltip']) {
            return;
        }

        // Tooltip settings
        $this->add_render_attribute($icon, 'class', 'sa-el-tippy-tooltip');
        $this->add_render_attribute($icon, 'data-tippy', '');

        if ($settings['helpdesk_tooltip_placement']) {
            $this->add_render_attribute($icon, 'data-tippy-placement', $settings['helpdesk_tooltip_placement']);
        }

        if ($settings['helpdesk_tooltip_animation']) {
            $this->add_render_attribute($icon, 'data-tippy-animation', $settings['helpdesk_tooltip_animation']);
        }

        if ($settings['helpdesk_tooltip_x_offset']['size'] or $settings['helpdesk_tooltip_y_offset']['size']) {
            $this->add_render_attribute($icon, 'data-tippy-offset', $settings['helpdesk_tooltip_x_offset']['size'] . ',' . $settings['helpdesk_tooltip_y_offset']['size']);
        }

        if ('yes' == $settings['helpdesk_tooltip_arrow']) {
            $this->add_render_attribute($icon, 'data-tippy-arrow', 'true');
        }

        if ('yes' == $settings['helpdesk_tooltip_trigger']) {
            $this->add_render_attribute($icon, 'data-tippy-trigger', 'click');
        }
    }

}
