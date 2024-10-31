<?php

namespace SA_EL_ADDONS\Elements\Preview_Window;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;

class Preview_Window extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_preview_window';
    }

    public function get_title() {
        return esc_html__('Preview Window', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-slideshow oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {

        /* Start Image Preview Content Section */
        $this->start_controls_section('sa_el_preview_image',
                [
                    'label' => __('Trigger Image', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('sa_el_preview_image_main',
                [
                    'label' => __('Choose Image', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => ['active' => true],
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'sa_el_preview_image_main_size',
                    'default' => 'full',
                ]
        );

        $this->add_control('sa_el_preview_image_alt',
                [
                    'label' => __('Alt', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => ['active' => true],
                    'default' => __('Preview Window', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('sa_el_preview_image_caption',
                [
                    'label' => __('Caption', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => ['active' => true],
                    'default' => __('Preview Window', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control('sa_el_preview_image_link_switcher',
                [
                    'label' => __('Link', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                ]
        );

        $this->add_control('sa_el_preview_image_link_selection',
                [
                    'label' => __('Link Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'url' => __('URL', SA_EL_ADDONS_TEXTDOMAIN),
                        'link' => __('Existing Page', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'url',
                    'label_block' => true,
                    'condition' => [
                        'sa_el_preview_image_link_switcher' => 'yes'
                    ]
                ]
        );

        $this->add_control('sa_el_preview_image_link',
                [
                    'label' => __('Link', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::URL,
                    'dynamic' => ['active' => true],
                    'default' => [
                        'url' => '#',
                    ],
                    'placeholder' => 'http://sa-elementor-addons.com/',
                    'label_block' => true,
                    'condition' => [
                        'sa_el_preview_image_link_selection' => 'url',
                        'sa_el_preview_image_link_switcher' => 'yes'
                    ]
                ]
        );

        $this->add_control('sa_el_preview_image_existing_link',
                [
                    'label' => __('Existing Page', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT2,
                    'options' => $this->sa_el_get_all_post(),
                    'condition' => [
                        'sa_el_preview_image_link_selection' => 'link',
                        'sa_el_preview_image_link_switcher' => 'yes'
                    ],
                    'multiple' => false,
                    'label_block' => true,
                ]
        );

        $this->add_control('sa_el_preview_image_align',
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
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-preview-image-trig-img-wrap' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_preview_image_magnifier',
                [
                    'label' => __('Preview Window', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('sa_el_preview_image_content_selection',
                [
                    'label' => __('Content Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'custom' => __('Custom Content', SA_EL_ADDONS_TEXTDOMAIN),
                        'template' => __('Elementor Template', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'custom',
                    'label_block' => true,
                ]
        );

        $this->add_control('sa_el_preview_image_img_switcher',
                [
                    'label' => __('Image', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'condition' => [
                        'sa_el_preview_image_content_selection' => 'custom'
                    ]
                ]
        );

        $this->add_control('sa_el_preview_image_tooltips_image',
                [
                    'label' => __('Choose Image', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => ['active' => true],
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'sa_el_preview_image_content_selection' => 'custom',
                        'sa_el_preview_image_img_switcher' => 'yes'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'sa_el_preview_image_tooltips_image_size',
                    'default' => 'full',
                    'condition' => [
                        'sa_el_preview_image_content_selection' => 'custom',
                        'sa_el_preview_image_img_switcher' => 'yes'
                    ]
                ]
        );

        $this->add_control('sa_el_preview_image_tooltips_image_alt',
                [
                    'label' => __('Alt', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => ['active' => true],
                    'default' => __('Preview Window', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_preview_image_content_selection' => 'custom',
                        'sa_el_preview_image_img_switcher' => 'yes'
                    ]
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_tooltip_img_align',
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
                    'default' => 'center',
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-img-wrap-{{ID}}' => 'text-align: {{VALUE}};',
                    ],
                    'condition' => [
                        'sa_el_preview_image_content_selection' => 'custom',
                        'sa_el_preview_image_img_switcher' => 'yes'
                    ]
                ]
        );

        $this->add_control('sa_el_preview_image_title_switcher',
                [
                    'label' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'condition' => [
                        'sa_el_preview_image_content_selection' => 'custom'
                    ]
                ]
        );

        $this->add_control('sa_el_preview_image_title',
                [
                    'label' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Preview Image',
                    'condition' => [
                        'sa_el_preview_image_title_switcher' => 'yes',
                        'sa_el_preview_image_content_selection' => 'custom'
                    ]
                ]
        );

        $this->add_control('sa_el_image_preview_title_heading',
                [
                    'label' => __('HTML Tag', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'h3',
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6'
                    ],
                    'condition' => [
                        'sa_el_preview_image_title_switcher' => 'yes',
                        'sa_el_preview_image_content_selection' => 'custom'
                    ]
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_tooltip_title_align',
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
                    'default' => 'center',
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-title-wrap-{{ID}}' => 'text-align: {{VALUE}};',
                    ],
                    'condition' => [
                        'sa_el_preview_image_content_selection' => 'custom',
                        'sa_el_preview_image_title_switcher' => 'yes'
                    ]
                ]
        );

        $this->add_control('sa_el_preview_image_desc_switcher',
                [
                    'label' => __('Description', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'condition' => [
                        'sa_el_preview_image_content_selection' => 'custom'
                    ]
                ]
        );

        $this->add_control('sa_el_preview_image_desc',
                [
                    'label' => __('Content', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::WYSIWYG,
                    'dynamic' => ['active' => true],
                    'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    'condition' => [
                        'sa_el_preview_image_desc_switcher' => 'yes',
                        'sa_el_preview_image_content_selection' => 'custom'
                    ]
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_tooltip_desc_align',
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
                    'default' => 'center',
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-desc-wrap-{{ID}}' => 'text-align: {{VALUE}};',
                    ],
                    'condition' => [
                        'sa_el_preview_image_content_selection' => 'custom',
                        'sa_el_preview_image_desc_switcher' => 'yes'
                    ]
                ]
        );

        $this->add_control('sa_el_preview_image_content_temp',
                [
                    'label' => __('Choose Template', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Template content is a template which you can choose from Elementor library', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT2,
                    'options' => $this->sa_el_get_all_post(),
                    'condition' => [
                        'sa_el_preview_image_content_selection' => 'template'
                    ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_preview_image_advanced',
                [
                    'label' => __('Advanced Settings', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('sa_el_preview_image_interactive',
                [
                    'label' => __('Interactive', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('Give users the possibility to interact with the content of the tooltip', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('sa_el_preview_image_responsive',
                [
                    'label' => __('Responsive', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('Resize tooltip image to fit screen', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('sa_el_preview_image_anim',
                [
                    'label' => __('Animation', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'fade' => __('Fade', SA_EL_ADDONS_TEXTDOMAIN),
                        'grow' => __('Grow', SA_EL_ADDONS_TEXTDOMAIN),
                        'swing' => __('Swing', SA_EL_ADDONS_TEXTDOMAIN),
                        'slide' => __('Slide', SA_EL_ADDONS_TEXTDOMAIN),
                        'fall' => __('Fall', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'fade',
                    'label_block' => true,
                ]
        );

        $this->add_control('sa_el_preview_image_anim_dur',
                [
                    'label' => __('Animation Duration', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __('Set the animation duration in milliseconds, default is 350', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => 350,
                ]
        );

        $this->add_control('sa_el_preview_image_delay',
                [
                    'label' => __('Delay', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __('Set the animation delay in milliseconds, default is 10'),
                    'default' => 10,
                ]
        );

        $this->add_control('sa_el_preview_image_arrow',
                [
                    'label' => __('Arrow', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'description' => __('Show an arrow beside the tooltip', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => true,
                ]
        );

        $this->add_control('sa_el_preview_image_distance',
                [
                    'label' => __('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __('The distance between the origin and the tooltip in pixels, default is 6', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => -1,
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_min_width',
                [
                    'label' => __('Min Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __('Set a minimum width for the tooltip in pixels, default: 0 (auto width)', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_max_width',
                [
                    'label' => __('Max Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __('Set a maximum width for the tooltip in pixels, default: null (no max width)', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('sa_el_preview_image_custom_height_switcher',
                [
                    'label' => __('Custom Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'return_value' => true,
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_custom_height',
                [
                    'label' => __('Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em', '%'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 800,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 20,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 200,
                    ],
                    'label_block' => true,
                    'condition' => [
                        'sa_el_preview_image_custom_height_switcher' => 'true'
                    ],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-wrap-{{ID}}' => 'height: {{SIZE}}{{UNIT}} !important;'
                    ]
                ]
        );

        $this->add_control('sa_el_preview_image_side',
                [
                    'label' => __('Side', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT2,
                    'options' => [
                        'top' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                        'right' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom' => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                        'left' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'description' => __('Sets the side of the tooltip. The value may one of the following: \'top\', \'bottom\', \'left\', \'right\'. It may also be an array containing one or more of these values. When using an array, the order of values is taken into account as order of fallbacks and the absence of a side disables it', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => ['right', 'left'],
                    'multiple' => true,
        ]);

        $this->add_control('sa_el_preview_image_hide',
                [
                    'label' => __('Hide on Mobiles', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'description' => __('Hide tooltips on mobile phones', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => true,
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();
        
        $this->start_controls_section('sa_el_preview_image_trigger_style_settings',
                [
                    'label' => __('Trigger Image', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control('sa_el_preview_image_trigger_background',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-preview-image-trigger' => 'background-color:{{VALUE}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_preview_image_trigger_border',
                    'selector' => '{{WRAPPER}} .sa-el-preview-image-trigger',
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_trigger_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-preview-image-trigger' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                    ]
        ]);

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'sa_el_preview_image_trigger_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-preview-image-trigger',
                ]
        );

        $this->add_group_control(
                Group_Control_Css_Filter::get_type(),
                [
                    'name' => 'css_filters',
                    'selector' => '{{WRAPPER}} .sa-el-preview-image-trigger',
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_trigger_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-preview-image-trigger' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_trigger_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-preview-image-trigger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_preview_image_caption_style',
                [
                    'label' => __('Trigger Image Caption', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'sa_el_preview_image_caption!' => ''
                    ]
                ]
        );

        $this->add_control('sa_el_preview_image_caption_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-preview-image-figcap' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sa_el_preview_image_caption_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .sa-el-preview-image-figcap'
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'sa_el_preview_image_caption_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-preview-image-figcap'
                ]
        );

        $this->add_control('sa_el_preview_image_caption_background_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-preview-image-figcap' => 'background: {{VALUE}};',
                    ],
                ]
        );


        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_preview_image_caption_border',
                    'selector' => '{{WRAPPER}} .sa-el-preview-image-figcap'
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_caption_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-preview-image-figcap' => 'border-radius: {{SIZE}}{{UNIT}}'
                    ]
        ]);

        $this->add_responsive_control('sa_el_preview_image_caption_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-preview-image-figcap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_caption_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-preview-image-figcap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_preview_image_tooltip_style_settings',
                [
                    'label' => __('Preview Window Content', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control('sa_el_preview_image_tooltip_background',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-wrap-{{ID}}' => 'background-color:{{VALUE}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_preview_image_tooltip_border',
                    'selector' => '.sa-el-prev-img-tooltip-wrap-{{ID}}'
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_tooltip_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-wrap-{{ID}}' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                    ]
        ]);

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'sa_el_preview_image_tooltip_shadow',
                    'selector' => '.sa-el-prev-img-tooltip-wrap-{{ID}}'
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_tooltip_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-wrap-{{ID}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_tooltip_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-wrap-{{ID}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_preview_image_tooltip_img_style_settings',
                [
                    'label' => __('Preview Window Image', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'sa_el_preview_image_content_selection' => 'custom',
                        'sa_el_preview_image_img_switcher' => 'yes'
                    ]
                ]
        );

        $this->add_control('sa_el_preview_image_tooltip_img_background',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-img-wrap-{{ID}} .sa-el-preview-image-tooltips-img' => 'background-color:{{VALUE}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_preview_image_tooltip_img_border',
                    'selector' => '.sa-el-prev-img-tooltip-img-wrap-{{ID}} .sa-el-preview-image-tooltips-img'
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_tooltip_img_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-img-wrap-{{ID}} .sa-el-preview-image-tooltips-img' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                    ]
        ]);

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'label' => __('Shadow', SA_EL_ADDONS_TEXTDOMAIN),
                    'name' => 'sa_el_preview_image_tooltip_img_shadow',
                    'selector' => '.sa-el-prev-img-tooltip-img-wrap-{{ID}} .sa-el-preview-image-tooltips-img'
                ]
        );

        $this->add_group_control(
                Group_Control_Css_Filter::get_type(),
                [
                    'name' => 'preview_css_filters',
                    'selector' => '.sa-el-prev-img-tooltip-img-wrap-{{ID}} .sa-el-preview-image-tooltips-img',
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_tooltip_img_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-img-wrap-{{ID}} .sa-el-preview-image-tooltips-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_tooltip_img_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-img-wrap-{{ID}} .sa-el-preview-image-tooltips-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_preview_image_tooltip_title_style_settings',
                [
                    'label' => __('Preview Window Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'sa_el_preview_image_content_selection' => 'custom',
                        'sa_el_preview_image_title_switcher' => 'yes'
                    ]
                ]
        );

        $this->add_control('sa_el_preview_image_tooltip_title_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-title-wrap-{{ID}} .sa-el-previmg-tooltip-title' => 'color: {{VALUE}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sa_el_preview_image_tooltip_title_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '.sa-el-prev-img-tooltip-title-wrap-{{ID}} .sa-el-previmg-tooltip-title'
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'sa_el_preview_image_tooltip_title_shadow',
                    'selector' => '.sa-el-prev-img-tooltip-title-wrap-{{ID}}'
                ]
        );

        $this->add_control('sa_el_preview_image_tooltip_title_background',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-title-wrap-{{ID}}' => 'background-color:{{VALUE}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_preview_image_tooltip_title_border',
                    'selector' => '.sa-el-prev-img-tooltip-title-wrap-{{ID}}'
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_tooltip_title_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-title-wrap-{{ID}}' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                    ]
        ]);

        $this->add_responsive_control('sa_el_preview_image_tooltip_title_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-title-wrap-{{ID}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_tooltip_title_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-title-wrap-{{ID}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_preview_image_tooltip_desc_style_settings',
                [
                    'label' => __('Preview Window Description', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'sa_el_preview_image_content_selection' => 'custom',
                        'sa_el_preview_image_desc_switcher' => 'yes'
                    ]
                ]
        );

        $this->add_control('sa_el_preview_image_tooltip_desc_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-desc-wrap-{{ID}}' => 'color:{{VALUE}};'
                    ]
                ]
        );


        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sa_el_preview_image_tooltip_desc_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '.sa-el-prev-img-tooltip-desc-wrap-{{ID}}'
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'sa_el_preview_image_tooltip_desc_shadow',
                    'selector' => '.sa-el-prev-img-tooltip-desc-wrap-{{ID}}'
                ]
        );

        $this->add_control('sa_el_preview_image_tooltip_desc_background',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-desc-wrap-{{ID}}' => 'background-color:{{VALUE}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_preview_image_tooltip_desc_border',
                    'selector' => '.sa-el-prev-img-tooltip-desc-wrap-{{ID}}'
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_tooltip_desc_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-desc-wrap-{{ID}}' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                    ]
        ]);

        $this->add_responsive_control('sa_el_preview_image_tooltip_desc_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-desc-wrap-{{ID}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_tooltip_desc_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '.sa-el-prev-img-tooltip-desc-wrap-{{ID}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_preview_image_tooltip_container',
                [
                    'label' => __('Preview Window Container', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control('sa_el_preview_image_tooltip_outer_background',
                [
                    'label' => __('Inner  Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '.tooltipster-sidetip div.tooltipster-box-{{ID}} .tooltipster-content' => 'background-color:{{VALUE}};'
                    ]
                ]
        );

        $this->add_control('sa_el_preview_image_tooltip_container_background',
                [
                    'label' => __('Outer Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '.tooltipster-sidetip div.tooltipster-box-{{ID}}' => 'background-color:{{VALUE}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_preview_image_tooltip_container_border',
                    'selector' => '.tooltipster-sidetip div.tooltipster-box-{{ID}}'
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_tooltip_container_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '.tooltipster-sidetip div.tooltipster-box-{{ID}}' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                    ]
        ]);

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'sa_el_preview_image_tooltip_container_shadow',
                    'selector' => '.tooltipster-sidetip div.tooltipster-box-{{ID}}'
                ]
        );

        $this->add_responsive_control('sa_el_preview_image_tooltip_containe_rpadding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '.tooltipster-sidetip div.tooltipster-box-{{ID}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $id = $this->get_id();

        $template = $settings['sa_el_preview_image_content_temp'];

        if (!empty($settings['sa_el_preview_image_main']['url'])) {
            $image_main = $settings['sa_el_preview_image_main'];
            $image_url_main = Group_Control_Image_Size::get_attachment_image_src($image_main['id'], 'sa_el_preview_image_main_size', $settings);
            $image_url = empty($image_url_main) ? $image_main['url'] : $image_url_main;
        }

        $size = 0;

        if (!empty($settings['sa_el_preview_image_tooltips_image']['url'])) {

            $tooltips_image = $settings['sa_el_preview_image_tooltips_image'];
            $selected_size = $settings['sa_el_preview_image_tooltips_image_size' . '_size'];
            $size = wp_get_attachment_image_src($tooltips_image['id'], $selected_size);
            $tool_tips_image_url = Group_Control_Image_Size::get_attachment_image_src($tooltips_image['id'], 'sa_el_preview_image_tooltips_image_size', $settings);
            if (empty($tool_tips_image_url)) {
                $tool_tips_image_url = $tooltips_image['url'];
            } else {
                $tool_tips_image_url = $tool_tips_image_url;
            }

            $this->add_render_attribute('tooltip-img-wrap', 'class', 'sa-el-prev-img-tooltip-img-wrap-' . $id);

            $this->add_render_attribute('tooltip-img', 'class', 'sa-el-preview-image-tooltips-img');

            $this->add_render_attribute('tooltip-img', 'alt', $settings['sa_el_preview_image_tooltips_image_alt']);

            $this->add_render_attribute('tooltip-img', 'src', $tool_tips_image_url);
        }

        if (!empty($settings['sa_el_preview_image_desc'])) {
            $this->add_render_attribute('tooltip-desc', 'class', [
                'sa-el-prev-img-tooltip-desc-wrap-' . $id,
                'sa-el-prev-img-tooltip-desc-wrap'
                    ]
            );
        }

        $this->add_render_attribute('sa_el_preview_img_trigger', 'class', 'sa-el-preview-image-trigger');
        $this->add_render_attribute('sa_el_preview_img_trigger', 'alt', $settings['sa_el_preview_image_alt']);
        $this->add_render_attribute('sa_el_preview_img_trigger', 'src', $image_url);

        $this->add_inline_editing_attributes('sa_el_preview_image_caption', 'basic');
        $this->add_render_attribute('sa_el_preview_image_caption', 'class', 'sa-el-preview-image-figcap');


        if ($settings['sa_el_preview_image_link_switcher'] == 'yes') {
            if ($settings['sa_el_preview_image_link_selection'] == 'url') {
                $preview_img_url = $settings['sa_el_preview_image_link']['url'];
            } else {
                $preview_img_url = get_permalink($settings['sa_el_preview_image_existing_link']);
            }
        }

        $tooltip_container = [
            'background' => $settings['sa_el_preview_image_tooltip_container_background']
        ];

        $prev_img_settings = [
            'anim' => $settings['sa_el_preview_image_anim'],
            'animDur' => !empty($settings['sa_el_preview_image_anim_dur']) ? $settings['sa_el_preview_image_anim_dur'] : 350,
            'delay' => !empty($settings['sa_el_preview_image_delay']) ? $settings['sa_el_preview_image_delay'] : 10,
            'arrow' => ( $settings['sa_el_preview_image_arrow'] == true ) ? true : false,
            'active' => ( $settings['sa_el_preview_image_interactive'] == 'yes') ? true : false,
            'responsive' => ( $settings['sa_el_preview_image_responsive'] == 'yes' ) ? true : false,
            'distance' => !empty($settings['sa_el_preview_image_distance']) ? $settings['sa_el_preview_image_distance'] : 6,
            'maxWidth' => !empty($settings['sa_el_preview_image_max_width']) ? $settings['sa_el_preview_image_max_width'] : 'null',
            'minWidth' => !empty($settings['sa_el_preview_image_min_width']) ? $settings['sa_el_preview_image_min_width'] : $size[1],
            'maxWidthTabs' => !empty($settings['sa_el_preview_image_max_width_tablet']) ? $settings['sa_el_preview_image_max_width_tablet'] : 'null',
            'minWidthTabs' => !empty($settings['sa_el_preview_image_min_width_tablet']) ? $settings['sa_el_preview_image_min_width_tablet'] : $size[1],
            'maxWidthMobs' => !empty($settings['sa_el_preview_image_max_width_mobile']) ? $settings['sa_el_preview_image_max_width_mobile'] : 'null',
            'minWidthMobs' => !empty($settings['sa_el_preview_image_min_width_mobile']) ? $settings['sa_el_preview_image_min_width_mobile'] : $size[1],
            'side' => !empty($settings['sa_el_preview_image_side']) ? $settings['sa_el_preview_image_side'] : array('right', 'left'),
            'container' => $tooltip_container,
            'hideMobiles' => ($settings['sa_el_preview_image_hide'] == true) ? true : false,
            'id' => $id,
        ];

        if ($settings['sa_el_preview_image_title_switcher'] == 'yes' && !empty($settings['sa_el_preview_image_title'])) {

            $this->add_render_attribute('tooltip-title', 'class', [
                'sa-el-prev-img-tooltip-title-wrap-' . $id,
                'sa-el-prev-img-tooltip-title-wrap'
                    ]
            );

            $title = '<' . $settings['sa_el_image_preview_title_heading'] . ' class="sa-el-previmg-tooltip-title">' . $settings['sa_el_preview_image_title'] . '</' . $settings['sa_el_image_preview_title_heading'] . '>';
        }

        $this->add_render_attribute('preview-img', 'id', 'sa-el-preview-image-main-' . $id);

        $this->add_render_attribute('preview-img', 'class', 'sa-el-preview-image-wrap');

        $this->add_render_attribute('preview-img', 'data-settings', wp_json_encode($prev_img_settings));

        if ($settings['sa_el_preview_image_link_switcher'] == 'yes') {
            $this->add_render_attribute('img-link', 'class', 'sa-el-preview-img-link');

            $this->add_render_attribute('img-link', 'href', $preview_img_url);

            if (!empty($settings['sa_el_preview_image_link']['is_external'])) {
                $this->add_render_attribute('img-link', 'target', '_blank');
            }

            if (!empty($settings['sa_el_preview_image_link']['nofollow'])) {
                $this->add_render_attribute('img-link', 'rel', 'nofollow');
            }
        }

        $this->add_render_attribute('tooltip', 'id', 'tooltip_content');

        $this->add_render_attribute('tooltip', 'class', ['sa-el-prev-img-tooltip-wrap', 'sa-el-prev-img-tooltip-wrap-' . $id]);
        ?>		

        <div <?php echo $this->get_render_attribute_string('preview-img'); ?>>
            <div class="sa-el-preview-image-trig-img-wrap">
                <div class="sa-el-preview-image-inner-trig-img" data-tooltip-content="#tooltip_content">
                    <?php if ($settings['sa_el_preview_image_link_switcher'] == 'yes') : ?>
                        <a <?php echo $this->get_render_attribute_string('img-link'); ?>>
                        <?php endif; ?>
                        <figure class="sa-el-preview-image-figure">
                            <img <?php echo $this->get_render_attribute_string('sa_el_preview_img_trigger'); ?>>
                            <?php if (!empty($settings['sa_el_preview_image_caption'])) : ?>
                                <figcaption <?php echo $this->get_render_attribute_string('sa_el_preview_image_caption'); ?>>
                                    <?php echo esc_html($settings['sa_el_preview_image_caption']); ?>
                                </figcaption>
                            <?php endif; ?>
                        </figure>
                        <?php if ($settings['sa_el_preview_image_link_switcher'] == 'yes') : ?>
                        </a>
                    <?php endif; ?>

                    <div <?php echo $this->get_render_attribute_string('tooltip'); ?>>
                        <?php if ($settings['sa_el_preview_image_content_selection'] == 'custom') : ?>
                            <?php if ($settings['sa_el_preview_image_img_switcher'] == 'yes') : ?>
                                <div <?php echo $this->get_render_attribute_string('tooltip-img-wrap'); ?>>
                                    <img <?php echo $this->get_render_attribute_string('tooltip-img'); ?>>
                                </div>
                            <?php endif; ?>

                            <?php if ($settings['sa_el_preview_image_title_switcher'] == 'yes' && !empty($settings['sa_el_preview_image_title'])) : ?>
                                <div <?php echo $this->get_render_attribute_string('tooltip-title'); ?>>
                                    <?php echo $title; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($settings['sa_el_preview_image_desc_switcher'] == 'yes' && !empty($settings['sa_el_preview_image_desc'])) : ?>
                                <div <?php echo $this->get_render_attribute_string('tooltip-desc'); ?>>
                                    <?php echo $settings['sa_el_preview_image_desc']; ?>
                                </div>
                            <?php endif; ?>
                            <?php
                        else:
                            echo $this->sa_el_get_template_content($template);
                            ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

}
