<?php

namespace SA_EL_ADDONS\Elements\Layer_Slider;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Layer_Slider extends Widget_Base {
    
    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_layer_slider';
    }

    public function get_title() {
        return esc_html__('Layer Slider', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-post-slider oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function layer_slider_list() {
        if (shortcode_exists("layerslider")) {
            $output = '';
            $sliders = \LS_Sliders::find(array('limit' => 100));

            foreach ($sliders as $item) {
                $name = empty($item['name']) ? 'Unnamed' : htmlspecialchars($item['name']);
                $output[$item['id']] = $name;
            }

            return $output;
        }
    }

    protected function _register_controls() {
        $this->start_controls_section(
                'section_content_layout',
                [
                    'label' => esc_html__('Layout', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );
        if (!is_plugin_active('LayerSlider/layerslider.php')) {
            $this->add_control(
                    'layerslider_missing_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => sprintf(
                                __('Hi, it seems %1$s is missing in your site. Please install and activate %1$s first.', SA_EL_ADDONS_TEXTDOMAIN),
                                '<a href="https://codecanyon.net/item/layerslider-responsive-wordpress-slider-plugin/1362246" target="_blank" rel="noopener">Layer Slider</a>'
                        ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    ]
            );
            $this->end_controls_section();
            return;
        }


        $slider_list = $this->layer_slider_list();

        $this->add_control(
                'slider_name',
                [
                    'label' => esc_html__('Select Slider', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => $slider_list,
                ]
        );

        $this->add_control(
                'firstslide',
                [
                    'label' => esc_html__('First Slide', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => esc_html__('Which slide you want to show first ?', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 1,
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();
    }

    private function get_shortcode() {
        $settings = $this->get_settings();

        $attributes = [
            'id' => $settings['slider_name'],
            'firstslide' => $settings['firstslide'],
        ];

        $this->add_render_attribute('shortcode', $attributes);

        $shortcode = [];
        $shortcode[] = sprintf('[layerslider %s]', $this->get_render_attribute_string('shortcode'));

        return implode("", $shortcode);
    }

    public function render() {
        if (is_plugin_active('LayerSlider/layerslider.php')) {
            echo do_shortcode($this->get_shortcode());
        } else {
            ?>
            <div class="sa-el-alert-warning" >
                <div><?php printf(__('Please install and active <a target="_blank" href="https://codecanyon.net/item/layerslider-responsive-wordpress-slider-plugin/1362246">Layer Slider</a> Plugin to show your slider correctly.', SA_EL_ADDONS_TEXTDOMAIN)); ?></div>
            </div>
            <?php
        }
    }

    public function render_plain_content() {
        echo $this->get_shortcode();
    }

}
