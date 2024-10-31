<?php

namespace SA_EL_ADDONS\Elements\Alert_Box;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Alert_Box
 *
 * @author biplo
 * 
 */
use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Responsive\Responsive;

class Alert_Box extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_alert_box';
    }

    public function get_title() {
        return esc_html__('Alert Box', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return ' eicon-alert  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    public function is_reload_preview_required() {
        return true;
    }

    // Adding the controls fields for the premium notification bar
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {

        /* Start Bar Settings Section */
        $this->start_controls_section('sa_el_notbar_general_section',
                [
                    'label' => __('Box', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        /* Bar Position */
        $this->add_control('sa_el_notbar_position',
                [
                    'label' => __('Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'top' => [
                            'title' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'bottom' => [
                            'title' => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                        'middle' => [
                            'title' => __('Middle', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-stretch',
                        ],
                        'float' => [
                            'title' => __('Custom', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-justify',
                        ],
                    ],
                    'default' => 'float',
                    'toggle' => false,
                ]
        );

        $this->add_responsive_control('sa_el_notbar_float_pos',
                [
                    'label' => __('Vertical Offset (%)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 10,
                        'unit' => '%'
                    ],
                    'condition' => [
                        'sa_el_notbar_position' => 'float',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-notbar' => 'top: {{SIZE}}%;'
                    ]
                ]
        );

        $this->add_control('sa_el_notbar_top_select',
                [
                    'label' => __('Layout', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'fixed' => __('Fixed', SA_EL_ADDONS_TEXTDOMAIN),
                        'relative' => __('Relative', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'relative',
                    'condition' => [
                        'sa_el_notbar_position' => 'top',
                    ],
                    'label_block' => true,
                ]
        );

        $this->add_control('sa_el_notbar_width',
                [
                    'label' => __('Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'wide' => __('Full Width', SA_EL_ADDONS_TEXTDOMAIN),
                        'boxed' => __('Boxed', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'boxed',
                    'label_block' => true,
                ]
        );

        $this->add_control('sa_el_notbar_direction',
                [
                    'label' => __('Direction', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'row' => [
                            'title' => __('LTR', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-arrow-circle-right',
                        ],
                        'row-reverse' => [
                            'title' => __('RTL', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-arrow-circle-left',
                        ],
                    ],
                    'default' => 'row',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-notbar-text-container, {{WRAPPER}} .sa-el-notbar-icon-text-container' => '-webkit-flex-direction: {{VALUE}}; flex-direction: {{VALUE}};'
                    ],
                    'condition' => [
                        'sa_el_notbar_content_type' => 'editor',
                    ],
                    'toggle' => false
                ]
        );

        $this->add_control('sa_el_notbar_close_heading',
                [
                    'label' => __('Close Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_control('sa_el_notbar_close_hor_position',
                [
                    'label' => __('Horizontal Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'row' => __('After', SA_EL_ADDONS_TEXTDOMAIN),
                        'row-reverse' => __('Before', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-notbar-text-container' => '-webkit-flex-direction: {{VALUE}}; flex-direction: {{VALUE}};'
                    ],
                    'default' => 'row',
                    'label_block' => true,
                ]
        );

        $this->add_control('sa_el_notbar_close_ver_position',
                [
                    'label' => __('Vertical Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'flex-start' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                        'center' => __('Middle', SA_EL_ADDONS_TEXTDOMAIN),
                        'flex-end' => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-notbar-text-container' => 'align-items: {{VALUE}};'
                    ],
                    'default' => 'center',
                    'label_block' => true,
                    'separator' => 'after'
                ]
        );

        $this->add_control('sa_el_notbar_index',
                [
                    'label' => __('Z-index', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Set a z-index for the notification bar, default is: 9999', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 9999,
                    'selectors' => [
                        '#sa-el-notbar-{{ID}}' => 'z-index: {{VALUE}};'
                    ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_notbar_content',
                [
                    'label' => __('Content', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('sa_el_notbar_content_type',
                [
                    'label' => __('Content to Show', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'editor' => __('Text Editor', SA_EL_ADDONS_TEXTDOMAIN),
                        'template' => __('Elementor Template', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'editor',
                    'label_block' => true
                ]
        );

        $this->add_control('sa_el_notbar_content_temp',
                [
                    'label' => __('Content', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Elementor Template is a template which you can choose from Elementor Templates library', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT2,
                    'options' => $this->sa_el_get_all_post(),
                    'condition' => [
                        'sa_el_notbar_content_type' => 'template',
                    ],
                ]
        );

        $this->add_responsive_control('sa_el_notbar_temp_width',
                [
                    'label' => __('Content Width (%)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'condition' => [
                        'sa_el_notbar_content_type' => 'template',
                    ],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-text-container' => 'width: {{SIZE}}%;'
                    ]
                ]
        );

        $this->add_control('sa_el_notbar_icon_switcher',
                [
                    'label' => __('Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'condition' => [
                        'sa_el_notbar_content_type' => 'editor',
                    ],
                ]
        );

        $this->add_control('sa_el_notbar_icon_selector',
                [
                    'label' => __('Icon Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'font-awesome-icon',
                    'options' => [
                        'font-awesome-icon' => __('Font Awesome Icon', SA_EL_ADDONS_TEXTDOMAIN),
                        'custom-image' => __('Custom Image', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'condition' => [
                        'sa_el_notbar_content_type' => 'editor',
                        'sa_el_notbar_icon_switcher' => 'yes',
                    ]
                ]
        );

        $this->add_control('sa_el_notbar_icon_updated',
                [
                    'label' => __('Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'sa_el_notbar_icon',
                    'default' => [
                        'value' => 'fas fa-exclamation-circle',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'sa_el_notbar_icon_switcher' => 'yes',
                        'sa_el_notbar_content_type' => 'editor',
                        'sa_el_notbar_icon_selector' => 'font-awesome-icon'
                    ]
                ]
        );

        $this->add_control('sa_el_notbar_custom_image',
                [
                    'label' => __('Custom Image', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => ['active' => true],
                    'default' => [
                        'url' => Utils::get_placeholder_image_src()
                    ],
                    'condition' => [
                        'sa_el_notbar_icon_switcher' => 'yes',
                        'sa_el_notbar_content_type' => 'editor',
                        'sa_el_notbar_icon_selector' => 'custom-image'
                    ]
                ]
        );

        $this->add_control('sa_el_notbar_text',
                [
                    'type' => Controls_Manager::WYSIWYG,
                    'dynamic' => ['active' => true],
                    'default' => 'Your alert title comes here!',
                    'condition' => [
                        'sa_el_notbar_content_type' => 'editor',
                    ],
                    'show_label' => false,
                ]
        );

        $this->add_control('sa_el_notbar_close_text',
                [
                    'label' => __('Close Button Text', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => ['active' => true],
                    'default' => 'x',
                ]
        );

        $this->add_responsive_control('sa_el_notbar_text_align',
                [
                    'label' => __('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
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
                    'condition' => [
                        'sa_el_notbar_content_type' => 'editor',
                    ],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-icon-text-container' => 'justify-content: {{VALUE}}; text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_notbar_advanced',
                [
                    'label' => __('Advanced Settings', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('sa_el_notbar_cookies',
                [
                    'label' => __('Use Cookies', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('This option will use cookies to remember user action', SA_EL_ADDONS_TEXTDOMAIN)
        ]);

        $this->add_control('sa_el_notbar_interval',
                [
                    'label' => __('Expiration Time', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 1,
                    'min' => 0,
                    'title' => __('How much time before removing cookie, set the value in hours, default is: 1 hour', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_notbar_cookies' => 'yes'
                    ]
                ]
        );

        $this->add_control('sa_el_notbar_responsive_switcher',
                [
                    'label' => __('Responsive Controls', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('This options will hide the notification bar below a specific screen size', SA_EL_ADDONS_TEXTDOMAIN)
        ]);

        $this->add_responsive_control('sa_el_notbar_height',
                [
                    'label' => __('Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em', 'vh'],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-icon-text-container' => 'height: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_responsive_control('sa_el_notbar_overflow',
                [
                    'label' => __('Overflow', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'visible' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                        'scroll' => __('Scroll', SA_EL_ADDONS_TEXTDOMAIN),
                        'auto' => __('Auto', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'label_block' => true,
                    'default' => 'auto',
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-icon-text-container' => 'overflow-y: {{VALUE}};'
                    ]
                ]
        );

        $this->add_control('sa_el_notbar_hide_tabs',
                [
                    'label' => __('Hide on Tablets', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('Hide Notification Bar below Elementor\'s Tablet Breakpoint ', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_notbar_responsive_switcher' => 'yes'
                    ],
        ]);

        $this->add_control('sa_el_notbar_hide_mobs',
                [
                    'label' => __('Hide on Mobiles', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('Hide Notification Bar below Elementor\'s Mobile Breakpoint ', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_notbar_responsive_switcher' => 'yes'
                    ],
        ]);

        $this->end_controls_section();

        $this->Sa_El_Support();

        $this->start_controls_section('sa_el_notbar_style',
                [
                    'label' => __('Box', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('sa_el_notbar_background',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}}' => 'background-color: {{VALUE}};'
                    ]
        ]);

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_notbar_border',
                    'selector' => '#sa-el-notbar-{{ID}}',
                ]
        );

        $this->add_control('sa_el_notbar_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}}' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'sa_el_notbar_shadow',
                    'selector' => '#sa-el-notbar-{{ID}}',
                ]
        );

        $this->add_responsive_control('sa_el_notbar_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ]
                ]
        );

        $this->add_responsive_control('sa_el_notbar_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ]
                ]
        );


        $this->end_controls_section();

        $this->start_controls_section('sa_el_notbar_icon_style',
                [
                    'label' => __('Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'sa_el_notbar_icon_switcher' => 'yes',
                        'sa_el_notbar_content_type' => 'editor',
                    ]
        ]);

        $this->add_control('sa_el_notbar_icon_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'condition' => [
                        'sa_el_notbar_icon_switcher' => 'yes',
                        'sa_el_notbar_content_type' => 'editor',
                        'sa_el_notbar_icon_selector' => 'font-awesome-icon'
                    ],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-icon' => 'color: {{VALUE}};'
                    ]
        ]);

        $this->add_control('sa_el_notbar_icon_hover_color',
                [
                    'label' => __('Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'condition' => [
                        'sa_el_notbar_icon_switcher' => 'yes',
                        'sa_el_notbar_content_type' => 'editor',
                        'sa_el_notbar_icon_selector' => 'font-awesome-icon'
                    ],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}}:hover .sa-el-notbar-icon' => 'color: {{VALUE}};'
                    ]
        ]);

        $this->add_responsive_control('sa_el_notbar_icon_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em'],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-icon' => 'font-size: {{SIZE}}px;',
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-custom-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_control('sa_el_notbar_icon_backcolor',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-icon, #sa-el-notbar-{{ID}} .sa-el-notbar-custom-image' => 'background-color: {{VALUE}};'
                    ]
        ]);

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_notbar_icon_border',
                    'selector' => '#sa-el-notbar-{{ID}} .sa-el-notbar-icon,#sa-el-notbar-{{ID}} .sa-el-notbar-custom-image'
                ]
        );

        $this->add_control('sa_el_notbar_icon_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-icon, #sa-el-notbar-{{ID}} .sa-el-notbar-custom-image' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'label' => __('Shadow', SA_EL_ADDONS_TEXTDOMAIN),
                    'name' => 'sa_el_notbar_icon_shadow',
                    'selector' => '#sa-el-notbar-{{ID}} .sa-el-notbar-icon',
                    'condition' => [
                        'sa_el_notbar_icon_switcher' => 'yes',
                        'sa_el_notbar_content_type' => 'editor',
                        'sa_el_notbar_icon_selector' => 'font-awesome-icon'
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'sa_el_notbar_img_shadow',
                    'selector' => '#sa-el-notbar-{{ID}} .sa-el-notbar-custom-image',
                    'condition' => [
                        'sa_el_notbar_icon_switcher' => 'yes',
                        'sa_el_notbar_content_type' => 'editor',
                        'sa_el_notbar_icon_selector' => 'custom-image'
                    ],
                ]
        );

        $this->add_responsive_control('sa_el_notbar_icon_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-icon , #sa-el-notbar-{{ID}} .sa-el-notbar-custom-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ]
                ]
        );

        $this->add_responsive_control('sa_el_notbar_icon_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-icon , #sa-el-notbar-{{ID}} .sa-el-notbar-custom-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_notbar_text_style',
                [
                    'label' => __('Text', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'sa_el_notbar_content_type' => 'editor'
                    ]
        ]);

        $this->add_control('sa_el_notbar_text_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-text' => 'color: {{VALUE}};'
                    ]
        ]);

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sa_el_notbar_text_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '#sa-el-notbar-{{ID}} .sa-el-notbar-text',
        ]);

        $this->add_control('sa_el_notbar_text_backcolor',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-text-container .sa-el-notbar-text' => 'background-color: {{VALUE}};'
                    ]
        ]);

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_notbar_text_border',
                    'selector' => '#sa-el-notbar-{{ID}} .sa-el-notbar-text-container .sa-el-notbar-text',
                ]
        );

        $this->add_control('sa_el_notbar_text_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-text-container .sa-el-notbar-text' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'label' => __('Shadow', SA_EL_ADDONS_TEXTDOMAIN),
                    'name' => 'sa_el_notbar_text_shadow',
                    'selector' => '#sa-el-notbar-{{ID}} .sa-el-notbar-text .sa-el-notbar-text',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'sa_el_notbar_text_box_shadow',
                    'selector' => '#sa-el-notbar-{{ID}} .sa-el-notbar-text-container .sa-el-notbar-text',
                ]
        );

        $this->add_responsive_control('sa_el_notbar_text_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-text-container .sa-el-notbar-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ]
                ]
        );

        $this->add_responsive_control('sa_el_notbar_text_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-text-container .sa-el-notbar-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_notbar_close_style',
                [
                    'label' => __('Close', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('sa_el_notbar_close_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-close' => 'color: {{VALUE}};'
                    ]
        ]);

        $this->add_control('sa_el_notbar_close_hover_color',
                [
                    'label' => __('Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-close:hover' => 'color: {{VALUE}};'
                    ]
        ]);

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sa_el_notbar_close_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '#sa-el-notbar-{{ID}} .sa-el-notbar-close',
        ]);

        $this->add_control('sa_el_notbar_close_backcolor',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-close' => 'background-color: {{VALUE}};'
                    ]
        ]);

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_notbar_close_border',
                    'selector' => '#sa-el-notbar-{{ID}} .sa-el-notbar-close',
                ]
        );

        $this->add_control('sa_el_notbar_close_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-close' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'label' => __('Shadow', SA_EL_ADDONS_TEXTDOMAIN),
                    'name' => 'sa_el_notbar_close_shadow',
                    'selector' => '#sa-el-notbar-{{ID}} .sa-el-notbar-close',
                ]
        );

        $this->add_responsive_control('sa_el_notbar_close_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-close' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ]
                ]
        );

        $this->add_responsive_control('sa_el_notbar_close_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '#sa-el-notbar-{{ID}} .sa-el-notbar-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ]
                ]
        );

        $this->end_controls_section();
    }

    /**
     * returns the responsive style based on Elementor's Breakpoints
     * @access protected
     * @return string
     */
    protected function get_notbar_responsive_style() {

        $breakpoints = Responsive::get_breakpoints();
        $style = '<style>';
        $style .= '@media ( max-width: ' . $breakpoints['md'] . 'px ) {';
        $style .= '.sa-el-notbar-text-container, .sa-el-notbar-icon-text-container {';
        $style .= 'flex-direction: column !important; -moz-flex-direction: column !important; -webkit-flex-direction: column !important;';
        $style .= '}';
        $style .= '}';
        $style .= '</style>';

        return $style;
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $id = $this->get_id();

        $image_custom = $settings['sa_el_notbar_custom_image']['url'];

        $bar_position = $settings['sa_el_notbar_position'];

        $bar_layout = 'sa-el-notbar-' . $settings['sa_el_notbar_top_select'];

        $bar_width = $settings['sa_el_notbar_width'];

        $template = $settings['sa_el_notbar_content_temp'];

        $this->add_render_attribute('sa_el_notbar_text', 'class', 'sa-el-notbar-text');

        $not_settings = [
            'layout' => $bar_width,
            'location' => $bar_position,
            'position' => $bar_layout,
            'varPos' => !empty($settings['sa_el_notbar_float_pos']) ? $settings['sa_el_notbar_float_pos'] : '10%',
            'responsive' => ( $settings['sa_el_notbar_responsive_switcher'] == 'yes' ) ? true : false,
            'hideTabs' => ( $settings['sa_el_notbar_hide_tabs'] == 'yes' ) ? true : false,
            'tabSize' => ( $settings['sa_el_notbar_hide_tabs'] == 'yes' ) ? Responsive::get_breakpoints()['lg'] : Responsive::get_breakpoints()['lg'],
            'hideMobs' => ( $settings['sa_el_notbar_hide_mobs'] == 'yes' ) ? true : false,
            'mobSize' => ( $settings['sa_el_notbar_hide_mobs'] == 'yes' ) ? Responsive::get_breakpoints()['md'] : Responsive::get_breakpoints()['md'],
            'cookies' => ( $settings['sa_el_notbar_cookies'] == 'yes' ) ? true : false,
            'interval' => !empty($settings['sa_el_notbar_interval']) ? $settings['sa_el_notbar_interval'] : 1,
            'id' => $id
        ];

        $this->add_render_attribute('alert', 'id', 'sa-el-notbar-outer-container-' . $id);

        $this->add_render_attribute('alert', 'class', ['sa-el-notbar-outer-container', 'sa-el-notbar-' . $settings['sa_el_notbar_content_type']]);

        $this->add_render_attribute('alert', 'data-settings', wp_json_encode($not_settings));

        $this->add_render_attribute('wrap', 'id', 'sa-el-notbar-' . $id);

        $this->add_render_attribute('wrap', 'class', ['sa-el-notbar', 'sa-el-notbar-' . $bar_width]);

        if ($bar_position != 'top') {
            $this->add_render_attribute('wrap', 'class', 'sa-el-notbar-' . $bar_position);
            $this->add_render_attribute('button', 'class', 'sa-el-notbar-' . $bar_position);
        } elseif ($bar_position == 'top' && is_user_logged_in()) {
            $this->add_render_attribute('wrap', 'class', 'sa-el-notbar-edit-top' . $bar_layout);
            $this->add_render_attribute('button', 'class', 'sa-el-notbar-edit-top');
        } else {
            $this->add_render_attribute('wrap', 'class', ['sa-el-notbar-top', $bar_layout]);
            $this->add_render_attribute('button', 'class', 'sa-el-notbar-top');
        }

        $this->add_render_attribute('button', 'type', 'button');

        $this->add_render_attribute('button', 'id', 'sa-el-notbar-close-' . $id);

        $this->add_render_attribute('button', 'class', 'sa-el-notbar-close');

        if ($settings['sa_el_notbar_icon_selector'] === 'font-awesome-icon') {
            if (!empty($settings['sa_el_notbar_icon'])) {
                $this->add_render_attribute('icon', 'class', array(
                    'sa-el-notbar-icon',
                    $settings['sa_el_notbar_icon']
                ));
                $this->add_render_attribute('icon', 'aria-hidden', 'true');
            }
            $migrated = isset($settings['__fa4_migrated']['sa_el_notbar_icon_updated']);
            $is_new = empty($settings['sa_el_notbar_icon']) && Icons_Manager::is_migration_allowed();
        }
        ?>
        <div <?php echo $this->get_render_attribute_string('alert'); ?>>
            <div <?php echo $this->get_render_attribute_string('wrap'); ?>>
                <div class="sa-el-notbar-text-container">
                    <div class="sa-el-notbar-icon-text-container">
                        <?php if ($settings['sa_el_notbar_icon_switcher'] == 'yes' && $settings['sa_el_notbar_content_type'] == 'editor') : ?>
                            <div class="sa-el-notbar-icon-wrap">
                                <?php
                                if ($settings['sa_el_notbar_icon_selector'] === 'font-awesome-icon') :
                                    if ($is_new || $migrated) :
                                        Icons_Manager::render_icon($settings['sa_el_notbar_icon_updated'], ['class' => 'sa-el-notbar-icon', 'aria-hidden' => 'true']);
                                    else:
                                        ?>
                                        <i <?php echo $this->get_render_attribute_string('icon'); ?>></i>
                                    <?php
                                    endif;
                                else:
                                    ?>
                                    <img class="sa-el-notbar-custom-image" alt ="Premium Notification Bar" src="<?php echo $image_custom; ?>" >
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($settings['sa_el_notbar_content_type'] == 'editor') : ?>
                            <span <?php echo $this->get_render_attribute_string('sa_el_notbar_text'); ?>><?php echo $settings['sa_el_notbar_text']; ?></span>
                            <?php
                        elseif ($settings['sa_el_notbar_content_type'] == 'template') : echo $this->getTemplateInstance()->get_template_content($template);
                        endif;
                        ?>
                    </div>
                    <div class="sa-el-notbar-button-wrap">
                        <button <?php echo $this->get_render_attribute_string('button'); ?>><?php echo esc_html($settings['sa_el_notbar_close_text']); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        echo $this->get_notbar_responsive_style();
    }

}
