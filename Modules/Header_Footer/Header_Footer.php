<?php

namespace SA_EL_ADDONS\Modules\Header_Footer;

if (!defined('ABSPATH')) {
    exit;
}

use \SA_EL_ADDONS\Classes\Build_API;

class Header_Footer extends Build_API {

    public static $instance = null;
    public $post_type = 'sa_el_header_footer';
    public $templates;
    public $header_template;
    public $footer_template;
    public $current_theme;
    public $current_template;

    const saved_tempalte_data = 'sa_el_active_template_data';

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function config() {
        $this->prefix = 'template';
        $this->param = '/(?P<id>\w+)/';
        add_action('init', [$this, 'post_type'], 0);
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('admin_footer', [$this, 'Editor']);
        add_action('admin_init', [$this, 'add_author_support_to_column'], 10);
        add_filter('manage_sa_el_header_footer_posts_columns', [$this, 'column']);
        add_action('manage_sa_el_header_footer_posts_custom_column', [$this, 'column_data'], 10, 2);
        add_filter('parse_query', [$this, 'query']);
        add_action('wp', array($this, 'hooks'));
        add_filter('single_template', [$this, 'load_canvas_template']);
        $this->init();
        $this->Admin_nav_menu();
    }

    public function Admin_nav_menu() {
        $menu = 'get_oxilab_addons_menu';
        $elements = get_transient($menu);
        $elements = $elements === false ? [] : $elements;
        if (!array_key_exists('Header_Footer', array_key_exists('Elementor', $elements) ? $elements['Elementor'] : [])):
            $elements['Elementor']['Header_Footer'] = [
                'name' => 'Header Footer',
                'homepage' => 'edit.php?post_type=sa_el_header_footer'
            ];
            set_transient($menu, $elements, 10 * DAY_IN_SECONDS);
        endif;
    }

    public function get_update() {
        $id = $this->request['id'];
        $open_editor = $this->request['open_editor'];
        $title = ($this->request['title'] == '') ? ( $this->request['type'] . ' Template #' . time()) : $this->request['title'];
        $type = $this->request['type'];
        $cond_a = $this->request['condition_a'];
        $cond_singular = $cond_a == 'singular' ? $this->request['condition_singular'] : '';
        $cond_singular_id = $cond_singular == 'selected' ? $this->request['condition_singular_id'] : '';
        $activation = $this->request['activation'];

        $post_data = array(
            'post_title' => $title,
            'post_status' => 'publish',
            'post_type' => 'sa_el_header_footer',
        );

        $post = get_post($id);

        if ($post == null) {
            $post_data['post_author'] = $this->request['post_author'];
            $id = wp_insert_post($post_data);
        } else {
            $post_data['ID'] = $id;
            wp_update_post($post_data);
        }

        update_post_meta($id, '_wp_page_template', 'elementor_canvas');
        update_post_meta($id, 'sa_el_header_footer_activation', $activation);
        update_post_meta($id, 'sa_el_header_footer_type', $type);
        update_post_meta($id, 'sa_el_header_footer_cond_a', $cond_a);
        update_post_meta($id, 'sa_el_header_footer_cond_singular', $cond_singular);
        update_post_meta($id, 'sa_el_header_footer_cond_singular_id', $cond_singular_id);
        $template = $this->create_template_data(true);
        if ($open_editor == 'true') {
            $url = get_admin_url() . '/post.php?post=' . $id . '&action=elementor';
            wp_redirect($url);
            exit;
        } else {
            if ($cond_a == 'singular'):
                if ($cond_singular != ''):
                    if (is_array($cond_singular_id)):
                        $rt = '';
                        foreach ($cond_singular_id as $value) {
                            $rt .= $cond_a . ' > ' . $cond_singular . ' > ' . esc_html(get_the_title($value)) . '<br>';
                        }
                    else:
                        $rt = $cond_a . ' > ' . $cond_singular;
                    endif;

                else:
                    $rt = $cond_a;
                endif;
            else:
                $rt = $cond_a;
            endif;
            $cond = ucwords(str_replace('_', ' ', $rt));

            return [
                'saved' => true,
                'data' => [
                    'id' => $id,
                    'title' => $title,
                    'type' => $type,
                    'activation' => $activation,
                    'cond_text' => $cond,
                    'type_html' => (ucfirst($type) . (($activation == 'yes') ? ( '<span class="sa-el-header-footer-status sa-el-header-footer-status-active">' . esc_html__('Active', SA_EL_ADDONS_TEXTDOMAIN) . '</span>' ) : ( '<span class="sa-el-header-footer-status sa-el-header-footer-status-inactive">' . esc_html__('Inactive', SA_EL_ADDONS_TEXTDOMAIN) . '</span>' ))),
                ]
            ];
        }
    }

    public function get_get() {
        $id = $this->request['id'];
        $post = get_post($id);
        if ($post != null) {
            return [
                'title' => $post->post_title,
                'status' => $post->post_status,
                'activation' => get_post_meta($post->ID, 'sa_el_header_footer_activation', true),
                'type' => get_post_meta($post->ID, 'sa_el_header_footer_type', true),
                'cond_a' => get_post_meta($post->ID, 'sa_el_header_footer_cond_a', true),
                'cond_singular' => get_post_meta($post->ID, 'sa_el_header_footer_cond_singular', true),
                'cond_singular_id' => get_post_meta($post->ID, 'sa_el_header_footer_cond_singular_id', true),
            ];
        }
        return true;
    }

    public function get_singular_list() {
        $query_args = [
            'post_status' => 'publish',
            'posts_per_page' => 15,
            'post_type' => 'any'
        ];

        if (isset($this->request['ids'])) {
            $ids = explode(',', $this->request['ids']);
            $query_args['post__in'] = $ids;
        }
        if (isset($this->request['qu'])) {
            $query_args['s'] = $this->request['qu'];
        }

        $query = new \WP_Query($query_args);
        $options = [];
        if ($query->have_posts()):
            while ($query->have_posts()) {
                $query->the_post();
                $options[] = ['id' => get_the_ID(), 'text' => get_the_title()];
            }
        endif;

        return ['results' => $options];
        wp_reset_postdata();
    }

    public function post_type() {

        $labels = array(
            'name' => __('Header Footer', SA_EL_ADDONS_TEXTDOMAIN),
            'singular_name' => __('Header Footer', SA_EL_ADDONS_TEXTDOMAIN),
            'menu_name' => __('Header Footer', SA_EL_ADDONS_TEXTDOMAIN),
            'name_admin_bar' => __('Header Footer', SA_EL_ADDONS_TEXTDOMAIN),
            'add_new' => __('Add New', SA_EL_ADDONS_TEXTDOMAIN),
            'add_new_item' => __('Add New Header Footer', SA_EL_ADDONS_TEXTDOMAIN),
            'new_item' => __('New Header Footer', SA_EL_ADDONS_TEXTDOMAIN),
            'edit_item' => __('Edit Header Footer', SA_EL_ADDONS_TEXTDOMAIN),
            'view_item' => __('View Header Footer', SA_EL_ADDONS_TEXTDOMAIN),
            'all_items' => __('All Header Footer', SA_EL_ADDONS_TEXTDOMAIN),
            'search_items' => __('Search Header Footer', SA_EL_ADDONS_TEXTDOMAIN),
            'parent_item_colon' => __('Parent Header Footer:', SA_EL_ADDONS_TEXTDOMAIN),
            'not_found' => __('No Header Footer found.', SA_EL_ADDONS_TEXTDOMAIN),
            'not_found_in_trash' => __('No Header Footer found in Trash.', SA_EL_ADDONS_TEXTDOMAIN),
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'rewrite' => false,
            'show_ui' => true,
            'show_in_menu' => false,
            'show_in_nav_menus' => false,
            'exclude_from_search' => true,
            'capability_type' => 'page',
            'hierarchical' => false,
            'supports' => array('title', 'thumbnail', 'elementor'),
        );

        register_post_type('sa_el_header_footer', $args);
    }

    public function admin_menu() {
        add_submenu_page('sa-el-addons', 'Header Footer', 'Header Footer', $this->menu_permission(), 'edit.php?post_type=sa_el_header_footer');
    }

    public function hooks() {
        $this->current_template = basename(get_page_template_slug());
        if ($this->current_template == 'elementor_canvas') {
            return;
        }
        $this->current_theme = get_template();
        switch ($this->current_theme) {
            case 'astra':
                new \SA_EL_ADDONS\Modules\Header_Footer\Theme\Astra($this->template_ids());
                break;

            case 'generatepress': case 'generatepress-child':
                new \SA_EL_ADDONS\Modules\Header_Footer\Theme\Generatepress($this->template_ids());
                break;

            case 'oceanwp': case 'oceanwp-child':
                new \SA_EL_ADDONS\Modules\Header_Footer\Theme\Genesis($this->template_ids());
                break;

            case 'bb-theme': case 'bb-theme-child':
                new \SA_EL_ADDONS\Modules\Header_Footer\Theme\Bbtheme($this->template_ids());
                break;

            case 'genesis': case 'genesis-child':
                new \SA_EL_ADDONS\Modules\Header_Footer\Theme\Genesis($this->template_ids());
                break;

            case 'twentynineteen':
                new \SA_EL_ADDONS\Modules\Header_Footer\Theme\TwentyNineteen($this->template_ids());
                break;

            default:
                new \SA_EL_ADDONS\Modules\Header_Footer\Theme\Theme($this->template_ids());
                break;
        }
    }

    public function template_ids() {
        $cached = wp_cache_get('sa_el_header_footer_ids');
        if (false !== $cached) {
            return $cached;
        }

        $this->the_filter();

        $ids = [
            $this->header_template,
            $this->footer_template,
        ];

        if ($this->header_template != null) {
            $this->elementor_content_css($this->header_template);
        }

        if ($this->footer_template != null) {
            $this->elementor_content_css($this->footer_template);
        }

        wp_cache_set('sa_el_header_footer_ids', $ids);
        return $ids;
    }

    public function the_filter() {
        $arg = [
            'posts_per_page' => -1,
            'orderby' => 'id',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => $this->post_type,
            'meta_query' => [
                [
                    'key' => 'sa_el_header_footer_activation',
                    'value' => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->templates = get_posts($arg);
        if (!is_admin()):
            if (is_home() || is_front_page()):
                $filters = [
                    'front_page' => 'front_page',
                    'all_posts' => 'all_pages',
                    'all' => 'all',
                    'entire_site' => 'entire_site',
                ];
            elseif (is_archive()):
                $filters = [
                    'entire_site' => 'entire_site',
                    'archive' => 'archive',
                ];
            elseif (is_page()):
                $filters = [
                    'cond_singular_id' => get_the_ID(),
                    'all_pages' => 'all_pages',
                    'all' => 'all',
                    'entire_site' => 'entire_site',
                ];
            elseif (is_single()):
                $filters = [
                    'cond_singular_id' => get_the_ID(),
                    'all_posts' => 'all_posts',
                    'all' => 'all',
                    'entire_site' => 'entire_site',
                ];
            elseif (is_404()):
                $filters = [
                    'errorpage' => 'errorpage',
                    'all' => 'all',
                    'entire_site' => 'entire_site',
                ];
            else:
                $filters = [
                    'entire_site' => 'entire_site',
                ];
            endif;
            $this->get_header_footer($filters);
        endif;
    }

    protected function create_template_data($force = false) {
        $response = get_transient(self::saved_tempalte_data);
        if (!$response || $force):
            $response = [];
            if ($this->templates != null) {
                foreach ($this->templates as $template) {
                    $template = $this->get_full_data($template);
                    $response[$template['ID']] = [
                        'ID' => $template['ID'],
                        'post_title' => $template['post_title'],
                        'type' => $template['type'],
                        'cond_a' => $template['cond_a'],
                        'cond_singular' => $template['cond_singular'],
                        'cond_singular_id' => $template['cond_singular_id'],
                    ];
                }
            }
            set_transient(self::saved_tempalte_data, $response, 10 * DAY_IN_SECONDS);
        endif;
        return $response;
    }

    protected function get_header_footer($filters) {
        $template = $this->create_template_data(true);
        if (count($template) > 0) {
            $temp = [];
            foreach ($template as $key => $value) {
                if ($value['cond_a'] != ''):
                    $temp[$value['type']][$value['cond_a']] = $value['ID'];
                endif;
                if ($value['cond_singular'] != ''):
                    $temp[$value['type']][$value['cond_singular']] = $value['ID'];
                endif;
                if ($value['cond_singular_id'] != ''):
                    foreach ($value['cond_singular_id'] as $k => $v) {
                        if ($v == get_the_ID()):
                            $temp[$value['type']]['cond_singular_id'] = $value['ID'];
                        endif;
                    }
                endif;
            }
            foreach ($temp as $key => $value) {
                foreach ($filters as $k => $filter) {
                    if (array_key_exists($k, $value) && $value[$k] != ''):
                        $this->confirm_template_id($value[$k], $key);
                    endif;
                }
            }
        }
    }

    protected function confirm_template_id($id, $key) {
        if ($key == 'header') {
            $this->header_template = $id;
        }
        if ($key == 'footer') {
            $this->footer_template = $id;
        }
    }

    protected function get_full_data($post) {
        if ($post != null) {
            return array_merge((array) $post, [
                'type' => get_post_meta($post->ID, 'sa_el_header_footer_type', true),
                'cond_a' => get_post_meta($post->ID, 'sa_el_header_footer_cond_a', true),
                'cond_singular' => get_post_meta($post->ID, 'sa_el_header_footer_cond_singular', true),
                'cond_singular_id' => get_post_meta($post->ID, 'sa_el_header_footer_cond_singular_id', true),
            ]);
        }
    }

    public function Editor() {
        $screen = get_current_screen();
        if ($screen->id == 'edit-sa_el_header_footer') {
            include_once SA_EL_ADDONS_PATH . 'Modules/Header_Footer/inc/editor.php';
        }
    }

    public function enqueue_scripts() {
        $screen = get_current_screen();
        if ($screen->id == 'edit-sa_el_header_footer') {
            wp_enqueue_style('select2', SA_EL_ADDONS_URL . 'Modules/Header_Footer/assets/css/select2.min.css', false, SA_EL_ADDONS_PLUGIN_VERSION);
            wp_enqueue_script('select2', SA_EL_ADDONS_URL . 'Modules/Header_Footer/assets/js/select2.min.js', array('jquery'), true, SA_EL_ADDONS_PLUGIN_VERSION);
            wp_enqueue_script('sa-el-header-footer-script', SA_EL_ADDONS_URL . 'Modules/Header_Footer/assets/js/admin-script.js', array('jquery'), true, SA_EL_ADDONS_PLUGIN_VERSION);
            wp_enqueue_style('sa-el-admin-css', SA_EL_ADDONS_URL . '/assets/css/admin.css', false, SA_EL_ADDONS_PLUGIN_VERSION);
            wp_enqueue_style('bootstrap.min-css', SA_EL_ADDONS_URL . '/assets/css/bootstrap.min.css', false, SA_EL_ADDONS_PLUGIN_VERSION);
            wp_enqueue_script('bootstrap.min', SA_EL_ADDONS_URL . '/assets/js/bootstrap.min.js', false, SA_EL_ADDONS_PLUGIN_VERSION);
            wp_enqueue_style('sa-el-header-footer-style', SA_EL_ADDONS_URL . 'Modules/Header_Footer/assets/css/admin-style.css', false, SA_EL_ADDONS_PLUGIN_VERSION);

            $js = 'var ElementorAddons = {
                        restapi: "' . get_rest_url() . 'ElementorAddons/v1/",
                   }';
            wp_add_inline_script('sa-el-header-footer-script', $js);
        }
    }

    public function add_author_support_to_column() {
        add_post_type_support('sa_el_header_footer', 'author');
    }

    public function column($columns) {
        $date_column = $columns['date'];
        $author_column = $columns['author'];
        unset($columns['date']);
        unset($columns['author']);
        $columns['type'] = esc_html__('Type', SA_EL_ADDONS_TEXTDOMAIN);
        $columns['condition'] = esc_html__('Conditions', SA_EL_ADDONS_TEXTDOMAIN);
        $columns['date'] = $date_column;
        $columns['author'] = $author_column;
        return $columns;
    }

    public function column_data($column, $post_id) {
        switch ($column) {
            case 'type':
                $type = get_post_meta($post_id, 'sa_el_header_footer_type', true);
                $active = get_post_meta($post_id, 'sa_el_header_footer_activation', true);

                echo ucfirst($type) . (
                ($active == 'yes') ?
                        ( '<span class="sa-el-header-footer-status sa-el-header-footer-status-active">' .
                        esc_html__('Active', SA_EL_ADDONS_TEXTDOMAIN) . '</span>' ) :
                        ( '<span class="sa-el-header-footer-status sa-el-header-footer-status-inactive">'
                        . esc_html__('Inactive', SA_EL_ADDONS_TEXTDOMAIN) . '</span>' ));

                break;
            case 'condition':
                $cond = [
                    'cond_a' => get_post_meta($post_id, 'sa_el_header_footer_cond_a', true),
                    'cond_singular' => get_post_meta($post_id, 'sa_el_header_footer_cond_singular', true),
                    'cond_singular_id' => get_post_meta($post_id, 'sa_el_header_footer_cond_singular_id', true),
                ];
                if ($cond['cond_a'] == 'singular'):
                    if ($cond['cond_singular'] != ''):
                        if (is_array($cond['cond_singular_id'])):
                            $rt = '';
                            foreach ($cond['cond_singular_id'] as $value) {
                                $rt .= $cond['cond_a'] . ' > ' . $cond['cond_singular'] . ' > ' . esc_html(get_the_title($value)) . '<br>';
                            }
                        else:
                            $rt = $cond['cond_a'] . ' > ' . $cond['cond_singular'];
                        endif;

                    else:
                        $rt = $cond['cond_a'];
                    endif;
                else:
                    $rt = $cond['cond_a'];
                endif;
                echo ucwords(str_replace('_', ' ', $rt));
                break;
        }
    }

    public function query($query) {
        global $pagenow;
        $current_page = isset($_GET['post_type']) ? sanitize_key($_GET['post_type']) : '';
        if (
                is_admin() && 'sa_el_header_footer' == $current_page && 'edit.php' == $pagenow && isset($_GET['sa_el_type_filter']) && $_GET['sa_el_type_filter'] != '' && $_GET['sa_el_type_filter'] != 'all'
        ) {
            $type = sanitize_key($_GET['sa_el_type_filter']);
            $query->query_vars['meta_key'] = 'sa_el_header_footer_type';
            $query->query_vars['meta_value'] = $type;
            $query->query_vars['meta_compare'] = '=';
        }
    }

    public function elementor_content_css($content_id) {
        if (class_exists('\Elementor\Core\Files\CSS\Post')) {
            $css_file = new \Elementor\Core\Files\CSS\Post($content_id);
            $css_file->enqueue();
        }
    }

    public static function elementor_content($content_id) {
        $elementor_instance = \Elementor\Plugin::instance();
        return $elementor_instance->frontend->get_builder_content_for_display($content_id);
    }

    public function load_canvas_template($single_template) {
        global $post;

        if ('elementskit_template' == $post->post_type) {

            $elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

            if (file_exists($elementor_2_0_canvas)) {
                return $elementor_2_0_canvas;
            } else {
                return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
            }
        }

        return $single_template;
    }

}
