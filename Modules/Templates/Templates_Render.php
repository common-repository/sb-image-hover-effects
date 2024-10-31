<?php

namespace SA_EL_ADDONS\Modules\Templates;

/**
 *
 * @author biplo
 */
trait Templates_Render {

    public function plugins_dependency($required) {
        $required = explode(',', $required);
        if (!function_exists('get_plugins')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
        $installed_plugins = get_plugins();
        $return = '';
        foreach ($required as $value) {
            if ($value != '') {
                $return .= (isset($installed_plugins[$value]) ? '' : $value . ',');
            }
        }
        return $return;
    }

    public function templates_render($satype = '') {
        $templates = \SA_EL_ADDONS\Modules\Templates\Rest_API::get_instance()->TRANSIENT_TEMPLATE();
        $categories = \SA_EL_ADDONS\Modules\Templates\Rest_API::get_instance()->TEMPLATE_CATEGORY();
        if (!empty($satype)):
            $args = array('post_type' => 'elementor_library', 'posts_per_page' => -1,);



            $el_library = [0 => [], 1 => []];
            $query = new \WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $el_library[0][$query->post->post_name] = $query->post->post_name;
                    $el_library[1][$query->post->post_name] = $query->post->ID;
                }
            }

            $i = 0;
            $tempdata = '';
            foreach ($templates['templates'][$satype] as $section) {
                if ($section['is_pro'] && !apply_filters('sa-el-addons/check_version', '')) {
                    $profile = '<div class="oxi-el-template-section-imagebody">
                                        <a href="#" data-url="' . $section['url'] . '" class="sael-btn sa-el-preview-button"  sa-el-title="' . $section['title'] . ' Templates">Preview</a>
                                </div>
                                <div class="oxi-el-template-section-imagebody-pro">
                                    <div class="sa-el-pro-spn">Upgrade</div>
                                </div>';
                } else if (array_key_exists($section['post_name'], $el_library[0])) {
                    $profile = '<div class="oxi-el-template-section-imagebody">
                                        <a href="#" data-url="' . $section['url'] . '" class="sael-btn sa-el-preview-button" sa-el-title="' . $section['title'] . ' Templates">Preview</a>
                                        <a href="' . admin_url('post.php?post=' . $el_library[1][$section['post_name']] . '&action=elementor') . '" target="_blank" class="sael-btn el-edit-btn">Edit Template</a>
                                    </div>';
                } else {
                    $profile = '<div class="oxi-el-template-section-imagebody">
                                        <a href="#" data-url="' . $section['url'] . '" class="sael-btn sa-el-preview-button">Preview</a>
                                        <a href="javascript:void(0)"  class="sael-btn el-import-btn  sa-el-import-start" sael_required="' . str_replace('-', ' ', $section['required']) . '" sael-id="' . $section['id'] . '" sa-el-title="' . $section['title'] . ' Template">Import</a>
                                    </div>';
                }
                $tempdata .= '<div class="oxi-el-template-data-col">
                                <div class="oxi-el-template-section-image">
                                    <div class="oxi-el-template-section-image-data"style="background-image: url(' . $section['thumbnail'] . ')"></div>
                                    ' . $profile . '
                                </div>
                                <div class="oxi-el-template-data-content">
                                    <div class="oxi-el-template-data-content-data">
                                        <h3>' . $section['title'] . '</h3>
                                    </div>
                                </div>
                            </div>';
                $i++;
            }

            return '<div class="oxi-el-template-section">
                    <div class="oxi-el-template-back-menu">
                        <a href="' . admin_url('admin.php?page=sa-el-templates&type=templates') . '">Back to Elementor Templates</a>
                    </div>
                    <div class="oxi-el-template-count-section">
                        <div class="oxi-el-template-count">
                            <h1 class="oxi-el-template-count-h1">' . $categories['category'][$satype]['title'] . '</h1>
                            <div class="oxi-el-template-count-data">' . $i++ . ' Page Templates in this Kits.</div>
                        </div>
                    </div>
                    <div class="oxi-el-template-data">
                            ' . $tempdata . '
                    </div>
                </div>';
        else:
            $temdata = '';
            $num = $pg = 0;
            foreach ($categories['category'] as $cat) {
                if ($cat['category_parent'] == $categories['parent']['templates']) {
                    $temdata .= '<div class="oxi-el-template-data-col">
                                    <div class="oxi-el-template-data-image">
                                        <div class="oxi-el-template-data-image-data"style="background-image: url(' . $cat['thumbnail'] . ')"></div>
                                        <a href="' . admin_url('admin.php?page=sa-el-templates&type=templates&section=' . $cat['slug'] . '') . '"></a>
                                    </div>
                                    <div class="oxi-el-template-data-content">
                                        <div class="oxi-el-template-data-content-data">
                                            <h3>' . $cat['title'] . '</h3>
                                            ' . $cat['template_count'] . ' Page Templates in this Kits
                                        </div>
                                    </div>
                                </div>';
                    $pg += $cat['template_count'];
                    $num++;
                }
            }

            return '<div class="oxi-el-template-body">
                            <div class="oxi-el-template-count">
                            <h1 class="oxi-el-template-count-h1">Free Template Kits for Elementor</h1>
                            <div class="oxi-el-template-count-data">' . $num . ' Free Template Kits, over ' . $pg . ' individual Responsive Page Templates.</div>
                        </div>
                            <div class="oxi-el-template-data">
                            ' . $temdata . '
                            </div>  
                        </div>';
        endif;
    }

    public function blocks_render($satype = '') {
        $templates = \SA_EL_ADDONS\Modules\Templates\Rest_API::get_instance()->TRANSIENT_TEMPLATE();
        $categories = \SA_EL_ADDONS\Modules\Templates\Rest_API::get_instance()->TEMPLATE_CATEGORY();

        if (!empty($satype)):

            $args = array('post_type' => 'elementor_library', 'posts_per_page' => -1,);
            $el_library = [0 => [], 1 => []];
            $query = new \WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $el_library[0][$query->post->post_name] = $query->post->post_name;
                    $el_library[1][$query->post->post_name] = $query->post->ID;
                }
            }

            $i = 0;
            $tempdata = '';
            foreach ($templates['templates'][$satype] as $section) {
                if ($section['is_pro'] && !apply_filters('sa-el-addons/check_version', '')) {
                    $profile = ' <a href="javascript:void(0)" data-url="#" class="sael-btn sa-el-blocks-pro-button">Upgrade Please</a>';
                } else if (array_key_exists($section['post_name'], $el_library[0])) {
                    $profile = '<a href="' . admin_url('post.php?post=' . $el_library[1][$section['post_name']] . '&action=elementor') . '" target="_blank" class="sael-btn el-edit-btn">Edit Block</a>';
                } else {
                    $profile = ' <a href="javascript:void(0)" data-url="#" class="sael-btn el-import-btn sa-el-import-start"  sael_required="' . $this->plugins_dependency($section['required']) . '" sael-id="' . $section['id'] . '"  sa-el-title="' . $section['title'] . ' Block">Import</a>';
                }
                $tempdata .= '<div class="oxi-el-blocks-section-col">
                                <div class="oxi-el-blocks-section-image">
                                    <img src="' . $section['thumbnail'] . '" alt="' . $section['title'] . '">
                                    <div class="oxi-el-template-section-imagebody">
                                         <a href="#" data-url="' . $section['url'] . '" class="sael-btn sa-el-preview-button" sa-el-title="' . $section['title'] . ' Block">Preview</a>
                                    </div>
                                </div>
                                <div class="oxi-el-blocks-section-content">
                                    <div class="oxi-el-template-count">
                                        <h1 class="oxi-el-template-count-h1">' . $section['title'] . '</h1>
                                        <div class="oxi-el-template-count-data">Import this template to make it available in your Elementor Saved Templates list for future use.</div>
                                        <div class="oxi-el-blocks-section-success">Congrats! This was just imported to the WordPress library.</div>
                                        ' . $profile . '
                                      </div>
                                </div>
                            </div>';
                $i++;
            }
            return '  <div class="oxi-el-blocks-section">
                        <div class="oxi-el-template-back-menu">
                            <a href="' . admin_url('admin.php?page=sa-el-templates&type=blocks') . '">Back to all Blocks</a>
                        </div>
                        <div class="oxi-el-template-count-section">
                            <div class="oxi-el-template-count">
                                <h1 class="oxi-el-template-count-h1">' . $categories['category'][$satype]['title'] . '</h1>
                                <div class="oxi-el-template-count-data">' . $i++ . ' Templates in this blocks category.</div>
                            </div>
                        </div>
                        
                        <div class="oxi-el-template-data">
                            ' . $tempdata . '
                        </div>
                    </div>';
        else:
            $temdata = '';
            $pg = 0;
            foreach ($categories['category'] as $cat) {
                if ($cat['category_parent'] == $categories['parent']['blocks']) {
                    $temdata .= '<div class="oxi-el-blocks-data-col">
                                    <div class="oxi-el-blocks-data-content">
                                        <div class="oxi-el-template-data-content-data">
                                            <h3>' . $cat['title'] . '</h3>
                                            ' . $cat['template_count'] . ' Page Templates in this Kits
                                            <a href="' . admin_url('admin.php?page=sa-el-templates&type=blocks&section=' . $cat['slug']) . '"></a>
                                        </div>
                                    </div>
                                </div>';
                    $pg += $cat['template_count'];
                }
            }
            return '<div class="oxi-el-blocks-body" >
                    <div class="oxi-el-template-count">
                        <h1 class="oxi-el-template-count-h1">Free Block Kits for Elementor</h1>
                        <div class="oxi-el-template-count-data">Browse over ' . $pg . ' free Responsive Block.</div>
                    </div>
                    <div class="oxi-el-blocks-data">
                        ' . $temdata . '
                    </div>
                </div>';
        endif;
    }

    public function presets_render($satype = '') {
        $templates = \SA_EL_ADDONS\Modules\Templates\Rest_API::get_instance()->TRANSIENT_TEMPLATE();
        $categories = \SA_EL_ADDONS\Modules\Templates\Rest_API::get_instance()->TEMPLATE_CATEGORY();
        if (!empty($satype)):
            $args = array('post_type' => 'elementor_library', 'posts_per_page' => -1,);
            $el_library = [0 => [], 1 => []];
            $query = new \WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $el_library[0][$query->post->post_name] = $query->post->post_name;
                    $el_library[1][$query->post->post_name] = $query->post->ID;
                }
            }
            $i = 0;
            $tempdata = '';
            foreach ($templates['templates'][$satype] as $section) {

                if (!apply_filters('sa-el-addons/check_version', '')) {
                    $profile = ' <a href="javascript:void(0)" data-url="#" class="sael-btn sa-el-blocks-pro-button">Upgrade Please</a>';
                } else if (array_key_exists($section['post_name'], $el_library[0])) {
                    $profile = '<a href="' . admin_url('post.php?post=' . $el_library[1][$section['post_name']] . '&action=elementor') . '" target="_blank" class="sael-btn el-edit-btn">Edit Block</a>';
                } else {
                    $profile = ' <a href="javascript:void(0)" data-url="#" class="sael-btn el-import-btn sa-el-import-start"  sael_required="" sael-id="' . $section['id'] . '"  sa-el-title="' . $section['title'] . ' Block">Import</a>';
                }
                $tempdata .= '<div class="oxi-el-blocks-section-col">
                                <div class="oxi-el-blocks-section-image">
                                    <img src="' . $section['thumbnail'] . '" alt="' . $section['title'] . '">
                                    <div class="oxi-el-template-section-imagebody">
                                         <a href="#" data-url="' . $section['url'] . '" class="sael-btn sa-el-preview-button" sa-el-title="' . $section['title'] . ' Block">Preview</a>
                                    </div>
                                </div>
                                <div class="oxi-el-blocks-section-content">
                                    <div class="oxi-el-template-count">
                                        <h1 class="oxi-el-template-count-h1">' . $section['title'] . '</h1>
                                        <div class="oxi-el-template-count-data">Import this Design to make it available in your Elementor Saved into Templates list for future use.</div>
                                        <div class="oxi-el-blocks-section-success">Congrats! This was just imported to the WordPress library.</div>
                                        ' . $profile . '
                                      </div>
                                </div>
                            </div>';
                $i++;
            }
            return '  <div class="oxi-el-blocks-section">
                        <div class="oxi-el-template-back-menu">
                            <a href="' . admin_url('admin.php?page=sa-el-templates&type=presets') . '">Back to all Pre Design</a>
                        </div>
                        <div class="oxi-el-template-count-section">
                            <div class="oxi-el-template-count">
                                <h1 class="oxi-el-template-count-h1">' . $categories['category'][$satype]['title'] . '</h1>
                                <div class="oxi-el-template-count-data">' . $i++ . ' Blocks in this Pre Design category.</div>
                            </div>
                        </div>
                        
                        <div class="oxi-el-template-data">
                            ' . $tempdata . '
                        </div>
                    </div>';
        else:
            $temdata = '';
            $pg = 0;
            foreach ($categories['category'] as $cat) {
                if ($cat['category_parent'] == $categories['parent']['pre-design']) {
                    $temdata .= '<div class="oxi-el-blocks-data-col">
                                    <div class="oxi-el-blocks-data-content">
                                        <div class="oxi-el-template-data-content-data">
                                            <h3>' . $cat['title'] . '</h3>
                                            ' . $cat['template_count'] . ' Pre Design in this ' . $cat['title'] . '
                                            <a href="' . admin_url('admin.php?page=sa-el-templates&type=presets&section=' . $cat['slug']) . '"></a>
                                        </div>
                                    </div>
                                </div>';
                    $pg += $cat['template_count'];
                }
            }
            return '<div class="oxi-el-blocks-body" >
                    <div class="oxi-el-template-count">
                        <h1 class="oxi-el-template-count-h1">Elements Pre Design for Elementor</h1>
                        <div class="oxi-el-template-count-data">Browse over ' . $pg . ' Responsive Elements Pre Design.</div>
                    </div>
                    <div class="oxi-el-blocks-data">
                        ' . $temdata . '
                    </div>
                </div>';
        endif;
    }

    public function header_render($satype = '') {
        $templates = \SA_EL_ADDONS\Modules\Templates\Rest_API::get_instance()->TRANSIENT_TEMPLATE();
        $categories = \SA_EL_ADDONS\Modules\Templates\Rest_API::get_instance()->TEMPLATE_CATEGORY();
        if (!empty($satype)):
            $args = array('post_type' => 'elementor_library', 'posts_per_page' => -1,);
            $el_library = [0 => [], 1 => []];
            $query = new \WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $el_library[0][$query->post->post_name] = $query->post->post_name;
                    $el_library[1][$query->post->post_name] = $query->post->ID;
                }
            }
            $i = 0;
            $tempdata = '';
            foreach ($templates['templates'][$satype] as $section) {

                if (!apply_filters('sa-el-addons/check_version', '')) {
                    $profile = ' <a href="javascript:void(0)" data-url="#" class="sael-btn sa-el-blocks-pro-button">Upgrade Please</a>';
                } else if (array_key_exists($section['post_name'], $el_library[0])) {
                    $profile = '<a href="' . admin_url('post.php?post=' . $el_library[1][$section['post_name']] . '&action=elementor') . '" target="_blank" class="sael-btn el-edit-btn">Edit Block</a>';
                } else {
                    $profile = ' <a href="javascript:void(0)" data-url="#" class="sael-btn el-import-btn sa-el-import-start"  sael_required="" sael-id="' . $section['id'] . '"  sa-el-title="' . $section['title'] . ' Block">Import</a>';
                }
                $tempdata .= '<div class="oxi-el-blocks-section-col">
                                <div class="oxi-el-blocks-section-image">
                                    <img src="' . $section['thumbnail'] . '" alt="' . $section['title'] . '">
                                    <div class="oxi-el-template-section-imagebody">
                                         <a href="#" data-url="' . $section['url'] . '" class="sael-btn sa-el-preview-button" sa-el-title="' . $section['title'] . ' Block">Preview</a>
                                    </div>
                                </div>
                                <div class="oxi-el-blocks-section-content">
                                    <div class="oxi-el-template-count">
                                        <h1 class="oxi-el-template-count-h1">' . $section['title'] . '</h1>
                                        <div class="oxi-el-template-count-data">Import this Design to make it available in your Elementor Saved into Templates list for future use.</div>
                                        <div class="oxi-el-blocks-section-success">Congrats! This was just imported to the WordPress library.</div>
                                        ' . $profile . '
                                      </div>
                                </div>
                            </div>';
                $i++;
            }
            return '  <div class="oxi-el-blocks-section">
                        <div class="oxi-el-template-back-menu">
                            <a href="' . admin_url('admin.php?page=sa-el-templates&type=header') . '">Back to all Header Design</a>
                        </div>
                        <div class="oxi-el-template-count-section">
                            <div class="oxi-el-template-count">
                                <h1 class="oxi-el-template-count-h1">' . $categories['category'][$satype]['title'] . '</h1>
                                <div class="oxi-el-template-count-data">' . $i++ . ' Header in this Header category.</div>
                            </div>
                        </div>
                        
                        <div class="oxi-el-template-data">
                            ' . $tempdata . '
                        </div>
                    </div>';
        else:
            $temdata = '';
            $pg = 0;
            foreach ($categories['category'] as $cat) {
                if ($cat['category_parent'] == $categories['parent']['header']) {
                    $temdata .= '<div class="oxi-el-blocks-data-col">
                                    <div class="oxi-el-blocks-data-content">
                                        <div class="oxi-el-template-data-content-data">
                                            <h3>' . $cat['title'] . '</h3>
                                            ' . $cat['template_count'] . ' Header in this ' . $cat['title'] . '
                                            <a href="' . admin_url('admin.php?page=sa-el-templates&type=header&section=' . $cat['slug']) . '"></a>
                                        </div>
                                    </div>
                                </div>';
                    $pg += $cat['template_count'];
                }
            }
            return '<div class="oxi-el-blocks-body" >
                    <div class="oxi-el-template-count">
                        <h1 class="oxi-el-template-count-h1">Header for Elementor</h1>
                        <div class="oxi-el-template-count-data">Browse over ' . $pg . ' Section of Responsive Header.</div>
                    </div>
                    <div class="oxi-el-blocks-data">
                        ' . $temdata . '
                    </div>
                </div>';
        endif;
    }

    public function footer_render($satype = '') {
        $templates = \SA_EL_ADDONS\Modules\Templates\Rest_API::get_instance()->TRANSIENT_TEMPLATE();
        $categories = \SA_EL_ADDONS\Modules\Templates\Rest_API::get_instance()->TEMPLATE_CATEGORY();
        if (!empty($satype)):
            $args = array('post_type' => 'elementor_library', 'posts_per_page' => -1,);
            $el_library = [0 => [], 1 => []];
            $query = new \WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $el_library[0][$query->post->post_name] = $query->post->post_name;
                    $el_library[1][$query->post->post_name] = $query->post->ID;
                }
            }
            $i = 0;
            $tempdata = '';
            foreach ($templates['templates'][$satype] as $section) {
                if (!apply_filters('sa-el-addons/check_version', '')) {
                    $profile = ' <a href="javascript:void(0)" data-url="#" class="sael-btn sa-el-blocks-pro-button">Upgrade Please</a>';
                } else if (array_key_exists($section['post_name'], $el_library[0])) {
                    $profile = '<a href="' . admin_url('post.php?post=' . $el_library[1][$section['post_name']] . '&action=elementor') . '" target="_blank" class="sael-btn el-edit-btn">Edit Block</a>';
                } else {
                    $profile = ' <a href="javascript:void(0)" data-url="#" class="sael-btn el-import-btn sa-el-import-start"  sael_required="" sael-id="' . $section['id'] . '"  sa-el-title="' . $section['title'] . ' Block">Import</a>';
                }
                $tempdata .= '<div class="oxi-el-blocks-section-col">
                                <div class="oxi-el-blocks-section-image">
                                    <img src="' . $section['thumbnail'] . '" alt="' . $section['title'] . '">
                                    <div class="oxi-el-template-section-imagebody">
                                         <a href="#" data-url="' . $section['url'] . '" class="sael-btn sa-el-preview-button" sa-el-title="' . $section['title'] . ' Block">Preview</a>
                                    </div>
                                </div>
                                <div class="oxi-el-blocks-section-content">
                                    <div class="oxi-el-template-count">
                                        <h1 class="oxi-el-template-count-h1">' . $section['title'] . '</h1>
                                        <div class="oxi-el-template-count-data">Import this Design to make it available in your Elementor Saved into Templates list for future use.</div>
                                        <div class="oxi-el-blocks-section-success">Congrats! This was just imported to the WordPress library.</div>
                                        ' . $profile . '
                                      </div>
                                </div>
                            </div>';
                $i++;
            }
            return '  <div class="oxi-el-blocks-section">
                        <div class="oxi-el-template-back-menu">
                            <a href="' . admin_url('admin.php?page=sa-el-templates&type=footer') . '">Back to all Footer Design</a>
                        </div>
                        <div class="oxi-el-template-count-section">
                            <div class="oxi-el-template-count">
                                <h1 class="oxi-el-template-count-h1">' . $categories['category'][$satype]['title'] . '</h1>
                                <div class="oxi-el-template-count-data">' . $i++ . ' Footer in this Footer category.</div>
                            </div>
                        </div>
                        
                        <div class="oxi-el-template-data">
                            ' . $tempdata . '
                        </div>
                    </div>';
        else:
            $temdata = '';
            $pg = 0;
            foreach ($categories['category'] as $cat) {
                if ($cat['category_parent'] == $categories['parent']['footer']) {
                    $temdata .= '<div class="oxi-el-blocks-data-col">
                                    <div class="oxi-el-blocks-data-content">
                                        <div class="oxi-el-template-data-content-data">
                                            <h3>' . $cat['title'] . '</h3>
                                            ' . $cat['template_count'] . ' Footer in this ' . $cat['title'] . '
                                            <a href="' . admin_url('admin.php?page=sa-el-templates&type=footer&section=' . $cat['slug']) . '"></a>
                                        </div>
                                    </div>
                                </div>';
                    $pg += $cat['template_count'];
                }
            }
            return '<div class="oxi-el-blocks-body" >
                    <div class="oxi-el-template-count">
                        <h1 class="oxi-el-template-count-h1">Footer for Elementor</h1>
                        <div class="oxi-el-template-count-data">Browse over ' . $pg . ' Section of Responsive Footer.</div>
                    </div>
                    <div class="oxi-el-blocks-data">
                        ' . $temdata . '
                    </div>
                </div>';
        endif;
    }

}
