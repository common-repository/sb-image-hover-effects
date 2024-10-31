<?php

namespace SA_EL_ADDONS\Elements\Easy_Digital_Downloads;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class Easy_Digital_Downloads extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa-el-easy-digital-downloads';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Easy Digital Downloads', SA_EL_ADDONS_TEXTDOMAIN);
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-file-download oxi-el-admin-icon';
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'section_edd_layout',
                [
                    'label' => esc_html__('Layout', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );
        if (!class_exists('Easy_Digital_Downloads')) {
            $this->add_control(
                    'Easy_Digital_Downloads_missing_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => sprintf(
                                __('Hi, it seems %1$s is missing in your site. Please install and activate %1$s first.', SA_EL_ADDONS_TEXTDOMAIN),
                                '<a href="https://wordpress.org/plugins/easy-digital-downloads/" target="_blank" rel="noopener">Easy Digital Downloads</a>'
                        ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    ]
            );
            $this->end_controls_section();
            return;
        }

        $this->add_control(
                'columns',
                [
                    'label' => esc_html__('Columns', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                    ],
                    'default' => '3',
                ]
        );

        $this->add_control(
                'item_gap',
                [
                    'label' => esc_html__('Item Gap', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 10,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list' => 'margin: -{{SIZE}}px -{{SIZE}}px 0',
                        '(desktop){{WRAPPER}} .edd_downloads_list .edd_download' => 'width: calc( 100% / {{columns.SIZE}} ); border: {{SIZE}}px solid transparent',
                        '(tablet){{WRAPPER}} .edd_downloads_list .edd_download' => 'width: calc( 100% / 2 ); border: {{SIZE}}px solid transparent',
                        '(mobile){{WRAPPER}} .edd_downloads_list .edd_download' => 'width: calc( 100% / 1 ); border: {{SIZE}}px solid transparent',
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner' => 'margin: 0;',
                    ],
                    'frontend_available' => true,
                ]
        );


        $this->add_control(
                'number',
                [
                    'label' => esc_html__('Categories Count', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '4',
                ]
        );

        $this->add_control(
                'edd_thumbnail_show',
                [
                    'label' => esc_html__('Show Thumbnail', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'edd_excerpt_show',
                [
                    'label' => esc_html__('Show Excerpt', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'edd_price_show',
                [
                    'label' => esc_html__('Show Price', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'edd_buy_button',
                [
                    'label' => esc_html__('Show Buy Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'edd_pagination_show',
                [
                    'label' => esc_html__('Show Pagination', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_filter',
                [
                    'label' => esc_html__('Query', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'source',
                [
                    'label' => _x('Source', 'Posts Query Control', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '' => esc_html__('Show All', SA_EL_ADDONS_TEXTDOMAIN),
                        'by_id' => esc_html__('Manual Selection', SA_EL_ADDONS_TEXTDOMAIN),
                        'by_parent' => esc_html__('By Parent', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $categories = get_terms('download_category');

        $options = [];
        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }

        $this->add_control(
                'categories',
                [
                    'label' => esc_html__('Categories', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT2,
                    'options' => $options,
                    'default' => [],
                    'label_block' => true,
                    'multiple' => true,
                    'condition' => [
                        'source' => 'by_id',
                    ],
                ]
        );

        $parent_options = ['0' => esc_html__('Only Top Level', SA_EL_ADDONS_TEXTDOMAIN)] + $options;

        $this->add_control(
                'parent',
                [
                    'label' => esc_html__('Parent', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => '0',
                    'options' => $parent_options,
                    'condition' => [
                        'source' => 'by_parent',
                    ],
                ]
        );

        $this->add_control(
                'hide_empty',
                [
                    'label' => esc_html__('Hide Empty', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                ]
        );

        $this->add_control(
                'orderby',
                [
                    'label' => esc_html__('Order by', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'name',
                    'options' => [
                        'name' => esc_html__('Name', SA_EL_ADDONS_TEXTDOMAIN),
                        'slug' => esc_html__('Slug', SA_EL_ADDONS_TEXTDOMAIN),
                        'description' => esc_html__('Description', SA_EL_ADDONS_TEXTDOMAIN),
                        'count' => esc_html__('Count', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'order',
                [
                    'label' => esc_html__('Order', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'desc',
                    'options' => [
                        'asc' => esc_html__('ASC', SA_EL_ADDONS_TEXTDOMAIN),
                        'desc' => esc_html__('DESC', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();
        $this->start_controls_section(
                'section_style_item',
                [
                    'label' => esc_html__('Item', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'item_bg_color',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => 'RGB(244,244,244)',
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'item_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'item_border',
                    'label' => esc_html__('Item Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner',
                    'separator' => 'before',
                ]
        );

        $this->add_responsive_control(
                'item_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'item_box_shadow',
                    'exclude' => [
                        'box_shadow_position',
                    ],
                    'selector' => '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner',
                ]
        );

        $this->add_control(
                'edd_item_alignment',
                [
                    'label' => esc_html__('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
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
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner' => 'text-align: {{VALUE}}',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_image',
                [
                    'label' => esc_html__('Image', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => ['edd_thumbnail_show' => 'yes'],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'image_border',
                    'label' => esc_html__('Image Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_download_image img',
                ]
        );

        $this->add_responsive_control(
                'image_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_download_image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'image_box_shadow',
                    'exclude' => [
                        'box_shadow_position',
                    ],
                    'selector' => '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_download_image img',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_description',
                [
                    'label' => esc_html__('Description', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'heading_style_title',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__('Title', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'title_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_download_title a' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'hover_title_color',
                [
                    'label' => esc_html__('Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_download_title a:hover' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_download_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_download_title a',
                ]
        );

        $this->add_control(
                'edd_excerpt_heading',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__('Excerpt', SA_EL_ADDONS_TEXTDOMAIN),
                    'separator' => 'before',
                    'condition' => ['edd_excerpt_show' => 'yes'],
                ]
        );

        $this->add_control(
                'eddexcerpt_color',
                [
                    'label' => esc_html__('Excerpt Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_download_excerpt' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                    'condition' => ['edd_excerpt_show' => 'yes'],
                ]
        );

        $this->add_responsive_control(
                'edd_excerpt_margin',
                [
                    'label' => esc_html__('Excerpt Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_download_excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => ['edd_excerpt_show' => 'yes'],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'edd_excerpt_typography',
                    'label' => esc_html__('Excerpt Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_download_excerpt',
                ]
        );

        $this->add_control(
                'heading_style_price',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__('Price', SA_EL_ADDONS_TEXTDOMAIN),
                    'separator' => 'before',
                    'condition' => ['edd_price_show' => 'yes'],
                ]
        );

        $this->add_control(
                'edd_price_color',
                [
                    'label' => esc_html__('Price Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner span.edd_price, 
					 {{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_price_options span' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                    'condition' => ['edd_price_show' => 'yes'],
                ]
        );

        $this->add_responsive_control(
                'edd_price_margin',
                [
                    'label' => esc_html__('Price Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_price, 
					 {{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_price_options span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => ['edd_price_show' => 'yes'],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'edd_price_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner span.edd_price, 
				 {{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_price_options span',
                    'condition' => ['edd_price_show' => 'yes'],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_button',
                [
                    'label' => esc_html__('Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => ['edd_buy_button' => 'yes'],
                ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
                'tab_button_normal',
                [
                    'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'button_text_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_purchase_submit_wrapper > .button' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'background_color',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_purchase_submit_wrapper > .button' => 'background-color: {{VALUE}};',
                    ],
                ]
        );


        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'border',
                    'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_purchase_submit_wrapper > .button',
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_purchase_submit_wrapper > .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'button_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_purchase_submit_wrapper > .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
        );
        $this->add_control(
                'button_margin',
                [
                    'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_purchase_submit_wrapper > .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'button_fullwidth',
                [
                    'label' => esc_html__('Fullwidth Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_purchase_submit_wrapper > .button' => 'width: 100%;',
                    ],
                    'separator' => 'before',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow',
                    'selector' => '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_purchase_submit_wrapper > .button',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_purchase_submit_wrapper > .button',
                    'separator' => 'before',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_button_hover',
                [
                    'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'hover_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_purchase_submit_wrapper > .button:hover' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'button_background_hover_color',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_purchase_submit_wrapper > .button:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'button_hover_border_color',
                [
                    'label' => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'border_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .edd_downloads_list .edd_download .edd_download_inner .edd_purchase_submit_wrapper > .button:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_pagination_',
                [
                    'label' => esc_html__('Pagination', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => ['edd_pagination_show' => 'yes'],
                ]
        );

        $this->start_controls_tabs('tabs_pagination_style');

        $this->start_controls_tab(
                'tab_pagination_normal',
                [
                    'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'pagination_text_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} #edd_download_pagination .page-numbers' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'pagination_background_color',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} #edd_download_pagination .page-numbers' => 'background-color: {{VALUE}};',
                    ],
                ]
        );


        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'pagination_border',
                    'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} #edd_download_pagination .page-numbers',
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'pagination_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} #edd_download_pagination .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'pagination_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} #edd_download_pagination .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
        );
        $this->add_control(
                'pagination_margin',
                [
                    'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} #edd_download_pagination ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'pagination_fullwidth',
                [
                    'label' => esc_html__('Fullwidth Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'selectors' => [
                        '{{WRAPPER}} #edd_download_pagination .page-numbers' => 'width: 100%;',
                    ],
                    'separator' => 'before',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'pagination_box_shadow',
                    'selector' => '{{WRAPPER}} #edd_download_pagination .page-numbers',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'pagination_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} #edd_download_pagination .page-numbers',
                    'separator' => 'before',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_pagination_hover',
                [
                    'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'pagination_hover_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} #edd_download_pagination .page-numbers:hover' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'pagination_background_hover_color',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} #edd_download_pagination .page-numbers:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'pagination_hover_border_color',
                [
                    'label' => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'border_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} #edd_download_pagination .page-numbers:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
                'pagination_gap',
                [
                    'label' => esc_html__('Item Gap', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 35,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} #edd_download_pagination .page-numbers + .page-numbers' => 'margin-left: {{SIZE}}px',
                    ],
                ]
        );

        $this->add_control(
                'pagination_alignment',
                [
                    'label' => esc_html__('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
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
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} #edd_download_pagination' => 'text-align: {{VALUE}}',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    private function get_shortcode() {
        $settings = $this->get_settings();

        $attributes = [
            'number' => $settings['number'],
            'columns' => $settings['columns'],
            'hide_empty' => $settings['hide_empty'] ? 1 : 0,
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
            'thumbnails' => $settings['edd_thumbnail_show'] ? 'true' : 'false',
            'excerpt' => $settings['edd_excerpt_show'] ? 'yes' : 'no',
            'price' => $settings['edd_price_show'] ? 'yes' : 'no',
            'buy_button' => $settings['edd_buy_button'] ? 'yes' : 'no',
            'pagination' => $settings['edd_pagination_show'] ? 'true' : 'false',
        ];

        if ('by_id' === $settings['source']) {
            $attributes['category'] = implode(',', $settings['categories']);
        } elseif ('by_parent' === $settings['source']) {
            $attributes['parent'] = $settings['parent'];
        }

        $this->add_render_attribute('shortcode', $attributes);

        $shortcode = [];
        $shortcode[] = sprintf('[edd_downloads %s]', $this->get_render_attribute_string('shortcode'));

        return implode("", $shortcode);
    }

    public function render() {
        if (!class_exists('Easy_Digital_Downloads')) :
            ?>
            <div class="sa-el-alert-warning" >
                <div><?php printf(__('Please install <a target="_blank" href="https://wordpress.org/plugins/easy-digital-downloads/">Easy Digital Downloads Plugin</a> to show your work correctly.', SA_EL_ADDONS_TEXTDOMAIN)); ?></div>
            </div>
            <?php
        else :

            echo do_shortcode($this->get_shortcode());

        endif;
    }

    public function render_plain_content() {
        echo $this->get_shortcode();
    }

}
