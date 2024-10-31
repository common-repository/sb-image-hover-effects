<?php

namespace SA_EL_ADDONS\Classes\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Addons
 * Content of Shortcode Addons Plugins
 *
 * @author $biplob018
 */
class Addons {

    use \SA_EL_ADDONS\Helper\Public_Helper;

    public function __construct() {
        $this->menu();
        $this->CSS_JSS();
        $this->Handler();
        $this->Render();
    }

    /**
     * Plugin admin menu
     *
     * @since 1.0.0
     */
    public function menu() {
        echo apply_filters('sa-el-addons/admin_nav_menu', false);
    }

    /**
     * Plugin CSS_JSS
     *
     * @since 1.0.0
     */
    public function CSS_JSS() {
        wp_enqueue_style('sa-el-admin-css', SA_EL_ADDONS_URL . '/assets/css/admin.css', false, SA_EL_ADDONS_PLUGIN_VERSION);
        wp_enqueue_style('bootstrap.min-css', SA_EL_ADDONS_URL . '/assets/css/bootstrap.min.css', false, SA_EL_ADDONS_PLUGIN_VERSION);
        wp_enqueue_script("jquery");
        wp_enqueue_script('bootstrap.min', SA_EL_ADDONS_URL . '/assets/js/bootstrap.min.js', false, SA_EL_ADDONS_PLUGIN_VERSION);
        $this->font_familly_validation(['Bree+Serif', 'Source+Sans+Pro']);
    }

    /**
     * Plugin Handler
     *
     * @since 1.0.0
     */
    public function Handler() {
        wp_enqueue_script('sa-elemetor-addons-script', SA_EL_ADDONS_URL . '/assets/js/addons.js', false, SA_EL_ADDONS_PLUGIN_VERSION);
        wp_localize_script('sa-elemetor-addons-script', 'saelemetoraddons', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('sa_elemetor_addons'),
        ));
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

    /**
     * Plugin Render
     *
     * @since 1.0.0
     */
    public function Render() {
        $registered_element = $element = $array1 = array('Extension' => array());
        $registered_el = $this->Get_Registered_elements(true);
        foreach ($registered_el as $key => $value) {
            $array1[$value['category']] = $value['category'];
            $element[$value['category']][$key] = $value;
        }
        $array2 = array(
            'Content Elements' => 'Content Elements',
            'Creative Elements' => 'Creative Elements',
            'Marketing Elements' => 'Marketing Elements',
            'Carousel & Slider' => 'Carousel & Slider',
            'Social Elements' => 'Social Elements',
            'Form Contents' => 'Form Contents',
            'Extension' => 'Extension',
            'Modules' => 'Modules'
        );
        $margecat = array_merge($array2, $array1);
        foreach ($margecat as $key => $value) {
            (array_key_exists($key, $element) ? $registered_element[$value] = $element[$value] : '');
        }
        $sa_el_extension = $sa_el_elements = $sa_el_modules = [];
        foreach ($registered_element as $key => $value) {
            if ($key == 'Extension'):
                $sa_el_extension[$key] = $value;
            elseif ($key == 'Modules'):
                $sa_el_modules[$key] = $value;
            else:
                $sa_el_elements[$key] = $value;
            endif;
        }
        $Get_Active_Elements = $this->Get_Active_Elements();
        $bgimage = SA_EL_ADDONS_URL . 'image/logo.png';
        ?>
        <div class="oxi-addons-wrapper">
            <div class="oxi-addons-row">
                <form action="" method="POST" id="sa-el-settings">
                    <div class="oxi-addons-wrapper">
                        <div class="sa-el-header-wrap">
                            <div class="sa-el-header-left">
                                <div class="sa-el-admin-logo-inline">
                                    <img src="<?php echo $bgimage ?>">
                                </div>
                                <h2 class="title">Elementor Addons Settings</h2>
                            </div>
                            <div class="sa-el-header-right">
                                <button type="submit" class="button sa-el-btn sa-el-settings-save" sa-el-change="no" style="cursor: not-allowed" disabled="disabled">Save settings</button>
                            </div>
                        </div>
                    </div>

                    <div class="ctu-ultimate-wrapper ctu-ultimate-wrapper-2">
                        <div class="ctu-ulimate-style-2">
                            <div class="vc-tabs-li vc-tabs-li-2-id-4" ref="#tabs-general">
                                General
                            </div>
                            <div class="vc-tabs-li vc-tabs-li-2-id-5" ref="#tabs-elements">
                                Elements
                            </div>
                            <div class="vc-tabs-li vc-tabs-li-2-id-4" ref="#tabs-extention">
                                Extension
                            </div>
                            <div class="vc-tabs-li vc-tabs-li-2-id-4" ref="#tabs-addons">
                                Modules
                            </div>
                            <div class="vc-tabs-li vc-tabs-li-2-id-5" ref="#tabs-cache">
                                Cache
                            </div>
                        </div>
                        <div class="ctu-ultimate-style-2-content"> 
                            <div class="ctu-ulitate-style-2-tabs" id="tabs-general">
                                <div class="about-wrap text-center">
                                    <h1>Welcome to Elementor Addons</h1>
                                    <div class="about-text">
                                        Thank you for Installing Elementor Addons, The most friendly Elementor extension or all in one Package for Elementor. Here's how to get started.
                                    </div>
                                </div>
                                <div class="feature-section">
                                    <div class="about-container">
                                        <div class="about-addons-videos"><iframe src="https://www.youtube.com/embed/3M6jrL_Ytes" frameborder="0" allowfullscreen class="about-video"></iframe></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="sa-el-admin-wrapper">

                                            <div class="sa-el-admin-block">
                                                <div class="sa-el-admin-header">
                                                    <div class="sa-el-admin-header-icon">
                                                        <span class="dashicons dashicons-format-aside"></span>
                                                    </div>    
                                                    <h4 class="sa-el-admin-header-title">Documentation</h4>  
                                                </div>
                                                <div class="sa-el-admin-block-content">
                                                    <p>Get started by spending some time with the documentation to get familiar with Elementor Addons. Build awesome websites for you or your clients with ease.</p>
                                                    <a href="https://www.sa-elementor-addons.com/docs" class="sa-el-button" target="_blank">Documentation</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="col-lg-6 col-md-12">
                                        <div class="sa-el-admin-wrapper">
                                            <div class="sa-el-admin-block">
                                                <div class="sa-el-admin-header">
                                                    <div class="sa-el-admin-header-icon">
                                                        <span class="dashicons dashicons-format-aside"></span>
                                                    </div>    
                                                    <h4 class="sa-el-admin-header-title">Contribute to Elementor Addons</h4>  
                                                </div>
                                                <div class="sa-el-admin-block-content">
                                                    <p>You can contribute to make Elementor Addons better reporting bugs & creating issues. Our Development team always try to make more powerfull addons day by day with solved Issues</p>
                                                    <a href="https://wordpress.org/support/plugin/sb-image-hover-effects/" class="sa-el-button" target="_blank">Report a bug</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="col-lg-6 col-md-12">
                                        <div class="sa-el-admin-wrapper">
                                            <div class="sa-el-admin-block">
                                                <div class="sa-el-admin-header">
                                                    <div class="sa-el-admin-header-icon">
                                                        <span class="dashicons dashicons-format-aside"></span>
                                                    </div>    
                                                    <h4 class="sa-el-admin-header-title">Video Tutorials </h4>  
                                                </div>
                                                <div class="sa-el-admin-block-content">
                                                    <p>Unable to use Elementor Addons? Don't worry you can check your web tutorials to make easier to use :) </p>
                                                    <a href="https://www.youtube.com/playlist?list=PLUIlGSU2bl8gFKe5UBZJqvZN7Z-tvE-w7" class="sa-el-button" target="_blank">Video Tutorials</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                </div>   
                            </div> 
                            <div class="ctu-ulitate-style-2-tabs" id="tabs-elements">
                                <div class="oxi-addons-wrapper">
                                    <div class="oxi-addons-import-layouts">
                                        <h1>GLOBAL CONTROL</h1>
                                        <p> Use the Buttons to Activate or Deactivate all the Elements of Elementor Addons at once.</p>
                                    </div>
                                    <div class="sa-el-btn-group">
                                        <button type="button" class="sa-el-btn sa-el-btn-control-enable">Enable All</button>
                                        <button type="button" class="sa-el-btn sa-el-btn-control-disable">Disable All</button>
                                    </div>
                                </div>
                                <div class="oxi-addons-wrapper">
                                    <div class="oxi-addons-row">
                                        <?php
                                        foreach ($sa_el_elements as $key => $value) {
                                            echo '<div class="oxi-sa-cards-wrapper">';
                                            echo '<div class="oxi-addons-ce-heading">' . $this->name_converter($key) . '</div>';
                                            echo '<div class="row">';
                                            foreach ($value as $elements) {
                                                $Control = $docs_preview = '';
                                                if (array_key_exists('preview', $elements)):
                                                    $docs_preview .= '<div class="oxi-sa-cards-settings">
                                                                         <span data-href="' . $elements['preview'] . '" class="dashicons dashicons-visibility dashicons-sa-el-icon-link"></span>
                                                                      </div>';
                                                endif;
                                                if (array_key_exists('docs', $elements)):
                                                    $docs_preview .= '<div class="oxi-sa-cards-settings">
                                                                         <span data-href="' . $elements['docs'] . '" class="dashicons dashicons-book-alt dashicons-sa-el-icon-link"></span>
                                                                      </div>';
                                                endif;
                                                if (array_key_exists('Control', $elements)):
                                                    $current = [];
                                                    foreach ($elements['Control'] as $k => $v) {
                                                        $s = get_option($k);
                                                        $current[$k] = $s ? $s : $v['default'];
                                                    }

                                                    $Control = '<div class="oxi-sa-cards-settings">
                                                                    <span id="modal_settings_'.$elements['name'].'" data-title="' . $this->name_converter($elements['name']) . '" data-encode=\'' . json_encode($elements['Control']) . '\' data-savl=\''. json_encode($current).'\' class="dashicons dashicons-admin-tools dashicons-modal-settings"></span>
                                                                </div>';
                                                endif;
                                                echo '  <div class="col-lg-4 col-md-6 col-sm-12">
                                                                <div class="oxi-sa-cards">
                                                                    ' . (($elements['Premium'] == TRUE && !apply_filters('sa-el-addons/check_version', '')) ? '<sup class="pro-label">Pro</sup>' : "") . '
                                                                    <div class="oxi-sa-cards-h1">
                                                                        ' . $this->name_converter($elements['name']) . '
                                                                        ' . $docs_preview . '
                                                                    </div>
                                                                    ' . $Control . '
                                                                    <div class="oxi-sa-cards-switcher ' . (($elements['Premium'] == TRUE && apply_filters('sa-el-addons/check_version', '') == FALSE) ? 'oxi-sa-cards-switcher-disabled' : "") . '">
                                                                        <input type="checkbox" class="oxi-addons-switcher-btn" sa-elmentor="' . $elements['name'] . '" id="' . $elements['name'] . '" name="' . $elements['name'] . '" ' . (array_key_exists($elements['name'], $Get_Active_Elements) ? 'checked="checked"' : '') . ' >
                                                                        <label for="' . $elements['name'] . '" class="oxi-addons-switcher-label"></label>
                                                                    </div>
                                                                </div>
                                                            </div>';
                                            }
                                            echo '</div></div>';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="ctu-ulitate-style-2-tabs" id="tabs-extention">
                                <div class="oxi-addons-wrapper">
                                    <div class="oxi-addons-row">
                                        <?php
                                        foreach ($sa_el_extension as $key => $value) {
                                            $section = $content = '';
                                            foreach ($value as $elements) {
                                                $var = ($elements['Extension'] == 'Elements Layouts' ? 'content' : 'section');
                                                $$var .= '  <div class="col-lg-4 col-md-6 col-sm-12">
                                                                <div class="oxi-sa-cards">
                                                                    ' . (($elements['Premium'] == TRUE && !apply_filters('sa-el-addons/check_version', '')) ? '<sup class="pro-label">Pro</sup>' : "") . '
                                                                    <div class="oxi-sa-cards-h1">
                                                                        ' . $this->name_converter($elements['name']) . '
                                                                    </div>
                                                                    <div class="oxi-sa-cards-switcher ' . (($elements['Premium'] == TRUE && apply_filters('sa-el-addons/check_version', '') == FALSE) ? 'oxi-sa-cards-switcher-disabled' : "") . '">
                                                                        <input type="checkbox" class="oxi-addons-switcher-btn" sa-elmentor="' . $elements['name'] . '" id="' . $elements['name'] . '" name="' . $elements['name'] . '" ' . (array_key_exists($elements['name'], $Get_Active_Elements) ? 'checked="checked"' : '') . ' >
                                                                        <label for="' . $elements['name'] . '" class="oxi-addons-switcher-label"></label>
                                                                    </div>
                                                                </div>
                                                            </div>';
                                            }

                                            echo '<div class="oxi-sa-cards-wrapper">';
                                            echo '<div class="oxi-addons-ce-heading">Elements Layouts</div>';
                                            echo '<div class="row">';
                                            echo $content;
                                            echo '</div></div>';

                                            echo '<div class="oxi-sa-cards-wrapper">';
                                            echo '<div class="oxi-addons-ce-heading">Section Layouts</div>';
                                            echo '<div class="row">';
                                            echo $section;
                                            echo '</div></div>';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="ctu-ulitate-style-2-tabs" id="tabs-addons">
                                <div class="row">
                                    <?php
                                    foreach ($sa_el_modules as $key => $value) {
                                        foreach ($value as $elements) {
                                            echo '<div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="oxi-addons-modules-elements">
                                                        <img class="oxi-addons-modules-banner" src="' . $elements['image'] . '">
                                                        <div class="oxi-addons-modules-action-wrapper">	
                                                            ' . (($elements['Premium'] == TRUE && !apply_filters('sa-el-addons/check_version', '')) ? '<sup class="pro-label">Pro</sup>' : "") . '
                                                            <span class="oxi-addons-modules-name">' . $this->name_converter($elements['name']) . '
                                                                <div class="oxi-sa-cards-switcher ' . (($elements['Premium'] == TRUE && apply_filters('sa-el-addons/check_version', '') == FALSE) ? 'oxi-sa-cards-switcher-disabled' : "") . '">
                                                                    <input type="checkbox" class="oxi-addons-switcher-btn" sa-elmentor="' . $elements['name'] . '" id="' . $elements['name'] . '" name="' . $elements['name'] . '" ' . (array_key_exists($elements['name'], $Get_Active_Elements) ? 'checked="checked"' : '') . ' >
                                                                    <label for="' . $elements['name'] . '" class="oxi-addons-switcher-label"></label>
                                                                </div>
                                                            </span>
                                                            <span class="oxi-addons-modules-desc">' . $elements['desc'] . '</span>	
                                                        </div>	
                                                    </div>
                                                </div>';
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="ctu-ulitate-style-2-tabs" id="tabs-cache">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="sa-el-admin-wrapper">
                                            <div class="sa-el-admin-block">
                                                <div class="sa-el-admin-header tabs-cache">
                                                    <div class="sa-el-admin-header-icon">
                                                        <span class="dashicons dashicons-format-aside"></span>
                                                    </div>    
                                                    <h4 class="sa-el-admin-header-title">Clear Cache</h4>  
                                                </div>
                                                <div class="sa-el-admin-block-content">
                                                    <p>Elementor Addons styles & scripts are saved in Uploads folder. This option will clear all those cached files.</p>
                                                    <a href="#" class="sa-el-button sa-el-button-clear-cache">Clear Cache</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                </div>   
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="OXIAADDONSCHANGEDPOPUP" class="modal fade">
            <div class="modal-dialog modal-confirm  bounceIn ">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">

                        </div>
                    </div>
                    <div class="modal-body text-center">
                        <h4></h4>	
                        <p></p>
                    </div>
                </div>
            </div>
        </div> 

        <div class="modal" tabindex="-1" role="dialog" id="sa-el-addons-modal-settings">
            <form action="" method="POST" id="sa-el-modal-settings">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }

}
