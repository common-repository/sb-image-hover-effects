<?php

namespace SA_EL_ADDONS\Elements\Video_Box;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Embed;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

class Video_Box extends Widget_Base
{

    use \SA_EL_ADDONS\Helper\Elementor_Helper;
    
    public function get_name()
    {
        return 'sa_el_video_box';
    }

    public function get_title()
    {
        return esc_html__('Video Box', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-video-camera oxi-el-admin-icon';
    }

    public function get_categories()
    {
        return ['sa-el-addons'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'sa_el_video_box_general_settings',
            [
                'label'         => __('Video Box', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'sa_el_video_box_video_type',
            [
                'label'         => __('Video Type', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'youtube',
                'options'       => [
                    'youtube'       => __('Youtube', SA_EL_ADDONS_TEXTDOMAIN),
                    'vimeo'         => __('Vimeo', SA_EL_ADDONS_TEXTDOMAIN),
                    'self'          => __('Self Hosted', SA_EL_ADDONS_TEXTDOMAIN),
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_video_id_embed_selection',
            [
                'label'         => __('Link', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::HIDDEN,
                'default'       => 'id',
                'options'       => [
                    'id'    => __('ID', SA_EL_ADDONS_TEXTDOMAIN),
                    'embed' => __('Embed URL', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'condition'     => [
                    'sa_el_video_box_video_type!' => 'self',
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_video_id',
            [
                'label'         => __('Video ID', SA_EL_ADDONS_TEXTDOMAIN),
                'description'   => __('Enter the numbers and letters after the equal sign which located in your YouTube video link or after the slash sign in your Vimeo video link. For example, z1hQgVpfTKU', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::HIDDEN,
                'dynamic'       => ['active' => true],
                'condition'     => [
                    'sa_el_video_box_video_type!' => 'self',
                    'sa_el_video_box_video_id_embed_selection' => 'id',
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_video_embed',
            [
                'label'         => __('Embed URL', SA_EL_ADDONS_TEXTDOMAIN),
                'description'   => __('Enter your YouTube/Vimeo video link. For example, https://www.youtube.com/embed/z1hQgVpfTKU', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::HIDDEN,
                'dynamic'       => ['active' => true],
                'condition'     => [
                    'sa_el_video_box_video_type!' => 'self',
                    'sa_el_video_box_video_id_embed_selection' => 'embed',
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_link',
            [
                'label'         => __('Link', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => 'https://youtu.be/3M6jrL_Ytes',
                'dynamic'       => [
                    'active' => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY
                    ]
                ],
                'condition'     => [
                    'sa_el_video_box_video_type!' => 'self',
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_self_hosted',
            [
                'label'         => __('URL', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::MEDIA,
                'dynamic'       => [
                    'active' => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY,
                    ],
                ],
                'media_type' => 'video',
                'condition'     => [
                    'sa_el_video_box_video_type' => 'self',
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_self_hosted_remote',
            [
                'label'         => __('Remote Video URL', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [
                    'active' => true,
                ],
                'label_block'   => true,
                'condition'     => [
                    'sa_el_video_box_video_type' => 'self',
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_controls',
            [
                'label'         => __('Player Controls', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Show/hide player controls', SA_EL_ADDONS_TEXTDOMAIN),
                'default'       => 'yes'
            ]
        );

        $this->add_control(
            'sa_el_video_box_mute',
            [
                'label'         => __('Mute', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This will play the video muted', SA_EL_ADDONS_TEXTDOMAIN)
            ]
        );

        $this->add_control(
            'sa_el_video_box_self_autoplay',
            [
                'label'         => __('Autoplay', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'condition'   => [
                    'sa_el_video_box_video_type' => 'self'
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_loop',
            [
                'label'         => __('Loop', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'sa_el_video_box_start',
            [
                'label'       => __('Start Time', SA_EL_ADDONS_TEXTDOMAIN),
                'type'        => Controls_Manager::NUMBER,
                'description' => __('Specify a start time (in seconds)', SA_EL_ADDONS_TEXTDOMAIN),
                'condition'   => [
                    'sa_el_video_box_video_type!' => 'vimeo'
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_end',
            [
                'label'       => __('End Time', SA_EL_ADDONS_TEXTDOMAIN),
                'type'        => Controls_Manager::NUMBER,
                'description' => __('Specify an end time (in seconds)', SA_EL_ADDONS_TEXTDOMAIN),
                'condition'   => [
                    'sa_el_video_box_video_type!' => 'vimeo'
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_suggested_videos',
            [
                'label'         => __('Suggested Videos From', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    ''      => __('Current Channel', SA_EL_ADDONS_TEXTDOMAIN),
                    'yes'   => __('Any Channel', SA_EL_ADDONS_TEXTDOMAIN)
                ],
                'condition'     => [
                    'sa_el_video_box_video_type' => 'youtube',
                ]
            ]
        );

        $this->add_control(
            'aspect_ratio',
            [
                'label'         => __('Aspect Ratio', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    '11'    => '1:1',
                    '169'   => '16:9',
                    '43'    => '4:3',
                    '32'    => '3:2',
                    '219'   => '21:9',
                ],
                'default'       => '169',
                'prefix_class'  => 'sa-el-aspect-ratio-',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'sa_el_video_box_image_switcher',
            [
                'label'         => __('Overlay', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes'
            ]
        );

        $this->add_control(
            'sa_el_video_box_yt_thumbnail_size',
            [
                'label'     => __('Thumbnail Size', SA_EL_ADDONS_TEXTDOMAIN),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'maxresdefault' => __('Maximum Resolution', SA_EL_ADDONS_TEXTDOMAIN),
                    'hqdefault'     => __('High Quality', SA_EL_ADDONS_TEXTDOMAIN),
                    'mqdefault'     => __('Medium Quality', SA_EL_ADDONS_TEXTDOMAIN),
                    'sddefault'     => __('Standard Quality', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'default'   => 'maxresdefault',
                'condition' => [
                    'sa_el_video_box_video_type'      => 'youtube',
                    'sa_el_video_box_image_switcher!' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'sa_el_video_box_image_settings',
            [
                'label'         => __('Overlay', SA_EL_ADDONS_TEXTDOMAIN),
                'condition'     => [
                    'sa_el_video_box_image_switcher'  => 'yes'
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_image',
            [
                'label'         => __('Image', SA_EL_ADDONS_TEXTDOMAIN),
                'description'   => __('Choose an image for the video box', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::MEDIA,
                'dynamic'       => ['active' => true],
                'default'       => [
                    'url'    => Utils::get_placeholder_image_src()
                ],
                'label_block'   => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'sa_el_video_box_play_icon_settings',
            [
                'label'         => __('Play Icon', SA_EL_ADDONS_TEXTDOMAIN)
            ]
        );

        $this->add_control(
            'sa_el_video_box_play_icon_switcher',
            [
                'label'         => __('Play Icon', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes'
            ]
        );

        $this->add_control(
            'sa_el_video_box_icon_hor_position',
            [
                'label'         => __('Horizontal Position (%)', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'label_block'   => true,
                'default'       => [
                    'size' => 50,
                ],
                'condition'     => [
                    'sa_el_video_box_play_icon_switcher'  => 'yes',
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-video-box-play-icon-container' => 'left: {{SIZE}}%;',
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_icon_ver_position',
            [
                'label'         => __('Vertical Position (%)', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'label_block'   => true,
                'default'       => [
                    'size' => 50,
                ],
                'condition'     => [
                    'sa_el_video_box_play_icon_switcher'  => 'yes',
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-video-box-play-icon-container' => 'top: {{SIZE}}%;',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'sa_el_video_box_description_text_section',
            [
                'label'         => __('Description', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'sa_el_video_box_video_text_switcher',
            [
                'label'         => __('Video Text', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'sa_el_video_box_description_text',
            [
                'label'         => __('Text', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXTAREA,
                'dynamic'       => ['active' => true],
                'default'       => __('Play Video', SA_EL_ADDONS_TEXTDOMAIN),
                'condition'     => [
                    'sa_el_video_box_video_text_switcher' => 'yes'
                ],
                'dynamic'       => ['active' => true],
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'sa_el_video_box_description_ver_position',
            [
                'label'         => __('Vertical Position (%)', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'label_block'   => true,
                'default'       => [
                    'size' => 60,
                ],
                'condition'     => [
                    'sa_el_video_box_video_text_switcher' => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-video-box-description-container' => 'top: {{SIZE}}%;',
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_description_hor_position',
            [
                'label'         => __('Horizontal Position (%)', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'label_block'   => true,
                'default'       => [
                    'size' => 50,
                ],
                'condition'     => [
                    'sa_el_video_box_video_text_switcher' => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-video-box-description-container' => 'left: {{SIZE}}%;',
                ]
            ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();

        $this->start_controls_section(
            'sa_el_video_box_text_style_section',
            [
                'label'         => __('Video Box', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'image_border',
                'selector'      => '{{WRAPPER}} .sa-el-video-box-image-container, {{WRAPPER}} .sa-el-video-box-video-container',
            ]
        );

        //Border Radius Properties sepearated for responsive issues
        $this->add_responsive_control(
            'sa_el_video_box_image_border_radius',
            [
                'label'         => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-video-box-image-container, {{WRAPPER}} .sa-el-video-box-video-container'  => 'border-top-left-radius: {{SIZE}}{{UNIT}}; border-top-right-radius: {{SIZE}}{{UNIT}}; border-bottom-left-radius: {{SIZE}}{{UNIT}}; border-bottom-right-radius: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Shadow', SA_EL_ADDONS_TEXTDOMAIN),
                'name'          => 'box_shadow',
                'selector'      => '{{WRAPPER}} .sa-el-video-box-image-container',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'sa_el_video_box_icon_style',
            [
                'label'         => __('Play Icon', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'sa_el_video_box_play_icon_switcher'  => 'yes',
                ],
            ]
        );

        $this->add_control(
            'sa_el_video_box_play_icon_color',
            [
                'label'         => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-video-box-play-icon'  => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_play_icon_color_hover',
            [
                'label'         => __('Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-video-box-container:hover .sa-el-video-box-play-icon'  => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_play_icon_size',
            [
                'label'         => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'unit'  => 'px',
                    'size'  => 30,
                ],
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-video-box-play-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'sa_el_video_box_play_icon_background_color',
                'types'         => ['classic', 'gradient'],
                'selector'      => '{{WRAPPER}} .sa-el-video-box-play-icon-container',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'icon_border',
                'selector'      => '{{WRAPPER}} .sa-el-video-box-play-icon-container',
            ]
        );

        $this->add_control(
            'sa_el_video_box_icon_border_radius',
            [
                'label'         => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'unit'  => 'px',
                    'size'  => 100,
                ],
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-video-box-play-icon-container'  => 'border-radius: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'sa_el_video_box_icon_padding',
            [
                'label'         => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'default'       => [
                    'top'   => 40,
                    'right' => 40,
                    'bottom' => 40,
                    'left'  => 40,
                    'unit'  => 'px'
                ],
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-video-box-play-icon ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_icon_hover_animation',
            [
                'label'         => __('Hover Animation', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Hover animation works only when you set a background color or image for play icon', SA_EL_ADDONS_TEXTDOMAIN),
                'default'       => 'yes',
            ]
        );

        $this->add_responsive_control(
            'sa_el_video_box_icon_padding_hover',
            [
                'label'         => __('Hover Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-video-box-container:hover .sa-el-video-box-play-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition'     => [
                    'sa_el_video_box_icon_hover_animation'    => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'sa_el_video_box_text_style',
            [
                'label'         => __('Video Text', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'sa_el_video_box_video_text_switcher' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_text_color',
            [
                'label'         => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-video-box-text'   => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'sa_el_video_box_text_color_hover',
            [
                'label'         => __('Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-video-box-container:hover .sa-el-video-box-text'   => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'text_typography',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .sa-el-video-box-text',
            ]
        );

        $this->add_control(
            'sa_el_video_box_text_background_color',
            [
                'label'         => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-video-box-description-container'   => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'sa_el_video_box_text_padding',
            [
                'label'         => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-video-box-description-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'label'         => __('Shadow', SA_EL_ADDONS_TEXTDOMAIN),
                'name'          => 'sa_el_text_shadow',
                'selector'      => '.sa-el-video-box-text'
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings   = $this->get_settings_for_display();

        $id         = $this->get_id();

        $video_type = $settings['sa_el_video_box_video_type'];

        $params     = $this->get_video_params();

        $thumbnail  = $this->get_video_thumbnail($params['id']);

        $image      = sprintf('url(\'%s\')', $thumbnail);

        if ('self' === $video_type) {

            $overlay        = $settings['sa_el_video_box_image_switcher'];

            if ('yes' !== $overlay)
                $image      = 'transparent';

            if (empty($settings['sa_el_video_box_self_hosted_remote'])) {
                $hosted_url = $settings['sa_el_video_box_self_hosted']['url'];
            } else {
                $hosted_url = $settings['sa_el_video_box_self_hosted_remote'];
            }
        }

        $link       = $params['link'];

        $related = $settings['sa_el_video_box_suggested_videos'];

        $mute = $settings['sa_el_video_box_mute'];

        $loop = $settings['sa_el_video_box_loop'];

        $controls = $settings['sa_el_video_box_controls'];

        $options = 'youtube' === $video_type ? '&rel=' : '?rel';
        $options .= 'yes' === $related ? '1' : '0';
        $options .= 'youtube' === $video_type ? '&mute=' : '&muted=';
        $options .= 'yes' === $mute ? '1' : '0';
        $options .= '&loop=';
        $options .= 'yes' === $loop ? '1' : '0';
        $options .= '&controls=';
        $options .= 'yes' === $controls ? '1' : '0';

        if ($settings['sa_el_video_box_start'] || $settings['sa_el_video_box_end']) {

            if ('youtube' === $video_type) {

                if ($settings['sa_el_video_box_start']) {
                    $options .= '&start=' . $settings['sa_el_video_box_start'];
                }

                if ($settings['sa_el_video_box_end']) {
                    $options .= '&end=' . $settings['sa_el_video_box_end'];
                }
            } elseif ('self' === $video_type) {

                $hosted_url .= '#t=';

                if ($settings['sa_el_video_box_start']) {
                    $hosted_url .= $settings['sa_el_video_box_start'];
                }

                if ($settings['sa_el_video_box_end']) {
                    $hosted_url .= ',' . $settings['sa_el_video_box_end'];
                }
            }
        }

        if ($loop) {
            $options .= '&playlist=' . $params['id'];
        }

        if ('self' === $video_type) {

            $video_params = '';

            $autoplay = $settings['sa_el_video_box_self_autoplay'];

            if ($controls) {
                $video_params .= 'controls ';
            }
            if ($mute) {
                $video_params .= 'muted ';
            }
            if ($loop) {
                $video_params .= 'loop ';
            }
            if ($autoplay) {
                $video_params .= 'autoplay';
            }
        }

        $this->add_inline_editing_attributes('sa_el_video_box_description_text');

        $this->add_render_attribute(
            'container',
            [
                'id'    => 'sa-el-video-box-container-' . $id,
                'class' => 'sa-el-video-box-container',
                'data-overlay'  => 'yes' === $settings['sa_el_video_box_image_switcher'] ? 'true' : 'false',
                'data-type'     => $video_type
            ]
        );

        $this->add_render_attribute(
            'video_container',
            [
                'class' => 'sa-el-video-box-video-container',
            ]
        );


        if ('self' !== $video_type) {
            $this->add_render_attribute(
                'video_container',
                [
                    'data-src'  => $link . $options
                ]
            );
        }

        ?>

        <div <?php echo $this->get_render_attribute_string('container'); ?>>
            <div <?php echo $this->get_render_attribute_string('video_container'); ?>>
                <?php if ('self' === $video_type) : ?>
                    <video src="<?php echo esc_url($hosted_url); ?>" <?php echo $video_params; ?>></video>
                <?php endif; ?>
            </div>
            <div class="sa-el-video-box-image-container" style="background-image: <?php echo $image; ?>">
            </div>
            <?php if ($settings['sa_el_video_box_play_icon_switcher'] == 'yes') : ?>
                <div class="sa-el-video-box-play-icon-container">
                    <i class="sa-el-video-box-play-icon fa fa-play fa-lg"></i>
                </div>
            <?php endif; ?>
            <?php if ($settings['sa_el_video_box_video_text_switcher'] == 'yes' && !empty($settings['sa_el_video_box_description_text'])) : ?>
                <div class="sa-el-video-box-description-container">
                    <p class="sa-el-video-box-text"><span <?php echo $this->get_render_attribute_string('sa_el_video_box_description_text'); ?>><?php echo $settings['sa_el_video_box_description_text']; ?></span></p>
                </div>
            <?php endif; ?>
        </div>

<?php
    }

    private function get_video_thumbnail($id = '')
    {

        $settings       = $this->get_settings_for_display();

        $type           = $settings['sa_el_video_box_video_type'];

        $overlay        = $settings['sa_el_video_box_image_switcher'];

        if ('yes' !== $overlay) {
            $size           = '';
            if ('youtube' === $type) {
                $size = $settings['sa_el_video_box_yt_thumbnail_size'];
            }
            $thumbnail_src  = self::get_video_thumbnail_gen($id, $type, $size);
        } else {
            $thumbnail_src  = $settings['sa_el_video_box_image']['url'];
        }

        return $thumbnail_src;
    }

    private function get_video_params()
    {

        $settings   = $this->get_settings_for_display();

        $type       = $settings['sa_el_video_box_video_type'];

        $identifier = $settings['sa_el_video_box_video_id_embed_selection'];

        $id         = $settings['sa_el_video_box_video_id'];

        $embed      = $settings['sa_el_video_box_video_embed'];

        $link       = $settings['sa_el_video_box_link'];

        if (!empty($link)) {
            if ('youtube' === $type) {
                $video_props    = Embed::get_video_properties($link);
                $link           = Embed::get_embed_url($link);
                $video_id       = $video_props['video_id'];
            } elseif ('vimeo' === $type) {
                $video_id = substr($link, strpos($link, '.com/') + 5);
                $link = sprintf('https://player.vimeo.com/video/%s', $video_id);
            }

            $id = $video_id;
        } elseif (!empty($id) || !empty($embed)) {

            if ('id' === $identifier) {
                $link = 'youtube' === $type ? sprintf('https://www.youtube.com/embed/%s', $id) : sprintf('https://player.vimeo.com/video/%s', $id);
            } else {
                $link = $embed;
            }
        }

        return [
            'link' => $link,
            'id'    => $id
        ];
    }
    public static function get_video_thumbnail_gen($id, $type, $size = '')
    {

        if ('youtube' === $type) {
            if ('' === $size) {
                $size = 'maxresdefault';
            }
            $thumbnail_src = sprintf('https://i.ytimg.com/vi/%s/%s.jpg', $id, $size);
        } elseif ('vimeo' === $type) {

            $vimeo_data         = wp_remote_get('http://www.vimeo.com/api/v2/video/' . intval($id) . '.php');
            if (isset($vimeo_data['response']['code']) && '200' == $vimeo_data['response']['code']) {
                $response       = unserialize($vimeo_data['body']);
                $thumbnail_src  = isset($response[0]['thumbnail_large']) ? $response[0]['thumbnail_large'] : false;
            }
        } else {
            $thumbnail_src = 'transparent';
        }

        return $thumbnail_src;
    }
}
