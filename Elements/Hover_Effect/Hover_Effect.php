<?php

namespace SA_EL_ADDONS\Elements\Hover_Effect;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Css_Filter;

class Hover_Effect extends Widget_Base
{
    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name()
    {
        return 'sa_el_hover_effect';
    }

    public function get_title()
    {
        return esc_html__('Hover Effect', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-flip-box oxi-el-admin-icon';
    }

    public function get_categories()
    {
        return ['sa-el-addons'];
    }

    protected function _register_controls()
    {
        
        $this->start_controls_section('sa_el_hover_effect_image_content_section',
            [
                'label'         => __('Image',SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control('sa_el_hover_effect_thumbnail_front_image',
            [
                'label'         => __( 'Choose Image', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::MEDIA,
                'dynamic'       => [ 'active' => true ],
                'default'       => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block'   => true
            ]
        );
        
        $this->add_responsive_control('sa_el_hover_effect_thumbnail_size',
            [
                'label'         => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 500
                    ],
                    'em'    => [
                        'min'   => 0,
                        'max'   => 20
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-item.style20 .sa-el-hover-effect-spinner, {{WRAPPER}} .sa-el-hover-effect-item, {{WRAPPER}} .sa-el-hover-effect-img-wrap, {{WRAPPER}} .sa-el-hover-effect-img-wrap .sa-el-hover-effect-img, {{WRAPPER}} .sa-el-hover-effect-info-wrap' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_control('sa_el_hover_effect_container_border_radius',
            [
                'label'         => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-item-wrap, {{WRAPPER}} .sa-el-hover-effect-img, {{WRAPPER}} .sa-el-hover-effect-info-back, {{WRAPPER}} .sa-el-hover-effect-spinner' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_control('sa_el_hover_effect_thumbnail_hover_effect',
            [
                'label'         => __( 'Hover Effect', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'style18',
                'options'       => [
                    'style18'       => 'Advertising',
                    'style19'       => 'Book Cover',
                    'style10'       => 'Backward',
                    'style15'       => 'Faded In Background',
                    'style17'       => 'Flash Rotation',
                    'style4'        => 'Flip Background',
                    'style16'       => 'Flip Door',
                    'style9'        => 'Heroes Flying-Top',
                    'style9-1'      => 'Heroes Flying-Bottom',
                    'style9-2'      => 'Heroes Flying-Right',
                    'style14'       => 'Magic Door',
                    'style2'        => 'Reduced Image-Top',
                    'style2-2'      => 'Reduced Image-Right',
                    'style6'        => 'Reduced Image-Bottom',
                    'style2-1'      => 'Reduced Image-Left',
                    'style7'        => 'Rotated Image-Left',
                    'style7-1'      => 'Rotated Image-Right',
                    'style13'       => 'Rotated Wheel Image-Left',
                    'style8'        => 'Rotating Wheel-Left',
                    'style8-1'      => 'Rotating Wheel-Top',
                    'style8-2'      => 'Rotating Wheel-Bottom',
                    'style8-3'      => 'Rotating Wheel-Right',
                    'style1'        => 'Rotor Cube',
                    'style11'       => 'Slided Out Image',
                    'style12'       => 'Slided In Image',
                    'style20'       => 'Spinner',
                    'style5'        => 'Zoom In ',
                    'style5-1'      => 'Zoom Out'
                ],
                'label_block'   => true,
            ]
        );
         
        $this->add_control('sa_el_hover_effect_thumbnail_link_switcher',
            [
                'label'         => __('Link', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Add a custom link or select an existing page link',SA_EL_ADDONS_TEXTDOMAIN)
            ]
        );

        $this->add_control('sa_el_hover_effect_thumbnail_link_type', 
            [
                'label'         => __('Link/URL', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'url'   => __('URL', SA_EL_ADDONS_TEXTDOMAIN),
                    'link'  => __('Existing Page', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'default'       => 'url',
                'condition'     => [
                   'sa_el_hover_effect_thumbnail_link_switcher'  => 'yes',
                ],
                'label_block'   => true,
            ]
        );

        $this->add_control('sa_el_hover_effect_thumbnail_existing_page', 
            [
                'label'         => __('Existing Page', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SELECT2,
                'options'       => $this->sa_el_get_all_post(),
                'condition'     => [
                   'sa_el_hover_effect_thumbnail_link_switcher'  => 'yes',
                    'sa_el_hover_effect_thumbnail_link_type'     => 'link',
                ],
                'multiple'      => false,
                'label_block'   => true,
            ]
        );

        $this->add_control('sa_el_hover_effect_thumbnail_url',
            [
                'label'         => __('URL', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::URL,
                'dynamic'       => [ 'active' => true ],
                'placeholder'   => 'https://elementoraddons.com/',
                'default'       => [
                  'url'     => '#'
                ],
                'condition'     => [
                    'sa_el_hover_effect_thumbnail_link_switcher'  => 'yes',
                    'sa_el_hover_effect_thumbnail_link_type'     => 'url',
                ],
                'label_block'   => true
            ]
        );

        $this->add_control('sa_el_hover_effect_thumbnail_link_text',
            [
                'label'         => __('Link Title', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                    'sa_el_hover_effect_thumbnail_link_switcher' => 'yes',
                ],
                'label_block'   => true
            ]
        );

        $this->add_responsive_control('sa_el_hover_effect_thumbnail_alignment', 
            [
                'label'         => __('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'  => [
                        'title'     => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon'      => 'fa fa-align-left'
                    ],
                    'center'=> [
                        'title'     => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon'      => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title'     => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon'      => 'fa fa-align-right'
                    ],
                ],
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-list' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'sa_el_hover_effect_css_classes',
            [
                'label'         => __( 'CSS Classes', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'label_block'   => true,
                'title'         => __( 'Add your custom class without the dot. e.g: my-class', SA_EL_ADDONS_TEXTDOMAIN )
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section('sa_el_hover_effect_description_content_section',
            [
                'label'         => __('Content',SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );
        
        $this->add_control('sa_el_hover_effect_icon_fa_switcher',
            [
                'label'         => __('Icon', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
            ]
        );
        
        $this->add_control('sa_el_hover_effect_icon_selection',
            [
                'label'         => __('Icon Type', SA_EL_ADDONS_TEXTDOMAIN),
                'description'   => __('Select type for the icon', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'icon',
                'options'       => [
                    'icon'  => __('Font Awesome Icon',SA_EL_ADDONS_TEXTDOMAIN),
                    'image' => __('Custom Image',SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'label_block'   =>  true,
                'condition'     => [
                    'sa_el_hover_effect_icon_fa_switcher' => 'yes',
                ],
            ]
        );
        
        $this->add_control('sa_el_hover_effect_icon_fa_updated', 
            [
                'label'         => __('Icon', SA_EL_ADDONS_TEXTDOMAIN),
                'description'   => __( 'Choose an Icon for Front Side', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::ICONS,
                'fa4compatibility'  => 'sa_el_hover_effect_icon_fa',
                'default' => [
                    'value'     => 'fas fa-star',
                    'library'   => 'fa-solid',
                ],
                'label_block'   => true,
                'condition'     => [
                    'sa_el_hover_effect_icon_fa_switcher' => 'yes',
                    "sa_el_hover_effect_icon_selection"   => 'icon'
                ],
            ]
        );
        
        $this->add_control('sa_el_hover_effect_icon_image',
            [
                'label'         => __('Image', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::MEDIA,
                'default'       => [
                    'url'   => Utils::get_placeholder_image_src(),
                    ],
                'description'   => __('Choose the icon image', SA_EL_ADDONS_TEXTDOMAIN ),
                'label_block'   => true,
                'condition'     => [
                    'sa_el_hover_effect_icon_fa_switcher' => 'yes',
                    "sa_el_hover_effect_icon_selection"   => 'image'
                ]
            ]
        );

        $this->add_control('sa_el_hover_effect_icon_size',
            [
                'label'         => __('Icon Size', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px','em','%'],
                'default'       => [
                    'size'  => 30,
                ],
                'range'         => [
                    'px'    => [
                        'min' => 5,
                        'max' => 80
                    ],
                ],
                'selectors'         => [
                    '{{WRAPPER}} .sa-el-hover-effect-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sa-el-hover-effect-icon-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition'      => [
                    'sa_el_hover_effect_icon_fa_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control('sa_el_hover_effect_thumbnail_back_title_switcher', 
            [
                'label'         => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable/Disable Title',SA_EL_ADDONS_TEXTDOMAIN),
                'default'       => 'yes',
            ]
        );

        $this->add_control('sa_el_hover_effect_thumbnail_back_title',
            [
                'label'         => __( 'Text', SA_EL_ADDONS_TEXTDOMAIN ),
                'placeholder'   => __( 'Awesome Title', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'dynamic'       => [
                    'active'        => true,
                ],
                'default'       => __( 'Awesome Title', SA_EL_ADDONS_TEXTDOMAIN ),
                'condition'     => [
                   'sa_el_hover_effect_thumbnail_back_title_switcher'  => 'yes',
                ],
                'label_block'   => false
            ]
        );

         $this->add_control('sa_el_hover_effect_thumbnail_back_title_tag',
            [
                'label'         => __( 'HTML Tag', SA_EL_ADDONS_TEXTDOMAIN ),
                'description'   => __( 'Select a heading tag for the title. Headings are defined with H1 to H6 tags', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'h4',
                'options'       => [
                    'h1'    => 'H1',
                    'h2'    => 'H2',
                    'h3'    => 'H3',
                    'h4'    => 'H4',
                    'h5'    => 'H5',
                    'h6'    => 'H6'
                ],
                'condition'     => [
                   'sa_el_hover_effect_thumbnail_back_title_switcher'  => 'yes',
                ],
                'label_block'   => true,
            ]
        );

        $this->add_control('sa_el_hover_effect_thumbnail_back_separator_switcher', 
            [
                'label'         => __('Separator', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable/Disable Separator',SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control('sa_el_hover_effect_thumbnail_back_description_switcher', 
            [
                'label'         => __('Description', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable/Disable Description',SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control('sa_el_hover_effect_thumbnail_back_description',
            [
                'label'         => __( 'Text', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::WYSIWYG,
                'dynamic'       => [ 'active' => true ],
                'default'       => __( 'Cool Description', SA_EL_ADDONS_TEXTDOMAIN ),
                'condition'     => [
                   'sa_el_hover_effect_thumbnail_back_description_switcher'  => 'yes',
                ],
                'dynamic'       => [
                    'active'    => true
                ],
                'label_block'   => true
            ]
        );

        /** Description Alignment **/
        $this->add_control('sa_el_hover_effect_description_alignment_content', 
            [
                'label'         => __('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'  => [
                        'title'     => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon'      => 'fa fa-align-left'
                    ],
                    'center'=> [
                        'title'     => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon'      => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title'     => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon'      => 'fa fa-align-right'
                    ],
                ],
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-content-wrap' => 'text-align: {{VALUE}}'
                ]
            ]
        );


        $this->end_controls_section();

        $this->Sa_El_Support();
        
        $this->start_controls_section('sa_el_hover_effect_front_image',
            [
                'label'         => __( 'Front Image', SA_EL_ADDONS_TEXTDOMAIN ),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .sa-el-hover-effect-img',
			]
		);
        
        $this->end_controls_section();
        
        $this->start_controls_section('sa_el_hover_effect_icon_style_section',
            [
                'label'         => __( 'Icon', SA_EL_ADDONS_TEXTDOMAIN ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'sa_el_hover_effect_icon_fa_switcher'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('sa_el_hover_effect_fa_color_selection',
            [
                'label'         => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'default' => '#ffffff',
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-icon' => 'color: {{VALUE}};',
                ],
                'condition'     => [
                    'sa_el_hover_effect_icon_selection'   => 'icon'
                ]
            ]
        );
        
        $this->add_control('sa_el_hover_effect_icon_background',
            [
                'label'         => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-icon, {{WRAPPER}} .sa-el-hover-effect-icon-image'    => 'background: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'sa_el_hover_effect_icon_border',
                'selector'      => '{{WRAPPER}} .sa-el-hover-effect-icon,{{WRAPPER}} .sa-el-hover-effect-icon-image',
            ]
        );
        
        $this->add_control('sa_el_hover_effect_icon_border_radius',
            [
                'label'         => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px','em','%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-icon, {{WRAPPER}} .sa-el-hover-effect-icon-image'  => 'border-radius: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'label'         => __('Shadow',SA_EL_ADDONS_TEXTDOMAIN),
                'name'          => 'sa_el_hover_effect_icon_shadow',
                'selector'      => '{{WRAPPER}} .sa-el-hover-effect-icon, {{WRAPPER}} .sa-el-hover-effect-icon-image',
                'condition'     => [
                    'sa_el_hover_effect_icon_selection'   => 'icon'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Shadow',SA_EL_ADDONS_TEXTDOMAIN),
                'name'          => 'sa_el_hover_effect_image_shadow',
                'selector'      => '{{WRAPPER}} .sa-el-hover-effect-icon-image',
                'condition'     => [
                    'sa_el_hover_effect_icon_selection'   => 'image'
                ]
            ]
        );

        $this->add_responsive_control('sa_el_hover_effect_icon_margin',
            [
                'label'         => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-icon , {{WRAPPER}} .sa-el-hover-effect-icon-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control('sa_el_hover_effect_icon_padding',
            [
                'label'         => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-icon, {{WRAPPER}} .sa-el-hover-effect-icon-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('sa_el_hover_effect_title_style_section',
            [
                'label'         => __( 'Title', SA_EL_ADDONS_TEXTDOMAIN ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'sa_el_hover_effect_thumbnail_back_title_switcher'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('sa_el_hover_effect_thumbnail_title_color',
            [
                'label'         => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'default' => '#ffffff',
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'sa_el_hover_effect_thumbnail_title_typhography',
                'selector'      => '{{WRAPPER}} .sa-el-hover-effect-title'
            ]
        );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'sa_el_hover_effect_thumbnail_title_text_shadow',
                'selector'      => '{{WRAPPER}} .sa-el-hover-effect-title'
            ]
        );

        $this->add_responsive_control('sa_el_hover_effect_thumbnail_title_margin',
            [
                'label'         => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('sa_el_hover_effect_thumbnail_title_padding',
            [
                'label'         => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('sa_el_hover_effect_thumbnail_divider_style_tab',
            [
                'label'         => __('Separator', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                   'sa_el_hover_effect_thumbnail_back_separator_switcher'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('sa_el_hover_effect_thumbnail_divider_color',
            [
                'label'         => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-divider .sa-el-hover-effect-divider-line' => 'border-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control('sa_el_hover_effect_thumbnail_divider_type',
            [
                'label'         => __( 'Style', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'none'          => __( 'None', SA_EL_ADDONS_TEXTDOMAIN ),
                    'solid'         => __( 'Solid', SA_EL_ADDONS_TEXTDOMAIN ),
                    'double'        => __( 'Double', SA_EL_ADDONS_TEXTDOMAIN ),
                    'dotted'        => __( 'Dotted', SA_EL_ADDONS_TEXTDOMAIN ),
                ],
                'default'       =>'solid',
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-divider .sa-el-hover-effect-divider-line' => 'border-style: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_responsive_control('sa_el_hover_effect_thumbnail_divider_width',
            [
                'label'         => __('Width', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'description'   => __('Enter Separator width in (PX, EM, %), default is 100%', SA_EL_ADDONS_TEXTDOMAIN),
                'size_units'    => ['px', 'em' , '%'],
                'range'         => [
                    'px'    => [
                        'min'       => 0,
                        'max'       => 450
                    ],
                    'em'    => [
                        'min'       => 0,
                        'max'       => 30
                    ]
                ],
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-divider .sa-el-hover-effect-divider-line' => 'border-width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('sa_el_hover_effect_thumbnail_divider_height',
            [
                'label'         => __('Height', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em'],
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-divider' => 'height:{{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'sa_el_hover_effect_thumbnail_divider_box_shadow',
                'selector'      => '{{WRAPPER}} .sa-el-hover-effect-divider'
            ]
        );

        $this->add_responsive_control('sa_el_hover_effect_thumbnail_divider_margin',
            [
                'label'         => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section('sa_el_hover_effect_thumbnail_description_style_tab',
            [
                'label'         => __('Description', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                   'sa_el_hover_effect_thumbnail_back_description_switcher'  => 'yes'
                ]
            ]
        );

        $this->add_control('sa_el_hover_effect_thumbnail_description_color',
            [
                'label'         => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-description' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'sa_el_hover_effect_thumbnail_description_typhography',
                'selector'      => '{{WRAPPER}} .sa-el-hover-effect-description'
            ]
        );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'sa_el_hover_effect_thumbnail_description_text_shadow',
                'selector'      => '{{WRAPPER}} .sa-el-hover-effect-description'
            ]
        );

        $this->add_responsive_control('sa_el_hover_effect_thumbnail_description_margin',
            [
                'label'         => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('sa_el_hover_effect_thumbnail_description_padding',
            [
                'label'         => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section('sa_el_hover_effect_thumbnail_spinner_style_section',
            [
                'label'         => __( 'Spinner', SA_EL_ADDONS_TEXTDOMAIN ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                   'sa_el_hover_effect_thumbnail_hover_effect'  => 'style20'
                ]
            ]
        );

        $this->add_control('sa_el_hover_effect_thumbnail_spinner_type',
            [
                'label'         => __( 'Style', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'none'          => __( 'None', SA_EL_ADDONS_TEXTDOMAIN ),
                    'solid'         => __( 'Solid', SA_EL_ADDONS_TEXTDOMAIN ),
                    'double'        => __( 'Double', SA_EL_ADDONS_TEXTDOMAIN ),
                    'dotted'        => __( 'Dotted', SA_EL_ADDONS_TEXTDOMAIN ),
                    'dashed'        => __( 'Dashed', SA_EL_ADDONS_TEXTDOMAIN ),
                    'groove'        => __( 'Groove', SA_EL_ADDONS_TEXTDOMAIN )
                ],
                'default'       =>'solid',
                'condition'     => [
                   'sa_el_hover_effect_thumbnail_hover_effect'  => 'style20'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-item.style20 .sa-el-hover-effect-spinner' => 'border-style: {{VALUE}};'
                ]
            ]
        );

        $this->add_control('sa_el_hover_effect_thumbnail_spinner_border_width',
            [
                'label'         => __('Border Width', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'condition'     => [
                   'sa_el_hover_effect_thumbnail_hover_effect'  => 'style20'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-item.style20 .sa-el-hover-effect-spinner' => 'border-width:{{SIZE}}{{UNIT}};'
                ]
            ]    
        );

        $this->add_control('sa_el_hover_effect_thumbnail_spinner_border_left_color',
            [
                'label'         => __('First Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition'     => [
                   'sa_el_hover_effect_thumbnail_hover_effect'  => 'style20'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-spinner' => 'border-top-color: {{VALUE}}; border-left-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control('sa_el_hover_effect_thumbnail_spinner_border_right_color',
            [
                'label'         => __('Second Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'condition'     => [
                   'sa_el_hover_effect_thumbnail_hover_effect'  => 'style20'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-spinner' => 'border-bottom-color: {{VALUE}};border-right-color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_hover_effect_container_style_section',
            [
                'label'         => __( 'Container', SA_EL_ADDONS_TEXTDOMAIN ),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control('sa_el_hover_effect_thumbnail_background_color',
            [
                'label'         => __('Overlay Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-info-back' => 'background: {{VALUE}} !important;'
                ]
            ]
        );
        
        $this->add_control('sa_el_hover_effect_container_background',
            [
                'label'         => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-item-wrap' => 'background: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'sa_el_hover_effect_container_border',
                'selector'      => '{{WRAPPER}} .sa-el-hover-effect-item-wrap',
                'condition'     => [
                   'sa_el_hover_effect_thumbnail_hover_effect!'  => 'style20'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'sa_el_hover_effect_container_box_shadow',
                'selector'      => '{{WRAPPER}} .sa-el-hover-effect-img',
            ]
        );

        
        $this->add_responsive_control('sa_el_hover_effect_container_margin',
            [
                'label'         => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-item-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('sa_el_hover_effect_container_padding',
            [
                'label'         => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-hover-effect-item-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();
        
    }
    
    /**
     * renders the HTML content of the link
     * @return void
     */
    protected function get_link( $settings ) {
        
        $ihover_link_type = $settings['sa_el_hover_effect_thumbnail_link_type'];
        
        if ( 'url' == $ihover_link_type ) {
            $link_url = $settings['sa_el_hover_effect_thumbnail_url']['url'];
        } elseif ( 'link' == $ihover_link_type ) {
            $link_url = get_permalink( $settings['sa_el_hover_effect_thumbnail_existing_page' ]);
        }
        
        $this->add_render_attribute('link', 'class', 'sa-el-hover-effect-item-link');
        
        $this->add_render_attribute('link', 'href', $link_url );
        
        $this->add_render_attribute('link', 'title', $settings['sa_el_hover_effect_thumbnail_link_text'] );
        
        if( ! empty( $settings['sa_el_hover_effect_thumbnail_url']['is_external'] ) ) {
            $this->add_render_attribute('link', 'target', '_blank' );
        }
        
        if( ! empty( $settings['sa_el_hover_effect_thumbnail_url']['nofollow'] ) ) {
            $this->add_render_attribute('link', 'rel', 'nofollow' );
        }
        
        ?>
            <a <?php echo $this->get_render_attribute_string('link'); ?>>
        <?php 
    
    }


    /**
     * renders the HTML content of the widget
     * @return void
     */
    protected function render(){
        
        $settings = $this->get_settings_for_display();
        
        $this->add_render_attribute('container', 'class', [ 'sa-el-hover-effect-container', $settings['sa_el_hover_effect_css_classes'] ] );
        
        $ihover_title_tag = $settings['sa_el_hover_effect_thumbnail_back_title_tag'];
        
        $this->add_inline_editing_attributes('title', 'basic');
        
        $this->add_render_attribute('title', 'class', 'sa-el-hover-effect-title');
        
        $this->add_inline_editing_attributes('description', 'advanced');
        
        $this->add_render_attribute('description', 'class', 'sa-el-hover-effect-description');
        
        $this->add_render_attribute('item', 'class', [ 'sa-el-hover-effect-item', $settings['sa_el_hover_effect_thumbnail_hover_effect' ] ] );
        
        $this->add_render_attribute('img', 'class', 'sa-el-hover-effect-img' );
        
        $this->add_render_attribute('img', 'src', $settings['sa_el_hover_effect_thumbnail_front_image' ]['url'] );
        
        if( 'yes' == $settings['sa_el_hover_effect_icon_fa_switcher'] && 'icon' == $settings['sa_el_hover_effect_icon_selection'] ) {
            if ( ! empty ( $settings['sa_el_hover_effect_icon_fa'] ) ) {
                $this->add_render_attribute( 'icon', 'class', array(
                    'sa-el-hover-effect-icon',
                    $settings['sa_el_hover_effect_icon_fa']
                ));
                $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
            }
        
            $migrated = isset( $settings['__fa4_migrated']['sa_el_hover_effect_icon_fa_updated'] );
            $is_new = empty( $settings['sa_el_hover_effect_icon_fa'] ) && Icons_Manager::is_migration_allowed();
        }
        
        ?>
        <div <?php echo $this->get_render_attribute_string('container'); ?>>
            <div class="sa-el-hover-effect-list">
                <div class="sa-el-hover-effect-item-wrap">
                <?php 
                    if ( 'yes' == $settings['sa_el_hover_effect_thumbnail_link_switcher'] ) :
                        echo $this->get_link($settings);
                    endif; 
                ?>
                    <div <?php echo $this->get_render_attribute_string('item'); ?>>
                        <?php if( 'style20' == $settings['sa_el_hover_effect_thumbnail_hover_effect'] ) { ?>
                            <div class="sa-el-hover-effect-spinner"></div>
                        <?php } ?>
                        <div class="sa-el-hover-effect-img-wrap">
                            <div class="sa-el-hover-effect-img-front">
                                <div class="sa-el-hover-effect-img-inner-wrap"></div>
                                <img <?php echo $this->get_render_attribute_string('img'); ?>>
                            </div>
                        </div>
                        <div class="sa-el-hover-effect-info-wrap">
                            <div class="sa-el-hover-effect-info-back">
                                <div class="sa-el-hover-effect-content">
                                    <div class="sa-el-hover-effect-content-wrap">
                                        <div class="sa-el-hover-effect-title-wrap">
                                            <?php if( 'yes' == $settings['sa_el_hover_effect_icon_fa_switcher'] && 'icon' == $settings['sa_el_hover_effect_icon_selection'] ) :
                                            if ( $is_new || $migrated ) :
                                                Icons_Manager::render_icon( $settings['sa_el_hover_effect_icon_fa_updated'], ['class' => 'sa-el-hover-effect-icon', 'aria-hidden' => 'true' ] );
                                            else: ?>
                                                <i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
                                            <?php endif;
                                            elseif( 'yes' == $settings['sa_el_hover_effect_icon_fa_switcher'] && 'image' == $settings['sa_el_hover_effect_icon_selection'] ) : ?>
                                                <img alt="Hover Effect Image" class="sa-el-hover-effect-icon-image" src="<?php echo $settings['sa_el_hover_effect_icon_image']['url']; ?>">
                                            <?php endif; ?>
                                        
                                        
                                        <?php if( 'yes' == $settings['sa_el_hover_effect_thumbnail_back_title_switcher'] ) : ?>
                                            <<?php echo $ihover_title_tag . ' ' . $this->get_render_attribute_string('title'); ?>><?php echo  ( $settings['sa_el_hover_effect_thumbnail_back_title'] ); ?></<?php echo $ihover_title_tag; ?>>
                                        <?php endif; ?>
                                            
                                        </div>
                                        
                                        <?php if( 'yes' == $settings['sa_el_hover_effect_thumbnail_back_separator_switcher'] ) : ?>
                                            <div class="sa-el-hover-effect-divider"><span class="sa-el-hover-effect-divider-line"></span></div>
                                        <?php endif; ?>
                                            
                                        <?php if( 'yes' == $settings['sa_el_hover_effect_thumbnail_back_description_switcher'] ) : ?>
                                            
                                        <div <?php echo $this->get_render_attribute_string('description'); ?>><?php echo $settings['sa_el_hover_effect_thumbnail_back_description']; ?></div>
                                        
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if ( 'yes' == $settings['sa_el_hover_effect_thumbnail_link_switcher'] ) :
                            echo '</a>';
                        endif; 
                    ?>
                </div>
            </div>  
        </div>
    <?php 
    }
    
    
}