<?php

namespace SA_EL_ADDONS\Elements\EDD_Profile_Editor;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

class EDD_Profile_Editor extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa-el-edd-profile-editor';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Easy Download Profile Editor', SA_EL_ADDONS_TEXTDOMAIN);
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-file-download oxi-el-admin-icon';
    }

    public function get_keywords() {
        return ['easy', 'digital', 'downloads', 'software', 'eshop', 'estore', 'profile', 'editor'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'section_style_fieldset',
                [
                    'label' => esc_html__('Fieldset', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        if (!class_exists('Easy_Digital_Downloads')) {
            $this->add_control(
                    'Easy_Digital_Downloads_missing_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => sprintf(
                                __('Hi, it seems %1$s is missing in your site. Please install and activate %1$s first.', SA_EL_ADDONS_TEXTDOMAIN),
                                '<a href="https://wordpress.org/plugins/easy-digital-downloads/" target="_blank" rel="noopener">Easy Digital Downloads</a>'
                        ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    ]
            );
            $this->end_controls_section();
            return;
        }

        $this->add_responsive_control(
                'fieldset_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} fieldset' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'fieldset_border_style',
                [
                    'label' => __('Border Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'solid',
                    'options' => [
                        'none' => __('None', SA_EL_ADDONS_TEXTDOMAIN),
                        'solid' => __('Solid', SA_EL_ADDONS_TEXTDOMAIN),
                        'double' => __('Double', SA_EL_ADDONS_TEXTDOMAIN),
                        'dotted' => __('Dotted', SA_EL_ADDONS_TEXTDOMAIN),
                        'dashed' => __('Dashed', SA_EL_ADDONS_TEXTDOMAIN),
                        'groove' => __('Groove', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} fieldset' => 'border-style: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'fieldset_border_width',
                [
                    'label' => esc_html__('Border Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10,
                        ],
                    ],
                    'px' => [
                        'size' => 2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} fieldset' => 'border-width: {{SIZE}}px;',
                    ],
                ]
        );

        $this->add_control(
                'fieldset_border_color',
                [
                    'label' => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} fieldset' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'caption_color',
                [
                    'label' => esc_html__('Caption Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} legend' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'caption_border',
                    'label' => esc_html__('Caption Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} legend',
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'caption_radius',
                [
                    'label' => esc_html__('Caption Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} legend' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'caption_padding',
                [
                    'label' => esc_html__('Caption Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} legend' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'caption_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} legend',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_label',
                [
                    'label' => esc_html__('Label', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'label_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form label' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'label_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} #edd_profile_editor_form label',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_input',
                [
                    'label' => esc_html__('Input', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'input_placeholder_color',
                [
                    'label' => esc_html__('Placeholder Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form input::placeholder' => 'color: {{VALUE}};',
                        '{{WRAPPER}} #edd_profile_editor_form textarea::placeholder' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'input_text_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form input' => 'color: {{VALUE}};',
                        '{{WRAPPER}} #edd_profile_editor_form .wpcf7-textarea' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'others_type_input_text_color',
                [
                    'label' => esc_html__('Others Type Input Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#666666',
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form.select-state' => 'color: {{VALUE}};',
                        '{{WRAPPER}} #edd_profile_editor_form.select-gender' => 'color: {{VALUE}};',
                        '{{WRAPPER}} #edd_profile_editor_form.accept-this-1' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'input_text_background',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form input' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} #edd_profile_editor_form .wpcf7-textarea' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'textarea_height',
                [
                    'label' => esc_html__('Textarea Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 125,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 30,
                            'max' => 500,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form .wpcf7-textarea' => 'height: {{SIZE}}{{UNIT}}; display: block;',
                    ],
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'input_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form input, {{WRAPPER}} #edd_profile_editor_form .wpcf7-textarea, {{WRAPPER}} #edd_profile_editor_form .select.edd-select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'input_space',
                [
                    'label' => esc_html__('Element Space', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 25,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 50,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form-control' => 'margin-top: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} #edd_profile_editor_form' => 'margin-top: -{{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'input_border_show',
                [
                    'label' => esc_html__('Border Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator' => 'before',
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(), [
            'name' => 'input_border',
            'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
            'placeholder' => '1px',
            'default' => '1px',
            'selector' => '{{WRAPPER}} #edd_profile_editor_form input, {{WRAPPER}} #edd_profile_editor_form textarea, {{WRAPPER}} #edd_profile_editor_form .select.edd-select',
            'condition' => [
                'input_border_show' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'input_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} #edd_profile_editor_form textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} #edd_profile_editor_form .select.edd-select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
                'section_style_submit_button',
                [
                    'label' => esc_html__('Submit Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
                'tab_button_normal',
                [
                    'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'button_text_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form #edd_profile_editor_submit' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'background_color',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form #edd_profile_editor_submit' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'border',
                    'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} #edd_profile_editor_form #edd_profile_editor_submit',
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form #edd_profile_editor_submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_shadow',
                    'selector' => '{{WRAPPER}} #edd_profile_editor_submit',
                ]
        );

        $this->add_control(
                'text_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form #edd_profile_editor_submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} #edd_profile_editor_form #edd_profile_editor_submit',
                    'separator' => 'before',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_button_hover',
                [
                    'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'hover_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form #edd_profile_editor_submit:hover' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'button_background_hover_color',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form #edd_profile_editor_submit:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'button_hover_border_color',
                [
                    'label' => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'border_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form #edd_profile_editor_submit:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_additional_option',
                [
                    'label' => esc_html__('Additional Option', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'fullwidth_input',
                [
                    'label' => esc_html__('Fullwidth Input', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('On', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => esc_html__('Off', SA_EL_ADDONS_TEXTDOMAIN),
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form input[type*="text"]' => 'width: 100%;',
                        '{{WRAPPER}} #edd_profile_editor_form input[type*="email"]' => 'width: 100%;',
                        '{{WRAPPER}} #edd_profile_editor_form input[type*="url"]' => 'width: 100%;',
                        '{{WRAPPER}} #edd_profile_editor_form input[type*="number"]' => 'width: 100%;',
                        '{{WRAPPER}} #edd_profile_editor_form input[type*="tel"]' => 'width: 100%;',
                        '{{WRAPPER}} #edd_profile_editor_form input[type*="date"]' => 'width: 100%;',
                        '{{WRAPPER}} #edd_profile_editor_form input[type*="password"]' => 'width: 100%;',
                        '{{WRAPPER}} #edd_profile_editor_form .select.edd-select' => 'width: 100%;',
                    ],
                ]
        );

        $this->add_control(
                'fullwidth_textarea',
                [
                    'label' => esc_html__('Fullwidth Texarea', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('On', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => esc_html__('Off', SA_EL_ADDONS_TEXTDOMAIN),
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form textarea' => 'width: 100%;',
                    ],
                ]
        );

        $this->add_control(
                'fullwidth_button',
                [
                    'label' => esc_html__('Fullwidth Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('On', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => esc_html__('Off', SA_EL_ADDONS_TEXTDOMAIN),
                    'selectors' => [
                        '{{WRAPPER}} #edd_profile_editor_form #edd_profile_editor_submit' => 'width: 100%;',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'sa_el_section_support',
                [
                    'label' => __('Unable To Use or Found Bugs?', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                'sa_el_section_support_get',
                [
                    'label' => __('Need Support', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'toggle' => FALSE,
                    'options' => [
                        '1' => [
                            'title' => __('', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fas fa-headset',
                        ],
                    ],
                    'default' => '1',
                    'description' => 'Are you in need of a feature that’s not available in our plugin or got some bugs? Feel free to do a <a href="https://wordpress.org/support/plugin/sb-image-hover-effects/" target="_blank">Support</a> request.'
                ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        if (!class_exists('Easy_Digital_Downloads')) :
            ?>
            <div class="sa-el-alert-warning" >
                <div><?php printf(__('Please install <a target="_blank" href="https://wordpress.org/plugins/easy-digital-downloads/">Easy Digital Downloads Plugin</a> to show your work correctly.', SA_EL_ADDONS_TEXTDOMAIN)); ?></div>
            </div>
            <?php
        else :
            echo do_shortcode('[edd_profile_editor]');
        endif;
    }

}
