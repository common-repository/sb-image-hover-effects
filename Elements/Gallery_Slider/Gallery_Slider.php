<?php

namespace SA_EL_ADDONS\Elements\Gallery_Slider;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Image Accordion
 *
 * @author biplo
 * 
 */
use SA_EL_ADDONS\Classes\Front\Group_Control_Transition;
// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Scheme_Typography;
use \Elementor\Scheme_Color;
use \Elementor\Widget_Base as Widget_Base;

class Gallery_Slider extends Widget_Base {
    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_script_depends() {
        return [
            'jquery-slick',
        ];
    }

    public function get_name() {
        return 'sa_el_gallery_slider';
    }

    public function get_title() {
        return esc_html__('Gallery Slider', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-featured-image  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
                'section_gallery', [
            'label' => __('Gallery', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'wp_gallery', [
            'label' => __('Add Images', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::GALLERY,
            'dynamic' => ['active' => true],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_thumbnails', [
            'label' => __('Thumbnails', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'show_thumbnails', [
            'type' => Controls_Manager::SWITCHER,
            'label' => __('Thumbnails', SA_EL_ADDONS_TEXTDOMAIN),
            'default' => 'yes',
            'label_off' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
            'label_on' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
            'frontend_available' => true,
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'thumbnail',
            'label' => __('Thumbnails Size', SA_EL_ADDONS_TEXTDOMAIN),
            'condition' => [
                'show_thumbnails!' => '',
            ],
                ]
        );

        $this->add_responsive_control(
                'columns', [
            'label' => __('Columns', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => '3',
            'tablet_default' => '6',
            'mobile_default' => '4',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
                '9' => '9',
                '10' => '10',
                '11' => '11',
                '12' => '12',
            ],
            'prefix_class' => 'sa-el-grid-columns%s-',
            'frontend_available' => true,
            'condition' => [
                'show_thumbnails!' => '',
            ],
                ]
        );

        $this->add_control(
                'gallery_rand', [
            'label' => __('Ordering', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                '' => __('Default', SA_EL_ADDONS_TEXTDOMAIN),
                'rand' => __('Random', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'default' => '',
            'condition' => [
                'show_thumbnails!' => '',
            ],
                ]
        );

        $this->add_control(
                'thumbnails_caption_type', [
            'label' => __('Caption', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'options' => [
                '' => __('None', SA_EL_ADDONS_TEXTDOMAIN),
                'title' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                'caption' => __('Caption', SA_EL_ADDONS_TEXTDOMAIN),
                'description' => __('Description', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'condition' => [
                'show_thumbnails!' => '',
            ],
                ]
        );

        $this->add_control(
                'view', [
            'label' => __('View', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::HIDDEN,
            'default' => 'traditional',
            'condition' => [
                'show_thumbnails!' => '',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_preview', [
            'label' => __('Preview', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'preview',
            'label' => __('Preview Size', SA_EL_ADDONS_TEXTDOMAIN),
            'default' => 'full',
                ]
        );

        $this->add_control(
                'link_to', [
            'label' => __('Link to', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'none',
            'options' => [
                'none' => __('None', SA_EL_ADDONS_TEXTDOMAIN),
                'file' => __('Media File', SA_EL_ADDONS_TEXTDOMAIN),
                'custom' => __('Custom URL', SA_EL_ADDONS_TEXTDOMAIN),
            ],
                ]
        );

        $this->add_control(
                'link', [
            'label' => 'Link to',
            'type' => Controls_Manager::URL,
            'placeholder' => __('http://your-link.com', SA_EL_ADDONS_TEXTDOMAIN),
            'condition' => [
                'link_to' => 'custom',
            ],
            'show_label' => false,
                ]
        );

        $this->add_control(
                'open_lightbox', [
            'label' => __('Lightbox', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'default',
            'options' => [
                'default' => __('Default', SA_EL_ADDONS_TEXTDOMAIN),
                'yes' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                'no' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'condition' => [
                'link_to' => 'file',
            ],
                ]
        );

        $this->add_control(
                'preview_stretch', [
            'label' => __('Image Stretch', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'yes',
            'options' => [
                'no' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                'yes' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
            ],
                ]
        );

        $this->add_control(
                'caption_type', [
            'label' => __('Caption', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'caption',
            'options' => [
                '' => __('None', SA_EL_ADDONS_TEXTDOMAIN),
                'title' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                'caption' => __('Caption', SA_EL_ADDONS_TEXTDOMAIN),
                'description' => __('Description', SA_EL_ADDONS_TEXTDOMAIN),
            ],
                ]
        );

        $this->add_control(
                'show_arrows', [
            'type' => Controls_Manager::SWITCHER,
            'label' => __('Arrows', SA_EL_ADDONS_TEXTDOMAIN),
            'default' => '',
            'label_off' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
            'label_on' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
            'frontend_available' => true,
            'prefix_class' => 'elementor-arrows-',
            'render_type' => 'template',
                ]
        );

        $this->add_control(
                'autoplay', [
            'label' => __('Autoplay', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'yes',
            'options' => [
                'yes' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                'no' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'frontend_available' => true,
                ]
        );

        $this->add_control(
                'autoplay_speed', [
            'label' => __('Autoplay Speed', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::NUMBER,
            'default' => 5000,
            'frontend_available' => true,
            'condition' => [
                'autoplay' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'pause_on_hover', [
            'label' => __('Pause on Hover', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'yes',
            'options' => [
                'yes' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                'no' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'frontend_available' => true,
            'condition' => [
                'autoplay' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'infinite', [
            'label' => __('Infinite Loop', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'yes',
            'options' => [
                'yes' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                'no' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'frontend_available' => true,
                ]
        );

        $this->add_control(
                'adaptive_height', [
            'label' => __('Adaptive Height', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'yes',
            'options' => [
                'yes' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                'no' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'frontend_available' => true,
                ]
        );

        $this->add_control(
                'effect', [
            'label' => __('Effect', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'slide',
            'options' => [
                'slide' => __('Slide', SA_EL_ADDONS_TEXTDOMAIN),
                'fade' => __('Fade', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'frontend_available' => true,
                ]
        );

        $this->add_control(
                'speed', [
            'label' => __('Animation Speed', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::NUMBER,
            'default' => 500,
            'frontend_available' => true,
                ]
        );

        $this->add_control(
                'direction', [
            'label' => __('Direction', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'ltr',
            'options' => [
                'ltr' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                'rtl' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'frontend_available' => true,
                ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();

        $this->start_controls_section(
                'section_style_preview', [
            'label' => __('Preview', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs('preview_tabs');

        $this->start_controls_tab('preview_layout', ['label' => __('Layout', SA_EL_ADDONS_TEXTDOMAIN)]);

        $this->add_control(
                'preview_position', [
            'label' => __('Position', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'left',
            'tablet_default' => 'top',
            'mobile_default' => 'top',
            'options' => [
                'top' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                'right' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                'left' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'prefix_class' => 'sa-el-gallery-slider--',
            'condition' => [
                'show_thumbnails!' => '',
            ],
                ]
        );

        $this->add_control(
                'preview_stack', [
            'label' => __('Stack on', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'tablet',
            'tablet_default' => 'top',
            'mobile_default' => 'top',
            'options' => [
                'tablet' => __('Tablet & Mobile', SA_EL_ADDONS_TEXTDOMAIN),
                'mobile' => __('Mobile Only', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'prefix_class' => 'sa-el-gallery-slider--stack-',
            'condition' => [
                'show_thumbnails!' => '',
            ],
                ]
        );

        $this->add_responsive_control(
                'preview_width', [
            'label' => __('Width (%)', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'size' => 70,
            ],
            'condition' => [
                'preview_position!' => 'top',
                'show_thumbnails!' => '',
            ],
            'selectors' => [
                '{{WRAPPER}}.sa-el-gallery-slider--left .sa-el-gallery-slider__preview' => 'width: {{SIZE}}%',
                '{{WRAPPER}}.sa-el-gallery-slider--right .sa-el-gallery-slider__preview' => 'width: {{SIZE}}%',
                '{{WRAPPER}}.sa-el-gallery-slider--left .sa-el-gallery-slider__gallery' => 'width: calc(100% - {{SIZE}}%)',
                '{{WRAPPER}}.sa-el-gallery-slider--right .sa-el-gallery-slider__gallery' => 'width: calc(100% - {{SIZE}}%)',
            ],
                ]
        );

        $preview_horizontal_margin = is_rtl() ? 'margin-right' : 'margin-left';
        $preview_horizontal_padding = is_rtl() ? 'padding-right' : 'padding-left';

        $this->add_responsive_control(
                'preview_spacing', [
            'label' => __('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'default' => [
                'size' => 24,
            ],
            'selectors' => [
                '{{WRAPPER}}.sa-el-gallery-slider--left .sa-el-gallery-slider > *,
								 {{WRAPPER}}.sa-el-gallery-slider--right .sa-el-gallery-slider > *' => $preview_horizontal_padding . ': {{SIZE}}{{UNIT}};',
                '{{WRAPPER}}.sa-el-gallery-slider--left .sa-el-gallery-slider,
								 {{WRAPPER}}.sa-el-gallery-slider--right .sa-el-gallery-slider' => $preview_horizontal_margin . ': -{{SIZE}}{{UNIT}};',
                '{{WRAPPER}}.sa-el-gallery-slider--top .sa-el-gallery-slider__preview' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                '(tablet){{WRAPPER}}.sa-el-gallery-slider--stack-tablet .sa-el-gallery-slider__preview' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                '(mobile){{WRAPPER}}.sa-el-gallery-slider--stack-mobile .sa-el-gallery-slider__preview' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'show_thumbnails!' => '',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('preview_images', ['label' => __('Images', SA_EL_ADDONS_TEXTDOMAIN)]);

        $this->add_group_control(
                Group_Control_Border::get_type(), [
            'name' => 'preview_border',
            'label' => __('Image Border', SA_EL_ADDONS_TEXTDOMAIN),
            'selector' => '{{WRAPPER}} .slick-slider',
                ]
        );

        $this->add_control(
                'preview_border_radius', [
            'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .slick-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(), [
            'name' => 'preview_box_shadow',
            'selector' => '{{WRAPPER}} .slick-slider',
            'separator' => '',
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
                'arrows_style_heading', [
            'label' => __('Arrows', SA_EL_ADDONS_TEXTDOMAIN),
            'separator' => 'before',
            'type' => Controls_Manager::HEADING,
            'condition' => [
                'show_arrows!' => '',
            ]
                ]
        );

        $this->add_responsive_control(
                'arrows_size', [
            'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 12,
                    'max' => 48,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__arrow' => 'font-size: {{SIZE}}px;',
            ],
            'condition' => [
                'show_arrows!' => '',
            ]
                ]
        );

        $this->add_responsive_control(
                'arrows_padding', [
            'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1,
                    'step' => 0.1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__arrow' => 'padding: {{SIZE}}em;',
            ],
            'condition' => [
                'show_arrows!' => '',
            ]
                ]
        );

        $this->add_responsive_control(
                'arrows_distance', [
            'label' => __('Distance', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__arrow' => 'margin: {{SIZE}}px; transform: translateY( calc(-50% - {{SIZE}}px ) )',
            ],
            'condition' => [
                'show_arrows!' => '',
            ]
                ]
        );

        $this->add_responsive_control(
                'arrows_border_radius', [
            'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__arrow' => 'border-radius: {{SIZE}}%;',
            ],
            'condition' => [
                'show_arrows!' => '',
            ],
            'separator' => 'after',
                ]
        );

        $this->add_group_control(
                Group_Control_Transition::get_type(), [
            'name' => 'arrows',
            'selector' => '{{WRAPPER}} .sa-el-carousel__arrow,
										{{WRAPPER}} .sa-el-carousel__arrow:before',
            'condition' => [
                'show_arrows!' => '',
            ]
                ]
        );

        $this->start_controls_tabs('arrows_tabs_hover');

        $this->start_controls_tab('arrows_tab_default', [
            'label' => __('Default', SA_EL_ADDONS_TEXTDOMAIN),
            'condition' => [
                'show_arrows!' => '',
            ]
        ]);

        $this->add_control(
                'arrows_color', [
            'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__arrow i:before' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'show_arrows!' => '',
            ]
                ]
        );

        $this->add_control(
                'arrows_background_color', [
            'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__arrow' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'show_arrows!' => '',
            ]
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('arrows_tab_hover', [
            'label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
            'condition' => [
                'show_arrows!' => '',
            ]
        ]);

        $this->add_control(
                'arrows_color_hover', [
            'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__arrow:hover i:before' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'show_arrows!' => '',
            ]
                ]
        );

        $this->add_control(
                'arrows_background_color_hover', [
            'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__arrow:hover' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'show_arrows!' => '',
            ]
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('arrows_tab_disabled', [
            'label' => __('Disabled', SA_EL_ADDONS_TEXTDOMAIN),
            'condition' => [
                'show_arrows!' => '',
            ]
        ]);

        $this->add_responsive_control(
                'arrows_opacity_disabled', [
            'label' => __('Opacity', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1,
                    'step' => 0.05,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__arrow.slick-disabled' => 'opacity: {{SIZE}};',
            ],
            'condition' => [
                'show_arrows!' => '',
            ]
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_preview_captions', [
            'label' => __('Preview Captions', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'preview_vertical_align', [
            'label' => __('Vertical Align', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'top' => [
                    'title' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-v-align-top',
                ],
                'middle' => [
                    'title' => __('Middle', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-v-align-middle',
                ],
                'bottom' => [
                    'title' => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-v-align-bottom',
                ],
            ],
            'default' => 'bottom',
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'preview_horizontal_align', [
            'label' => __('Horizontal Align', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::CHOOSE,
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
                'justify' => [
                    'title' => __('Justify', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-h-align-stretch',
                ],
            ],
            'default' => 'justify',
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'preview_align', [
            'label' => __('Text Align', SA_EL_ADDONS_TEXTDOMAIN),
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
            'default' => 'center',
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__media__caption' => 'text-align: {{VALUE}};',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'preview_typography',
            'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
            'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            'selector' => '{{WRAPPER}} .sa-el-carousel__media__caption',
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'preview_text_padding', [
            'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__media__caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'preview_text_margin', [
            'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__media__caption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'caption_type!' => '',
            ],
            'separator' => 'after',
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(), [
            'name' => 'preview_text_border',
            'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
            'selector' => '{{WRAPPER}} .sa-el-carousel__media__caption',
            'separator' => '',
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'preview_text_border_radius', [
            'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__media__caption' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_preview_hover_effects', [
            'label' => __('Preview Hover Effects', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'hover_preview_captions_heading', [
            'label' => __('Captions', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::HEADING,
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Transition::get_type(), [
            'name' => 'preview_caption',
            'selector' => '{{WRAPPER}} .sa-el-carousel__media__content,
										{{WRAPPER}} .sa-el-carousel__media__caption',
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->update_control('preview_caption_transition', array(
            'default' => 'custom',
        ));

        $this->add_control(
                'preview_caption_effect', [
            'label' => __('Effect', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'options' => [
                '' => __('None', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-in' => __('Fade In', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-out' => __('Fade Out', SA_EL_ADDONS_TEXTDOMAIN),
                'from-top' => __('From Top', SA_EL_ADDONS_TEXTDOMAIN),
                'from-right' => __('From Right', SA_EL_ADDONS_TEXTDOMAIN),
                'from-bottom' => __('From Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                'from-left' => __('From Left', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-from-top' => __('Fade From Top', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-from-right' => __('Fade From Right', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-from-bottom' => __('Fade From Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-from-left' => __('Fade From Left', SA_EL_ADDONS_TEXTDOMAIN),
                'to-top' => __('To Top', SA_EL_ADDONS_TEXTDOMAIN),
                'to-right' => __('To Right', SA_EL_ADDONS_TEXTDOMAIN),
                'to-bottom' => __('To Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                'to-left' => __('To Left', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-to-top' => __('Fade To Top', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-to-right' => __('Fade To Right', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-to-bottom' => __('Fade To Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-to-left' => __('Fade To Left', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'condition' => [
                'caption_type!' => '',
                'preview_caption_transition!' => '',
            ],
                ]
        );

        $this->start_controls_tabs('preview_caption_style');

        $this->start_controls_tab('preview_caption_style_default', [
            'label' => __('Default', SA_EL_ADDONS_TEXTDOMAIN),
            'condition' => [
                'caption_type!' => '',
            ],
        ]);

        $this->add_control(
                'preview_text_color', [
            'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__media__caption' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(), [
            'name' => 'preview_text_background',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .sa-el-carousel__media__caption',
            'default' => 'classic',
            'condition' => [
                'caption_type!' => '',
            ],
            'exclude' => [
                'image',
            ]
                ]
        );

        $this->add_control(
                'preview_text_opacity', [
            'label' => __('Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 1,
            ],
            'range' => [
                'px' => [
                    'max' => 1,
                    'min' => 0,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__media__caption' => 'opacity: {{SIZE}}',
            ],
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(), [
            'name' => 'preview_text_box_shadow',
            'selector' => '{{WRAPPER}} .sa-el-carousel__media__caption',
            'separator' => '',
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('preview_caption_style_hover', [
            'label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
            'condition' => [
                'caption_type!' => '',
            ],
        ]);

        $this->add_control(
                'preview_text_color_hover', [
            'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__media:hover .sa-el-carousel__media__caption' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(), [
            'name' => 'preview_text_background_hover',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .sa-el-carousel__media:hover .sa-el-carousel__media__caption',
            'default' => 'classic',
            'condition' => [
                'caption_type!' => '',
            ],
            'exclude' => [
                'image',
            ]
                ]
        );

        $this->add_control(
                'preview_text_opacity_hover', [
            'label' => __('Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 1,
            ],
            'range' => [
                'px' => [
                    'max' => 1,
                    'min' => 0,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__media:hover .sa-el-carousel__media__caption' => 'opacity: {{SIZE}}',
            ],
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'preview_text_border_color_hover', [
            'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .sa-el-carousel__media:hover .sa-el-carousel__media__caption' => 'border-color: {{VALUE}};',
            ],
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(), [
            'name' => 'preview_text_box_shadow_hover',
            'selector' => '{{WRAPPER}} .sa-el-carousel__media:hover .sa-el-carousel__media__caption',
            'separator' => '',
            'condition' => [
                'caption_type!' => '',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_thumbnails', [
            'label' => __('Thumbnails', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_thumbnails!' => '',
            ],
                ]
        );

        $this->add_control(
                'image_align', [
            'label' => __('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::CHOOSE,
            'default' => '',
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
            'prefix_class' => 'sa-el-grid-halign--',
                ]
        );

        $this->add_control(
                'image_vertical_align', [
            'label' => __('Vertical Alignment', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::CHOOSE,
            'default' => 'stretch',
            'options' => [
                'top' => [
                    'title' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-v-align-top',
                ],
                'middle' => [
                    'title' => __('Middle', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-v-align-middle',
                ],
                'bottom' => [
                    'title' => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-v-align-bottom',
                ],
                'stretch' => [
                    'title' => __('Stretch', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-v-align-stretch',
                ],
            ],
            'prefix_class' => 'sa-el-grid-align--',
                ]
        );

        $this->add_responsive_control(
                'image_stretch_ratio', [
            'label' => __('Image Size Ratio', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => '100'
            ],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 200,
                ],
            ],
            'condition' => [
                'image_vertical_align' => 'stretch',
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media:before' => 'padding-bottom: {{SIZE}}%;',
            ],
                ]
        );

        $columns_horizontal_margin = is_rtl() ? 'margin-right' : 'margin-left';
        $columns_horizontal_padding = is_rtl() ? 'padding-right' : 'padding-left';

        $this->add_responsive_control(
                'image_horizontal_spacing', [
            'label' => __('Horizontal spacing', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'default' => [
                'size' => 0,
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__item' => $columns_horizontal_padding . ': {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .sa-el-gallery' => $columns_horizontal_margin . ': -{{SIZE}}{{UNIT}};',
                '(desktop){{WRAPPER}} .sa-el-gallery__item' => 'max-width: calc( 100% / {{columns.SIZE}} );',
                '(tablet){{WRAPPER}} .sa-el-gallery__item' => 'max-width: calc( 100% / {{columns_tablet.SIZE}} );',
                '(mobile){{WRAPPER}} .sa-el-gallery__item' => 'max-width: calc( 100% / {{columns_mobile.SIZE}} );',
            ],
                ]
        );

        $this->add_responsive_control(
                'image_vertical_spacing', [
            'label' => __('Vertical spacing', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'default' => [
                'size' => '',
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__item' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .sa-el-gallery' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(), [
            'name' => 'image_border',
            'label' => __('Image Border', SA_EL_ADDONS_TEXTDOMAIN),
            'selector' => '{{WRAPPER}} .sa-el-gallery__media-wrapper',
            'separator' => '',
                ]
        );

        $this->add_control(
                'image_border_radius', [
            'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_captions', [
            'label' => __('Thumbnails Captions', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'thumbnails_caption_type!' => '',
                'show_thumbnails!' => '',
            ],
                ]
        );

        $this->add_control(
                'vertical_align', [
            'label' => __('Vertical Align', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'top' => [
                    'title' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-v-align-top',
                ],
                'middle' => [
                    'title' => __('Middle', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-v-align-middle',
                ],
                'bottom' => [
                    'title' => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-v-align-bottom',
                ],
            ],
            'default' => 'bottom',
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'horizontal_align', [
            'label' => __('Horizontal Align', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::CHOOSE,
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
                'justify' => [
                    'title' => __('Justify', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-h-align-stretch',
                ],
            ],
            'default' => 'justify',
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'align', [
            'label' => __('Text Align', SA_EL_ADDONS_TEXTDOMAIN),
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
            'default' => 'center',
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media__caption' => 'text-align: {{VALUE}};',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'typography',
            'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
            'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            'selector' => '{{WRAPPER}} .sa-el-gallery__media__caption',
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'text_padding', [
            'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media__caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'text_margin', [
            'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media__caption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
            'separator' => 'after',
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(), [
            'name' => 'text_border',
            'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
            'selector' => '{{WRAPPER}} .sa-el-gallery__media__caption',
            'separator' => '',
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'text_border_radius', [
            'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media__caption' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_thumbnails_hover_effects', [
            'label' => __('Thumbnails Hover Effects', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_thumbnails!' => '',
            ],
                ]
        );

        $this->add_control(
                'hover_thubmanils_images_heading', [
            'label' => __('Images', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_group_control(
                Group_Control_Transition::get_type(), [
            'name' => 'image',
            'selector' => '{{WRAPPER}} .sa-el-gallery__media-wrapper,
									{{WRAPPER}} .sa-el-gallery__media__thumbnail,
									{{WRAPPER}} .sa-el-gallery__media__thumbnail img',
            'separator' => '',
                ]
        );

        $this->update_control('image_transition', array(
            'default' => 'custom',
        ));

        $this->start_controls_tabs('image_style');

        $this->start_controls_tab('image_style_default', ['label' => __('Default', SA_EL_ADDONS_TEXTDOMAIN),]);

        $this->add_control(
                'image_background_color', [
            'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media-wrapper' => 'background-color: {{VALUE}};',
            ],
                ]
        );

        $this->add_responsive_control(
                'image_opacity', [
            'label' => __('Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 1,
            ],
            'range' => [
                'px' => [
                    'max' => 1,
                    'min' => 0,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media__thumbnail img' => 'opacity: {{SIZE}}',
            ],
                ]
        );

        $this->add_responsive_control(
                'image_scale', [
            'label' => __('Scale', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 2,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media__thumbnail img' => 'transform: scale({{SIZE}});',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(), [
            'name' => 'image_box_shadow',
            'selector' => '{{WRAPPER}} .sa-el-gallery__media-wrapper',
            'separator' => '',
                ]
        );

        $this->add_group_control(
                Group_Control_Css_Filter::get_type(), [
            'name' => 'image_css_filters',
            'selector' => '{{WRAPPER}} .sa-el-gallery__media__thumbnail img',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('image_style_hover', ['label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),]);

        $this->add_control(
                'image_background_color_hover', [
            'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media:hover .sa-el-gallery__media-wrapper' => 'background-color: {{VALUE}};',
            ],
                ]
        );

        $this->add_responsive_control(
                'image_opacity_hover', [
            'label' => __('Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 1,
            ],
            'range' => [
                'px' => [
                    'max' => 1,
                    'min' => 0,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media:hover .sa-el-gallery__media__thumbnail img' => 'opacity: {{SIZE}}',
            ],
                ]
        );

        $this->add_responsive_control(
                'image_scale_hover', [
            'label' => __('Scale', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 2,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media:hover .sa-el-gallery__media__thumbnail img' => 'transform: scale({{SIZE}});',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(), [
            'name' => 'image_box_shadow_hover',
            'selector' => '{{WRAPPER}} .sa-el-gallery__media:hover .sa-el-gallery__media-wrapper',
            'separator' => '',
                ]
        );

        $this->add_control(
                'image_border_color_hover', [
            'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media:hover .sa-el-gallery__media-wrapper' => 'border-color: {{VALUE}};',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Css_Filter::get_type(), [
            'name' => 'image_css_filters_hover',
            'selector' => '{{WRAPPER}} .sa-el-gallery__media:hover .sa-el-gallery__media__thumbnail img',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('image_style_active', ['label' => __('Active', SA_EL_ADDONS_TEXTDOMAIN),]);

        $this->add_control(
                'image_background_color_active', [
            'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__item.is--active .sa-el-gallery__media-wrapper' => 'background-color: {{VALUE}};',
            ],
                ]
        );

        $this->add_responsive_control(
                'image_opacity_active', [
            'label' => __('Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 1,
            ],
            'range' => [
                'px' => [
                    'max' => 1,
                    'min' => 0,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__item.is--active .sa-el-gallery__media__thumbnail img' => 'opacity: {{SIZE}}',
            ],
                ]
        );

        $this->add_responsive_control(
                'image_scale_active', [
            'label' => __('Scale', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 2,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__item.is--active .sa-el-gallery__media__thumbnail img' => 'transform: scale({{SIZE}});',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(), [
            'name' => 'image_box_shadow_active',
            'selector' => '{{WRAPPER}} .sa-el-gallery__item.is--active .sa-el-gallery__media-wrapper',
            'separator' => '',
                ]
        );

        $this->add_control(
                'image_border_color_active', [
            'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__item.is--active .sa-el-gallery__media-wrapper' => 'border-color: {{VALUE}};',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Css_Filter::get_type(), [
            'name' => 'image_css_filters_active',
            'selector' => '{{WRAPPER}} .sa-el-gallery__item.is--active .sa-el-gallery__media__thumbnail img',
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
                'hover_thubmanils_captions_heading', [
            'label' => __('Captions', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Transition::get_type(), [
            'name' => 'caption',
            'selector' => '{{WRAPPER}} .sa-el-gallery__media__content,
										{{WRAPPER}} .sa-el-gallery__media__caption',
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->update_control('caption_transition', array(
            'default' => 'custom',
        ));

        $this->add_control(
                'caption_effect', [
            'label' => __('Effect', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'options' => [
                '' => __('None', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-in' => __('Fade In', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-out' => __('Fade Out', SA_EL_ADDONS_TEXTDOMAIN),
                'from-top' => __('From Top', SA_EL_ADDONS_TEXTDOMAIN),
                'from-right' => __('From Right', SA_EL_ADDONS_TEXTDOMAIN),
                'from-bottom' => __('From Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                'from-left' => __('From Left', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-from-top' => __('Fade From Top', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-from-right' => __('Fade From Right', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-from-bottom' => __('Fade From Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-from-left' => __('Fade From Left', SA_EL_ADDONS_TEXTDOMAIN),
                'to-top' => __('To Top', SA_EL_ADDONS_TEXTDOMAIN),
                'to-right' => __('To Right', SA_EL_ADDONS_TEXTDOMAIN),
                'to-bottom' => __('To Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                'to-left' => __('To Left', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-to-top' => __('Fade To Top', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-to-right' => __('Fade To Right', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-to-bottom' => __('Fade To Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                'fade-to-left' => __('Fade To Left', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
                'caption_transition!' => '',
            ],
                ]
        );

        $this->start_controls_tabs('caption_style');

        $this->start_controls_tab('caption_style_default', [
            'label' => __('Default', SA_EL_ADDONS_TEXTDOMAIN),
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
        ]);

        $this->add_control(
                'text_color', [
            'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media__caption' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'text_background_color', [
            'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media__caption' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'text_opacity', [
            'label' => __('Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 1,
            ],
            'range' => [
                'px' => [
                    'max' => 1,
                    'min' => 0,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media__caption' => 'opacity: {{SIZE}}',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
                'tilt_enable' => 'yes',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(), [
            'name' => 'text_box_shadow',
            'selector' => '{{WRAPPER}} .sa-el-gallery__media__caption',
            'separator' => '',
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('caption_style_hover', [
            'label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
        ]);

        $this->add_control(
                'text_color_hover', [
            'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media:hover .sa-el-gallery__media__caption' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'text_background_color_hover', [
            'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media:hover .sa-el-gallery__media__caption' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'text_opacity_hover', [
            'label' => __('Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 1,
            ],
            'range' => [
                'px' => [
                    'max' => 1,
                    'min' => 0,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media:hover .sa-el-gallery__media__caption' => 'opacity: {{SIZE}}',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
                'tilt_enable' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'text_border_color_hover', [
            'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media:hover .sa-el-gallery__media__caption' => 'border-color: {{VALUE}};',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(), [
            'name' => 'text_box_shadow_hover',
            'selector' => '{{WRAPPER}} .sa-el-gallery__media:hover .sa-el-gallery__media__caption',
            'separator' => '',
            'condition' => [
                'thumbnails_caption_type!' => '',
                'tilt_enable' => 'yes',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('caption_style_active', [
            'label' => __('Active', SA_EL_ADDONS_TEXTDOMAIN),
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
        ]);

        $this->add_control(
                'text_color_active', [
            'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__item.is--active .sa-el-gallery__media__caption' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'text_background_color_active', [
            'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__item.is--active .sa-el-gallery__media__caption' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_control(
                'text_opacity_active', [
            'label' => __('Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 1,
            ],
            'range' => [
                'px' => [
                    'max' => 1,
                    'min' => 0,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__item.is--active .sa-el-gallery__media__caption' => 'opacity: {{SIZE}}',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
                'tilt_enable' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'text_border_color_active', [
            'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__item.is--active .sa-el-gallery__media__caption' => 'border-color: {{VALUE}};',
            ],
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(), [
            'name' => 'text_box_shadow_active',
            'selector' => '{{WRAPPER}} .sa-el-gallery__item.is--active .sa-el-gallery__media__caption',
            'separator' => '',
            'condition' => [
                'thumbnails_caption_type!' => '',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
                'hover_thubmanils_overlay_heading', [
            'label' => __('Overlay', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
                ]
        );

        $this->add_group_control(
                Group_Control_Transition::get_type(), [
            'name' => 'overlay',
            'selector' => '{{WRAPPER}} .sa-el-gallery__media__overlay',
            'separator' => 'after',
                ]
        );

        $this->update_control('overlay_transition', array(
            'default' => 'custom',
        ));

        $this->start_controls_tabs('overlay_style');

        $this->start_controls_tab('overlay_style_default', ['label' => __('Default', SA_EL_ADDONS_TEXTDOMAIN)]);

        $this->add_group_control(
                Group_Control_Background::get_type(), [
            'name' => 'overlay_background',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .sa-el-gallery__media__overlay',
            'default' => 'classic',
            'exclude' => [
                'image',
            ]
                ]
        );

        $this->add_control(
                'overlay_blend', [
            'label' => __('Blend mode', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'normal',
            'options' => [
                'normal' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                'multiply' => __('Multiply', SA_EL_ADDONS_TEXTDOMAIN),
                'screen' => __('Screen', SA_EL_ADDONS_TEXTDOMAIN),
                'overlay' => __('Overlay', SA_EL_ADDONS_TEXTDOMAIN),
                'darken' => __('Darken', SA_EL_ADDONS_TEXTDOMAIN),
                'lighten' => __('Lighten', SA_EL_ADDONS_TEXTDOMAIN),
                'color' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'color-dodge' => __('Color Dodge', SA_EL_ADDONS_TEXTDOMAIN),
                'hue' => __('Hue', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media__overlay' => 'mix-blend-mode: {{VALUE}};',
            ],
                ]
        );

        $this->add_control(
                'overlay_blend_notice', [
            'type' => Controls_Manager::RAW_HTML,
            'raw' => sprintf(__('Please check blend mode support for your browser %1$s here %2$s', SA_EL_ADDONS_TEXTDOMAIN), '<a href="https://caniuse.com/#search=mix-blend-mode" target="_blank">', '</a>'),
            'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
            'condition' => [
                'overlay_blend!' => 'normal'
            ],
                ]
        );

        $this->add_responsive_control(
                'overlay_margin', [
            'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 48,
                    'min' => 0,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media__overlay' => 'top: {{SIZE}}px; right: {{SIZE}}px; bottom: {{SIZE}}px; left: {{SIZE}}px',
            ],
                ]
        );

        $this->add_responsive_control(
                'overlay_opacity', [
            'label' => __('Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 1,
            ],
            'range' => [
                'px' => [
                    'max' => 1,
                    'min' => 0,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media__overlay' => 'opacity: {{SIZE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(), [
            'name' => 'overlay_border',
            'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
            'selector' => '{{WRAPPER}} .sa-el-gallery__media__overlay',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('overlay_style_hover', ['label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN)]);

        $this->add_group_control(
                Group_Control_Background::get_type(), [
            'name' => 'overlay_background_hover',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .sa-el-gallery__media:hover .sa-el-gallery__media__overlay',
            'default' => 'classic',
            'exclude' => [
                'image',
            ]
                ]
        );

        $this->add_responsive_control(
                'overlay_margin_hover', [
            'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 48,
                    'min' => 0,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media:hover .sa-el-gallery__media__overlay' => 'top: {{SIZE}}px; right: {{SIZE}}px; bottom: {{SIZE}}px; left: {{SIZE}}px',
            ],
                ]
        );

        $this->add_responsive_control(
                'overlay_opacity_hover', [
            'label' => __('Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 1,
                    'min' => 0,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__media:hover .sa-el-gallery__media__overlay' => 'opacity: {{SIZE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(), [
            'name' => 'overlay_border_hover',
            'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
            'selector' => '{{WRAPPER}} .sa-el-gallery__media:hover .sa-el-gallery__media__overlay',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('overlay_style_active', ['label' => __('Active', SA_EL_ADDONS_TEXTDOMAIN)]);

        $this->add_group_control(
                Group_Control_Background::get_type(), [
            'name' => 'overlay_background_active',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .sa-el-gallery__item.is--active .sa-el-gallery__media__overlay',
            'default' => 'classic',
            'exclude' => [
                'image',
            ]
                ]
        );

        $this->add_responsive_control(
                'overlay_margin_active', [
            'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 48,
                    'min' => 0,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__item.is--active .sa-el-gallery__media__overlay' => 'top: {{SIZE}}px; right: {{SIZE}}px; bottom: {{SIZE}}px; left: {{SIZE}}px',
            ],
                ]
        );

        $this->add_responsive_control(
                'overlay_opacity_active', [
            'label' => __('Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 1,
                    'min' => 0,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-gallery__item.is--active .sa-el-gallery__media__overlay' => 'opacity: {{SIZE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(), [
            'name' => 'overlay_border_active',
            'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
            'selector' => '{{WRAPPER}} .sa-el-gallery__item.is--active .sa-el-gallery__media__overlay',
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render
     * 
     * Render widget contents on frontend
     *
     * @since  1.1.0
     * @return void
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if (!$settings['wp_gallery'])
            return;

        $this->add_render_attribute([
            'wrapper' => [
                'class' => 'sa-el-gallery-slider',
            ],
            'preview' => [
                'class' => [
                    'sa-el-gallery-slider__preview',
                    'elementor-slick-slider',
                ],
            ],
            'gallery-wrapper' => [
                'class' => [
                    'sa-el-gallery-slider__gallery',
                ],
            ],
            'gallery' => [
                'class' => [
                    'sa-el-gallery',
                    'sa-el-grid',
                    'sa-el-grid--gallery',
                    'sa-el-gallery__gallery',
                    'sa-el-media-align--' . $settings['vertical_align'],
                    'sa-el-media-align--' . $settings['horizontal_align'],
                    'sa-el-media-effect__content--' . $settings['caption_effect'],
                ],
            ],
            'slider' => [
                'class' => [
                    'elementor-image-carousel',
                    'sa-el-carousel',
                    'sa-el-gallery-slider__carousel',
                    'sa-el-media-align--' . $settings['preview_vertical_align'],
                    'sa-el-media-align--' . $settings['preview_horizontal_align'],
                    'sa-el-media-effect__content--' . $settings['preview_caption_effect'],
                ],
            ],
            'gallery-thumbnail' => [
                'class' => [
                    'sa-el-media__thumbnail',
                    'sa-el-gallery__media__thumbnail',
                ],
            ],
            'gallery-overlay' => [
                'class' => [
                    'sa-el-media__overlay',
                    'sa-el-gallery__media__overlay',
                ],
            ],
            'gallery-content' => [
                'class' => [
                    'sa-el-media__content',
                    'sa-el-gallery__media__content',
                ],
            ],
            'gallery-caption' => [
                'class' => [
                    'wp-caption-text',
                    'sa-el-media__content__caption',
                    'sa-el-gallery__media__caption',
                ],
            ],
            'gallery-item' => [
                'class' => [
                    'sa-el-gallery__item',
                    'sa-el-grid__item',
                ],
            ],
        ]);

        if ($settings['columns']) {
            $this->add_render_attribute('shortcode', 'columns', $settings['columns']);
        }

        if (!empty($settings['gallery_rand'])) {
            $this->add_render_attribute('shortcode', 'orderby', $settings['gallery_rand']);
        }

        if ('yes' === $settings['preview_stretch']) {
            $this->add_render_attribute('slider', 'class', 'slick-image-stretch');
        }
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div <?php echo $this->get_render_attribute_string('preview'); ?> dir="<?php echo $settings['direction']; ?>">
                <div <?php echo $this->get_render_attribute_string('slider'); ?>>
        <?php echo $this->render_carousel(); ?>
                </div>
            </div>

        <?php if ('yes' === $settings['show_thumbnails']) : ?>
                <div <?php echo $this->get_render_attribute_string('gallery-wrapper'); ?>>
                    <div <?php echo $this->get_render_attribute_string('gallery'); ?>>
            <?php echo $this->render_wp_gallery(); ?>
                    </div>
                </div>
        <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Render WP Gallery
     * 
     * Render gallery from wp gallery data
     *
     * @since  1.1.0
     * @return void
     */
    protected function render_wp_gallery() {

        $settings = $this->get_settings_for_display();
        $gallery = $settings['wp_gallery'];
        $media_tag = 'figure';

        foreach ($gallery as $index => $item) {

            $item_url = (in_array('url', $item)) ? $item['url'] : '';

            $image = self::get_image_info($item['id'], $item_url, $settings['thumbnail_size']);

            $gallery_media_key = $this->get_repeater_setting_key('gallery-media', 'wp_gallery', $index);
            $gallery_media_wrapper_key = $this->get_repeater_setting_key('gallery-media-wrapper', 'wp_gallery', $index);

            $this->add_render_attribute([
                $gallery_media_key => [
                    'class' => [
                        'sa-el-media',
                        'sa-el-gallery__media',
                    ],
                ],
                $gallery_media_wrapper_key => [
                    'class' => [
                        'sa-el-media__wrapper',
                        'sa-el-gallery__media-wrapper',
                    ],
                ],
            ]);

            if (empty($image))
                continue;
            ?>

            <div <?php echo $this->get_render_attribute_string('gallery-item'); ?>>

                <<?php echo $media_tag; ?> <?php echo $this->get_render_attribute_string($gallery_media_key); ?>>
                <div <?php echo $this->get_render_attribute_string($gallery_media_wrapper_key); ?>>
            <?php $this->render_image_thumbnail($image); ?>
            <?php $this->render_image_overlay(); ?>
            <?php $this->render_image_caption($item); ?>
                </div>
                </<?php echo $media_tag; ?>>

            </div>

        <?php
        }
    }

    /**
     * Render Image Thumbnail
     *
     * @since  1.1.0
     * @param  image|array 		The image information
     * @return void
     */
    protected function render_image_thumbnail($image) {
        ?><div <?php echo $this->get_render_attribute_string('gallery-thumbnail'); ?>>
        <?php echo $image['image']; ?>
        </div><?php
    }

    /**
     * Render Image Caption
     *
     * @since  1.1.0
     * @param  item|array 		The repeater item
     * @param  settings|array 	The widget settings
     * @return void
     */
    protected function render_image_caption($item) {
        ?><figcaption <?php echo $this->get_render_attribute_string('gallery-content'); ?>>
            <div <?php echo $this->get_render_attribute_string('gallery-caption'); ?>>
        <?php echo self::get_image_caption($item['id'], $this->get_settings('thumbnails_caption_type')); ?>
            </div>
        </figcaption>
        <?php
    }

    /**
     * Render Image Overlay
     *
     * @since  1.1.0
     * @return void
     */
    protected function render_image_overlay() {
        ?>
        <div <?php echo $this->get_render_attribute_string('gallery-overlay'); ?>></div>
        <?php
    }

    /**
     * Render Carousel
     *
     * @since  1.1.0
     * @return void
     */
    private function render_carousel() {

        $settings = $this->get_settings_for_display();
        $gallery = $settings['wp_gallery'];
        $slides = [];

        foreach ($gallery as $index => $item) {

            $image_url = Group_Control_Image_Size::get_attachment_image_src($item['id'], 'preview', $settings);
            $image_html = '<img class="slick-slide-image" src="' . esc_attr($image_url) . '" alt="' . esc_attr(Control_Media::get_image_alt($item)) . '" />';

            $link = self::get_link_url($item, $settings);
            $image_caption = self::get_image_caption($item['id'], $settings['caption_type']);

            $slide_key = $this->get_repeater_setting_key('slide', 'wp_gallery', $index);
            $slide_inner_key = $this->get_repeater_setting_key('slide-inner', 'wp_gallery', $index);
            $thumbnail_key = $this->get_repeater_setting_key('thumbnail', 'wp_gallery', $index);
            $slide_tag = 'div';

            $this->add_render_attribute([
                $slide_key => [
                    'class' => 'slick-slide'
                ],
                $slide_inner_key => [
                    'class' => [
                        'slick-slide-inner',
                        'sa-el-media',
                        'sa-el-carousel__media',
                    ],
                ],
                $thumbnail_key => [
                    'class' => [
                        'sa-el-media__thumbnail',
                        'sa-el-carousel__media__thumbnail',
                    ],
                ],
            ]);

            if ($link) {

                $slide_tag = 'a';

                $this->add_render_attribute($slide_key, [
                    'href' => $link['url'],
                    'class' => 'elementor-clickable',
                    'data-elementor-open-lightbox' => $settings['open_lightbox'],
                    'data-elementor-lightbox-slideshow' => $this->get_id(),
                    'data-elementor-lightbox-index' => $index,
                ]);

                if (!empty($link['is_external'])) {
                    $this->add_render_attribute($slide_key, 'target', '_blank');
                }

                if (!empty($link['nofollow'])) {
                    $this->add_render_attribute($slide_key, 'rel', 'nofollow');
                }
            }

            $slide_html = '<' . $slide_tag . ' ' . $this->get_render_attribute_string($slide_key) . '>';
            $slide_html .= '<figure ' . $this->get_render_attribute_string($slide_inner_key) . '>';
            $slide_html .= '<div ' . $this->get_render_attribute_string($thumbnail_key) . '>' . $image_html . '</div>';

            if (!empty($image_caption)) {

                $content_key = $this->get_repeater_setting_key('content', 'wp_gallery', $index);
                $caption_key = $this->get_repeater_setting_key('caption', 'wp_gallery', $index);

                $this->add_render_attribute([
                    $content_key => [
                        'class' => [
                            'sa-el-media__content',
                            'sa-el-carousel__media__content',
                        ],
                    ],
                    $caption_key => [
                        'class' => [
                            'sa-el-media__content__caption',
                            'sa-el-carousel__media__caption',
                        ],
                    ],
                ]);

                $slide_html .= '<div ' . $this->get_render_attribute_string($content_key) . '>';
                $slide_html .= '<figcaption ' . $this->get_render_attribute_string($caption_key) . '>';
                $slide_html .= $image_caption;
                $slide_html .= '</figcaption>';
                $slide_html .= '</div>';
            }

            $slide_html .= '</figure>';
            $slide_html .= '</' . $slide_tag . '>';

            $slides[] = $slide_html;
        }

        echo implode('', $slides);
    }

    public static function get_link_url($attachment, $instance) {
        if ('none' === $instance['link_to']) {
            return false;
        }

        if ('custom' === $instance['link_to']) {
            if (empty($instance['link']['url'])) {
                return false;
            }
            return $instance['link'];
        }

        return [
            'url' => wp_get_attachment_url($attachment['id']),
        ];
    }

    /**
     * Get Image Info
     * 
     * Get image information as array
     *
     * @since  1.6.0
     * @return array
     */
    public static function get_image_info($image_id, $image_url = '', $image_size = '') {

        if (!$image_id)
            return false;

        $info = [];

        if (!empty($image_id)) { // Existing attachment
            $attachment = get_post($image_id);

            if (!$attachment)
                return;

            $info['id'] = $image_id;
            $info['url'] = $image_url;
            $info['image'] = wp_get_attachment_image($attachment->ID, $image_size, true);
            $info['caption'] = $attachment->post_excerpt;
        } else { // Placeholder image, most likely
            if (empty($image_url))
                return;

            $info['id'] = false;
            $info['url'] = $image_url;
            $info['image'] = '<img src="' . $image_url . '" />';
            $info['caption'] = '';
        }

        return $info;
    }

    public static function get_image_caption($attachment, $type = 'caption') {

        if (empty($type)) {
            return '';
        }

        if (!is_a($attachment, 'WP_Post')) {
            if (is_numeric($attachment)) {
                $attachment = get_post($attachment);

                if (!$attachment)
                    return '';
            }
        }

        if ('caption' === $type) {
            return $attachment->post_excerpt;
        }

        if ('title' === $type) {
            return $attachment->post_title;
        }

        return $attachment->post_content;
    }

}
