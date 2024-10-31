<?php

namespace SA_EL_ADDONS\Elements\Instagram_Feed;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Interactive Card
 *
 * @author biplop
 * 
 */
use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Scheme_Typography as Scheme_Typography;
use \Elementor\Widget_Base as Widget_Base;
use SA_EL_ADDONS\Elements\Instagram_Feed\Files\Instagram_Query as Instagram_Query;
class Instagram_Feed extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_instagram_feed';
    }

    public function get_title() {
        return esc_html__('Instagram Feed', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-accordion  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
                'sa_el_section_instafeed_settings_account',
                [
                    'label' => esc_html__('Instagram Account Settings', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'sa_el_instafeed_access_token',
                [
                    'label' => esc_html__('Access Token', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__('4507625822.ba4c844.2608ae40c33d40fe9856fdc9bed8c8c5', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => '<a href="http://www.jetseotools.com/instagram-access-token/" class="sa-el-btn" target="_blank">Get Access Token</a>', SA_EL_ADDONS_TEXTDOMAIN,
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'sa_el_section_instafeed_settings_content',
                [
                    'label' => esc_html__('Feed Settings', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'sa_el_instafeed_sort_by',
                [
                    'label' => esc_html__('Sort By', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none' => esc_html__('None', SA_EL_ADDONS_TEXTDOMAIN),
                        'most-recent' => esc_html__('Most Recent', SA_EL_ADDONS_TEXTDOMAIN),
                        'least-recent' => esc_html__('Least Recent', SA_EL_ADDONS_TEXTDOMAIN),
                        'most-liked' => esc_html__('Most Likes', SA_EL_ADDONS_TEXTDOMAIN),
                        'least-liked' => esc_html__('Least Likes', SA_EL_ADDONS_TEXTDOMAIN),
                        'most-commented' => esc_html__('Most Commented', SA_EL_ADDONS_TEXTDOMAIN),
                        'least-commented' => esc_html__('Least Commented', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'sa_el_instafeed_image_count',
                [
                    'label' => esc_html__('Max Visible Images', SA_EL_ADDONS_TEXTDOMAIN),
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

        $this->add_control(
                'sa_el_instafeed_image_resolution',
                [
                    'label' => esc_html__('Image Resolution', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'low_resolution',
                    'options' => [
                        'thumbnail' => esc_html__('Thumbnail (150x150)', SA_EL_ADDONS_TEXTDOMAIN),
                        'low_resolution' => esc_html__('Low Res (306x306)', SA_EL_ADDONS_TEXTDOMAIN),
                        'standard_resolution' => esc_html__('Standard (612x612)', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'sa_el_instafeed_force_square',
                [
                    'label' => esc_html__('Force Square Image?', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => '',
                ]
        );

        $this->add_responsive_control(
                'sa_el_instafeed_sq_image_size',
                [
                    'label' => esc_html__('Image Dimension (px)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 300,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-instafeed-square-img .sa-el-insta-img-wrap img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                    ],
                    'condition' => [
                        'sa_el_instafeed_force_square' => 'yes',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'sa_el_section_instafeed_settings_general',
                [
                    'label' => esc_html__('General Settings', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'sa_el_instafeed_columns',
                [
                    'label' => esc_html__('Number of Columns', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'sa-el-col-4',
                    'options' => [
                        'sa-el-col-1' => esc_html__('Single Column', SA_EL_ADDONS_TEXTDOMAIN),
                        'sa-el-col-2' => esc_html__('Two Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        'sa-el-col-3' => esc_html__('Three Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        'sa-el-col-4' => esc_html__('Four Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        'sa-el-col-5' => esc_html__('Five Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        'sa-el-col-6' => esc_html__('Six Columns', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'sa_el_instafeed_pagination_heading',
                [
                    'label' => __('Pagination', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_control(
                'sa_el_instafeed_pagination',
                [
                    'label' => esc_html__('Enable Load More?', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => '',
                ]
        );

        $this->add_control(
                'sa_el_instafeed_caption_heading',
                [
                    'label' => __('Link & Content', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_control(
                'sa_el_instafeed_caption',
                [
                    'label' => esc_html__('Display Caption', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'sa_el_instafeed_likes',
                [
                    'label' => esc_html__('Display Like', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'sa_el_instafeed_comments',
                [
                    'label' => esc_html__('Display Comments', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'sa_el_instafeed_link',
                [
                    'label' => esc_html__('Enable Link', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'sa_el_instafeed_link_target',
                [
                    'label' => esc_html__('Open in new window?', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'sa_el_instafeed_link' => 'yes',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();

        $this->start_controls_section(
                'sa_el_section_instafeed_styles_general',
                [
                    'label' => esc_html__('Instagram Feed Styles', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control(
                'sa_el_instafeed_spacing',
                [
                    'label' => esc_html__('Padding Between Images', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-insta-feed-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_instafeed_box_border',
                    'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-insta-feed-wrap',
                ]
        );

        $this->add_control(
                'sa_el_instafeed_box_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-insta-feed-wrap' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'sa_el_section_instafeed_styles_content',
                [
                    'label' => esc_html__('Color &amp; Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'sa_el_instafeed_overlay_color',
                [
                    'label' => esc_html__('Hover Overlay Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => 'rgba(0,0,0, .75)',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-insta-feed-wrap::after' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'sa_el_instafeed_like_comments_heading',
                [
                    'label' => __('Like & Comments Styles', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_control(
                'sa_el_instafeed_like_comments_color',
                [
                    'label' => esc_html__('Like &amp; Comments Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fbd800',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-insta-likes-comments > p' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sa_el_instafeed_like_comments_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                    'selector' => '{{WRAPPER}} .sa-el-insta-likes-comments > p',
                ]
        );

        $this->add_control(
                'sa_el_instafeed_caption_style_heading',
                [
                    'label' => __('Caption Styles', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_control(
                'sa_el_instafeed_caption_color',
                [
                    'label' => esc_html__('Caption Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-insta-info-wrap' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sa_el_instafeed_caption_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                    'selector' => '{{WRAPPER}} .sa-el-insta-info-wrap',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'sa_el_section_load_more_btn',
                [
                    'label' => __('Load More Button Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control(
                'sa_el_instafeed_load_more_btn_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-load-more-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'sa_el_instafeed_load_more_btn_margin',
                [
                    'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-load-more-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sa_el_instafeed_load_more_btn_typography',
                    'selector' => '{{WRAPPER}} .sa-el-load-more-button',
                ]
        );

        $this->start_controls_tabs('sa_el_instafeed_load_more_btn_tabs');

        // Normal State Tab
        $this->start_controls_tab('sa_el_instafeed_load_more_btn_normal', ['label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN)]);

        $this->add_control(
                'sa_el_instafeed_load_more_btn_normal_text_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-load-more-button' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'sa_el_cta_btn_normal_bg_color',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#29d8d8',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-load-more-button' => 'background: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_instafeed_load_more_btn_normal_border',
                    'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-load-more-button',
                ]
        );

        $this->add_control(
                'sa_el_instafeed_load_more_btn_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-load-more-button' => 'border-radius: {{SIZE}}px;',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'sa_el_instafeed_load_more_btn_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-load-more-button',
                    'separator' => 'before',
                ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab('sa_el_instafeed_load_more_btn_hover', ['label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN)]);

        $this->add_control(
                'sa_el_instafeed_load_more_btn_hover_text_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-load-more-button:hover' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'sa_el_instafeed_load_more_btn_hover_bg_color',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#27bdbd',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-load-more-button:hover' => 'background: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'sa_el_instafeed_load_more_btn_hover_border_color',
                [
                    'label' => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-load-more-button:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'sa_el_instafeed_load_more_btn_hover_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-load-more-button:hover',
                    'separator' => 'before',
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $force_square = (($settings['sa_el_instafeed_force_square'] == 'yes') ? "sa-el-instafeed-square-img" : "");
        $column_count = ($settings['sa_el_instafeed_columns']);
        $classes = $force_square . ' ' . $column_count;
        $settings_var = [
            'sa_el_instafeed_access_token' => $settings['sa_el_instafeed_access_token'],
            'sa_el_instafeed_image_count' => $settings['sa_el_instafeed_image_count'],
            'sa_el_instafeed_sort_by' => $settings['sa_el_instafeed_sort_by'],
            'sa_el_instafeed_image_resolution' => $settings['sa_el_instafeed_image_resolution'],
            'sa_el_instafeed_likes' => $settings['sa_el_instafeed_likes'],
            'sa_el_instafeed_comments' => $settings['sa_el_instafeed_comments'],
            'sa_el_instafeed_caption' => $settings['sa_el_instafeed_caption'],
            'sa_el_instafeed_link' => $settings['sa_el_instafeed_link'],
            'sa_el_instafeed_link_target' => $settings['sa_el_instafeed_link_target']
        ];

        echo '<div class="sa-el-instagram-feed ' . $classes . '">
            <div id="sa-el-instagram-feed-' . esc_attr($this->get_id()) . '" class="sa-el-insta-grid">
                ' . Instagram_Query::__template( $settings_var)['html'] . '
            </div>
            <div class="clearfix"></div>';
//
        if (($settings['sa_el_instafeed_pagination'] == 'yes')) {
            echo '<div class="sa-el-load-more-button-wrap">
                <button class="sa-el-load-more-button sa-el-load-more-instagram-feed" data-id="' . $this->get_id() . '" data-settings=\'' . json_encode($settings_var) . '\' data-page="0"  data-class="SA_EL_ADDONS\Elements\Instagram_Feed\Files\Instagram_Query"  data-function="__ajax_template">
                    <div class="sa-el-btn-loader button__loader"></div>
                    <span>Load more</span>
                </button>
            </div>';
        }
        echo '</div>';
    }

}
