<?php

namespace SA_EL_ADDONS\Elements\Revolution_Slider;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Revolution_Slider extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_revolution_slider';
    }

    public function get_title() {
        return esc_html__('Revolution Slider', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-slider-full-screen oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    public function sa_el_rev_slider_options() {
        if (class_exists('RevSlider')) {
            $slider = new \RevSlider();
            $revolution_sliders = $slider->getArrSliders();
            $slider_options = ['0' => esc_html__('Select Slider', SA_EL_ADDONS_TEXTDOMAIN)];
            if (!empty($revolution_sliders) && !is_wp_error($revolution_sliders)) {
                foreach ($revolution_sliders as $revolution_slider) {
                    $alias = $revolution_slider->getAlias();
                    $title = $revolution_slider->getTitle();
                    $slider_options[$alias] = $title;
                }
            }
        } else {
            $slider_options = ['0' => esc_html__('No Slider Found!', SA_EL_ADDONS_TEXTDOMAIN)];
        }
        return $slider_options;
    }

    protected function _register_controls() {
        $this->start_controls_section(
                'section_content_layout',
                [
                    'label' => esc_html__('Layout', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        if (!class_exists('RevSlider')) {
            $this->add_control(
                    'layerslider_missing_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => sprintf(
                                __('Hi, it seems %1$s is missing in your site. Please install and activate %1$s first.', SA_EL_ADDONS_TEXTDOMAIN),
                                '<a href="https://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380" target="_blank" rel="noopener">Revolution Slider</a>'
                        ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    ]
            );
            $this->end_controls_section();
            return;
        }

        $this->add_control(
                'slider_name',
                [
                    'label' => esc_html__('Select Slider', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => '0',
                    'options' => $this->sa_el_rev_slider_options(),
                ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();
    }

    private function get_shortcode() {
        $settings = $this->get_settings();

        $attributes = [
            'alias' => $settings['slider_name'],
        ];

        $this->add_render_attribute('shortcode', $attributes);

        $shortcode = [];
        $shortcode[] = sprintf('[rev_slider %s]', $this->get_render_attribute_string('shortcode'));

        return implode("", $shortcode);
    }

    public function render() {
        if (!class_exists('RevSlider')) {
            ?>
            <div class="sa-el-alert-warning" >
                <div><?php printf(__('Please install and active <a target="_blank" href="https://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380">Revolution Slider</a> Plugin to show your slider correctly.', SA_EL_ADDONS_TEXTDOMAIN)); ?></div>
            </div>
            <?php
        } else {
            echo do_shortcode($this->get_shortcode());
        }
    }

    public function render_plain_content() {
        echo $this->get_shortcode();
    }

}
