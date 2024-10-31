<?php

namespace SA_EL_ADDONS\Elements\Audio_Player;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

class Audio_Player extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_audio_player';
    }

    public function get_title() {
        return esc_html__('Audio Player', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-play  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
                'section_title',
                [
                    'label' => __('Audio', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );


        $this->add_control(
                'source_type',
                [
                    'label' => esc_html__('Source Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'hosted_url',
                    'options' => [
                        'hosted_url' => esc_html__('Local Audio', SA_EL_ADDONS_TEXTDOMAIN),
                        'remote_url' => esc_html__('Remote Audio', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'hosted_url',
                [
                    'label' => __('Local Audio', 'elementor'),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => [
                        'active' => true,
                        'categories' => [
                            TagsModule::POST_META_CATEGORY,
                            TagsModule::MEDIA_CATEGORY,
                        ],
                    ],
                    'media_type' => 'audio',
                    'default' => [
                        'url' => 'https://www.sa-elementor-addons.com/wp-content/uploads/2019/12/O_Saki_Saki-Batla_House_FusionBD.Com_.mp3',
                    ],
                    'condition' => [
                        'source_type' => 'hosted_url'
                    ]
                ]
        );


        $this->add_control(
                'remote_url',
                [
                    'label' => esc_html__('Remote URL', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => 'If you want to add any streaming audio url so please add <b>;stream/1</b> at the end of your url for example: http://cast.com:9942/;stream/1',
                    'type' => Controls_Manager::URL,
                    'show_external' => false,
                    'default' => [
                        'url' => 'https://www.sa-elementor-addons.com/wp-content/uploads/2019/12/O_Saki_Saki-Batla_House_FusionBD.Com_.mp3',
                    ],
                    'placeholder' => 'https://example.com/music.mp3',
                    'dynamic' => [
                        'active' => true,
                        'categories' => [
                            TagsModule::POST_META_CATEGORY,
                            TagsModule::MEDIA_CATEGORY,
                        ],
                    ],
                    'condition' => [
                        'source_type' => 'remote_url'
                    ]
                ]
        );


        $this->add_control(
                'audio_title',
                [
                    'label' => esc_html__('Audio Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'tooltip',
                    'options' => [
                        'tooltip' => esc_html__('Tooltip', SA_EL_ADDONS_TEXTDOMAIN),
                        'inline' => esc_html__('Inline', SA_EL_ADDONS_TEXTDOMAIN),
                        'none' => esc_html__('None', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'prefix_class' => 'sa-el-audio-player-title-',
                    'render_type' => 'template',
                ]
        );

        $this->add_control(
                'title',
                [
                    'label' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Audio Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_block' => true,
                    'dynamic' => ['active' => true],
                ]
        );


        $this->add_responsive_control(
                'player_width',
                [
                    'label' => esc_html__('Player Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 40,
                            'max' => 1200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-widget-container' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'fixed_player!' => 'yes'
                    ],
                ]
        );

        $this->add_responsive_control(
                'player_align',
                [
                    'label' => esc_html__('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'left',
                    'prefix_class' => 'elementor%s-align-',
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'condition' => [
                        'player_width!' => '',
                        'fixed_player!' => 'yes'
                    ],
                ]
        );

        $this->add_control(
                'fixed_player',
                [
                    'label' => __('Fixed Player', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'prefix_class' => 'sa-el-audio-player-fixed-',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_content_additional',
                [
                    'label' => __('Additional', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'seek_bar',
                [
                    'label' => __('Seek Bar', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'time_duration',
                [
                    'label' => esc_html__('Time/Duration(s)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'both',
                    'options' => [
                        '' => esc_html__('None', SA_EL_ADDONS_TEXTDOMAIN),
                        'time' => esc_html__('Time', SA_EL_ADDONS_TEXTDOMAIN),
                        'duration' => esc_html__('Duration', SA_EL_ADDONS_TEXTDOMAIN),
                        'both' => esc_html__('Both', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'time_restrict',
                [
                    'label' => __('Restrict Time', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('After some second player will stop', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'restrict_duration',
                [
                    'label' => esc_html__('Restrict Duration(s)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'step' => 2,
                            'max' => 200
                        ]
                    ],
                    'default' => [
                        'size' => 10
                    ],
                    'condition' => [
                        'time_restrict' => 'yes'
                    ]
                ]
        );

        $this->add_control(
                'volume_mute',
                [
                    'label' => __('Volume Mute/Unmute', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'volume_bar',
                [
                    'label' => __('Volume Bar', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'smooth_show',
                [
                    'label' => __('Smoothly Enter', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'keyboard_enable',
                [
                    'label' => __('Keyboard Enable', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('for example: when you press p=Play, m=Mute, >=Volume + <=Volume -, l=Loop etc  ', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'autoplay',
                [
                    'label' => __('Auto Play', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Some latest browser does not support this feature for not annoying user.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                ]
        );

        $this->add_control(
                'loop',
                [
                    'label' => __('Loop', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('If you set yes so your music will automatically repeat again and again.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                ]
        );

        $this->add_control(
                'volume_level',
                [
                    'label' => esc_html__('Default Volume', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1,
                            'step' => 0.1,
                        ],
                    ],
                    'default' => [
                        'size' => 0.8,
                    ],
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();

        $this->start_controls_section(
                'section_style_play_button',
                [
                    'label' => __('Play/Pause Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs('tabs_play_button');

        $this->start_controls_tab(
                'tab_play_button_normal',
                [
                    'label' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'play_button_icon_color',
                [
                    'label' => __('Icon Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-play svg, {{WRAPPER}} .jp-audio .jp-pause svg' => 'fill: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'play_button_background',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-play, {{WRAPPER}} .jp-audio .jp-pause' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'play_button_border',
                [
                    'label' => esc_html__('Border Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'solid',
                    'options' => [
                        '' => esc_html__('None', SA_EL_ADDONS_TEXTDOMAIN),
                        'solid' => esc_html__('Solid', SA_EL_ADDONS_TEXTDOMAIN),
                        'dotted' => esc_html__('Dotted', SA_EL_ADDONS_TEXTDOMAIN),
                        'dashed' => esc_html__('Dashed', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-play, {{WRAPPER}} .jp-audio .jp-pause' => 'border-style: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'play_button_border_width',
                [
                    'label' => __('Border Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'default' => [
                        'top' => '1',
                        'bottom' => '1',
                        'left' => '1',
                        'right' => '1',
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-play, {{WRAPPER}} .jp-audio .jp-pause' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'play_button_border!' => '',
                    ],
                ]
        );

        $this->add_control(
                'play_button_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#d5d5d5',
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-play, {{WRAPPER}} .jp-audio .jp-pause' => 'border-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'play_button_border!' => '',
                    ],
                ]
        );

        $this->add_responsive_control(
                'play_button_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-play, {{WRAPPER}} .jp-audio .jp-pause' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'play_button_shadow',
                    'selector' => '{{WRAPPER}} .jp-audio .jp-play, {{WRAPPER}} .jp-audio .jp-pause',
                ]
        );

        $this->add_responsive_control(
                'play_button_size',
                [
                    'label' => esc_html__('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 30,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-play, {{WRAPPER}} .jp-audio .jp-pause' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};line-height: calc({{SIZE}}{{UNIT}} - 4px);',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_play_button_hover',
                [
                    'label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'play_button_hover_icon_color',
                [
                    'label' => __('Icon Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-play:hover svg, {{WRAPPER}} .jp-audio .jp-pause:hover svg' => 'fill: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'play_button_hover_background',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-play:hover, {{WRAPPER}} .jp-audio .jp-pause:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'play_button_hover_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'play_button_border_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-play:hover, {{WRAPPER}} .jp-audio .jp-pause:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'play_button_hover_shadow',
                    'selector' => '{{WRAPPER}} .jp-audio .jp-play:hover, {{WRAPPER}} .jp-audio .jp-pause:hover',
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_time',
                [
                    'label' => __('Time/Duration', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'time_duration!' => '',
                    ],
                ]
        );

        $this->add_control(
                'time_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-current-time, {{WRAPPER}} .jp-audio .jp-duration' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'time_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .jp-audio .jp-current-time, {{WRAPPER}} .jp-audio .jp-duration',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_seek_bar',
                [
                    'label' => __('Seek Bar', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'seek_bar' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'seek_bar_height',
                [
                    'label' => __('Bar Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-seek-bar' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'seek_bar_color',
                [
                    'label' => __('Bar Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-seek-bar' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'seek_bar_adjust_color',
                [
                    'label' => __('Active Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-seek-bar .jp-play-bar' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'seek_bar_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-seek-bar .jp-play-bar, {{WRAPPER}} .jp-audio .jp-seek-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_audio_title',
                [
                    'label' => __('Audio Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'audio_title' => 'inline',
                        '_skin' => '',
                    ]
                ]
        );

        $this->add_control(
                'audio_title_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-audio-title' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'audio_title_align',
                [
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
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-audio-title' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'audio_title_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .sa-el-audio-title'
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_volume_button',
                [
                    'label' => __('Volume Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'volume_mute' => 'yes',
                    ],
                ]
        );

        $this->start_controls_tabs('tabs_volume_button');

        $this->start_controls_tab(
                'tab_volume_button_normal',
                [
                    'label' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'volume_button_icon_color',
                [
                    'label' => __('Icon Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-mute svg, {{WRAPPER}} .jp-audio .jp-unmute svg' => 'fill: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'volume_button_background',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-mute, {{WRAPPER}} .jp-audio .jp-unmute' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'volume_button_border',
                [
                    'label' => esc_html__('Border Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'solid',
                    'options' => [
                        '' => esc_html__('None', SA_EL_ADDONS_TEXTDOMAIN),
                        'solid' => esc_html__('Solid', SA_EL_ADDONS_TEXTDOMAIN),
                        'dotted' => esc_html__('Dotted', SA_EL_ADDONS_TEXTDOMAIN),
                        'dashed' => esc_html__('Dashed', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-mute, {{WRAPPER}} .jp-audio .jp-unmute' => 'border-style: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'volume_button_border_width',
                [
                    'label' => __('Border Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'default' => [
                        'top' => '1',
                        'bottom' => '1',
                        'left' => '1',
                        'right' => '1',
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-mute, {{WRAPPER}} .jp-audio .jp-unmute' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'volume_button_border!' => '',
                    ],
                ]
        );

        $this->add_control(
                'volume_button_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#d5d5d5',
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-mute, {{WRAPPER}} .jp-audio .jp-unmute' => 'border-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'volume_button_border!' => '',
                    ],
                ]
        );

        $this->add_responsive_control(
                'volume_button_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-mute, {{WRAPPER}} .jp-audio .jp-unmute' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'volume_button_shadow',
                    'selector' => '{{WRAPPER}} .jp-audio .jp-mute, {{WRAPPER}} .jp-audio .jp-unmute',
                ]
        );

        $this->add_responsive_control(
                'volume_button_size',
                [
                    'label' => esc_html__('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 30,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-mute, {{WRAPPER}} .jp-audio .jp-unmute' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};line-height: calc({{SIZE}}{{UNIT}} - 4px);',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_volume_button_hover',
                [
                    'label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'volume_button_hover_icon_color',
                [
                    'label' => __('Icon Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-mute:hover svg, {{WRAPPER}} .jp-audio .jp-unmute:hover svg' => 'fill: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'volume_button_hover_background',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-mute:hover, {{WRAPPER}} .jp-audio .jp-unmute:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'volume_button_hover_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'volume_button_border_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-mute:hover, {{WRAPPER}} .jp-audio .jp-unmute:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'volume_button_hover_shadow',
                    'selector' => '{{WRAPPER}} .jp-audio .jp-mute:hover, {{WRAPPER}} .jp-audio .jp-unmute:hover',
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_volume_bar',
                [
                    'label' => __('Volume Bar', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'volume_bar' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'volume_bar_height',
                [
                    'label' => __('Bar Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-volume-bar' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'volume_bar_color',
                [
                    'label' => __('Bar Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-volume-bar' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'volume_bar_adjust_color',
                [
                    'label' => __('Active Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .jp-audio .jp-volume-bar .jp-volume-bar-value' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    public function render_audio_header() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();

        $this->add_render_attribute('audio-player', 'class', 'jp-jplayer');

        $this->add_render_attribute(
                [
                    'audio-player' => [
                        'data-settings' => [
                            wp_json_encode(array_filter([
                                'audio_title' => $settings['title'],
                                'volume_level' => $settings['volume_level']['size'],
                                'keyboard_enable' => ('yes' == $settings['keyboard_enable']) ? true : false,
                                'smooth_show' => ('yes' == $settings['smooth_show']) ? true : false,
                                'time_restrict' => ('yes' == $settings['time_restrict']) ? true : false,
                                'restrict_duration' => $settings['restrict_duration']['size'],
                                'autoplay' => ('yes' == $settings['autoplay']) ? true : false,
                                'loop' => ('yes' == $settings['loop']) ? true : false,
                                'audio_source' => ('remote_url' == $settings['source_type']) ? $settings['remote_url']['url'] : $settings['hosted_url']['url'],
                            ]))
                        ]
                    ]
                ]
        );
        ?>
        <div <?php echo $this->get_render_attribute_string('audio-player'); ?>></div>

        <?php
    }

    public function render_audio_default() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        ?>
        <div id="jp_container_<?php echo esc_attr($id); ?>" class="jp-audio" role="application" aria-label="media player">
            <div class="jp-type-playlist">
                <div class="jp-gui jp-interface">
                    <div class="jp-controls sa-el-grid sa-el-grid-small sa-el-flex-middle" sa-el-grid>

                        <?php $this->render_play_button(); ?>

                        <?php $this->render_current_time(); ?>

                        <?php $this->render_seek_bar(); ?>

                        <?php $this->render_time_duration(); ?>

                        <?php $this->render_mute_button(); ?>

                        <?php $this->render_volume_bar(); ?>

                    </div>

                </div>

            </div>
        </div>

        <?php
    }

    public function render_play_button() {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="sa-el-width-auto" >
            <a href="javaScript:Void(0);" class="jp-play" tabindex="1" title="<?php esc_html_e('Play', SA_EL_ADDONS_TEXTDOMAIN); ?> <?php echo $settings['title']; ?>">
                <?php echo '<i class="fas fa-play"></i>'; ?>
            </a>
            <a href="javaScript:Void(0);" class="jp-pause" tabindex="1" title="<?php esc_html_e('Pause', SA_EL_ADDONS_TEXTDOMAIN); ?> <?php echo $settings['title']; ?>">
                <?php echo '<i class="fas fa-pause-circle"></i>'; ?>

            </a>
        </div>

        <?php
    }

    public function render_seek_bar() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('progress', 'title', $settings['title']);

        if ('tooltip' == $settings['audio_title']) {
            $this->add_render_attribute('progress', 'sa-el-tooltip');
        }
        ?>

        <?php if ('yes' === $settings['seek_bar']) : ?>
            <div class="sa-el-width-expand">
                <div class="jp-progress" <?php echo $this->get_render_attribute_string('progress'); ?>>
                    <?php if ('inline' === $settings['audio_title']) : ?>
                        <div class="sa-el-audio-title"><?php echo esc_html($settings['title']); ?></div>
                    <?php endif; ?>
                    <div class="jp-seek-bar">
                        <div class="jp-play-bar"></div>
                    </div>
                </div>
            </div>
            <?php
        endif;
    }

    public function render_current_time() {
        $settings = $this->get_settings_for_display();
        ?>

        <?php if ('time' === $settings['time_duration'] or 'both' === $settings['time_duration']) : ?>
            <div class="sa-el-width-auto"><div class="jp-current-time"></div></div>
            <?php
        endif;
    }

    public function render_time_duration() {
        $settings = $this->get_settings_for_display();
        ?>

        <?php if ('duration' === $settings['time_duration'] or 'both' === $settings['time_duration']) : ?>
            <div class="sa-el-width-auto sa-el-visible-m"><div class="jp-duration"></div></div>
            <?php
        endif;
    }

    public function render_mute_button() {
        $settings = $this->get_settings_for_display();
        ?>

        <?php if ('yes' === $settings['volume_mute']) : ?>
            <div class="sa-el-width-auto sa-el-audio-player-mute">
                <a href="javaScript:Void(0);" class="jp-mute" tabindex="1" title="<?php esc_html_e('Mute', SA_EL_ADDONS_TEXTDOMAIN); ?>">
                    <?php echo '<i class="fas fa-volume-up"></i>'; ?>
                </a>
                <a href="javaScript:Void(0);" class="jp-unmute" tabindex="1" title="<?php esc_html_e('Unmute', SA_EL_ADDONS_TEXTDOMAIN); ?>">
                    <?php echo '<i class="fas fa-volume-mute"></i>'; ?>
                </a>
            </div>
            <?php
        endif;
    }

    public function render_volume_bar() {
        $settings = $this->get_settings_for_display();
        ?>

        <?php if ('yes' === $settings['volume_bar']) : ?>
            <div class="sa-el-width-auto sa-el-visible-m">
                <div class="jp-volume-bar">
                    <div class="jp-volume-bar-value"></div>
                </div>
            </div>
            <?php
        endif;
    }

    protected function render() {
        $id = $this->get_id();
        ?>
        <div class="sa-el-audio-player">
            <?php $this->render_audio_header(); ?>
            <?php $this->render_audio_default(); ?>
        </div>		
        <?php
    }

}
