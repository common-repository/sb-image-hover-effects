<?php

namespace SA_EL_ADDONS\Elements\Image_Scroller;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Image Scroller
 *
 * @author biplo
 * 
 */
use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Background as Group_Control_Background;
use \Elementor\Scheme_Typography as Scheme_Typography;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Utils as Utils;
use \Elementor\Widget_Base as Widget_Base;
use \SA_EL_ADDONS\Classes\Bootstrap;

class Image_Scroller extends Widget_Base {

     use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_img_scroller';
    }

    public function get_title() {
        return esc_html__('Image Scroller', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-v-align-stretch oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {
        /**
         * General Settings
         */
        $this->start_controls_section(
                'sa_el_image_scroller_section_general', [
            'label' => esc_html__('General', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'sa_el_image_scroller_bg_img', [
            'label' => __('Background Image', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $this->add_control(
                'sa_el_image_scroller_container_height', [
            'label' => __('Container Height', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'description' => 'Container height/width should be less than the image height/width. Otherwise scroll will not work.',
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 100,
                    'max' => 1000,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 300,
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-image-scroller' => 'height: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'before',
                ]
        );

        $this->add_control(
                'sa_el_image_scroller_direction', [
            'label' => __('Scroll Direction', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'vertical',
            'options' => [
                'horizontal' => __('Horizontal', SA_EL_ADDONS_TEXTDOMAIN),
                'vertical' => __('Vertical', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'separator' => 'before',
                ]
        );

        $this->add_control(
                'sa_el_image_scroller_auto_scroll', [
            'label' => esc_html__('Auto Scroll', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before',
                ]
        );

        $this->add_control(
                'sa_el_image_scroller_duration', [
            'label' => __('Scroll Duration', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 100,
                    'max' => 10000,
                    'step' => 100,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 1000,
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-image-scroller.sa-el-image-scroller-hover img' => 'transition-duration: {{SIZE}}ms;',
            ],
            'condition' => [
                'sa_el_image_scroller_auto_scroll' => 'yes',
            ],
            'separator' => 'before',
                ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $wrap_classes = ['sa-el-image-scroller', 'sa-el-image-scroller-' . $settings['sa_el_image_scroller_direction']];

        if ($settings['sa_el_image_scroller_auto_scroll'] === 'yes') {
            $wrap_classes[] = 'sa-el-image-scroller-hover';
        }

        echo '<div class="' . implode(' ', $wrap_classes) . '">
			<img src="' . $settings['sa_el_image_scroller_bg_img']['url'] . '" alt="' . esc_attr(get_post_meta($settings['sa_el_image_scroller_bg_img']['id'], '_wp_attachment_image_alt', true)) . '">
		</div>';
    }

}
