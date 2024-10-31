<?php

namespace SA_EL_ADDONS\Modules\Templates\views;

/**
 * Description of Templates
 *
 * @author biplo
 */
class Templates {

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
        wp_enqueue_script('sa-elemetor-addons-templates', SA_EL_ADDONS_URL . 'Modules/Templates/assets/js/templates.js', false, SA_EL_ADDONS_PLUGIN_VERSION);
        $js = 'var ElementorAddons = {
                        restapi: "' . get_rest_url() . 'ElementorAddons/v1/",
                   }';
        wp_add_inline_script('sa-elemetor-addons-templates', $js);
        wp_localize_script('sa-elemetor-addons-templates', 'saelemetoraddons', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('sa_elemetor_addons'),
        ));
    }

    /**
     * Plugin Render
     *
     * @since 1.0.0
     */
    public function Render() {
        ?>
        <div class="oxi-addons-wrapper">
            <?php
            $page = (!empty($_GET['type']) ? $_GET['type'] : '');
            if ($page == ''):
                $template = ['template' => [
                        'name' => 'Templates',
                        'url' => 'sa-el-addons&type=templates',
                        'image' => 'https://www.sa-elementor-addons.com/wp-content/uploads/2019/11/templa.jpg'
                    ], 'blocks' => [
                        'name' => 'Blocks',
                        'url' => 'sa-el-addons&type=blocks',
                        'image' => 'https://www.sa-elementor-addons.com/wp-content/uploads/2019/11/blocks.jpg'
                    ], 'Presets' => [
                        'name' => 'Presets',
                        'url' => 'sa-el-addons&type=presets',
                        'image' => 'https://www.sa-elementor-addons.com/wp-content/uploads/2019/11/presets.jpg'
                    ], 'Header' => [
                        'name' => 'Header',
                        'url' => 'sa-el-addons&type=header',
                        'image' => 'https://www.sa-elementor-addons.com/wp-content/uploads/2019/11/header-1.jpg'
                    ], 'Footer' => [
                        'name' => 'Footer',
                        'url' => 'sa-el-addons&type=footer',
                        'image' => 'https://www.sa-elementor-addons.com/wp-content/uploads/2019/11/footer.jpg'
                    ]
                ];
                echo '<div class="oxi-addons-row"><div class="row d-flex justify-content-center">';
                echo '<div class="col-sm-12 p-3"></div>';
                foreach ($template as $key => $value) {
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="oxi-addons-modules-elements oxi-addons-modules-elements-template">
                            <a href="<?php echo admin_url('admin.php?page=sa-el-templates&type=' . $value['url']); ?>">
                                <img class="oxi-addons-modules-banner" src="<?php echo $value['image']; ?>">
                                <div class="oxi-addons-modules-action-wrapper">
                                    <span class="oxi-addons-modules-name"><?php echo $value['name']; ?></span>
                                </div>	
                            </a>
                        </div>
                    </div>
                    <?php
                }
                echo '</div></div>';
            else:
                ?>
                <div class="oxi-addons-sa-el-parent" id="oxi-addons-sa-el-parent">
                    <div class="oxi-addons-sa-el-paren-loader">
                        <div id="loading">
                            <div id="loading-center">
                                <div id="loading-center-absolute">
                                    <div class="object" id="object_one"></div>
                                    <div class="object" id="object_two"></div>
                                    <div class="object" id="object_three"></div>
                                    <div class="object" id="object_four"></div>
                                    <div class="object" id="object_five"></div>
                                    <div class="object" id="object_six"></div>
                                    <div class="object" id="object_seven"></div>
                                    <div class="object" id="object_eight"></div>
                                    <div class="object" id="object_big"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade sa-el-template-preview-import-modal" id="sa-el-template-preview-import-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="SA-el-ModalLabelTitle">Modal title</h5>
                            </div>
                            <div class="modal-body">
                                <p class="sa-el-msg">Import this Blocks via one click</p>
                                <div class="sa-el-btn-body">
                                    <span class="sa-el-loader"></span>
                                    <a href="javascript:void(0)" class="el-import-btn sael-btn sa-el-final-import-start">Import Blocks</a>
                                    <a href="#" target="_blank" data-hr="<?php echo admin_url('post.php?post=') ?>" class="el-edit-btn sael-btn sa-el-final-edit-start" target="_blank">Edit Blocks</a>
                                </div>
                                <p class="sa-el-horizontal">OR</p>
                                <div class="sa-el-page-create">
                                    <p>Create a new page from this Blocks</p>
                                    <input type="text" class="sa-el-page-name" id="sa-el-page-name" name="sa-el-page-name" placeholder="Enter a Page Name">
                                    <div class="sa-el-btn-body">
                                        <a href="javascript:void(0)" style="padding: 0;" class="el-import-btn sael-btn sa-el-final-create-start">Create New Page</a>
                                        <span class="sa-el-loader-page"></span>
                                    </div>
                                </div>
                                <div class="sa-el-page-edit">
                                    <p style="color: #000;">Your page is successfully imported!</p>
                                    <div class="sa-el-btn-body">
                                        <a href="#" target="_blank" data-hr="<?php echo admin_url('post.php?post=') ?>" class="el-edit-btn sael-btn sa-el-final-edit-page" target="_blank">Edit Page</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade modal-fullscreen" id="SA-EL-IFRAME" tabindex="-1" role="dialog" aria-labelledby="SA-EL-IFRAME" aria-hidden="true">
                    <div class="modal-dialog animated zoomInLeft">
                        <div class="modal-content">
                            <div class="modal-header d-block">
                                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="SA-el-ModalLabelTitle">Modal title</h5>
                            </div>
                            <div class="modal-body">

                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endif;
            ?>

        </div>
        <?php
    }

}
