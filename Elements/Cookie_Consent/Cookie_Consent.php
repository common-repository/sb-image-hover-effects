<?php

namespace SA_EL_ADDONS\Elements\Cookie_Consent;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Frontend;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Scheme_Typography as Scheme_Typography;
use \Elementor\Widget_Base as Widget_Base;

class Cookie_Consent extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_cookie_consent';
    }

    public function get_title() {
        return esc_html__('Cookie Consent', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-countdown  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    public function get_keywords() {
        return ['cookie', 'consent'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'section_content_layout',
                [
                    'label' => __('Layout', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'message',
                [
                    'label' => __('Message', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => 'This website uses cookies to ensure you get the best experience on our website. ',
                    'dynamic' => ['active' => true],
                ]
        );

        $this->add_control(
                'button_text',
                [
                    'label' => __('Button Text', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Got it!',
                ]
        );

        $this->add_control(
                'learn_more_text',
                [
                    'label' => __('Learn More Text', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __('Learn more', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => 'Learn more',
                ]
        );

        $this->add_control(
                'learn_more_link',
                [
                    'label' => __('Learn More Link', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::URL,
                    'show_external' => false,
                    'placeholder' => __('https://your-link.com', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => [
                        'url' => 'http://cookiesandyou.com/',
                    ],
                    'dynamic' => ['active' => true],
                ]
        );

        $this->add_control(
                'position',
                [
                    'label' => __('Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'bottom',
                    'options' => [
                        'bottom' => esc_html__('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom-left' => esc_html__('Bottom Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom-right' => esc_html__('Bottom Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'top' => esc_html__('Top', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'pushdown',
                [
                    'label' => esc_html__('Show Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'condition' => [
                        'position' => 'top',
                    ]
                ]
        );

        $this->add_control(
                'expiry_days',
                [
                    'label' => __('Expiry Days', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => 'Specify -1 for no expiry',
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 365,
                    ],
                    'range' => [
                        'px' => [
                            'min' => -1,
                            'max' => 731,
                            'step' => 5,
                        ],
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style',
                [
                    'label' => __('Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'background',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ff56c6',
                    'selectors' => [
                        'body .cc-window' => 'background-color: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->add_control(
                'text_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ffffff',
                    'selectors' => [
                        'body .cc-window' => 'color: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->add_control(
                'learn_more_color',
                [
                    'label' => __('Learn More Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#f9ff4c',
                    'selectors' => [
                        'body .cc-window .cc-link' => 'color: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'subtitle_typography',
                    'selector' => 'body .cc-window *',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();
        $this->start_controls_section(
                'section_style_dismiss_button',
                [
                    'label' => esc_html__('Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs('tabs_dismiss_button_style');

        $this->start_controls_tab(
                'tab_dismiss_button_normal',
                [
                    'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'dismiss_button_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ffffff',
                    'selectors' => [
                        'body .cc-window .cc-btn.cc-dismiss' => 'color: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->add_control(
                'dismiss_button_background',
                [
                    'label' => esc_html__('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#8e0077',
                    'selectors' => [
                        'body .cc-window .cc-btn.cc-dismiss' => 'background-color: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->add_control(
                'dismiss_button_border_style',
                [
                    'label' => __('Border Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none' => __('None', SA_EL_ADDONS_TEXTDOMAIN),
                        'solid' => __('Solid', SA_EL_ADDONS_TEXTDOMAIN),
                        'double' => __('Double', SA_EL_ADDONS_TEXTDOMAIN),
                        'dotted' => __('Dotted', SA_EL_ADDONS_TEXTDOMAIN),
                        'dashed' => __('Dashed', SA_EL_ADDONS_TEXTDOMAIN),
                        'groove' => __('Groove', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'selectors' => [
                        'body .cc-window .cc-btn.cc-dismiss' => 'border-style: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->add_control(
                'dismiss_button_border_width',
                [
                    'label' => __('Border Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'min' => 0,
                        'max' => 20,
                        'size' => 1,
                    ],
                    'selectors' => [
                        'body .cc-window .cc-btn.cc-dismiss' => 'border-width: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
        );

        $this->add_control(
                'dismiss_button_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ccc',
                    'selectors' => [
                        'body .cc-window .cc-btn.cc-dismiss' => 'border-color: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->add_control(
                'dismiss_button_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        'body .cc-window .cc-btn.cc-dismiss' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
        );

        $this->add_responsive_control(
                'dismiss_button_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        'body .cc-window .cc-btn.cc-dismiss' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
        );

        $this->add_responsive_control(
                'dismiss_button_margin',
                [
                    'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        'body .cc-window .cc-btn.cc-dismiss' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
        );


        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'dismiss_button_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => 'body .cc-window .cc-btn.cc-dismiss',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_dismiss_button_hover',
                [
                    'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'dismiss_button_hover_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        'body .cc-window .cc-btn.cc-dismiss:hover' => 'color: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->add_control(
                'dismiss_button_hover_background',
                [
                    'label' => esc_html__('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        'body .cc-window .cc-btn.cc-dismiss:hover' => 'background-color: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->add_control(
                'dismiss_button_hover_border_color',
                [
                    'label' => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'dismiss_button_border_style!' => 'none',
                    ],
                    'selectors' => [
                        'body .cc-window .cc-btn.cc-dismiss:hover' => 'border-color: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();

        $cc_position = $settings['position'];

        if ($cc_position == 'bottom-left') {
            $cc_position = 'cc-bottom cc-left cc-floating';
        } else if ($cc_position == 'bottom-right') {
            $cc_position = 'cc-bottom cc-right cc-floating';
        } else if ($cc_position == 'top') {
            $cc_position = 'cc-top cc-banner';
        } else if ($cc_position == 'bottom') {
            $cc_position = 'cc-bottom cc-banner';
        }

        $this->add_render_attribute('cookie-consent', 'class', ['sa-el-cookie-consent', 'sa-el-hidden']);

        $this->add_render_attribute(
                [
                    'cookie-consent' => [
                        'data-settings' => [
                            wp_json_encode(array_filter([
                                "position" => $settings["position"],
                                "static" => ("top" == $settings["position"] and $settings["pushdown"]) ? true : false,
                                "content" => [
                                    "message" => $settings["message"],
                                    "dismiss" => $settings["button_text"],
                                    "link" => $settings["learn_more_text"],
                                    "href" => esc_url($settings["learn_more_link"]["url"]),
                                ],
                                "expiryDays" => $settings["expiry_days"]["size"],
                            ]))
                        ]
                    ]
                ]
        );

        if (\Elementor\Plugin::instance()->editor->is_edit_mode()) :
            ?>

            <div role="dialog" aria-live="polite" aria-label="cookieconsent" aria-describedby="cookieconsent:desc" class="cc-window <?php echo esc_attr($cc_position); ?> cc-type-info cc-theme-block cc-color-override--2000495483">

                <!--googleoff: all-->
                <span id="cookieconsent:desc" class="cc-message"><?php echo esc_attr($settings['message']); ?><a aria-label="learn more about cookies" role="button" tabindex="0" class="cc-link" href="<?php echo esc_url($settings['learn_more_link']['url']); ?>" rel="noopener noreferrer nofollow" target="_blank"><?php echo esc_attr($settings['learn_more_text']); ?></a></span>
                <div class="cc-compliance">
                    <a aria-label="dismiss cookie message" role="button" tabindex="0" class="cc-btn cc-dismiss"><?php echo $settings['button_text']; ?></a>
                </div>
                <!--googleon: all-->

            </div>

        <?php else : ?>

            <div <?php echo $this->get_render_attribute_string('cookie-consent'); ?>></div>

        <?php
        endif;
    }

    protected function _content_template() {
        ?>

        <# 
        var cc_position = settings.position;

        if (cc_position == 'bottom-left') {
        cc_position = 'cc-bottom cc-left cc-floating';
        } else if (cc_position == 'bottom-right') {
        cc_position = 'cc-bottom cc-right cc-floating';
        } else if (cc_position == 'top') {
        cc_position = 'cc-top cc-banner';
        } else if (cc_position == 'bottom') {
        cc_position = 'cc-bottom cc-banner';
        }

        #>

        <div role="dialog" aria-live="polite" aria-label="cookieconsent" aria-describedby="cookieconsent:desc" class="cc-window cc-type-info cc-theme-block <# print(cc_position) #> cc-color-override--2000495483">

            <!--googleoff: all-->
            <span id="cookieconsent:desc" class="cc-message"><# print(settings.message) #><a aria-label="learn more about cookies" role="button" tabindex="0" class="cc-link" href="<# print(settings.learn_more_link.url) #>" rel="noopener noreferrer nofollow" target="_blank"><# print(settings.learn_more_text) #></a></span>
            <div class="cc-compliance">
                <a aria-label="dismiss cookie message" role="button" tabindex="0" class="cc-btn cc-dismiss"><# print(settings.button_text) #></a>
            </div>
            <!--googleon: all-->

        </div>



        <?php
    }

}
