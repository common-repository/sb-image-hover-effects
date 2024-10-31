<?php

namespace SA_EL_ADDONS\Elements\Download_Monitor;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class Download_Monitor extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_download_monitor';
    }

    public function get_title() {
        return esc_html__('Download Monitor', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-file-download  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    public function get_keywords() {
        return ['download', 'monitor'];
    }

    protected function sa_el_download_file_list() {
        $output = [];
        $search_query = (!empty($_POST['dlm_search']) ? $_POST['dlm_search'] : '' );
        $limit = 10;
        $page = isset($_GET['paged']) ? absint($_GET['paged']) : 1;
        $filters = array('post_status' => 'publish');
        if (!empty($search_query)) {
            $filters['s'] = $search_query;
        }
        $d_num_rows = download_monitor()->service('download_repository')->num_rows($filters);
        $downloads = download_monitor()->service('download_repository')->retrieve($filters, $limit, ( ( $page - 1 ) * $limit));
        foreach ($downloads as $download) {
            $output[absint($download->get_id())] = $download->get_title() . ' (' . $download->get_version()->get_filename() . ')';
        }

        return $output;
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'section_content_download_monitor',
                [
                    'label' => esc_html__('Content', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        if (!is_plugin_active('download-monitor/download-monitor.php')) {
            $this->add_control(
                    'download_monitor_missing_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => sprintf(
                                __('Hi, it seems %1$s is missing in your site. Please install and activate %1$s first.', SA_EL_ADDONS_TEXTDOMAIN),
                                '<a href="https://wordpress.org/plugins/download-monitor/" target="_blank" rel="noopener">Download Monitor</a>'
                        ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    ]
            );
            $this->end_controls_section();
            return;
        }


        $this->add_control(
                'file_id',
                [
                    'label' => esc_html__('Select File', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => $this->sa_el_download_file_list(),
                ]
        );


        $this->add_control(
                'file_type_show',
                [
                    'label' => esc_html__('Show File Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'condition' => [
                        'file_id!' => '',
                    ],
                ]
        );

        $this->add_control(
                'file_size_show',
                [
                    'label' => esc_html__('Show File Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'condition' => [
                        'file_id!' => '',
                    ],
                ]
        );

        $this->add_control(
                'download_count_show',
                [
                    'label' => esc_html__('Show Download Count', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'condition' => [
                        'file_id!' => '',
                    ],
                ]
        );



        $this->end_controls_section();


        $this->start_controls_section(
                'section_content_button',
                [
                    'label' => esc_html__('Button', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'alt_title',
                [
                    'label' => esc_html__('Alternative Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                ]
        );

        $this->add_control(
                'link',
                [
                    'label' => __('Link', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'current-tab' => __('Current Tab', SA_EL_ADDONS_TEXTDOMAIN),
                        'new-tab' => __('New Tab', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'current-tab',
                ]
        );


        $this->add_responsive_control(
                'align',
                [
                    'label' => esc_html__('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'prefix_class' => 'elementor-align%s-',
                ]
        );

        $this->add_control(
                'icon',
                [
                    'label' => esc_html__('Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => '',
                ]
        );

        $this->add_control(
                'icon_align',
                [
                    'label' => esc_html__('Icon Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'right',
                    'options' => [
                        'left' => esc_html__('Before', SA_EL_ADDONS_TEXTDOMAIN),
                        'right' => esc_html__('After', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'condition' => [
                        'icon!' => '',
                    ],
                ]
        );

        $this->add_control(
                'icon_indent',
                [
                    'label' => esc_html__('Icon Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 8,
                    ],
                    'range' => [
                        'px' => [
                            'max' => 50,
                        ],
                    ],
                    'condition' => [
                        'icon!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-download-monitor-button .sa-el-button-icon-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .sa-el-download-monitor-button .sa-el-button-icon-align-left' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();


        $this->start_controls_section(
                'section_style_button',
                [
                    'label' => esc_html__('Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'heading_footer_button',
                [
                    'label' => esc_html__('Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
                'tab_button_normal',
                [
                    'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'button_text_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} a.sa-el-download-monitor-button' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'button_background_color',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} a.sa-el-download-monitor-button',
                    'separator' => 'after',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow',
                    'selector' => '{{WRAPPER}} a.sa-el-download-monitor-button',
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(), [
            'name' => 'button_border',
            'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
            'placeholder' => '1px',
            'default' => '1px',
            'selector' => '{{WRAPPER}} a.sa-el-download-monitor-button',
            'separator' => 'before',
                ]
        );

        $this->add_control(
                'button_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} a.sa-el-download-monitor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'button_text_padding',
                [
                    'label' => esc_html__('Text Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} a.sa-el-download-monitor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'label' => esc_html__('Title Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} a.sa-el-download-monitor-button .sa-el-dm-title',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_meta_typography',
                    'label' => esc_html__('Meta Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} a.sa-el-download-monitor-button .sa-el-dm-meta > *',
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_button_hover',
                [
                    'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'button_hover_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a.sa-el-download-monitor-button:hover' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'button_background_hover_color',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} a.sa-el-download-monitor-button:hover',
                    'separator' => 'after',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_hover_box_shadow',
                    'selector' => '{{WRAPPER}} a.sa-el-download-monitor-button:hover',
                ]
        );

        $this->add_control(
                'button_hover_border_color',
                [
                    'label' => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a.sa-el-download-monitor-button:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'button_hover_animation',
                [
                    'label' => esc_html__('Animation', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HOVER_ANIMATION,
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    public function render() {

        if (is_plugin_active('download-monitor/download-monitor.php')) {

            $settings = $this->get_settings();

            try {
                $download = download_monitor()->service('download_repository')->retrieve_single($settings['file_id']);
            } catch (\Exception $exception) {
                $exception->getMessage();
                return;
            }

            if (isset($download)) {

                $this->add_render_attribute(
                        [
                            'download-monitor-button' => [
                                'class' => [
                                    'sa-el-download-monitor-button',
                                    'elementor-button',
                                    'elementor-size-sm',
                                    $settings['button_hover_animation'] ? 'elementor-animation-' . $settings['button_hover_animation'] : ''
                                ],
                                'href' => [
                                    $download->get_the_download_link()
                                ],
                                'target' => [
                                    $settings['link'] == 'new-tab' ? "_blank" : "_self"
                                ]
                            ]
                        ]
                );
                ?>
                <a <?php echo $this->get_render_attribute_string('download-monitor-button'); ?>>

                    <div class="sa-el-dm-description">
                        <div class="sa-el-dm-title">
                            <?php
                            if ($settings['alt_title']) {
                                echo esc_html($settings['alt_title']);
                            } else {
                                echo esc_html($download->get_title());
                            }
                            ?>
                        </div>

                        <div class="sa-el-dm-meta">
                            <?php if ('yes' === $settings['file_type_show']) : ?>
                                <div class="sa-el-dm-file">
                                    <?php echo esc_html($download->get_version()->get_filetype()); ?>

                                </div>
                            <?php endif; ?>

                            <?php if ('yes' === $settings['file_size_show']) : ?>
                                <div class="sa-el-dm-size">
                                    <?php echo esc_html($download->get_version()->get_filesize_formatted()); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ('yes' === $settings['download_count_show']) : ?>
                                <div class="sa-el-dm-count">
                                    <?php esc_html_e('Downloaded', SA_EL_ADDONS_TEXTDOMAIN); ?> <?php echo esc_html($download->get_download_count()); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ($settings['icon']) : ?>
                        <span class="sa-el-button-icon-align-<?php echo esc_html($settings['icon_align']); ?>">
                            <i class="<?php echo esc_html($settings['icon']); ?>"></i>
                        </span>
                    <?php endif; ?>

                </a>
                <?php
            }
        } else {
            ?>
            <div class="sa-el-alert-warning" >
                <div><?php printf(__('Please install and active <a target="_blank" href="https://wordpress.org/plugins/download-monitor/">Download Monitor</a> Plugin to show your slider correctly.', SA_EL_ADDONS_TEXTDOMAIN)); ?></div>
            </div>
            <?php
        }
    }

}
