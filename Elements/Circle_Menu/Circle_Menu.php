<?php

namespace SA_EL_ADDONS\Elements\Circle_Menu;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

// use \SA_EL_ADDONS\Classes\Bootstrap;

class Circle_Menu extends Widget_Base {

   use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa-el-circle-menu';
    }

    public function get_title() {
        return esc_html__('Circle Menu', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-plus-circle oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    public function get_keywords() {
        return ['circle', 'menu', 'rounded'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'section_content_iconnav',
                [
                    'label' => esc_html__('Circle Menu', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'toggle_icon',
                [
                    'label' => __('Choose Toggle Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'fa fa-plus' => [
                            'title' => __('Plus', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-plus',
                        ],
                        'fa fa-plus-circle' => [
                            'title' => __('Plus Circle', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-plus-circle',
                        ],
                        'fa fa-times' => [
                            'title' => __('Close', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-times',
                        ],
                        'fa fa-cog' => [
                            'title' => __('Settings', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-cog',
                        ],
                        'fa fa-bars' => [
                            'title' => __('Bars', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-bars',
                        ],
                    ],
                    'default' => 'fa fa-plus',
                ]
        );

        $this->add_control(
                'circle_menu',
                [
                    'label' => esc_html__('Circle Menu Items', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::REPEATER,
                    'default' => [
                        [
                            'icon' => 'fa fa-home',
                            'iconnav_link' => [
                                'url' => esc_html__('#', SA_EL_ADDONS_TEXTDOMAIN),
                            ],
                            'title' => esc_html__('Home', SA_EL_ADDONS_TEXTDOMAIN)
                        ],
                        [
                            'icon' => 'fa fa-shopping-bag',
                            'iconnav_link' => [
                                'url' => esc_html__('#', SA_EL_ADDONS_TEXTDOMAIN),
                            ],
                            'title' => esc_html__('Products', SA_EL_ADDONS_TEXTDOMAIN)
                        ],
                        [
                            'icon' => 'fa fa-wrench',
                            'iconnav_link' => [
                                'url' => esc_html__('#', SA_EL_ADDONS_TEXTDOMAIN),
                            ],
                            'title' => esc_html__('Settings', SA_EL_ADDONS_TEXTDOMAIN)
                        ],
                        [
                            'icon' => 'fa fa-book',
                            'iconnav_link' => [
                                'url' => esc_html__('#', SA_EL_ADDONS_TEXTDOMAIN),
                            ],
                            'title' => esc_html__('Documentation', SA_EL_ADDONS_TEXTDOMAIN)
                        ],
                        [
                            'icon' => 'fa fa-envelope-o',
                            'iconnav_link' => [
                                'url' => esc_html__('#', SA_EL_ADDONS_TEXTDOMAIN),
                            ],
                            'title' => esc_html__('Contact Us', SA_EL_ADDONS_TEXTDOMAIN)
                        ],
                    ],
                    'fields' => [
                        [
                            'name' => 'title',
                            'label' => esc_html__('Menu Title', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::TEXT,
                            'dynamic' => ['active' => true],
                            'default' => 'Home',
                        ],
                        [
                            'name' => 'icon',
                            'label' => esc_html__('Icon', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::ICON,
                            'default' => 'fa fa-home',
                        ],
                        [
                            'name' => 'iconnav_link',
                            'label' => esc_html__('Link', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::URL,
                            'default' => ['url' => '#'],
                            'dynamic' => ['active' => true],
                            'description' => 'Add your section id WITH the # key. e.g: #my-id also you can add internal/external URL',
                        ],
                    ],
                    'title_field' => '{{{ title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_content_layout',
                [
                    'label' => esc_html__('Layout', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'toggle_icon_position',
                [
                    'label' => __('Toggle Icon Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', SA_EL_ADDONS_TEXTDOMAIN),
                        'top-left' => esc_html__('Top Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'top-center' => esc_html__('Top Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'top-right' => esc_html__('Top Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'center' => esc_html__('Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'center-left' => esc_html__('Center Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'center-right' => esc_html__('Center Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom-left' => esc_html__('Bottom Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom-center' => esc_html__('Bottom Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom-right' => esc_html__('Bottom Right', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'toggle_icon_x_position',
                [
                    'label' => __('Horizontal Offset', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0,
                    ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'step' => 10,
                            'max' => 500,
                        ],
                    ],
                ]
        );

        $this->add_control(
                'toggle_icon_y_position',
                [
                    'label' => __('Vertical Offset', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER, 'default' => [
                        'size' => 0,
                    ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'step' => 10,
                            'max' => 500,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu-container' => 'transform: translate({{toggle_icon_x_position.size}}px, {{SIZE}}px);',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_content_additional_settings',
                [
                    'label' => esc_html__('Additional Settings', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'direction',
                [
                    'label' => __('Menu Direction', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'bottom-right',
                    'options' => [
                        'top' => esc_html__('Top', SA_EL_ADDONS_TEXTDOMAIN),
                        'right' => esc_html__('Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom' => esc_html__('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                        'left' => esc_html__('Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'top' => esc_html__('Top', SA_EL_ADDONS_TEXTDOMAIN),
                        'full' => esc_html__('Full', SA_EL_ADDONS_TEXTDOMAIN),
                        'top-left' => esc_html__('Top-Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'top-right' => esc_html__('Top-Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'top-half' => esc_html__('Top-Half', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom-left' => esc_html__('Bottom-Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom-right' => esc_html__('Bottom-Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom-half' => esc_html__('Bottom-Half', SA_EL_ADDONS_TEXTDOMAIN),
                        'left-half' => esc_html__('Left-Half', SA_EL_ADDONS_TEXTDOMAIN),
                        'right-half' => esc_html__('Right-Half', SA_EL_ADDONS_TEXTDOMAIN),
                    ]
                ]
        );

        $this->add_control(
                'item_diameter',
                [
                    'label' => __('Circle Menu Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 35,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 20,
                            'step' => 1,
                            'max' => 50,
                        ],
                    ],
                ]
        );

        $this->add_control(
                'circle_radius',
                [
                    'label' => __('Circle Menu Distance', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 100,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 20,
                            'step' => 5,
                            'max' => 500,
                        ],
                    ],
                ]
        );

        $this->add_control(
                'speed',
                [
                    'label' => __('Speed', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 500,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 100,
                            'step' => 10,
                            'max' => 1000,
                        ],
                    ],
                ]
        );

        $this->add_control(
                'delay',
                [
                    'label' => __('Delay', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 1000,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 100,
                            'step' => 10,
                            'max' => 2000,
                        ],
                    ],
                ]
        );

        $this->add_control(
                'step_out',
                [
                    'label' => __('Step Out', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 20,
                    ],
                    'range' => [
                        'px' => [
                            'min' => -200,
                            'step' => 5,
                            'max' => 200,
                        ],
                    ],
                ]
        );

        $this->add_control(
                'step_in',
                [
                    'label' => __('Step In', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => -20,
                    ],
                    'range' => [
                        'px' => [
                            'min' => -200,
                            'step' => 5,
                            'max' => 200,
                        ],
                    ],
                ]
        );

        $this->add_control(
                'trigger',
                [
                    'label' => __('Trigger', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'hover',
                    'options' => [
                        'hover' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                        'click' => esc_html__('Click', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();
        $this->start_controls_section(
                'section_style',
                [
                    'label' => esc_html__('Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control(
                'toggle_icon_size',
                [
                    'label' => esc_html__('Toggle Icon Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 22,
                            'max' => 48,
                        ],
                    ],
                    'default' => [
                        'size' => 24,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu li.sa-el-toggle-icon i' => 'font-size: {{SIZE}}px;',
                    ],
                ]
        );

        $this->add_control(
                'transition_function',
                [
                    'label' => esc_html__('Transition', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'ease',
                    'options' => [
                        'ease' => esc_html('Ease', SA_EL_ADDONS_TEXTDOMAIN),
                        'linear' => esc_html('Linear', SA_EL_ADDONS_TEXTDOMAIN),
                        'ease-in' => esc_html('Ease-In', SA_EL_ADDONS_TEXTDOMAIN),
                        'ease-out' => esc_html('Ease-Out', SA_EL_ADDONS_TEXTDOMAIN),
                        'ease-in-out' => esc_html('Ease-In-Out', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_toggle_icon',
                [
                    'label' => esc_html__('Toggle Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs('tabs_toggle_icon_style');

        $this->start_controls_tab(
                'tab_toggle_icon_normal',
                [
                    'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'toggle_icon_background',
                [
                    'label' => esc_html__('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu li.sa-el-toggle-icon' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'toggle_icon_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu li.sa-el-toggle-icon' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'toggle_icon_border',
                    'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .sa-el-circle-menu li.sa-el-toggle-icon',
                ]
        );


        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'toggle_icon_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-circle-menu li.sa-el-toggle-icon',
                ]
        );

        $this->add_responsive_control(
                'toggle_icon_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu li.sa-el-toggle-icon' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'toggle_icon_hover',
                [
                    'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'toggle_icon_hover_background',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu li.sa-el-toggle-icon:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'toggle_icon_hover_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu li.sa-el-toggle-icon:hover' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'toggle_icon_hover_border_color',
                [
                    'label' => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'toggle_icon_border_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu li.sa-el-toggle-icon:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_circle_menu_icon',
                [
                    'label' => esc_html__('Circle Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs('tabs_circle_menu_icon_style');

        $this->start_controls_tab(
                'tab_circle_menu_icon_normal',
                [
                    'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'circle_menu_icon_background',
                [
                    'label' => esc_html__('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu li.sa-el-menu-icon' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'circle_menu_icon_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu li.sa-el-menu-icon > a' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'circle_menu_icon_border',
                    'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .sa-el-circle-menu li.sa-el-menu-icon',
                ]
        );

        $this->add_responsive_control(
                'circle_menu_icon_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu li.sa-el-menu-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'circle_menu_icon_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-circle-menu li.sa-el-menu-icon',
                ]
        );

        $this->add_responsive_control(
                'circle_menu_icon_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu li.sa-el-menu-icon' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
        );

        $this->add_responsive_control(
                'circle_menu_icon_size',
                [
                    'label' => esc_html__('Icon Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'step' => 1,
                            'max' => 50,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu li.sa-el-menu-icon i' => 'font-size: {{SIZE}}px;',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'circle_menu_icon_hover',
                [
                    'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'circle_menu_icon_hover_background',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu li:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'circle_menu_icon_hover_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu li:hover > a' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'circle_menu_icon_hover_border_color',
                [
                    'label' => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'circle_menu_icon_border_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-circle-menu li:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    public function render_loop_iconnav_list($settings, $list) {

        $this->add_render_attribute(
                [
                    'iconnav-link' => [
                        'class' => [
                            'sa-el-position-center',
                        ],
                        'target' => [
                            $list['iconnav_link']['is_external'] ? '_blank' : '_self',
                        ],
                        'rel' => [
                            $list['iconnav_link']['nofollow'] ? 'nofollow' : '',
                        ],
                        'title' => [
                            esc_html($list['title']),
                        ],
                        'href' => [
                            esc_url($list['iconnav_link']['url']),
                        ],
                    ],
                ], '', '', true
        );
        ?>
        <li class="sa-el-menu-icon">
            <a <?php echo $this->get_render_attribute_string('iconnav-link'); ?>>
                <?php if ($list['icon']) : ?>
                    <span><i class="<?php echo esc_attr($list['icon']); ?>"></i></span>
                <?php endif; ?>
            </a>
        </li>
        <?php
    }

    protected function render() {
        $settings = $this->get_settings();
        $id = 'sa-el-circle-menu-' . $this->get_id();
        $toggle_icon = ($settings['toggle_icon']) ?: 'plus';

        $this->add_render_attribute(
                [
                    'circle-menu-container' => [
                        'id' => [
                            esc_attr($id),
                        ],
                        'class' => [
                            'sa-el-circle-menu-container',
                            $settings['toggle_icon_position'] ? 'sa-el-position-fixed sa-el-position-' . $settings['toggle_icon_position'] : '',
                        ],
                    ],
                ]
        );

        $this->add_render_attribute(
                [
                    'toggle-icon' => [
                        'href' => [
                            'javascript:void(0)',
                        ],
                        'class' => [
                            'sa-el-icon sa-el-link-reset',
                            'sa-el-position-center',
                        ],
                        'sa-el-icon' => [
                            'icon: ' . esc_attr($toggle_icon) . '; ratio: 1.1',
                        ],
                        'title' => [
                            esc_html('Click me to show menus.', SA_EL_ADDONS_TEXTDOMAIN),
                        ],
                    ],
                ]
        );


        $circle_menu_settings = wp_json_encode(
                array_filter([
            "direction" => $settings["direction"],
            "direction" => $settings["direction"],
            "item_diameter" => $settings["item_diameter"]["size"],
            "circle_radius" => $settings["circle_radius"]["size"],
            "speed" => $settings["speed"]["size"],
            "delay" => $settings["delay"]["size"],
            "step_out" => $settings["step_out"]["size"],
            "step_in" => $settings["step_in"]["size"],
            "trigger" => $settings["trigger"],
            "transition_function" => $settings["transition_function"]
                ])
        );

        $this->add_render_attribute('circle-menu-settings', 'data-settings', $circle_menu_settings);
        ?>
        <div <?php echo $this->get_render_attribute_string('circle-menu-container'); ?>>
            <ul class="sa-el-circle-menu" <?php echo $this->get_render_attribute_string('circle-menu-settings'); ?>>
                <li class="sa-el-toggle-icon">
                    <a <?php echo $this->get_render_attribute_string('toggle-icon'); ?>>
                        <i class="<?php echo $settings['toggle_icon']; ?> oxi-icons" aria-hidden="true"></i>
                    </a>
                </li>
                <?php
                foreach ($settings['circle_menu'] as $key => $nav) :
                    $this->render_loop_iconnav_list($settings, $nav);
                endforeach;
                ?>
            </ul>
        </div>
        <?php
    }

}
