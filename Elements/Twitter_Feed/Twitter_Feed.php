<?php

namespace SA_EL_ADDONS\Elements\Twitter_Feed;

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
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use \SA_EL_ADDONS\Elements\Twitter_Feed\Files\Twitter_Query as Twitter_Query;

class Twitter_Feed extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;
    
    public function get_name() {
        return 'sa_el_twitter_feed';
    }

    public function get_title() {
        return esc_html__('Twitter Feed', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-twitter-feed oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'sa_el_section_twitter_feed_acc_settings',
            [
                'label' => esc_html__('Account Settings', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_ac_name',
            [
                'label' => esc_html__('Account Name', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::TEXT,
                'default' => '@TwitterDev',
                'label_block' => false,
                'description' => esc_html__('Use @ sign with your account name.', SA_EL_ADDONS_TEXTDOMAIN),

            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_hashtag_name',
            [
                'label' => esc_html__('Hashtag Name', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'description' => esc_html__('Remove # sign from your hashtag name.', SA_EL_ADDONS_TEXTDOMAIN),

            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_consumer_key',
            [
                'label' => esc_html__('Consumer Key', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => 'wwC72W809xRKd9ySwUzXzjPkl',
                'description' => '<a href="https://apps.twitter.com/app/" target="_blank">Get Consumer Key.</a> Create a new app or select existing app and grab the <b>consumer key.</b>',
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_consumer_secret',
            [
                'label' => esc_html__('Consumer Secret', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => 'rn54hBqxjve2CWOtZqwJigT3F5OEvrriK2XAcqoQVohzrKajbY',
                'description' => '<a href="https://apps.twitter.com/app/" target="_blank">Get Consumer Secret.</a> Create a new app or select existing app and grab the <b>consumer secret.</b>',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'sa_el_section_twitter_feed_settings',
            [
                'label' => esc_html__('Layout Settings', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_type',
            [
                'label' => esc_html__('Content Layout', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SELECT,
                'default' => 'masonry',
                'options' => [
                    'list' => esc_html__('List', SA_EL_ADDONS_TEXTDOMAIN),
                    'masonry' => esc_html__('Masonry', SA_EL_ADDONS_TEXTDOMAIN),
                ],
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_type_col_type',
            [
                'label' => __('Column Grid', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'col-2' => '2 Columns',
                    'col-3' => '3 Columns',
                    'col-4' => '4 Columns',
                ],
                'default' => 'col-3',
                'condition' => [
                    'sa_el_twitter_feed_type' => 'masonry',
                ],
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_content_length',
            [
                'label' => esc_html__('Content Length', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => '20',
            ]
        );

        $this->add_responsive_control(
            'sa_el_twitter_feed_column_spacing',
            [
                'label' => esc_html__('Column spacing', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_post_limit',
            [
                'label' => esc_html__('Post Limit', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::NUMBER,
                'label_block' => false,
                'default' => 10,
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_media',
            [
                'label' => esc_html__('Show Media Elements', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('yes', SA_EL_ADDONS_TEXTDOMAIN),
                'label_off' => __('no', SA_EL_ADDONS_TEXTDOMAIN),
                'default' => 'true',
                'return_value' => 'true',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'sa_el_section_twitter_feed_card_settings',
            [
                'label' => esc_html__('Card Settings', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_show_avatar',
            [
                'label' => esc_html__('Show Avatar', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('yes', SA_EL_ADDONS_TEXTDOMAIN),
                'label_off' => __('no', SA_EL_ADDONS_TEXTDOMAIN),
                'default' => 'true',
                'return_value' => 'true',
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_avatar_style',
            [
                'label' => __('Avatar Style', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'circle' => 'Circle',
                    'square' => 'Square',
                ],
                'default' => 'circle',
                'prefix_class' => 'sa-el-social-feed-avatar-',
                'condition' => [
                    'sa_el_twitter_feed_show_avatar' => 'true',
                ],
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_show_date',
            [
                'label' => esc_html__('Show Date', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('yes', SA_EL_ADDONS_TEXTDOMAIN),
                'label_off' => __('no', SA_EL_ADDONS_TEXTDOMAIN),
                'default' => 'true',
                'return_value' => 'true',
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_show_read_more',
            [
                'label' => esc_html__('Show Read More', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('yes', SA_EL_ADDONS_TEXTDOMAIN),
                'label_off' => __('no', SA_EL_ADDONS_TEXTDOMAIN),
                'default' => 'true',
                'return_value' => 'true',
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_show_icon',
            [
                'label' => esc_html__('Show Icon', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('yes', SA_EL_ADDONS_TEXTDOMAIN),
                'label_off' => __('no', SA_EL_ADDONS_TEXTDOMAIN),
                'default' => 'true',
                'return_value' => 'true',
            ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();

        /**
         * -------------------------------------------
         * Tab Style (Twitter Feed Card Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'sa_el_section_twitter_feed_card_style_settings',
            [
                'label' => esc_html__('Card Style', SA_EL_ADDONS_TEXTDOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_card_bg_color',
            [
                'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-twitter-feed-item-inner' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sa_el_twitter_feed_card_container_padding',
            [
                'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-twitter-feed-item-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .sa-el-twitter-feed-item-content' => 'padding: 0 {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'sa_el_twitter_feed_card_border',
                'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                'selector' => '{{WRAPPER}} .sa-el-twitter-feed-item-inner',
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_card_border_radius',
            [
                'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-twitter-feed-item-inner' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sa_el_twitter_feed_card_shadow',
                'selector' => '{{WRAPPER}} .sa-el-twitter-feed-item-inner',
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Twitter Feed Typography Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'sa_el_section_twitter_feed_card_typo_settings',
            [
                'label' => esc_html__('Color &amp; Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_title_heading',
            [
                'label' => esc_html__('Title Style', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_title_color',
            [
                'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-twitter-feed-item .sa-el-twitter-feed-item-author' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_twitter_feed_title_typography',
                'selector' => '{{WRAPPER}} .sa-el-twitter-feed-item .sa-el-twitter-feed-item-author',
            ]
        );
        // Content Style
        $this->add_control(
            'sa_el_twitter_feed_content_heading',
            [
                'label' => esc_html__('Content Style', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_content_color',
            [
                'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-twitter-feed-item .sa-el-twitter-feed-item-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_twitter_feed_content_typography',
                'selector' => '{{WRAPPER}} .sa-el-twitter-feed-item .sa-el-twitter-feed-item-content p',
            ]
        );

        // Content Link Style
        $this->add_control(
            'sa_el_twitter_feed_content_link_heading',
            [
                'label' => esc_html__('Link Style', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_content_link_color',
            [
                'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-twitter-feed-item .sa-el-twitter-feed-item-content a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sa_el_twitter_feed_content_link_hover_color',
            [
                'label' => esc_html__('Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-twitter-feed-item .sa-el-twitter-feed-item-content a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_twitter_feed_content_link_typography',
                'selector' => '{{WRAPPER}} .sa-el-twitter-feed-item .sa-el-twitter-feed-item-content a',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        echo '<div class="sa-el-twitter-feed sa-el-twitter-feed-' . $this->get_id() . ' sa-el-twitter-feed-' . $settings['sa_el_twitter_feed_type'] . ' sa-el-twitter-feed-' . $settings['sa_el_twitter_feed_type_col_type'] . ' clearfix" data-gutter="' . $settings['sa_el_twitter_feed_column_spacing']['size'] . '">
			' . Twitter_Query::twitter_feed_items($this->get_id(), $settings) . '
        </div>';
        
        echo '<style>
            .sa-el-twitter-feed-' . $this->get_id() . '.sa-el-twitter-feed-masonry.sa-el-twitter-feed-col-2 .sa-el-twitter-feed-item {
                width: calc(50% - ' . ceil($settings['sa_el_twitter_feed_column_spacing']['size'] / 2) . 'px);
            }
            .sa-el-twitter-feed-' . $this->get_id() . '.sa-el-twitter-feed-masonry.sa-el-twitter-feed-col-3 .sa-el-twitter-feed-item {
                width: calc(33.33% - ' . ceil($settings['sa_el_twitter_feed_column_spacing']['size'] * 2 / 3) . 'px);
            }
            .sa-el-twitter-feed-' . $this->get_id() . '.sa-el-twitter-feed-masonry.sa-el-twitter-feed-col-4 .sa-el-twitter-feed-item {
                width: calc(25% - ' . ceil($settings['sa_el_twitter_feed_column_spacing']['size'] * 3 / 4) . 'px);
            }
            
            .sa-el-twitter-feed-' . $this->get_id() . '.sa-el-twitter-feed-col-2 .sa-el-twitter-feed-item,
            .sa-el-twitter-feed-' . $this->get_id() . '.sa-el-twitter-feed-col-3 .sa-el-twitter-feed-item,
            .sa-el-twitter-feed-' . $this->get_id() . '.sa-el-twitter-feed-col-4 .sa-el-twitter-feed-item {
                margin-bottom: ' . $settings['sa_el_twitter_feed_column_spacing']['size'] . 'px;
            }

            @media only screen and (min-width: 768px) and (max-width: 992px) {
                .sa-el-twitter-feed-' . $this->get_id() . '.sa-el-twitter-feed-masonry.sa-el-twitter-feed-col-3 .sa-el-twitter-feed-item,
                .sa-el-twitter-feed-' . $this->get_id() . '.sa-el-twitter-feed-masonry.sa-el-twitter-feed-col-4 .sa-el-twitter-feed-item {
                    width: calc(50% - ' . ceil($settings['sa_el_twitter_feed_column_spacing']['size'] / 2) . 'px);
                }
            }
        </style>';

        if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            echo '<script type="text/javascript">
                jQuery(document).ready(function($) {
                    $(".sa-el-twitter-feed").each(function() {
                        var $node_id = "' . $this->get_id() . '",
                        $scope = $(".elementor-element-"+$node_id+""),
                        $gutter = $(".sa-el-twitter-feed", $scope).data("gutter"),
                        $settings = {
                            itemSelector: ".sa-el-twitter-feed-item",
                            percentPosition: true,
                            masonry: {
                                columnWidth: ".sa-el-twitter-feed-item",
                                gutter: $gutter
                            }
                        };
                        
                        $twitter_feed_gallery = $(".sa-el-twitter-feed", $scope).isotope($settings);
                    
                        $twitter_feed_gallery.imagesLoaded().progress(function() {
                            $twitter_feed_gallery.isotope("layout");
                        });
                    });
                });
            </script>';
        }
    }

}
