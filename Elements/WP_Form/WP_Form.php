<?php

namespace SA_EL_ADDONS\Elements\WP_Form;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use \Elementor\Widget_Base as Widget_Base;

class WP_Form extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_wp_form';
    }

    public function get_title() {
        return esc_html__('WP From', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'fa fa-envelope-o  oxi-el-admin-icon';
    }

    public function get_keywords() {
        return ['wpf', 'wpform', 'form', 'contact', 'cf7', 'contact form', 'gravity', 'ninja'];
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    /**
     * Check if WPForms is activated
     *
     * @return bool
     */
    public function sa_el_is_wpf_activated() {
        return class_exists('WPForms_Lite');
    }

    /**
     * Get a list of all WPForms
     *
     * @return array
     */
    public function sa_el_get_wpforms() {
        $forms = get_posts([
            'post_type' => 'wpforms',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
        ]);

        if (!empty($forms)) {
            return wp_list_pluck($forms, 'post_title', 'ID');
        }
        return [];
    }

    protected function _register_controls() {
        $this->start_controls_section(
                '_section_wpf',
                [
                    'label' => $this->sa_el_is_wpf_activated() ? __('WPForms', SA_EL_ADDONS_TEXTDOMAIN) : __('Notice', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        if (!$this->sa_el_is_wpf_activated()) {
            $this->add_control(
                    'wpf_missing_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => sprintf(
                                __('Hi, it seems %1$s is missing in your site. Please install and activate %1$s first.', SA_EL_ADDONS_TEXTDOMAIN),
                                '<a href="https://wordpress.org/plugins/wpforms-lite/" target="_blank" rel="noopener">WPForms</a>'
                        ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    ]
            );
            $this->end_controls_section();
            return;
        }


        $this->add_control(
                'form_id',
                [
                    'label' => __('Select Your Form', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default' => '',
                    'options' => ['' => __('Select a WPForm', SA_EL_ADDONS_TEXTDOMAIN)] + $this->sa_el_get_wpforms(),
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();

        $this->start_controls_section(
                '_section_fields_style',
                [
                    'label' => __('Form Fields', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control(
                'field_margin',
                [
                    'label' => __('Field Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-field:not(.wpforms-submit), .wpforms-field-required:not(.wpforms-submit)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'field_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-field input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpforms-field textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'field_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-field input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpforms-field textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'field_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .wpforms-field input, {{WRAPPER}} .wpforms-field-textarea textarea',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_3
                ]
        );

        $this->add_control(
                'field_textcolor',
                [
                    'label' => __('Field Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-field input, {{WRAPPER}} .wpforms-field-textarea textarea' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'field_placeholder_color',
                [
                    'label' => __('Field Placeholder Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ::-webkit-input-placeholder' => 'color: {{VALUE}};',
                        '{{WRAPPER}} ::-moz-placeholder' => 'color: {{VALUE}};',
                        '{{WRAPPER}} ::-ms-input-placeholder' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->start_controls_tabs('tabs_field_state');

        $this->start_controls_tab(
                'tab_field_normal',
                [
                    'label' => __('Normal State', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'field_border',
                    'selector' => '{{WRAPPER}} .wpforms-field input, {{WRAPPER}} .wpforms-field-textarea textarea',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'field_box_shadow',
                    'selector' => '{{WRAPPER}} .wpforms-field input, {{WRAPPER}} .wpforms-field-textarea textarea',
                ]
        );

        $this->add_control(
                'field_bg_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-field input, {{WRAPPER}} .wpforms-field-textarea textarea' => 'background-color: {{VALUE}}',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_field_focus',
                [
                    'label' => __('Focus', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'field_focus_border',
                    'selector' => '{{WRAPPER}} .wpforms-field input:focus, {{WRAPPER}} .wpforms-field-textarea textarea:focus',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'field_focus_box_shadow',
                    'exclude' => [
                        'box_shadow_position',
                    ],
                    'selector' => '{{WRAPPER}} .wpforms-field input:focus, {{WRAPPER}} .wpforms-field-textarea textarea:focus',
                ]
        );

        $this->add_control(
                'field_focus_bg_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-field input:focus, {{WRAPPER}} .wpforms-field-textarea textarea:focus' => 'background-color: {{VALUE}}',
                    ],
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'wpf-form-label',
                [
                    'label' => __('Form Fields Label', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control(
                'label_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-field-container label.wpforms-field-label' => 'display: inline-block; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'label_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-field-container label.wpforms-field-label' => 'display: inline-block; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'hr3',
                [
                    'type' => Controls_Manager::DIVIDER,
                    'style' => 'thick',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'label_typography',
                    'label' => __('Label Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .wpforms-field-container label.wpforms-field-label',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_3
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sublabel_typography',
                    'label' => __('Sub Label Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .wpforms-field-sublabel',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_3
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'desc_typography',
                    'label' => __('Description Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .wpforms-field-description',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_3
                ]
        );

        $this->add_control(
                'label_color_popover',
                [
                    'label' => __('Colors', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => __('', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_on' => __('Custom', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                ]
        );

        $this->start_popover();

        $this->add_control(
                'label_color',
                [
                    'label' => __('Label Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-field-container label.wpforms-field-label' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'label_color_popover' => 'yes'
                    ],
                ]
        );

        $this->add_control(
                'requered_label',
                [
                    'label' => __('Required Label Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-required-label' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'label_color_popover' => 'yes'
                    ],
                ]
        );

        $this->add_control(
                'sublabel_color',
                [
                    'label' => __('Sub Label Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-field-sublabel' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'label_color_popover' => 'yes'
                    ],
                ]
        );

        $this->add_control(
                'desc_label_color',
                [
                    'label' => __('Description Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-field-description' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'label_color_popover' => 'yes'
                    ],
                ]
        );

        $this->end_popover();

        $this->end_controls_section();

        $this->start_controls_section(
                'submit',
                [
                    'label' => __('Submit Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'submit_btn_width',
                [
                    'label' => __('Button Full Width?', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );

        $this->add_responsive_control(
                'button_width',
                [
                    'label' => __('Button Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'condition' => [
                        'submit_btn_width' => 'yes'
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 100
                    ],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 800,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-submit' => 'display: block; width: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'submit_btn_position',
                [
                    'label' => __('Button Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [
                        'submit_btn_width' => '',
                    ],
                    'desktop_default' => 'left',
                    'toggle' => false,
                    'prefix_class' => 'sa-el-form-btn--%s',
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-submit-container' => 'text-align: {{Value}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'submit_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'submit_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'submit_typography',
                    'selector' => '{{WRAPPER}} .wpforms-submit',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'submit_border',
                    'selector' => '{{WRAPPER}} .wpforms-form .wpforms-submit-container button[type=submit]',
                ]
        );

        $this->add_control(
                'submit_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'submit_box_shadow',
                    'selector' => '{{WRAPPER}} .wpforms-submit',
                ]
        );

        $this->add_control(
                'hr4',
                [
                    'type' => Controls_Manager::DIVIDER,
                    'style' => 'thick',
                ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
                'tab_button_normal',
                [
                    'label' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'submit_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-submit' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'submit_bg_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-submit' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_button_hover',
                [
                    'label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'submit_hover_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-submit:hover, {{WRAPPER}} .wpforms-submit:focus' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'submit_hover_bg_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-submit:hover, {{WRAPPER}} .wpforms-submit:focus' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'submit_hover_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpforms-submit:hover, {{WRAPPER}} .wpforms-submit:focus' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        if (!$this->sa_el_is_wpf_activated()) {
            return;
        }

        $settings = $this->get_settings_for_display();



        if (!empty($settings['form_id'])) {
            echo $this->sa_el_do_shortcode('wpforms', [
                'id' => $settings['form_id'],
            ]);
        }
    }

}
