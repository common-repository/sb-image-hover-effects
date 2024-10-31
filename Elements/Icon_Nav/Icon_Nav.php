<?php

namespace SA_EL_ADDONS\Elements\Icon_Nav;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use SA_EL_ADDONS\Elements\Icon_Nav\Files\IconNav;

class Icon_Nav extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_icon_nav';
    }

    public function get_title() {
        return esc_html__('Icon Nav', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-navigation-vertical  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'section_content_iconnav',
                [
                    'label' => esc_html__('Iconnav', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'iconnavs',
                [
                    'label' => esc_html__('Iconnav Items', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::REPEATER,
                    'default' => [
                        [
                            'iconnav_title' => esc_html__('Home page', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-home',
                            'iconnav_link' => [
                                'url' => esc_html__('#', SA_EL_ADDONS_TEXTDOMAIN),
                            ]
                        ],
                        [
                            'iconnav_title' => esc_html__('Support', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-wrench',
                            'iconnav_link' => [
                                'url' => esc_html__('#', SA_EL_ADDONS_TEXTDOMAIN),
                            ]
                        ],
                        [
                            'iconnav_title' => esc_html__('Blog', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-book',
                            'iconnav_link' => [
                                'url' => esc_html__('#', SA_EL_ADDONS_TEXTDOMAIN),
                            ]
                        ],
                        [
                            'iconnav_title' => esc_html__('About Us', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-envelope-o',
                            'iconnav_link' => [
                                'url' => esc_html__('#', SA_EL_ADDONS_TEXTDOMAIN),
                            ]
                        ],
                    ],
                    'fields' => [
                        [
                            'name' => 'icon',
                            'label' => esc_html__('Icon', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::ICON,
                            'default' => 'fa fa-home',
                        ],
                        [
                            'name' => 'iconnav_title',
                            'label' => esc_html__('Iconnav Title', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::TEXT,
                            'default' => esc_html__('Iconnav Title', SA_EL_ADDONS_TEXTDOMAIN),
                            'dynamic' => ['active' => true],
                        ],
                        [
                            'name' => 'iconnav_link',
                            'label' => esc_html__('Link', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::URL,
                            'default' => ['url' => '#'],
                            'description' => 'Add your section id WITH the # key. e.g: #my-id also you can add internal/external URL',
                            'dynamic' => ['active' => true],
                        ],
                    ],
                    'title_field' => '{{{ iconnav_title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_content_offcanvas_layout',
                [
                    'label' => esc_html__('Offcanvas Menu', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'navbar',
                [
                    'label' => esc_html__('Select Menu', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => esc_html__('Child menu not visible in off-canvas for some design issue.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => '0',
                    'options' => $this->sa_el_get_menus(),
                ]
        );

        $this->add_control(
                'navbar_level',
                [
                    'label' => esc_html__('Max Menu Level', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => esc_html__('You can set max 3 level menu because of design issue.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 1,
                    'options' => [
                        1 => esc_html__('Level 1', SA_EL_ADDONS_TEXTDOMAIN),
                        2 => esc_html__('Level 2', SA_EL_ADDONS_TEXTDOMAIN),
                        3 => esc_html__('Level 3', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'offcanvas_overlay',
                [
                    'label' => esc_html__('Overlay', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'condition' => [
                        'navbar!' => '0',
                    ],
                ]
        );

        $this->add_control(
                'offcanvas_animations',
                [
                    'label' => esc_html__('Animations', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'slide',
                    'options' => [
                        'slide' => esc_html__('Slide', SA_EL_ADDONS_TEXTDOMAIN),
                        'push' => esc_html__('Push', SA_EL_ADDONS_TEXTDOMAIN),
                        'reveal' => esc_html__('Reveal', SA_EL_ADDONS_TEXTDOMAIN),
                        'none' => esc_html__('None', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'condition' => [
                        'navbar!' => '0',
                    ],
                ]
        );

        $this->add_control(
                'offcanvas_flip',
                [
                    'label' => esc_html__('Flip', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'true',
                    'condition' => [
                        'navbar!' => '0',
                    ],
                ]
        );

        $this->add_control(
                'offcanvas_close_button',
                [
                    'label' => esc_html__('Close Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'condition' => [
                        'navbar!' => '0',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_content_branding',
                [
                    'label' => esc_html__('Branding', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'show_branding',
                [
                    'label' => __('Show Branding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'branding_image',
                [
                    'label' => __('Choose Branding Image', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'condition' => [
                        'show_branding' => 'yes',
                    ],
                ]
        );

        $this->add_responsive_control(
                'brading_space',
                [
                    'label' => __('Space', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 30,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-branding' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_content_additional_settings',
                [
                    'label' => esc_html__('Additional Settings', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'menu_text',
                [
                    'label' => esc_html__('Menu Text', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'show_as_tooltip',
                    'options' => [
                        'show_as_tooltip' => esc_html__('Show as Tooltip', SA_EL_ADDONS_TEXTDOMAIN),
                        'show_under_icon' => esc_html__('Show Under Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    ]
                ]
        );

        $this->add_responsive_control(
                'iconnav_width',
                [
                    'label' => esc_html__('Iconnav Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 48,
                            'max' => 120,
                            'step' => 2,
                        ],
                    ],
                    'default' => [
                        'size' => 48,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-container' => 'width: {{SIZE}}{{UNIT}};',
                        'body:not(.sa-el-offcanvas-flip) #sa-el-offcanvas{{ID}}.sa-el-offcanvas.sa-el-icon-nav-left' => 'left: {{SIZE}}{{UNIT}};',
                        'body.sa-el-offcanvas-flip #sa-el-offcanvas{{ID}}.sa-el-offcanvas.sa-el-icon-nav-right' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'iconnav_position',
                [
                    'label' => esc_html__('Iconnav Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'left' => esc_html__('Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'right' => esc_html__('Right', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_responsive_control(
                'iconnav_top_offset',
                [
                    'label' => __('Top Offset', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 80,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-container' => 'padding-top: {{SIZE}}{{UNIT}};',
                        '#sa-el-offcanvas{{ID}}.sa-el-offcanvas .sa-el-offcanvas-bar' => 'padding-top: calc({{SIZE}}{{UNIT}} + {{brading_space.SIZE}}px + 50px);',
                    ],
                ]
        );

        $this->add_responsive_control(
                'iconnav_gap',
                [
                    'label' => __('Icon Gap', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav-container ul.sa-el-icon-nav.sa-el-icon-nav-vertical li + li' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'iconnav_tooltip_spacing',
                [
                    'label' => __('Tooltip Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 5,
                    ],
                    'separator' => 'before',
                    'condition' => [
                        'menu_text' => 'show_as_tooltip',
                    ],
                ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();
        $this->start_controls_section(
                'section_style_iconnav',
                [
                    'label' => esc_html__('Iconnav', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'iconnav_background',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-container' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'iconnav_border',
                    'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-container',
                ]
        );

        $this->add_responsive_control(
                'iconnav_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'iconnav_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-container',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_iconnav_icon',
                [
                    'label' => esc_html__('Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs('tabs_iconnav_icon_style');

        $this->start_controls_tab(
                'tab_iconnav_icon_normal',
                [
                    'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_responsive_control(
                'iconnav_icon_size',
                [
                    'label' => esc_html__('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 48,
                        ],
                    ],
                    'default' => [
                        'size' => 16,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-icon-wrapper' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'iconnav_icon_background',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-icon-wrapper' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'iconnav_icon_border',
                    'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-icon-wrapper',
                ]
        );

        $this->add_responsive_control(
                'iconnav_icon_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'iconnav_icon_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-icon-wrapper',
                ]
        );

        $this->add_responsive_control(
                'iconnav_icon_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-icon-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'iconnav_icon_margin',
                [
                    'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-icon-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'iconnav_icon_hover',
                [
                    'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'iconnav_icon_hover_background',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-icon-wrapper:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'iconnav_icon_hover_border_color',
                [
                    'label' => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'iconnav_icon_border_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-icon-wrapper:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'iconnav_icon_active',
                [
                    'label' => esc_html__('Active', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'iconnav_icon_active_background',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-icon-wrapper' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'iconnav_icon_active_border_color',
                [
                    'label' => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'iconnav_icon_border_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-icon-wrapper' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_tooltip',
                [
                    'label' => esc_html__('Tooltip', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'menu_text' => 'show_as_tooltip',
                    ],
                ]
        );

        $this->add_control(
                'tooltip_background',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .tippy-backdrop' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'tooltip_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .tippy-backdrop' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'tooltip_border',
                    'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .sa-el-icon-nav .tippy-tooltip',
                ]
        );

        $this->add_responsive_control(
                'tooltip_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .tippy-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'tooltip_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-icon-nav .tippy-tooltip',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'tooltip_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-icon-nav .tippy-backdrop',
                ]
        );

        $this->add_control(
                'tooltip_animation',
                [
                    'label' => esc_html__('Tooltip Animation', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '' => esc_html__('Default', SA_EL_ADDONS_TEXTDOMAIN),
                        'shift-toward' => esc_html__('Shift Toward', SA_EL_ADDONS_TEXTDOMAIN),
                        'fade' => esc_html__('Fade', SA_EL_ADDONS_TEXTDOMAIN),
                        'scale' => esc_html__('Scale', SA_EL_ADDONS_TEXTDOMAIN),
                        'perspective' => esc_html__('Perspective', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'tooltip_size',
                [
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

        $this->start_controls_section(
                'section_style_menu_text',
                [
                    'label' => esc_html__('Menu Text', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'menu_text!' => 'show_as_tooltip',
                    ],
                ]
        );

        $this->add_control(
                'menu_text_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-menu-text' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'menu_text_spacing',
                [
                    'label' => esc_html__('Space', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-menu-text' => 'margin-top: {{SIZE}}px;',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'menu_text_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-icon-nav .sa-el-menu-text',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_offcanvas_content',
                [
                    'label' => esc_html__('Offcanvas', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'navbar!' => '0',
                    ],
                ]
        );

        $this->add_control(
                'offcanvas_content_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '#sa-el-offcanvas{{ID}}.sa-el-offcanvas .sa-el-offcanvas-bar *' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'offcanvas_content_link_color',
                [
                    'label' => esc_html__('Link Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '#sa-el-offcanvas{{ID}}.sa-el-offcanvas .sa-el-offcanvas-bar ul > li a' => 'color: {{VALUE}};',
                        '#sa-el-offcanvas{{ID}}.sa-el-offcanvas .sa-el-offcanvas-bar a *' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'offcanvas_content_link_hover_color',
                [
                    'label' => esc_html__('Link Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '#sa-el-offcanvas{{ID}}.sa-el-offcanvas .sa-el-offcanvas-bar ul > li a:hover' => 'color: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->add_control(
                'offcanvas_content_link_active_color',
                [
                    'label' => esc_html__('Link Active Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '#sa-el-offcanvas{{ID}}.sa-el-offcanvas .sa-el-offcanvas-bar ul > li.sa-el-active a:before' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'offcanvas_content_background_color',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '#sa-el-offcanvas{{ID}}.sa-el-offcanvas .sa-el-offcanvas-bar' => 'background-color: {{VALUE}} !important;',
                    ],
                    'separator' => 'before',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'offcanvas_content_box_shadow',
                    'selector' => '#sa-el-offcanvas{{ID}}.sa-el-offcanvas .sa-el-offcanvas-bar',
                ]
        );

        $this->add_responsive_control(
                'offcanvas_content_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '#sa-el-offcanvas{{ID}}.sa-el-offcanvas .sa-el-offcanvas-bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_branding',
                [
                    'label' => esc_html__('Branding', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_branding' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'branding_background',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-branding' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'branding_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-branding' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'branding_border',
                    'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-branding',
                ]
        );

        $this->add_responsive_control(
                'branding_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-branding' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'branding_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-branding',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'branding_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-icon-nav .sa-el-icon-nav-branding',
                ]
        );

        $this->end_controls_section();
    }

    public function render_loop_iconnav_list($list) {
        $settings = $this->get_settings();

        $scroll_active = (preg_match("/(#\s*([a-z]+)\s*)/", $list['iconnav_link']['url'])) ? 'sa-el-scroll' : '';

        $this->add_render_attribute('iconnav-item-link', 'class', 'sa-el-icon-nav-icon-wrapper', true);
        $this->add_render_attribute('iconnav-item-link', 'href', $list['iconnav_link']['url'], true);

        if ($list['iconnav_link']['is_external']) {
            $this->add_render_attribute('iconnav-item-link', 'target', '_blank', true);
        }

        if ($list['iconnav_link']['nofollow']) {
            $this->add_render_attribute('iconnav-item-link', 'rel', 'nofollow', true);
        }

        $this->add_render_attribute('iconnav-item', 'class', 'sa-el-icon-nav-item');

        // Tooltip settings
        if ('show_as_tooltip' == $settings['menu_text']) {
            $this->add_render_attribute('iconnav-item', 'class', 'sa-el-tippy-tooltip', true);
            $this->add_render_attribute('iconnav-item', 'data-tippy', '', true);
            $this->add_render_attribute('iconnav-item', 'data-tippy-content', $list["iconnav_title"], true);
            if ($settings['tooltip_animation']) {
                $this->add_render_attribute('iconnav-item', 'data-tippy-animation', $settings['tooltip_animation'], true);
            }
            if ($settings['tooltip_size']) {
                $this->add_render_attribute('iconnav-item', 'data-tippy-size', $settings['tooltip_size'], true);
            }
            if ($settings['iconnav_tooltip_spacing']['size']) {
                $this->add_render_attribute('iconnav-item', 'data-tippy-distance', $settings['iconnav_tooltip_spacing']['size'], true);
            }
            $this->add_render_attribute('iconnav-item', 'data-tippy-placement', 'left', true);
        } else {
            $this->add_render_attribute('iconnav-item-link', 'title', $list["iconnav_title"], true);
        }
        ?>
        <li <?php echo $this->get_render_attribute_string('iconnav-item'); ?>>
            <a <?php echo $this->get_render_attribute_string('iconnav-item-link'); ?> <?php echo $scroll_active; ?>>
                <?php if ($list['icon']) : ?>
                    <span class="sa-el-icon-nav-icon">
                        <i class="<?php echo esc_attr($list['icon']); ?>"></i>
                    </span>
                <?php endif; ?>

                <?php if ('show_under_icon' == $settings['menu_text']) : ?>
                    <span class="sa-el-menu-text sa-el-display-block sa-el-text-small"><?php echo esc_attr($list["iconnav_title"]); ?></span>
                <?php endif; ?>
            </a>
        </li>
        <?php
    }

    protected function render() {
        $settings = $this->get_settings();
        $id = $this->get_id();

        $this->add_render_attribute('icon-nav', 'class', 'sa-el-icon-nav');
        $this->add_render_attribute('icon-nav', 'id', 'sa-el-icon-nav-' . $id);

        $this->add_render_attribute('nav-container', 'class', ['sa-el-icon-nav-container', 'sa-el-icon-nav-' . $settings['iconnav_position']]);
        ?>
        <div <?php echo $this->get_render_attribute_string('icon-nav'); ?>>
            <div <?php echo $this->get_render_attribute_string('nav-container'); ?>>
                <div class="sa-el-icon-nav-branding">
                    <?php if ($settings['show_branding']) : ?>
                        <?php if (!empty($settings['branding_image']['url'])) : ?>
                            <div class="sa-el-logo-image"><img src="<?php echo esc_url($settings['branding_image']['url']); ?>" alt="<?php echo get_bloginfo('name'); ?>"></div>
                        <?php else : ?>
                            <?php
                            $string = get_bloginfo('name');
                            $words = explode(" ", $string);
                            $letters = "";
                            foreach ($words as $value) {
                                $letters .= substr($value, 0, 1);
                            }
                            ?>
                            <div><div class="sa-el-logo-txt">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"><?php echo esc_attr($letters); ?></a></div></div>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
                <ul class="sa-el-icon-nav sa-el-icon-nav-vertical">
                    <?php if ($settings['navbar']) : ?>
                        <li>
                            <a class="sa-el-icon-nav-icon-wrapper" href="#" sa-el-toggle="target: #sa-el-offcanvas<?php echo esc_attr($id); ?>">
                                <span class="sa-el-icon-nav-icon">
                                    <i class="fa fa-navicon"></i>
                                </span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php
                    foreach ($settings['iconnavs'] as $key => $nav) :
                        $this->render_loop_iconnav_list($nav);
                    endforeach;
                    ?>
                </ul>
            </div>
        </div>

        <?php if ($settings['navbar']) : ?>
            <?php $this->offcanvas($settings); ?>
            <?php
        endif;
    }

    private function offcanvas($settings) {
        $id = $this->get_id();

        $this->add_render_attribute(
                [
                    'offcanvas-settings' => [
                        'id' => 'sa-el-offcanvas' . $id,
                        'class' => [
                            'sa-el-offcanvas',
                            'sa-el-icon-nav-offcanvas',
                            'sa-el-icon-nav-' . $settings['iconnav_position']
                        ],
                    ]
                ]
        );

        $this->add_render_attribute('offcanvas-settings', 'sa-el-offcanvas', 'mode: ' . $settings['offcanvas_animations'] . ';');

        if ($settings['offcanvas_overlay']) {
            $this->add_render_attribute('offcanvas-settings', 'sa-el-offcanvas', 'overlay: true;');
        }

        if ($settings['offcanvas_flip']) {
            $this->add_render_attribute('offcanvas-settings', 'sa-el-offcanvas', 'flip: true;');
        }

        $nav_menu = !empty($settings['navbar']) ? wp_get_nav_menu_object($settings['navbar']) : false;
        $navbar_attr = [];
        if (!$nav_menu) {
            return;
        }

        if (1 < $settings['navbar_level']) {
            $nav_class = 'sa-el-nav sa-el-nav-default sa-el-nav-parent-icon';
        } else {
            $nav_class = 'sa-el-nav sa-el-nav-default';
        }

        $nav_menu_args = array(
            'fallback_cb' => false,
            'container' => false,
            'items_wrap' => '<ul id="%1$s" class="%2$s" sa-el-nav>%3$s</ul>',
            'menu_id' => 'sa-el-navmenu',
            'menu_class' => $nav_class,
            'theme_location' => 'default_navmenu', // creating a fake location for better functional control
            'menu' => $nav_menu,
            'echo' => true,
            'depth' => $settings['navbar_level'],
            'walker' => new IconNav
        );
        ?>		
        <div <?php echo $this->get_render_attribute_string('offcanvas-settings'); ?>>
            <div class="sa-el-offcanvas-bar">

                <?php if ($settings['offcanvas_close_button']) : ?>
                    <button class="sa-el-offcanvas-close" type="button" sa-el-close></button>
                <?php endif; ?>

                <div id="sa-el-navbar-<?php echo esc_attr($id); ?>" class="sa-el-navbar-wrapper">
                    <?php wp_nav_menu(apply_filters('widget_nav_menu_args', $nav_menu_args, $nav_menu, $settings)); ?>
                </div>
            </div>
        </div>
        <?php
    }

    protected function _content_template() {
        $id = $this->get_id();
        ?>

        <#
        view.addRenderAttribute( 'icon-nav', 'class', 'sa-el-icon-nav' );
        view.addRenderAttribute( 'nav-container', 'class', ['sa-el-icon-nav-container', 'sa-el-icon-nav-' + settings.iconnav_position] );

        #>
        <div <# print(view.getRenderAttributeString( 'icon-nav')); #>>
            <div <# print(view.getRenderAttributeString( 'nav-container')); #>>
                <div class="sa-el-icon-nav-branding">
                    <# if ( settings.show_branding) { #>
                    <# if ( settings.branding_image.url ) { #>
                    <div class="sa-el-logo-image"><img src="{{{settings.branding_image.url}}}"></div>
                    <# } else { #>
                    <#
                    var letters = 'SA';
                    #>
                    <div><div class="sa-el-logo-txt">
                            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">{{{letters}}}</a></div></div>
                    <# } #>
                    <# } #>

                </div>
                <ul class="sa-el-icon-nav sa-el-icon-nav-vertical">
                    <# if ( settings.navbar ) { #>
                    <li>
                        <a class="sa-el-icon-nav-icon-wrapper" href="#" sa-el-toggle="target: #sa-el-offcanvas<?php echo esc_attr($id); ?>">
                            <span class="sa-el-icon-nav-icon">
                                <i class="fa fa-navicon"></i>
                            </span>
                        </a>
                    </li>
                    <# } #>

                    <# _.each( settings.iconnavs, function( item ) { 

                    view.addRenderAttribute( 'iconnav-item-link', 'class', 'sa-el-icon-nav-icon-wrapper', true );
                    view.addRenderAttribute( 'iconnav-item-link', 'href', item.iconnav_link.url, true );

                    if ( item.iconnav_link.is_external ) {
                    view.addRenderAttribute( 'iconnav-item-link', 'target', '_blank', true );
                    }

                    if ( item.iconnav_link.nofollow ) {
                    view.addRenderAttribute( 'iconnav-item-link', 'rel', 'nofollow', true );
                    }

                    view.addRenderAttribute( 'iconnav-item', 'class', 'sa-el-icon-nav-item' );

                    if ( 'show_as_tooltip' == settings.menu_text ) {
                    view.addRenderAttribute( 'iconnav-item', 'class', 'sa-el-tippy-tooltip', true );
                    view.addRenderAttribute( 'iconnav-item', 'data-tippy', '', true );
                    view.addRenderAttribute( 'iconnav-item', 'title', item.iconnav_title, true );

                    if (settings.tooltip_animation) {
                    view.addRenderAttribute( 'iconnav-item', 'data-tippy-animation', settings.tooltip_animation, true );
                    }
                    if (settings.tooltip_size) {
                    view.addRenderAttribute( 'iconnav-item', 'data-tippy-size', settings.tooltip_size, true );
                    }
                    if (settings.iconnav_tooltip_spacing.size) {
                    view.addRenderAttribute( 'iconnav-item', 'data-tippy-distance', settings.iconnav_tooltip_spacing.size, true );
                    }
                    view.addRenderAttribute( 'iconnav-item', 'data-tippy-placement', 'left', true );
                    } else {
                    view.addRenderAttribute( 'iconnav-item-link', 'title', item.iconnav_title, true );
                    }		

                    #>
                    <li <# print(view.getRenderAttributeString( 'iconnav-item' )); #>>
                        <a <# print(view.getRenderAttributeString( 'iconnav-item-link' )); #>>
                            <# if (item.icon) { #>
                            <span class="sa-el-icon-nav-icon">
                                <i class="{{{item.icon}}}"></i>
                            </span>
                            <# } #>

                            <# if ('show_under_icon' == settings.menu_text) { #>
                            <span class="sa-el-menu-text sa-el-display-block sa-el-text-small">{{{item.iconnav_title}}}</span>
                            <# } #>
                        </a>
                    </li>
                    <# }); #>

                </ul>
            </div>
        </div>

        <# if ( settings.navbar ) { #>


        <# } #>

        <?php
    }

}
