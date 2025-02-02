<?php

namespace SA_EL_ADDONS\Elements\One_Page_Navigation;

if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Background as Group_Control_Background;
use \Elementor\Scheme_Typography as Scheme_Typography;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Utils as Utils;
use \Elementor\Widget_Base as Widget_Base;

class One_Page_Navigation extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_one_page_navigation';
    }

    public function get_title() {
        return esc_html__('One Page Navigation', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-navigation-horizontal oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {

   
        $this->start_controls_section(
                'section_nav_dots',
                [
                    'label' => __('Navigation Dots', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'section_title',
                [
                    'label' => __('Section Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Section Title', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $repeater->add_control(
                'section_id',
                [
                    'label' => __('Section ID', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                ]
        );

        $repeater->add_control(
                'dot_icon',
                [
                    'label' => __('Navigation Dot', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::ICON,
                    'default' => 'fa fa-circle',
                ]
        );

        $this->add_control(
                'nav_dots',
                [
                    'label' => '',
                    'type' => Controls_Manager::REPEATER,
                    'default' => [
                        [
                            'section_title' => __('Section #1', SA_EL_ADDONS_TEXTDOMAIN),
                            'section_id' => 'section-1',
                            'dot_icon' => 'fa fa-circle',
                        ],
                        [
                            'section_title' => __('Section #2', SA_EL_ADDONS_TEXTDOMAIN),
                            'section_id' => 'section-2',
                            'dot_icon' => 'fa fa-circle',
                        ],
                        [
                            'section_title' => __('Section #3', SA_EL_ADDONS_TEXTDOMAIN),
                            'section_id' => 'section-3',
                            'dot_icon' => 'fa fa-circle',
                        ],
                    ],
                    'fields' => array_values($repeater->get_controls()),
                    'title_field' => '{{{ section_title }}}',
                ]
        );

        $this->end_controls_section();

        /**
         * Content Tab: Settings
         */
        $this->start_controls_section(
                'section_onepage_nav_settings',
                [
                    'label' => __('Settings', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'nav_tooltip',
                [
                    'label' => __('Tooltip', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Show tooltip on hover', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'tooltip_arrow',
                [
                    'label' => __('Tooltip Arrow', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'label_on' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                    'condition' => [
                        'nav_tooltip' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'scroll_wheel',
                [
                    'label' => __('Scroll Wheel', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Use mouse wheel to navigate from one row to another', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'off',
                    'label_on' => __('On', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('Off', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'on',
                ]
        );

        $this->add_control(
                'scroll_touch',
                [
                    'label' => __('Touch Swipe', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Use touch swipe to navigate from one row to another in mobile devices', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'off',
                    'label_on' => __('On', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('Off', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'on',
                    'condition' => [
                        'scroll_wheel' => 'on',
                    ],
                ]
        );

        $this->add_control(
                'scroll_keys',
                [
                    'label' => __('Scroll Keys', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Use UP and DOWN arrow keys to navigate from one row to another', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'off',
                    'label_on' => __('On', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('Off', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'on',
                ]
        );

        $this->add_control(
                'top_offset',
                [
                    'label' => __('Row Top Offset', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => ['size' => '0'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 300,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px'],
                ]
        );

        $this->add_control(
                'scrolling_speed',
                [
                    'label' => __('Scrolling Speed', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '700',
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();
        /* ----------------------------------------------------------------------------------- */
        /* 	STYLE TAB
          /*----------------------------------------------------------------------------------- */

        /**
         * Style Tab: Navigation Box
         */
        $this->start_controls_section(
                'section_nav_box_style',
                [
                    'label' => __('Navigation Box', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'heading_alignment',
                [
                    'label' => __('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'top' => [
                            'title' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'bottom' => [
                            'title' => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                        'left' => [
                            'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'right',
                    'prefix_class' => 'nav-align-',
                    'frontend_available' => true,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-caldera-form-heading' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'nav_container_background',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .sa-el-one-page-nav',
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'nav_container_border',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .sa-el-one-page-nav'
                ]
        );

        $this->add_control(
                'nav_container_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-one-page-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'nav_container_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-one-page-nav-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'nav_container_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-one-page-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'nav_container_box_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-one-page-nav',
                    'separator' => 'before',
                ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Navigation Dots
         */
        $this->start_controls_section(
                'section_dots_style',
                [
                    'label' => __('Navigation Dots', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control(
                'dots_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => ['size' => '10'],
                    'range' => [
                        'px' => [
                            'min' => 5,
                            'max' => 60,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-nav-dot' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'dots_spacing',
                [
                    'label' => __('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => ['size' => '10'],
                    'range' => [
                        'px' => [
                            'min' => 2,
                            'max' => 30,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}}.nav-align-right .sa-el-one-page-nav-item, {{WRAPPER}}.nav-align-left .sa-el-one-page-nav-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}}.nav-align-top .sa-el-one-page-nav-item, {{WRAPPER}}.nav-align-bottom .sa-el-one-page-nav-item' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'dots_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-nav-dot-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'dots_box_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-nav-dot-wrap',
                    'separator' => 'before',
                ]
        );

        $this->start_controls_tabs('tabs_dots_style');

        $this->start_controls_tab(
                'tab_dots_normal',
                [
                    'label' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'dots_color_normal',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-nav-dot' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'dots_bg_color_normal',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-nav-dot-wrap' => 'background-color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'dots_border',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .sa-el-nav-dot-wrap'
                ]
        );

        $this->add_control(
                'dots_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-nav-dot-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_dots_hover',
                [
                    'label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'dots_color_hover',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-one-page-nav-item .sa-el-nav-dot-wrap:hover .sa-el-nav-dot' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'dots_bg_color_hover',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-one-page-nav-item .sa-el-nav-dot-wrap:hover' => 'background-color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'dots_border_color_hover',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-one-page-nav-item .sa-el-nav-dot-wrap:hover' => 'border-color: {{VALUE}}',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_dots_active',
                [
                    'label' => __('Active', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'dots_color_active',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-one-page-nav-item.active .sa-el-nav-dot' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'dots_bg_color_active',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-one-page-nav-item.active .sa-el-nav-dot-wrap' => 'background-color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'dots_border_color_active',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-one-page-nav-item.active .sa-el-nav-dot-wrap' => 'border-color: {{VALUE}}',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Style Tab: Tooltip
         */
        $this->start_controls_section(
                'section_tooltips_style',
                [
                    'label' => __('Tooltip', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'nav_tooltip' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'tooltip_bg_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-nav-dot-tooltip-content' => 'background-color: {{VALUE}}',
                        '{{WRAPPER}} .sa-el-nav-dot-tooltip' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'nav_tooltip' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'tooltip_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-nav-dot-tooltip-content' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'nav_tooltip' => 'yes',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'tooltip_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-nav-dot-tooltip',
                    'condition' => [
                        'nav_tooltip' => 'yes',
                    ],
                ]
        );

        $this->add_responsive_control(
                'tooltip_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-nav-dot-tooltip-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $this->add_render_attribute('onepage-nav-container', 'class', 'sa-el-one-page-nav-container');

        $this->add_render_attribute('onepage-nav', 'class', 'sa-el-one-page-nav');

        $this->add_render_attribute('onepage-nav', 'id', 'sa-el-one-page-nav-' . $this->get_id());

        $this->add_render_attribute('onepage-nav', 'data-section-id', 'sa-el-one-page-nav-' . $this->get_id());

        $this->add_render_attribute('onepage-nav', 'data-top-offset', $settings['top_offset']['size']);

        $this->add_render_attribute('onepage-nav', 'data-scroll-speed', $settings['scrolling_speed']);

        $this->add_render_attribute('onepage-nav', 'data-scroll-wheel', $settings['scroll_wheel']);

        $this->add_render_attribute('onepage-nav', 'data-scroll-touch', $settings['scroll_touch']);

        $this->add_render_attribute('onepage-nav', 'data-scroll-keys', $settings['scroll_keys']);

        $this->add_render_attribute('tooltip', 'class', 'sa-el-nav-dot-tooltip');

        if ($settings['tooltip_arrow'] == 'yes') {
            $this->add_render_attribute('tooltip', 'class', 'sa-el-tooltip-arrow');
        }
        ?>
        <div <?php echo $this->get_render_attribute_string('onepage-nav-container'); ?>>
            <ul <?php echo $this->get_render_attribute_string('onepage-nav'); ?>>
                <?php
                $i = 1;
                foreach ($settings['nav_dots'] as $index => $dot) {
                    $sa_el_section_title = $dot['section_title'];
                    $sa_el_section_id = $dot['section_id'];
                    $sa_el_dot_icon = $dot['dot_icon'];

                    if ($settings['nav_tooltip'] == 'yes') {
                        $sa_el_dot_tooltip = sprintf('<span %1$s><span class="sa-el-nav-dot-tooltip-content">%2$s</span></span>', $this->get_render_attribute_string('tooltip'), $sa_el_section_title);
                    } else {
                        $sa_el_dot_tooltip = '';
                    }

                    printf('<li class="sa-el-one-page-nav-item">%1$s<a href="#" data-row-id="%2$s"><span class="sa-el-nav-dot-wrap"><span class="sa-el-nav-dot %3$s"></span></span></a></li>', $sa_el_dot_tooltip, $sa_el_section_id, $sa_el_dot_icon);

                    $i++;
                }
                ?>
            </ul>
        </div>
        <?php
    }

}
