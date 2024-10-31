<?php

namespace SA_EL_ADDONS\Elements\Logo_Grid;

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use \Elementor\Widget_Base as Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Logo_Grid extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_logo_grid';
    }

    public function get_title() {
        return esc_html__('Logo Grid', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-logo oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    public function get_keywords() {
        return ['logo', 'grid', 'brand', 'client'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
                '_section_logo',
                [
                    'label' => __('Logo Grid', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
                'image',
                [
                    'label' => __('Logo', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
        );

        $repeater->add_control(
                'link',
                [
                    'label' => __('Website Url', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::URL,
                    'show_external' => false,
                    'label_block' => false,
                ]
        );

        $repeater->add_control(
                'name',
                [
                    'label' => __('Brand Name', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Brand Name', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'logo_list',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'title_field' => '{{{ name }}}',
                    'default' => [
                        ['image' => ['url' => Utils::get_placeholder_image_src()]],
                        ['image' => ['url' => Utils::get_placeholder_image_src()]],
                        ['image' => ['url' => Utils::get_placeholder_image_src()]],
                        ['image' => ['url' => Utils::get_placeholder_image_src()]],
                        ['image' => ['url' => Utils::get_placeholder_image_src()]],
                        ['image' => ['url' => Utils::get_placeholder_image_src()]],
                        ['image' => ['url' => Utils::get_placeholder_image_src()]],
                        ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                '_section_settings',
                [
                    'label' => __('Settings', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbnail',
                    'default' => 'large',
                    'separator' => 'before',
                    'exclude' => [
                        'custom'
                    ]
                ]
        );

        $this->add_control(
                'layout',
                [
                    'label' => __('Grid Layout', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'box' => __('Box', SA_EL_ADDONS_TEXTDOMAIN),
                        'border' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                        'tictactoe' => __('Tic Tac Toe', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'box',
                    'prefix_class' => 'sa-el-logo-grid--',
                    'style_transfer' => true,
                ]
        );

        $this->add_responsive_control(
                'columns',
                [
                    'label' => __('Columns', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        2 => __('2 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        3 => __('3 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        4 => __('4 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        5 => __('5 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        6 => __('6 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'desktop_default' => 4,
                    'tablet_default' => 2,
                    'mobile_default' => 2,
                    'prefix_class' => 'sa-el-logo-grid--col-%s',
                    'style_transfer' => true,
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();

        $this->start_controls_section(
                '_section_style_grid',
                [
                    'label' => __('Grid', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control(
                'padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-logo-grid-figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'height',
                [
                    'label' => __('Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'max' => 500,
                            'min' => 100,
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-logo-grid-item' => 'height: {{SIZE}}{{UNIT}};'
                    ],
                ]
        );

        $this->add_control(
                'grid_border_type',
                [
                    'label' => __('Border Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'none' => __('None', SA_EL_ADDONS_TEXTDOMAIN),
                        'solid' => __('Solid', SA_EL_ADDONS_TEXTDOMAIN),
                        'double' => __('Double', SA_EL_ADDONS_TEXTDOMAIN),
                        'dotted' => __('Dotted', SA_EL_ADDONS_TEXTDOMAIN),
                        'dashed' => __('Dashed', SA_EL_ADDONS_TEXTDOMAIN),
                        'groove' => __('Groove', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'solid',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-logo-grid-item' => 'border-style: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'grid_border_width',
                [
                    'label' => __('Border Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'selectors' => [
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border .sa-el-logo-grid-item' => 'border-right-width: {{grid_border_width.SIZE}}{{UNIT}}; border-bottom-width: {{grid_border_width.SIZE}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border .sa-el-logo-grid-item' => 'border-right-width: {{grid_border_width_tablet.SIZE}}{{UNIT}}; border-bottom-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border .sa-el-logo-grid-item' => 'border-right-width: {{grid_border_width_mobile.SIZE}}{{UNIT}}; border-bottom-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-2 .sa-el-logo-grid-item:nth-child(2n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-3 .sa-el-logo-grid-item:nth-child(3n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-4 .sa-el-logo-grid-item:nth-child(4n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-5 .sa-el-logo-grid-item:nth-child(5n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-6 .sa-el-logo-grid-item:nth-child(6n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-2 .sa-el-logo-grid-item:nth-child(-n+2)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-3 .sa-el-logo-grid-item:nth-child(-n+3)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-4 .sa-el-logo-grid-item:nth-child(-n+4)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-5 .sa-el-logo-grid-item:nth-child(-n+5)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-6 .sa-el-logo-grid-item:nth-child(-n+6)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet2 .sa-el-logo-grid-item:nth-child(2n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet3 .sa-el-logo-grid-item:nth-child(3n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet4 .sa-el-logo-grid-item:nth-child(4n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet5 .sa-el-logo-grid-item:nth-child(5n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet6 .sa-el-logo-grid-item:nth-child(6n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet2 .sa-el-logo-grid-item:nth-child(-n+2)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet3 .sa-el-logo-grid-item:nth-child(-n+3)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet4 .sa-el-logo-grid-item:nth-child(-n+4)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet5 .sa-el-logo-grid-item:nth-child(-n+5)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet6 .sa-el-logo-grid-item:nth-child(-n+6)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile2 .sa-el-logo-grid-item:nth-child(2n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile3 .sa-el-logo-grid-item:nth-child(3n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile4 .sa-el-logo-grid-item:nth-child(4n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile5 .sa-el-logo-grid-item:nth-child(5n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile6 .sa-el-logo-grid-item:nth-child(6n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile2 .sa-el-logo-grid-item:nth-child(-n+2)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile3 .sa-el-logo-grid-item:nth-child(-n+3)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile4 .sa-el-logo-grid-item:nth-child(-n+4)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile5 .sa-el-logo-grid-item:nth-child(-n+5)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile6 .sa-el-logo-grid-item:nth-child(-n+6)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                        '{{WRAPPER}}.sa-el-logo-grid--tictactoe .sa-el-logo-grid-item' => 'border-top-width: {{SIZE}}{{UNIT}}; border-right-width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}}.sa-el-logo-grid--box .sa-el-logo-grid-item' => 'border-width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'grid_border_type!' => 'none',
                    ]
                ]
        );

        $this->add_control(
                'grid_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-logo-grid-item' => 'border-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'grid_border_type!' => 'none',
                    ]
                ]
        );

        $this->add_control(
                'grid_bg_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-logo-grid-figure' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'grid_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}}.sa-el-logo-grid--border .sa-el-logo-grid-wrapper, {{WRAPPER}}.sa-el-logo-grid--box .sa-el-logo-grid-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}}.sa-el-logo-grid--border .sa-el-logo-grid-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}};',
                        '{{WRAPPER}}.sa-el-logo-grid--border .sa-el-logo-grid-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-2 .sa-el-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-2 .sa-el-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-3 .sa-el-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-3 .sa-el-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-4 .sa-el-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-4 .sa-el-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-5 .sa-el-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-5 .sa-el-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-6 .sa-el-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col-6 .sa-el-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet2 .sa-el-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet2 .sa-el-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet3 .sa-el-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet3 .sa-el-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet4 .sa-el-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet4 .sa-el-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet5 .sa-el-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet5 .sa-el-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet6 .sa-el-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--tablet6 .sa-el-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile2 .sa-el-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile2 .sa-el-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile3 .sa-el-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile3 .sa-el-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile4 .sa-el-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile4 .sa-el-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile5 .sa-el-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile5 .sa-el-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile6 .sa-el-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--border.sa-el-logo-grid--col--mobile6 .sa-el-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                        // Tictactoe
                        '{{WRAPPER}}.sa-el-logo-grid--tictactoe .sa-el-logo-grid-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}}.sa-el-logo-grid--tictactoe .sa-el-logo-grid-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}};',
                        '{{WRAPPER}}.sa-el-logo-grid--tictactoe .sa-el-logo-grid-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col-2 .sa-el-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col-2 .sa-el-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col-3 .sa-el-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col-3 .sa-el-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col-4 .sa-el-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col-4 .sa-el-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col-5 .sa-el-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col-5 .sa-el-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col-6 .sa-el-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                        '(desktop+){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col-6 .sa-el-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--tablet2 .sa-el-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--tablet2 .sa-el-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--tablet3 .sa-el-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--tablet3 .sa-el-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--tablet4 .sa-el-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--tablet4 .sa-el-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--tablet5 .sa-el-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--tablet5 .sa-el-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--tablet6 .sa-el-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                        '(tablet){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--tablet6 .sa-el-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--mobile2 .sa-el-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--mobile2 .sa-el-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--mobile3 .sa-el-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--mobile3 .sa-el-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--mobile4 .sa-el-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--mobile4 .sa-el-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--mobile5 .sa-el-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--mobile5 .sa-el-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--mobile6 .sa-el-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                        '(mobile){{WRAPPER}}.sa-el-logo-grid--tictactoe.sa-el-logo-grid--col--mobile6 .sa-el-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'grid_box_shadow',
                    'exclude' => [
                        'box_shadow_position',
                    ],
                    'selector' => '{{WRAPPER}}.sa-el-logo-grid--tictactoe .sa-el-logo-grid-wrapper, {{WRAPPER}}.sa-el-logo-grid--border .sa-el-logo-grid-wrapper, {{WRAPPER}}.sa-el-logo-grid--box .sa-el-logo-grid-item'
                ]
        );


        $this->start_controls_tabs(
                '_tabs_image_effects',
                [
                    'separator' => 'before'
                ]
        );

        $this->start_controls_tab(
                '_tab_image_effects_normal',
                [
                    'label' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'image_opacity',
                [
                    'label' => __('Opacity', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 1,
                            'min' => 0.10,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-logo-grid-figure > img' => 'opacity: {{SIZE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Css_Filter::get_type(),
                [
                    'name' => 'image_css_filters',
                    'selector' => '{{WRAPPER}} .sa-el-logo-grid-figure > img',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('hover',
                [
                    'label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'image_opacity_hover',
                [
                    'label' => __('Opacity', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 1,
                            'min' => 0.10,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-logo-grid-figure:hover > img' => 'opacity: {{SIZE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Css_Filter::get_type(),
                [
                    'name' => 'image_css_filters_hover',
                    'selector' => '{{WRAPPER}} .sa-el-logo-grid-figure:hover > img',
                ]
        );

        $this->add_control(
                'image_bg_hover_transition',
                [
                    'label' => __('Transition Duration', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 3,
                            'step' => 0.1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-logo-grid-figure:hover > img' => 'transition-duration: {{SIZE}}s',
                    ],
                ]
        );

        $this->add_control(
                'hover_animation',
                [
                    'label' => __('Hover Animation', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HOVER_ANIMATION,
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['logo_list'])) {
            return;
        }
        ?>

        <div class="sa-el-logo-grid-wrapper">
            <?php
            foreach ($settings['logo_list'] as $index => $item) :
                $image = wp_get_attachment_image_url($item['image']['id'], $settings['thumbnail_size']);
                if (!$image) {
                    $image = Utils::get_placeholder_image_src();
                }
                $repeater_key = 'grid_item' . $index;
                $tag = 'div';
                $this->add_render_attribute($repeater_key, 'class', 'sa-el-logo-grid-item');

                if ($item['link']['url']) {
                    $tag = 'a';
                    $this->add_render_attribute($repeater_key, 'class', 'sa-el-logo-grid-link');
                    $this->add_render_attribute($repeater_key, 'target', '_blank');
                    $this->add_render_attribute($repeater_key, 'rel', 'noopener');
                    $this->add_render_attribute($repeater_key, 'href', esc_url($item['link']['url']));
                }
                ?>
                <<?php echo $tag; ?> <?php $this->print_render_attribute_string($repeater_key); ?>>
                <figure class="sa-el-logo-grid-figure">
                    <img class="sa-el-logo-grid-img elementor-animation-<?php echo esc_attr($settings['hover_animation']); ?>" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($item['name']); ?>">
                </figure>
                </<?php echo $tag; ?>>
            <?php endforeach; ?>
        </div>

        <?php
    }

}
