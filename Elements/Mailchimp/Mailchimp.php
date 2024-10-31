<?php

namespace SA_EL_ADDONS\Elements\Mailchimp;

// If this file is called directly, abort.
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

class Mailchimp extends Widget_Base
{

    use \SA_EL_ADDONS\Helper\Elementor_Helper;
    public function sa_el_mailchimp_lists()
    {
        $api_key = get_option('sa_el_mailchimp_api');
        $data = array(
            'apikey' => $api_key,
        );

        // cURL Setup
        $sa_el_mailchimp = curl_init();
        curl_setopt($sa_el_mailchimp, CURLOPT_URL, 'https://' . substr($api_key, strpos($api_key, '-') + 1) . '.api.mailchimp.com/3.0/lists/');
        curl_setopt($sa_el_mailchimp, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic ' . base64_encode('user:' . $api_key)));
        curl_setopt($sa_el_mailchimp, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($sa_el_mailchimp, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($sa_el_mailchimp, CURLOPT_TIMEOUT, 10);
        curl_setopt($sa_el_mailchimp, CURLOPT_POST, true);
        curl_setopt($sa_el_mailchimp, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($sa_el_mailchimp, CURLOPT_POSTFIELDS, json_encode($data));

        $lists = curl_exec($sa_el_mailchimp);
        $lists = json_decode($lists);
        if (!empty($lists)) {
            $lists_name = array('' => 'Select One');
            for ($i = 0; $i < count($lists->lists); $i++) {
                $lists_name[$lists->lists[$i]->id] = $lists->lists[$i]->name;
            }
            return $lists_name;
        }
    }




    public function get_name()
    {
        return 'sa_el_mailchimp';
    }

    public function get_title()
    {
        return esc_html__('Mailchimp', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-envelope  oxi-el-admin-icon';
    }

    public function get_categories()
    {
        return ['sa-el-addons'];
    }

    protected function _register_controls()
    {
        /**
         * Mailchimp API Settings
         */
        $this->start_controls_section(
            'sa_el_section_mailchimp_api_settings',
            [
                'label' => esc_html__('Mailchimp Account Settings', SA_EL_ADDONS_TEXTDOMAIN)
            ]
        );

        $this->add_control(
            'sa_el_mailchimp_lists',
            [
                'label'           => esc_html__('Mailchimp List', SA_EL_ADDONS_TEXTDOMAIN),
                'type'             => Controls_Manager::SELECT,
                'label_block'     => false,
                'description'     => 'Set your API Key from <strong>Elementor Addons &gt; Addons &gt; Mailchimp Settings</strong>',
                'options'         => $this->sa_el_mailchimp_lists(),
            ]
        );
        $this->end_controls_section();
        /**
         * Mailchimp Fields Settings
         */
        $this->start_controls_section(
            'sa_el_section_mailchimp_field_settings',
            [
                'label' => esc_html__('Field Settings', SA_EL_ADDONS_TEXTDOMAIN)
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_email_label_text',
            [
                'label' => esc_html__('Email Label', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => 'Email',
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_fname_show',
            [
                'label' => esc_html__('Enable First Name', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_fname_label_text',
            [
                'label' => esc_html__('First Name Label', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => 'First Name',
                'condition' => [
                    'sa_el_mailchimp_fname_show' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_lname_show',
            [
                'label' => esc_html__('Enable Last Name', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_lname_label_text',
            [
                'label' => esc_html__('Last Name Label', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => 'Last Name',
                'condition' => [
                    'sa_el_mailchimp_lname_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

        /**
         * Mailchimp Button Settings
         */
        $this->start_controls_section(
            'sa_el_section_mailchimp_button_settings',
            [
                'label' => esc_html__('Button Settings', SA_EL_ADDONS_TEXTDOMAIN)
            ]
        );
        $this->add_control(
            'sa_el_section_mailchimp_button_text',
            [
                'label' => esc_html__('Button Text', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => esc_html__('Subscribe', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        $this->add_control(
            'sa_el_section_mailchimp_loading_text',
            [
                'label' => esc_html__('Loading Text', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => esc_html__('Submitting...', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        $this->end_controls_section();

        /**
         * Mailchimp Message Settings
         */
        $this->start_controls_section(
            'sa_el_section_mailchimp_message_settings',
            [
                'label' => esc_html__('Message Settings', SA_EL_ADDONS_TEXTDOMAIN)
            ]
        );
        $this->add_control(
            'sa_el_section_mailchimp_success_text',
            [
                'label' => esc_html__('Success Text', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('You have subscribed successfully!', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        $this->end_controls_section();

        $this->Sa_El_Support();
        /**
         * -------------------------------------------
         * Tab Style Mailchimp Style
         * -------------------------------------------
         */
        $this->start_controls_section(
            'sa_el_section_mailchimp_style_settings',
            [
                'label' => esc_html__('General Style', SA_EL_ADDONS_TEXTDOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_layout',
            [
                'label' => __('Layout', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'inline' => 'Inline',
                    'stacked' => 'Stacked'
                ],
                'default' => 'stacked',

            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'                  => 'sa_el_mailchimp_box_bg',
                'label'                 => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                'types'                 => ['none', 'classic', 'gradient'],
                'selector'              => '{{WRAPPER}} .sa-el-mailchimp-wrap',
            ]
        );
        $this->add_responsive_control(
            'sa_el_mailchimp_padding',
            [
                'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sa_el_mailchimp_margin',
            [
                'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'sa_el_mailchimp_border',
                'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                'selector' => '{{WRAPPER}} .sa-el-mailchimp-wrap',
            ]
        );
        $this->add_responsive_control(
            'sa_el_mailchimp_border_radius',
            [
                'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sa_el_mailchimp_box_shadow',
                'selector' => '{{WRAPPER}} .sa-el-mailchimp-wrap',
            ]
        );
        $this->end_controls_section();

        /**
         * Tab Style: Form Fields Style
         */
        $this->start_controls_section(
            'sa_el_section_contact_form_field_styles',
            [
                'label' => esc_html__('Form Fields Styles', SA_EL_ADDONS_TEXTDOMAIN),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_input_background',
            [
                'label' => esc_html__('Input Field Background', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-input' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sa_el_mailchimp_input_width',
            [
                'label' => esc_html__('Input Width', SA_EL_ADDONS_TEXTDOMAIN),
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
                    '{{WRAPPER}} .sa-el-field-group' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sa_el_mailchimp_input_height',
            [
                'label' => esc_html__('Input Height', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 1500,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-input' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sa_el_mailchimp_input_padding',
            [
                'label' => esc_html__('Fields Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sa_el_mailchimp_input_margin',
            [
                'label' => esc_html__('Fields Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-field-group' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_input_border_radius',
            [
                'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'sa_el_mailchimp_input_border',
                'selector' => '{{WRAPPER}} .sa-el-mailchimp-input',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sa_el_mailchimp_input_box_shadow',
                'selector' => '{{WRAPPER}} .sa-el-mailchimp-input',
            ]
        );
        $this->end_controls_section();

        /**
         * Tab Style: Form Field Color & Typography
         */
        $this->start_controls_section(
            'sa_el_section_mailchimp_typography',
            [
                'label' => esc_html__('Color & Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_label_color',
            [
                'label' => esc_html__('Label Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-wrap label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_field_color',
            [
                'label' => esc_html__('Field Font Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-input' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_field_placeholder_color',
            [
                'label' => esc_html__('Placeholder Font Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-wrap ::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sa-el-mailchimp-wrap ::-moz-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sa-el-mailchimp-wrap ::-ms-input-placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_label_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Label Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_mailchimp_label_typography',
                'selector' => '{{WRAPPER}} .sa-el-mailchimp-wrap label',
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_heading_input_field',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Input Fields Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_mailchimp_input_field_typography',
                'selector' => '{{WRAPPER}} .sa-el-mailchimp-input',
            ]
        );
        $this->end_controls_section();

        /**
         * Subscribe Button Style
         */
        $this->start_controls_section(
            'sa_el_section_subscribe_btn',
            [
                'label' => __('Subscribe Button Style', SA_EL_ADDONS_TEXTDOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_subscribe_btn_display',
            [
                'label' => __('Button Display', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'inline' => 'Inline',
                    'block' => 'Block'
                ],
                'default' => 'inline',

            ]
        );
        $this->add_responsive_control(
            'sa_el_mailchimp_subscribe_btn_width',
            [
                'label' => esc_html__('Button Max Width', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-submit-btn' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sa_el_mailchimp_subscribe_btn_padding',
            [
                'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-subscribe' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sa_el_mailchimp_subscribe_btn_margin',
            [
                'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-subscribe' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_mailchimp_subscribe_btn_typography',
                'selector' => '{{WRAPPER}} .sa-el-mailchimp-subscribe',
            ]
        );

        $this->start_controls_tabs('sa_el_mailchimp_subscribe_btn_tabs');

        // Normal State Tab
        $this->start_controls_tab('sa_el_mailchimp_subscribe_btn_normal', ['label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN)]);

        $this->add_control(
            'sa_el_mailchimp_subscribe_btn_normal_text_color',
            [
                'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-subscribe' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sa_el_mailchimp_subscribe_btn_normal_bg_color',
            [
                'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#29d8d8',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-subscribe' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'sa_el_mailchimp_subscribe_btn_normal_border',
                'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                'selector' => '{{WRAPPER}} .sa-el-mailchimp-subscribe',
            ]
        );

        $this->add_control(
            'sa_el_mailchimp_subscribe_btn_border_radius',
            [
                'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-subscribe' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sa_el_mailchimp_subscribe_btn_shadow',
                'selector' => '{{WRAPPER}} .sa-el-mailchimp-subscribe',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab('sa_el_mailchimp_subscribe_btn_hover', ['label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN)]);

        $this->add_control(
            'sa_el_mailchimp_subscribe_btn_hover_text_color',
            [
                'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-subscribe:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sa_el_mailchimp_subscribe_btn_hover_bg_color',
            [
                'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#27bdbd',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-subscribe:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sa_el_mailchimp_subscribe_btn_hover_border_color',
            [
                'label' => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-subscribe:hover' => 'border-color: {{VALUE}};',
                ],
            ]

        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sa_el_mailchimp_subscribe_btn_hover_shadow',
                'selector' => '{{WRAPPER}} .sa-el-mailchimp-subscribe:hover',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();

        /**
         * Subscribe Button Style
         */
        $this->start_controls_section(
            'sa_el_section_success_message',
            [
                'label' => __('Message Style', SA_EL_ADDONS_TEXTDOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_message_background',
            [
                'label' => esc_html__('Background', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-message' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sa_el_mailchimp_message_color',
            [
                'label' => esc_html__('Font Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-message' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sa_el_mailchimp_message_alignment',
            [
                'label' => esc_html__('Text Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => true,
                'options' => [
                    'default' => [
                        'title' => __('Default', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => 'fa fa-ban',
                    ],
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
                'default' => 'default',
                'prefix_class' => 'sa-el-mailchimp-message-text-',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_mailchimp_message_typography',
                'selector' => '{{WRAPPER}} .sa-el-mailchimp-message',
            ]
        );
        $this->add_responsive_control(
            'sa_el_mailchimp_message_padding',
            [
                'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sa_el_mailchimp_message_margin',
            [
                'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sa_el_mailchimp_message_border_radius',
            [
                'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-mailchimp-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'sa_el_mailchimp_message_border',
                'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                'selector' => '{{WRAPPER}} .sa-el-mailchimp-message',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sa_el_mailchimp_message_box_shadow',
                'selector' => '{{WRAPPER}} .sa-el-mailchimp-message',
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings();
        $api_key = get_option('sa_el_mailchimp_api');

        // Layout Class
        if ('stacked' === $settings['sa_el_mailchimp_layout']) {
            $layout = 'sa-el-mailchimp-stacked';
        } elseif ('inline' === $settings['sa_el_mailchimp_layout']) {
            $layout = 'sa-el-mailchimp-inline';
        }
        // Button Display Class
        if ('block' === $settings['sa_el_mailchimp_subscribe_btn_display']) {
            $subscribe_btn_display = 'sa-el-mailchimp-btn-block';
        } elseif ('inline' === $settings['sa_el_mailchimp_subscribe_btn_display']) {
            $subscribe_btn_display = 'sa-el-mailchimp-btn-inline';
        }

        $this->add_render_attribute('sa-el-mailchimp-main-wrapper', 'class', 'sa-el-mailchimp-wrap');
        $this->add_render_attribute('sa-el-mailchimp-main-wrapper', 'class', esc_attr($layout));
        $this->add_render_attribute('sa-el-mailchimp-main-wrapper', 'data-mailchimp-id', esc_attr($this->get_id()));
        $this->add_render_attribute('sa-el-mailchimp-main-wrapper', 'data-list-id', $settings['sa_el_mailchimp_lists']);
        $this->add_render_attribute('sa-el-mailchimp-main-wrapper', 'data-button-text', $settings['sa_el_section_mailchimp_button_text']);
        $this->add_render_attribute('sa-el-mailchimp-main-wrapper', 'data-success-text', $settings['sa_el_section_mailchimp_success_text']);
        $this->add_render_attribute('sa-el-mailchimp-main-wrapper', 'data-loading-text', $settings['sa_el_section_mailchimp_loading_text']);
        $this->add_render_attribute('sa-el-mailchimp-main-wrapper', 'data-class', "SA_EL_ADDONS\Elements\Mailchimp\File\Mailfun");
        $this->add_render_attribute('sa-el-mailchimp-main-wrapper', 'data-function', "sa_el_mailchimp_subscribe");

        ?>
        <?php if (!empty($api_key)) : ?>
            <div <?php echo $this->get_render_attribute_string('sa-el-mailchimp-main-wrapper'); ?>>
                <form class="sa-el-mailchimp-form" id="sa-el-mailchimp-form-<?php echo esc_attr($this->get_id()); ?>" method="POST">
                    <div class="sa-el-form-fields-wrapper sa-el-mailchimp-fields-wrapper <?php echo esc_attr($subscribe_btn_display); ?>">
                        <div class="sa-el-field-group sa-el-mailchimp-email">
                            <label for="<?php echo esc_attr($settings['sa_el_mailchimp_email_label_text'], SA_EL_ADDONS_TEXTDOMAIN); ?>"><?php echo esc_html__($settings['sa_el_mailchimp_email_label_text'], SA_EL_ADDONS_TEXTDOMAIN); ?></label>
                            <input type="email" name="sa_el_mailchimp_email" class="sa-el-mailchimp-input" placeholder="Email" required="required">
                        </div>
                        <?php if ('yes' == $settings['sa_el_mailchimp_fname_show']) : ?>
                            <div class="sa-el-field-group sa-el-mailchimp-fname">
                                <label for="<?php echo esc_attr($settings['sa_el_mailchimp_fname_label_text'], SA_EL_ADDONS_TEXTDOMAIN); ?>"><?php echo esc_html__($settings['sa_el_mailchimp_fname_label_text'], SA_EL_ADDONS_TEXTDOMAIN); ?></label>
                                <input type="text" name="sa_el_mailchimp_firstname" class="sa-el-mailchimp-input" placeholder="First Name">
                            </div>
                        <?php endif; ?>
                        <?php if ('yes' == $settings['sa_el_mailchimp_lname_show']) : ?>
                            <div class="sa-el-field-group sa-el-mailchimp-lname">
                                <label for="<?php echo esc_attr($settings['sa_el_mailchimp_lname_label_text'], SA_EL_ADDONS_TEXTDOMAIN); ?>"><?php echo esc_html__($settings['sa_el_mailchimp_lname_label_text'], SA_EL_ADDONS_TEXTDOMAIN); ?></label>
                                <input type="text" name="sa_el_mailchimp_lastname" class="sa-el-mailchimp-input" placeholder="Last Name">
                            </div>
                        <?php endif; ?>
                        <div class="sa-el-field-group sa-el-mailchimp-submit-btn">
                            <button id="sa-el-subscribe-<?php echo esc_attr($this->get_id()); ?>" class="sa-el-load-more-button sa-el-mailchimp-subscribe">
                                <div class="sa-el-btn-loader button__loader"></div>
                                <span><?php echo esc_html__($settings['sa_el_section_mailchimp_button_text'], SA_EL_ADDONS_TEXTDOMAIN); ?></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        <?php else : ?>
            <p class="sa-el-mailchimp-error">Please insert your api key</p>
        <?php endif; ?>

<?php
    }

    protected function content_template()
    { }
}
