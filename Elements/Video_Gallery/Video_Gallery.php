<?php

namespace SA_EL_ADDONS\Elements\Video_Gallery;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Interactive Card
 *
 * @author biplop
 * 
 */
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;

class Video_Gallery extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_video_gallery';
    }

    public function get_title() {
        return esc_html__('Video Gallery', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-slider-video oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    public function _register_controls() {

        $this->start_controls_section(
                'section_custom_gallery_content',
                [
                    'label' => esc_html__('Video Gallery', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'thumb_layout',
                [
                    'label' => esc_html__('Thumb Layout', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'vertical',
                    'options' => [
                        'vertical' => esc_html__('Vertical', SA_EL_ADDONS_TEXTDOMAIN),
                        'horizontal' => esc_html__('Horizontal', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('tabs_content_video_gallery');

        $repeater->start_controls_tab(
                'tab_video_gallery_source',
                [
                    'label' => esc_html__('Source', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $repeater->add_control(
                'source_type',
                [
                    'label' => esc_html__('Video Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'remote_url',
                    'label_block' => true,
                    'options' => [
                        'remote_url' => esc_html__('Remote Video', SA_EL_ADDONS_TEXTDOMAIN),
                        'hosted_url' => esc_html__('Local Video', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $repeater->add_control(
                'remote_url',
                [
                    'type' => Controls_Manager::URL,
                    'label' => __('Video Source', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_block' => true,
                    'show_external' => false,
                    'placeholder' => __('https://www.youtube.com/watch?v=vN9DnFiRMX0&feature=youtu.be', SA_EL_ADDONS_TEXTDOMAIN),
                    'dynamic' => ['active' => true],
                    'default' => [
                        'url' => __('https://www.youtube.com/watch?v=vN9DnFiRMX0&feature=youtu.be', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'condition' => [
                        'source_type' => 'remote_url',
                    ],
                ]
        );

        $repeater->add_control(
                'hosted_url',
                [
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => [
                        'active' => true,
                        'categories' => [
                            'post_meta',
                            'media',
                        ],
                    ],
                    'media_type' => 'video',
                    'condition' => [
                        'source_type' => 'hosted_url'
                    ],
                ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
                'tab_video_gallery_desc',
                [
                    'label' => esc_html__('Description', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $repeater->add_control(
                'title',
                [
                    'label' => esc_html__('Title and Description', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_block' => true,
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => ['active' => true],
                    'default' => esc_html__('Video Title', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $repeater->add_control(
                'desc',
                [
                    'type' => Controls_Manager::TEXTAREA,
                    'dynamic' => ['active' => true],
                    'default' => esc_html__('Women typing keyboard', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
                'tab_video_gallery_poster',
                [
                    'label' => esc_html__('Poster', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $repeater->add_control(
                'poster',
                [
                    'label' => esc_html__('Poster', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => ['active' => true],
                ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
                'video_gallery',
                [
                    'type' => Controls_Manager::REPEATER,
                    'fields' => array_values($repeater->get_controls()),
                    'default' => [
                        [
                            'title' => esc_html__('Youtube Video', SA_EL_ADDONS_TEXTDOMAIN),
                            'desc' => esc_html__('Elementor Addons Video', SA_EL_ADDONS_TEXTDOMAIN),
                            'remote_url' => ['url' => 'https://youtu.be/3M6jrL_Ytes'],
                        ],
                        [
                            'title' => esc_html__('Vimeo Video', SA_EL_ADDONS_TEXTDOMAIN),
                            'desc' => esc_html__('Elementor Addons Video', SA_EL_ADDONS_TEXTDOMAIN),
                            'remote_url' => ['url' => 'https://player.vimeo.com/video/372538261'],
                        ],
                        [
                            'title' => esc_html__('Wista Video', SA_EL_ADDONS_TEXTDOMAIN),
                            'desc' => esc_html__('Brendan - Make It Clap', SA_EL_ADDONS_TEXTDOMAIN),
                            'remote_url' => ['url' => 'https://home.wistia.com/medias/e4a27b971d'],
                        ],
                        [
                            'title' => esc_html__('Dailymotion Video', SA_EL_ADDONS_TEXTDOMAIN),
                            'desc' => esc_html__('Drama B - DREAMS', SA_EL_ADDONS_TEXTDOMAIN),
                            'remote_url' => ['url' => 'https://www.dailymotion.com/video/x7oi21e?playlist=x5v2j4'],
                        ],
                        [
                            'title' => esc_html__('MP4 Format Video', SA_EL_ADDONS_TEXTDOMAIN),
                            'desc' => esc_html__('Elementor Addons Demo', SA_EL_ADDONS_TEXTDOMAIN),
                            'remote_url' => ['url' => 'https://www.sa-elementor-addons.com/wp-content/uploads/2019/11/SampleVideo_1280x720_2mb.mp4'],
                        ],
                        [
                            'title' => esc_html__('WEBM Format Video', SA_EL_ADDONS_TEXTDOMAIN),
                            'desc' => esc_html__('Fish Frenzy - Oceans Clip', SA_EL_ADDONS_TEXTDOMAIN),
                            'remote_url' => ['url' => 'https://s3.amazonaws.com/fooplugins/rvs/oceans-clip.webm'],
                        ],
                        [
                            'title' => esc_html__('OGV Format Video', SA_EL_ADDONS_TEXTDOMAIN),
                            'desc' => esc_html__('Fish Frenzy - Oceans Clip', SA_EL_ADDONS_TEXTDOMAIN),
                            'remote_url' => ['url' => 'https://s3.amazonaws.com/fooplugins/rvs/oceans-clip.ogv'],
                        ],
                    ],
                    'title_field' => '{{{ title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_content_video',
                [
                    'label' => esc_html__('Video', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'show_video_title',
                [
                    'label' => esc_html__('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'show_video_desc',
                [
                    'label' => esc_html__('Description', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_content_thumbnail',
                [
                    'label' => esc_html__('Thumbnail', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'show_thumbnail_thumb',
                [
                    'label' => esc_html__('Thumbnail', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'prefix_class' => 'sa-el-video-gallery-thumbnail-',
                ]
        );

        $this->add_control(
                'show_thumbnail_title',
                [
                    'label' => esc_html__('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'prefix_class' => 'sa-el-video-gallery-title-',
                ]
        );

        $this->add_control(
                'show_thumbnail_desc',
                [
                    'label' => esc_html__('Description', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'prefix_class' => 'sa-el-video-gallery-desc-',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_content_additional',
                [
                    'label' => esc_html__('Additional', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'show_play_btn_on_hover',
                [
                    'label' => esc_html__('Play Button on Hover', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                ]
        );


        $this->add_control(
                'continuous_play',
                [
                    'label' => esc_html__('Play when Navigate', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_video_title',
                [
                    'label' => esc_html__('Video Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_video_title' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'video_title_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-item-text h2' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'video_title_text_shadow',
                    'selector' => '{{WRAPPER}} .rvs-item-text h2',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'video_title_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .rvs-item-text h2',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_video_desc',
                [
                    'label' => esc_html__('Video Description', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_video_desc' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'video_desc_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-vg-video-desc' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_responsive_control(
                'video_desc_space',
                [
                    'label' => __('Space', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 0,
                            'min' => 200,
                            'step' => 2
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-vg-video-desc' => 'margin-top: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'video_desc_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-vg-video-desc',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_thumb_item',
                [
                    'label' => __('Thumb Item', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs('tabs_thumb_item_style');

        $this->start_controls_tab(
                'tab_thumb_item_normal',
                [
                    'label' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control(
                'thumb_item_bg',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'thumb_item_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'thumb_item_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'thumb_item_border',
                    'separator' => 'before',
                    'selector' => '{{WRAPPER}} .rvs-nav-item',
                    'separator' => 'before',
                ]
        );

        $this->add_responsive_control(
                'thumb_item_radius',
                [
                    'label' => __('Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'thumb_item_shadow',
                    'selector' => '{{WRAPPER}} .rvs-nav-item span',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_thumb_item_hover',
                [
                    'label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control(
                'thumb_item_hover_bg',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'thumb_item_hover_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item:hover' => 'border-color: {{VALUE}} !important;',
                    ]
                ]
        );

        $this->add_responsive_control(
                'thumb_item_hover_radius',
                [
                    'label' => __('Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'thumb_item_hover_shadow',
                    'selector' => '{{WRAPPER}} .rvs-nav-item:hover',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_thumb_item_active',
                [
                    'label' => __('Active', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control(
                'thumb_item_active_bg',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item.rvs-active' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'thumb_item_active_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item.rvs-active' => 'border-color: {{VALUE}} !important;',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_thumbnail',
                [
                    'label' => __('Thumbnail', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_thumbnail_thumb' => 'yes',
                    ],
                ]
        );

        $this->add_responsive_control(
                'thumb_width',
                [
                    'label' => __('Width (px)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item span' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'thumbnail_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'thumbnail_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->start_controls_tabs('thumbnail_effects');

        $this->start_controls_tab('normal',
                [
                    'label' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'opacity',
                [
                    'label' => __('Opacity', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 1,
                            'min' => 0.10,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item span' => 'opacity: {{SIZE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Css_Filter::get_type(),
                [
                    'name' => 'css_filters',
                    'separator' => 'before',
                    'selector' => '{{WRAPPER}} .rvs-nav-item span',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('hover',
                [
                    'label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'opacity_hover',
                [
                    'label' => __('Opacity', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 1,
                            'min' => 0.10,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item span:hover' => 'opacity: {{SIZE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Css_Filter::get_type(),
                [
                    'name' => 'css_filters_hover',
                    'selector' => '{{WRAPPER}} .rvs-nav-item span:hover',
                ]
        );

        $this->add_control(
                'background_hover_transition',
                [
                    'label' => __('Transition Duration (s)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 3,
                            'step' => 0.1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item span' => 'transition-duration: {{SIZE}}s',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'thumbnail_border',
                    'separator' => 'before',
                    'selector' => '{{WRAPPER}} .rvs-nav-item span',
                    'separator' => 'before',
                ]
        );

        $this->add_responsive_control(
                'thumbnail_radius',
                [
                    'label' => __('Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'thumbnail_shadow',
                    'selector' => '{{WRAPPER}} .rvs-nav-item span',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_thumbnail_title',
                [
                    'label' => esc_html__('Thumbnail Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_thumbnail_title' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'thumbnail_title_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item-title' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'thumbnail_title_hover_color',
                [
                    'label' => esc_html__('Text Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item-title:hover' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'thumbnail_title_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .rvs-nav-item-title',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_thumbnail_desc',
                [
                    'label' => esc_html__('Thumbnail Description', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_thumbnail_desc' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'thumbnail_desc_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item-credits' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'thumbnail_desc_hover_color',
                [
                    'label' => esc_html__('Text Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item-credits:hover' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'thumbnail_desc_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .rvs-nav-item-credits',
                ]
        );

        $this->add_responsive_control(
                'thumbnail_desc_space',
                [
                    'label' => __('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-nav-item-credits' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_play_button',
                [
                    'label' => __('Play/Pause Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs('tabs_play_button');

        $this->start_controls_tab(
                'tab_play_btn_normal',
                [
                    'label' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'play_btn_icon_color',
                [
                    'label' => __('Icon Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-play-video' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'play_btn_bg',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-play-video' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'play_btn_size',
                [
                    'label' => __('Size (px)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 20,
                            'max' => 200,
                            'step' => 2
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rvs-container a.rvs-play-video' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'play_btn_border',
                    'separator' => 'before',
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .rvs-play-video'
                ]
        );

        $this->add_responsive_control(
                'play_btn_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .rvs-play-video' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'play_btn_shadow',
                    'selector' => '{{WRAPPER}} .rvs-play-video',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_play_btn_hover',
                [
                    'label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'play_btn_hover_icon_color',
                [
                    'label' => __('Icon Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-play-video:hover' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'play_btn_hover_bg',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rvs-play-video:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'play_btn_hover_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'play_btn_border_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rvs-play-video:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'play_btn_hover_shadow',
                    'selector' => '{{WRAPPER}} .rvs-play-video:hover',
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    public function render() {
        $settings = $this->get_settings();

        $this->render_header();

        foreach ($settings['video_gallery'] as $video) :

            $video_poster = ( $video['poster']['url'] ) ? $video['poster']['url'] : 'https://www.sa-elementor-addons.com/wp-content/uploads/2019/12/placeholder-img.jpg';
            $video_source = $video['remote_url']['url'];

            if ('hosted_url' == $video['source_type']) {
                $video_source = $video['hosted_url']['url'];
            } else {
                $youtube_id = (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video['remote_url']['url'], $match) ) ? $match[1] : false;

                $vimeo_id = ( preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $video['remote_url']['url'], $match) ) ? $match[3] : false;

                if ($youtube_id) {
                    $video_source = 'https://www.youtube.com/watch?v=' . $youtube_id;
                    $video_poster = ( $video['poster']['url'] ) ? $video['poster']['url'] : 'https://img.youtube.com/vi/' . $youtube_id . '/maxresdefault.jpg';
                } elseif ($vimeo_id) {
                    $video_source = 'https://vimeo.com/' . $vimeo_id;
                    $video_poster = ( $video['poster']['url'] ) ? $video['poster']['url'] : 'https://i.vimeocdn.com/video/' . $vimeo_id . '.webp?mw=960&mh=540';
                }
            }
            ?>
            <!-- items go here -->
            <div class="rvs-item" style="background-image: url(<?php echo esc_url($video_poster); ?>)">

                <?php if ($settings['show_video_title'] or $settings['show_video_desc']) : ?>
                    <div class="rvs-item-text">

                        <?php if ($settings['show_video_title']) : ?>
                            <h2 class="sa-el-vg-video-title"><?php echo esc_html($video['title']); ?></h2>
                        <?php endif; ?>

                        <?php if ($settings['show_video_desc']) : ?>
                            <div class="sa-el-vg-video-desc"><?php echo wp_kses_post($video['desc']); ?></div>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

                <a href="<?php echo esc_url($video_source); ?>" class="rvs-play-video"></a>
            </div>

        <?php endforeach; ?>


        </div>
        </div>

        <?php if ('yes' == $settings['show_thumbnail_thumb'] or 'yes' == $settings['show_thumbnail_title'] or 'yes' == $settings['show_thumbnail_desc']) : ?>
            <div class="rvs-nav-container">
                <a class="rvs-nav-prev"></a>
                <div class="rvs-nav-stage">

                    <?php
                    foreach ($settings['video_gallery'] as $video) :

                        $video_thumbnail = ( $video['poster']['url'] ) ? $video['poster']['url'] : 'https://www.sa-elementor-addons.com/wp-content/uploads/2019/12/placeholder-img.jpg';

                        $youtube_id = (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video['remote_url']['url'], $match) ) ? $match[1] : false;

                        $vimeo_id = ( preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $video['remote_url']['url'], $match) ) ? $match[3] : false;

                        if ($youtube_id) {
                            $video_thumbnail = ( $video['poster']['url'] ) ? $video['poster']['url'] : 'https://img.youtube.com/vi/' . $youtube_id . '/default.jpg';
                        } elseif ($vimeo_id) {
                            $video_thumbnail = ( $video['poster']['url'] ) ? $video['poster']['url'] : 'https://i.vimeocdn.com/video/' . $vimeo_id . '.webp?mw=60&mh=60';
                        }
                        ?>
                        <!-- nav items go here -->
                        <a class="rvs-nav-item">

                            <?php if ('yes' == $settings['show_thumbnail_thumb']) : ?>
                                <span class="rvs-nav-item-thumb" style="background-image: url(<?php echo esc_url($video_thumbnail); ?>)"></span>
                            <?php endif; ?>

                            <?php if ('yes' == $settings['show_thumbnail_title']) : ?>
                                <h4 class="rvs-nav-item-title" title="<?php echo esc_html($video['title']); ?>"><?php echo esc_html($video['title']); ?></h4>
                            <?php endif; ?>

                            <?php if ('yes' == $settings['show_thumbnail_desc']) : ?>
                                <div class="rvs-nav-item-credits" title="<?php echo wp_kses_post($video['desc']); ?>"><?php echo wp_kses_post($video['desc']); ?></div>
                            <?php endif; ?>
                        </a>

                    <?php endforeach; ?>

                    <?php
                endif;

                $this->render_footer();
            }

            public function render_header($skin = 'default') {
                $settings = $this->get_settings_for_display();
                $id = $this->get_id();

                $this->add_render_attribute('video-gallery', 'class', ['sa-el-video-gallery', 'rvs-container', 'rvs-flat-circle-play']);

                if ('horizontal' == $settings['thumb_layout']) {
                    $this->add_render_attribute('video-gallery', 'class', 'rvs-horizontal');
                }

                if ($settings['show_play_btn_on_hover']) {
                    $this->add_render_attribute('video-gallery', 'class', 'rvs-show-play-on-hover');
                }

                if ($settings['continuous_play']) {
                    $this->add_render_attribute('video-gallery', 'class', 'rvs-continuous-play');
                }

                if ('yes' !== $settings['show_thumbnail_desc']) {
                    $this->add_render_attribute('video-gallery', 'class', 'rvs-hide-credits');
                }
                ?>
                <div <?php echo $this->get_render_attribute_string('video-gallery'); ?>>
                    <div class="rvs-item-container">
                        <div class="rvs-item-stage">
                            <?php
                        }

                        public function render_footer() {
                            $settings = $this->get_settings();
                            ?>
                        </div>
                        <a class="rvs-nav-next"></a>
                    </div>
                </div>
                <?php
            }

        }
        