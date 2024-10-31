<?php

namespace SA_EL_ADDONS\Elements\Devices;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Widget_Base as Widget_Base;

// use \SA_EL_ADDONS\Classes\Bootstrap;

class Devices extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_devices';
    }

    public function get_title() {
        return esc_html__('Devices', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-device-mobile  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    /**
     * Register Widget Controls
     *
     * @since  0.1.0
     * @return void
     */
    protected function _register_controls() {
        $this->start_controls_section(
                'section_content',
                [
                    'label' => __('Device', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'device_type',
                [
                    'label' => __('Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'phone',
                    'options' => [
                        'phone' => [
                            'title' => __('Phone', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-mobile-phone',
                        ],
                        'tablet' => [
                            'title' => __('Tablet', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-tablet',
                        ],
                        'laptop' => [
                            'title' => __('Laptop', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-laptop',
                        ],
                        'desktop' => [
                            'title' => __('Desktop', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-desktop',
                        ],
                        'window' => [
                            'title' => __('Window', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'far fa-window-maximize',
                        ],
                    ],
                    'frontend_available' => true,
                ]
        );

        $this->add_control(
                'device_media_type',
                [
                    'label' => __('Media Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'image',
                    'options' => [
                        'image' => __('Image', SA_EL_ADDONS_TEXTDOMAIN),
                        'video' => __('Video', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'device_orientation',
                [
                    'label' => __('Orientation', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'portrait',
                    'options' => [
                        'portrait' => [
                            'title' => __('Portrait', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fas fa-mobile-alt',
                        ],
                        'landscape' => [
                            'title' => __('Landscape', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'far fa-window-restore',
                        ],
                    ],
                    'prefix_class' => 'sa-el-device-orientation-',
                    'condition' => [
                        'device_type' => ['phone', 'tablet'],
                        'device_media_type' => ['image'],
                    ]
                ]
        );

        $this->add_control(
                'device_orientation_control',
                [
                    'label' => __('Orientation Control', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Show orientation control on frontend. ', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                    'condition' => [
                        'device_type' => ['phone', 'tablet'],
                        'device_media_type' => ['image'],
                    ],
                    'frontend_available' => true,
                ]
        );

        $this->add_responsive_control(
                'device_align',
                [
                    'label' => __('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'center',
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
                    'selectors' => [
                        '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'device_width',
                [
                    'label' => __('Maximum Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1920,
                            'step' => 10,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-device-wrapper' => 'max-width: {{SIZE}}{{UNIT}}; width: 100%;',
                        '{{WRAPPER}} .sa-el-device' => 'width: 100%;',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_screenshot',
                [
                    'label' => __('Screen', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'device_media_type' => ['image'],
                    ]
                ]
        );

        $this->start_controls_tabs('tabs_media');

        $this->start_controls_tab(
                'tab_media_portrait',
                [
                    'label' => __('Default', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'media_portrait_screenshot',
                [
                    'label' => __('Choose Screenshot', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => ['active' => true],
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'device_media_type' => ['image'],
                    ]
                ]
        );

        $this->add_control(
                'screen_phone_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => __('Use an image or video with the ratio of 16:9', SA_EL_ADDONS_TEXTDOMAIN),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                    'condition' => [
                        'device_type' => ['phone', 'desktop'],
                    ],
                ]
        );

        $this->add_control(
                'screen_tablet_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => __('Use an image or video with the ratio of 4:3', SA_EL_ADDONS_TEXTDOMAIN),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                    'condition' => [
                        'device_type' => 'tablet'
                    ],
                ]
        );

        $this->add_control(
                'screen_laptop_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => __('Use an image or video with the ratio of 16:10', SA_EL_ADDONS_TEXTDOMAIN),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                    'condition' => [
                        'device_type' => 'laptop'
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'media_portrait_screenshot',
                    'label' => __('Screenshot Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => 'large',
                    'condition' => [
                        'media_portrait_screenshot[url]!' => '',
                        'device_media_type' => ['image'],
                    ]
                ]
        );

        $this->add_control(
                'media_portrait_screenshot_scrollable',
                [
                    'label' => __('Scrollable', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'scrollable',
                    'prefix_class' => 'sa-el-device-portrait-',
                    'condition' => [
                        'media_portrait_screenshot[url]!' => '',
                        'device_media_type' => ['image'],
                        'device_type!' => ['window'],
                    ]
                ]
        );

        $this->add_responsive_control(
                'media_portrait_screenshot_align',
                [
                    'label' => __('Vertical Align', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'flex-start',
                    'options' => [
                        'flex-start' => [
                            'title' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'center' => [
                            'title' => __('Middle', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-stretch',
                        ],
                        'flex-end' => [
                            'title' => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                        'initial' => [
                            'title' => __('Custom', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-stretch',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-device__media__screen--image' => 'align-items: {{VALUE}};',
                        '{{WRAPPER}} .sa-el-device__media__screen--image .sa-el-device__media__screen__inner' => 'top: auto;',
                    ],
                    'condition' => [
                        'media_portrait_screenshot_scrollable!' => 'scrollable',
                        'media_portrait_screenshot[url]!' => '',
                        'device_media_type' => ['image'],
                        'device_type!' => ['window'],
                    ]
                ]
        );

        $this->add_control(
                'media_portrait_screenshot_position',
                [
                    'label' => __('Offset Top (%)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-device__media__screen--image .sa-el-device__media__screen__inner figure' => 'transform: translateY(-{{SIZE}}%);',
                    ],
                    'condition' => [
                        'media_portrait_screenshot_scrollable!' => 'scrollable',
                        'media_portrait_screenshot_align' => 'initial',
                        'media_portrait_screenshot[url]!' => '',
                        'device_media_type' => ['image'],
                        'device_type!' => ['window'],
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_media_landscape',
                [
                    'label' => __('Landscape', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'device_orientation_control' => 'yes',
                        'device_type' => ['phone', 'tablet'],
                        'device_media_type' => ['image'],
                    ]
                ]
        );

        $this->add_control(
                'media_landscape_screenshot',
                [
                    'label' => __('Choose Screenshot', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => ['active' => true],
                    'condition' => [
                        'device_orientation_control' => 'yes',
                        'device_type' => ['phone', 'tablet'],
                        'device_media_type' => ['image'],
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'media_landscape_screenshot', // Actually its `image_size`
                    'label' => __('Screenshot Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => 'large',
                    'condition' => [
                        'device_orientation_control' => 'yes',
                        'device_type' => ['phone', 'tablet'],
                        'device_media_type' => ['image'],
                        'media_landscape_screenshot[url]!' => '',
                    ]
                ]
        );

        $this->add_control(
                'media_landscape_screenshot_scrollable',
                [
                    'label' => __('Scrollable', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'scrollable',
                    'prefix_class' => 'sa-el-device-landscape-',
                    'condition' => [
                        'device_orientation_control' => 'yes',
                        'device_type' => ['phone', 'tablet'],
                        'device_media_type' => ['image'],
                        'media_landscape_screenshot[url]!' => ''
                    ]
                ]
        );

        $this->add_responsive_control(
                'media_landscape_screenshot_align',
                [
                    'label' => __('Vertical Align', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'flex-start',
                    'options' => [
                        'flex-start' => [
                            'title' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'center' => [
                            'title' => __('Middle', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-stretch',
                        ],
                        'flex-end' => [
                            'title' => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                        'initial' => [
                            'title' => __('Custom', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-stretch',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-device__media__screen.sa-el-device__media__screen__landscape' => 'align-items: {{VALUE}};',
                        '{{WRAPPER}} .sa-el-device__media__screen__landscape .sa-el-device__media__screen__inner' => 'top: auto;',
                    ],
                    'condition' => [
                        'media_landscape_screenshot_scrollable!' => 'scrollable',
                        'device_orientation_control' => 'yes',
                        'device_type' => ['phone', 'tablet'],
                        'device_media_type' => ['image'],
                        'media_landscape_screenshot[url]!' => '',
                    ]
                ]
        );

        $this->add_control(
                'media_landscape_screenshot_position',
                [
                    'label' => __('Offset Top (%)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-device__media__screen__landscape .sa-el-device__media__screen__inner' => 'transform: translateY(-{{SIZE}}%);',
                    ],
                    'condition' => [
                        'media_landscape_screenshot_scrollable!' => 'scrollable',
                        'media_landscape_screenshot_align' => 'initial',
                        'device_orientation_control' => 'yes',
                        'device_type' => ['phone', 'tablet'],
                        'device_media_type' => ['image'],
                        'media_landscape_screenshot[url]!' => ''
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'section_video',
                [
                    'label' => __('Video', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'device_media_type' => 'video',
                    ]
                ]
        );

        $this->start_controls_tabs('tabs_sources');

        $this->start_controls_tab(
                'tab_source_mp4',
                [
                    'label' => __('MP4', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_source',
                [
                    'label' => __('Source', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'url',
                    'options' => [
                        'url' => __('URL', SA_EL_ADDONS_TEXTDOMAIN),
                        'file' => __('File', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'video_url',
                [
                    'label' => __('URL', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'video_source' => 'url',
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_file',
                [
                    'label' => __('File', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => [
                        'active' => true,
                        'categories' => [
                            TagsModule::POST_META_CATEGORY,
                            TagsModule::MEDIA_CATEGORY,
                        ],
                    ],
                    'media_type' => 'video',
                    'condition' => [
                        'video_source' => 'file',
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_source_m4v',
                [
                    'label' => __('M4V', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_source_m4v',
                [
                    'label' => __('Source', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'url',
                    'options' => [
                        'url' => __('URL', SA_EL_ADDONS_TEXTDOMAIN),
                        'file' => __('File', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'video_url_m4v',
                [
                    'label' => __('URL', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'video_source_m4v' => 'url',
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_file_m4v',
                [
                    'label' => __('File', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => [
                        'active' => true,
                        'categories' => [
                            TagsModule::POST_META_CATEGORY,
                            TagsModule::MEDIA_CATEGORY,
                        ],
                    ],
                    'media_type' => 'video',
                    'condition' => [
                        'video_source_m4v' => 'file',
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_source_ogg',
                [
                    'label' => __('OGG', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_source_ogg',
                [
                    'label' => __('Source', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'url',
                    'options' => [
                        'url' => __('URL', SA_EL_ADDONS_TEXTDOMAIN),
                        'file' => __('File', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'video_url_ogg',
                [
                    'label' => __('URL', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'video_source_ogg' => 'url',
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_file_ogg',
                [
                    'label' => __('File', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => [
                        'active' => true,
                        'categories' => [
                            TagsModule::POST_META_CATEGORY,
                            TagsModule::MEDIA_CATEGORY,
                        ],
                    ],
                    'media_type' => 'video',
                    'condition' => [
                        'video_source_ogg' => 'file',
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_source_webm',
                [
                    'label' => __('WEBM', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_source_webm',
                [
                    'label' => __('Source', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'url',
                    'options' => [
                        'url' => __('URL', SA_EL_ADDONS_TEXTDOMAIN),
                        'file' => __('File', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'video_url_webm',
                [
                    'label' => __('URL', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'video_source_webm' => 'url',
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_file_webm',
                [
                    'label' => __('File', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => [
                        'active' => true,
                        'categories' => [
                            TagsModule::POST_META_CATEGORY,
                            TagsModule::MEDIA_CATEGORY,
                        ],
                    ],
                    'media_type' => 'video',
                    'condition' => [
                        'video_source_webm' => 'file',
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
                'video_cover',
                [
                    'label' => __('Choose Cover', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => ['active' => true],
                    'separator' => 'before',
                    'condition' => [
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'video_cover',
                    'label' => __('Cover Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => 'large',
                    'condition' => [
                        'video_cover[url]!' => '',
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_behaviour_heading',
                [
                    'label' => __('Behaviour', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_autoplay',
                [
                    'label' => __('Auto Play', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'autoplay',
                    'condition' => [
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_autoplay_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => __('Many browsers don\'t allow videos with sound to autoplay without user interaction. To avoid this, enable the "Start Muted" control to disable sound so that the video autoplays correctly.', SA_EL_ADDONS_TEXTDOMAIN),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    'condition' => [
                        'video_autoplay!' => '',
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_stop_others',
                [
                    'label' => __('Stop Others', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Stop all other videos on page when this video is played.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                    'frontend_available' => true,
                    'condition' => [
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_play_viewport',
                [
                    'label' => __('Play in Viewport', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Autoplay video when the player is in viewport', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                    'condition' => [
                        'device_media_type' => ['video'],
                        'video_autoplay' => 'autoplay',
                    ],
                    'frontend_available' => true,
                ]
        );

        $this->add_control(
                'video_stop_viewport',
                [
                    'label' => __('Stop on leave', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Stop video when the player has left the viewport', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                    'condition' => [
                        'device_media_type' => ['video'],
                        'video_autoplay' => 'autoplay',
                        'video_play_viewport' => 'yes',
                    ],
                    'frontend_available' => true,
                ]
        );

        $this->add_control(
                'video_restart_on_pause',
                [
                    'label' => __('Restart on pause', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                    'frontend_available' => true,
                    'condition' => [
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_loop',
                [
                    'label' => __('Loop', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'loop',
                    'condition' => [
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_end_at_last_frame',
                [
                    'label' => __('End at last frame', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('End the video at the last frame instead of showing the first one.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                    'condition' => [
                        'device_media_type' => ['video'],
                        'video_loop' => '',
                    ],
                    'frontend_available' => true,
                ]
        );

        $this->add_responsive_control(
                'video_speed',
                [
                    'label' => __('Playback Speed', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 1,
                    ],
                    'range' => [
                        'px' => [
                            'max' => 5,
                            'min' => 0.1,
                            'step' => 0.01,
                        ],
                    ],
                    'condition' => [
                        'device_media_type' => ['video'],
                    ],
                    'frontend_available' => true,
                ]
        );

        $this->add_control(
                'video_display_heading',
                [
                    'label' => __('Display', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_show_buttons',
                [
                    'label' => __('Show Buttons', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'show',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'show',
                    'condition' => [
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_show_bar',
                [
                    'label' => __('Show Bar', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'show',
                    'condition' => [
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_bar_hide',
                [
                    'label' => __('Hide Bar When Playing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'hide',
                    'prefix_class' => 'sa-el-video-player-bar--',
                    'return_value' => 'hide',
                    'condition' => [
                        'video_show_bar' => 'show',
                    ],
                ]
        );

        $this->add_control(
                'video_show_rewind',
                [
                    'label' => __('Show Rewind', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'show',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'show',
                    'condition' => [
                        'device_media_type' => ['video'],
                        'video_restart_on_pause!' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'video_show_time',
                [
                    'label' => __('Show Time', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'show',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'show',
                    'condition' => [
                        'device_media_type' => ['video'],
                        'video_show_bar!' => '',
                    ]
                ]
        );

        $this->add_control(
                'video_show_progress',
                [
                    'label' => __('Show Progress', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'show',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'show',
                    'condition' => [
                        'device_media_type' => ['video'],
                        'video_show_bar!' => '',
                    ]
                ]
        );

        $this->add_control(
                'video_show_duration',
                [
                    'label' => __('Show Duration', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'show',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'show',
                    'condition' => [
                        'device_media_type' => ['video'],
                        'video_show_bar!' => '',
                    ]
                ]
        );

        $this->add_control(
                'video_show_fs',
                [
                    'label' => __('Show Fullscreen', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'show',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'show',
                    'condition' => [
                        'device_media_type' => ['video'],
                        'video_show_bar!' => '',
                    ],
                ]
        );

        $this->add_control(
                'video_volume_heading',
                [
                    'label' => __('Volume', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_show_volume',
                [
                    'label' => __('Show Volume', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'show',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'show',
                    'condition' => [
                        'device_media_type' => ['video'],
                        'video_show_bar!' => '',
                    ],
                ]
        );

        $this->add_control(
                'video_show_volume_icon',
                [
                    'label' => __('Show Volume Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'show',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'show',
                    'condition' => [
                        'video_show_bar!' => '',
                        'video_show_volume!' => '',
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_show_volume_bar',
                [
                    'label' => __('Show Volume Bar', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'show',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'show',
                    'condition' => [
                        'video_show_bar!' => '',
                        'video_show_volume!' => '',
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_control(
                'video_start_muted',
                [
                    'label' => __('Start Muted', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'video_autoplay!' => '',
                        'device_media_type' => ['video'],
                    ],
                ]
        );

        $this->add_responsive_control(
                'video_volume',
                [
                    'label' => __('Initial Volume', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0.8,
                    ],
                    'range' => [
                        'px' => [
                            'max' => 1,
                            'min' => 0,
                            'step' => 0.01,
                        ],
                    ],
                    'condition' => [
                        'device_media_type' => ['video'],
                        'video_start_muted!' => 'yes',
                    ],
                    'frontend_available' => true,
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_device_style',
                [
                    'label' => __('Device', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'device_override_style',
                [
                    'label' => __('Override Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Override default device style', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'device_skin',
                [
                    'label' => __('Skin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'jetblack',
                    'options' => [
                        'jetblack' => __('Jet black', SA_EL_ADDONS_TEXTDOMAIN),
                        'black' => __('Black', SA_EL_ADDONS_TEXTDOMAIN),
                        'silver' => __('Silver', SA_EL_ADDONS_TEXTDOMAIN),
                        'gold' => __('Gold', SA_EL_ADDONS_TEXTDOMAIN),
                        'rosegold' => __('Rose Gold', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'prefix_class' => 'sa-el-device-skin-',
                    'condition' => [
                        'device_override_style!' => 'yes',
                        'device_type!' => ['laptop', 'desktop']
                    ],
                ]
        );

        $this->add_control(
                'device_frame_background',
                [
                    'label' => __('Device Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-device-wrapper svg .back-shape' => 'fill: {{VALUE}}',
                        '{{WRAPPER}} .sa-el-device-wrapper svg .side-shape' => 'fill: {{VALUE}}',
                    ],
                    'condition' => [
                        'device_override_style' => 'yes'
                    ],
                ]
        );

        $this->add_control(
                'device_overlay_tone',
                [
                    'label' => __('Tone', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'light',
                    'options' => [
                        'light' => __('Light', SA_EL_ADDONS_TEXTDOMAIN),
                        'dark' => __('Dark', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'prefix_class' => 'sa-el-device-controls-tone-',
                    'condition' => [
                        'device_override_style' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'device_overlay_opacity',
                [
                    'label' => __('Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0.2,
                    ],
                    'range' => [
                        'px' => [
                            'max' => 0.4,
                            'min' => 0.1,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-device-wrapper svg .overlay-shape' => 'fill-opacity: {{SIZE}};',
                    ],
                    'condition' => [
                        'device_override_style' => 'yes'
                    ],
                ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();
        $this->start_controls_section(
                'section_orientation_style',
                [
                    'label' => __('Orientation Control', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'device_orientation_control!' => '',
                    ],
                ]
        );

        $this->start_controls_tabs('tabs_orientation_style');

        $this->start_controls_tab(
                'orientation_default',
                [
                    'label' => __('Default', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'orientation_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-device__orientation' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'orientation_hover',
                [
                    'label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'orientation_color_hover',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-device__orientation:hover' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'section_video_style',
                [
                    'label' => __('Video', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'device_media_type' => 'video',
                        'device_type!' => 'window',
                    ],
                ]
        );

        $this->add_control(
                'video_cover_screen',
                [
                    'label' => __('Cover Screen', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'return_value' => 'cover',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'device_media_type' => 'video',
                        'device_type!' => 'window',
                    ],
                    'prefix_class' => 'sa-el-device-video-',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_screen_style',
                [
                    'label' => __('Screen', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'device_media_type' => ['image'],
                        'device_type' => ['window'],
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'device_screen_border',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-device-wrapper .sa-el-device__media__screen figure',
                    'condition' => [
                        'device_type' => ['window'],
                        'device_media_type' => ['image'],
                    ],
                ]
        );

        $this->add_control(
                'device_screen_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'allowed_dimensions' => ['bottom', 'left'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-device-wrapper .sa-el-device__media__screen figure' => 'border-radius: 0 0 {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'device_type' => ['window'],
                        'device_media_type' => ['image'],
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_video_overlay',
                [
                    'label' => __('Video Overlay', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'device_media_type' => 'video',
                    ],
                ]
        );

        $this->add_control(
                'video_overlay_background',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#000000',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-video-player__cover::after' => 'background-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'device_media_type' => 'video',
                    ],
                ]
        );

        $this->add_responsive_control(
                'video_overlay_opacity',
                [
                    'label' => __('Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0.8,
                    ],
                    'range' => [
                        'px' => [
                            'max' => 1,
                            'min' => 0,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-video-player__cover::after' => 'opacity: {{SIZE}}',
                    ],
                    'condition' => [
                        'device_media_type' => 'video',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style',
                [
                    'label' => __('Video Interface', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'device_media_type',
                                'operator' => '==',
                                'value' => 'video',
                            ],
                            [
                                'relation' => 'or',
                                'terms' => [
                                    [
                                        'name' => 'video_show_buttons',
                                        'operator' => '==',
                                        'value' => 'show',
                                    ],
                                    [
                                        'name' => 'video_show_bar',
                                        'operator' => '==',
                                        'value' => 'show',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]
        );

        $this->add_control(
                'video_controls_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'default' => [
                        'top' => 100,
                        'right' => 100,
                        'bottom' => 100,
                        'left' => 100,
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__overlay .sa-el-player__control,
						{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar .sa-el-player__control--progress' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar .sa-el-player__control--progress__inner' => 'border-radius: 0 {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} 0;'
                    ],
                ]
        );

        $this->start_controls_tabs('tabs_controls_style');

        $this->start_controls_tab(
                'video_controls',
                [
                    'label' => __('Default', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'video_controls_foreground',
                [
                    'label' => __('Controls Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#000000',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__overlay .sa-el-player__control,
							 {{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__control--progress__inner' => 'background-color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'video_controls_background',
                [
                    'label' => __('Controls Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#FFFFFF',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__overlay .sa-el-player__control,
							 {{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar' => 'background-color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'video_controls_opacity',
                [
                    'label' => __('Controls Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0.9,
                    ],
                    'range' => [
                        'px' => [
                            'max' => 1,
                            'min' => 0,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__overlay .sa-el-player__control,
							 {{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar' => 'opacity: {{SIZE}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'video_controls_border',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' =>
                    '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__overlay .sa-el-player__control,
							 {{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'video_controls_shadow',
                    'selector' =>
                    '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__overlay .sa-el-player__control,
							 {{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'video_controls_hover',
                [
                    'label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'video_controls_foreground_hover',
                [
                    'label' => __('Controls Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '(desktop+){{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__overlay .sa-el-player__control:hover,
							 {{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar:hover' => 'color: {{VALUE}}',
                        '(desktop+){{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar:hover .sa-el-player__control--progress__inner' => 'background-color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'video_controls_background_hover',
                [
                    'label' => __('Controls Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '(desktop+){{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__overlay .sa-el-player__control:hover,
							 {{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar:hover' => 'background-color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'video_controls_opacity_hover',
                [
                    'label' => __('Controls Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
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
                        '(desktop+){{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__overlay .sa-el-player__control:hover,
							 {{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar:hover' => 'opacity: {{SIZE}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'video_controls_border_hover',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' =>
                    '(desktop+){{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__overlay .sa-el-player__control:hover,
							{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar:hover',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'video_controls_shadow_hover',
                    'selector' =>
                    '(desktop+){{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__overlay .sa-el-player__control:hover,
							{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar:hover',
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'section_buttons_style',
                [
                    'label' => __('Video Buttons', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'device_media_type' => 'video',
                        'video_show_buttons!' => '',
                    ],
                ]
        );

        $this->add_responsive_control(
                'video_buttons_size',
                [
                    'label' => __('Size (%)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 60,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__overlay .sa-el-player__control' => 'font-size: {{SIZE}}px; width: {{SIZE}}px; height: {{SIZE}}px;',
                    ],
                    'condition' => [
                        'video_show_buttons!' => '',
                    ],
                ]
        );

        $this->add_responsive_control(
                'video_buttons_spacing',
                [
                    'label' => __('Controls Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__overlay .sa-el-player__controls__rewind' => 'margin-right: {{SIZE}}px;',
                    ],
                    'condition' => [
                        'video_show_buttons!' => '',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_bar_style',
                [
                    'label' => __('Video Bar', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'device_media_type' => 'video',
                        'video_show_bar!' => '',
                    ],
                ]
        );

        $this->add_responsive_control(
                'video_bar_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '',
                    ],
                    'range' => [
                        'px' => [
                            'max' => 72,
                            'min' => 0,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar' => 'padding: {{SIZE}}px',
                    ],
                    'condition' => [
                        'video_show_bar!' => '',
                    ],
                ]
        );

        $this->add_responsive_control(
                'video_bar_margin',
                [
                    'label' => __('Distance', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '',
                    ],
                    'range' => [
                        'px' => [
                            'max' => 72,
                            'min' => 0,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar-wrapper' => 'padding: 0 {{SIZE}}px {{SIZE}}px {{SIZE}}px',
                    ],
                    'condition' => [
                        'video_show_bar!' => '',
                    ],
                ]
        );

        $this->add_control(
                'video_bar_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'video_show_bar!' => '',
                    ],
                ]
        );

        $this->add_responsive_control(
                'video_bar_zoom',
                [
                    'label' => __('Controls Zoom', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '',
                    ],
                    'range' => [
                        'px' => [
                            'max' => 36,
                            'min' => 6,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar' => 'font-size: {{SIZE}}px',
                        '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__controls__bar .sa-el-player__control--progress' => 'height: {{SIZE}}px',
                    ],
                    'condition' => [
                        'video_show_bar!' => '',
                    ],
                ]
        );

        $this->add_responsive_control(
                'video_bar_spacing',
                [
                    'label' => __('Controls Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '',
                    ],
                    'range' => [
                        'px' => [
                            'max' => 24,
                            'min' => 3,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__control--indicator,
						 {{WRAPPER}} .sa-el-video-player__controls .sa-el-player__control--icon' => 'padding: 0 {{SIZE}}px',
                        '{{WRAPPER}} .sa-el-video-player__controls .sa-el-player__control--progress' => 'margin: 0 {{SIZE}}px',
                    ],
                    'condition' => [
                        'video_show_bar!' => '',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    /**
     * Render
     * 
     * Render widget contents on frontend
     *
     * @since  0.1.0
     * @return void
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Default to phone
        $device_type = 'phone';

        // Only assign device type if selected
        if (!empty($settings['device_type'])) {
            $device_type = $settings['device_type'];
        }

        $this->add_render_attribute([
            'device-wrapper' => [
                'class' => [
                    'sa-el-device-wrapper',
                    'sa-el-device-type-' . $device_type,
                ],
            ],
            'device' => [
                'class' => [
                    'sa-el-device',
                ],
            ],
            'device-orientation' => [
                'class' => [
                    'sa-el-device__orientation',
                    'far',
                    ' fa-window-restore',
                ],
            ],
            'device-shape' => [
                'class' => [
                    'sa-el-device__shape',
                ],
            ],
            'device-media' => [
                'class' => [
                    'sa-el-device__media',
                ],
            ],
            'device-media-inner' => [
                'class' => [
                    'sa-el-device__media__inner',
                ],
            ],
            'device-media-screen' => [
                'class' => [
                    'sa-el-device__media__screen',
                    'sa-el-device__media__screen--' . $settings['device_media_type'],
                ],
            ],
            'device-media-screen-landscape' => [
                'class' => [
                    'sa-el-device__media__screen',
                    'sa-el-device__media__screen__landscape',
                ],
            ],
            'device-media-screen-controls' => [
                'class' => [
                    'sa-el-device__media__screen',
                    'sa-el-device__media__screen__controls',
                ],
            ],
            'device-media-screen-inner' => [
                'class' => [
                    'sa-el-device__media__screen__inner',
                ],
            ],
        ]);

        if ('yes' === $settings['device_orientation_control'] && 'image' === $settings['device_media_type']) {
            $this->add_render_attribute('device', 'class', 'has--orientation-control');
        }
        ?><div <?php echo $this->get_render_attribute_string('device-wrapper'); ?>>
            <div <?php echo $this->get_render_attribute_string('device'); ?>>

                <?php if ('yes' === $settings['device_orientation_control'] && 'image' === $settings['device_media_type']) { ?>
                    <div <?php echo $this->get_render_attribute_string('device-orientation'); ?>></div>
                <?php } ?>

                <div <?php echo $this->get_render_attribute_string('device-shape'); ?>>
                    <?php include SA_EL_ADDONS_PATH . 'assets/shapes/' . $device_type . '.svg'; ?>
                </div><!-- .sa-el-device__shape -->

                <div <?php echo $this->get_render_attribute_string('device-media'); ?>>
                    <div <?php echo $this->get_render_attribute_string('device-media-inner'); ?>>
                        <div <?php echo $this->get_render_attribute_string('device-media-screen'); ?>>
                            <div <?php echo $this->get_render_attribute_string('device-media-screen-inner'); ?>>
                                <?php if ('image' === $settings['device_media_type']) { ?>
                                    <?php $this->render_type_image('media_portrait_screenshot'); ?>
                                <?php } elseif ('video' === $settings['device_media_type']) { ?>
                                    <?php $this->render_type_video(); ?>
                                <?php } ?>
                            </div><!-- .sa-el-device__media__screen__inner -->
                        </div><!-- .sa-el-device__media__screen -->

                        <?php if ('image' === $settings['device_media_type'] && '' !== $settings['media_landscape_screenshot']['url']) { ?>
                            <div <?php echo $this->get_render_attribute_string('device-media-screen-landscape'); ?>>
                                <div <?php echo $this->get_render_attribute_string('device-media-screen-inner'); ?>>
                                    <figure>
                                        <?php $this->render_type_image('media_landscape_screenshot'); ?>
                                    </figure>
                                </div><!-- .sa-el-device__media__screen__inner -->
                            </div><!-- .sa-el-device__media__screen__landscape -->
                        <?php } ?>

                    </div><!-- .sa-el-device__media__inner -->
                </div><!-- .sa-el-device__media -->
            </div><!-- .sa-el-device -->
        </div><!-- .sa-el-device-wrapper --><?php
    }

    /**
     * Render Type Image
     * 
     * Render markup for the image
     *
     * @since  0.1.0
     * @param  control|string 	The control id
     * @return void
     */
    protected function render_type_image($control) {
        $settings = $this->get_settings_for_display();

        if ('' !== $settings['media_portrait_screenshot']['url']) {
            ?>
            <figure><?php echo Group_Control_Image_Size::get_attachment_image_html($settings, $control); ?></figure>
            <?php
        }
    }

    protected function render_type_video() {
        $settings = $this->get_settings_for_display();

        if (
                empty($settings['video_file']['url']) &&
                empty($settings['video_file_ogg']['url']) &&
                empty($settings['video_file_webm']['url']) &&
                empty($settings['video_file_m4v']['url']) &&
                empty($settings['video_url']) &&
                empty($settings['video_url_ogg']) &&
                empty($settings['video_url_webm']) &&
                empty($settings['video_url_m4v'])
        )
            return;

        $this->add_render_attribute([
            'video-wrapper' => [
                'class' => [
                    'sa-el-video-player',
                    'sa-el-player'
                ],
            ],
        ]);
        ?><div <?php echo $this->get_render_attribute_string('video-wrapper'); ?>>
                <?php $this->render_video(); ?>
                <?php $this->render_cover(); ?>
                <?php $this->render_controls(); ?>
        </div><!-- .sa-el-video-player -->
        <?php
    }

    /**
     * Render Video
     * 
     * Render markup for the video
     *
     * @since  0.1.0
     * @return void
     */
    protected function render_video() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('video', [
            'class' => [
                'sa-el-video-player__source',
                'sa-el-player__source'
            ],
            'playsinline' => 'true',
            'webkit-playsinline' => 'true',
            'width' => '100%',
            'height' => '100%',
        ]);

        if ('autoplay' === $settings['video_autoplay'] && 'yes' !== $settings['video_play_viewport']) {
            $this->add_render_attribute('video', 'autoplay', 'true');
        }

        if ('yes' === $settings['video_start_muted']) {
            $this->add_render_attribute('video', 'muted', 'true');
        }

        if ('loop' === $settings['video_loop']) {
            $this->add_render_attribute('video', 'loop', 'true');
        }

        if (!empty($settings['video_cover']['url'])) {
            $url = Group_Control_Image_Size::get_attachment_image_src($settings['video_cover']['id'], 'video_cover', $settings);
            $this->add_render_attribute('video', 'poster', $url);
        }
        ?><video <?php echo $this->get_render_attribute_string('video'); ?>><?php
            $video_url = ( 'file' === $settings['video_source'] ) ? $settings['video_file']['url'] : $settings['video_url'];
            $video_url_m4v = ( 'file' === $settings['video_source_m4v'] ) ? $settings['video_file_m4v']['url'] : $settings['video_url_m4v'];
            $video_url_ogg = ( 'file' === $settings['video_source_ogg'] ) ? $settings['video_file_ogg']['url'] : $settings['video_url_ogg'];
            $video_url_webm = ( 'file' === $settings['video_source_webm'] ) ? $settings['video_file_webm']['url'] : $settings['video_url_webm'];

            if ($video_url) {
                $this->add_render_attribute('source-mp4', [
                    'src' => $video_url,
                    'type' => 'video/mp4',
                ]);
                ?><source <?php echo $this->get_render_attribute_string('source-mp4'); ?>><?php } ?>

            <?php
            if ($video_url_m4v) {
                $this->add_render_attribute('source-m4v', [
                    'src' => $video_url_m4v,
                    'type' => 'video/m4v',
                ]);
                ?><source <?php echo $this->get_render_attribute_string('source-m4v'); ?>><?php } ?>

            <?php
            if ($video_url_ogg) {
                $this->add_render_attribute('source-ogg', [
                    'src' => $video_url_ogg,
                    'type' => 'video/ogg',
                ]);
                ?><source <?php echo $this->get_render_attribute_string('source-wav'); ?>><?php } ?>

            <?php
            if ($video_url_webm) {
                $this->add_render_attribute('source-webm', [
                    'src' => $video_url_webm,
                    'type' => 'video/webm',
                ]);
                ?><source <?php echo $this->get_render_attribute_string('source-webm'); ?>><?php } ?>

        </video><?php
    }

    /**
     * Render Cover
     * 
     * Render markup for the cover
     *
     * @since  0.1.0
     * @return void
     */
    protected function render_cover() {
        $this->add_render_attribute('video-cover', [
            'class' => [
                'sa-el-video-player__cover',
                'sa-el-player__cover',
            ],
        ]);
        ?><div <?php echo $this->get_render_attribute_string('video-cover'); ?>></div><?php
    }

    /**
     * Render Controls
     * 
     * Render markup for the player controls
     *
     * @since  0.1.0
     * @return void
     */
    protected function render_controls() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute([
            'controls' => [
                'class' => [
                    'sa-el-video-player__controls',
                    'sa-el-player__controls',
                ],
            ],
            'bar-wrapper' => [
                'class' => [
                    'sa-el-player__controls__bar-wrapper',
                    'sa-el-video-player__controls__bar-wrapper',
                ],
            ],
            'bar' => [
                'class' => [
                    'sa-el-player__controls__bar',
                ],
            ],
            'control-play' => [
                'class' => [
                    'sa-el-player__control',
                    'sa-el-player__controls__play',
                    'sa-el-player__control--icon',
                    'fa-play', 'fas',
                ],
            ],
        ]);
        ?>
        <div <?php echo $this->get_render_attribute_string('controls'); ?>><?php
            /**
             * Before overlay.
             *
             * Fires before printing the overlay controls.
             *
             * @since 2.2.0
             */
            do_action('elementor_extras/widgets/devices/video/before_overlay');

            $this->render_overlay();

            /**
             * After overlay.
             *
             * Fires after printing the overlay controls.
             *
             * @since 2.2.0
             */
            do_action('elementor_extras/widgets/devices/video/before_overlay');

            if ('show' === $settings['video_show_bar']) {

                /**
                 * Before bar.
                 *
                 * Fires before printing the controls bar.
                 *
                 * @since 2.2.0
                 */
                do_action('elementor_extras/widgets/devices/video/before_bar');
                ?><div <?php echo $this->get_render_attribute_string('bar-wrapper'); ?>>
                    <div <?php echo $this->get_render_attribute_string('bar'); ?>>

                        <?php
                        if ('yes' !== $settings['video_restart_on_pause'] && 'show' === $settings['video_show_rewind']) {
                            $this->add_render_attribute('control-rewind', [
                                'class' => [
                                    'sa-el-player__control',
                                    'sa-el-player__controls__rewind',
                                    'sa-el-player__control--icon',
                                    'fas',
                                    'fa-redo-alt',
                                ],
                            ]);
                            ?><div <?php echo $this->get_render_attribute_string('control-rewind'); ?>></div><?php } ?>

                        <div <?php echo $this->get_render_attribute_string('control-play'); ?>></div>

                        <?php
                        if ($settings['video_show_time']) {
                            $this->add_render_attribute('control-time', [
                                'class' => [
                                    'sa-el-player__control',
                                    'sa-el-player__control--indicator',
                                    'sa-el-player__controls__time',
                                ],
                            ]);
                            ?><div <?php echo $this->get_render_attribute_string('control-time'); ?>>00:00</div><?php } ?>

                        <?php
                        if ($settings['video_show_progress']) {
                            $this->add_render_attribute([
                                'control-progress' => [
                                    'class' => [
                                        'sa-el-player__control',
                                        'sa-el-player__controls__progress',
                                        'sa-el-player__control--progress',
                                    ],
                                ],
                                'control-progress-time' => [
                                    'class' => [
                                        'sa-el-player__controls__progress-time',
                                        'sa-el-player__control--progress__inner',
                                    ],
                                ],
                                'control-progress-track' => [
                                    'class' => [
                                        'sa-el-player__control--progress__inner',
                                        'sa-el-player__control--progress__track',
                                    ],
                                ],
                            ]);
                            ?><div <?php echo $this->get_render_attribute_string('control-progress'); ?>>
                                <div <?php echo $this->get_render_attribute_string('control-progress-time'); ?>></div>
                                <div <?php echo $this->get_render_attribute_string('control-progress-track'); ?>></div>
                            </div><?php } ?>

                        <?php
                        if ($settings['video_show_duration']) {
                            $this->add_render_attribute('control-duration', [
                                'class' => [
                                    'sa-el-player__control',
                                    'sa-el-player__controls__duration',
                                    'sa-el-player__control--indicator',
                                ],
                            ]);
                            ?><div <?php echo $this->get_render_attribute_string('control-duration'); ?>>00:00</div><?php } ?>

                        <?php
                        if ($settings['video_show_volume']) {
                            $this->add_render_attribute('control-volume', [
                                'class' => [
                                    'sa-el-player__control',
                                    'sa-el-player__controls__volume',
                                ],
                            ]);
                            ?><div <?php echo $this->get_render_attribute_string('control-volume'); ?>>

                                <?php
                                if ($settings['video_show_volume_icon']) {
                                    $this->add_render_attribute('control-volume-icon', [
                                        'class' => [
                                            'sa-el-player__controls__volume-icon',
                                            'sa-el-player__control--icon',
                                            'fas',
                                            'fa-volume-up',
                                        ],
                                    ]);
                                    ?><div <?php echo $this->get_render_attribute_string('control-volume-icon'); ?>></div><?php } ?>

                                <?php
                                if ($settings['video_show_volume_bar']) {
                                    $this->add_render_attribute([
                                        'control-volume-bar' => [
                                            'class' => [
                                                'sa-el-player__control',
                                                'sa-el-player__controls__volume-bar',
                                                'sa-el-player__control--progress',
                                            ],
                                        ],
                                        'control-volume-bar-amount' => [
                                            'class' => [
                                                'sa-el-player__controls__volume-bar__amount',
                                                'sa-el-player__control--progress__inner',
                                            ],
                                        ],
                                        'control-volume-bar-track' => [
                                            'class' => [
                                                'sa-el-player__controls__volume-bar__track',
                                                'sa-el-player__control--progress__inner',
                                                'sa-el-player__control--progress__track',
                                            ],
                                        ],
                                    ]);
                                    ?><div <?php echo $this->get_render_attribute_string('control-volume-bar'); ?>>
                                        <div <?php echo $this->get_render_attribute_string('control-volume-bar-amount'); ?>></div>
                                        <div <?php echo $this->get_render_attribute_string('control-volume-bar-track'); ?>></div>
                                    </div><?php } ?>

                            </div><?php } ?>

                        <?php
                        if ($settings['video_show_fs']) {
                            $this->add_render_attribute('control-fullscreen', [
                                'class' => [
                                    'sa-el-player__control',
                                    'sa-el-player__controls__fs',
                                    'sa-el-player__control--icon',
                                    'fas', 'fa-expand-arrows-alt'
                                ],
                            ]);
                            ?><div <?php echo $this->get_render_attribute_string('control-fullscreen'); ?>></div><?php } ?>

                    </div><!-- .sa-el-player__controls__bar -->
                </div><!-- .sa-el-player__controls__bar-wrapper --><?php
                /**
                 * After bar.
                 *
                 * Fires after printing the controls bar.
                 *
                 * @since 2.2.0
                 */
                do_action('elementor_extras/widgets/devices/video/after_bar');
            }
            ?></div><!-- .sa-el-video-player__controls -->
        <?php
    }

    /**
     * Render Overlay
     * 
     * Render markup for the overlay
     *
     * @since  0.1.0
     * @return void
     */
    protected function render_overlay() {
        $settings = $this->get_settings_for_display();

        if ('show' === $settings['video_show_buttons']) {
            $this->add_render_attribute([
                'overlay' => [
                    'class' => [
                        'sa-el-player__controls__overlay',
                        'sa-el-video-player__overlay',
                    ],
                ],
                'overlay-play' => [
                    'class' => [
                        'sa-el-player__control',
                        'sa-el-player__controls__play',
                        'fa-play', 'fas',
                    ],
                ],
            ]);
            ?><ul <?php echo $this->get_render_attribute_string('overlay'); ?>><?php
                    if ('yes' !== $settings['video_restart_on_pause'] && 'show' === $settings['video_show_rewind']) {
                        $this->add_render_attribute('overlay-rewind', [
                            'class' => [
                                'sa-el-player__control',
                                'sa-el-player__controls__rewind',
                                'fas', 'fa-redo-alt',
                            ],
                        ])
                        ?><li <?php echo $this->get_render_attribute_string('overlay-rewind'); ?>></li><?php }
                    ?><li <?php echo $this->get_render_attribute_string('overlay-play'); ?>></li>
            </ul>
            <?php
        }
    }

    /**
     * Content Template
     * 
     * Javascript content template for quick rendering
     *
     * @since  0.1.0
     * @return void
     */
    protected function _content_template() {
        ?><#

        var device_type = 'phone';

        if ( settings.device_type ) {
        device_type = settings.device_type;
        }

        view.addRenderAttribute( {
        'device-wrapper' : {
        'class' : [
        'sa-el-device-wrapper',
        'sa-el-device-type-' + device_type,
        ],
        },
        'device' : {
        'class' : [
        'sa-el-device',
        ],
        },
        'device-orientation' : {
        'class' : [
        'sa-el-device__orientation',

        'far',
        'fa-window-restore',
        ],
        },
        'device-shape' : {
        'class' : [
        'sa-el-device__shape',
        ],
        },
        'device-media' : {
        'class' : [
        'sa-el-device__media',
        ],
        },
        'device-media-inner' : {
        'class' : [
        'sa-el-device__media__inner',
        ],
        },
        'device-media-screen' : {
        'class' : [
        'sa-el-device__media__screen',
        'sa-el-device__media__screen--' + settings.device_media_type,
        ],
        },
        'device-media-screen-landscape' : {
        'class' : [
        'sa-el-device__media__screen',
        'sa-el-device__media__screen__landscape',
        ],
        },
        'device-media-screen-controls' : {
        'class' : [
        'sa-el-device__media__screen',
        'sa-el-device__media__screen__controls',
        ],
        },
        'device-media-screen-inner' : {
        'class' : [
        'sa-el-device__media__screen__inner',
        ],
        },
        } );

        if ( 'yes' === settings.device_orientation_control && 'image' === settings.device_media_type ) {
        view.addRenderAttribute('device', 'class', 'has--orientation-control');
        }

        function getScreenshotURL( orientation ) {
        var screen = {
        id 			: settings['media_' + orientation + '_screenshot'].id,
        url 		: settings['media_' + orientation + '_screenshot'].url,
        size 		: settings['media_' + orientation + '_screenshot_size'],
        dimension 	: settings['media_' + orientation + '_screenshot_custom_dimension'],
        model 		: view.getEditModel(),
        };

        var screen_url = elementor.imagesManager.getImageUrl( screen );

        if ( screen_url )
        return screen_url;

        return false;
        }

        #><div {{{ view.getRenderAttributeString( 'device-wrapper') }}}>
            <div {{{ view.getRenderAttributeString( 'device' ) }}}>

                <# if ( 'yes' === settings.device_orientation_control && 'image' === settings.device_media_type ) { #>
                <div {{{ view.getRenderAttributeString( 'device-orientation') }}}></div>
                <# } #>

                <div {{{ view.getRenderAttributeString( 'device-shape') }}}></div><!-- .sa-el-device__shape -->

                <div {{{ view.getRenderAttributeString( 'device-media') }}}>
                    <div {{{ view.getRenderAttributeString( 'device-media-inner') }}}>
                        <div {{{ view.getRenderAttributeString( 'device-media-screen') }}}>
                            <div {{{ view.getRenderAttributeString( 'device-media-screen-inner') }}}>
                                <# if ( 'image' === settings.device_media_type ) { #>
                                <figure><img src="{{{ getScreenshotURL( 'portrait' ) }}}" /></figure>
                                <# } else if ( 'video' === settings.device_media_type ) { #>
                                <?php $this->_video_type_template(); ?>
                                <# } #>
                            </div><!-- .sa-el-device__media__screen__inner -->
                        </div><!-- .sa-el-device__media__screen -->

                        <# if ( 'image' === settings.device_media_type && '' !== settings.media_landscape_screenshot.url ) { #>
                        <div {{{ view.getRenderAttributeString( 'device-media-screen-landscape') }}}>
                            <div {{{ view.getRenderAttributeString( 'device-media-screen-inner') }}}>
                                <figure>
                                    <figure><img src="{{{ getScreenshotURL( 'landscape' ) }}}" /></figure>
                                </figure>
                            </div><!-- .sa-el-device__media__screen__inner -->
                        </div><!-- .sa-el-device__media__screen__landscape -->
                        <# } #>

                    </div><!-- .sa-el-device__media__inner -->
                </div><!-- .sa-el-device__media -->
            </div><!-- .sa-el-device -->
        </div><!-- .sa-el-device-wrapper --><?php
    }

    /**
     * Video Type Template
     * 
     * Javascript video type template
     *
     * @since  0.1.0
     * @return void
     */
    protected function _video_type_template() {
        ?><#

        if (
        '' !== settings.video_file.url ||
        '' !== settings.video_file_ogg.url ||
        '' !== settings.video_file_webm.url ||
        '' !== settings.video_file_m4v.url ||
        '' !== settings.video_url ||
        '' !== settings.video_url_ogg ||
        '' !== settings.video_url_webm ||
        '' !== settings.video_url_m4v
        ) {

        view.addRenderAttribute( {
        'video-wrapper' : {
        'class' : [
        'sa-el-video-player',
        'sa-el-player',
        ],
        },
        } );

        #><div {{{ view.getRenderAttributeString( 'video-wrapper' ) }}}>
        <?php echo $this->_video_template(); ?>
        <?php echo $this->_cover_template(); ?>
        <?php echo $this->_controls_template(); ?>
        </div><!-- .sa-el-player -->
        <# } #><?php
    }

    /**
     * Video Template
     * 
     * Javascript video template
     *
     * @since  0.1.0
     * @return void
     */
    protected function _video_template() {
        ?><#

        view.addRenderAttribute( 'video', {
        'class' : [
        'sa-el-video-player__source',
        'sa-el-player__source'
        ],
        'playsinline' : 'true',
        'width' : '100%',
        'height' : '100%',
        } );

        if( 'autoplay' === settings.video_autoplay && 'yes' !== settings.video_play_viewport ) {
        view.addRenderAttribute( 'video', 'autoplay', 'true' );
        }

        if( 'yes' === settings.video_start_muted ) {
        view.addRenderAttribute( 'video', 'muted', 'true' );
        }

        if ( 'loop' === settings.video_loop ) {
        view.addRenderAttribute( 'video', 'loop', 'true' );
        }

        if ( settings.video_cover.id ) {

        var image = {
        id 			: settings.video_cover.id,
        url 		: settings.video_cover.url,
        size 		: settings.image_size,
        dimension 	: settings.image_custom_dimension,
        model 		: view.getEditModel(),
        };

        view.addRenderAttribute( 'video', 'poster', elementor.imagesManager.getImageUrl( image ) );
        }

        #><video {{{ view.getRenderAttributeString( 'video' ) }}}><#

            var video_url = ( 'file' === settings.video_source ) ? settings.video_file.url : settings.video_url,
            video_url_m4v = ( 'file' === settings.video_source_m4v ) ? settings.video_file_m4v.url : settings.video_url_m4v,
            video_url_ogg = ( 'file' === settings.video_source_ogg ) ? settings.video_file_ogg.url : settings.video_url_ogg,
            video_url_webm = ( 'file' === settings.video_source_webm ) ? settings.video_file_webm.url : settings.video_url_webm;

            if ( video_url ) {
            view.addRenderAttribute( 'source-mp4', {
            'src' : video_url,
            'type' : 'video/mp4',
            } );
            #><source {{{ view.getRenderAttributeString( 'source-mp4' ) }}}><# } #>

                <# if ( video_url_m4v ) {
                view.addRenderAttribute( 'source-m4v', {
                'src' : video_url_m4v,
                'type' : 'video/m4v',
                } );
                #><source {{{ view.getRenderAttributeString( 'source-m4v' ) }}}><# } #>

                <# if ( video_url_ogg ) {
                view.addRenderAttribute( 'source-ogg', {
                'src' : video_url_ogg,
                'type' : 'video/ogg',
                } );
                #><source {{{ view.getRenderAttributeString( 'source-ogg' ) }}}><# } #>

                <# if ( video_url_webm ) {
                view.addRenderAttribute( 'source-webm', {
                'src' : video_url_webm,
                'type' : 'video/webm',
                } );
                #><source {{{ view.getRenderAttributeString( 'source-webm' ) }}}><# } #>

        </video>
        <?php
    }

    /**
     * Controls Template
     * 
     * Javascript controls template
     *
     * @since  0.1.0
     * @return void
     */
    protected function _controls_template() {
        ?><#

        view.addRenderAttribute({
        'controls' : {
        'class' : [
        'sa-el-video-player__controls',
        'sa-el-player__controls',
        ],
        },
        'bar-wrapper' : {
        'class' : [
        'sa-el-player__controls__bar-wrapper',
        'sa-el-video-player__controls__bar-wrapper',
        ],
        },
        'bar' : {
        'class' : [
        'sa-el-player__controls__bar',
        ],
        },
        'control-play' : {
        'class' : [
        'sa-el-player__control',
        'sa-el-player__controls__play',
        'sa-el-player__control--icon',

        'fa-play','fas',
        ],
        },
        });

        #><div {{{ view.getRenderAttributeString( 'controls' ) }}}>

            <?php $this->_overlay_template(); ?>

            <# if ( 'show' === settings.video_show_bar ) { #>

            <div {{{ view.getRenderAttributeString( 'bar-wrapper' ) }}}>
                <div {{{ view.getRenderAttributeString( 'bar' ) }}}>

                    <# if ( 'yes' !== settings.video_restart_on_pause && 'show' === settings.video_show_rewind ) {
                    view.addRenderAttribute( 'control-rewind', {
                    'class' : [
                    'sa-el-player__control',
                    'sa-el-player__controls__rewind',
                    'sa-el-player__control--icon',

                    'fas',
                    'fa-redo-alt',
                    ],
                    } );
                    #><div {{{ view.getRenderAttributeString( 'control-rewind' ) }}}></div><# } #>

                    <div {{{ view.getRenderAttributeString( 'control-play' ) }}}></div>

                    <# if ( settings.video_show_time ) {
                    view.addRenderAttribute( 'control-time', {
                    'class' : [
                    'sa-el-player__control',
                    'sa-el-player__control--indicator',
                    'sa-el-player__controls__time',
                    ],
                    } );
                    #><div {{{ view.getRenderAttributeString( 'control-time' ) }}}>00:00</div><# } #>

                    <# if ( settings.video_show_progress ) {
                    view.addRenderAttribute( {
                    'control-progress' : {
                    'class' : [
                    'sa-el-player__control',
                    'sa-el-player__controls__progress',
                    'sa-el-player__control--progress',
                    ],
                    },
                    'control-progress-time' : {
                    'class' : [
                    'sa-el-player__controls__progress-time',
                    'sa-el-player__control--progress__inner',
                    ],
                    },
                    'control-progress-track' : {
                    'class' : [
                    'sa-el-player__control--progress__inner',
                    'sa-el-player__control--progress__track',
                    ],
                    },
                    } );
                    #><div {{{ view.getRenderAttributeString( 'control-progress' ) }}}>
                        <div {{{ view.getRenderAttributeString( 'control-progress-time' ) }}}></div>
                        <div {{{ view.getRenderAttributeString( 'control-progress-track' ) }}}></div>
                    </div><# } #>

                    <# if ( settings.video_show_duration ) {
                    view.addRenderAttribute( 'control-duration', {
                    'class' : [
                    'sa-el-player__control',
                    'sa-el-player__controls__duration',
                    'sa-el-player__control--indicator',
                    ],
                    } );
                    #><div {{{ view.getRenderAttributeString( 'control-duration' ) }}}>00:00</div><# } #>

                    <# if ( settings.video_show_volume ) {
                    view.addRenderAttribute( 'control-volume', {
                    'class' : [
                    'sa-el-player__control',
                    'sa-el-player__controls__volume',
                    ],
                    } );
                    #><div {{{ view.getRenderAttributeString( 'control-volume' ) }}}>

                        <# if ( settings.video_show_volume_icon ) {
                        view.addRenderAttribute( 'control-volume-icon', {
                        'class' : [
                        'sa-el-player__controls__volume-icon',
                        'sa-el-player__control--icon',

                        'fas',
                        'fa-volume-up',
                        ],
                        } );
                        #><div {{{ view.getRenderAttributeString( 'control-volume-icon' ) }}}></div><# } #>

                        <# if ( settings.video_show_volume_bar ) {
                        view.addRenderAttribute( {
                        'control-volume-bar' : {
                        'class' : [
                        'sa-el-player__control',
                        'sa-el-player__controls__volume-bar',
                        'sa-el-player__control--progress',
                        ],
                        },
                        'control-volume-bar-amount' : {
                        'class' : [
                        'sa-el-player__controls__volume-bar__amount',
                        'sa-el-player__control--progress__inner',
                        ],
                        },
                        'control-volume-bar-track' : {
                        'class' : [
                        'sa-el-player__controls__volume-bar__track',
                        'sa-el-player__control--progress__inner',
                        'sa-el-player__control--progress__track',
                        ],
                        },
                        } );
                        #><div {{{ view.getRenderAttributeString( 'control-volume-bar' ) }}}>
                            <div {{{ view.getRenderAttributeString( 'control-volume-bar-amount' ) }}}></div>
                            <div {{{ view.getRenderAttributeString( 'control-volume-bar-track' ) }}}></div>
                        </div><# } #>

                    </div><# } #>

                </div><!-- .sa-el-player__controls__bar -->
            </div><!-- .sa-el-player__controls__bar-wrapper -->
            <# } #>
        </div><!-- .sa-el-player__controls -->
        <?php
    }

    /**
     * Cover Template
     * 
     * Javascript cover template
     *
     * @since  0.1.0
     * @return void
     */
    protected function _cover_template() {
        ?><#
        view.addRenderAttribute( 'video-cover', {
        'class' : [
        'sa-el-video-player__cover',
        'sa-el-player__cover',
        ],
        } );
        #><div {{{ view.getRenderAttributeString( 'video-cover' ) }}}></div><?php
    }

    /**
     * Overlay Template
     * 
     * Javascript overlay template
     *
     * @since  0.1.0
     * @return void
     */
    protected function _overlay_template() {
        ?><#

        if ( 'show' === settings.video_show_buttons ) {
        view.addRenderAttribute( {
        'overlay' : {
        'class' : [
        'sa-el-player__controls__overlay',
        'sa-el-video-player__overlay',
        ],
        },
        'overlay-play' : {
        'class' : [
        'sa-el-player__control',
        'sa-el-player__controls__play',

        'fa-play','fas',
        ],
        },
        } );

        #><ul {{{ view.getRenderAttributeString( 'overlay' ) }}}><#

            if ( 'yes' !== settings.video_restart_on_pause && 'show' === settings.video_show_rewind ) {
            view.addRenderAttribute( 'overlay-rewind', {
            'class' : [
            'sa-el-player__control',
            'sa-el-player__controls__rewind',

            'fas fa-redo-alt',
            ],
            } )
            #><li {{{ view.getRenderAttributeString( 'overlay-rewind' ) }}}></li><# }

            #><li {{{ view.getRenderAttributeString( 'overlay-play' ) }}}></li>
        </ul>
        <# } #><?php
    }

}
