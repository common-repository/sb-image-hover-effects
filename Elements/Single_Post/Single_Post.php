<?php

namespace SA_EL_ADDONS\Elements\Single_Post;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Utils;

class Single_Post extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_single_post';
    }

    public function get_title() {
        return esc_html__('Single Post', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-image-rollover oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    public function get_keywords() {
        return ['single', 'post', 'recent', 'news', 'blog'];
    }

    public function sa_el_get_my_post() {

        $post_types = get_post_types();
        $post_type_not__in = array('attachment', 'revision', 'nav_menu_item', 'custom_css', 'customize_changeset', 'elementor_library', 'post');

        foreach ($post_type_not__in as $post_type_not) {
            unset($post_types[$post_type_not]);
        }
        $post_type = array_values($post_types);


        $all_posts = get_posts(array(
            'posts_per_page' => -1,
            'post_type' => 'post',
                )
        );
        if (!empty($all_posts) && !is_wp_error($all_posts)) {
            foreach ($all_posts as $post) {
                $this->options[$post->ID] = strlen($post->post_title) > 20 ? substr($post->post_title, 0, 20) . '...' : $post->post_title;
            }
        }
        return $this->options;
    }

    protected function _register_controls() {
        $this->start_controls_section(
                'section_content_layout',
                [
                    'label' => esc_html__('Layout', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'post_list',
                [
                    'label' => __('Content', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Elementor Template is a template which you can choose from Elementor Templates library', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT2,
                    'options' => $this->sa_el_get_my_post(),
                ]
        );
        // $post_list = get_posts(['numberposts' => 50]);
        // $post_list_options = ['0' => esc_html__( 'Select Post', SA_EL_ADDONS_TEXTDOMAIN ) ];
        // foreach ( $post_list as $list ) :
        // 	$post_list_options[ $list->ID ] = $list->post_title;
        // endforeach;
//        $this->add_control(
//                'post_list',
//                [
//                    'label' => esc_html__('Enter Post ID', SA_EL_ADDONS_TEXTDOMAIN),
//                    'type' => Controls_Manager::TEXT,
//                ]
//        );

        $this->add_control(
                'show_tag',
                [
                    'label' => esc_html__('Tag', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'show_title',
                [
                    'label' => esc_html__('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'link_title',
                [
                    'label' => esc_html__('Link Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'condition' => [
                        'show_title' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'show_date',
                [
                    'label' => esc_html__('Date', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'show_category',
                [
                    'label' => esc_html__('Category', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'show_excerpt',
                [
                    'label' => esc_html__('Excerpt', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                ]
        );

        $this->add_control(
                'excerpt_length',
                [
                    'label' => esc_html__('Excerpt Length', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 40,
                    'condition' => [
                        'show_excerpt' => 'yes',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();

        $this->start_controls_section(
                'section_style_tag',
                [
                    'label' => esc_html__('Tag', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_tag' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'tag_background',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-single-post .sa-el-single-post-tag-wrap span' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'tag_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-single-post .sa-el-single-post-tag-wrap span' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'tag_border',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-single-post .sa-el-single-post-tag-wrap span',
                ]
        );

        $this->add_control(
                'tag_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-single-post .sa-el-single-post-tag-wrap span' => 'border-radius: {{SIZE}}{{UNIT}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'tag_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-single-post .sa-el-single-post-tag-wrap span',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_title',
                [
                    'label' => esc_html__('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_title' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'title_color',
                [
                    'label' => esc_html__('Title Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-single-post .sa-el-single-post-title' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-single-post .sa-el-single-post-title',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_date',
                [
                    'label' => esc_html__('Date', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_date' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'date_color',
                [
                    'label' => esc_html__('Date Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#e5e5e5',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-single-post .sa-el-single-post-meta span' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'date_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-single-post .sa-el-single-post-meta span',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_category',
                [
                    'label' => esc_html__('Category', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_category' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'category_color',
                [
                    'label' => esc_html__('Category Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#e5e5e5',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-single-post .sa-el-single-post-meta a' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'category_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-single-post .sa-el-single-post-meta a',
                ]
        );

        $this->add_control(
                'meta_separator_color',
                [
                    'label' => esc_html__('Meta Separator Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'separator' => 'after',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-subnav span:after' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_excerpt',
                [
                    'label' => esc_html__('Excerpt', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_excerpt' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'excerpt_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-single-post .sa-el-single-post-excerpt' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'excerpt_spacing',
                [
                    'label' => esc_html__('Sapce', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-single-post .sa-el-single-post-excerpt' => 'margin-top: {{SIZE}}px;',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'excerpt_typography',
                    'label' => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                    'selector' => '{{WRAPPER}} .sa-el-single-post .sa-el-single-post-excerpt',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_overlay',
                [
                    'label' => esc_html__('Overlay', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'overlay_color',
                [
                    'label' => esc_html__('Overlay Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-single-post .sa-el-overlay-primary' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    public function filter_excerpt_length() {
        return $this->get_settings('excerpt_length');
    }

    public function filter_excerpt_more($more) {
        return '';
    }

    protected function render_excerpt() {
        if (!$this->get_settings('show_excerpt')) {
            return;
        }

        add_filter('excerpt_more', [$this, 'filter_excerpt_more'], 20);
        add_filter('excerpt_length', [$this, 'filter_excerpt_length'], 20);
        ?>
        <div class="sa-el-single-post-excerpt">
            <?php do_shortcode(the_excerpt()); ?>
        </div>
        <?php
        remove_filter('excerpt_length', [$this, 'filter_excerpt_length'], 20);
        remove_filter('excerpt_more', [$this, 'filter_excerpt_more'], 20);
    }

    protected function render() {
        $settings = $this->get_settings();
        $id = $this->get_id();
        $single_post = get_post($settings['post_list']);

        if ($single_post) {

            $placeholder_image_src = Utils::get_placeholder_image_src();
            $image_src = wp_get_attachment_image_src(get_post_thumbnail_id($single_post->ID), 'large');

            if (!$image_src) {
                $image_src = $placeholder_image_src;
            } else {
                $image_src = $image_src[0];
            }
            ?>

            <div id="sa-el-single-post-<?php echo esc_attr($id); ?>" class="sa-el-single-post">
                <div class="sa-el-single-post-item">
                    <div class="sa-el-single-post-thumbnail-wrap sa-el-position-relative">
                        <div class="sa-el-single-post-thumbnail">
                            <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_html($single_post->post_title); ?>">
                                <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_html($single_post->post_title); ?>">
                            </a>
                        </div>
                        <div class="sa-el-overlay-primary sa-el-position-cover"></div>
                        <div class="sa-el-single-post-desc sa-el-text-center sa-el-position-center sa-el-position-medium sa-el-position-z-index">
                            <?php if ($settings['show_tag']) : ?>
                                <div class="sa-el-single-post-tag-wrap">
                                    <?php
                                    $tags_list = get_the_tag_list('<span class="sa-el-background-primary">', '</span> <span class="sa-el-background-primary">', '</span>', $single_post->ID);
                                    if ($tags_list) :
                                        echo wp_kses_post($tags_list);
                                    endif;
                                    ?>
                                </div>
                            <?php endif ?>

                            <?php if ($settings['show_title']) : ?>

                                <?php if ($settings['link_title']) : ?>
                                    <a href="<?php echo esc_url(get_permalink($single_post->ID)); ?>" class="sa-el-single-post-link" title="<?php echo esc_html($single_post->post_title); ?>">
                                    <?php endif; ?>									

                                    <h2 class="sa-el-single-post-title sa-el-margin-small-top sa-el-margin-remove-bottom"><?php echo esc_html($single_post->post_title); ?></h2>

                                    <?php if ($settings['link_title']) : ?>									
                                    </a>
                                <?php endif; ?>		

                            <?php endif ?>

                            <?php if ($settings['show_category'] or $settings['show_date']) : ?>
                                <div class="sa-el-single-post-meta sa-el-flex-center sa-el-subnav sa-el-flex-middle sa-el-margin-small-top">
                                    <?php if ($settings['show_category']) : ?>
                                        <?php echo '<span>' . get_the_category_list(', ', '', $single_post->ID) . '</span>'; ?>
                                    <?php endif ?>

                                    <?php if ($settings['show_date']) : ?>
                                        <?php echo '<span>' . esc_attr(get_the_date('d F Y', $single_post->ID)) . '</span>'; ?>
                                    <?php endif ?>
                                </div>
                            <?php endif ?>


                            <?php $this->render_excerpt(); ?>


                        </div>
                    </div>
                </div>
            </div>

            <?php
        } else {
            echo '<div class="sa-el-alert-warning" sa-el-alert>Oops! You did not select any post from settings.</div>';
        }
    }

}
