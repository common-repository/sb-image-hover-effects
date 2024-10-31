<?php

namespace SA_EL_ADDONS\Elements\Contact_Form_7;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Background as Group_Control_Background;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Scheme_Typography as Scheme_Typography;
use \Elementor\Widget_Base as Widget_Base;

class Contact_Form_7 extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    /**
     * Sanitize html class string
     *
     * @param $class
     * @return string
     */
    public function get_name() {
        return 'sa_el_cf7';
    }

    public function get_title() {
        return esc_html__('Contact Form 7', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'fa fa-envelope-o  oxi-el-admin-icon';
    }

    public function get_keywords() {
        return ['form', 'contact', 'cf7', 'contact form', 'gravity', 'ninja'];
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    /**
     * Check if contact form 7 is activated
     *
     * @return bool
     */
    public function sa_el_cf7_activated() {
        return class_exists('WPCF7');
    }

    /**
     * Get a list of all CF7 forms
     *
     * @return array
     */
    public function sa_el_get_cf7_forms() {
        $options = array();

        if (function_exists('wpcf7')) {
            $wpcf7_form_list = get_posts(array(
                'post_type' => 'wpcf7_contact_form',
                'showposts' => 999,
            ));
            $options[0] = esc_html__('Select a Contact Form', SA_EL_ADDONS_TEXTDOMAIN);
            if (!empty($wpcf7_form_list) && !is_wp_error($wpcf7_form_list)) {
                foreach ($wpcf7_form_list as $post) {
                    $options[$post->ID] = $post->post_title;
                }
            } else {
                $options[0] = esc_html__('Create a Form First', SA_EL_ADDONS_TEXTDOMAIN);
            }
        }
        return $options;
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'section_info_box',
                [
                    'label' => $this->sa_el_cf7_activated() ? __('Contact Form 7', SA_EL_ADDONS_TEXTDOMAIN) : __('Notice', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        if (!$this->sa_el_cf7_activated()) {

            $this->add_control(
                    'cf7_missing_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => sprintf(
                                __('Hi, it seems %1$s is missing in your site. Please install and activate %1$s first.', SA_EL_ADDONS_TEXTDOMAIN),
                                '<a href="https://wordpress.org/plugins/contact-form-7/" target="_blank" rel="noopener">Contact Form 7</a>'
                        ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    ]
            );
            $this->end_controls_section();
            return;
        }




        $this->add_control(
                'contact_form_list',
                [
                    'label' => esc_html__('Select Form', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => true,
                    'options' => $this->sa_el_get_cf7_forms(),
                    'default' => '0',
                ]
        );

        $this->add_control(
                'form_title',
                [
                    'label' => __('Form Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('On', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('Off', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'form_title_text',
                [
                    'label' => esc_html__('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => '',
                    'condition' => [
                        'form_title' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'form_description',
                [
                    'label' => __('Form Description', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('On', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('Off', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'form_description_text',
                [
                    'label' => esc_html__('Description', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => '',
                    'condition' => [
                        'form_description' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'labels_switch',
                [
                    'label' => __('Labels', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'label_on' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                ]
        );

        $this->end_controls_section();

        /**
         * Content Tab: Errors
         * -------------------------------------------------
         */
        $this->start_controls_section(
                'section_errors',
                [
                    'label' => __('Errors', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'error_messages',
                [
                    'label' => __('Error Messages', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'show',
                    'options' => [
                        'show' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                        'hide' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'selectors_dictionary' => [
                        'show' => 'block',
                        'hide' => 'none',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-not-valid-tip' => 'display: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->add_control(
                'validation_errors',
                [
                    'label' => __('Validation Errors', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'show',
                    'options' => [
                        'show' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                        'hide' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'selectors_dictionary' => [
                        'show' => 'block',
                        'hide' => 'none',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-validation-errors' => 'display: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();
        
        $this->start_controls_section(
                'section_container_style',
                [
                    'label' => __('Form Container', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'sa_el_contact_form_background',
                    'label' => __('Background', 'plugin-domain'),
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .sa-el-contact-form',
                ]
        );

        $this->add_responsive_control(
                'sa_el_contact_form_alignment',
                [
                    'label' => esc_html__('Form Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'label_block' => true,
                    'options' => [
                        'default' => [
                            'title' => __('Default', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-ban',
                        ],
                        'left' => [
                            'title' => esc_html__('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'default',
                ]
        );

        $this->add_responsive_control(
                'sa_el_contact_form_max_width',
                [
                    'label' => esc_html__('Form Max Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em', '%'],
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 1500,
                        ],
                        'em' => [
                            'min' => 1,
                            'max' => 80,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7-wrapper .sa-el-contact-form-7' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );



        $this->add_responsive_control(
                'sa_el_contact_form_padding',
                [
                    'label' => esc_html__('Form Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'sa_el_contact_form_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'separator' => 'before',
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_contact_form_border',
                    'selector' => '{{WRAPPER}} .sa-el-contact-form',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'sa_el_contact_form_box_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-contact-form',
                ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
                'section_fields_title_description',
                [
                    'label' => __('Title & Description', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control(
                'heading_alignment',
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
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .sa-el-contact-form-7-heading' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'title_heading',
                [
                    'label' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'title_text_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .sa-el-contact-form-7-title' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-contact-form-7 .sa-el-contact-form-7-title',
                ]
        );

        $this->add_control(
                'description_heading',
                [
                    'label' => __('Description', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'description_text_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .sa-el-contact-form-7-description' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-contact-form-7 .sa-el-contact-form-7-description',
                ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Input & Textarea
         * -------------------------------------------------
         */
        $this->start_controls_section(
                'section_fields_style',
                [
                    'label' => __('Input & Textarea', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs('tabs_fields_style');

        $this->start_controls_tab(
                'tab_fields_normal',
                [
                    'label' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'field_bg',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'background-color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'field_text_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'color: {{VALUE}}',
                    ],
                    'separator' => 'before',
                ]
        );

        $this->add_responsive_control(
                'input_spacing',
                [
                    'label' => __('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '20',
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form p:not(:last-of-type) .wpcf7-form-control-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}}',
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
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'text_indent',
                [
                    'label' => __('Text Indent', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 60,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 30,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'text-indent: {{SIZE}}{{UNIT}}',
                    ],
                ]
        );

        $this->add_responsive_control(
                'input_width',
                [
                    'label' => __('Input Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1200,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'width: {{SIZE}}{{UNIT}}',
                    ],
                ]
        );

        $this->add_responsive_control(
                'textarea_width',
                [
                    'label' => __('Textarea Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1200,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'width: {{SIZE}}{{UNIT}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'field_border',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-text,{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-select',
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'field_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'field_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-select',
                    'separator' => 'before',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'field_box_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control.wpcf7-select',
                    'separator' => 'before',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_fields_focus',
                [
                    'label' => __('Focus', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'field_bg_focus',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input:focus, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form textarea:focus' => 'background-color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'input_border_focus',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input:focus, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form textarea:focus',
                    'separator' => 'before',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'focus_box_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input:focus, {{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form textarea:focus',
                    'separator' => 'before',
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Style Tab: Label Section
         */
        $this->start_controls_section(
                'section_label_style',
                [
                    'label' => __('Labels', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'labels_switch' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'text_color_label',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form label' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'labels_switch' => 'yes',
                    ],
                ]
        );

        $this->add_responsive_control(
                'label_spacing',
                [
                    'label' => __('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form label' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'labels_switch' => 'yes',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'typography_label',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form label',
                    'condition' => [
                        'labels_switch' => 'yes',
                    ],
                ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Placeholder Section
         */
        $this->start_controls_section(
                'section_placeholder_style',
                [
                    'label' => __('Placeholder', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'placeholder_switch',
                [
                    'label' => __('Show Placeholder', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'text_color_placeholder',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control::-webkit-input-placeholder' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'placeholder_switch' => 'yes',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'typography_placeholder',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form-control::-webkit-input-placeholder',
                    'condition' => [
                        'placeholder_switch' => 'yes',
                    ],
                ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Radio & Checkbox
         * -------------------------------------------------
         */
        $this->start_controls_section(
                'section_radio_checkbox_style',
                [
                    'label' => __('Radio & Checkbox', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'custom_radio_checkbox',
                [
                    'label' => __('Custom Styles', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                ]
        );

        $this->add_responsive_control(
                'radio_checkbox_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '15',
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 80,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .sa-el-custom-radio-checkbox input[type="radio"]' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'custom_radio_checkbox' => 'yes',
                    ],
                ]
        );

        $this->start_controls_tabs('tabs_radio_checkbox_style');

        $this->start_controls_tab(
                'radio_checkbox_normal',
                [
                    'label' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'custom_radio_checkbox' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'radio_checkbox_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .sa-el-custom-radio-checkbox input[type="radio"]' => 'background: {{VALUE}}',
                    ],
                    'condition' => [
                        'custom_radio_checkbox' => 'yes',
                    ],
                ]
        );

        $this->add_responsive_control(
                'radio_checkbox_border_width',
                [
                    'label' => __('Border Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 15,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .sa-el-custom-radio-checkbox input[type="radio"]' => 'border-width: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'custom_radio_checkbox' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'radio_checkbox_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .sa-el-custom-radio-checkbox input[type="radio"]' => 'border-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'custom_radio_checkbox' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'checkbox_heading',
                [
                    'label' => __('Checkbox', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'condition' => [
                        'custom_radio_checkbox' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'checkbox_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .sa-el-custom-radio-checkbox input[type="checkbox"]:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'custom_radio_checkbox' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'radio_heading',
                [
                    'label' => __('Radio Buttons', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'condition' => [
                        'custom_radio_checkbox' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'radio_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-custom-radio-checkbox input[type="radio"], {{WRAPPER}} .sa-el-custom-radio-checkbox input[type="radio"]:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'custom_radio_checkbox' => 'yes',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'radio_checkbox_checked',
                [
                    'label' => __('Checked', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'custom_radio_checkbox' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'radio_checkbox_color_checked',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-custom-radio-checkbox input[type="checkbox"]:checked:before, {{WRAPPER}} .sa-el-custom-radio-checkbox input[type="radio"]:checked:before' => 'background: {{VALUE}}',
                    ],
                    'condition' => [
                        'custom_radio_checkbox' => 'yes',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Style Tab: Submit Button
         */
        $this->start_controls_section(
                'section_submit_button_style',
                [
                    'label' => __('Submit Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control(
                'button_align',
                [
                    'label' => __('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'left',
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
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form p:nth-last-of-type(1)' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input[type="submit"]' => 'display:inline-block;',
                    ],
                    'condition' => [
                        'button_width_type' => 'custom',
                    ],
                ]
        );

        $this->add_control(
                'button_width_type',
                [
                    'label' => __('Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'custom',
                    'options' => [
                        'full-width' => __('Full Width', SA_EL_ADDONS_TEXTDOMAIN),
                        'custom' => __('Custom', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'prefix_class' => 'sa-el-contact-form-7-button-',
                ]
        );

        $this->add_responsive_control(
                'button_width',
                [
                    'label' => __('Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1200,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input[type="submit"]' => 'width: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'button_width_type' => 'custom',
                    ],
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
                'button_bg_color_normal',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input[type="submit"]' => 'background-color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'button_text_color_normal',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input[type="submit"]' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'button_border_normal',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input[type="submit"]',
                ]
        );

        $this->add_control(
                'button_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'button_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'button_margin',
                [
                    'label' => __('Margin Top', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input[type="submit"]' => 'margin-top: {{SIZE}}{{UNIT}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input[type="submit"]',
                    'separator' => 'before',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input[type="submit"]',
                    'separator' => 'before',
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
                'button_bg_color_hover',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'background-color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'button_text_color_hover',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'button_border_color_hover',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'border-color: {{VALUE}}',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Style Tab: Errors
         */
        $this->start_controls_section(
                'section_error_style',
                [
                    'label' => __('Errors', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'error_messages_heading',
                [
                    'label' => __('Error Messages', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'condition' => [
                        'error_messages' => 'show',
                    ],
                ]
        );

        $this->start_controls_tabs('tabs_error_messages_style');

        $this->start_controls_tab(
                'tab_error_messages_alert',
                [
                    'label' => __('Alert', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'error_messages' => 'show',
                    ],
                ]
        );

        $this->add_control(
                'error_alert_text_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-not-valid-tip' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'error_messages' => 'show',
                    ],
                ]
        );

        $this->add_responsive_control(
                'error_alert_spacing',
                [
                    'label' => __('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-not-valid-tip' => 'margin-top: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'error_messages' => 'show',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_error_messages_fields',
                [
                    'label' => __('Fields', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'error_messages' => 'show',
                    ],
                ]
        );

        $this->add_control(
                'error_field_bg_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-not-valid' => 'background: {{VALUE}}',
                    ],
                    'condition' => [
                        'error_messages' => 'show',
                    ],
                ]
        );

        $this->add_control(
                'error_field_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-not-valid' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'error_messages' => 'show',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'error_field_border',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-not-valid',
                    'separator' => 'before',
                    'condition' => [
                        'error_messages' => 'show',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
                'validation_errors_heading',
                [
                    'label' => __('Validation Errors', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'validation_errors' => 'show',
                    ],
                ]
        );

        $this->add_control(
                'validation_errors_bg_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-validation-errors' => 'background: {{VALUE}}',
                    ],
                    'condition' => [
                        'validation_errors' => 'show',
                    ],
                ]
        );

        $this->add_control(
                'validation_errors_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-validation-errors' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'validation_errors' => 'show',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'validation_errors_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-validation-errors',
                    'separator' => 'before',
                    'condition' => [
                        'validation_errors' => 'show',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'validation_errors_border',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-validation-errors',
                    'separator' => 'before',
                    'condition' => [
                        'validation_errors' => 'show',
                    ],
                ]
        );

        $this->add_responsive_control(
                'validation_errors_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-contact-form-7 .wpcf7-validation-errors' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'validation_errors' => 'show',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        if (!$this->sa_el_cf7_activated()) {
            return;
        }
        $settings = $this->get_settings();

        $this->add_render_attribute('contact-form', 'class', [
            'sa-el-contact-form',
            'sa-el-contact-form-7',
            'sa-el-contact-form-' . esc_attr($this->get_id()),
        ]);

        if ($settings['labels_switch'] != 'yes') {
            $this->add_render_attribute('contact-form', 'class', 'labels-hide');
        }

        if ($settings['placeholder_switch'] == 'yes') {
            $this->add_render_attribute('contact-form', 'class', 'placeholder-show');
        }

        if ($settings['custom_radio_checkbox'] == 'yes') {
            $this->add_render_attribute('contact-form', 'class', 'sa-el-custom-radio-checkbox');
        }
        if ($settings['sa_el_contact_form_alignment'] == 'left') {
            $this->add_render_attribute('contact-form', 'class', 'sa-el-contact-form-7-align-left');
        } elseif ($settings['sa_el_contact_form_alignment'] == 'center') {
            $this->add_render_attribute('contact-form', 'class', 'sa-el-contact-form-7-align-center');
        } elseif ($settings['sa_el_contact_form_alignment'] == 'right') {
            $this->add_render_attribute('contact-form', 'class', 'sa-el-contact-form-7-align-right');
        } else {
            $this->add_render_attribute('contact-form', 'class', 'sa-el-contact-form-7-align-default');
        }

        if (!empty($settings['contact_form_list'])) {
            echo '<div class="sa-el-contact-form-7-wrapper">
                <div ' . $this->get_render_attribute_string('contact-form') . '>';
            if ($settings['form_title'] == 'yes' || $settings['form_description'] == 'yes') {
                echo '<div class="sa-el-contact-form-7-heading">';
                if ($settings['form_title'] == 'yes' && $settings['form_title_text'] != '') {
                    echo '<h3 class="sa-el-contact-form-title sa-el-contact-form-7-title">
                                    ' . esc_attr($settings['form_title_text']) . '
                                </h3>';
                }
                if ($settings['form_description'] == 'yes' && $settings['form_description_text'] != '') {
                    echo '<div class="sa-el-contact-form-description sa-el-contact-form-7-description">
                                    ' . $this->parse_text_editor($settings['form_description_text']) . '
                                </div>';
                }
                echo '</div>';
            }
            echo do_shortcode('[contact-form-7 id="' . $settings['contact_form_list'] . '" ]');
            echo '</div>
            </div>';
        }
    }

}
