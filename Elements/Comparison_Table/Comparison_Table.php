<?php

namespace SA_EL_ADDONS\Elements\Comparison_Table;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
// use \SA_EL_ADDONS\Classes\Bootstrap;

class Comparison_Table extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa-el-comparison-table';
    }

    public function get_title() {
        return esc_html__('Comparison Table', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-gallery-masonry oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    public function is_reload_preview_required() {
        return true;
    }

    public function get_script_depends() {
        return [
            'elementor-waypoints',
        ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
                'section_general',
                [
                    'label' => __('General', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );
        $this->add_control(
                'table_count',
                [
                    'label' => __('Table', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 2,
                    'min' => 2,
                    'max' => 10,
                    'placeholder' => __('Tables', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
                'section_legend',
                [
                    'label' => __('Feature Box', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control(
                'show_tooltip',
                [
                    'label' => __('Enable Tooltip', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );
        $this->add_control(
                'tooltip_type',
                [
                    'label' => __('Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'link' => __('Link', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => __('Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'icon',
                    'prefix_class' => 'sa-el-ct-tt-type-',
                    'render_type' => 'template',
                    'condition' => [
                        'show_tooltip' => 'yes'
                    ]
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
                'legend_feature_text',
                [
                    'label' => __('Feature', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'feature',
                    'placeholder' => __('Enter your feature', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );
        $repeater->add_control(
                'legend_feature_tooltip_text',
                [
                    'label' => __('Tooltip', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __('Tooltip Text', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'features_text',
                [
                    'label' => __('Features', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::REPEATER,
                    'show_label' => true,
                    'default' => [
                        [
                            'legend_feature_text' => __('Bandwidth', SA_EL_ADDONS_TEXTDOMAIN),
                        ],
                        [
                            'legend_feature_text' => __('Space', SA_EL_ADDONS_TEXTDOMAIN),
                        ],
                        [
                            'legend_feature_text' => __('Domain', SA_EL_ADDONS_TEXTDOMAIN),
                        ],
                    ],
                    'fields' => array_values($repeater->get_controls()),
                ]
        );
        $this->end_controls_section();

        $this->add_tables();
    }

    function add_tables() {

        $repeater = new Repeater();

        $repeater->add_control(
                'table_content_type',
                [
                    'label' => __('Content', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'label_block' => false,
                    'options' => [
                        'fa fa-check' => [
                            'title' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-check',
                        ],
                        'fa fa-close' => [
                            'title' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-close',
                        ],
                        'text' => [
                            'title' => __('Text', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-font',
                        ]
                    ],
                    'default' => 'text',
                ]
        );
        $repeater->add_control(
                'feature_text',
                [
                    'label' => __('Feature', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Feature', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => __('Enter your feature', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'table_content_type' => 'text'
                    ]
                ]
        );
        for ($i = 1; $i < 11; $i ++) {
            $this->start_controls_section(
                    'section_table_' . $i,
                    [
                        'label' => __('Table ' . $i, SA_EL_ADDONS_TEXTDOMAIN),
                        'operator' => '>',
                        'condition' => [
                            'table_count' => $this->add_condition_value($i),
                        ]
                    ]
            );
            $this->add_control(
                    'table_title_' . $i,
                    [
                        'label' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::TEXT,
                        'default' => __('Our Plan', SA_EL_ADDONS_TEXTDOMAIN),
                        'placeholder' => __('Enter table title', SA_EL_ADDONS_TEXTDOMAIN),
                    ]
            );
            $this->add_control(
                    'table_currency_symbol_' . $i,
                    [
                        'label' => __('Currency Symbol', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::TEXT,
                        'default' => __('$', SA_EL_ADDONS_TEXTDOMAIN),
                        'placeholder' => __('$', SA_EL_ADDONS_TEXTDOMAIN),
                    ]
            );
            $this->add_control(
                    'table_price_' . $i,
                    [
                        'label' => __('Price', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::TEXT,
                        'default' => __('39.99', SA_EL_ADDONS_TEXTDOMAIN),
                        'placeholder' => __('Enter table title', SA_EL_ADDONS_TEXTDOMAIN),
                    ]
            );
            $this->add_control(
                    'table_offer_discount_' . $i,
                    [
                        'label' => __('Offering Discount', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::SWITCHER,
                        'return_value' => 'yes',
                        'default' => 'no',
                    ]
            );
            $this->add_control(
                    'table_original_price_' . $i,
                    [
                        'label' => __('Original Price', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::TEXT,
                        'default' => __('49.99', SA_EL_ADDONS_TEXTDOMAIN),
                        'placeholder' => __('Enter table title', SA_EL_ADDONS_TEXTDOMAIN),
                        'condition' => [
                            'table_offer_discount_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'table_duration_' . $i,
                    [
                        'label' => __('Duration', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::TEXT,
                        'default' => __('/year', SA_EL_ADDONS_TEXTDOMAIN),
                        'placeholder' => __('Enter table title', SA_EL_ADDONS_TEXTDOMAIN),
                    ]
            );

            $this->add_control(
                    'table_ribbon_' . $i,
                    [
                        'label' => __('Ribbon', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::SWITCHER,
                        'return_value' => 'yes',
                        'default' => 'no',
                    ]
            );

            $this->add_control(
                    'table_ribbon_text_' . $i,
                    [
                        'label' => __('Ribbon Text', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::TEXT,
                        'default' => __('Popular', SA_EL_ADDONS_TEXTDOMAIN),
                        'placeholder' => __('Popular', SA_EL_ADDONS_TEXTDOMAIN),
                        'condition' => [
                            'table_ribbon_' . $i => 'yes',
                        ]
                    ]
            );

            $this->add_control(
                    'ribbons_position_' . $i,
                    [
                        'label' => __('Position', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::CHOOSE,
                        'label_block' => false,
                        'options' => [
                            'left' => [
                                'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                                'icon' => 'eicon-h-align-left',
                            ],
                            'top' => [
                                'title' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                                'icon' => 'eicon-v-align-top',
                            ],
                            'right' => [
                                'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                                'icon' => 'eicon-h-align-right',
                            ]
                        ],
                        'default' => 'left',
                        'condition' => [
                            'table_ribbon_' . $i => 'yes'
                        ]
                    ]
            );

            $this->add_control(
                    'button_text_' . $i,
                    [
                        'label' => __('Button Text', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Buy Now'
                    ]
            );
            $this->add_control(
                    'item_link_' . $i,
                    [
                        'label' => __('Link', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::URL,
                        'default' => [
                            'url' => '#',
                            'is_external' => '',
                        ],
                    ]
            );

            $this->add_control(
                    'feature_items_' . $i,
                    [
                        'label' => __('Features', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::REPEATER,
                        'show_label' => true,
                        'default' => [
                            [
                                'feature_text' => __('25GB', SA_EL_ADDONS_TEXTDOMAIN),
                            ],
                            [
                                'feature_text' => __('5GB', SA_EL_ADDONS_TEXTDOMAIN),
                            ],
                            [
                                'feature_text' => __('1', SA_EL_ADDONS_TEXTDOMAIN),
                            ],
                        ],
                        'fields' => array_values($repeater->get_controls()),
                    ]
            );


            $this->add_control(
                    'override_style_' . $i,
                    [
                        'label' => __('Override Style', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::SWITCHER,
                        'return_value' => 'yes',
                        'default' => 'no',
                        'separator' => 'before'
                    ]
            );

            $this->add_control(
                    'custom__heading_' . $i,
                    [
                        'label' => __('Heading', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::HEADING,
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'heading_text_color_custom_' . $i,
                    [
                        'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .sa-el-table-' . $i . '.sa-el-ct-heading' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'heading_text_bg_color_custom_' . $i,
                    [
                        'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .sa-el-table-' . $i . '.sa-el-ct-heading' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );

            $this->add_control(
                    'active_tab_color_custom_' . $i,
                    [
                        'label' => __('Active Tab Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .sa-el-table-' . $i . '.sa-el-ct-heading.active' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );

            $this->add_control(
                    'active_tab_bg_color_custom_' . $i,
                    [
                        'label' => __('Active Tab BG Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .sa-el-table-' . $i . '.sa-el-ct-heading.active' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'custom_o_price_heading_' . $i,
                    [
                        'label' => __('Original Price', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'before',
                        'condition' => [
                            'override_style_' . $i => 'yes',
                            'table_offer_discount_' . $i => 'yes'
                        ]
                    ]
            );
            $this->add_control(
                    'custom_o_price_color_' . $i,
                    [
                        'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .sa-el-ct-plan.sa-el-table-' . $i . ' .sa-el-ct-price-wrapper .sa-el-ct-original-price' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                            'table_offer_discount_' . $i => 'yes'
                        ]
                    ]
            );
            $this->add_control(
                    'custom_o_price_line_color_' . $i,
                    [
                        'label' => __('Line Through Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .sa-el-ct-plan.sa-el-table-' . $i . ' .sa-el-ct-price-wrapper .sa-el-ct-original-price' => 'text-decoration-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                            'table_offer_discount_' . $i => 'yes'
                        ]
                    ]
            );
            $this->add_control(
                    'custom_price_heading_' . $i,
                    [
                        'label' => __('Price', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'before',
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'custom_currency_color_' . $i,
                    [
                        'label' => __('Currency Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .sa-el-ct-plan.sa-el-table-' . $i . ' .sa-el-ct-price-wrapper .sa-el-ct-currency' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'custom_price_color_' . $i,
                    [
                        'label' => __('Price Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .sa-el-ct-plan.sa-el-table-' . $i . ' .sa-el-ct-price-wrapper .sa-el-ct-price' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'custom_fractional_color_' . $i,
                    [
                        'label' => __('Fractional Part Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .sa-el-ct-plan.sa-el-table-' . $i . ' .sa-el-ct-price-wrapper .sa-el-ct-fractional-price' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'custom_duration_color_' . $i,
                    [
                        'label' => __('Duration Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .sa-el-ct-plan.sa-el-table-' . $i . ' .sa-el-ct-duration' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'custom_price_bg_color_' . $i,
                    [
                        'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .sa-el-ct-plan.sa-el-table-' . $i => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'custom_table_Items_' . $i,
                    [
                        'label' => __('Features', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'before',
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'custom_table_item_color_' . $i,
                    [
                        'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} td.sa-el-table-' . $i . '.sa-el-ct-txt' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'features_tbl_check_color_' . $i,
                    [
                        'label' => __('Check Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .sa-el-ct-wrapper td.sa-el-table-' . $i . ' i.fa.fa-check' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'features_tbl_close_color_' . $i,
                    [
                        'label' => __('Close Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .sa-el-ct-wrapper td.sa-el-table-' . $i . ' i.fa.fa-close' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'custom_table_item_bg_color_' . $i,
                    [
                        'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} td.sa-el-table-' . $i . '.sa-el-ct-txt' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'custom_ribbon_heading_' . $i,
                    [
                        'label' => __('Ribbon', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'before',
                        'condition' => [
                            'override_style_' . $i => 'yes',
                            'table_ribbon_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'custom_ribbon_text_color_' . $i,
                    [
                        'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} th.sa-el-table-' . $i . '.sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper span.sa-el-ct-ribbons-inner' => 'color: {{VALUE}};',
                            '{{WRAPPER}} th.sa-el-table-' . $i . '.sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper-top' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                            'table_ribbon_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'custom_ribbon_bg_color_' . $i,
                    [
                        'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} th.sa-el-table-' . $i . '.sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper span.sa-el-ct-ribbons-inner' => 'background-color: {{VALUE}};',
                            '{{WRAPPER}} li.sa-el-table-' . $i . '.sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper span.sa-el-ct-ribbons-inner' => 'background-color: {{VALUE}};',
                            '{{WRAPPER}} th.sa-el-table-' . $i . '.sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper-top' => 'background-color: {{VALUE}};',
                            '{{WRAPPER}} li.sa-el-table-' . $i . '.sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper-top' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                            'table_ribbon_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'custom_button_heading_' . $i,
                    [
                        'label' => __('Button', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'before',
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'custom_button_text_color_' . $i,
                    [
                        'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .sa-el-table-' . $i . ' .sa-el-ct-btn' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );
            $this->add_control(
                    'custom_button_bg_color_' . $i,
                    [
                        'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .sa-el-table-' . $i . ' .sa-el-ct-btn' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );

            $this->add_control(
                    'custom_btn_clm_background_color_' . $i,
                    [
                        'label' => __('Column Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} tr:last-child td.sa-el-table-' . $i => 'background-color: {{VALUE}}; border-color:{{VALUE}}',
                        ],
                        'condition' => [
                            'override_style_' . $i => 'yes',
                        ]
                    ]
            );

            $this->end_controls_section();
        }

        $this->start_controls_section(
                'section_general_style',
                [
                    'label' => __('General', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'odd_color',
                [
                    'label' => __('Odd Row Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} tr:nth-child(even)' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'even_color',
                [
                    'label' => __('Even Row Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} tr:nth-child(odd)' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'table_border',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-ct-wrapper table tr td:first-child,{{WRAPPER}}  .sa-el-ct-wrapper td,{{WRAPPER}} .sa-el-ct-wrapper td,{{WRAPPER}}  .sa-el-ct-wrapper th',
                    'label_block' => true,
                ]
        );
        $this->end_controls_section();
        $this->Sa_El_Support();

        $this->start_controls_section(
                'section_feature_style',
                [
                    'label' => __('Feature Box', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'features_text_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-feature' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'feature_text_bg_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-feature' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'feature_text_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                    'selector' => '{{WRAPPER}} .sa-el-ct-feature',
                ]
        );

        $this->add_responsive_control(
                'feature_text_align',
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
                        ]
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-feature' => 'text-align: {{VALUE}};',
                    ]
                ]
        );
        $this->add_responsive_control(
                'feature_text_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-feature' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_control(
                'tooltip_icon_heading',
                [
                    'label' => __('Tooltip Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'tooltip_type' => 'icon'
                    ]
                ]
        );
        $this->add_control(
                'tooltip_icon_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 50,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'size' => 15,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-feature .sa-el-icon-view-stacked i' => 'font-size: {{SIZE}}px',
                    ],
                    'condition' => [
                        'tooltip_type' => 'icon'
                    ]
                ]
        );

        $this->add_control(
                'feature_tooltip_icon_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-feature .sa-el-icon-view-stacked i' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'tooltip_type' => 'icon'
                    ]
                ]
        );
        $this->add_control(
                'feature_tooltip_icon_bg_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-feature .sa-el-icon' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'tooltip_type' => 'icon'
                    ]
                ]
        );
        $this->add_control(
                'feature_tooltip_icon_hover_color',
                [
                    'label' => __('Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-feature .tooltip:hover .sa-el-icon-view-stacked i' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'tooltip_type' => 'icon'
                    ]
                ]
        );
        $this->add_control(
                'feature_tooltip_icon_bg_hover_color',
                [
                    'label' => __('Hover Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-feature .tooltip:hover .sa-el-icon' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'tooltip_type' => 'icon'
                    ]
                ]
        );

        $this->add_control(
                'tooltip_icon_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 50,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'size' => 5,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-wrapper .sa-el-icon' => 'padding: {{SIZE}}px',
                    ],
                    'condition' => [
                        'tooltip_type' => 'icon'
                    ]
                ]
        );

        $this->add_control(
                'tooltip_Text_heading',
                [
                    'label' => __('Tooltip Text', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
        );
        $this->add_control(
                'feature_tooltip_text_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-wrapper .tooltip .tooltiptext' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'feature_tooltip_text_bg_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-wrapper .tooltip .tooltiptext' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .sa-el-ct-wrapper .tooltip .tooltiptext::before' => 'border-top-color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'Tooltip_text_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                    'selector' => '{{WRAPPER}} .sa-el-ct-wrapper .tooltip .tooltiptext',
                ]
        );

        $this->add_responsive_control(
                'feature_tooltip_text_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-wrapper .tooltip .tooltiptext' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
                'section_ribbon_style',
                [
                    'label' => __('Ribbon', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );
        $ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';

        $this->add_responsive_control(
                'sa_el_ribbon_distance',
                [
                    'label' => __('Distance', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper span.sa-el-ct-ribbons-inner' => 'margin-top: {{SIZE}}{{UNIT}}; transform: ' . $ribbon_distance_transform,
                    ],
                ]
        );

        $this->add_control(
                'ribbon_text_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper span.sa-el-ct-ribbons-inner' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper-top' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'ribbon_bg_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper span.sa-el-ct-ribbons-inner' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper-top' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sa_el_ribbons_typography',
                    'selector' => '{{WRAPPER}} .sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper span.sa-el-ct-ribbons-inner,{{WRAPPER}} .sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper-top',
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'ribbon_border',
                    'label' => __('Box Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper span.sa-el-ct-ribbons-inner, {{WRAPPER}} .sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper-top',
                ]
        );
        $this->add_responsive_control(
                'ribbon_text_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper span.sa-el-ct-ribbons-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .sa-el-ct-ribbons-yes .sa-el-ct-ribbons-wrapper-top' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
                'section_heading_style',
                [
                    'label' => __('Heading', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'tab_format',
                [
                    'label' => __('Tab Format', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'all' => __('All', SA_EL_ADDONS_TEXTDOMAIN),
                        'tab-mob' => __('Tablet & Mobile', SA_EL_ADDONS_TEXTDOMAIN),
                        'mobile' => __('Mobile', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'mobile',
                    'prefix_class' => 'sa-el-tab-format-',
                ]
        );
        $this->add_responsive_control(
                'sa_el_th_height',
                [
                    'label' => __('Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 150,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-heading' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_control(
                'active_tab_color',
                [
                    'label' => __('Active Tab Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-heading.active' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'heading_text_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-heading' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'heading_text_color_active',
                [
                    'label' => __('Active Tab Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .active.sa-el-ct-heading' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'heading_text_bg_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-heading' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_text_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .sa-el-ct-heading',
                ]
        );
        $this->add_responsive_control(
                'heading_text_align',
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
                        ]
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-heading' => 'text-align: {{VALUE}};',
                    ]
                ]
        );
        $this->add_responsive_control(
                'heading_text_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_price_style',
                [
                    'label' => __('Price', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'original_heading',
                [
                    'label' => __('Original Price', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                ]
        );
        $this->add_control(
                'original_text_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-original-price' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'line_through_text_color',
                [
                    'label' => __('Text Decoration Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-original-price' => 'text-decoration-color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'original_text_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-ct-original-price',
                ]
        );
        $this->add_control(
                'original_align',
                [
                    'label' => __('Vertical Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'flex-end',
                    'label_block' => false,
                    'options' => [
                        'flex-start' => [
                            'title' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'center' => [
                            'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-middle',
                        ],
                        'flex-end' => [
                            'title' => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-original-price' => 'align-self: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'currency_heading',
                [
                    'label' => __('Currency', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
        );
        $this->add_control(
                'currency_text_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-currency' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'currency_text_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-ct-currency',
                ]
        );
        $this->add_control(
                'currency_align',
                [
                    'label' => __('Vertical Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'flex-start',
                    'label_block' => false,
                    'options' => [
                        'flex-start' => [
                            'title' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'center' => [
                            'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-middle',
                        ],
                        'flex-end' => [
                            'title' => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-currency' => 'align-self: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'price_heading',
                [
                    'label' => __('Price', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
        );
        $this->add_control(
                'price_text_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-price' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'price_text_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-ct-price',
                ]
        );
        $this->add_control(
                'fractional_heading',
                [
                    'label' => __('Fractional', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
        );
        $this->add_control(
                'fractional _text_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-fractional-price' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'fractional_text_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-ct-fractional-price',
                ]
        );
        $this->add_control(
                'fractional_align',
                [
                    'label' => __('Vertical Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'flex-start',
                    'label_block' => false,
                    'options' => [
                        'flex-start' => [
                            'title' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'center' => [
                            'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-middle',
                        ],
                        'flex-end' => [
                            'title' => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-fractional-price' => 'align-self: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'duration_heading',
                [
                    'label' => __('Duration', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
        );
        $this->add_control(
                'duration_text_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-duration' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'duration_text_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-ct-duration',
                ]
        );

        $this->add_control(
                'price_text_bg_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-plan' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'price_text_align',
                [
                    'label' => __('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [
                            'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-center',
                        ],
                        'flex-end' => [
                            'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right',
                        ]
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-price-wrapper  ' => 'justify-content: {{VALUE}};',
                    ]
                ]
        );
        $this->add_control(
                'add_responsive_control',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-plan' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
                'section_text_style',
                [
                    'label' => __('Features', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'features_tbl_text_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-txt' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'features_tbl_check_color',
                [
                    'label' => __('Check Icon Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-wrapper i.fa.fa-check' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'features_tbl_close_color',
                [
                    'label' => __('Close Icon Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-wrapper i.fa.fa-close' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'feature_tbl_text_bg_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-txt' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'Feature_tbl_text_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                    'selector' => '{{WRAPPER}} .sa-el-ct-txt',
                ]
        );

        $this->add_responsive_control(
                'feature_tbl_text_align',
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
                        ]
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-txt' => 'text-align: {{VALUE}};',
                    ]
                ]
        );
        $this->add_responsive_control(
                'feature_tbl_text_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-txt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_btn_style',
                [
                    'label' => __('Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                'button_color',
                [
                    'label' => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-btn' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'btn_background_color',
                [
                    'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#61ce70',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-btn' => 'background-color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'btn_clm_background_color',
                [
                    'label' => __('Column Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} tr:last-child td' => 'background-color: {{VALUE}}; border-color:{{VALUE}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'btn_text_typography',
                    'label' => __('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-ct-btn',
                ]
        );
        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'btn_text_shadow',
                    'label' => 'Text Shadow',
                    'selector' => '{{WRAPPER}} .sa-el-ct-btn',
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'btn_box_shadow',
                    'label' => 'Box Shadow',
                    'selector' => '{{WRAPPER}} .sa-el-ct-btn',
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'btn_border',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-ct-btn',
                ]
        );

        $this->add_control(
                'btn_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'button_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-ct-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->end_controls_section();
    }

    function add_condition_value($j) {
        $value = [];
        for ($i = $j; $i < 11; $i ++) {
            $value[] = $i;
        }

        return $value;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        //echo '<pre>';print_r($settings);echo '</pre>';
        ?>
        <article class="sa-el-ct-wrapper">

            <ul>
                <?php
                for ($i = 1; $i <= $settings['table_count']; $i ++) {
                    if ($settings['table_ribbon_' . $i] == 'yes') {
                        echo '<li class="sa-el-ct-heading sa-el-table-' . $i . ' sa-el-ct-ribbons-yes sa-el-ct-ribbons-h-' . $settings['ribbons_position_' . $i] . '">';
                        if ($settings['ribbons_position_' . $i] == 'top') {
                            ?>
                            <div class="sa-el-ct-ribbons-wrapper-top">
                                <span class="sa-el-ct-ribbons-inner-top">
                                    <?php echo $settings['table_ribbon_text_' . $i] ?>
                                </span>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="sa-el-ct-ribbons-wrapper">
                                <span class="sa-el-ct-ribbons-inner">
                                    <?php echo $settings['table_ribbon_text_' . $i] ?>
                                </span>
                            </div>

                            <?php
                        }
                    } else {
                        echo '<li class="sa-el-ct-heading sa-el-table-' . $i . '">';
                    }
                    echo '<div class="sa-el-ct-heading-inner">';
                    echo $settings['table_title_' . $i];
                    echo '</div>';
                    echo '</li>';
                }
                ?>
            </ul>

            <table>
                <thead>
                    <tr>
                        <th class="hide"></th>
                        <?php
                        for ($i = 1; $i <= $settings['table_count']; $i ++) {
                            if ($settings['table_ribbon_' . $i] == 'yes') {
                                echo '<th class="sa-el-ct-heading sa-el-ct-ribbons-yes sa-el-ct-ribbons-h-' . $settings['ribbons_position_' . $i] . ' sa-el-table-' . $i . '">';
                                if ($settings['ribbons_position_' . $i] == 'top') {
                                    ?>
                            <div class="sa-el-ct-ribbons-wrapper-top">
                                <span class="sa-el-ct-ribbons-inner-top">
                                    <?php echo $settings['table_ribbon_text_' . $i] ?>
                                </span>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="sa-el-ct-ribbons-wrapper">
                                <span class="sa-el-ct-ribbons-inner">
                                    <?php echo $settings['table_ribbon_text_' . $i] ?>
                                </span>
                            </div>

                            <?php
                        }
                    } else {
                        echo '<th class="sa-el-ct-heading sa-el-table-' . $i . '">';
                    }
                    echo $settings['table_title_' . $i];
                    echo '</th>';
                }
                ?>
                </tr>
                </thead>
                <tbody>
                    <?php
                    echo '<tr>';
                    echo '<td class="hide"></td>';
                    for ($j = 1; $j <= $settings['table_count']; $j++) {
                        echo '<td class="sa-el-ct-plan sa-el-table-' . $j . '"><div class="sa-el-ct-price-wrapper">';

                        if ($settings['table_offer_discount_' . $j] == 'yes') {
                            echo '<span class="sa-el-ct-original-price">';
                            echo $settings['table_currency_symbol_' . $j] . $settings['table_original_price_' . $j];
                            echo '</span>';
                        }

                        $price = explode('.', $settings['table_price_' . $j]);
                        $fractional_price = '';
                        if (count($price) > 1) {
                            $fractional_price = '<span class="sa-el-ct-fractional-price">' . $price[1] . '</span>';
                        }
                        echo '<span class="sa-el-ct-currency">' . $settings['table_currency_symbol_' . $j] . '</span>';
                        echo '<span class="sa-el-ct-price">' . $price[0] . '</span>';
                        echo $fractional_price;
                        echo '</div>';
                        echo '<span class="sa-el-ct-duration">' . $settings['table_duration_' . $j] . '</span>';
                        echo '</td>';
                    }
                    echo '</tr>';

                    for ($x = 1; $x <= count($settings['features_text']); $x ++) {
                        echo '<tr>';
                        echo '<td  class="sa-el-ct-feature">';

                        if ($settings['features_text'][$x - 1]['legend_feature_tooltip_text'] !== '' && $settings['show_tooltip'] == 'yes') {

                            if ($settings['tooltip_type'] !== 'icon') {
                                echo '<div class="tooltip">';
                                echo '<span class="sa-el-ct-heading-tooltip">';
                            } else {
                                echo '<span>';
                            }
                            echo $settings['features_text'][$x - 1]['legend_feature_text'];
                            echo '</span>';
                            if ($settings['tooltip_type'] == 'icon') {
                                ?>
                            <div class="tooltip">
                                <div class="sa-el-icon sa-el-icon-view-stacked sa-el-icon-shape-circle sa-el-icon-type-icon">
                                    <div class="sa-el-icon-wrap">
                                        <i class="fa fa-info"></i>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <span class="tooltiptext">
                                <?php
                                echo $settings['features_text'][$x - 1]['legend_feature_tooltip_text'];
                                ?>
                            </span>
                        </div>
                        <?php
                    } else {
                        echo $settings['features_text'][$x - 1]['legend_feature_text'];
                    }
                    echo '</td>';

                    for ($j = 1; $j <= $settings['table_count']; $j ++) {
                        echo '<td class="sa-el-ct-txt sa-el-table-' . $j . '">';
                        if (count($settings['feature_items_' . $j]) >= $x) {
                            if ($settings['feature_items_' . $j][$x - 1]['table_content_type'] !== 'text') {
                                echo '<i class="' . $settings['feature_items_' . $j][$x - 1]['table_content_type'] . '"></i>';
                            } else {
                                echo $settings['feature_items_' . $j][$x - 1]['feature_text'];
                            }
                        } else {
                            echo '';
                        }
                        echo '</td>';
                    }
                    echo '</tr>';
                }
                echo '<td></td>';
                for ($j = 1; $j <= $settings['table_count']; $j ++) {
                    $this->add_render_attribute('button_' . $j . '-link-attributes', 'href', $settings['item_link_' . $j]['url']);
                    $this->add_render_attribute('button_' . $j . '-link-attributes', 'class', 'sa-el-ct-btn');

                    if ($settings['item_link_' . $j]['is_external'] == 'on') {
                        $this->add_render_attribute('button_' . $j . '-link-attributes', 'target', '_blank');
                    }
                    if ($settings['item_link_' . $j]['nofollow']) {
                        $this->add_render_attribute('button_' . $j . '-link-attributes', 'rel', 'nofollow');
                    }

                    echo '<td class="sa-el-table-' . $j . '">';
                    if ($settings['button_text_' . $j] !== '') {
                        echo '<a ' . $this->get_render_attribute_string('button_' . $j . '-link-attributes') . '>' . $settings['button_text_' . $j] . '</a>';
                    }
                    echo '</td>';
                }
                ?>
                </tbody>
            </table>
        </article>
        <?php
    }

    protected function _content_template() {
        ?>

        <article class="sa-el-ct-wrapper">
            <ul>
                <#
                for ( var i = 1; i <= settings.table_count; i++ ) {
                if ( settings['table_ribbon_' + i ] == 'yes' ) {
                console.log('yes');
                view.addRenderAttribute( 'heading_' + i, 'class', 'sa-el-ct-heading' );
                view.addRenderAttribute( 'heading_' + i, 'class', 'sa-el-table-' + i );
                view.addRenderAttribute( 'heading_' + i, 'class', 'sa-el-ct-ribbons-yes');
                view.addRenderAttribute( 'heading_' + i, 'class', 'sa-el-ct-ribbons-h-' + settings['ribbons_position_' + i
                ] );
                }
                if ( settings['table_ribbon_' + i ] == 'yes' ) {
                #>
                <li {{{ view.getRenderAttributeString(
                    'heading_' + i ) }}}>
                    <# if ( settings['ribbons_position_' + i ] == 'top' ) {
                    #>
                    <div class="sa-el-ct-ribbons-wrapper-top">
                        <span class="sa-el-ct-ribbons-inner-top">
                            {{{ settings['table_ribbon_text_'  + i ] }}}
                        </span>
                    </div>
                    <#
                    } else {
                    #>
                    <div class="sa-el-ct-ribbons-wrapper">
                        <span class="sa-el-ct-ribbons-inner">
                            {{{ settings['table_ribbon_text_'  + i ] }}}
                        </span>
                    </div>

                    <#
                    }
                    }
                    else{
                    #>
                <li class="sa-el-ct-heading sa-el-table-" {{{i}}}>
                    <#
                    }
                    #>
                    <div class="sa-el-ct-heading-inner">
                        {{{ settings['table_title_' + i ] }}}
                    </div>
                </li>
                <# }
                #>
            </ul>
            <table>
                <thead>
                    <tr>
                        <th class="hide"></th>
                        <#
                        for ( var i = 1; i <= settings.table_count; i++ ) {
                        if ( settings[ 'table_ribbon_' + i ] == 'yes' ) {
                        view.addRenderAttribute( 'heading_inn_' + i, 'class', 'sa-el-ct-heading' );
                        view.addRenderAttribute( 'heading_inn_' + i, 'class', 'sa-el-ct-ribbons-yes' );
                        view.addRenderAttribute( 'heading_inn_' + i, 'class', 'sa-el-ct-ribbons-h-' + settings['ribbons_position_' + i ] );
                        view.addRenderAttribute( 'heading_inn_' + i, 'class', 'sa-el-table-' + i );
                        #>
                        <th {{{ view.getRenderAttributeString('heading_inn_' + i ) }}}>
                            <# if ( settings[ 'ribbons_position_' + i ] == 'top' ) {
                            #>
                            <div class="sa-el-ct-ribbons-wrapper-top">
                                <span class="sa-el-ct-ribbons-inner-top">
                                    {{{ settings[ 'table_ribbon_text_' + i ] }}}
                                </span>
                            </div>
                            <#
                            } else {
                            #>
                            <div class="sa-el-ct-ribbons-wrapper">
                                <span class="sa-el-ct-ribbons-inner">
                                    {{{ settings[ 'table_ribbon_text_' + i ] }}}
                                </span>
                            </div>

                            <# } #>
                            <# } else { #>
                        <th class="sa-el-ct-heading sa-el-table-{{{ i }}}">
                            <# }
                            #>
                            {{{ settings[ 'table_title_' + i ] }}}
                        </th>
                        <#    }
                        #>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="hide"></td>
                        <#
                        for ( var j = 1; j <= settings.table_count; j++ ) {
                        #>
                        <td class="sa-el-ct-plan sa-el-table-{{{ j }}}"><div class="sa-el-ct-price-wrapper">

                                <# if ( settings[ 'table_offer_discount_' + j ] == 'yes' ) { #>
                                <span class="sa-el-ct-original-price">
                                    {{{ settings[ 'table_currency_symbol_' + j ] + settings[ 'table_original_price_' + j ] }}}
                                </span>
                                <# }

                                var price  = settings[ 'table_price_' + j].split(".");
                                var fractional_price = '';
                                if ( price.length > 1 ) {

                                fractional_price = '<span class="sa-el-ct-fractional-price">' + price[1] + '</span>';
                                }
                                #>
                                <span class="sa-el-ct-currency"> {{{ settings[ 'table_currency_symbol_' + j ] }}} </span>
                                <span class="sa-el-ct-price"> {{{ price[0] }}} </span>
                                {{{ fractional_price }}}
                            </div>
                            <span class="sa-el-ct-duration"> {{{ settings[ 'table_duration_' + j ] }}} </span>
                        </td>
                        <# } #>
                    </tr>

                    <#
                    for ( var x = 1; x <= settings['features_text'].length; x++ ) {
                    #>
                    <tr>
                        <td class="sa-el-ct-feature">
                            <# if ( settings['features_text'][ x - 1 ]['legend_feature_tooltip_text'] !== '' && settings['show_tooltip'] == 'yes' ) {
                            if ( settings['tooltip_type'] !== 'icon' ) {
                            #>
                            <div class="tooltip">
                                <span class="sa-el-ct-heading-tooltip">
                                    <# } else { #>
                                    <span>
                                        <# }#>
                                        {{{ settings['features_text'][ x - 1 ]['legend_feature_text'] }}}
                                    </span>
                                    <# if ( settings['tooltip_type'] == 'icon' ) { #>
                                    <div class="tooltip">
                                        <div class="sa-el-icon sa-el-icon-view-stacked sa-el-icon-shape-circle sa-el-icon-type-icon">
                                            <div class="sa-el-icon-wrap">
                                                <i class="fa fa-info"></i>
                                            </div>
                                        </div>
                                        <# } #>
                                        <span class="tooltiptext">
                                            {{{ settings['features_text'][ x - 1 ]['legend_feature_tooltip_text'] }}}
                                        </span>
                                    </div>
                                    <# } else { #>
                                    {{{ settings['features_text'][ x - 1 ]['legend_feature_text'] }}}
                                    <# } #>
                                </span>
                                <# for ( var j = 1; j <= settings['table_count']; j++ ) { #>
                                <td class="sa-el-ct-txt sa-el-table-{{{ j }}}">
                                    <# if ( settings[ 'feature_items_' + j ].length  >= x ) {
                                    if ( settings[ 'feature_items_' + j ][ x - 1 ]['table_content_type'] !== 'text' ) { #>
                                    <i class=" {{{ settings[ 'feature_items_' + j ][ x - 1 ]['table_content_type'] }}}"></i>
                                    <# } else { #>
                                    {{{ settings[ 'feature_items_' + j ][ x - 1 ]['feature_text'] }}}
                                    <# } } else { #>
                                    <# } #>
                                </td>
                                <# } #>
                    </tr>
                    <# } #>
                <td></td>
                <# for ( j = 1; j <= settings['table_count']; j++ ) {
                view.addRenderAttribute( 'button_' + j + '-link-attributes', 'href', settings[ 'item_link_' + j ]['url'] );
                view.addRenderAttribute( 'button_' + j + '-link-attributes', 'class', 'sa-el-ct-btn' );

                if ( settings[ 'item_link_' + j ]['is_external'] == 'on' ) {
                view.addRenderAttribute( 'button_' + j + '-link-attributes', 'target', '_blank' );
                }
                if ( settings[ 'item_link_' + j ]['nofollow'] ) {
                view.addRenderAttribute( 'button_' + j + '-link-attributes', 'rel', 'nofollow' );
                }
                #>
                <td class="sa-el-table-{{{ j }}}">
                    <# if ( settings[ 'button_text_' . j ] !== '' ) { #>
                    <a {{{ view.getRenderAttributeString( 'button_' + j + '-link-attributes' ) }}} > {{{ settings[ 'button_text_' + j ] }}} </a>
                    <# } #>
                </td>
                <# } #>
                </tbody>
            </table>
        </article>
        <?php
    }

}
