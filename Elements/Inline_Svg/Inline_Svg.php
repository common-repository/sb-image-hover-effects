<?php

namespace SA_EL_ADDONS\Elements\Inline_Svg;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Interactive Card
 *
 * @author biplop
 * 
 */
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;

class Inline_Svg extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_inline_svg';
    }

    public function get_title() {
        return esc_html__('Inline Svg', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-code  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {
        $css_scheme = apply_filters(
                'sa-el-elements/sa-el-inline-svg/css-scheme',
                array(
                    'svg-wrapper' => '.sa-el-inline-svg__wrapper',
                    'svg-link' => '.sa-el-inline-svg',
                    'svg' => '.sa-el-inline-svg svg',
                )
        );

        $this->start_controls_section(
                'section_svg_content',
                array(
                    'label' => esc_html__('SVG', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_CONTENT,
                    'show_label' => false,
                )
        );

        $this->add_control(
                'svg_url',
                array(
                    'label' => esc_html__('SVG', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'default' => array(
                        'url' => '',
                    ),
                )
        );

        $this->add_control(
                'svg_link',
                array(
                    'label' => esc_html__('URL', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::URL,
                    'default' => array(
                        'url' => '',
                    ),
                    'dynamic' => array('active' => true),
                )
        );

        $this->end_controls_section();

        $this->Sa_El_Support();

        $this->start_controls_section(
                'section_svg_style',
                array(
                    'label' => esc_html__('SVG', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'show_label' => false,
                )
        );

        $this->add_control(
                'svg_custom_width',
                array(
                    'label' => esc_html__('Use Custom Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => esc_html__('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                    'default' => '',
                    'description' => esc_html__('Makes SVG responsive and allows to change its width.', SA_EL_ADDONS_TEXTDOMAIN)
                )
        );

        $this->add_control(
                'svg_aspect_ratio',
                array(
                    'label' => esc_html__('Use Aspect Ratio', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => esc_html__('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'description' => esc_html__('This option allows your SVG item to be scaled up exactly as your bitmap image, at the same time saving its width compared to the height. ', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => array(
                        'svg_custom_width' => 'yes'
                    )
                )
        );

        $this->add_responsive_control(
                'svg_width',
                array(
                    'label' => esc_html__('Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => array(
                        'px',
                    ),
                    'range' => array(
                        'px' => array(
                            'min' => 10,
                            'max' => 1000,
                        ),
                    ),
                    'default' => array(
                        'size' => 150,
                        'unit' => 'px',
                    ),
                    'selectors' => array(
                        '{{WRAPPER}} ' . $css_scheme['svg-link'] => 'max-width: {{SIZE}}{{UNIT}};',
                    ),
                    'condition' => array(
                        'svg_custom_width' => 'yes'
                    )
                )
        );

        $this->add_responsive_control(
                'svg_height',
                array(
                    'label' => esc_html__('Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => array(
                        'px',
                    ),
                    'range' => array(
                        'px' => array(
                            'min' => 10,
                            'max' => 1000,
                        ),
                    ),
                    'default' => array(
                        'size' => 150,
                        'unit' => 'px',
                    ),
                    'selectors' => array(
                        '{{WRAPPER}} ' . $css_scheme['svg'] => 'height: {{SIZE}}{{UNIT}};',
                    ),
                    'condition' => array(
                        'svg_aspect_ratio!' => 'yes',
                        'svg_custom_width' => 'yes'
                    )
                )
        );

        $this->add_control(
                'svg_custom_color',
                array(
                    'label' => esc_html__('Use Custom Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => esc_html__('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                    'default' => '',
                    'description' => esc_html__('Specifies color of all SVG elements that have a fill or stroke color set.', SA_EL_ADDONS_TEXTDOMAIN)
                )
        );

        $this->add_control(
                'svg_color',
                array(
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => array(
                        '{{WRAPPER}} ' . $css_scheme['svg-link'] => 'color: {{VALUE}};',
                    ),
                    'condition' => array(
                        'svg_custom_color' => 'yes'
                    )
                )
        );

        $this->add_control(
                'svg_hover_color',
                array(
                    'label' => esc_html__('Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => array(
                        '{{WRAPPER}} ' . $css_scheme['svg-link'] . ':hover' => 'color: {{VALUE}}',
                    ),
                    'condition' => array(
                        'svg_custom_color' => 'yes'
                    )
                )
        );

        $this->add_control(
                'svg_remove_inline_css',
                array(
                    'label' => esc_html__('Remove Inline CSS', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => esc_html__('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                    'default' => '',
                    'description' => esc_html__('Use this option to delete the inline styles in the loaded SVG.', SA_EL_ADDONS_TEXTDOMAIN)
                )
        );

        $this->add_responsive_control(
                'svg_alignment',
                array(
                    'label' => esc_html__('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'center',
                    'options' => array(
                        'left' => array(
                            'title' => esc_html__('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left',
                        ),
                        'center' => array(
                            'title' => esc_html__('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-center',
                        ),
                        'right' => array(
                            'title' => esc_html__('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right',
                        ),
                    ),
                    'selectors' => array(
                        '{{WRAPPER}} ' . $css_scheme['svg-wrapper'] => 'text-align: {{VALUE}};',
                    ),
                )
        );

        $this->end_controls_section();
    }

    public function prepare_svg($svg, $settings) {
        if ('yes' !== $settings['svg_aspect_ratio']) {
            $svg = preg_replace('[preserveAspectRatio\s*?=\s*?"\s*?.*?\s*?"]', '', $svg);
            $svg = preg_replace('[<svg]', '<svg preserveAspectRatio="none"', $svg);
        }

        if ('yes' === $settings['svg_remove_inline_css']) {
            $svg = preg_replace('[style\s*?=\s*?"\s*?.*?\s*?"]', '', $svg);
        }

        if ('yes' === $settings['svg_custom_color']) {
            $svg = preg_replace('[fill\s*?=\s*?("(?!(?:\s*?none\s*?)")[^"]*")]', 'fill="currentColor"', $svg);
            $svg = preg_replace('[stroke\s*?=\s*?("(?!(?:\s*?none\s*?)")[^"]*")]', 'stroke="currentColor"', $svg);
        }

        return $svg;
    }

    protected function render() {

        $this->__context = 'render';
        $settings = $this->get_settings_for_display();
        $tag = 'div';
        $svg = $this->get_image_by_url($settings['svg_url']['url'], array('class' => 'sa-el-inline-svg__inner'));

        $url = esc_url($settings['svg_url']['url']);

        if (empty($url)) {
            return;
        }

        $ext = pathinfo($url, PATHINFO_EXTENSION);

        if ('svg' !== $ext) {
            return printf('<h5 class="sa-el-inline-svg__error">%s</h5>', esc_html__('Please choose a SVG file format.', 'sa-el-elements'));
        }

        $svg = $this->prepare_svg($svg, $settings);

        $this->add_render_attribute('svg_wrap', 'class', 'sa-el-inline-svg');

        if (!empty($settings['svg_link']['url'])) {
            $tag = 'a';
            $this->add_render_attribute('svg_wrap', 'href', $settings['svg_link']['url']);

            if ('on' === $settings['svg_link']['is_external']) {
                $this->add_render_attribute('svg_wrap', 'target', '_blank');
            }

            if ('on' === $settings['svg_link']['nofollow']) {
                $this->add_render_attribute('svg_wrap', 'rel', 'nofollow');
            }
        }

        if ('yes' === $settings['svg_custom_width']) {
            $this->add_render_attribute('svg_wrap', 'class', 'sa-el-inline-svg--custom-width');
        }

        if ('yes' === $settings['svg_custom_color']) {
            $this->add_render_attribute('svg_wrap', 'class', 'sa-el-inline-svg--custom-color');
        }

        printf('<div class="elementor-%s sa-el-elements">', $this->get_name());
        echo '<div class="sa-el-inline-svg__wrapper"><' . $tag . ' ' . $this->get_render_attribute_string('svg_wrap') . '>';
        echo $svg;
        echo '</' . $tag . '></div> </div>';
    }

    public function get_attr_string($attr = array()) {

        if (empty($attr) || !is_array($attr)) {
            return;
        }

        $result = '';

        foreach ($attr as $key => $value) {
            $result .= sprintf(' %s="%s"', esc_attr($key), esc_attr($value));
        }

        return $result;
    }

    public function get_image_by_url($url = null, $attr = array()) {

        $url = esc_url($url);

        if (empty($url)) {
            return;
        }

        $ext = pathinfo($url, PATHINFO_EXTENSION);
        $attr = array_merge(array('alt' => ''), $attr);

        if ('svg' !== $ext) {
            return sprintf('<img src="%1$s"%2$s>', $url, $this->get_attr_string($attr));
        }

        $base_url = site_url('/');
        $svg_path = str_replace($base_url, ABSPATH, $url);
        $key = md5($svg_path);
        $svg = get_transient($key);

        if (!$svg) {
            $svg = file_get_contents($svg_path);
        }

        if (!$svg) {
            return sprintf('<img src="%1$s"%2$s>', $url, $this->get_attr_string($attr));
        }

        set_transient($key, $svg, DAY_IN_SECONDS);

        unset($attr['alt']);

        return sprintf('<div%2$s>%1$s</div>', $svg, $this->get_attr_string($attr));
    }

}
