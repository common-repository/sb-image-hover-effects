<?php

namespace SA_EL_ADDONS\Elements\Iframe;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

defined('ABSPATH') || die();

class Iframe extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa-el-iframe';
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
        return __('Iframe', SA_EL_ADDONS_TEXTDOMAIN);
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
        return 'eicon-animation oxi-el-admin-icon';
    }

    public function get_keywords() {
        return ['iframe', 'embed'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
                'section_content_layout',
                [
                    'label' => esc_html__('Layout', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'source',
                [
                    'label' => esc_html__('Content Source', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::URL,
                    'dynamic' => ['active' => true],
                    'default' => ['url' => 'https://www.sa-elementor-addons.com'],
                    'placeholder' => esc_html__('https://example.com', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => esc_html__('You can put here any website url, youtube, vimeo, document or image embed url', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_block' => true,
                    'show_external' => false,
                ]
        );

        $this->add_responsive_control(
                'height',
                [
                    'label' => esc_html__('Iframe Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'separator' => 'before',
                    'range' => [
                        'px' => [
                            'min' => 100,
                            'max' => 1500,
                            'step' => 10,
                        ],
                        'vw' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'size_units' => ['px', 'vw', '%'],
                    'default' => [
                        'size' => 640,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-iframe iframe' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'auto_height!' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'auto_height',
                [
                    'label' => esc_html__('Auto Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => esc_html__('Auto height only works when cross origin properly set', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_iframe_settings',
                [
                    'label' => esc_html__('Lazyload Settings', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'lazyload',
                [
                    'label' => esc_html__('Lazyload', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes'
                ]
        );

        $this->add_control(
                'throttle',
                [
                    'label' => esc_html__('Throttle', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => esc_html__('millisecond interval at which to process events', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 300,
                    'condition' => [
                        'lazyload' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'threshold',
                [
                    'label' => esc_html__('Threshold', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => esc_html__('scroll distance from element before its loaded', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'separator' => 'before',
                    'default' => 100,
                    'condition' => [
                        'lazyload' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'live',
                [
                    'label' => esc_html__('Live', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => esc_html__('auto bind lazy loading to ajax loaded elements', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'separator' => 'before',
                    'default' => 'yes',
                    'condition' => [
                        'lazyload' => 'yes',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_content_additional',
                [
                    'label' => esc_html__('Additional Settings', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'allowfullscreen',
                [
                    'label' => esc_html__('Allow Fullscreen', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => esc_html__('Maybe you need this when you use youtube or video embed link.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes'
                ]
        );

        $this->add_control(
                'scrolling',
                [
                    'label' => esc_html__('Show Scroll Bar', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => esc_html__('Specifies whether or not to display scrollbars', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'sandbox',
                [
                    'label' => esc_html__('Sandbox', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => esc_html__('Enables an extra set of restrictions for the content', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'sandbox_allowed_attributes',
                [
                    'label' => esc_html__('Sandbox Allowed Attributes', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => [
                        'allow-forms' => esc_html__('Forms', SA_EL_ADDONS_TEXTDOMAIN),
                        'allow-pointer-lock' => esc_html__('Pointer Lock', SA_EL_ADDONS_TEXTDOMAIN),
                        'allow-popups' => esc_html__('Popups', SA_EL_ADDONS_TEXTDOMAIN),
                        'allow-same-origin' => esc_html__('Same Origin', SA_EL_ADDONS_TEXTDOMAIN),
                        'allow-scripts' => esc_html__('Scripts', SA_EL_ADDONS_TEXTDOMAIN),
                        'allow-top-navigation' => esc_html__('Top Navigation', SA_EL_ADDONS_TEXTDOMAIN)
                    ],
                    'condition' => [
                        'sandbox' => 'yes'
                    ]
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();
    }

    public function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('iframe-container', 'class', 'sa-el-iframe');
        if ('yes' == $settings['lazyload']) {
            $this->add_render_attribute('iframe', 'class', 'sa-el-lazyload');
            $this->add_render_attribute('iframe', 'data-throttle', esc_attr($settings['throttle']));
            $this->add_render_attribute('iframe', 'data-threshold', esc_attr($settings['threshold']));
            $this->add_render_attribute('iframe', 'data-live', $settings['live'] ? 'true' : 'false' );
            $this->add_render_attribute('iframe', 'data-src', esc_url($settings['source']['url']));
        } else {
            $this->add_render_attribute('iframe', 'src', esc_url($settings['source']['url']));
        }

        if (!$settings['scrolling']) {
            $this->add_render_attribute('iframe', 'scrolling', 'no');
        }

        $this->add_render_attribute('iframe', 'data-auto_height', ($settings['auto_height']) ? true : false );


        if ('yes' == $settings['allowfullscreen']) {
            $this->add_render_attribute('iframe', 'allowfullscreen');
        } else {
            $this->add_render_attribute('iframe', 'donotallowfullscreen');
        }

        if ($settings['sandbox']) {
            $this->add_render_attribute('iframe', 'sandbox');

            if ($settings['sandbox_allowed_attributes']) {
                $this->add_render_attribute('iframe', 'sandbox', $settings['sandbox_allowed_attributes']);
            }
        }
        ?>
        <div <?php echo $this->get_render_attribute_string('iframe-container'); ?>>
            <iframe <?php echo $this->get_render_attribute_string('iframe'); ?>></iframe>
        </div>
        <?php
    }

}
