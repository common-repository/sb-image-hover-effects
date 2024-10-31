<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <?php if (!current_theme_supports('title-tag')) : ?>
            <title>
                <?php echo wp_get_document_title(); ?>
            </title>
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <?php do_action('ElementorAddons/template/before_header'); ?>
        <div class="elementor-addons-template-content-markup elementor-addons-template-content-header elementor-addons-template-content-theme-support">
            <?php
            $CLASS = \SA_EL_ADDONS\Modules\Header_Footer\Header_Footer::instance();
            $template = $CLASS->template_ids();
            echo $CLASS->elementor_content($template[0]);
            ?>
        </div>
        <?php do_action('ElementorAddons/template/after_header'); ?>
