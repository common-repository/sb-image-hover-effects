<?php

namespace SA_EL_ADDONS\Elements\EDD_Download_History;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class EDD_Download_History extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa-el-edd-download-history';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Easy Digital Download History', SA_EL_ADDONS_TEXTDOMAIN);
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-file-download oxi-el-admin-icon';
    }

    protected function _register_controls() {
        $this->start_controls_section(
                'section_content_table',
                [
                    'label' => __('Table', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        if (!class_exists('Easy_Digital_Downloads')) {
            $this->add_control(
                    'Easy_Digital_Downloads_missing_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => sprintf(
                                __('Hi, it seems %1$s is missing in your site. Please install and activate %1$s first.', SA_EL_ADDONS_TEXTDOMAIN),
                                '<a href="https://wordpress.org/plugins/easy-digital-downloads/" target="_blank" rel="noopener">Easy Digital Downloads</a>'
                        ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    ]
            );
            $this->end_controls_section();
            return;
        }

        $this->add_control(
                'header_align',
                [
                    'label' => __('Header Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history th' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'body_align',
                [
                    'label' => __('Body Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history td' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_table',
                [
                    'label' => __('Table', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'table_border_style',
                [
                    'label' => __('Border Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'solid',
                    'options' => [
                        'none' => __('None', SA_EL_ADDONS_TEXTDOMAIN),
                        'solid' => __('Solid', SA_EL_ADDONS_TEXTDOMAIN),
                        'double' => __('Double', SA_EL_ADDONS_TEXTDOMAIN),
                        'dotted' => __('Dotted', SA_EL_ADDONS_TEXTDOMAIN),
                        'dashed' => __('Dashed', SA_EL_ADDONS_TEXTDOMAIN),
                        'groove' => __('Groove', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history' => 'border-style: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'table_border_width',
                [
                    'label' => __('Border Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'min' => 0,
                        'max' => 20,
                        'size' => 1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history' => 'border-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'table_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ccc',
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_header',
                [
                    'label' => __('Header', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'header_background',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#dfe3e6',
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history th' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'header_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#333',
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history th' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'header_border_style',
                [
                    'label' => __('Border Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'solid',
                    'options' => [
                        'none' => __('None', SA_EL_ADDONS_TEXTDOMAIN),
                        'solid' => __('Solid', SA_EL_ADDONS_TEXTDOMAIN),
                        'double' => __('Double', SA_EL_ADDONS_TEXTDOMAIN),
                        'dotted' => __('Dotted', SA_EL_ADDONS_TEXTDOMAIN),
                        'dashed' => __('Dashed', SA_EL_ADDONS_TEXTDOMAIN),
                        'groove' => __('Groove', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history th' => 'border-style: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'header_border_width',
                [
                    'label' => __('Border Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'min' => 0,
                        'max' => 20,
                        'size' => 1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history th' => 'border-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'header_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ccc',
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history th' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'header_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'default' => [
                        'top' => 1,
                        'bottom' => 1,
                        'left' => 1,
                        'right' => 1,
                        'unit' => 'em'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();
        $this->start_controls_section(
                'section_style_body',
                [
                    'label' => __('Body', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'cell_border_style',
                [
                    'label' => __('Border Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'solid',
                    'options' => [
                        'none' => __('None', SA_EL_ADDONS_TEXTDOMAIN),
                        'solid' => __('Solid', SA_EL_ADDONS_TEXTDOMAIN),
                        'double' => __('Double', SA_EL_ADDONS_TEXTDOMAIN),
                        'dotted' => __('Dotted', SA_EL_ADDONS_TEXTDOMAIN),
                        'dashed' => __('Dashed', SA_EL_ADDONS_TEXTDOMAIN),
                        'groove' => __('Groove', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history td' => 'border-style: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'cell_border_width',
                [
                    'label' => __('Border Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'min' => 0,
                        'max' => 20,
                        'size' => 1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history td' => 'border-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'cell_padding',
                [
                    'label' => __('Cell Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'default' => [
                        'top' => 0.5,
                        'bottom' => 0.5,
                        'left' => 1,
                        'right' => 1,
                        'unit' => 'em'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'after',
                ]
        );

        $this->start_controls_tabs('tabs_body_style');

        $this->start_controls_tab(
                'tab_normal',
                [
                    'label' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'normal_background',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history tr:nth-child(odd) td' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'normal_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history tr:nth-child(odd) td' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'normal_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ccc',
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history tr:nth-child(odd) td' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_stripe',
                [
                    'label' => __('Stripe', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'stripe_background',
                [
                    'label' => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#f7f7f7',
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history tr:nth-child(even) td' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'stripe_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history tr:nth-child(even) td' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'stripe_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ccc',
                    'selectors' => [
                        '{{WRAPPER}} #edd_user_history tr:nth-child(even) td' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        if (!class_exists('Easy_Digital_Downloads')) :
            ?>
            <div class="sa-el-alert-warning" >
                <div><?php printf(__('Please install <a target="_blank" href="https://wordpress.org/plugins/easy-digital-downloads/">Easy Digital Downloads Plugin</a> to show your work correctly.', SA_EL_ADDONS_TEXTDOMAIN)); ?></div>
            </div>
            <?php
        else :
            echo do_shortcode('[download_history]');
        endif;
    }

}
