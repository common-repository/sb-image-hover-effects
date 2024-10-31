<?php

namespace SA_EL_ADDONS\Elements\Charts;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

// use \SA_EL_ADDONS\Classes\Bootstrap;

class Charts extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa-el-chart';
    }

    public function get_title() {
        return esc_html__('Charts', SA_EL_ADDONS_TEXTDOMAIN);
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

        $this->start_controls_section('general_settings',
                [
                    'label' => __('Charts', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('type',
                [
                    'label' => __('Layout', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'line' => __('Line', SA_EL_ADDONS_TEXTDOMAIN),
                        'bar' => __('Bar', SA_EL_ADDONS_TEXTDOMAIN),
                        'horizontalBar' => __('Horizontal Bar', SA_EL_ADDONS_TEXTDOMAIN),
                        'pie' => __('Pie', SA_EL_ADDONS_TEXTDOMAIN),
                        'radar' => __('Radar', SA_EL_ADDONS_TEXTDOMAIN),
                        'doughnut' => __('Doughnut', SA_EL_ADDONS_TEXTDOMAIN),
                        'polarArea' => __('Polar Area', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'bar',
                    'label_block' => true,
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('x_axis',
                [
                    'label' => __('X-Axis', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('x_axis_label_switch',
                [
                    'label' => __('Show Axis Label', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'return_value' => 'true',
                    'description' => __('Show or Hide X-Axis Label', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('x_axis_label',
                [
                    'label' => __('Label', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => ['active' => true],
                    'default' => 'X-Axis',
                    'label_block' => true,
                    'condition' => [
                        'x_axis_label_switch' => 'true',
                    ]
                ]
        );

        $this->add_control('x_axis_labels',
                [
                    'label' => __('Data Labels', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => ['active' => true],
                    'default' => 'Jan,Feb,Mar,Apr,May',
                    'description' => __('Enter labels for X-Axis separated with \' , \' ', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_block' => true,
                ]
        );

        $this->add_control('x_axis_grid',
                [
                    'label' => __('Show Grid Lines', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'return_value' => 'true',
                    'default' => 'true',
                    'description' => __('Show or Hide X-Axis Grid Lines', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('x_axis_begin',
                [
                    'label' => __('Begin at Zero', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'true',
                    'description' => __('Start X-Axis Labels at zero', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('x_axis_label_rotation',
                [
                    'label' => __('Labels\' Rotation ', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 360,
                    'default' => 0
                ]
        );

        $this->add_control('x_column_width',
                [
                    'label' => __('Column Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1,
                            'step' => 0.1
                        ]
                    ],
                    'condition' => [
                        'type' => 'bar'
                    ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('y_axis',
                [
                    'label' => __('Y-Axis', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('y_axis_label_switch',
                [
                    'label' => __('Show Axis Label', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'return_value' => 'true',
                    'description' => __('Show or Hide Y-Axis Label', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('y_axis_label',
                [
                    'label' => __('Label', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => ['active' => true],
                    'default' => 'Y-Axis',
                    'label_block' => true,
                    'condition' => [
                        'y_axis_label_switch' => 'true',
                    ]
                ]
        );

        $data_repeater = new REPEATER();

        $data_repeater->add_control('y_axis_column_title',
                [
                    'label' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => __('Dataset', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => ['active' => true],
                ]
        );

        $data_repeater->add_control('y_axis_column_data',
                [
                    'label' => __('Data', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Enter Data Numbers for Y-Axis separated with \' , \' ', SA_EL_ADDONS_TEXTDOMAIN),
                    'dynamic' => ['active' => true],
                    'type' => Controls_Manager::TEXT,
                ]
        );

        $data_repeater->add_control('y_axis_urls',
                [
                    'label' => __('URLs', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'description' => __('Enter URLs for each Dataset separated with \' , \' ', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_block' => true,
                ]
        );

        $data_repeater->add_control('y_axis_column_color',
                [
                    'label' => __('First Fill Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#6ec1e4',
                ]
        );

        $data_repeater->add_control('y_axis_column_second_color',
                [
                    'label' => __('Second Fill Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR
                ]
        );

        $data_repeater->add_control('y_axis_circle_color',
                [
                    'label' => __('Fill Colors', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Enter Colors separated with \' , \', this will work only for pie and doughnut charts ', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => '#ec792e,#cd0012,#0688c8,#3d9c45,#3d4579',
                    'type' => Controls_Manager::TEXT,
                ]
        );

        $data_repeater->add_control('y_axis_column_border_width',
                [
                    'label' => __('Border Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => 1,
                    'type' => Controls_Manager::NUMBER,
                ]
        );

        $data_repeater->add_control('y_axis_column_border_color',
                [
                    'label' => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                ]
        );

        $this->add_control('y_axis_data',
                [
                    'label' => __('Data', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::REPEATER,
                    'default' => [
                        [
                            'y_axis_column_data' => '1,5,2,3,7',
                        ],
                    ],
                    'fields' => array_values($data_repeater->get_controls()),
                ]
        );

        $this->add_control('data_type',
                [
                    'label' => __('Data Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'linear' => __('Linear', SA_EL_ADDONS_TEXTDOMAIN),
                        'logarithmic' => __('Logarithmic', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'linear',
                    'condition' => [
                        'type!' => 'horizontalBar'
                    ]
                ]
        );

        $this->add_control('y_axis_grid',
                [
                    'label' => __('Show Grid Lines', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'return_value' => 'true',
                    'default' => 'true',
                    'description' => __('Show or Hide Y-Axis Grid Lines', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('y_axis_begin',
                [
                    'label' => __('Begin at Zero', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'true',
                    'return_value' => 'true',
                    'description' => __('Start Y-Axis Data at zero', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('y_axis_urls_target',
                [
                    'label' => __('Open Links in new tab', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'return_value' => 'true',
                    'default' => 'true',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('title_content',
                [
                    'label' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('title_switcher',
                [
                    'label' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'true',
                ]
        );

        $this->add_control('title',
                [
                    'label' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'description' => __('Enter a Title for the Chart', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_block' => true,
                    'dynamic' => ['active' => true],
                    'condition' => [
                        'title_switcher' => 'true'
                    ]
                ]
        );

        $this->add_control('title_tag',
                [
                    'label' => __('HTML Tag', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'h3',
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6'
                    ],
                    'label_block' => true,
                    'condition' => [
                        'title_switcher' => 'true'
                    ]
                ]
        );

        $this->add_control('title_position',
                [
                    'label' => __('Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'top' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom' => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'top',
                    'condition' => [
                        'title_switcher' => 'true'
                    ]
                ]
        );

        $this->add_responsive_control('title_align',
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
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-chart-title' => 'text-align: {{VALUE}}',
                    ],
                    'default' => 'center',
                    'condition' => [
                        'title_switcher' => 'true'
                    ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('advanced',
                [
                    'label' => __('Advanced Settings', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('y_axis_min',
                [
                    'label' => __('Minimum Value', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'title' => __('Set Y-axis minimum value, this will be overriden if data has a smaller value', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'type!' => ['pie', 'doughnut', 'radar', 'polarArea']
                    ]
                ]
        );

        $this->add_control('y_axis_max',
                [
                    'label' => __('Maximum Value', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'title' => __('Set Y-axis maximum value, this will be overriden if data has a larger value', SA_EL_ADDONS_TEXTDOMAIN),
                    'min' => 0,
                    'default' => 1,
                    'condition' => [
                        'type!' => ['pie', 'doughnut']
                    ]
                ]
        );

        $this->add_control('step_size',
                [
                    'label' => __('Step Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'condition' => [
                        'type!' => ['pie', 'doughnut']
                    ]
                ]
        );

        $this->add_control('legend_display',
                [
                    'label' => __('Show Legend', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'return_value' => 'true',
                    'description' => __('Show or Hide chart legend', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('legend_position',
                [
                    'label' => __('Legend Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'top' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                        'right' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom' => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                        'left' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'top',
                    'condition' => [
                        'legend_display' => 'true'
                    ]
                ]
        );

        $this->add_control('legend_reverse',
                [
                    'label' => __('Reverse', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('Enable or Disable legend data reverse', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'true',
                    'condition' => [
                        'legend_display' => 'true'
                    ]
                ]
        );

        $this->add_control('tool_tips',
                [
                    'label' => __('Show Values on Hover', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'return_value' => 'true',
                ]
        );

        $this->add_control('tool_tips_percent',
                [
                    'label' => __('Convert Values to percent', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'true',
                    'condition' => [
                        'tool_tips' => 'true'
                    ]
                ]
        );

        $this->add_control('tool_tips_mode',
                [
                    'label' => __('Mode', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'point' => __('Point', SA_EL_ADDONS_TEXTDOMAIN),
                        'nearest' => __('Nearest', SA_EL_ADDONS_TEXTDOMAIN),
                        'dataset' => __('Dataset', SA_EL_ADDONS_TEXTDOMAIN),
                        'x' => __('X', SA_EL_ADDONS_TEXTDOMAIN),
                        'y' => __('Y', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'nearest',
                    'condition' => [
                        'tool_tips' => 'true'
                    ]
                ]
        );

        $this->add_control('value_on_chart',
                [
                    'label' => __('Show Values on Chart', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __("This option works only with Pie and Douhnut Charts", "sa-el-addons-pro"),
                    'label_on' => 'Show',
                    'label_off' => 'Hide',
                    'return_value' => 'true',
                    'condition' => [
                        'type' => ['pie', 'doughnut'],
                        'tool_tips!' => 'true'
                    ]
                ]
        );

        $this->add_control('start_animation',
                [
                    'label' => __('Animation', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'linear' => __('Linear', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInQuad' => __('Ease in Quad', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeOutQuad' => __('Ease out Quad', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInOutQuad' => __('Ease in out Quad', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInCubic' => __('Ease in Cubic', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeOutCubic' => __('Ease out Cubic', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInOutCubic' => __('Ease in out Cubic', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInQuart' => __('Ease in Quart', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeOutQuart' => __('Ease out Quart', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInOutQuart' => __('Ease in out Quart', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInQuint' => __('Ease in Quint', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeOutQuint' => __('Ease out Quint', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInOutQuint' => __('Ease in out Quint', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInSine' => __('Ease in Sine', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeOutSine' => __('Ease out Sine', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInOutSine' => __('Ease in out Sine', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInExpo' => __('Ease in Expo', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeOutExpo' => __('Ease out Expo', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInOutExpo' => __('Ease in out Cubic', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInCirc' => __('Ease in Circle', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeOutCirc' => __('Ease out Circle', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInOutCirc' => __('Ease in out Circle', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInElastic' => __('Ease in Elastic', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeOutElastic' => __('Ease out Elastic', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInOutElastic' => __('Ease in out Elastic', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInBack' => __('Ease in Back', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeOutBack' => __('Ease out Back', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInOutBack' => __('Ease in Out Back', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInBounce' => __('Ease in Bounce', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeOutBounce' => __('Ease out Bounce', SA_EL_ADDONS_TEXTDOMAIN),
                        'easeInOutBounce' => __('Ease in out Bounce', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'easeInQuad',
                ]
        );


        $this->end_controls_section();
        $this->Sa_El_Support();

        $this->start_controls_section('general_style',
                [
                    'label' => __('General', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control('height',
                [
                    'label' => __('Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'title' => __('Set the height of the graph in pixels', SA_EL_ADDONS_TEXTDOMAIN),
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-chart-canvas-container' => 'height: {{VALUE}}px'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'general_background',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .sa-el-chart-container',
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'general_border',
                    'selector' => '{{WRAPPER}} .sa-el-chart-container',
                ]
        );

        $this->add_control('general_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-chart-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'general_box_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-chart-container',
                ]
        );

        $this->add_responsive_control('general_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-chart-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ]
                ]
        );

        $this->add_responsive_control('general_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-chart-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('title_style',
                [
                    'label' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'title_switcher' => 'true'
                    ]
                ]
        );

        $this->add_control('title_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-chart-title' => 'color: {{VALUE}};',
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typo',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .sa-el-chart-title',
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'title_background',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .sa-el-chart-title-container',
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'title_border',
                    'selector' => '{{WRAPPER}} .sa-el-chart-title-container',
                ]
        );

        $this->add_control('title_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-chart-title-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'title_box_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-chart-title',
                ]
        );

        $this->add_responsive_control('title_margin',
                [
                    'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-chart-title-container .sa-el-chart-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ]
                ]
        );

        $this->add_responsive_control('title_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-chart-title-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('x_axis_style',
                [
                    'label' => __('X-Axis', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control('x_axis_label_pop',
                [
                    'label' => __('Axis Label', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'condition' => [
                        'x_axis_label_switch' => 'true'
                    ]
                ]
        );

        $this->start_popover();

        $this->add_control('x_axis_label_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                ]
        );

        $this->add_control('x_axis_label_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 50,
                    'default' => 12
                ]
        );

        $this->end_popover();

        $this->add_control('x_axis_labels_pop',
                [
                    'label' => __('Data Labels', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                ]
        );

        $this->start_popover();

        $this->add_control('x_axis_labels_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                ]
        );

        $this->add_control('x_axis_labels_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 50,
                    'default' => 12
                ]
        );

        $this->end_popover();

        $this->add_control('x_axis_grid_pop',
                [
                    'label' => __('Grid', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::POPOVER_TOGGLE
                ]
        );

        $this->start_popover();

        $this->add_control('x_axis_grid_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#6ec1e4',
                ]
        );

        $this->add_control('x_axis_grid_width',
                [
                    'label' => __('Width', 'sa-el-charts'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => 0.1
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 1
                    ]
                ]
        );

        $this->end_popover();

        $this->end_controls_section();

        $this->start_controls_section('y_axis_style',
                [
                    'label' => __('Y-Axis', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control('y_axis_label_pop',
                [
                    'label' => __('Axis Label', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'condition' => [
                        'y_axis_label_switch' => 'true'
                    ]
                ]
        );

        $this->start_popover();

        $this->add_control('y_axis_label_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                ]
        );

        $this->add_control('y_axis_label_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 50,
                    'default' => 12
                ]
        );

        $this->end_popover();

        $this->add_control('y_axis_data_pop',
                [
                    'label' => __('Data', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                ]
        );

        $this->start_popover();

        $this->add_control('y_axis_labels_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                ]
        );

        $this->add_control('y_axis_labels_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 50,
                    'default' => 12
                ]
        );

        $this->end_popover();

        $this->add_control('y_axis_grid_pop',
                [
                    'label' => __('Grid', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::POPOVER_TOGGLE
                ]
        );

        $this->start_popover();

        $this->add_control('y_axis_grid_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#54595f',
                ]
        );

        $this->add_control('y_axis_grid_width',
                [
                    'label' => __('Width', 'sa-el-charts'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => 0.1
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 1
                    ]
                ]
        );

        $this->end_popover();

        $this->end_controls_section();

        $this->start_controls_section('legend_style',
                [
                    'label' => __('Legend', 'sa-el-charts'),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'legend_display' => 'true'
                    ]
                ]
        );

        $this->add_control('legend_text_color',
                [
                    'label' => __('Color', 'sa-el-charts'),
                    'type' => Controls_Manager::COLOR,
                ]
        );

        $this->add_control('legend_text_size',
                [
                    'label' => __('Size', 'sa-el-charts'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 50,
                    'default' => 12
                ]
        );

        $this->add_control(
                'legend_item_width',
                [
                    'label' => __('Item Width', 'sa-el-charts'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'default' => 40
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $id = $this->get_id();

        if (!empty($settings['title']) && $settings['title_switcher']) {
            $title = '<' . $settings['title_tag'] . ' class="sa-el-chart-title">' . $settings['title'] . '</' . $settings['title_tag'] . '>';
        }
        $xlabels = explode(',', $settings['x_axis_labels']);

        $columns_array = array();


        foreach ($settings['y_axis_data'] as $column_data) {

            if ('pie' != $settings['type'] && 'doughnut' != $settings['type']) {
                $background = [$column_data['y_axis_column_color'], $column_data['y_axis_column_second_color']];
            } else {
                $background = explode(',', $column_data['y_axis_circle_color']);
            }

            $col_settings = [
                'label' => $column_data['y_axis_column_title'],
                'data' => explode(',', $column_data['y_axis_column_data']),
                'links' => explode(',', $column_data['y_axis_urls']),
                'backgroundColor' => $background,
                'borderColor' => $column_data['y_axis_column_border_color'],
                'borderWidth' => $column_data['y_axis_column_border_width']
            ];

            array_push($columns_array, $col_settings);
        }

        $labels_rotation = !empty($settings['x_axis_label_rotation']) ? $settings['x_axis_label_rotation'] : 0;

        $x_label_size = !empty($settings['x_axis_labels_size']) ? $settings['x_axis_labels_size'] : 12;

        $y_label_size = !empty($settings['y_axis_labels_size']) ? $settings['y_axis_labels_size'] : 12;

        $ytype = 'horizontalBar' != $settings['type'] ? $settings['data_type'] : 'category';

        $chart_id = 'sa-el-chart-canvas-' . $id;

        $chart_settings = [
            'type' => $settings['type'],
            'xlabeldis' => $settings['x_axis_label_switch'],
            'xlabel' => $settings['x_axis_label'],
            'ylabeldis' => $settings['y_axis_label_switch'],
            'ylabel' => $settings['y_axis_label'],
            'xlabels' => $xlabels,
            'easing' => $settings['start_animation'],
            'xwidth' => !empty($settings['x_column_width']['size']) ? $settings['x_column_width']['size'] : 0.9,
            'enTooltips' => $settings['tool_tips'],
            'printVal' => $settings['value_on_chart'],
            'percentage' => $settings['tool_tips_percent'],
            'modTooltips' => $settings['tool_tips_mode'],
            'legDis' => $settings['legend_display'],
            'legPos' => $settings['legend_position'],
            'legRev' => $settings['legend_reverse'],
            'legCol' => !empty($settings['legend_text_color']) ? ( $settings['legend_text_color'] ) : '#54595f',
            'legSize' => ( $settings['legend_text_size'] ),
            'itemWid' => ( $settings['legend_item_width'] ),
            'xGrid' => $settings['x_axis_grid'],
            'xGridCol' => $settings['x_axis_grid_color'],
            'xGridWidth' => $settings['x_axis_grid_width']['size'],
            'xTicksSize' => $x_label_size,
            'xlabelcol' => $settings['x_axis_label_color'],
            'ylabelcol' => $settings['y_axis_label_color'],
            'xlabelsize' => $settings['x_axis_label_size'],
            'ylabelsize' => $settings['y_axis_label_size'],
            'xTicksCol' => !empty($settings['x_axis_labels_color']) ? $settings['x_axis_labels_color'] : '#54595f',
            'xTicksRot' => $labels_rotation,
            'xTicksBeg' => $settings['x_axis_begin'],
            'yAxis' => $ytype,
            'yGrid' => $settings['y_axis_grid'],
            'yGridCol' => $settings['y_axis_grid_color'],
            'yGridWidth' => $settings['y_axis_grid_width']['size'],
            'yTicksSize' => $y_label_size,
            'yTicksCol' => !empty($settings['y_axis_labels_color']) ? $settings['y_axis_labels_color'] : '#54595f',
            'yTicksBeg' => $settings['y_axis_begin'],
            'chartId' => $chart_id,
            'suggestedMin' => $settings['y_axis_min'],
            'suggestedMax' => $settings['y_axis_max'],
            'stepSize' => $settings['step_size'],
            'height' => !empty($settings['height']) ? $settings['height'] : 400,
            'target' => ( $settings['y_axis_urls_target'] ) ? '_blank' : '_top'
        ];

        $this->add_render_attribute('charts', 'id', 'sa-el-chart-container-' . $id);

        $this->add_render_attribute('charts', 'class', 'sa-el-chart-container');

        $this->add_render_attribute('charts', 'data-chart', wp_json_encode($columns_array));

        $this->add_render_attribute('charts', 'data-settings', wp_json_encode($chart_settings));

        $this->add_render_attribute('canvas', 'id', 'sa-el-chart-canvas-' . $id);

        $this->add_render_attribute('canvas', 'class', 'sa-el-chart-canvas');

        $this->add_render_attribute('canvas', 'width', 400);

        $this->add_render_attribute('canvas', 'height', 400);
        ?>

        <div <?php echo $this->get_render_attribute_string('charts'); ?>>
            <?php if (!empty($settings['title']) && $settings['title_switcher'] && 'top' == $settings['title_position']) : ?>
                <div class="sa-el-chart-title-container"><?php echo $title; ?></div>
            <?php endif; ?>
            <div class="sa-el-chart-canvas-container">
                <canvas <?php echo $this->get_render_attribute_string('canvas'); ?>></canvas>
            </div>
            <?php if (!empty($settings['title']) && $settings['title_switcher'] && 'bottom' == $settings['title_position']) : ?>
                <div class="sa-el-chart-title-container"><?php echo $title; ?></div>
            <?php endif; ?>
        </div>

        <?php
    }

}
