<?php

namespace SA_EL_ADDONS\Elements\LearnDash_Course;

if (!defined('ABSPATH'))
    exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Frontend;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use \Elementor\Scheme_Typography;
use \Elementor\Group_Control_Background;

class LearnDash_Course extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    /**
     * Get post tags with id or slug
     * 
     * @param string $type
     */
    public function sa_el_post_type_tags($type = 'term_id') {
        $options = [];

        $tags = get_tags([
            'hide_empty' => true
        ]);

        if (!empty($tags) && !is_wp_error($tags)) {
            foreach ($tags as $tag) {
                $options[$tag->{$type}] = $tag->name;
            }
        }

        return $options;
    }

    public function sa_el_learndash_post_taxonomy($taxonomy, $type = 'term_id') {
        $options = [];

        if (taxonomy_exists($taxonomy)) {
            $tags = get_terms([
                'taxonomy' => $taxonomy,
                'hide_empty' => false
            ]);

            if (!empty($tags) && !is_wp_error($tags)) {
                foreach ($tags as $tag) {
                    $options[$tag->{$type}] = $tag->name;
                }
            }
        }

        return $options;
    }

    public function get_name() {
        return 'sa_el_learndash_course';
    }

    public function get_title() {
        return esc_html__('LearnDash Course', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-slider-3d oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {



        if (!defined('LEARNDASH_VERSION')) {
            $this->start_controls_section(
                    'section_general_settings',
                    [
                        'label' => esc_html__('LearnDash', SA_EL_ADDONS_TEXTDOMAIN)
                    ]
            );

            $this->add_control(
                    'learndash_missing_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => sprintf(
                                __('<strong>LearnDash</strong> is not installed/activated on your site. Please install and activate <strong>LearnDash</strong> first.', SA_EL_ADDONS_TEXTDOMAIN),
                                '<a href="https://www.learndash.com/" target="_blank" rel="noopener">LearnDash</a>'
                        ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    ]
            );
            $this->end_controls_section();
            return;
        }
        /**
         * ----------------------------------------
         * General settings section
         * ----------------------------------------
         */
        $this->start_controls_section(
                'section_general_settings',
                [
                    'label' => esc_html__('Layout Settings', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );


        $this->add_control(
                'template_skin',
                [
                    'label' => esc_html__('Skins', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => false,
                    'description' => __('Select skin for different layout design.', SA_EL_ADDONS_TEXTDOMAIN),
                    'options' => [
                        'default' => __('Default', SA_EL_ADDONS_TEXTDOMAIN),
                        'layout__1' => __('Layout 1', SA_EL_ADDONS_TEXTDOMAIN),
                        'layout__2' => __('Layout 2', SA_EL_ADDONS_TEXTDOMAIN),
                        'layout__3' => __('Layout 3', SA_EL_ADDONS_TEXTDOMAIN)
                    ],
                    'default' => 'default'
                ]
        );

        $this->add_control('number_of_courses',
                [
                    'label' => __('Number of Courses', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __('How many courses will be displayed in your grid.', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => 10
                ]
        );

        $this->add_control(
                'course_category_name',
                [
                    'label' => __('Show by course category', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Shows only courses in the specified LearnDash category. Use the category slug.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT2,
                    'options' => $this->sa_el_learndash_post_taxonomy('ld_course_category', 'slug')
                ]
        );

        $this->add_control(
                'course_tag',
                [
                    'label' => __('Show by course tag', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Shows only courses tagged with the specified LearnDash tag. Use the tag slug.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT2,
                    'options' => $this->sa_el_post_type_tags('ld_course_tag', 'slug')
                ]
        );

        $this->add_responsive_control(
                'column',
                [
                    'label' => esc_html__('Columns', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => false,
                    'description' => __('Number of columns your grid will have on differnt screens.', SA_EL_ADDONS_TEXTDOMAIN),
                    'options' => [
                        '1' => __('1 Column', SA_EL_ADDONS_TEXTDOMAIN),
                        '2' => __('2 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        '3' => __('3 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        '4' => __('4 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        '5' => __('5 Columns', SA_EL_ADDONS_TEXTDOMAIN),
                        '6' => __('6 Columns', SA_EL_ADDONS_TEXTDOMAIN)
                    ],
                    'prefix_class' => 'elementor-grid%s-',
                    'frontend_available' => true,
                    'default' => '3',
                    'tablet_default' => '2',
                    'mobile_default' => '1'
                ]
        );



        $this->add_control(
                'show_tags',
                [
                    'label' => __('Tags', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Hide course tags.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'true' => [
                            'title' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-check',
                        ],
                        'false' => [
                            'title' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-ban',
                        ]
                    ],
                    'default' => 'true',
                    'condition' => [
                        'template_skin!' => 'layout__3'
                    ]
                ]
        );

        $this->add_control(
                'show_cats',
                [
                    'label' => __('Category', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Hide course category.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'true' => [
                            'title' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-check',
                        ],
                        'false' => [
                            'title' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-ban',
                        ]
                    ],
                    'default' => 'true',
                    'condition' => [
                        'template_skin' => 'layout__3'
                    ]
                ]
        );

        $this->add_control(
                'show_thumbnail',
                [
                    'label' => __('Thumbnail', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Hide the thumbnail image.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'true' => [
                            'title' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-check',
                        ],
                        'false' => [
                            'title' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-ban',
                        ]
                    ],
                    'default' => 'true',
                    'condition' => [
                        'template_skin!' => 'layout__3'
                    ]
                ]
        );

        $this->add_control(
                'show_course_meta',
                [
                    'label' => __('Course Meta', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Hide course meta.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'true' => [
                            'title' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-check',
                        ],
                        'false' => [
                            'title' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-ban',
                        ]
                    ],
                    'default' => 'true',
                    'condition' => [
                        'template_skin' => 'layout__2'
                    ]
                ]
        );

        $this->add_control(
                'show_content',
                [
                    'label' => __('Excerpt', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Hide course excerpt', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'true' => [
                            'title' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-check',
                        ],
                        'false' => [
                            'title' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-ban',
                        ]
                    ],
                    'default' => 'true',
                ]
        );

        $this->add_control(
                'excerpt_length',
                [
                    'label' => __('Excerpt Words', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '12',
                    'condition' => [
                        'show_content' => 'true',
                        'template_skin!' => ['layout__3', 'default']
                    ],
                ]
        );

        $this->add_control(
                'show_price',
                [
                    'label' => __('Price', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Hide course price', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'true' => [
                            'title' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-check',
                        ],
                        'false' => [
                            'title' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-ban',
                        ]
                    ],
                    'default' => 'true',
                    'condition' => [
                        'template_skin!' => ['layout__2']
                    ]
                ]
        );

        $this->add_control(
                'show_button',
                [
                    'label' => __('Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Hide course enroll button.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'true' => [
                            'title' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-check',
                        ],
                        'false' => [
                            'title' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-ban',
                        ]
                    ],
                    'default' => 'true'
                ]
        );


        $this->add_control(
                'show_progress_bar',
                [
                    'label' => __('Progress Bar', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('A visual indicator of a student’s current progress in each course.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'true' => [
                            'title' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-check',
                        ],
                        'false' => [
                            'title' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-ban',
                        ]
                    ],
                    'default' => 'true'
                ]
        );

        $this->add_control(
                'show_author_meta',
                [
                    'label' => __('Author Meta', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Hide show author meta from courses.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'true' => [
                            'title' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-check',
                        ],
                        'false' => [
                            'title' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-ban',
                        ]
                    ],
                    'default' => 'true',
                    'condition' => [
                        'template_skin' => 'layout__1'
                    ]
                ]
        );

        $this->end_controls_section();
        #End of `General Settings` section


        /**
         * Sorting section
         * ----------------------------------------
         */
        $this->start_controls_section(
                'section_sorting',
                [
                    'label' => esc_html__('Sorting Options', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control(
                'orderby',
                [
                    'label' => esc_html__('Course Sorting', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => false,
                    'description' => __('How to sort the courses in your grid.', SA_EL_ADDONS_TEXTDOMAIN),
                    'options' => [
                        'title' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                        'ID' => __('ID', SA_EL_ADDONS_TEXTDOMAIN),
                        'date' => __('Date', SA_EL_ADDONS_TEXTDOMAIN),
                        'modified' => __('Modified', SA_EL_ADDONS_TEXTDOMAIN),
                        'menu_order' => __('Menu Order', SA_EL_ADDONS_TEXTDOMAIN),
                        'rand' => __('Random', SA_EL_ADDONS_TEXTDOMAIN)
                    ],
                    'default' => 'date',
                ]
        );

        $this->add_control(
                'order',
                [
                    'label' => esc_html__('Order of Sorting', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => false,
                    'description' => __('The sort order for the “orderby” parameter.', SA_EL_ADDONS_TEXTDOMAIN),
                    'options' => [
                        'ASC' => __('ASC', SA_EL_ADDONS_TEXTDOMAIN),
                        'DESC' => __('DESC', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'ASC',
                ]
        );

        $this->add_control(
                'mycourses',
                [
                    'label' => esc_html__('My Courses', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT2,
                    'description' => __('Shows only the courses in which the current user is enrolled.', SA_EL_ADDONS_TEXTDOMAIN),
                    'options' => [
                        'default' => __('Default', SA_EL_ADDONS_TEXTDOMAIN),
                        'enrolled' => __('Enrolled Only', SA_EL_ADDONS_TEXTDOMAIN),
                        'not-enrolled' => __('Not Enrolled Only', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'default',
                ]
        );

        $this->end_controls_section();
        #End of `General Settings` section


        $this->Sa_El_Support();


        /**
         * Card Style section
         * ----------------------------------------
         */
        $this->start_controls_section(
                'card_style_section',
                [
                    'label' => esc_html__('Card Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE
                ]
        );

        $this->start_controls_tabs('sa_el_learn_dash_card_tabs');

        $this->start_controls_tab(
                'sa_el_learn_dash_card_tab_normal',
                [
                    'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'card_background',
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => '#ffffff',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner',
                ]
        );

        $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name' => 'card_border',
                    'selector' => '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner',
                ]
        );

        $this->add_responsive_control(
                'card_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'card_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner',
                ]
        );

        $this->add_responsive_control(
                'card_transition',
                [
                    'label' => __('Transition', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '300',
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10000,
                            'step' => 100,
                        ],
                    ],
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-course .sa-el-learn-dash-course-inner' => 'transition: {{SIZE}}ms',
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'sa_el_learn_dash_card_tab_hover',
                [
                    'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control(
                '3d_hover',
                [
                    'label' => __('Enable 3D Hover', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'card_hover_background',
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => '#ffffff',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner:hover',
                ]
        );

        $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name' => 'card_hover_border',
                    'selector' => '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner:hover',
                ]
        );

        $this->add_responsive_control(
                'card_hover_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'card_hover_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner:hover',
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_responsive_control(
                'card_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-learn-deash-course-content-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .sa-el-learndash-wrapper.layout__3 .card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'card_margin',
                [
                    'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();
        # End of `Card style`

        /**
         * Tags Style section
         * ----------------------------------------
         */
        $this->start_controls_section(
                'tags_style_section',
                [
                    'label' => esc_html__('Tags Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_tags' => 'true',
                        'template_skin!' => 'layout__3'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'tags_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '.sa-el-learndash-wrapper .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .course-tag',
                ]
        );

        $this->add_responsive_control(
                'tags_spacing',
                [
                    'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .course-tag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'tags_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#f31768',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .course-tag' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'tags_background',
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'types' => ['classic', 'gradient'],
                    'exclude' => [
                        'image',
                    ],
                    'selector' => '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .course-tag',
                ]
        );

        $this->end_controls_section();
        # End of `Tags Style section`

        /**
         * Image Style section
         * ----------------------------------------
         */
        $this->start_controls_section(
                'image_style_section',
                [
                    'label' => esc_html__('Image Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_thumbnail' => 'true'
                    ]
                ]
        );

        $this->add_responsive_control(
                'image_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '10',
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 80,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-learn-dash-course-thumbnail img' => 'border-radius: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .sa-el-learndash-wrapper.layout__3 a.card-thumb' => 'border-radius: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .sa-el-learndash-wrapper.layout__3 .sa-el-learn-dash-course-inner' => 'border-top-left-radius: {{SIZE}}{{UNIT}}; border-top-right-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control(
                'image_space',
                [
                    'label' => __('Bottom Space', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '0',
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 80,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-learn-dash-course-thumbnail' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .sa-el-learndash-wrapper.layout__3 a.card-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->end_controls_section();
        # End of `Image Style section`

        /**
         * Color &  Typography section
         * ----------------------------------------
         */
        $this->start_controls_section(
                'color_&_typography_section',
                [
                    'label' => esc_html__('Color & Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_typo_heading',
                [
                    'label' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING
                ]
        );

        $this->add_control(
                'title_tag',
                [
                    'label' => esc_html__('Title Tag', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => false,
                    'options' => [
                        'h1' => __('H1', SA_EL_ADDONS_TEXTDOMAIN),
                        'h2' => __('H2', SA_EL_ADDONS_TEXTDOMAIN),
                        'h3' => __('H3', SA_EL_ADDONS_TEXTDOMAIN),
                        'h4' => __('H4', SA_EL_ADDONS_TEXTDOMAIN),
                        'h5' => __('H5', SA_EL_ADDONS_TEXTDOMAIN),
                        'h6' => __('H6', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'h4'
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-learn-deash-course-content-card .course-card-title, {{WRAPPER}} .sa-el-learn-dash-course.sa-el-course-layout-3.card-style .card-body .course-card-title',
                ]
        );

        $this->add_control(
                'title_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#485771',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-learn-deash-course-content-card .course-card-title a' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .sa-el-learn-dash-course.sa-el-course-layout-3.card-style .card-body .course-card-title a' => 'color: {{VALUE}};'
                    ]
                ]
        );

        $this->add_responsive_control(
                'title_spacing',
                [
                    'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-learn-deash-course-content-card .course-card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .sa-el-learn-dash-course.sa-el-course-layout-3.card-style .card-body .course-card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'content_typo_heading',
                [
                    'label' => __('Content', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'show_content' => 'true'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-learn-dash-course-short-desc',
                    'condition' => [
                        'show_content' => 'true'
                    ]
                ]
        );

        $this->add_control(
                'content_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#485771',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-learn-dash-course-short-desc' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'show_content' => 'true'
                    ]
                ]
        );

        $this->add_responsive_control(
                'content_spacing',
                [
                    'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-learn-dash-course-short-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_content' => 'true'
                    ]
                ]
        );

        $this->end_controls_section();
        # End of `Color & typography section`

        /**
         * Price ticker section
         * ----------------------------------------
         */
        $this->start_controls_section(
                'price_ticker_style_section',
                [
                    'label' => esc_html__('Price', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_author_meta' => 'true',
                        'template_skin' => 'layout__1'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'price_ticker_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-learndash-wrapper .price-ticker-tag',
                ]
        );

        $this->add_control(
                'price_ticker_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .price-ticker-tag' => 'color: {{VALUE}};',
                    ]
                ]
        );

        $this->add_control(
                'price_ticker_position',
                [
                    'label' => esc_html__('Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => false,
                    'description' => __('Select price ticker position.', SA_EL_ADDONS_TEXTDOMAIN),
                    'options' => [
                        'left-top' => __('Left - Top', SA_EL_ADDONS_TEXTDOMAIN),
                        'left-bottom' => __('Left - Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                        'right-top' => __('Right - Top', SA_EL_ADDONS_TEXTDOMAIN),
                        'right-bottom' => __('Right - Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'left-bottom',
                    'prefix_class' => 'price-tikcer-position-'
                ]
        );

        $this->add_responsive_control(
                'price_ticker_border_radus',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .price-ticker-tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
        );

        $this->add_responsive_control(
                'price_ticker_height',
                [
                    'label' => __('Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '42',
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .price-ticker-tag' => 'height: {{SIZE}}{{UNIT}}',
                    ]
                ]
        );

        $this->add_responsive_control(
                'price_ticker_width',
                [
                    'label' => __('Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '25',
                        'unit' => '%',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .price-ticker-tag' => 'width: {{SIZE}}{{UNIT}}',
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'price_ticker_background',
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'types' => ['classic', 'gradient'],
                    'exclude' => [
                        'image',
                    ],
                    'default' => '#f31768',
                    'selector' => '{{WRAPPER}} .sa-el-learndash-wrapper .price-ticker-tag',
                ]
        );

        $this->end_controls_section();
        # End of `Price ticker section`

        /**
         * Price section
         * ----------------------------------------
         */
        $this->start_controls_section(
                'price_style_section',
                [
                    'label' => esc_html__('Price', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_price' => 'true',
                        'template_skin' => ['layout__3', 'default']
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'price_background',
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'types' => ['classic', 'gradient'],
                    'exclude' => [
                        'image',
                    ],
                    'default' => '#f31768',
                    'selector' => '{{WRAPPER}} .sa-el-learndash-wrapper .card-price',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'price_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-learndash-wrapper .card-price',
                ]
        );

        $this->add_control(
                'price_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .card-price' => 'color: {{VALUE}};',
                    ]
                ]
        );

        $this->add_responsive_control(
                'price_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .card-price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
        );

        $this->add_responsive_control(
                'price_circle_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '50',
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 95,
                            'step' => 5,
                        ],
                    ],
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .card-price' => 'width:{{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ]
                ]
        );

        $this->end_controls_section();
        # End of `Price ticker section`

        /**
         * Course Meta section bottom 
         * ----------------------------------------
         */
        $this->start_controls_section(
                'section_inline_author_meta',
                [
                    'label' => esc_html__('Author Meta', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'template_skin' => ['default', 'layout__1']
                    ]
                ]
        );

        $this->add_responsive_control(
                'author_meta_space_around',
                [
                    'label' => esc_html__('Space Around', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-author-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'template_skin' => 'layout__1'
                    ]
                ]
        );

        $this->add_control(
                'author_meta_avatar',
                [
                    'label' => __('Avatar', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING
                ]
        );

        $this->add_responsive_control(
                'author_avatar_size',
                [
                    'label' => __('Avatar Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '50',
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 95,
                            'step' => 5,
                        ],
                    ],
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-author-meta .author-image' => 'flex-basis:{{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'template_skin' => 'layout__1'
                    ]
                ]
        );

        $this->add_responsive_control(
                'avatar_border_radus',
                [
                    'label' => esc_html__('Avatar Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-author-meta .author-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'template_skin' => 'layout__1'
                    ]
                ]
        );

        $this->add_responsive_control(
                'avatar_space',
                [
                    'label' => __('Avatar Space', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '15',
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 30,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-author-meta .author-image' => 'margin-right: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'template_skin' => 'layout__1'
                    ]
                ]
        );

        $this->add_control(
                'author_meta_heading',
                [
                    'label' => __('Author', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING
                ]
        );

        $this->add_control(
                'inline_author_meta',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course-inner .course-author-meta-inline span' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'inline_author_meta_link',
                [
                    'label' => esc_html__('Link Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course-inner .course-author-meta-inline a' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'inline_author_meta_link_hover',
                [
                    'label' => esc_html__('Link Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course-inner .course-author-meta-inline a:hover' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'author_meta_date',
                [
                    'label' => __('Date', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING
                ]
        );

        $this->add_control(
                'author_meta_date_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-author-meta .author-desc .author-designation' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'author_meta_date_typo',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-learndash-wrapper .sa-el-learn-dash-author-meta .author-desc .author-designation',
                ]
        );


        $this->end_controls_section();
        # End of `Course Meta section bottom`


        /**
         * Course Meta section
         * ----------------------------------------
         */
        $this->start_controls_section(
                'course_meta_style_section',
                [
                    'label' => esc_html__('Course Meta', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_course_meta' => 'true',
                        'template_skin' => 'layout__2'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'course_meta_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-learn-deash-course-content-card .sa-el-learn-dash-course-meta-card span',
                ]
        );

        $this->add_control(
                'course_meta_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#f31768',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-learn-deash-course-content-card .sa-el-learn-dash-course-meta-card span' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'course_meta_icon_space',
                [
                    'label' => __('Icon Space', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '8',
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 25,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-learn-deash-course-content-card .sa-el-learn-dash-course-meta-card span i' => 'margin-right: {{SIZE}}{{UNIT}}',
                    ]
                ]
        );

        $this->add_responsive_control(
                'course_meta_each_space',
                [
                    'label' => __('Meta Space', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '25',
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 40,
                            'step' => 1,
                        ],
                    ],
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course-inner .sa-el-learn-deash-course-content-card .sa-el-learn-dash-course-meta-card span.enrolled-count' => 'margin: 0 {{SIZE}}{{UNIT}}',
                    ]
                ]
        );

        $this->end_controls_section();
        # End of `Course meta section`

        /**
         * Button style section
         * ----------------------------------------
         */
        $this->start_controls_section(
                'button_style_section',
                [
                    'label' => esc_html__('Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_button' => 'true'
                    ]
                ]
        );

        $this->start_controls_tabs(
                'button_controls_tabs',
                [
                    'separator' => 'after'
                ]
        );
        $this->start_controls_tab(
                'button_controls_normal',
                [
                    'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-course-button',
                ]
        );

        $this->add_control(
                'button_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-course-button' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'button_background',
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'types' => ['classic', 'gradient'],
                    'exclude' => [
                        'image',
                    ],
                    'default' => '#f31768',
                    'selector' => '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-course-button',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-course-button',
                ]
        );

        $this->add_responsive_control(
                'button_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-course-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
        );

        $this->add_responsive_control(
                'button_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-course-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
        );

        $this->add_responsive_control(
                'button_margin',
                [
                    'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-course-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'button_controls_hover',
                [
                    'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control(
                'button_color_hover',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-course-button:hover' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'button_background_hover',
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'types' => ['classic', 'gradient'],
                    'exclude' => [
                        'image',
                    ],
                    'default' => '#f31768',
                    'selector' => '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-course-button:hover',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_shadow_hover',
                    'selector' => '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-course-button:hover',
                ]
        );

        $this->add_responsive_control(
                'button_transition_hover',
                [
                    'label' => __('Transition', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Hover transition in ms.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '300',
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 10,
                        ],
                    ],
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-course-button' => 'transition:{{SIZE}}ms',
                    ]
                ]
        );

        $this->add_responsive_control(
                'button_border_radius_hover',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course .sa-el-learn-dash-course-inner .sa-el-course-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        # End of `Button style section`

        /**
         * Progressbar section
         * ----------------------------------------
         */
        $this->start_controls_section(
                'progress_bar_style_section',
                [
                    'label' => esc_html__('Progress Bar', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_progress_bar' => 'true'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'progressbar_title_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .learndash-wrapper.learndash-widget .ld-progress .ld-progress-percentage',
                ]
        );

        $this->add_control(
                'progressbar_title_color',
                [
                    'label' => esc_html__('Label Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#f31768',
                    'selectors' => [
                        '{{WRAPPER}} .learndash-wrapper.learndash-widget .ld-progress .ld-progress-percentage' => 'color: {{VALUE}};'
                    ],
                ]
        );

        $this->add_control(
                'progressbar_fill_color',
                [
                    'label' => esc_html__('Fill Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#f31768',
                    'selectors' => [
                        '{{WRAPPER}} .learndash-wrapper.learndash-widget .ld-progress .ld-progress-bar .ld-progress-bar-percentage' => 'background: {{VALUE}};'
                    ],
                ]
        );

        $this->add_responsive_control(
                'progressbar_margin',
                [
                    'label' => esc_html__('Space', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .learndash-wrapper .ld-progress.ld-progress-inline' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
        );

        $this->add_responsive_control(
                'progressbar_label_alignment',
                [
                    'label' => __('Label Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-end' => [
                            'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-center',
                        ],
                        'flex-start' => [
                            'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right',
                        ]
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learndash-wrapper .learndash-wrapper .ld-progress.ld-progress-inline' => 'justify-content: {{VALUE}};',
                    ]
                ]
        );

        $this->add_control(
                'progressbar_step_label',
                [
                    'label' => __('Enable Steps Label', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                    'prefix_class' => 'course-steps-label-',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'steps_label_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-learn-dash-course .learndash-wrapper.learndash-widget .ld-progress .ld-progress-steps',
                    'condition' => [
                        'progressbar_step_label' => 'yes'
                    ]
                ]
        );

        $this->add_control(
                'progress_label_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course .learndash-wrapper.learndash-widget .ld-progress .ld-progress-steps' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'progressbar_step_label' => 'yes'
                    ]
                ]
        );

        $this->add_responsive_control(
                'progress_label_margin',
                [
                    'label' => esc_html__('Space', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-learn-dash-course .learndash-wrapper.learndash-widget .ld-progress .ld-progress-steps' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'progressbar_step_label' => 'yes'
                    ]
                ]
        );

        $this->end_controls_section();
    }

    protected function _generate_tags($tags) {
        $settings = $this->get_settings();

        if (!empty($tags) && $settings['show_tags'] === 'true') {
            $i = 0;
            ?>
            <div class="sa-el-learn-dash-course-header">
                <?php
                foreach ($tags as $tag) {
                    if ($i == 3)
                        break;
                    if ($tag) {
                        echo '<div class="course-tag">' . $tag->name . '</div>';
                    }
                    $i++;
                }
                ?>
            </div>
            <?php
        }
    }

    protected function get_courses() {
        $settings = $this->get_settings();

        // Default args
        $query_args = [
            'post_type' => 'sfwd-courses',
            'numberposts' => $settings['number_of_courses'],
            'orderby' => $settings['orderby'],
            'order' => $settings['order']
        ];

        $query_args['tax_query'] = [];
        $query_args['tax_query']['relation'] = 'OR';

        /**
         * Course filter by course category & tag
         */
        if (!empty($settings['course_cat'])) {
            $query_args['tax_query'][] = [
                'taxonomy' => 'ld_course_category',
                'field' => 'id',
                'terms' => array($settings['course_cat']),
            ];
        }

        if (!empty($settings['course_category_name'])) {
            $query_args['tax_query'][] = [
                'taxonomy' => 'ld_course_category',
                'field' => 'slug',
                'terms' => array($settings['course_category_name']),
            ];
        }

        if (!empty($settings['course_tag_id'])) {
            $query_args['tax_query'][] = [
                'taxonomy' => 'ld_course_tag',
                'field' => 'id',
                'terms' => array($settings['course_tag_id']),
            ];
        }

        if (!empty($settings['course_tag'])) {
            $query_args['tax_query'][] = [
                'taxonomy' => 'ld_course_tag',
                'field' => 'slug',
                'terms' => array($settings['course_tag']),
            ];
        }
        #end of course category & tag filter.

        return get_posts($query_args);
    }

    protected function get_enrolled_courses_only(array $data) {
        $course_ids = wp_list_pluck($data, 'ID');
        return array_intersect($course_ids, ld_get_mycourses(get_current_user_id()));
    }

    protected function get_controlled_short_desc($desc = '', $length) {
        if ($desc && $length) {

            $desc = strip_tags(strip_shortcodes($desc)); //Strips tags and images
            $words = explode(' ', $desc, $length + 1);

            if (count($words) > $length):
                array_pop($words);
                array_push($words, '…');
                $desc = implode(' ', $words);
            endif;
        }

        return $desc;
    }

    protected function render() {
        if (!defined('LEARNDASH_VERSION'))
            return;

        $settings = $this->get_settings();


        $this->add_render_attribute(
                'sa-el-learn-dash-wrapper',
                [
                    'class' => [
                        'sa-el-learndash-wrapper',
                        'sa-el-learndash-col-' . $settings['column'],
                        $settings['template_skin'],
                    ]
                ]
        );

        if ($settings['3d_hover']) {
            $this->add_render_attribute('sa-el-learn-dash-wrapper', 'class', 'sa-el-3d-hover');
            $this->add_render_attribute('sa-el-learn-dash-wrapper', 'data-3d-hover', $settings['3d_hover']);
        }

        $courses = $this->get_courses();

        // Get user enrolled courses.
        if ($settings['mycourses'] === 'enrolled' || $settings['mycourses'] === 'not-enrolled') {
            $enrolled_course_only = $this->get_enrolled_courses_only($courses);
        }


        ob_start();
        $html = '<div ' . $this->get_render_attribute_string('sa-el-learn-dash-wrapper') . '>';
        if ($courses) {
            foreach ($courses as $course) {

                if ($settings['mycourses'] === 'enrolled') {
                    // Get enrolled courses only
                    if (!in_array($course->ID, $enrolled_course_only))
                        continue;
                }

                if ($settings['mycourses'] === 'not-enrolled') {
                    // Get not enrolled courses only
                    if (in_array($course->ID, $enrolled_course_only))
                        continue;
                }

                $legacy_meta = get_post_meta($course->ID, '_sfwd-courses', true);
                $users = explode(',', get_post_meta($course->ID, 'course_access_list', true));
                $short_desc = get_post_meta($course->ID, '_learndash_course_grid_short_description', true);
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($course->ID), 'medium');
                $image_alt = get_post_meta(get_post_thumbnail_id($course->ID), '_wp_attachment_image_alt', true);
                $access_list = count($users);
                $button_text = get_post_meta($course->ID, '_learndash_course_grid_custom_button_text', true);
                $tags = wp_get_post_terms($course->ID, 'ld_course_tag');
                $excerpt_length = $settings['excerpt_length'] ? $settings['excerpt_length'] : null;
                $cats = wp_get_post_terms($course->ID, 'ld_course_category');
                $price = $legacy_meta['sfwd-courses_course_price'] ? $legacy_meta['sfwd-courses_course_price'] : 'Free';

                // $ribbon_text = get_post_meta($course->ID, '_learndash_course_grid_custom_ribbon_text', true); // not using

                if ($settings['template_skin'] === 'default' || $settings['template_skin'] === 'layout__1' || $settings['template_skin'] === 'layout__3') {
                    global $authordata;
                    $author_courses = add_query_arg(
                            'post_type',
                            'sfwd-courses',
                            get_author_posts_url($authordata->ID, $authordata->user_nicename)
                    );

                    $author_courses_from_cat = add_query_arg([
                        'post_type' => 'sfwd-courses',
                        'ld_course_category' => esc_attr($cats[0]->name)
                            ], get_author_posts_url($authordata->ID, $authordata->user_nicename));
                }

                $file = SA_EL_ADDONS_PATH . "Elements/LearnDash_Course/skins/" . $settings['template_skin'] . ".php";

                if (file_exists($file)) {
                    require $file;
                } else {
                    echo __("Course layout file not found! It's must be removed \n", SA_EL_ADDONS_TEXTDOMAIN);
                }
            }

            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                $html .= '
                <script type="text/javascript">
                    jQuery(document).ready(function($){
                        $(".sa-el-learndash-wrapper").each(function() {
                            var $node_id = "' . $this->get_id() . '",
                                $scope = $(".elementor-element-"+$node_id+"");

                            var $settings = {
                                itemSelector: ".sa-el-learn-dash-course",
                                percentPosition: true,
                                masonry: {
                                    columnWidth: ".sa-el-learn-dash-course"
                                }
                            };
                    
                            // init isotope
                            $ld_gallery = $(".sa-el-learndash-wrapper", $scope).isotope($settings);
                    
                            // layout gal, while images are loading
                            $ld_gallery.imagesLoaded().progress(function() {
                                $ld_gallery.isotope("layout");
                            });
                        });
                        
                    });
                </script>
                ';
            }
        } else {
            $html .= "<h4>" . __('No Courses Found!', SA_EL_ADDONS_TEXTDOMAIN) . '</h4>';
        }
        $html .= ob_get_clean();

        $html .= '</div>';

        echo $html;
    }

    protected function content_template() {
        
    }

}
