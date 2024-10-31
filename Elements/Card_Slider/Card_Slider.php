<?php

namespace SA_EL_ADDONS\Elements\Card_Slider;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;

class Card_Slider extends Widget_Base
{
    use \SA_EL_ADDONS\Helper\Elementor_Helper;
    use \SA_EL_ADDONS\Helper\Post_Query;

    public function get_name()
    {
        return 'sa_el_card_slider';
    }

    public function get_title()
    {
        return esc_html__('Card Slider', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-image-rollover oxi-el-admin-icon';
    }

    public function get_categories()
    {
        return ['sa-el-addons'];
    }

    public function get_script_depends()
    {
        return [
            'jquery-swiper',
        ];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_card',
            [
                'label'                 => __('Card Slider', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'source',
            [
                'label'                 => __('Source', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                    'custom'     => __('Custom', SA_EL_ADDONS_TEXTDOMAIN),
                    'posts'      => __('Posts', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'default'               => 'custom',
            ]
        );

        $this->add_control(
            'posts_count',
            [
                'label'                 => __('Posts Count', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::NUMBER,
                'default'               => 4,
                'condition'             => [
                    'source'    => 'posts'
                ]
            ]
        );

        $this->add_control(
            'link_type',
            [
                'label'                 => __('Link Type', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                    ''           => __('None', SA_EL_ADDONS_TEXTDOMAIN),
                    'title'      => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'image'      => __('Image', SA_EL_ADDONS_TEXTDOMAIN),
                    'button'     => __('Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'box'        => __('Box', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'default'               => '',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'                 => __('Button Text', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::TEXT,
                'label_block'           => false,
                'default'               => __('Read More', SA_EL_ADDONS_TEXTDOMAIN),
                'condition'             => [
                    'link_type'     => 'button',
                ]
            ]
        );

        $this->add_control(
            'date',
            [
                'label'                 => __('Date', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'return_value'          => 'yes',
                'frontend_available'    => true,
            ]
        );

        $this->add_control(
            'date_icon',
            [
                'label'                 => __('Date Icon', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::ICON,
                'default'               => 'fa fa-calendar',
                'condition'             => [
                    'date'      => 'yes'
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('card_items_tabs');

        $repeater->start_controls_tab('tab_card_items_content', ['label' => __('Content', SA_EL_ADDONS_TEXTDOMAIN)]);

        $repeater->add_control(
            'card_date',
            [
                'label'             => __('Date', SA_EL_ADDONS_TEXTDOMAIN),
                'type'              => Controls_Manager::TEXT,
                'label_block'       => false,
                'default'           => __('1 June 2018', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $repeater->add_control(
            'card_title',
            [
                'label'             => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                'type'              => Controls_Manager::TEXT,
                'label_block'       => false,
                'default'           => '',
            ]
        );

        $repeater->add_control(
            'card_content',
            [
                'label'             => __('Content', SA_EL_ADDONS_TEXTDOMAIN),
                'type'              => Controls_Manager::WYSIWYG,
                'default'           => '',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'                 => __('Link', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::URL,
                'dynamic'               => [
                    'active'        => true,
                    'categories'    => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY
                    ],
                ],
                'placeholder'           => 'https://www.your-link.com',
                'default'               => [
                    'url' => '',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab('tab_card_items_image', ['label' => __('Image', SA_EL_ADDONS_TEXTDOMAIN)]);

        $repeater->add_control(
            'card_image',
            [
                'label'                 => __('Show Image', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                'label_off'             => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                'return_value'          => 'yes',
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label'                 => __('Choose Image', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => \Elementor\Controls_Manager::MEDIA,
                'default'               => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'conditions'            => [
                    'terms' => [
                        [
                            'name'      => 'card_image',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'                  => 'image',
                'exclude'               => ['custom'],
                'include'               => [],
                'default'               => 'large',
                'conditions'            => [
                    'terms' => [
                        [
                            'name'      => 'card_image',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'items',
            [
                'label'                 => '',
                'type'                  => Controls_Manager::REPEATER,
                'default'               => [
                    [
                        'card_date'    => __('1 May 2018', SA_EL_ADDONS_TEXTDOMAIN),
                        'card_title'   => __('Card Slider Item 1', SA_EL_ADDONS_TEXTDOMAIN),
                        'card_content' => __('I am card slider Item content. Click here to edit this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    [
                        'card_date'    => __('1 June 2018', SA_EL_ADDONS_TEXTDOMAIN),
                        'card_title'   => __('Card Slider Item 2', SA_EL_ADDONS_TEXTDOMAIN),
                        'card_content' => __('I am card slider Item content. Click here to edit this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    [
                        'card_date'    => __('1 July 2018', SA_EL_ADDONS_TEXTDOMAIN),
                        'card_title'   => __('Card Slider Item 3', SA_EL_ADDONS_TEXTDOMAIN),
                        'card_content' => __('I am card slider Item content. Click here to edit this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    [
                        'card_date'    => __('1 August 2018', SA_EL_ADDONS_TEXTDOMAIN),
                        'card_title'   => __('Card Slider Item 4', SA_EL_ADDONS_TEXTDOMAIN),
                        'card_content' => __('I am card slider Item content. Click here to edit this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ],
                'fields'                => array_values($repeater->get_controls()),
                'title_field'           => '{{{ card_date }}}',
                'condition'             => [
                    'source'    => 'custom'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Content Tab: Query
         */
        $this->start_controls_section(
            'section_post_query',
            [
                'label'                 => __('Query', SA_EL_ADDONS_TEXTDOMAIN),
                'condition'             => [
                    'source'    => 'posts'
                ]
            ]
        );

        $this->sa_el_query_controls();

        $this->end_controls_section();

        /**
         * Content Tab: Posts
         */
        $this->start_controls_section(
            'section_posts',
            [
                'label'                 => __('Posts', SA_EL_ADDONS_TEXTDOMAIN),
                'condition'             => [
                    'source'    => 'posts'
                ]
            ]
        );

        $this->sa_el_layout_controls();

        $this->end_controls_section();

        /**
         * Content Tab: Additional Options
         */
        $this->start_controls_section(
            'section_additional_options',
            [
                'label'                 => __('Additional Options', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'slider_speed',
            [
                'label'                 => __('Slider Speed', SA_EL_ADDONS_TEXTDOMAIN),
                'description'           => __('Duration of transition between slides (in ms)', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => ['size' => 400],
                'range'                 => [
                    'px' => [
                        'min'   => 100,
                        'max'   => 3000,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'                 => __('Autoplay', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                'label_off'             => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                'return_value'          => 'yes',
                'separator'             => 'before',
                'frontend_available'    => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'                 => __('Autoplay Speed', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::NUMBER,
                'default'               => 2000,
                'min'                   => 500,
                'max'                   => 5000,
                'step'                  => 1,
                'frontend_available'    => true,
                'condition'             => [
                    'autoplay'      => 'yes',
                ]
            ]
        );

        $this->add_control(
            'loop',
            [
                'label'                 => __('Infinite Loop', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                'label_off'             => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                'return_value'          => 'yes',
                'frontend_available'    => true,
            ]
        );

        $this->add_control(
            'grab_cursor',
            [
                'label'                 => __('Grab Cursor', SA_EL_ADDONS_TEXTDOMAIN),
                'description'           => __('Shows grab cursor when you hover over the slider', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => '',
                'label_on'              => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                'label_off'             => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                'return_value'          => 'yes',
                'separator'             => 'before',
                'frontend_available'    => true,
            ]
        );

        $this->add_control(
            'navigation_heading',
            [
                'label'                 => __('Navigation', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label'                 => __('Pagination', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                'label_off'             => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                'return_value'          => 'yes',
                'frontend_available'    => true,
            ]
        );

        $this->add_control(
            'pagination_type',
            [
                'label'                 => __('Pagination Type', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'bullets',
                'options'               => [
                    'bullets'       => __('Dots', SA_EL_ADDONS_TEXTDOMAIN),
                    'fraction'      => __('Fraction', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'frontend_available'    => true,
                'condition'             => [
                    'pagination'        => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();
        /*-----------------------------------------------------------------------------------*/
        /*	STYLE TAB
        /*-----------------------------------------------------------------------------------*/

        /**
         * Style Tab: Card
         */
        $this->start_controls_section(
            'section_card_style',
            [
                'label'                 => __('Card', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'card_max_width',
            [
                'label'                 => __('Max Width', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 200,
                        'max'   => 1600,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => ['px', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_margin',
            [
                'label'                 => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label'                 => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_text_align',
            [
                'label'                 => __('Text Align', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::CHOOSE,
                'options'               => [
                    'left'     => [
                        'title'     => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon'         => 'fa fa-align-left',
                    ],
                    'center'         => [
                        'title'     => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon'         => 'fa fa-align-center',
                    ],
                    'right'         => [
                        'title'     => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon'         => 'fa fa-align-right',
                    ],
                ],
                'default'               => 'left',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('card_tabs');

        $this->start_controls_tab('tab_card_normal', ['label' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN)]);

        $this->add_control(
            'card_bg',
            [
                'label'                 => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'card_border',
                'label'                 => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .sa-el-card-slider',
            ]
        );

        $this->add_control(
            'card_border_radius',
            [
                'label'                 => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'                  => 'card_box_shadow',
                'selector'              => '{{WRAPPER}} .sa-el-card-slider',
            ]
        );

        $this->add_control(
            'heading_title',
            [
                'label'                 => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'title_text_color',
            [
                'label'                 => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'title_typography',
                'label'                 => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'selector'              => '{{WRAPPER}} .sa-el-card-slider-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin_bottom',
            [
                'label'                 => __('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => ['px'],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_date',
            [
                'label'                 => __('Date', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
                'condition'             => [
                    'date'     => 'yes',
                ],
            ]
        );

        $this->add_control(
            'date_color',
            [
                'label'                 => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-date' => 'color: {{VALUE}}',
                ],
                'condition'             => [
                    'date'     => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'date_typography',
                'label'                 => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'selector'              => '{{WRAPPER}} .sa-el-card-slider-date',
                'condition'             => [
                    'date'     => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'date_margin_bottom',
            [
                'label'                 => __('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => ['px'],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-date' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition'             => [
                    'date'     => 'yes',
                ],
            ]
        );

        $this->add_control(
            'heading_content',
            [
                'label'                 => __('Content', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'card_text_color',
            [
                'label'                 => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'card_text_typography',
                'label'                 => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'selector'              => '{{WRAPPER}} .sa-el-card-slider-content',
            ]
        );

        $this->add_control(
            'heading_meta',
            [
                'label'                 => __('Post Meta', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
                'condition'             => [
                    'source'       => 'posts',
                    'post_meta'    => 'yes',
                ],
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label'                 => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-meta' => 'color: {{VALUE}}',
                ],
                'condition'             => [
                    'source'       => 'posts',
                    'post_meta'    => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'meta_typography',
                'label'                 => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'selector'              => '{{WRAPPER}} .sa-el-card-slider-meta',
                'condition'             => [
                    'source'       => 'posts',
                    'post_meta'    => 'yes',
                ],
            ]
        );

        $this->add_control(
            'meta_spacing',
            [
                'label'                 => __('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'         => '',
                ],
                'range'                 => [
                    'px'         => [
                        'min'     => 0,
                        'max'     => 100,
                    ],
                ],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-meta'     => 'margin-bottom: {{SIZE}}px;'
                ],
                'condition'             => [
                    'source'       => 'posts',
                    'post_meta'    => 'yes',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('tab_card_hover', ['label' => __('Hover', SA_EL_ADDONS_TEXTDOMAIN)]);

        $this->add_control(
            'card_bg_hover',
            [
                'label'                 => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'card_border_color_hover',
            [
                'label'                 => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'card_title_color_hover',
            [
                'label'                 => __('Title Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider:hover .sa-el-card-slider-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'card_color_hover',
            [
                'label'                 => __('Content Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider:hover .sa-el-card-slider-content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'meta_color_hover',
            [
                'label'                 => __('Post Meta Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider:hover .sa-el-card-slider-meta' => 'color: {{VALUE}}',
                ],
                'condition'             => [
                    'source'       => 'posts',
                    'post_meta'    => 'yes',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Style Tab: Image
         */
        $this->start_controls_section(
            'section_image_style',
            [
                'label'                 => __('Image', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_direction',
            [
                'label'                 => __('Direction', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::CHOOSE,
                'label_block'           => false,
                'toggle'                => false,
                'default'               => 'left',
                'options'               => [
                    'left'         => [
                        'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon'     => 'eicon-h-align-left',
                    ],
                    'right'     => [
                        'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon'     => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class'          => 'sa-el-card-slider-image-',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'image_border',
                'label'                 => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .sa-el-card-slider-image',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'                 => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-image, {{WRAPPER}} .sa-el-card-slider-image:after, {{WRAPPER}} .sa-el-card-slider-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label'                 => __('Width', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 500,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => ['px', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label'                 => __('Height', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 500,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => ['px', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'                 => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', '%'],
                'placeholder'           => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                ],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-image' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'                  => 'image_box_shadow',
                'selector'              => '{{WRAPPER}} .sa-el-card-slider-image',
            ]
        );

        $this->add_control(
            'image_overlay_heading',
            [
                'label'                 => __('Overlay', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'                  => 'image_overlay',
                'label'                 => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                'types'                 => ['classic', 'gradient'],
                'selector'              => '{{WRAPPER}} .sa-el-card-slider-image:after',
                'exclude'               => ['image'],
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Button
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_info_box_button_style',
            [
                'label'                 => __('Button', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'                   => Controls_Manager::TAB_STYLE,
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->add_control(
            'button_spacing',
            [
                'label'                 => __('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'         => 20,
                ],
                'range'         => [
                    'px'         => [
                        'min'     => 0,
                        'max'     => 60,
                    ],
                ],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-button-wrap' => 'margin-top: {{SIZE}}px;',
                ],
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label'                 => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'sm',
                'options'               => [
                    'xs' => __('Extra Small', SA_EL_ADDONS_TEXTDOMAIN),
                    'sm' => __('Small', SA_EL_ADDONS_TEXTDOMAIN),
                    'md' => __('Medium', SA_EL_ADDONS_TEXTDOMAIN),
                    'lg' => __('Large', SA_EL_ADDONS_TEXTDOMAIN),
                    'xl' => __('Extra Large', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label'                 => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_normal',
            [
                'label'                 => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-button' => 'background-color: {{VALUE}}',
                ],
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_normal',
            [
                'label'                 => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-button' => 'color: {{VALUE}}',
                ],
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'button_border_normal',
                'label'                 => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .sa-el-card-slider-button',
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label'                 => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'button_typography',
                'label'                 => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .sa-el-card-slider-button',
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'                 => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', 'em', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'                  => 'button_box_shadow',
                'selector'              => '{{WRAPPER}} .sa-el-card-slider-button',
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->add_control(
            'info_box_button_icon_heading',
            [
                'label'                 => __('Button Icon', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
                'condition'             => [
                    'link_type'    => 'button',
                    'button_icon!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_icon_margin',
            [
                'label'                 => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', '%'],
                'placeholder'           => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                ],
                'condition'             => [
                    'link_type'    => 'button',
                    'button_icon!' => '',
                ],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider .sa-el-button-icon' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label'                 => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label'                 => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-button:hover' => 'background-color: {{VALUE}}',
                ],
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'                 => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-button:hover' => 'color: {{VALUE}}',
                ],
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label'                 => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider-button:hover' => 'border-color: {{VALUE}}',
                ],
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->add_control(
            'button_animation',
            [
                'label'                 => __('Animation', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::HOVER_ANIMATION,
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'                  => 'button_box_shadow_hover',
                'selector'              => '{{WRAPPER}} .sa-el-card-slider-button:hover',
                'condition'             => [
                    'link_type'    => 'button',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Style Tab: Dots
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_dots_style',
            [
                'label'                 => __('Dots', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'                   => Controls_Manager::TAB_STYLE,
                'condition'             => [
                    'pagination'        => 'yes',
                    'pagination_type'   => 'bullets'
                ],
            ]
        );

        $this->add_control(
            'dots_position',
            [
                'label'                 => __('Position', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                    'aside'      => __('Aside', SA_EL_ADDONS_TEXTDOMAIN),
                    'bottom'     => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'default'               => 'aside',
                'prefix_class'          => 'sa-el-card-slider-dots-',
            ]
        );

        $this->add_responsive_control(
            'dots_margin',
            [
                'label'                 => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', '%'],
                'placeholder'           => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                ],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider .swiper-pagination' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_spacing',
            [
                'label'                 => __('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
                'selectors'             => [
                    '(desktop){{WRAPPER}}.sa-el-card-slider-dots-aside .swiper-pagination-bullets .swiper-pagination-bullet' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}}',
                    '(desktop){{WRAPPER}}.sa-el-card-slider-dots-bottom .swiper-pagination-bullets .swiper-pagination-bullet' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}}',
                    '(tablet){{WRAPPER}}.sa-el-card-slider-dots-aside .swiper-pagination-bullets .swiper-pagination-bullet' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}}',
                    '(tablet){{WRAPPER}}.sa-el-card-slider-dots-bottom .swiper-pagination-bullets .swiper-pagination-bullet' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}}',
                    '(mobile){{WRAPPER}}.sa-el-card-slider-dots-aside .swiper-pagination-bullets .swiper-pagination-bullet' => 'margin-top: 0; margin-bottom: 0; margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}}',
                    '(mobile){{WRAPPER}}.sa-el-card-slider-dots-bottom .swiper-pagination-bullets .swiper-pagination-bullet' => 'margin-top: 0; margin-bottom: 0; margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'pagination'        => 'yes',
                    'pagination_type'   => 'bullets'
                ],
            ]
        );

        $this->start_controls_tabs('tabs_dots_style');

        $this->start_controls_tab(
            'tab_dots_normal',
            [
                'label'                 => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                'condition'             => [
                    'pagination'        => 'yes',
                    'pagination_type'   => 'bullets'
                ],
            ]
        );

        $this->add_control(
            'dots_color_normal',
            [
                'label'                 => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider .swiper-pagination-bullet' => 'background: {{VALUE}};',
                ],
                'condition'             => [
                    'pagination'        => 'yes',
                    'pagination_type'   => 'bullets'
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_width',
            [
                'label'                 => __('Width', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 2,
                        'max'   => 40,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'             => [
                    'pagination'        => 'yes',
                    'pagination_type'   => 'bullets'
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_height',
            [
                'label'                 => __('Height', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 2,
                        'max'   => 40,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'             => [
                    'pagination'        => 'yes',
                    'pagination_type'   => 'bullets'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'dots_border_normal',
                'label'                 => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .sa-el-card-slider .swiper-pagination-bullet',
                'condition'             => [
                    'pagination'        => 'yes',
                    'pagination_type'   => 'bullets'
                ],
            ]
        );

        $this->add_control(
            'dots_border_radius_normal',
            [
                'label'                 => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'             => [
                    'pagination'        => 'yes',
                    'pagination_type'   => 'bullets'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dots_hover',
            [
                'label'                 => __('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                'condition'             => [
                    'pagination'        => 'yes',
                    'pagination_type'   => 'bullets'
                ],
            ]
        );

        $this->add_control(
            'dots_color_hover',
            [
                'label'                 => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider .swiper-pagination-bullet:hover' => 'background: {{VALUE}};',
                ],
                'condition'             => [
                    'pagination'        => 'yes',
                    'pagination_type'   => 'bullets'
                ],
            ]
        );

        $this->add_control(
            'dots_border_color_hover',
            [
                'label'                 => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider .swiper-pagination-bullet:hover' => 'border-color: {{VALUE}};',
                ],
                'condition'             => [
                    'pagination'        => 'yes',
                    'pagination_type'   => 'bullets'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dots_active',
            [
                'label'                 => __('Active', SA_EL_ADDONS_TEXTDOMAIN),
                'condition'             => [
                    'pagination'        => 'yes',
                    'pagination_type'   => 'bullets'
                ],
            ]
        );

        $this->add_control(
            'dot_color_active',
            [
                'label'                 => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
                ],
                'condition'             => [
                    'pagination'        => 'yes',
                    'pagination_type'   => 'bullets'
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_width_active',
            [
                'label'                 => __('Width', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 2,
                        'max'   => 40,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'             => [
                    'pagination'        => 'yes',
                    'pagination_type'   => 'bullets'
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_height_active',
            [
                'label'                 => __('Height', SA_EL_ADDONS_TEXTDOMAIN),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 2,
                        'max'   => 40,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
                'selectors'             => [
                    '{{WRAPPER}} .sa-el-card-slider .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'             => [
                    'pagination'        => 'yes',
                    'pagination_type'   => 'bullets'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();


        $this->add_render_attribute('card-slider', 'class', 'sa-el-card-slider');

        if ($settings['image_direction']) {
            $this->add_render_attribute('card-slider', 'class', 'sa-el-card-slider-image-' . $settings['image_direction']);
        }
        ?>

        <div class="sa-el-card-slider-wrapper">
            <div class="sa-el-card-slider">
                <div class="swiper-wrapper">
                    <?php
                            if ($settings['source'] == 'posts') {
                                $this->sa_el_render_source_posts();
                            } elseif ($settings['source'] == 'custom') {
                                $this->sa_el_render_source_custom();
                            }
                            ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <?php
            }

            /**
             * Render custom content output on the frontend.
             *
             * Written in PHP and used to generate the final HTML.
             *
             * @access protected
             */
            protected function sa_el_render_source_custom()
            {
                $settings = $this->get_settings();

                $i = 1;

                foreach ($settings['items'] as $index => $item) {

                    $item_key       = $this->get_repeater_setting_key('item', 'items', $index);
                    $title_key      = $this->get_repeater_setting_key('card_title', 'items', $index);
                    $content_key    = $this->get_repeater_setting_key('card_content', 'items', $index);


                    $this->add_render_attribute($item_key, 'class', [
                        'sa-el-card-slider-item',
                        'swiper-slide',
                        'elementor-repeater-item-' . esc_attr($item['_id'])
                    ]);

                    $this->add_render_attribute($title_key, 'class', 'sa-el-card-slider-title');

                    $this->add_render_attribute($content_key, 'class', 'sa-el-card-slider-content');
                    ?>
            <div <?php echo $this->get_render_attribute_string($item_key); ?>>
                <?php if ($settings['link_type'] == 'box' && $item['link']['url']) { ?>
                    <?php
                                    $box_link_key = 'card-slider-box-link-' . $i;

                                    $this->add_render_attribute(
                                        $box_link_key,
                                        [
                                            'class' => 'sa-el-card-slider-box-link',
                                            'href'  => $item['link']['url'],
                                        ]
                                    );

                                    if ($item['link']['is_external']) {
                                        $this->add_render_attribute($box_link_key, 'target', '_blank');
                                    }

                                    if ($item['link']['nofollow']) {
                                        $this->add_render_attribute($box_link_key, 'rel', 'nofollow');
                                    }
                                    ?>
                    <a <?php echo $this->get_render_attribute_string($box_link_key); ?>></a>
                <?php } ?>
                <?php if ($item['card_image'] == 'yes' && !empty($item['image']['url'])) { ?>
                    <div class="sa-el-card-slider-image">
                        <?php
                                        if ($settings['link_type'] == 'image' && $item['link']['url']) {
                                            printf('<a href="%1$s"></a>%2$s', $item['link']['url'], Group_Control_Image_Size::get_attachment_image_html($item));
                                        } else {
                                            echo Group_Control_Image_Size::get_attachment_image_html($item);
                                        }
                                        ?>
                    </div>
                <?php } ?>
                <div class="sa-el-card-slider-content-wrap">
                    <?php if ($settings['date'] == 'yes') { ?>
                        <div class="sa-el-card-slider-date">
                            <?php if ($settings['date_icon']) { ?>
                                <span class="sa-el-card-slider-meta-icon <?php echo $settings['date_icon']; ?>"></span>
                            <?php } ?>
                            <span class="sa-el-card-slider-meta-text">
                                <?php
                                                echo $item['card_date'];
                                                ?>
                            </span>
                        </div>
                    <?php } ?>
                    <?php if ($item['card_title'] != '') { ?>
                        <h2 <?php echo $this->get_render_attribute_string($title_key); ?>>
                            <?php
                                            if ($settings['link_type'] == 'title' && $item['link']['url']) {
                                                printf('<a href="%1$s">%2$s</a>', $item['link']['url'], $item['card_title']);
                                            } else {
                                                echo $item['card_title'];
                                            }
                                            ?>
                        </h2>
                    <?php } ?>
                    <?php if ($item['card_content'] != '') { ?>
                        <div <?php echo $this->get_render_attribute_string($content_key); ?>>
                            <?php
                                            echo $this->parse_text_editor($item['card_content']);
                                            ?>
                        </div>
                    <?php } ?>
                    <?php if ($settings['link_type'] == 'button' && $settings['button_text']) { ?>
                        <?php
                                        if (!empty($item['link']['url'])) {

                                            $button_key = $this->get_repeater_setting_key('button', 'items', $index);

                                            $this->add_render_attribute($button_key, 'href', esc_url($item['link']['url']));

                                            if ($item['link']['is_external']) {
                                                $this->add_render_attribute($button_key, 'target', '_blank');
                                            }

                                            if ($item['link']['nofollow']) {
                                                $this->add_render_attribute($button_key, 'rel', 'nofollow');
                                            }

                                            $this->add_render_attribute(
                                                $button_key,
                                                'class',
                                                [
                                                    'sa-el-card-slider-button',
                                                    'elementor-button',
                                                    'elementor-size-' . $settings['button_size'],
                                                ]
                                            );
                                            ?>
                            <div class="sa-el-card-slider-button-wrap">
                                <a <?php echo $this->get_render_attribute_string($button_key); ?> href="<?php the_permalink() ?>">
                                    <span class="sa-el-card-slider-button-text">
                                        <?php echo esc_attr($settings['button_text']); ?>
                                    </span>
                                </a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <?php
                        $i++;
                    }
                }
                /**
                 * Render posts output on the frontend.
                 *
                 * Written in PHP and used to generate the final HTML.
                 *
                 * @access protected
                 */
                protected function sa_el_render_source_posts()
                {
                    $settings = $this->get_settings();
                    // Query Arguments
                    $args = $this->query_args($settings);
                    $posts_query = new \WP_Query($args);
                    $i = 1;
                    $settings = [
                        'date' => $settings['date'],
                        'date_icon' => $settings['date_icon'],
                        'link_type' => $settings['link_type'],
                        'button_text' => $settings['button_text'],
                        'button_size' => $settings['button_size'],
                        'sa_el_show_image' => $settings['sa_el_show_image'],
                        'image_size' => $settings['image_size'],
                        'sa_el_show_title' => $settings['sa_el_show_title'],
                        'sa_el_show_excerpt' => $settings['sa_el_show_excerpt'],
                        'sa_el_show_meta' => $settings['sa_el_show_meta'],
                        'expanison_indicator' => $settings['excerpt_expanison_indicator'],
                        'sa_el_excerpt_length' => intval($settings['sa_el_excerpt_length'], 10),
                        'sa_el_post_author' => $settings['sa_el_post_author'],
                        'sa_el_author_icon' => $settings['sa_el_author_icon'],
                        'sa_el_post_category' => $settings['sa_el_post_category'],
                        'sa_el_category_icon' => $settings['sa_el_category_icon'],
                    ];
                    if ($posts_query->have_posts()) : while ($posts_query->have_posts()) : $posts_query->the_post();

                            $item_key = 'card-slider-item' . $i;

                            if (has_post_thumbnail()) {
                                $image_id = get_post_thumbnail_id(get_the_ID());
                                $pp_thumb_url = wp_get_attachment_image_url(get_post_thumbnail_id(), $settings['image_size']);
                            } else {
                                $pp_thumb_url = '';
                            }

                            $this->add_render_attribute($item_key, 'class', [
                                'sa-el-card-slider-item',
                                'swiper-slide',
                                'sa-el-card-slider-item-' . intval($i)
                            ]);
                            ?>
                <div <?php echo $this->get_render_attribute_string($item_key); ?>>
                    <?php if ($settings['link_type'] == 'box') { ?>
                        <?php
                                            $box_link_key = 'card-slider-box-link-' . $i;

                                            $this->add_render_attribute(
                                                $box_link_key,
                                                [
                                                    'class' => 'sa-el-card-slider-box-link',
                                                    'href'  => get_permalink(),
                                                ]
                                            );
                                            ?>
                        <a <?php echo $this->get_render_attribute_string($box_link_key); ?>></a>
                    <?php } ?>
                    <?php if ($settings['sa_el_show_image'] == '1' && $pp_thumb_url) { ?>
                        <div class="sa-el-card-slider-image">
                            <?php
                                                if ($settings['link_type'] == 'image') {
                                                    printf('<a href="%1$s"></a>%2$s', get_permalink(), '<img src="' . esc_url($pp_thumb_url) . '">');
                                                } else {
                                                    echo '<img src="' . esc_url($pp_thumb_url) . '">';
                                                }
                                                ?>
                        </div>
                    <?php } ?>
                    <div class="sa-el-card-slider-content-wrap">
                        <?php if ($settings['date'] == 'yes') { ?>
                            <div class="sa-el-card-slider-date">
                                <?php if ($settings['date_icon']) { ?>
                                    <span class="sa-el-card-slider-meta-icon <?php echo $settings['date_icon']; ?>"></span>
                                <?php } ?>
                                <span class="sa-el-card-slider-meta-text">
                                    <?php
                                                        echo get_the_date();
                                                        ?>
                                </span>
                            </div>
                        <?php } ?>
                        <?php if ($settings['sa_el_show_title'] == '1') { ?>
                            <h2 class="sa-el-card-slider-title">
                                <?php
                                                    if ($settings['link_type'] == 'title') {
                                                        printf('<a href="%1$s">%2$s</a>', get_permalink(), get_the_title());
                                                    } else {
                                                        the_title();
                                                    }
                                                    ?>
                            </h2>
                        <?php } ?>
                        <?php if ($settings['sa_el_show_meta'] == '1') { ?>
                            <div class="sa-el-card-slider-meta">
                                
                            <?php if ( $settings['sa_el_post_author'] == '1' ) { ?>
                                <span class="sa-el-content-author">
                                    <?php if ( $settings['sa_el_author_icon'] ) { ?>
                                        <span class="sa-el-card-slider-meta-icon <?php echo $settings['sa_el_author_icon']; ?>"></span>
                                    <?php } ?>
                                    <span class="sa-el-card-slider-meta-text">
                                        <?php echo get_the_author(); ?>
                                    </span>
                                </span>
                            <?php } ?> 
                                
                                
                                    <?php if ( $settings['sa_el_post_category'] == '1' ) { ?>
                                <span class="sa-el-post-category">
                                    <?php if ( $settings['sa_el_category_icon'] ) { ?>
                                        <span class="sa-el-card-slider-meta-icon <?php echo $settings['sa_el_category_icon']; ?>"></span>
                                    <?php } ?>
                                    <span class="sa-el-card-slider-meta-text">
                                        <?php
                                            $category = get_the_category();
                                            if ( $category ) {
                                                echo esc_attr( $category[0]->name );
                                            }
                                        ?>
                                    </span>
                                </span>
                            <?php } ?> 
                               
                            </div>
                        <?php } ?>
                        <?php if ($settings['sa_el_show_excerpt'] == '1') { ?>
                            <div class="sa-el-card-slider-content">
                                <?php
                                                    echo implode(" ", array_slice(explode(" ", strip_tags(strip_shortcodes(get_the_excerpt() ? get_the_excerpt() : get_the_content()))), 0, $settings['sa_el_excerpt_length'])) . $settings['expanison_indicator'];
                                                    ?>
                            </div>
                        <?php } ?>
                        <?php if ($settings['link_type'] == 'button' && $settings['button_text']) { ?>
                            <?php
                                                $button_key = 'card-slider-button' . $i;

                                                $this->add_render_attribute(
                                                    $button_key,
                                                    'class',
                                                    [
                                                        'sa-el-card-slider-button',
                                                        'elementor-button',
                                                        'elementor-size-' . $settings['button_size'],
                                                    ]
                                                );
                                                ?>
                            <div class="sa-el-card-slider-button-wrap">
                                <a <?php echo $this->get_render_attribute_string($button_key); ?> href="<?php the_permalink() ?>">
                                    <span class="sa-el-card-slider-button-text">
                                        <?php echo esc_attr($settings['button_text']); ?>
                                    </span>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
<?php
                $i++;
            endwhile;
        endif;
        wp_reset_query();
    }
    protected function get_posts_query_arguments()
    {
        $settings = $this->get_settings();
        $pp_posts_count = absint($settings['posts_count']);

        // Post Authors
        $pp_tiled_post_author = '';
        $pp_tiled_post_authors = $settings['authors'];
        if (!empty($pp_tiled_post_authors)) {
            $pp_tiled_post_author = implode(",", $pp_tiled_post_authors);
        }

        // Post Categories
        $pp_tiled_post_cat = '';
        $pp_tiled_post_cats = $settings['categories'];
        if (!empty($pp_tiled_post_cats)) {
            $pp_tiled_post_cat = implode(",", $pp_tiled_post_cats);
        }

        // Query Arguments
        $args = array(
            'post_status'           => array('publish'),
            'post_type'             => $settings['post_type'],
            'post__in'              => '',
            'cat'                   => $pp_tiled_post_cat,
            'author'                => $pp_tiled_post_author,
            'tag__in'               => $settings['tags'],
            'orderby'               => $settings['orderby'],
            'order'                 => $settings['order'],
            'post__not_in'          => $settings['exclude_posts'],
            'offset'                => $settings['offset'],
            'ignore_sticky_posts'   => 1,
            'showposts'             => $pp_posts_count
        );

        return $args;
    }
}
