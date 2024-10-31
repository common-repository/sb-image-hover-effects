<?php

namespace SA_EL_ADDONS\Helper;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Elementor_Helper
 *
 * @author biplob018
 */
use Elementor\Icons_Manager;
use \Elementor\Controls_Manager as Controls_Manager;
use \SA_EL_ADDONS\Classes\Front\Group_Control_Transition;

trait Elementor_Helper {

    /**
     * Register Widget Category 
     *
     * @since v1.0.0
     */
    public function register_widget_categories($elements_manager) {
        $elements_manager->add_category(
                'sa-el-addons', [
            'title' => __('Elementor Addons', SA_EL_ADDONS_TEXTDOMAIN),
            'icon' => 'font',
                ], 1
        );
    }

    /**
     * Add new elementor group control
     *
     * @since v1.0.0
     */
    public function register_controls_group() {
        require( SA_EL_ADDONS_PATH . 'Classes/Front/Sa_Foreground_Control.php' );
        $ground = 'SA_EL_ADDONS\Classes\Front\Sa_Foreground_Control';
        \Elementor\Plugin::instance()->controls_manager->add_group_control($ground::get_type(), new $ground());
        $controls_manager = \Elementor\Plugin::instance()->controls_manager;
        $controls_manager->add_group_control('sa-el-transition', new Group_Control_Transition());
    }

    /**
     * Get all elementor page templates
     *
     * @return array
     */
    public function get_elementor_page_templates($type = null) {
        $args = [
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
        ];

        if ($type) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'elementor_library_type',
                    'field' => 'slug',
                    'terms' => $type,
                ],
            ];
        }

        $page_templates = get_posts($args);
        $options = array();

        if (!empty($page_templates) && !is_wp_error($page_templates)) {
            foreach ($page_templates as $post) {
                $options[$post->ID] = $post->post_title;
            }
        } else {
            $options[] = 'No ' . ucfirst($type) . ' Found';
        }
        return $options;
    }

    /**
     * Get all User Roles
     *
     * @return array
     */
    public function sa_el_user_roles() {
        global $wp_roles;
        $all = $wp_roles->roles;
        $all_roles = array();
        if (!empty($all)) {
            foreach ($all as $key => $value) {
                $all_roles[$key] = $all[$key]['name'];
            }
        }
        return $all_roles;
    }

    /**
     * Protected Form Input Fields
     */
    public function sa_el_get_block_pass_protected_form($settings) {
        echo '<div class="sa-el-password-protected-content-fields">';
        echo '<form method="post">';
        echo '<input type="password" name="sa_protection_password" class="sa-el-password" placeholder="' . $settings['sa_protection_password_placeholder'] . '">';
        echo '<input type="submit" value="' . $settings['sa_protection_password_submit_btn_txt'] . '" class="sa-el-submit">';
        echo '</form>';
        if (isset($_POST['sa_protection_password']) && ($settings['sa_protection_password'] !== $_POST['sa_protection_password'])) {
            echo sprintf(__('<p class="protected-content-error-msg">Password does not match.</p>', SA_EL_ADDONS_TEXTDOMAIN));
        }
        echo '</div>';
    }

    /**
     *  Get all WordPress registered widgets
     *  @return array
     */
    public function sa_get_registered_sidebars() {
        global $wp_registered_sidebars;
        $options = [];

        if (!$wp_registered_sidebars) {
            $options[''] = __('No sidebars were found', SA_EL_ADDONS_TEXTDOMAIN);
        } else {
            $options['---'] = __('Choose Sidebar', SA_EL_ADDONS_TEXTDOMAIN);

            foreach ($wp_registered_sidebars as $sidebar_id => $sidebar) {
                $options[$sidebar_id] = $sidebar['name'];
            }
        }
        return $options;
    }

    /**
     *  Price Table Feature Function
     */
    protected function render_feature_list($settings, $obj) {
        if (empty($settings['sa_el_pricing_table_items'])) {
            return;
        }

        $counter = 0;
        ?>
        <ul>
            <?php
            foreach ($settings['sa_el_pricing_table_items'] as $item) :

                if ('yes' !== $item['sa_el_pricing_table_icon_mood']) {
                    $obj->add_render_attribute('pricing_feature_item' . $counter, 'class', 'disable-item');
                }

                if ('yes' === $item['sa_el_pricing_item_tooltip']) {
                    $obj->add_render_attribute(
                            'pricing_feature_item' . $counter, [
                        'class' => 'tooltip',
                        'title' => $item['sa_el_pricing_item_tooltip_content'],
                        'id' => $obj->get_id() . $counter,
                            ]
                    );
                }

                if ('yes' == $item['sa_el_pricing_item_tooltip']) {

                    if ($item['sa_el_pricing_item_tooltip_side']) {
                        $obj->add_render_attribute('pricing_feature_item' . $counter, 'data-side', $item['sa_el_pricing_item_tooltip_side']);
                    }

                    if ($item['sa_el_pricing_item_tooltip_trigger']) {
                        $obj->add_render_attribute('pricing_feature_item' . $counter, 'data-trigger', $item['sa_el_pricing_item_tooltip_trigger']);
                    }

                    if ($item['sa_el_pricing_item_tooltip_animation']) {
                        $obj->add_render_attribute('pricing_feature_item' . $counter, 'data-animation', $item['sa_el_pricing_item_tooltip_animation']);
                    }

                    if (!empty($item['pricing_item_tooltip_animation_duration'])) {
                        $obj->add_render_attribute('pricing_feature_item' . $counter, 'data-animation_duration', $item['pricing_item_tooltip_animation_duration']);
                    }

                    if (!empty($item['sa_el_pricing_table_toolip_arrow'])) {
                        $obj->add_render_attribute('pricing_feature_item' . $counter, 'data-arrow', $item['sa_el_pricing_table_toolip_arrow']);
                    }

                    if (!empty($item['sa_el_pricing_item_tooltip_theme'])) {
                        $obj->add_render_attribute('pricing_feature_item' . $counter, 'data-theme', $item['sa_el_pricing_item_tooltip_theme']);
                    }
                }
                ?>
                <li <?php echo $obj->get_render_attribute_string('pricing_feature_item' . $counter); ?>>
                    <?php if ('show' === $settings['sa_el_pricing_table_icon_enabled']) : ?>
                        <span class="li-icon" style="color:<?php echo esc_attr($item['sa_el_pricing_table_list_icon_color']); ?>"><i class="<?php echo esc_attr($item['sa_el_pricing_table_list_icon']); ?>"></i></span>
                        <?php endif; ?>
                        <?php echo $item['sa_el_pricing_table_item']; ?>
                </li>
                <?php
                $counter++;
            endforeach;
            ?>
        </ul>
        <?php
    }

    /**
     * Elementor icon libray type

     */
    public function Sa_El_Icon_Type() {
        return (version_compare(ELEMENTOR_VERSION, '2.6', '>=') ? Controls_Manager::ICONS : Controls_Manager::ICON);
    }

    /**
     * Default icon class fa5 and fa4
     *
     */
    public function Sa_El_Default_Icon($FA5_Class, $libray, $FA4_Class) {
        return (version_compare(ELEMENTOR_VERSION, '2.6', '>=') ? ['value' => $FA5_Class, 'library' => $libray,] : $FA4_Class);
    }

    /**
     * Elementor icon render
     *
     * @return void
     */
    public function Sa_El_Icon_Render($settings) {
        if (version_compare(ELEMENTOR_VERSION, '2.6', '>=')) {
            ob_start();
            Icons_Manager::render_icon($settings, ['aria-hidden' => 'true']);
            $list = ob_get_contents();
            ob_end_clean();
            $rt = $list;
        } else {
            $rt = '<i aria-hidden="true" class="' . esc_attr($settings) . '"></i>';
        }
        return $rt;
    }

    /**
     * Get a list of all the allowed html tags.
     *
     * @param string $level Allowed levels are basic and intermediate
     * @return array
     */
    public function sa_el_get_allowed_html_tags($level = 'basic') {
        $allowed_html = [
            'b' => [],
            'i' => [],
            'u' => [],
            'em' => [],
            'br' => [],
            'abbr' => [
                'title' => [],
            ],
            'span' => [
                'class' => [],
            ],
            'strong' => [],
        ];

        if ($level === 'intermediate') {
            $allowed_html['a'] = [
                'href' => [],
                'title' => [],
                'class' => [],
                'id' => [],
            ];
        }

        return $allowed_html;
    }

    /**
     * Strip all the tags except allowed html tags
     *
     * The name is based on inline editing toolbar name
     *
     * @param string $string
     * @return string
     */
    public function sa_el_kses_intermediate($string = '') {
        return wp_kses($string, $this->sa_el_get_allowed_html_tags('intermediate'));
    }

    /**
     * Strip all the tags except allowed html tags
     *
     * The name is based on inline editing toolbar name
     *
     * @param string $string
     * @return string
     */
    public function sa_el_kses_basic($string = '') {
        return wp_kses($string, $this->sa_el_get_allowed_html_tags('basic'));
    }

    /**
     * Get a translatable string with allowed html tags.
     *
     * @param string $level Allowed levels are basic and intermediate
     * @return string
     */
    public function sa_el_get_allowed_html_desc($level = 'basic') {
        if (!in_array($level, ['basic', 'intermediate'])) {
            $level = 'basic';
        }

        $tags_str = '<' . implode('>,<', array_keys($this->sa_el_get_allowed_html_tags($level))) . '>';
        return sprintf(__('This input field has support for the following HTML tags: %1$s', SA_EL_ADDONS_TEXTDOMAIN), '<code>' . esc_html($tags_str) . '</code>');
    }

    /**
     * Call a shortcode function by tag name.
     *
     * @since  1.0.0
     *
     * @param string $tag     The shortcode whose function to call.
     * @param array  $atts    The attributes to pass to the shortcode function. Optional.
     * @param array  $content The shortcode's content. Default is null (none).
     *
     * @return string|bool False on failure, the result of the shortcode on success.
     */
    public function sa_el_do_shortcode($tag, array $atts = array(), $content = null) {
        global $shortcode_tags;
        if (!isset($shortcode_tags[$tag])) {
            return false;
        }
        return call_user_func($shortcode_tags[$tag], $atts, $content, $tag);
    }

    /**
     * Get all registered menus.
     *
     * @return array of menus.
     */
    public function sa_el_get_menus() {
        $menus = wp_get_nav_menus();
        $options = [];

        if (empty($menus)) {
            return $options;
        }

        foreach ($menus as $menu) {
            $options[$menu->term_id] = $menu->name;
        }

        return $options;
    }

    /**
     * Get all posts.
     *
     * @return array of menus.
     */
    public function sa_el_get_all_post() {

        $post_types = get_post_types();
        $post_type_not__in = array('attachment', 'revision', 'nav_menu_item', 'custom_css', 'customize_changeset', 'elementor_library', 'post');

        foreach ($post_type_not__in as $post_type_not) {
            unset($post_types[$post_type_not]);
        }
        $post_type = array_values($post_types);


        $all_posts = get_posts(array(
            'posts_per_page' => -1,
            'post_type' => 'page',
                )
        );
        if (!empty($all_posts) && !is_wp_error($all_posts)) {
            foreach ($all_posts as $post) {
                $this->options[$post->ID] = strlen($post->post_title) > 20 ? substr($post->post_title, 0, 20) . '...' : $post->post_title;
            }
        }
        return $this->options;
    }

    public function sa_el_get_elementor_page_list() {

        $pagelist = get_posts(array(
            'post_type' => 'elementor_library',
            'showposts' => 999,
        ));

        if (!empty($pagelist) && !is_wp_error($pagelist)) {

            foreach ($pagelist as $post) {
                $options[$post->post_title] = $post->post_title;
            }

            update_option('temp_count', $options);

            return $options;
        }
    }

    public function sa_el_get_template_content($title) {

        $frontend = new \Elementor\Frontend;

        $id = $this->sa_el_get_id_by_title($title);

        $template_content = $frontend->get_builder_content($id, true);

        return $template_content;
    }

    public function sa_el_get_id_by_title($handle) {

        $template = get_page_by_title($handle, OBJECT, 'elementor_library');

        $template_id = isset($template->ID) ? $template->ID : $handle;

        return $template_id;
    }

    public function Sa_El_Support() {
        $this->start_controls_section(
                'sa_el_section_support', [
            'label' => __('Unable To Use or Found Bugs?', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );
        $this->add_control(
                'sa_el_section_support_get', [
            'label' => __('Need Support', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::CHOOSE,
            'toggle' => FALSE,
            'options' => [
                '1' => [
                    'title' => __('', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'fas fa-headset',
                ],
            ],
            'default' => '1',
            'description' => 'Are you in need of a feature that’s not available in our plugin or got some bugs? Feel free to do a <a href="https://wordpress.org/support/plugin/sb-image-hover-effects/" target="_blank">Support</a> request.'
                ]
        );
        $this->end_controls_section();
    }

    public function Sa_El_Style_Support() {
        $this->start_controls_section(
                'sa_el_section_style_support', [
            'label' => __('Unable To Use or Found Bugs?', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE
                ]
        );
        $this->add_control(
                'sa_el_section_style_support_get', [
            'label' => __('Need Support', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::CHOOSE,
            'toggle' => FALSE,
            'options' => [
                '1' => [
                    'title' => __('', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'fas fa-headset',
                ],
            ],
            'default' => '1',
            'description' => 'Are you in need of a feature that’s not available in our plugin or got some bugs? Feel free to do a <a href="https://wordpress.org/support/plugin/sb-image-hover-effects/" target="_blank">Support</a> request.'
                ]
        );
        $this->end_controls_section();
    }

}
