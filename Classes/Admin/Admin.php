<?php

namespace SA_EL_ADDONS\Classes\Admin;

if (!defined('ABSPATH')) {
    exit;
}

class Admin {

    public function __construct() {
        add_action('admin_menu', array($this, 'admin_menu'));
        add_filter('sa-el-addons/admin_nav_menu', array($this, 'admin_nav_menu'));
        add_action('admin_head', array($this, 'menu_icon'));
        $this->basic_menu();
    }

    /**
     * SA Elementor Addons menu Icon
     * @since 1.0.0
     */
    public function menu_icon() {
        ?>
        <style type='text/css' media='screen'>
            @keyframes SAGRADIENT {
                0%,
                100% {
                    background-position: 0 50%
                }
                50% {
                    background-position: 100% 50%
                }
            }
            #adminmenu li.menu-top.toplevel_page_sa-el-addons,
            #adminmenu li.menu-top.toplevel_page_sa-el-addons:hover,
            #adminmenu li.opensub > a.menu-top.toplevel_page_sa-el-addons,
            #adminmenu li > a.menu-top.toplevel_page_sa-el-addons:focus {
                background: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB)!important;
                animation: SAGRADIENT 15s ease infinite;
                background-size: 400% 400%!important;
                color: #fff!important;
            }
            #adminmenu #toplevel_page_sa-el-addons  div.wp-menu-image img {
                width: 26px!important;
                margin: 4px 5px;
                display: block;
                padding: 0;
                opacity: 1;
                filter: alpha(opacity=100);
            }
        </style>
        <?php

    }

    /**
     * Plugin Elements Name Convert to View
     *
     * @since 1.0.0
     */
    public function name_converter($data) {
        $data = str_replace('_', ' ', $data);
        $data = str_replace('-', ' ', $data);
        $data = str_replace('+', ' ', $data);
        return ucwords($data);
    }

    public function admin_url_convert($agr) {
        return admin_url(strpos($agr, 'edit') !== false ? $agr : 'admin.php?page=' . $agr);
    }

    /**
     * Plugin admin menu
     *
     * @since 1.0.0
     */
    public function admin_nav_menu($agr) {
        $menu = 'get_oxilab_addons_menu';
        $elements = !empty(get_transient($menu)) ? get_transient($menu) : [];
        if (!array_key_exists('Elementor', $elements) || !array_key_exists('Addons', $elements['Elementor'])):
            $elements = [];
            $elements['Elementor']['Addons'] = [
                'name' => 'Addons',
                'homepage' => 'sa-el-addons'
            ];
            set_transient($menu, $elements, 10 * DAY_IN_SECONDS);
        endif;
        $bgimage = SA_EL_ADDONS_URL . 'image/sa-logo.png';
        $sub = '';
        $menu = '<div class="oxi-addons-wrapper">
                    <div class="oxilab-new-admin-menu">
                        <div class="oxi-site-logo">
                            <a href="' . $this->admin_url_convert('sa-el-addons') . '" class="header-logo" style=" background-image: url(' . $bgimage . ');">
                            </a>
                        </div>
                        <nav class="oxilab-sa-admin-nav">
                            <ul class="oxilab-sa-admin-menu">';


        $GETPage = sanitize_text_field($_GET['page']);
        $oxitype = (!empty($_GET['oxitype']) ? sanitize_text_field($_GET['oxitype']) : '');

        if (count($elements) == 1):
            foreach ($elements['Elementor'] as $key => $value) {
                $active = ($GETPage == $value['homepage'] ? (empty($oxitype) ? ' class="active" ' : '') : '');
                $menu .= '<li ' . $active . '><a href="' . $this->admin_url_convert($value['homepage']) . '">' . $this->name_converter($value['name']) . '</a></li>';
            }
        else:
            foreach ($elements as $key => $value) {
                $active = ($key == 'Elementor' ? 'active' : '');
                $menu .= '<li class="' . $active . '"><a class="oxi-nev-drop-menu" href="#">' . $this->name_converter($key) . '</a>';
                $menu .= '     <div class="oxi-nev-d-menu">
                                                    <div class="oxi-nev-drop-menu-li">';
                foreach ($value as $key2 => $submenu) {
                    $menu .= '<a href="' . $this->admin_url_convert($submenu['homepage']) . '">' . $this->name_converter($submenu['name']) . '</a>';
                }
                $menu .= '                                                                                                  </div>';
                $menu .= '</li>';
            }
            if ($GETPage == 'sa-el-addons' || $GETPage == 'sa-el-templates' || $GETPage == 'sa-el-addons-settings'):
                $sub .= '<div class="shortcode-addons-main-tab-header">';
                foreach ($elements['Elementor'] as $key => $value) {
                    $active = ($GETPage == $value['homepage'] ? (empty($oxitype) ? 'oxi-active' : '') : '');
                    $sub .= '<a href="' . $this->admin_url_convert($value['homepage']) . '">
                                <div class="shortcode-addons-header ' . $active . '">' . $this->name_converter($value['name']) . '</div>
                              </a>';
                }
                $sub .= '</div>';
            endif;
        endif;
        $menu .= '              </ul>
                            <ul class="oxilab-sa-admin-menu2">
                               ' . (!apply_filters('sa-el-addons/check_version', '') ? ' <li class="fazil-class" ><a target="_blank" href="https://www.oxilab.org/downloads/elementor-addons/">Upgrade</a></li>' : '') . '
                               <li class="saadmin-doc"><a target="_black" href="https://www.sa-elementor-addons.com/docs/">Docs</a></li>
                               <li class="saadmin-doc"><a target="_black" href="https://wordpress.org/support/plugin/sb-image-hover-effects/">Support</a></li>
                               <li class="saadmin-set"><a href="' . admin_url('admin.php?page=sa-el-addons-settings') . '"><span class="dashicons dashicons-admin-generic"></span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                ' . $sub;
        echo __($menu, SA_EL_ADDONS_TEXTDOMAIN);
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

    /**
     * Plugin admin menu
     *
     * @since 1.0.0
     */
    public function admin_menu() {
        $permission = $this->menu_permission();
        add_menu_page('Elementor Addons', 'Elementor Addons', $permission, 'sa-el-addons', [$this, 'Addons'], SA_EL_ADDONS_URL . 'image/white-logo.png');
        add_submenu_page('sa-el-addons', 'Addons', 'Addons', $permission, 'sa-el-addons', [$this, 'Addons']);
        add_submenu_page('sa-el-addons', 'Elementor Addons Settings', 'Settings', $permission, 'sa-el-addons-settings', [$this, 'Settings']);
    }

    public function Addons() {
        new \SA_EL_ADDONS\Classes\Admin\Addons();
    }

    public function settings() {
        new \SA_EL_ADDONS\Classes\Admin\Settings();
    }

    public function basic_menu() {
        
    }

}
