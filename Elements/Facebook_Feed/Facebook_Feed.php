<?php

namespace SA_EL_ADDONS\Elements\Facebook_Feed;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Interactive Card
 *
 * @author biplop
 * 
 */

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;
use \Elementor\Widget_Base;
use SA_EL_ADDONS\Elements\Facebook_Feed\Files\Facebook_Query as Facebook_Query;

class Facebook_Feed extends Widget_Base
{
    use \SA_EL_ADDONS\Helper\Elementor_Helper;
    use \SA_EL_ADDONS\Helper\Post_Query;

    public function get_name()
    {
        return 'sa_el_facebook_feed';
    }

    public function get_title()
    {
        return esc_html__('Facebook Feed', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-fb-feed oxi-el-admin-icon';
    }

    public function get_categories()
    {
        return ['sa-el-addons'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'sa_el_section_facebook_feed_settings_account',
            [
                'label' => esc_html__('Facebook Account Settings', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_page_id',
            [
                'label' => esc_html__('Page ID', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('', SA_EL_ADDONS_TEXTDOMAIN),
                'description' => __('<a href="https://findmyfbid.com/" class="sa-el-btn" target="_blank">Find Your Page ID</a>', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_access_token',
            [
                'label' => esc_html__('Access Token', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('', SA_EL_ADDONS_TEXTDOMAIN),
                'description' => __('<a href="https://www.sa-elementor-addons.com/docs/social-elements/facebook-feed/" class="sa-el-btn" target="_blank">Get Access Token</a>', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'sa_el_section_facebook_feed_settings_content',
            [
                'label' => esc_html__('Feed Settings', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_sort_by',
            [
                'label' => esc_html__('Sort By', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'most-recent' => esc_html__('Newest', SA_EL_ADDONS_TEXTDOMAIN),
                    'least-recent' => esc_html__('Oldest', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'default' => 'most-recent',
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_image_count',
            [
                'label' => esc_html__('Max Visible Items', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 12,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'sa_el_section_facebook_feed_settings_general',
            [
                'label' => esc_html__('General Settings', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_layout_heading',
            [
                'label' => __('Layout Settings', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_layout',
            [
                'label' => esc_html__('Layout', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'card' => esc_html__('Card', SA_EL_ADDONS_TEXTDOMAIN),
                    'overlay' => esc_html__('Overlay', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'default' => 'card',
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_columns',
            [
                'label' => esc_html__('Columns', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SELECT,
                'default' => 'sa-el-col-3',
                'options' => [
                    'sa-el-col-1' => esc_html__('1', SA_EL_ADDONS_TEXTDOMAIN),
                    'sa-el-col-2' => esc_html__('2', SA_EL_ADDONS_TEXTDOMAIN),
                    'sa-el-col-3' => esc_html__('3', SA_EL_ADDONS_TEXTDOMAIN),
                    'sa-el-col-4' => esc_html__('4', SA_EL_ADDONS_TEXTDOMAIN),
                    'sa-el-col-5' => esc_html__('5', SA_EL_ADDONS_TEXTDOMAIN),
                    'sa-el-col-6' => esc_html__('6', SA_EL_ADDONS_TEXTDOMAIN),
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_content_heading',
            [
                'label' => __('Content Settings', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_message',
            [
                'label' => esc_html__('Display Message', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_message_max_length',
            [
                'label' => esc_html__('Max Message Length', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                    'sa_el_facebook_feed_message' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_likes',
            [
                'label' => esc_html__('Display Like', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_comments',
            [
                'label' => esc_html__('Display Comments', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_date',
            [
                'label' => esc_html__('Display Date', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_link_target',
            [
                'label' => esc_html__('Open link in new window', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_load_more_heading',
            [
                'label' => __('Pagination', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'show_load_more',
            [
                'label' => __('Show Load More', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => [
                        'title' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => 'fa fa-check',
                    ],
                    'no' => [
                        'title' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => 'fa fa-ban',
                    ],
                ],
                'default' => 'no',
            ]
        );

        $this->add_control(
            'loadmore_text',
            [
                'label' => __('Label', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::TEXT,
                'default' => __('Load More', SA_EL_ADDONS_TEXTDOMAIN),
                'condition' => [
                    'show_load_more' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();
        $this->start_controls_section(
            'sa_el_section_facebook_feed_styles_general',
            [
                'label' => esc_html__('Feed Item Styles', SA_EL_ADDONS_TEXTDOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sa_el_facebook_feed_spacing',
            [
                'label' => esc_html__('Space Between Items', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-item-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'sa_el_facebook_feed_box_border',
                'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                'selector' => '{{WRAPPER}} .sa-el-facebook-feed-item-inner',
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                            'isLinked' => false,
                        ],
                    ],
                    'color' => [
                        'default' => '#eee',
                    ],
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_box_border_radius',
            [
                'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-item-inner' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_background',
            [
                'label' => esc_html__('Background', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-item-inner' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_header_style',
            [
                'label' => __('Header Style', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_header_background',
            [
                'label' => esc_html__('Background', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#f2f6fd',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-item-header' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_header_spacing',
            [
                'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-item-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_content_style',
            [
                'label' => __('Content Style', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_content_spacing',
            [
                'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_content_preview_spacing',
            [
                'label' => esc_html__('Preview Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-preview-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .sa-el-facebook-feed-preview-wrap .sa-el-facebook-feed-url-preview' => 'padding-left: 0; padding-right: 0;',
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_footer_style',
            [
                'label' => __('Footer Style', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_footer_background',
            [
                'label' => esc_html__('Background', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#f2f6fd',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-item-footer' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_footer_spacing',
            [
                'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-item-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'sa_el_section_facebook_feed_styles_content',
            [
                'label' => esc_html__('Color &amp; Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_styles_page_name_heading',
            [
                'label' => __('Page Name', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_facebook_feed_page_name_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-item-header .sa-el-facebook-feed-item-user .sa-el-facebook-feed-username',
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_page_name_color',
            [
                'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#365899',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-item-header .sa-el-facebook-feed-item-user .sa-el-facebook-feed-username' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_styles_date_heading',
            [
                'label' => __('Date', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_facebook_feed_date_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-item-header .sa-el-facebook-feed-post-time',
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_date_color',
            [
                'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-item-header .sa-el-facebook-feed-post-time' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_styles_message_heading',
            [
                'label' => __('Message', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_facebook_feed_message_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-item-content .sa-el-facebook-feed-message',
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_message_color',
            [
                'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-item-content .sa-el-facebook-feed-message' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_message_link_color',
            [
                'label' => esc_html__('Link Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#365899',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-item-content .sa-el-facebook-feed-message a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_styles_preview_host_heading',
            [
                'label' => __('Preview Host', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_facebook_feed_preview_host_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-preview-wrap .sa-el-facebook-feed-url-preview .sa-el-facebook-feed-url-host',
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_preview_host_color',
            [
                'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-preview-wrap .sa-el-facebook-feed-url-preview .sa-el-facebook-feed-url-host' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_styles_preview_title_heading',
            [
                'label' => __('Preview Title', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_facebook_feed_preview_title_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-preview-wrap .sa-el-facebook-feed-url-preview .sa-el-facebook-feed-url-title',
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_preview_title_color',
            [
                'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-preview-wrap .sa-el-facebook-feed-url-preview .sa-el-facebook-feed-url-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_styles_preview_desc_heading',
            [
                'label' => __('Preview Description', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_facebook_feed_preview_desc_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-preview-wrap .sa-el-facebook-feed-url-preview .sa-el-facebook-feed-url-description',
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_preview_desc_color',
            [
                'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-preview-wrap .sa-el-facebook-feed-url-preview .sa-el-facebook-feed-url-description' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'card',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_styles_likes_conmments_heading',
            [
                'label' => __('Likes & Comments', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_facebook_feed_likes_conmments_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .sa-el-facebook-feed-overlay .sa-el-facebook-feed-item .sa-el-facebook-feed-item-overlay, {{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-item-footer',
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_likes_conmments_color',
            [
                'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-card .sa-el-facebook-feed-item .sa-el-facebook-feed-item-inner .sa-el-facebook-feed-item-footer' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sa-el-facebook-feed-overlay .sa-el-facebook-feed-item .sa-el-facebook-feed-item-overlay' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sa-el-facebook-feed-overlay .sa-el-facebook-feed-item .sa-el-facebook-feed-item-overlay i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sa_el_facebook_feed_overlay_color',
            [
                'label' => esc_html__('Overlay Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(86,20,213,0.8)',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-facebook-feed-overlay .sa-el-facebook-feed-item .sa-el-facebook-feed-item-overlay' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'sa_el_facebook_feed_layout' => 'overlay',
                ],
            ]
        );

        $this->end_controls_section();

        $this->sa_el_load_more_style();;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $classes = implode(' ', [
            $settings['sa_el_facebook_feed_columns'],
            "sa-el-facebook-feed-{$settings['sa_el_facebook_feed_layout']}",
        ]);
        $settings_var = [
            'sa_el_facebook_feed_page_id' => $settings['sa_el_facebook_feed_page_id'],
            'sa_el_facebook_feed_access_token' => $settings['sa_el_facebook_feed_access_token'],
            'sa_el_facebook_feed_image_count' => $settings['sa_el_facebook_feed_image_count'],
            'sa_el_facebook_feed_sort_by' => $settings['sa_el_facebook_feed_sort_by'],
            'sa_el_facebook_feed_layout' => $settings['sa_el_facebook_feed_layout'],
            'sa_el_facebook_feed_message' => $settings['sa_el_facebook_feed_message'],
            'sa_el_facebook_feed_message_max_length' => $settings['sa_el_facebook_feed_message_max_length'],
            'sa_el_facebook_feed_date' => $settings['sa_el_facebook_feed_date'],
            'sa_el_facebook_feed_likes' => $settings['sa_el_facebook_feed_likes'],
            'sa_el_facebook_feed_comments' => $settings['sa_el_facebook_feed_comments'],
            'sa_el_facebook_feed_link_target' => $settings['sa_el_facebook_feed_link_target'],
        ];

        echo '<div id="sa-el-facebook-feed-' . esc_attr($this->get_id()) . '" class="sa-el-facebook-feed ' . $classes . '">
            ' . Facebook_Query::__template($settings)['html'] . '
        </div>
        <div class="clearfix"></div>';

        if (($settings['show_load_more'] == 'yes')) {
            echo '<div class="sa-el-load-more-button-wrap">
                <button class="sa-el-load-more-button sa-el-load-more-facebook-feed" id="sa-el-load-more-btn-' . $this->get_id() . '" data-settings=\'' . json_encode($settings_var) . '\' data-page="0"  data-class="SA_EL_ADDONS\Elements\Facebook_Feed\Files\Facebook_Query"  data-function="__ajax_template">
                    <div class="sa-el-btn-loader button__loader"></div>
                    <span>' . $settings['loadmore_text'] . '</span>
                </button>
            </div>';
        }

        if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            echo '<script type="text/javascript">
                jQuery(document).ready(function($) {
                    $(".sa-el-facebook-feed").each(function() {
                        var $node_id = "' . $this->get_id() . '",
                        $scope = $(".elementor-element-"+$node_id+""),
                        $settings = {
                            itemSelector: ".sa-el-facebook-feed-item",
                            percentPosition: true,
                            masonry: {
                                columnWidth: ".sa-el-facebook-feed-item",
                            }
                        };

                        $instagram_gallery = $(".sa-el-facebook-feed", $scope).isotope($settings);

                        $instagram_gallery.imagesLoaded().progress(function() {
                            $instagram_gallery.isotope("layout");
                        });
                    });
                });
            </script>';
        }
    }
}
