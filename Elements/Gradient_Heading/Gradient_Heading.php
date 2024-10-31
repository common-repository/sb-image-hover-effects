<?php

namespace SA_EL_ADDONS\Elements\Gradient_Heading;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;
use \Elementor\Widget_Base as Widget_Base;
use \SA_EL_ADDONS\Classes\Front\Sa_Foreground_Control;

class Gradient_Heading extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_gradient_heading';
    }

    public function get_title() {
        return esc_html__('Gradient Heading', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-barcode  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
                '_section_title', [
            'label' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'title', [
            'label' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Shortcode Addons is Awesome', SA_EL_ADDONS_TEXTDOMAIN),
            'placeholder' => __('Type Gradient Heading Text', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'link', [
            'label' => __('Link', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::URL,
            'separator' => 'before',
            'placeholder' => __('https://example.com/', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'title_tag', [
            'label' => __('Title HTML Tag', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'h1' => [
                    'title' => __('H1', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-editor-h1'
                ],
                'h2' => [
                    'title' => __('H2', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-editor-h2'
                ],
                'h3' => [
                    'title' => __('H3', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-editor-h3'
                ],
                'h4' => [
                    'title' => __('H4', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-editor-h4'
                ],
                'h5' => [
                    'title' => __('H5', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-editor-h5'
                ],
                'h6' => [
                    'title' => __('H6', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-editor-h6'
                ]
            ],
            'default' => 'h1',
            'toggle' => false,
                ]
        );

        $this->add_responsive_control(
                'align', [
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
                'justify' => [
                    'title' => __('Justify', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'fa fa-align-justify',
                ],
            ],
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}}' => 'text-align: {{VALUE}}'
            ]
                ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();
        $this->start_controls_section(
                '_section_style_title', [
            'label' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Sa_Foreground_Control::get_type(), [
            'name' => 'title-color',
            'selector' => '{{WRAPPER}} .sa-el-gradient-heading',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title-typo',
            'selector' => '{{WRAPPER}} .sa-el-gradient-heading',
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(), [
            'name' => 'title-shadow',
            'label' => __('Text Shadow', SA_EL_ADDONS_TEXTDOMAIN),
            'selector' => '{{WRAPPER}} .sa-el-gradient-heading',
                ]
        );

        $this->add_control(
                'blend_mode', [
            'label' => __('Blend Mode', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                '' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                'multiply' => 'Multiply',
                'screen' => 'Screen',
                'overlay' => 'Overlay',
                'darken' => 'Darken',
                'lighten' => 'Lighten',
                'color-dodge' => 'Color Dodge',
                'saturation' => 'Saturation',
                'color' => 'Color',
                'difference' => 'Difference',
                'exclusion' => 'Exclusion',
                'hue' => 'Hue',
                'luminosity' => 'Luminosity',
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gradient-heading' => 'mix-blend-mode: {{VALUE}}',
            ],
            'separator' => 'none',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title-1',
            'selector' => '{{WRAPPER}} .sa-el-gradient-heading',
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                ]
        );

        $this->add_responsive_control(
                'heading_margin', [
            'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gradient-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'sa-el-gradient-heading');

        $title = wp_kses_post($settings['title']);

        if (!empty($settings['link']['url'])) {
            $this->add_render_attribute('link', 'href', esc_url($settings['link']['url']));
            if (!empty($settings['link']['is_external'])) {
                $this->add_render_attribute('link', 'target', '_blank');
            }

            if (!empty($settings['link']['nofollow'])) {
                $this->set_render_attribute('link', 'rel', 'nofollow');
            }

            $title = sprintf('<a %s>%s</a>',
                    $this->get_render_attribute_string('link'),
                    $title
            );
        }

        printf('<%1$s %2$s>%3$s</%1$s>',
                tag_escape($settings['title_tag']),
                $this->get_render_attribute_string('title'),
                $title
        );
    }

    public function _content_template() {
        ?>
        <#
        view.addInlineEditingAttributes( 'title', 'none' );
        view.addRenderAttribute( 'title', 'class', 'sa-el-gradient-heading' );

        var title = _.isEmpty(settings.link.url) ? settings.title : '<a href="'+settings.link.url+'">'+settings.title+'</a>';
        #>
        <{{ settings.title_tag }} {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ title }}}</{{ settings.title_tag }}>
        <?php
    }

}
