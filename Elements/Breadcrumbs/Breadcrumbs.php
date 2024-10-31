<?php

namespace SA_EL_ADDONS\Elements\Breadcrumbs;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Breadcrumbs
 *
 * @author biplo
 * 
 */
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Widget_Base as Widget_Base;

class Breadcrumbs extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_breadcrumbs';
    }

    public function get_title() {
        return esc_html__('Breadcrumbs', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return ' eicon-clock-o  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'section_content',
                [
                    'label' => __('Breadcrumbs', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'display_heading',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => __('Display', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'source',
                [
                    'label' => __('Source', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => __('Current page', SA_EL_ADDONS_TEXTDOMAIN),
                        'id' => __('Specific page', SA_EL_ADDONS_TEXTDOMAIN),
                    ]
                ]
        );

        $this->add_control(
                'source_id',
                [
                    'label' => __('ID', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'placeholder' => '15',
                    'condition' => [
                        'source' => 'id',
                    ]
                ]
        );

        $this->add_control(
                'show_home',
                [
                    'label' => __('Show Home', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'home_text',
                [
                    'label' => __('Home Text', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Homepage', SA_EL_ADDONS_TEXTDOMAIN),
                    'dynamic' => [
                        'active' => true,
                        'categories' => [TagsModule::POST_META_CATEGORY]
                    ],
                    'condition' => [
                        'show_home' => 'yes'
                    ],
                ]
        );

        $this->add_control(
                'separator_heading',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => __('Separator', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'separator_type',
                [
                    'label' => __('Separator Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'icon',
                    'options' => [
                        'text' => __('Text', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => __('Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'separator_text',
                [
                    'label' => __('Separator', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('>', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'separator_type' => 'text'
                    ],
                ]
        );

        $this->add_control(
                'separator_icon',
                [
                    'label' => __('Separator', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-angle-right',
                    'condition' => [
                        'separator_type' => 'icon'
                    ],
                ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();

        $this->start_controls_section(
                'section_item_style',
                [
                    'label' => __('Crumbs', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control(
                'items_align',
                [
                    'label' => __('Align', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => '',
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
                        'stretch' => [
                            'title' => __('Stretch', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-h-align-stretch',
                        ],
                    ],
                    'prefix_class' => 'sa-el-breadcrumbs-align-',
                ]
        );

        $this->add_responsive_control(
                'items_text_align',
                [
                    'label' => __('Align', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => '',
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
                        '{{WRAPPER}} .sa-el-breadcrumbs' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'item_spacing',
                [
                    'label' => __('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 12
                    ],
                    'range' => [
                        'px' => [
                            'max' => 36,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-breadcrumbs' => 'margin-left: -{{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .sa-el-breadcrumbs__item' => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .sa-el-breadcrumbs__separator' => 'margin-left: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'item_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-breadcrumbs__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'allowed_dimensions' => ['right', 'left'],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'item_border',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-breadcrumbs__item',
                ]
        );

        $this->add_control(
                'item_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-breadcrumbs__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'item_background_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-breadcrumbs__item' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'item_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-breadcrumbs__item' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .sa-el-breadcrumbs__item a' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'item_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-breadcrumbs',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_separators',
                [
                    'label' => __('Separators', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'separator_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-breadcrumbs__separator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'allowed_dimensions' => ['right', 'left'],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'separator_border',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-breadcrumbs__separator',
                ]
        );

        $this->add_control(
                'separator_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-breadcrumbs__separator' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'separator_background_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-breadcrumbs__separator' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'separator_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-breadcrumbs__separator' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'separator_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-breadcrumbs__separator',
                    'condition' => [
                        'separator_type' => 'text'
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_current_style',
                [
                    'label' => __('Current', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'current_border',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-breadcrumbs__item--current',
                ]
        );

        $this->add_control(
                'current_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-breadcrumbs__item--current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'current_background_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-breadcrumbs__item--current' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'current_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-breadcrumbs__item--current' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'current_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .sa-el-breadcrumbs__item--current',
                ]
        );

        $this->end_controls_section();
    }

    protected function get_query() {

        global $post;

        $settings = $this->get_settings_for_display();
        $_id = null;
        $_post_type = 'post';

        if ('id' === $settings['source'] && '' !== $settings['source_id']) {

            $_id = $settings['source_id'];
            $_post_type = 'any';

            $_args = array(
                'p' => $_id,
                'post_type' => $_post_type,
            );

            // Create custom query
            $_post_query = new \WP_Query($_args);

            return $_post_query;
        }

        return false;
    }

    protected function set_separator() {

        $settings = $this->get_settings_for_display();

        if ('icon' === $settings['separator_type']) {

            $separator = '<i class="' . $settings['separator_icon'] . '"></i>';
        } else {

            $this->add_inline_editing_attributes('separator_text');
            $this->add_render_attribute('separator_text', 'class', 'sa-el-breadcrumbs__separator__text');

            $separator = '<span ' . $this->get_render_attribute_string('separator_text') . '>' . $settings['separator_text'] . '</span>';
        }

        $this->_separator = $separator;
    }

    protected function get_separator() {
        return $this->_separator;
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $_query = $this->get_query();

        $this->set_separator();
        $this->add_render_attribute('breadcrumbs', 'class', 'sa-el-breadcrumbs');

        if ($_query) {
            if ($_query->have_posts()) {

                // Setup post
                $_query->the_post();

                // Render using the new query
                $this->render_breadcrumbs($_query);

                // Reset post data to original query
                wp_reset_postdata();
                wp_reset_query();
            } else {

                _e('Post or page not found', SA_EL_ADDONS_TEXTDOMAIN);
            }
        } else {
            // Render using the original query
            $this->render_breadcrumbs();
        }
    }

    protected function render_home_link() {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes('home_text');
        $this->add_render_attribute('home_text', [
            'class' => [
                'sa-el-breadcrumbs__crumb--link',
                'sa-el-breadcrumbs__crumb--home'
            ],
            'href' => get_home_url(),
            'title' => $settings['home_text']
        ]);
        ?>
        <li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--home">
            <a <?php echo $this->get_render_attribute_string('home_text'); ?>>
                <?php echo $settings['home_text']; ?>
            </a>
        </li>
        <?php
        $this->render_separator();
    }

    protected function render_separator($output = true) {

        $this->add_render_attribute('separator', 'class', 'sa-el-breadcrumbs__separator');

        $markup = '<li ' . $this->get_render_attribute_string('separator') . '>';
        $markup .= $this->get_separator();
        $markup .= '</li>';

        if ($output === true) {
            echo $markup;
            return;
        }

        return $markup;
    }

    protected function render_breadcrumbs($query = false) {

        global $post, $wp_query;

        if ($query === false) {

            // Reset post data to parent query
            $wp_query->reset_postdata();

            // Set active query to native query
            $query = $wp_query;
        }

        $settings = $this->get_settings_for_display();
        $separator = $this->get_separator();

        $custom_taxonomy = 'product_cat';

        if (!$query->is_front_page()) {
            ?>

            <ul <?php echo $this->get_render_attribute_string('breadcrumbs'); ?>>

                <?php
                if ('yes' === $settings['show_home']) {
                    $this->render_home_link();
                }

                if ($query->is_archive() && !$query->is_tax() && !$query->is_category() && !$query->is_tag()) {

                    echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--current sa-el-breadcrumbs__item--archive"><strong class="sa-el-breadcrumbs__crumb--current sa-el-breadcrumbs__crumb--archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
                } else if ($query->is_archive() && $query->is_tax() && !$query->is_category() && !$query->is_tag()) {

                    $post_type = get_post_type();

                    if ($post_type != 'post') {

                        $post_type_object = get_post_type_object($post_type);
                        $post_type_archive = get_post_type_archive_link($post_type);

                        echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--cat sa-el-breadcrumbs__item--custom-post-type-' . $post_type . '"><a class="sa-el-breadcrumbs__crumb--cat sa-el-breadcrumbs__crumb--custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';

                        $this->render_separator();
                    }
                    $custom_tax_name = get_queried_object()->name;
                    echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--current sa-el-breadcrumbs__item--archive"><strong class="sa-el-breadcrumbs__crumb--current sa-el-breadcrumbs__crumb--archive">' . $custom_tax_name . '</strong></li>';
                } else if ($query->is_single()) {

                    $post_type = get_post_type();

                    if ($post_type != 'post') {
                        $post_type_object = get_post_type_object($post_type);
                        $post_type_archive = get_post_type_archive_link($post_type);
                        echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--cat sa-el-breadcrumbs__item--custom-post-type-' . $post_type . '"><a class="sa-el-breadcrumbs__crumb--cat sa-el-breadcrumbs__crumb--custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';

                        $this->render_separator();
                    }

                    $category = get_the_category();

                    if (!empty($category)) {

                        $values = array_values($category);

                        $last_category = end($values);

                        $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','), ',');
                        $cat_parents = explode(',', $get_cat_parents);

                        $cat_display = '';

                        foreach ($cat_parents as $parents) {
                            $cat_display .= '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--cat">' . $parents . '</li>';
                            $cat_display .= $this->render_separator(false);
                        }
                    }

                    $taxonomy_exists = taxonomy_exists($custom_taxonomy);

                    if (empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                        $taxonomy_terms = get_the_terms($post->ID, $custom_taxonomy);

                        if ($taxonomy_terms) {
                            $cat_id = $taxonomy_terms[0]->term_id;
                            $cat_nicename = $taxonomy_terms[0]->slug;
                            $cat_link = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                            $cat_name = $taxonomy_terms[0]->name;
                        }
                    }
                    if (!empty($last_category)) {

                        echo $cat_display;

                        echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item sa-el-breadcrumbs__item--current sa-el-breadcrumbs__item--' . $post->ID . '"><strong class="sa-el-breadcrumbs__crumb--current sa-el-breadcrumbs__crumb--' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                    } else if (!empty($cat_id)) {
                        echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--cat sa-el-breadcrumbs__item--cat-' . $cat_id . ' sa-el-breadcrumbs__item--cat-' . $cat_nicename . '"><a class="sa-el-breadcrumbs__crumb--cat sa-el-breadcrumbs__crumb--cat-' . $cat_id . ' sa-el-breadcrumbs__crumb--cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';

                        $this->render_separator();

                        echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--current sa-el-breadcrumbs__item--' . $post->ID . '"><strong class="sa-el-breadcrumbs__crumb--current sa-el-breadcrumbs__crumb--' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                    } else {
                        echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--current sa-el-breadcrumbs__item--' . $post->ID . '"><strong class="sa-el-breadcrumbs__crumb--current sa-el-breadcrumbs__crumb--' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                    }
                } else if ($query->is_category()) {

                    echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--current sa-el-breadcrumbs__item--cat"><strong class="sa-el-breadcrumbs__crumb--current sa-el-breadcrumbs__crumb--cat">' . single_cat_title('', false) . '</strong></li>';
                } else if ($query->is_page()) {

                    if ($post->post_parent) {

                        $anc = get_post_ancestors($post->ID);

                        $anc = array_reverse($anc);

                        if (!isset($parents))
                            $parents = null;

                        foreach ($anc as $ancestor) {

                            $parents .= '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--parent sa-el-breadcrumbs__item--parent-' . $ancestor . '"><a class="sa-el-breadcrumbs__crumb--parent sa-el-breadcrumbs__crumb--parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';

                            $parents .= $this->render_separator(false);
                        }

                        echo $parents;
                    }

                    echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--current sa-el-breadcrumbs__item--' . $post->ID . '"><strong class="sa-el-breadcrumbs__crumb--current sa-el-breadcrumbs__crumb--' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                } else if ($query->is_tag()) {


                    $term_id = get_query_var('tag_id');
                    $taxonomy = 'post_tag';
                    $args = 'include=' . $term_id;
                    $terms = get_terms($taxonomy, $args);
                    $get_term_id = $terms[0]->term_id;
                    $get_term_slug = $terms[0]->slug;
                    $get_term_name = $terms[0]->name;

                    echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--current sa-el-breadcrumbs__item--tag-' . $get_term_id . ' sa-el-breadcrumbs__item--tag-' . $get_term_slug . '"><strong class="sa-el-breadcrumbs__crumb--current sa-el-breadcrumbs__crumb--tag-' . $get_term_id . ' sa-el-breadcrumbs__crumb--tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
                } elseif ($query->is_day()) {


                    echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--year sa-el-breadcrumbs__item--year-' . get_the_time('Y') . '"><a class="sa-el-breadcrumbs__crumb--year sa-el-breadcrumbs__crumb--year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';

                    $this->render_separator();

                    echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--month sa-el-breadcrumbs__item--month-' . get_the_time('m') . '"><a class="sa-el-breadcrumbs__crumb--month sa-el-breadcrumbs__crumb--month-' . get_the_time('m') . '" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';

                    $this->render_separator();

                    echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--current sa-el-breadcrumbs__item--' . get_the_time('j') . '"><strong class="sa-el-breadcrumbs__crumb--current sa-el-breadcrumbs__crumb--' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
                } else if ($query->is_month()) {


                    echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--year sa-el-breadcrumbs__item--year-' . get_the_time('Y') . '"><a class="sa-el-breadcrumbs__crumb--year sa-el-breadcrumbs__crumb--year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';

                    $this->render_separator();

                    echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--month sa-el-breadcrumbs__item--month-' . get_the_time('m') . '"><strong class="sa-el-breadcrumbs__crumb--month sa-el-breadcrumbs__crumb--month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
                } else if ($query->is_year()) {

                    echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--current sa-el-breadcrumbs__item--current-' . get_the_time('Y') . '"><strong class="sa-el-breadcrumbs__crumb--current sa-el-breadcrumbs__crumb--current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
                } else if ($query->is_author()) {


                    global $author;
                    $userdata = get_userdata($author);

                    echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--current sa-el-breadcrumbs__item--current-' . $userdata->user_nicename . '"><strong class="sa-el-breadcrumbs__crumb--current sa-el-breadcrumbs__crumb--current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
                } else if (get_query_var('paged')) {

                    echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--current sa-el-breadcrumbs__item--current-' . get_query_var('paged') . '"><strong class="sa-el-breadcrumbs__crumb--current sa-el-breadcrumbs__crumb--current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">' . __('Page') . ' ' . get_query_var('paged') . '</strong></li>';
                } else if ($query->is_search()) {

                    echo '<li class="sa-el-breadcrumbs__item sa-el-breadcrumbs__item--current sa-el-breadcrumbs__item--current-' . get_search_query() . '"><strong class="sa-el-breadcrumbs__crumb--current sa-el-breadcrumbs__crumb--current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
                } elseif ($query->is_404()) {

                    echo '<li>' . 'Error 404' . '</li>';
                }

                echo '</ul>';
            }
        }

    }
    