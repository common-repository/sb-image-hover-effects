<?php

namespace SA_EL_ADDONS\Modules\Elementor_Shortcode;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Anywhere_Elementor
 * Content of Shortcode Addons Plugins
 *
 * @author $biplob018
 */
class Elementor_Shortcode {

    public function __construct() {
        add_action('init', [$this, 'post_type'], 0);
        add_filter('manage_sa_el_shortcodes_posts_columns', [$this, 'templates_posts_columns']);
        add_action('manage_sa_el_shortcodes_posts_custom_column', [$this, 'templates_columns'], 10, 2);
        add_action("add_meta_boxes", [$this, 'meta_box']);
        add_shortcode('ELEMENTOR_SHORTCODE', [$this, 'insert_elementor']);
        add_action('elementor/init', [$this, 'enable_elementor']);
        add_filter('widget_text', 'do_shortcode');
        add_action('admin_menu', array($this, 'admin_menu'));
    }

    public function enable_elementor() {
        add_post_type_support('sa_el_shortcodes', 'elementor');
    }

    public function insert_elementor($atts) {
        if (!class_exists('Elementor\Plugin')) {
            return '';
        }
        if (!isset($atts['id']) || empty($atts['id'])) {
            return '';
        }
        $post_id = $atts['id'];

        $post_id = apply_filters('wpml_object_id', $post_id, 'ae_global_templates');

        $response = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($post_id);
        return $response;
    }

    public function admin_menu() {
        $menu = 'get_oxilab_addons_menu';
        $elements = !empty(get_transient($menu)) ? get_transient($menu) : [];
        if (!array_key_exists('shortcode', $elements)):
            $elements['Elementor']['shortcode'] = [
                'name' => 'Shortcode',
                'homepage' => 'edit.php?post_type=sa_el_shortcodes'
            ];
            set_transient($menu, $elements, 10 * DAY_IN_SECONDS);
        endif;
        add_submenu_page('sa-el-addons', 'Elementor Shortcode', 'Elementor Shortcode', $this->menu_permission(), 'edit.php?post_type=sa_el_shortcodes');
    }

    /**
     * Plugin menu Permission
     *
     * @since 1.0.0
     */
    public function menu_permission() {
        $user_role = get_option('oxi_addons_user_permission');
        $role_object = get_role($user_role);
        if (isset($role_object->capabilities) && is_array($role_object->capabilities)):
            reset($role_object->capabilities);
            return key($role_object->capabilities);
        else:
            return 'manage_options';
        endif;
    }

    public function Elementor_Shortcode() {
        
    }

    public function post_type() {
        $labels = array(
            'name' => _x('Elementor Shortcodes', 'Post Type General Name', SA_EL_ADDONS_TEXTDOMAIN),
            'singular_name' => _x('Elementor Shortcode', 'Post Type Singular Name', SA_EL_ADDONS_TEXTDOMAIN),
            'menu_name' => __('Elementor Shortcodes', SA_EL_ADDONS_TEXTDOMAIN),
            'name_admin_bar' => __('Elementor Shortcodes', SA_EL_ADDONS_TEXTDOMAIN),
            'archives' => __('List Archives', SA_EL_ADDONS_TEXTDOMAIN),
            'parent_item_colon' => __('Parent List:', SA_EL_ADDONS_TEXTDOMAIN),
            'all_items' => __('Elementor Shortcodes', SA_EL_ADDONS_TEXTDOMAIN),
            'add_new_item' => __('Add New Elementor Shortcode', SA_EL_ADDONS_TEXTDOMAIN),
            'add_new' => __('Add New', SA_EL_ADDONS_TEXTDOMAIN),
            'new_item' => __('New Elementor Shortcode', SA_EL_ADDONS_TEXTDOMAIN),
            'edit_item' => __('Edit Elementor Shortcode', SA_EL_ADDONS_TEXTDOMAIN),
            'update_item' => __('Update Elementor Shortcode', SA_EL_ADDONS_TEXTDOMAIN),
            'view_item' => __('View Elementor Shortcode', SA_EL_ADDONS_TEXTDOMAIN),
            'search_items' => __('Search Elementor Shortcode', SA_EL_ADDONS_TEXTDOMAIN),
            'not_found' => __('Not found', SA_EL_ADDONS_TEXTDOMAIN),
            'not_found_in_trash' => __('Not found in Trash', SA_EL_ADDONS_TEXTDOMAIN)
        );
        $args = array(
            'label' => __('Post List', SA_EL_ADDONS_TEXTDOMAIN),
            'labels' => $labels,
            'supports' => array('title', 'editor'),
            'public' => true,
            'rewrite' => false,
            'show_ui' => true,
            'show_in_menu' => false,
            'show_in_nav_menus' => false,
            'exclude_from_search' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu-icon' => 'dashicon-move'
        );
        register_post_type('sa_el_shortcodes', $args);
    }

    public function templates_posts_columns($columns) {
        $columns['sa_shortcode_column'] = __('Shortcode', SA_EL_ADDONS_TEXTDOMAIN);
        return $columns;
    }

    public function templates_columns($column, $post_id) {
        switch ($column) {
            case 'sa_shortcode_column' :
                echo '<input type=\'text\' class=\'widefat\' value=\'[ELEMENTOR_SHORTCODE id="' . $post_id . '"]\' readonly="">';
                break;
        }
    }

    public function meta_box() {
        add_meta_box('sa-el-shortcode-box', 'Elementor Shortcode Usage', [$this, 'shortcode_box'], 'sa_el_shortcodes', 'side', 'high');
    }

    public function shortcode_box($post) {
        ?>
        <h4 style="margin-bottom:5px;">Shortcode</h4>
        <input type='text' class='widefat' value='[ELEMENTOR_SHORTCODE id="<?php echo $post->ID; ?>"]' readonly="">

        <h4 style="margin-bottom:5px;">Php Code</h4>
        <input type='text' class='widefat' value="&lt;?php echo do_shortcode('[ELEMENTOR_SHORTCODE id=&quot;<?php echo $post->ID; ?>&quot;]'); ?&gt;" readonly="">
        <?php
    }

}
