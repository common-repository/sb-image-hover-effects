<div class="modal fade" id="addons_headerfooter_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  modal-sm modal-dialog-centered" role="document">
        <form action="" mathod="get" id="addons_modalinput-form" data-open-editor="0" data-editor-url="<?php echo get_admin_url(); ?>">
            <div class="modal-content">
                <div class="modal-header">
                     <h4 class="modal-title"><?php esc_html_e('Template Settings', SA_EL_ADDONS_TEXTDOMAIN); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="shortcode-form-control shortcode-control-type-text    ">
                        <div class="shortcode-form-control-content">
                            <div class="shortcode-form-control-field">
                                <label for="" class="shortcode-form-control-title"><?php esc_html_e('Title:', SA_EL_ADDONS_TEXTDOMAIN); ?></label>
                                <div class="shortcode-form-control-input-wrapper">
                                    <input type="text" name="title" class="addons-modalinput-title" placeholder="Give Your Title">
                                </div>    
                            </div>
                        </div>
                    </div>
                    <div class="shortcode-form-control shortcode-control-type-text">
                        <div class="shortcode-form-control-content">
                            <div class="shortcode-form-control-field">
                                <label for="" class="shortcode-form-control-title"><?php esc_html_e('Type:', 'elementskit'); ?></label>
                                <div class="shortcode-form-control-input-wrapper">
                                    <div class="shortcode-form-control-input-select-wrapper">
                                        <select name="type" class="shortcode-addons-select-input addons_condition_type">
                                            <option value="header"><?php esc_html_e('Header', SA_EL_ADDONS_TEXTDOMAIN); ?></option>
                                            <option value="footer"><?php esc_html_e('Footer', SA_EL_ADDONS_TEXTDOMAIN); ?></option>
                                        </select>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                    <div class="shortcode-form-control shortcode-control-type-text">
                        <div class="shortcode-form-control-content">
                            <div class="shortcode-form-control-field">
                                <label for="" class="shortcode-form-control-title"><?php esc_html_e('Conditions:', 'elementskit'); ?></label>
                                <div class="shortcode-form-control-input-wrapper">
                                    <div class="shortcode-form-control-input-select-wrapper">
                                        <select name="condition_a" class="addons_condition_a shortcode-addons-select-input ">
                                            <option value="entire_site"><?php esc_html_e('Entire Site', SA_EL_ADDONS_TEXTDOMAIN); ?></option>
                                            <option value="singular"><?php esc_html_e('Singular', SA_EL_ADDONS_TEXTDOMAIN); ?></option>
                                            <option value="archive"><?php esc_html_e('Archive ', SA_EL_ADDONS_TEXTDOMAIN); ?></option>
                                        </select>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                    <div class="shortcode-form-control shortcode-control-type-text addons_condition_singular-container">
                        <div class="shortcode-form-control-content">
                            <div class="shortcode-form-control-field">
                                <label for="" class="shortcode-form-control-title"><?php esc_html_e('Page Type:', 'elementskit'); ?></label>
                                <div class="shortcode-form-control-input-wrapper">
                                    <div class="shortcode-form-control-input-select-wrapper">
                                        <select name="condition_singular" class="shortcode-addons-select-input addons_condition_singular ">
                                            <option value="all"><?php esc_html_e('All Singulars', SA_EL_ADDONS_TEXTDOMAIN); ?></option>
                                            <option value="front_page"><?php esc_html_e('Front Page', SA_EL_ADDONS_TEXTDOMAIN); ?></option>
                                            <option value="all_posts"><?php esc_html_e('All Posts', SA_EL_ADDONS_TEXTDOMAIN); ?></option>
                                            <option value="all_pages"><?php esc_html_e('All Pages', SA_EL_ADDONS_TEXTDOMAIN); ?></option>
                                            <option value="selected"><?php esc_html_e('Selected Singular', SA_EL_ADDONS_TEXTDOMAIN); ?> </option>
                                            <option value="errorpage"><?php esc_html_e('404 Page', SA_EL_ADDONS_TEXTDOMAIN); ?></option>
                                        </select>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                    <div class="shortcode-form-control shortcode-control-type-text addons_condition_singular_id-container">
                        <div class="shortcode-form-control-content">
                            <div class="shortcode-form-control-field">
                                <label for="" class="shortcode-form-control-title"><?php esc_html_e('Single Page:', 'elementskit'); ?></label>
                                <div class="shortcode-form-control-input-wrapper">
                                    <div class="shortcode-form-control-input-select-wrapper">
                                        <select multiple name="condition_singular_id[]" class="addons_condition_singular_id"></select>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                    <div class="shortcode-form-control shortcode-control-type-switcher     shortcode-addons-control-loader">
                        <div class="shortcode-form-control-content">
                            <div class="shortcode-form-control-field">
                                <label for="" class="shortcode-form-control-title"><?php esc_html_e('Activition:', SA_EL_ADDONS_TEXTDOMAIN); ?></label>
                                <div class="shortcode-form-control-input-wrapper">
                                    <label class="shortcode-switcher">  
                                        <input type="checkbox" value="yes" name="activation" class="addons-modalinput-activition">
                                        <span data-on="Yes" data-off="No"></span>
                                    </label>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="post_author" value ="<?php echo get_current_user_id(); ?>">
                    <button type="button" class="btn btn-info addons-save-btn-editor"><?php esc_html_e('Edit Template', SA_EL_ADDONS_TEXTDOMAIN); ?></button>
                    <button type="submit" class="btn btn-success addons-save-btn"><?php esc_html_e('Save changes', SA_EL_ADDONS_TEXTDOMAIN); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>