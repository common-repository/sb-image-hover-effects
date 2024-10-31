<?php

namespace SA_EL_ADDONS\Elements\Document_Viewer;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Widget_Base as Widget_Base;

// use \SA_EL_ADDONS\Classes\Bootstrap;

class Document_Viewer extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_document_viewer';
    }

    public function get_title() {
        return esc_html__('Document Viewer', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-typography  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    public function get_keywords() {
        return ['document', 'viewer', 'record', 'file'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
                'section_content_layout',
                [
                    'label' => esc_html__('Layout', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'file_source',
                [
                    'label' => esc_html__('File Source', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => esc_html__('any type of document file: pdf, xls, docx, ppt etc', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::URL,
                    'dynamic' => ['active' => true],
                    'placeholder' => esc_html__('https://example.com/sample.pdf', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_block' => true,
                    'show_external' => false,
                ]
        );

        $this->add_responsive_control(
                'document_height',
                [
                    'label' => esc_html__('Document Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 800,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 200,
                            'max' => 1500,
                            'step' => 50,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-document-viewer iframe' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();
    }

    public function render() {
        $settings = $this->get_settings_for_display();
        $final_url = ($settings['file_source']['url']) ? '//docs.google.com/viewer?embedded=true&amp;url=' . esc_url($settings['file_source']['url']) : false;
        ?>

        <?php if ($final_url) : ?>
            <div class="sa-el-document-viewer">
                <iframe src="<?php echo esc_url($final_url); ?>" class="sa-el-document"></iframe>
            </div>
        <?php else : ?>
            <div class="sa-el-alert-warning" sa-el-alert>
                <a class="sa-el-alert-close" sa-el-close></a>
                <p><?php esc_html_e('Please enter correct URL of your document.', SA_EL_ADDONS_TEXTDOMAIN); ?></p>
            </div>
        <?php endif; ?>

        <?php
    }

}
