<?php

namespace SA_EL_ADDONS\Modules\Header_Footer\Theme;

defined('ABSPATH') || exit;

class TwentyNineteen {

    function __construct($template_ids) {
        if ($template_ids[0] != null) {
            add_action('get_header', [$this, 'get_header']);
        }
        if ($template_ids[1] != null) {
            add_action('get_footer', [$this, 'get_footer']);
        }
    }

    public function get_header($name) {
        add_action('ElementorAddons/template/after_header', function() {
            echo '<div id="page" class="site">';
            echo '<div id="content" class="site-content">';
        });
        require __DIR__ . '/../inc/theme-header.php';

        $templates = [];
        $name = (string) $name;
        if ('' !== $name) {
            $templates[] = "header-{$name}.php";
        }
        $templates[] = 'header.php';
        remove_all_actions('wp_head');
        ob_start();
        locate_template($templates, true);
        ob_get_clean();
    }

    public function get_footer($name) {
        add_action('ElementorAddons/template/after_footer', function() {
            echo '</div></div>';
        });

        require __DIR__ . '/../inc/theme-footer.php';

        $templates = [];
        $name = (string) $name;
        if ('' !== $name) {
            $templates[] = "footer-{$name}.php";
        }
        $templates[] = 'footer.php';

        ob_start();
        locate_template($templates, true);
        ob_get_clean();
    }

}
