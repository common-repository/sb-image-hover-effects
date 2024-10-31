<?php

namespace SA_EL_ADDONS\Elements\Post_Grid;

if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;
use \Elementor\Widget_Base as Widget_Base;
use \SA_EL_ADDONS\Elements\Post_Grid\Files\Post_Query as Post_Query;

class Post_Grid extends Widget_Base
{

    use \SA_EL_ADDONS\Helper\Elementor_Helper;
    use \SA_EL_ADDONS\Helper\Post_Query;


    public function get_name()
    {
        return 'sa_el_post_grid';
    }

    public function get_title()
    {
        return esc_html__('Post Grid', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-posts-grid oxi-el-admin-icon';
    }

    public function get_categories()
    {
        return ['sa-el-addons'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            '_section_step',
            [
                'label' => __('Post Grid', SA_EL_ADDONS_TEXTDOMAIN),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->sa_el_query_controls();

        $this->end_controls_section();
        $this->start_controls_section(
            'sa_el_section_post_timeline_layout',
            [
                'label' => __('Layout Settings', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        $this->sa_el_layout_controls();
        $this->end_controls_section();

        $this->Sa_El_Support();
        
        $this->start_controls_section(
            '_section_icon_style',
            [
                'label' => __('Post Grid Style', SA_EL_ADDONS_TEXTDOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sa_el_post_grid_bg_color',
            [
                'label' => __('Post Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-grid-post-holder' => 'background-color: {{VALUE}}',
                ],

            ]
        );

        $this->add_responsive_control(
            'sa_el_post_grid_spacing',
            [
                'label' => esc_html__('Spacing Between Items', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-grid-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'sa_el_post_grid_border',
                'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                'selector' => '{{WRAPPER}} .sa-el-grid-post-holder',
            ]
        );

        $this->add_control(
            'sa_el_post_grid_border_radius',
            [
                'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .sa-el-grid-post-holder' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sa_el_post_grid_box_shadow',
                'selector' => '{{WRAPPER}} .sa-el-grid-post-holder',
            ]
        );
        $this->add_responsive_control(
            'sa_el_post_grid_padding',
            [
                'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-grid-post-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'sa_el_section_typography',
            [
                'label' => __('Color & Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sa_el_post_grid_title_style',
            [
                'label' => __('Title Style', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sa_el_post_grid_title_color',
            [
                'label' => __('Title Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#303133',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-entry-title a' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_control(
            'sa_el_post_grid_title_hover_color',
            [
                'label' => __('Title Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#23527c',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-entry-title:hover, {{WRAPPER}} .sa-el-entry-title a:hover' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'sa_el_post_grid_title_alignment',
            [
                'label' => __('Title Alignment', SA_EL_ADDONS_TEXTDOMAIN),
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
                    '{{WRAPPER}} .sa-el-entry-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_post_grid_title_typography',
                'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .sa-el-entry-title',
            ]
        );
        $this->add_responsive_control(
            'sa_el_post_grid_title_spacing',
            [
                'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-entry-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'sa_el_post_grid_excerpt_style',
            [
                'label' => __('Excerpt Style', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sa_el_post_grid_excerpt_color',
            [
                'label' => __('Excerpt Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-grid-post-excerpt p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sa_el_post_grid_excerpt_alignment',
            [
                'label' => __('Excerpt Alignment', SA_EL_ADDONS_TEXTDOMAIN),
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
                    'justify' => [
                        'title' => __('Justified', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-grid-post-excerpt' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_post_grid_excerpt_typography',
                'label' => __('Excerpt Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .sa-el-grid-post-excerpt p',
            ]
        );

        $this->add_responsive_control(
            'sa_el_post_grid_excerpt_spacing',
            [
                'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-grid-post-excerpt p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'sa_el_post_grid_read_more_style',
            [
                'label' => __('Read More Style', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_post_grid_read_more_typography',
                'label' => __('Meta Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .sa-el-post-elements-readmore-btn',
                
            ]
        );
        $this->start_controls_tabs('sa_el_post_grid_read_more_tabs');

        // Normal State Tab
        $this->start_controls_tab('sa_el_post_grid_read_more_normal', ['label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN)]);

        $this->add_control(
            'sa_el_post_grid_read_more_color',
            [
                'label' => __('Read More Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-post-elements-readmore-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // hover State Tab
        $this->start_controls_tab('sa_el_post_grid_read_more_hover', ['label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN)]);

        $this->add_control(
            'sa_el_post_grid_read_more_color_h',
            [
                'label' => __('Read More Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-post-elements-readmore-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        
        $this->add_responsive_control(
            'sa_el_post_grid_read_more_spacing',
            [
                'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'after',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-post-elements-readmore-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );








        $this->add_control(
            'sa_el_post_grid_meta_style',
            [
                'label' => __('Meta Style', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sa_el_post_grid_meta_color',
            [
                'label' => __('Meta Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-entry-meta, .sa-el-entry-meta a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sa_el_post_grid_meta_alignment',
            [
                'label' => __('Meta Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => 'fa fa-align-right',
                    ],
                    'stretch' => [
                        'title' => __('Justified', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-entry-footer' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .sa-el-entry-meta' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sa_el_post_grid_meta_typography',
                'label' => __('Meta Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .sa-el-entry-meta > div, {{WRAPPER}} .sa-el-entry-meta > span',
            ]
        );
        $this->add_responsive_control(
            'sa_el_post_grid_meta_spacing',
            [
                'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-entry-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'meta_position' => 'meta-entry-header',
                ],
            ]
        );
        $this->add_responsive_control(
            'sa_el_post_grid_meta_spacing_footer',
            [
                'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-entry-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'meta_position' => 'meta-entry-footer',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'sa_el_section_hover_card_styles',
            [
                'label' => __('Hover Card Style', SA_EL_ADDONS_TEXTDOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sa_el_post_grid_hover_animation',
            [
                'label' => esc_html__('Animation', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SELECT,
                'default' => 'fade-in',
                'options' => [
                    'none' => esc_html__('None', SA_EL_ADDONS_TEXTDOMAIN),
                    'fade-in' => esc_html__('FadeIn', SA_EL_ADDONS_TEXTDOMAIN),
                    'zoom-in' => esc_html__('ZoomIn', SA_EL_ADDONS_TEXTDOMAIN),
                    'slide-up' => esc_html__('SlideUp', SA_EL_ADDONS_TEXTDOMAIN),
                ],
            ]
        );

        $this->add_control(
            'sa_el_post_grid_bg_hover_icon_new',
            [
                'label' => __('Post Hover Icon', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'sa_el_post_grid_bg_hover_icon',
                'default' => [
                    'value' => 'fa fa-long-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'sa_el_post_grid_hover_animation!' => 'none',
                ],
            ]
        );

        $this->add_control(
            'sa_el_post_grid_hover_bg_color',
            [
                'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0, .75)',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-grid-post .sa-el-entry-overlay' => 'background-color: {{VALUE}}',
                ],

            ]
        );

        $this->add_control(
            'sa_el_post_grid_hover_icon_color',
            [
                'label' => __('Icon Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .sa-el-grid-post .sa-el-entry-overlay > i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'sa_el_post_grid_hover_icon_fontsize',
            [
                'label' => __('Icon font size', SA_EL_ADDONS_TEXTDOMAIN),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 18,
                ],
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-grid-post .sa-el-entry-overlay > i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sa-el-grid-post .sa-el-entry-overlay > img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();
        $this->sa_el_load_more_style();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        
        $args = $this->query_args($settings);

        $this->add_render_attribute(
            'post_grid_wrapper',
            [
                'id' => 'sa-el-post-grid-' . esc_attr($this->get_id()),
                'class' => [
                    'sa-el-post-grid-container',
                    esc_attr($settings['sa_el_post_grid_columns']),
                ],
            ]
        );
        $settings = [
            'sa_el_show_image' => $settings['sa_el_show_image'],
            'image_size' => $settings['image_size'],
            'sa_el_show_title' => $settings['sa_el_show_title'],
            'sa_el_show_excerpt' => $settings['sa_el_show_excerpt'],
            'sa_el_show_meta' => $settings['sa_el_show_meta'],
            'meta_position' => $settings['meta_position'],
            'sa_el_excerpt_length' => intval($settings['sa_el_excerpt_length'], 10),
            'sa_el_post_grid_hover_animation' => $settings['sa_el_post_grid_hover_animation'],
            'sa_el_post_grid_bg_hover_icon' => (isset($settings['__fa4_migrated']['sa_el_post_grid_bg_hover_icon_new']) || empty($settings['sa_el_post_grid_bg_hover_icon'])) ? $settings['sa_el_post_grid_bg_hover_icon_new']['value'] : $settings['sa_el_post_grid_bg_hover_icon'],
            'sa_el_show_read_more_button' => $settings['sa_el_show_read_more_button'],
            'read_more_button_text' => $settings['read_more_button_text'],
            'read_more_button_text' => $settings['read_more_button_text'],
            'sa_el_post_grid_columns' => $settings['sa_el_post_grid_columns'],
            'show_load_more' => $settings['show_load_more'],
            'show_load_more_text' => $settings['show_load_more_text'],
            'expanison_indicator' => $settings['excerpt_expanison_indicator']
        ];
        echo '<div ' . $this->get_render_attribute_string('post_grid_wrapper') . '>
                <div class="sa-el-post-grid sa-el-post-appender sa-el-post-appender-' . $this->get_id() . '">
                    ' . Post_Query::__post_template($args, $settings) . '
                </div>
                <div class="clearfix"></div>
            </div>
        ';
        if (1 == $settings['show_load_more']) {
            if ($args['posts_per_page'] != '-1') {
                echo '  <div class="sa-el-load-more-button-wrap">
                            <button class="sa-el-load-more-button sa-el-load-more-post-grid" id="sa-el-load-more-btn-' . $this->get_id() . '" data-widget="' . $this->get_id() . '" data-class="SA_EL_ADDONS\Elements\Post_Grid\Files\Post_Query" data-function="__ajax_template" data-args=\'' . json_encode($args) . '\' data-settings=\'' . json_encode($settings) . '\' data-layout="masonry" data-page="1">
                                    <div class="sa-el-btn-loader button__loader"></div>
                                    <span>' . esc_html__($settings['show_load_more_text'], SA_EL_ADDONS_TEXTDOMAIN) . '</span>
                            </button>
                        </div>';
            }
        }

        if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            echo '<script type="text/javascript">
                    jQuery(document).ready(function() {
                        jQuery(".sa-el-post-grid").each(function() {
                            var $scope = jQuery(".elementor-element-' . $this->get_id() . '");

                            // init isotope
                            var $gallery = jQuery(".sa-el-post-grid", $scope).isotope({
                                itemSelector: ".sa-el-grid-post",
                                masonry: {
                                    columnWidth: ".sa-el-post-grid-column",
                                    percentPosition: true
                                }
                            });

                            // layout gal, while images are loading
                            $gallery.imagesLoaded().progress(function() {
                                $gallery.isotope("layout");
                            });
                        });
                    });
                </script>';
        }
    }
}
