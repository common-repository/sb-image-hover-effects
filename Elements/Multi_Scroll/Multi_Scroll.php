<?php

namespace SA_EL_ADDONS\Elements\Multi_Scroll;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

use Elementor\Core\Responsive\Responsive;

class Multi_Scroll extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_multi_scroll';
    }

    public function get_title() {
        return esc_html__('Multi Scroll', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-scroll oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }
    public function is_reload_preview_required() {
        return true;
    }
    
    public function check_rtl(){
        return is_rtl();
    }
    
    protected function get_repeater_controls( $repeater, $condition = [] ) {
        
        $repeater->add_control('notice', 
            [
                'label'         => __('Names are reversed in RTL mode', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::HEADING,
            ]
        );
        
        $repeater->add_control('left_content', 
            [
                'label'         => __('Left Content', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'text'   => __('Text Editor', SA_EL_ADDONS_TEXTDOMAIN),
                    'temp'   => __('Elementor Template', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'default'       => 'temp'
            ]
        );

        $repeater->add_control('left_side_text',
            [ 
                'type'          => Controls_Manager::WYSIWYG,
                'default'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'label_block'   => true,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                   'left_content'  => 'text',
                ],
            ]
        );
        
        $repeater->add_control('left_side_template',
		  	[
		     	'label'			=> __( 'Left Template', SA_EL_ADDONS_TEXTDOMAIN ),
		     	'type'          => Controls_Manager::SELECT2,
		     	'options'       => $this->sa_el_get_elementor_page_list(),
		     	'multiple'      => false,
                'condition'     => [
                    'left_content'     => 'temp'     
                ]
		  	]
		);
        
        $repeater->add_control('hide_left_section_tabs',
            [
                'label'         => __('Hide on Tabs', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This option works only when multiscroll disabled on tablets', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        
        $repeater->add_control('hide_left_section_mobs',
            [
                'label'         => __('Hide on Mobiles', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This option works only when multiscroll disabled on mobiles', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        
        $repeater->add_control('right_content', 
            [
                'label'         => __('Right Content', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'text'   => __('Text Editor', SA_EL_ADDONS_TEXTDOMAIN),
                    'temp'   => __('Elementor Template', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'default'       => 'temp',
                'separator'     => 'before'
            ]
        );

        $repeater->add_control('right_side_text',
            [ 
                'type'          => Controls_Manager::WYSIWYG,
                'default'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'label_block'   => true,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                   'right_content'  => 'text',
                ],
            ]
        );
        
        $repeater->add_control('right_side_template',
		  	[
		     	'label'			=> __( 'Right Template', SA_EL_ADDONS_TEXTDOMAIN ),
		     	'type'          => Controls_Manager::SELECT2,
		     	'options'       => $this->sa_el_get_elementor_page_list(),
		     	'multiple'      => false,
                'condition'     => [
                   'right_content'  => 'temp',
                ],
		  	]
		);
        
        $repeater->add_control('hide_right_section_tabs',
            [
                'label'         => __('Hide on Tabs', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This option works only when multiscroll disabled on tablets', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        
        $repeater->add_control('hide_right_section_mobs',
            [
                'label'         => __('Hide on Mobiles', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This option works only when multiscroll disabled on mobiles', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        
    }

    protected function _register_controls() {
        
        $this->start_controls_section('content_templates',
            [
                'label'         => __('Content', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        
        $this->add_control('template_height_hint',
		  	[
                'label'         => '<span style="line-height: 1.4em;">It\'s recommended that templates be the same height</span>',
		     	'type'          => Controls_Manager::RAW_HTML,
		     	
		  	]
		);
        
        $repeater = new REPEATER();
        
        $this->get_repeater_controls($repeater, array( 'scroll_responsive_tabs' => 'yes' ) );
        
        $this->add_control('left_side_repeater',
           [
               'label'          => __( 'Sections', SA_EL_ADDONS_TEXTDOMAIN ),
               'type'           => Controls_Manager::REPEATER,
               'fields'         => array_values( $repeater->get_controls() ),
           ]
       );
        
        $this->end_controls_section();
        
        $this->start_controls_section('nav_menu',
            [
                'label'     => __('Navigation', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        
        $this->add_control('nav_menu_switch',
            [
                'label'         => __('Navigation Menu', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This option works only on the frontend', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        
        $this->add_control('navigation_menu_pos',
            [
                'label'         => __('Position', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'left'  => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                    'right' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'default'       => 'left',
                'condition'     => [
                    'nav_menu_switch'   => 'yes'
                ]
            ]
        );
        
        $nav_repeater = new REPEATER();
        
        $nav_repeater->add_control('nav_menu_item',
		  	[
		     	'label'			=> __( 'List Item', SA_EL_ADDONS_TEXTDOMAIN ),
		     	'type'          => Controls_Manager::TEXT,
		  	]
		);
        
        $this->add_control('nav_menu_repeater',
           [
               'label'          => __( 'List Items', SA_EL_ADDONS_TEXTDOMAIN ),
               'type'           => Controls_Manager::REPEATER,
               'fields'         => array_values( $nav_repeater->get_controls() ),
               'title_field'    => '{{{ nav_menu_item }}}',
               'condition'      => [
                   'nav_menu_switch'    => 'yes'
               ]
           ]
        );
        
        $this->add_control('navigation_dots',
            [
                'label'         => __('Navigation Dots', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'separator'     => 'before'
                
            ]
        );
        
        $this->add_control('dots_tooltips',
            [
                'label'         => __('Dots Tooltips Text', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'description'   => __('Add text for each navigation dot separated by \',\'',SA_EL_ADDONS_TEXTDOMAIN),
                'condition'     => [
                    'navigation_dots'   => 'yes'
                ]
            ]
        );
        
        $this->add_control('navigation_dots_pos',
            [
                'label'         => __('Dots Horizontal Position', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'left'  => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                    'right' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'default'       => 'right',
                'condition'     => [
                    'navigation_dots'   => 'yes'
                ]
            ]
        );
        
        $this->add_control('navigation_dots_v_pos',
            [
                'label'         => __('Dots Vertical Position', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'top'   => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                    'middle'=> __('Middle', SA_EL_ADDONS_TEXTDOMAIN),
                    'bottom'=> __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'default'       => 'middle',
                'condition'     => [
                    'navigation_dots'   => 'yes'
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('advanced_options',
            [
                'label'     => __('Advanced Settings', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        
        $this->add_control('left_width',
            [
                'label'         => esc_html__('Left Section Width (%)'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => '%',
                'default'       => [
                    'size'  => 50
                ]
            ]
        );
        
        $this->add_control('right_width',
            [
                'label'         => esc_html__('Right Section Width (%)'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => '%',
                'default'       => [
                    'size'  => 50
                ]
            ]
        );
        
        $this->add_control('scroll_container_height',
            [
                'label'         => __('Height', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'fit'   => __('Fit to Screen', SA_EL_ADDONS_TEXTDOMAIN),
                    'min'   => __('Min Height', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'default'       => 'min',
            ]
        );
        
        $this->add_responsive_control('container_min_height',
            [
                'label'         => __('Min Height (px)', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'  => 500
                ],
                'range'         => [
                    'px'    => [
                        'min'   => 1,
                        'max'   => 600
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-multiscroll-inner'    => 'min-height: {{SIZE}}px'
                ],
                'condition'     => [
                    'scroll_container_height'   => 'min'
                ],
            ]
        );
        
        $this->add_control('keyboard_scrolling',
            [
                'label'         => __('Keyboard Scrolling', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'condition'     => [
                    'scroll_container_height'   => 'min'
                ],
            ]
        );
        
        $this->add_control('loop_top',
            [
                'label'         => __('Loop Top', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Defines whether scrolling up in the first section should scroll to the last one or not.',SA_EL_ADDONS_TEXTDOMAIN)
                
            ]
        );
        
        $this->add_control('loop_bottom',
            [
                'label'         => __('Loop Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Defines whether scrolling down in the last section should scroll to the first one or not.',SA_EL_ADDONS_TEXTDOMAIN)
                
            ]
        );
        
        $this->add_control('scroll_speed',
            [
                'label'         => __('Scroll Speed', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::NUMBER,
                'title'         => __('Set scolling speed in seconds, default: 0.7', SA_EL_ADDONS_TEXTDOMAIN),
                'default'       => 0.7,
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-multiscroll-inner .sa-el-scroll-easing'    => '-webkit-transition:all {{VALUE}}s cubic-bezier(0.895, 0.03, 0.685, 0.22); -moz-transition:all {{VALUE}}s cubic-bezier(0.895, 0.03, 0.685, 0.22); -o-transition:all {{VALUE}}s cubic-bezier(0.895, 0.03, 0.685, 0.22); transition:all {{VALUE}}s cubic-bezier(0.895, 0.03, 0.685, 0.22)'
                ]
            ]
        );
        
        $this->add_control('scroll_responsive_tabs',
            [
                'label'         => __('Disable on Tabs', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Disable multiscroll on tabs', SA_EL_ADDONS_TEXTDOMAIN),
                'default'       => 'yes'
            ]
        );
        
        $this->add_control('scroll_responsive_mobs',
            [
                'label'         => __('Disable on Mobiles', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Disable multiscroll on mobile phones', SA_EL_ADDONS_TEXTDOMAIN),
                'default'       => 'yes'
            ]
        );
        
        $this->end_controls_section();

        $this->Sa_El_Support();
        
        $this->start_controls_section('left_side_text',
            [
                'label'     => __('Left Side', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'       => CONTROLS_MANAGER::TAB_STYLE,
            ]
        );
        
        $this->add_control('left_side_background', 
            [
                'label'         => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .ms-left .ms-tableCell' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control('left_text_color', 
            [
                'label'         => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-multiscroll-left-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control('left_text_background', 
            [
                'label'         => __('Text Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-multiscroll-left-text' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'left_text_typography',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .sa-el-multiscroll-left-text',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'left_text_border',
                'selector'      => '{{WRAPPER}} .sa-el-multiscroll-left-text',
            ]
        );

        $this->add_control('left_text_border_radius',
            [
                'label'         => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-multiscroll-left-text' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('left_text_vertical',
            [
                'label'         => __( 'Vertical Position', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'top'      => [
                        'title'=> __( 'Top', SA_EL_ADDONS_TEXTDOMAIN ),
                        'icon' => 'fa fa-long-arrow-up',
                    ],
                    'middle'    => [
                        'title'=> __( 'Middle', SA_EL_ADDONS_TEXTDOMAIN ),
                        'icon' => 'fa fa-align-justify',
                    ],
                    'bottom'     => [
                        'title'=> __( 'Bottom', SA_EL_ADDONS_TEXTDOMAIN ),
                        'icon' => 'fa fa-long-arrow-down',
                    ],
                ],
                'default'       => 'middle',
                'selectors'     => [
                    '{{WRAPPER}} .ms-left .ms-tableCell' => 'vertical-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control('left_text_margin',
            [
                'label'         => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-multiscroll-left-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('left_text_padding',
            [
                'label'         => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-multiscroll-left-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('right_side_text',
            [
                'label'     => __('Right Side', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'       => CONTROLS_MANAGER::TAB_STYLE,
            ]
        );
        
        $this->add_control('right_side_background', 
            [
                'label'         => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .ms-right .ms-tableCell' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control('right_text_color', 
            [
                'label'         => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-multiscroll-right-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control('right_text_background', 
            [
                'label'         => __('Text Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-multiscroll-right-text' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'right_text_typography',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .sa-el-multiscroll-right-text',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'right_text_border',
                'selector'      => '{{WRAPPER}} .sa-el-multiscroll-right-text',
            ]
        );

        $this->add_control('right_text_border_radius',
            [
                'label'         => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-multiscroll-right-text' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('right_text_vertical',
            [
                'label'         => __( 'Vertical Position', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'top'      => [
                        'title'=> __( 'Top', SA_EL_ADDONS_TEXTDOMAIN ),
                        'icon' => 'fa fa-long-arrow-up',
                    ],
                    'middle'    => [
                        'title'=> __( 'Middle', SA_EL_ADDONS_TEXTDOMAIN ),
                        'icon' => 'fa fa-align-justify',
                    ],
                    'bottom'     => [
                        'title'=> __( 'Bottom', SA_EL_ADDONS_TEXTDOMAIN ),
                        'icon' => 'fa fa-long-arrow-down',
                    ],
                ],
                'default'       => 'middle',
                'selectors'     => [
                    '{{WRAPPER}} .ms-right .ms-tableCell' => 'vertical-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control('right_text_margin',
            [
                'label'         => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-multiscroll-right-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('right_text_padding',
            [
                'label'         => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-multiscroll-right-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('navigation_style',
            [
                'label'     => __('Navigation Dots', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'       => CONTROLS_MANAGER::TAB_STYLE,
                'condition' => [
                    'navigation_dots'   => 'yes'
                ]
            ]
        );
        
        $this->start_controls_tabs('navigation_style_tabs');

        $this->start_controls_tab('dots_style_tab',
            [
                'label'         => __('Dots', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        
        $this->add_control('tooltips_color',
            [
                'label'         => __( 'Tooltips Text Color', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value' => Scheme_Color::COLOR_1
                ],
                'selectors'     => [
                    '{{WRAPPER}} .multiscroll-tooltip'  => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation_dots'   => 'yes',
                    'dots_tooltips!'    => ''
                ]
            ]
        );
        
        $this->add_control('tooltips_font',
            [
                'label'         => __( 'Tooltips Text Font', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::FONT,
                'selectors'     => [
                    '{{WRAPPER}} .multiscroll-tooltip'  => 'font-family: {{VALUE}};',
                ],
                'condition' => [
                    'navigation_dots'   => 'yes',
                    'dots_tooltips!'    => ''
                ]
            ]
        );
        
        $this->add_control('dots_color',
            [
                'label'         => __( 'Dots Color', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value' => Scheme_Color::COLOR_1
                ],
                'selectors'     => [
                    '{{WRAPPER}} .multiscroll-nav span'  => 'background-color: {{VALUE}};',
                ]
            ]
        );
        
        $this->add_control('active_dot_color',
            [
                'label'         => __( 'Active Dot Color', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value' => Scheme_Color::COLOR_2
                ],
                'selectors'     => [
                    '{{WRAPPER}} .multiscroll-nav li .active span'  => 'background-color: {{VALUE}};',
                ]
            ]
        );
        
        $this->add_control('dots_border_color',
            [
                'label'         => __( 'Dots Border Color', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_2
                ],
                'selectors'     => [
                    '{{WRAPPER}} .multiscroll-nav span'  => 'border-color: {{VALUE}};',
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('container_style_tab',
            [
                'label'         => __('Container', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        
        $this->add_control('navigation_background',
            [
                'label'         => __( 'Background Color', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_1
                ],
                'selectors'     => [
                    '{{WRAPPER}} .multiscroll-nav'  => 'background-color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_control('navigation_border_radius',
            [
                'label'         => __( 'Border Radius', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .multiscroll-nav'  => 'border-radius: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Shadow',SA_EL_ADDONS_TEXTDOMAIN),
                'name'          => 'navigation_box_shadow',
                'selector'      => '{{WRAPPER}} .multiscroll-nav',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();
        
        $this->start_controls_section('navigation_menu_style',
            [
                'label'     => __('Navigation Menu', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'       => CONTROLS_MANAGER::TAB_STYLE,
                'condition' => [
                    'nav_menu_switch'   => 'yes'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'navigation_items_typography',
                'selector'      => '{{WRAPPER}} .sa-el-scroll-nav-menu .sa-el-scroll-nav-item .sa-el-scroll-nav-link'
            ]
        );
        
        $this->start_controls_tabs('navigation_menu_style_tabs');

        $this->start_controls_tab('normal_style_tab',
            [
                'label'         => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        
        $this->add_control('normal_color',
            [
                'label'         => __( 'Text Color', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_1
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-scroll-nav-menu .sa-el-scroll-nav-item .sa-el-scroll-nav-link'  => 'color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_control('normal_hover_color',
            [
                'label'         => __( 'Text Hover Color', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_1
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-scroll-nav-menu .sa-el-scroll-nav-item .sa-el-scroll-nav-link:hover'  => 'color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_control('normal_background',
            [
                'label'         => __( 'Background Color', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_2
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-scroll-nav-menu .sa-el-scroll-nav-item'  => 'background-color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Shadow',SA_EL_ADDONS_TEXTDOMAIN),
                'name'          => 'normal_shadow',
                'selector'      => '{{WRAPPER}} .sa-el-scroll-nav-menu .sa-el-scroll-nav-item'
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('active_style_tab',
            [
                'label'         => __('Active', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        
        $this->add_control('active_color',
            [
                'label'         => __( 'Text Color', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_2
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-scroll-nav-menu .sa-el-scroll-nav-item.active .sa-el-scroll-nav-link'  => 'color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_control('active_hover_color',
            [
                'label'         => __( 'Text Hover Color', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_2
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-scroll-nav-menu .sa-el-scroll-nav-item.active .sa-el-scroll-nav-link:hover'  => 'color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_control('active_background',
            [
                'label'         => __( 'Background Color', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_1
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-scroll-nav-menu .sa-el-scroll-nav-item.active'  => 'background-color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Shadow',SA_EL_ADDONS_TEXTDOMAIN),
                'name'          => 'active_shadow',
                'selector'      => '{{WRAPPER}} .sa-el-scroll-nav-menu .sa-el-scroll-nav-item.active'
            ]
        );
        
        $this->end_controls_tabs();
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'navigation_items_border',
                'selector'      => '{{WRAPPER}} .sa-el-scroll-nav-menu .sa-el-scroll-nav-item',
                'separator'     => 'before'
            ]
        );

        $this->add_control('navigation_items_border_radius',
            [
                'label'         => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px','em','%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-scroll-nav-menu .sa-el-scroll-nav-item'  => 'border-radius: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        
        $this->add_responsive_control('navigation_items_margin',
            [
                'label'         => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-scroll-nav-menu .sa-el-scroll-nav-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control('navigation_items_padding',
            [
                'label'         => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-scroll-nav-menu .sa-el-scroll-nav-item .sa-el-scroll-nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
    }
    
    protected function render() {
    
        $settings = $this->get_settings_for_display();
    
        $id = $this->get_id();
        
        $navigation_dots = ( 'yes' == $settings['navigation_dots'] ) ? true : false;
        
        $top_loop = ( 'yes' == $settings['loop_top'] ) ? true : false;
        
        $bottom_loop = ( 'yes' == $settings['loop_bottom'] ) ? true : false;
        
        $dots_text = explode(',', $settings['dots_tooltips'] );
        
        $nav_items = $settings['nav_menu_repeater'];
        
        $anchors_arr = array();
        
        if ('yes' == $settings['nav_menu_switch'] ) {
            foreach( $nav_items as $index => $item ) {
                array_push($anchors_arr,'section_' . $index);
            }
        }
        
        $scoll_settings = [
            'dots'          => $navigation_dots,
            'leftWidth'     => !empty( $settings['left_width']['size'] ) ? $settings['left_width']['size'] : 50,
            'rightWidth'    => !empty( $settings['right_width']['size'] ) ? $settings['right_width']['size'] : 50,
            'dotsText'      => $dots_text,
            'dotsPos'       => $settings['navigation_dots_pos'],
            'dotsVPos'      => $settings['navigation_dots_v_pos'],
            'topLoop'       => $top_loop,
            'btmLoop'       => $bottom_loop,
            'anchors'       => $anchors_arr,
            'hideTabs'      => ( $settings['scroll_responsive_tabs'] == 'yes' ) ? true: false,
            'tabSize'       => ( $settings['scroll_responsive_tabs'] == 'yes' ) ? Responsive::get_breakpoints()['lg'] : Responsive::get_breakpoints()['lg'],
            'hideMobs'      => ( $settings['scroll_responsive_mobs'] == 'yes' ) ? true: false,
            'mobSize'       => ( $settings['scroll_responsive_mobs'] == 'yes' ) ? Responsive::get_breakpoints()['md'] : Responsive::get_breakpoints()['md'],
            'cellHeight'    => !empty( $settings['container_min_height']['size'] ) ? $settings['container_min_height']['size'] : 500,
            'fit'           => $settings['scroll_container_height'],
            'keyboard'      => ( $settings['keyboard_scrolling'] == 'yes' ) ? true : false,
            'rtl'           => $this->check_rtl(),
            'id'            => esc_attr( $id )
        ];
        
        $this->add_render_attribute( 'multiscroll_wrapper', 'class', 'sa-el-multiscroll-wrap' );
        
        $this->add_render_attribute( 'multiscroll_inner', 'class', array( 'sa-el-multiscroll-inner', 'sa-el-scroll-' . $settings['scroll_container_height'] ) );
        
        $this->add_render_attribute( 'multiscroll_inner', 'id', 'sa-el-multiscroll-' . $id );
        
        $this->add_render_attribute( 'multiscroll_menu', 'id', 'sa-el-scroll-nav-menu-' . $id );
        
        $this->add_render_attribute( 'multiscroll_menu', 'class', array( 'sa-el-scroll-nav-menu', 'sa-el-scroll-responsive', $settings['navigation_menu_pos'] ) );
        
        $this->add_render_attribute('right_template', 'class', [ 'sa-el-multiscroll-temp', 'sa-el-multiscroll-right-temp', 'sa-el-multiscroll-temp-' . $id ] );
        
        $this->add_render_attribute('left_template', 'class', [ 'sa-el-multiscroll-temp', 'sa-el-multiscroll-left-temp', 'sa-el-multiscroll-temp-' . $id ] );
        
        $this->add_render_attribute('left_side', 'class', 'sa-el-multiscroll-left-' . $id );
        
        $this->add_render_attribute('right_side', 'class', 'sa-el-multiscroll-right-' . $id );
        
        $this->add_inline_editing_attributes('left_side_text', 'advanced');
        
        $this->add_inline_editing_attributes('right_side_text', 'advanced');
        
        $this->add_render_attribute('left_side_text', 'class', 'sa-el-multiscroll-left-text');
        
        $this->add_render_attribute('right_side_text', 'class', 'sa-el-multiscroll-right-text');

        $templates = $settings['left_side_repeater'];
        
        ?>
        
        <div <?php echo $this->get_render_attribute_string('multiscroll_wrapper'); ?> data-settings='<?php echo wp_json_encode($scoll_settings); ?>'>
            <?php if ('yes' == $settings['nav_menu_switch'] ) : ?>
                <ul <?php echo $this->get_render_attribute_string('multiscroll_menu'); ?>>
                    <?php foreach( $nav_items as $index => $item ) : ?>
                        <li data-menuanchor="<?php echo 'section_' . $index; ?>" class="sa-el-scroll-nav-item"><a class="sa-el-scroll-nav-link" href="<?php echo '#section_' . $index; ?>"><?php echo $item['nav_menu_item'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div <?php echo $this->get_render_attribute_string('multiscroll_inner'); ?>>
                <div <?php echo $this->get_render_attribute_string('left_side'); ?>>
                    <?php foreach( $templates as $index => $section ) :
                        if('yes' == $section['hide_left_section_tabs'] ) {
                            $this->add_render_attribute('left_section' . $index , 'data-hide-tabs', true);
                        }
                        if( 'yes' == $section['hide_left_section_mobs'] ) {
                            $this->add_render_attribute('left_section' . $index , 'data-hide-mobs', true);
                        }
                    ?>
                    <div <?php echo $this->get_render_attribute_string('left_template') . $this->get_render_attribute_string('left_section' . $index ); ?>>
                        <?php
                            if('temp' == $section['left_content'] ) :
                                $template = $section['left_side_template'];
                                echo $this->sa_el_get_template_content( $template );
                            else :
                        ?>
                            <div <?php echo $this->get_render_attribute_string('left_side_text'); ?>>
                                <?php echo $section['left_side_text'] ?>
                            </div>
                        <?php
                            endif;
                        ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div <?php echo $this->get_render_attribute_string('right_side'); ?>>
                    <?php foreach( $templates as $index => $section ) :
                        if('yes' == $section['hide_right_section_tabs'] ) {
                            $this->add_render_attribute('right_section' . $index , 'data-hide-tabs', true);
                        }
                        if( 'yes' == $section['hide_right_section_mobs'] ) {
                            $this->add_render_attribute('right_section' . $index , 'data-hide-mobs', true);
                        }
                    ?>
                    <div <?php echo $this->get_render_attribute_string('right_template') . $this->get_render_attribute_string('right_section' . $index ); ?>>
                        <?php 
                            if('temp' == $section['right_content'] ) :
                                $template = $section['right_side_template'];
                                echo $this->sa_el_get_template_content( $template );
                            else : 
                        ?>
                            <div <?php echo $this->get_render_attribute_string('right_side_text'); ?>>
                                <?php echo $section['right_side_text'] ?>
                            </div>
                        <?php
                            endif;
                        ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <?php
        
    }
    
}