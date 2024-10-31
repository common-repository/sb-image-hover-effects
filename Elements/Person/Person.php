<?php

namespace SA_EL_ADDONS\Elements\Person;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;

class Person extends Widget_Base
{

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name()
    {
        return 'sa_el_person';
    }

    public function get_title()
    {
        return esc_html__('Person', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-person  oxi-el-admin-icon';
    }

    public function get_categories()
    {
        return ['sa-el-addons'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'sa_el_person_general_settings',
            [
                'label'         => __('Image', SA_EL_ADDONS_TEXTDOMAIN)
            ]
        );

        /*Person Image*/
        $this->add_control(
            'sa_el_person_image',
            [
                'label'         => __('Image', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::MEDIA,
                'dynamic'       => ['active' => true],
                'default'       => [
                    'url'    => Utils::get_placeholder_image_src()
                ],
                'label_block'   => true
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_responsive_control(
            'sa_el_person_image_width',
            [
                'label'         => __('Width', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'description'   => __('Enter image width in (PX, EM, %), default is 100%', SA_EL_ADDONS_TEXTDOMAIN),
                'size_units'    => ['px', 'em', '%'],
                'range'         => [
                    'px'    => [
                        'min'       => 1,
                        'max'       => 800,
                    ],
                    'em'    => [
                        'min'       => 1,
                        'max'       => 50,
                    ],
                ],
                'default'       => [
                    'unit'  => '%',
                    'size'  => '100',
                ],
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-person-container' => 'width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'sa_el_person_align',
            [
                'label'         => __('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'flex-start'      => [
                        'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center'    => [
                        'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end'     => [
                        'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .elementor-widget-container' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        /*Hover Image Effect*/
        $this->add_control(
            'sa_el_person_hover_image_effect',
            [
                'label'         => __('Hover Effect', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'none'          => __('None', SA_EL_ADDONS_TEXTDOMAIN),
                    'zoomin'        => __('Zoom In', SA_EL_ADDONS_TEXTDOMAIN),
                    'zoomout'       => __('Zoom Out', SA_EL_ADDONS_TEXTDOMAIN),
                    'scale'         => __('Scale', SA_EL_ADDONS_TEXTDOMAIN),
                    'grayscale'     => __('Grayscale', SA_EL_ADDONS_TEXTDOMAIN),
                    'blur'          => __('Blur', SA_EL_ADDONS_TEXTDOMAIN),
                    'bright'        => __('Bright', SA_EL_ADDONS_TEXTDOMAIN),
                    'sepia'         => __('Sepia', SA_EL_ADDONS_TEXTDOMAIN),
                    'trans'         => __('Translate', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'default'       => 'zoomin',
                'label_block'   => true
            ]
        );

        $this->end_controls_section();

        /*Start Person Details Section*/
        $this->start_controls_section(
            'sa_el_person_person_details_section',
            [
                'label'         => __('Person', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        /*Person Name*/
        $this->add_control(
            'sa_el_person_name',
            [
                'label'         => __('Name', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => ['active' => true],
                'default'       => 'John Frank',
                'label_block'   => true,
            ]
        );

        /*Name Tag*/
        $this->add_control(
            'sa_el_person_name_heading',
            [
                'label'         => __('HTML Tag', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'h2',
                'options'       => [
                    'h1'    => 'H1',
                    'h2'    => 'H2',
                    'h3'    => 'H3',
                    'h4'    => 'H4',
                    'h5'    => 'H5',
                    'h6'    => 'H6',
                ],
                'label_block'   =>  true,
            ]
        );

        /*Person Title*/
        $this->add_control(
            'sa_el_person_title',
            [
                'label'         => __('Job Title', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => ['active' => true],
                'default'       => __('Senior Developer', SA_EL_ADDONS_TEXTDOMAIN),
                'label_block'   => true,
            ]
        );

        /*Title Tag*/
        $this->add_control(
            'sa_el_person_title_heading',
            [
                'label'         => __('HTML Tag', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'h4',
                'options'       => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6'
                ],
                'label_block'   =>  true,
            ]
        );

        $this->add_control(
            'sa_el_person_content',
            [
                'label'         => __('Description', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::WYSIWYG,
                'dynamic'       => ['active' => true],
                'default'       => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ullamcorper nulla non metus auctor fringilla', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        /*Text Align*/
        $this->add_responsive_control(
            'sa_el_person_text_align',
            [
                'label'         => __('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'      => [
                        'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center'    => [
                        'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right'     => [
                        'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-person-info' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        /*End Person Details Section*/
        $this->end_controls_section();

        /*Start Social Links Section*/
        $this->start_controls_section(
            'sa_el_person_social_section',
            [
                'label'         => __('Social Icons', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'sa_el_person_social_enable',
            [
                'label'         => __('Enable Social Icons', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
            ]
        );

        /*Person Facebook*/
        $this->add_control(
            'sa_el_person_facebook',
            [
                'label'         => __('Facebook', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => ['active' => true],
                'default'       => '#',
                'label_block'   => true,
                'condition'     => [
                    'sa_el_person_social_enable'  => 'yes'
                ]
            ]
        );

        /*Person Twitter*/
        $this->add_control(
            'sa_el_person_twitter',
            [
                'label'         => __('Twitter', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => ['active' => true],
                'default'       => '#',
                'label_block'   => true,
                'condition'     => [
                    'sa_el_person_social_enable'  => 'yes'
                ]
            ]
        );

        /*Person Linkedin*/
        $this->add_control(
            'sa_el_person_linkedin',
            [
                'label'         => __('LinkedIn', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => ['active' => true],
                'default'       => '#',
                'label_block'   => true,
                'condition'     => [
                    'sa_el_person_social_enable'  => 'yes'
                ]
            ]
        );

        /*Person Google*/
        $this->add_control(
            'sa_el_person_google',
            [
                'label'         => __('Google+', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => ['active' => true],
                'default'       => '#',
                'label_block'   => true,
                'condition'     => [
                    'sa_el_person_social_enable'  => 'yes'
                ]
            ]
        );

        /*Person Youtube*/
        $this->add_control(
            'sa_el_person_youtube',
            [
                'label'         => __('Youtube', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => ['active' => true],
                'label_block'   => true,
                'condition'     => [
                    'sa_el_person_social_enable'  => 'yes'
                ]
            ]
        );

        /*Person Instagram*/
        $this->add_control(
            'sa_el_person_instagram',
            [
                'label'         => __('Instagram', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => ['active' => true],
                'label_block'   => true,
                'condition'     => [
                    'sa_el_person_social_enable'  => 'yes'
                ]
            ]
        );

        /*Person Skype*/
        $this->add_control(
            'sa_el_person_skype',
            [
                'label'         => __('Skype', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => ['active' => true],
                'label_block'   => true,
                'condition'     => [
                    'sa_el_person_social_enable'  => 'yes'
                ]
            ]
        );

        /*Person Pinterest*/
        $this->add_control(
            'sa_el_person_pinterest',
            [
                'label'         => __('Pinterest', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => ['active' => true],
                'default'       => '#',
                'label_block'   => true,
                'condition'     => [
                    'sa_el_person_social_enable'  => 'yes'
                ]
            ]
        );

        /*Person Dribble*/
        $this->add_control(
            'sa_el_person_dribbble',
            [
                'label'         => __('Dribbble', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => ['active' => true],
                'default'       => '#',
                'label_block'   => true,
                'condition'     => [
                    'sa_el_person_social_enable'  => 'yes'
                ]
            ]
        );

        /*Person Dribble*/
        $this->add_control(
            'sa_el_person_behance',
            [
                'label'         => __('Behance', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => ['active' => true],
                'default'       => '#',
                'label_block'   => true,
                'condition'     => [
                    'sa_el_person_social_enable'  => 'yes'
                ]
            ]
        );

        /*Person Google*/
        $this->add_control(
            'sa_el_person_mail',
            [
                'label'         => __('Email Address', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => ['active' => true],
                'default'       => '#',
                'label_block'   => true,
                'condition'     => [
                    'sa_el_person_social_enable'  => 'yes'
                ]
            ]
        );

        /*End Social Links Section*/
        $this->end_controls_section();
        $this->Sa_El_Support();
        /*Start Image Style Section*/
        $this->start_controls_section(
            'sa_el_person_image_style',
            [
                'label'         => __('Image', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        /*Image CSS Filter */
        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'css_filters',
                'selector' => '{{WRAPPER}} .sa-el-person-image-container img',
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'      => 'hover_css_filters',
                'label'     => __('Hover CSS Filters', SA_EL_ADDONS_TEXTDOMAIN),
                'selector'  => '{{WRAPPER}} .sa-el-person-image-container:hover img'
            ]
        );

        /*End Image Style Section*/
        $this->end_controls_section();

        /*Start Name Style Section*/
        $this->start_controls_section(
            'sa_el_person_name_style',
            [
                'label'         => __('Name', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );


        /*Name Color*/
        $this->add_control(
            'sa_el_person_name_color',
            [
                'label'         => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-person-name'  => 'color: {{VALUE}};',
                ]
            ]
        );

        /*Name Typography*/
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'name_typography',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .sa-el-person-name',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'name_shadow',
                'selector'      => '{{WRAPPER}} .sa-el-person-name',
            ]
        );

        /*End Name Style Section*/
        $this->end_controls_section();

        /*Start Title Style Section*/
        $this->start_controls_section(
            'sa_el_person_title_style',
            [
                'label'         => __('Job Title', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        /*Title Color*/
        $this->add_control(
            'sa_el_person_title_color',
            [
                'label'         => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-person-title'  => 'color: {{VALUE}};',
                ]
            ]
        );

        /*Title Typography*/
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'title_typography',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .sa-el-person-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'title_shadow',
                'selector'      => '{{WRAPPER}} .sa-el-person-title',
            ]
        );

        /*End Title Style Section*/
        $this->end_controls_section();

        /*Start Description Style Section*/
        $this->start_controls_section(
            'sa_el_person_description_style',
            [
                'label'         => __('Description', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        /*Title Color*/
        $this->add_control(
            'sa_el_person_description_color',
            [
                'label'         => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-person-content'  => 'color: {{VALUE}};',
                ]
            ]
        );

        /*Title Typography*/
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'description_typography',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .sa-el-person-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'description_shadow',
                'selector'      => '{{WRAPPER}} .sa-el-person-content',
            ]
        );

        /*End Description Style Section*/
        $this->end_controls_section();

        /*Start Social Icon Style Section*/
        $this->start_controls_section(
            'sa_el_person_social_icon_style',
            [
                'label'         => __('Social Icons', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'sa_el_person_social_enable'  => 'yes'
                ]
            ]
        );

        /*Social Color*/
        $this->add_control(
            'sa_el_person_social_color',
            [
                'label'         => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-person-list-item i'  => 'color: {{VALUE}};',
                ]
            ]
        );

        /*Social Hover Color*/
        $this->add_control(
            'sa_el_person_social_hover_color',
            [
                'label'         => __('Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-person-list-item:hover i'  => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'sa_el_person_social_background',
            [
                'label'             => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'              => Controls_Manager::COLOR,
                'selectors'      => [
                    '{{WRAPPER}} .sa-el-person-list-item i'  => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'sa_el_person_social_hover_background',
            [
                'label'             => __('Hover Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'              => Controls_Manager::COLOR,
                'selectors'      => [
                    '{{WRAPPER}} .sa-el-person-list-item:hover i'  => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'sa_el_person_social_border',
                'selector'      => '{{WRAPPER}} .sa-el-person-list-item i',
            ]
        );

        $this->add_responsive_control(
            'sa_el_person_social_radius',
            [
                'label'         => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-person-list-item i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'sa_el_person_social_margin',
            [
                'label'         => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-person-list-item i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'sa_el_person_social_padding',
            [
                'label'         => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-person-list-item i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        /*End Description Style Section*/
        $this->end_controls_section();

        /*Start Content Style Section*/
        $this->start_controls_section(
            'sa_el_person_general_style',
            [
                'label'         => __('Content', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        /*Content Background Color*/
        $this->add_control(
            'sa_el_person_content_background_color',
            [
                'label'         => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::COLOR,
                'default'       => 'rgba(245,245,245,0.97)',
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-person-info'  => 'background-color: {{VALUE}};',
                ]
            ]
        );

        /*Border Bottom Width*/
        $this->add_responsive_control(
            'sa_el_person_border_bottom_width',
            [
                'label'         => __('Bottom Offset', SA_EL_ADDONS_TEXTDOMAIN),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 700,
                    ]
                ],
                'default'       => [
                    'size'  => 20,
                    'unit'  => 'px'
                ],
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .sa-el-person-info' => 'bottom: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'sa_el_person_content_speed',
            [
                'label'            => __('Transition Duration (sec)', SA_EL_ADDONS_TEXTDOMAIN),
                'type'            => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 5,
                        'step'  => 0.1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-person-info, {{WRAPPER}} .sa-el-person-image-container img'   => 'transition-duration: {{SIZE}}s',
                ]
            ]
        );

        /*End Content Style Section*/
        $this->end_controls_section();
    }

    protected function render()
    {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes('name');

        $this->add_inline_editing_attributes('title');

        $this->add_inline_editing_attributes('description', 'advanced');

        $name_heading = $settings['sa_el_person_name_heading'];

        $title_heading = $settings['sa_el_person_title_heading'];

        $image_effect = $settings['sa_el_person_hover_image_effect'];

        $image_html = '';
        if (!empty($settings['sa_el_person_image']['url'])) {
            $this->add_render_attribute('image', 'src', $settings['sa_el_person_image']['url']);
            $this->add_render_attribute('image', 'alt', Control_Media::get_image_alt($settings['sa_el_person_image']));
            $this->add_render_attribute('image', 'title', Control_Media::get_image_title($settings['sa_el_person_image']));

            $image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'sa_el_person_image');
        }

        ?>

        <div class="sa-el-person-container <?php echo 'sa-el-person-' . $image_effect  . '-effect' ?>">
            <div class="sa-el-person-image-container">
                <?php echo $image_html; ?>
            </div>
            <div class="sa-el-person-info">
                <div class="sa-el-person-info-container">
                    <?php if (!empty($settings['sa_el_person_name'])) : ?><<?php echo $name_heading; ?> class="sa-el-person-name"><span <?php echo $this->get_render_attribute_string('name'); ?>><?php echo $settings['sa_el_person_name']; ?></span></<?php echo $name_heading; ?>><?php endif; ?>
                    <?php if (!empty($settings['sa_el_person_title'])) : ?><<?php echo $title_heading; ?> class="sa-el-person-title"><span <?php echo $this->get_render_attribute_string('title'); ?>><?php echo $settings['sa_el_person_title']; ?></span></<?php echo $title_heading; ?>><?php endif; ?>
                    <?php if (!empty($settings['sa_el_person_content'])) : ?>
                        <div class="sa-el-person-content">
                            <div <?php echo $this->get_render_attribute_string('content'); ?>>
                                <?php echo $settings['sa_el_person_content']; ?>
                            </div>
                        </div>
                    <?php endif;
                            if ('yes' === $settings['sa_el_person_social_enable']) : ?>
                        <ul class="sa-el-person-social-list">
                            <?php if (!empty($settings['sa_el_person_facebook'])) : ?><li class="sa-el-person-list-item sa-el-person-facebook"><a href="<?php echo $settings['sa_el_person_facebook']; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li><?php endif; ?>
                            <?php if (!empty($settings['sa_el_person_twitter'])) : ?><li class="sa-el-person-list-item sa-el-person-twitter"><a href="<?php echo $settings['sa_el_person_twitter']; ?>" target="_blank"><i class="fab fa-twitter"></i></a></li><?php endif; ?>
                            <?php if (!empty($settings['sa_el_person_linkedin'])) : ?><li class="sa-el-person-list-item sa-el-person-linkedin"><a href="<?php echo $settings['sa_el_person_linkedin']; ?>" target="_blank"><i class="fab fa-linkedin"></i></a></li><?php endif; ?>
                            <?php if (!empty($settings['sa_el_person_google'])) : ?><li class="sa-el-person-list-item sa-el-person-google"><a href="<?php echo $settings['sa_el_person_google']; ?>" target="_blank"><i class="fab fa-google-plus-g"></i></a></li><?php endif; ?>
                            <?php if (!empty($settings['sa_el_person_youtube'])) : ?><li class="sa-el-person-list-item sa-el-person-youtube"><a href="<?php echo $settings['sa_el_person_youtube']; ?>" target="_blank"><i class="fab fa-youtube"></i></a></li><?php endif; ?>

                            <?php if (!empty($settings['sa_el_person_instagram'])) : ?><li class="sa-el-person-list-item sa-el-person-instagram"><a href="<?php echo $settings['sa_el_person_instagram']; ?>" target="_blank"><i class="fab fa-instagram"></i></a></li><?php endif; ?>
                            <?php if (!empty($settings['sa_el_person_skype'])) : ?><li class="sa-el-person-list-item sa-el-person-skype"><a href="<?php echo $settings['sa_el_person_skype']; ?>" target="_blank"><i class="fab fa-skype"></i></a></li><?php endif; ?>
                            <?php if (!empty($settings['sa_el_person_pinterest'])) : ?><li class="sa-el-person-list-item sa-el-person-pinterest"><a href="<?php echo $settings['sa_el_person_pinterest']; ?>" target="_blank"><i class="fab fa-pinterest"></i></a></li><?php endif; ?>
                            <?php if (!empty($settings['sa_el_person_dribbble'])) : ?><li class="sa-el-person-list-item sa-el-person-dribbble"><a href="<?php echo $settings['sa_el_person_dribbble']; ?>" target="_blank"><i class="fab fa-dribbble"></i></a></li><?php endif; ?>
                            <?php if (!empty($settings['sa_el_person_behance'])) : ?><li class="sa-el-person-list-item sa-el-person-behance"><a href="<?php echo $settings['sa_el_person_behance']; ?>" target="_blank"><i class="fab fa-behance"></i></a></li><?php endif; ?>
                            <?php if (!empty($settings['sa_el_person_mail'])) : ?><li class="sa-el-person-list-item sa-el-person-mail"><a href="<?php echo $settings['sa_el_person_mail']; ?>" target="_blank"><i class="far fa-envelope"></i></a></li><?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php
        }

        protected function _content_template()
        {
            ?>
        <# view.addInlineEditingAttributes('name'); view.addInlineEditingAttributes('title'); view.addInlineEditingAttributes('content', 'advanced' ); var nameHeading=settings.sa_el_person_name_heading, titleHeading=settings.sa_el_person_title_heading, imageEffect='sa-el-person-' + settings.sa_el_person_hover_image_effect + '-effect' ; view.addRenderAttribute('container', 'class' , [ 'sa-el-person-container' , imageEffect ] ); var imageHtml='' ; if ( settings.sa_el_person_image.url ) { var image={ id: settings.sa_el_person_image.id, url: settings.sa_el_person_image.url, size: settings.thumbnail_size, dimension: settings.thumbnail_custom_dimension, model: view.getEditModel() }; var image_url=elementor.imagesManager.getImageUrl( image ); imageHtml='<img src="' + image_url + '"/>' ; } #>

            <div {{{ view.getRenderAttributeString('container') }}}>
                <div class="sa-el-person-image-container">
                    {{{imageHtml}}}
                </div>
                <div class="sa-el-person-info">
                    <div class="sa-el-person-info-container">
                        <# if( '' !=settings.sa_el_person_name ) { #>
                            <{{{nameHeading}}} class="sa-el-person-name">
                                <span {{{ view.getRenderAttributeString('name') }}}>
                                    {{{ settings.sa_el_person_name }}}
                                </span></{{{nameHeading}}}>
                            <# } if( '' !=settings.sa_el_person_title ) { #>
                                <{{{titleHeading}}} class="sa-el-person-title">
                                    <span {{{ view.getRenderAttributeString('title') }}}>
                                        {{{ settings.sa_el_person_title }}}
                                    </span></{{{titleHeading}}}>
                                <# } if( '' !=settings.sa_el_person_content ) { #>
                                    <div class="sa-el-person-content">
                                        <div {{{ view.getRenderAttributeString('content') }}}>
                                            {{{ settings.sa_el_person_content }}}
                                        </div>
                                    </div>
                                    <# } if ( 'yes'===settings.sa_el_person_social_enable ) { #>
                                        <ul class="sa-el-person-social-list">
                                            <# if( '' !=settings.sa_el_person_facebook ) { #>
                                                <li class="sa-el-person-list-item sa-el-person-facebook"><a href="{{ settings.sa_el_person_facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                                <# } #>

                                                    <# if( '' !=settings.sa_el_person_twitter ) { #>
                                                        <li class="sa-el-person-list-item sa-el-person-twitter"><a href="{{ settings.sa_el_person_twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                                        <# } #>

                                                            <# if( '' !=settings.sa_el_person_linkedin ) { #>
                                                                <li class="sa-el-person-list-item sa-el-person-linkedin"><a href="{{ settings.sa_el_person_linkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                                                <# } #>

                                                                    <# if( '' !=settings.sa_el_person_google ) { #>
                                                                        <li class="sa-el-person-list-item sa-el-person-google"><a href="{{ settings.sa_el_person_google }}" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
                                                                        <# } #>

                                                                            <# if( '' !=settings.sa_el_person_youtube ) { #>
                                                                                <li class="sa-el-person-list-item sa-el-person-youtube"><a href="{{ settings.sa_el_person_youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                                                                <# } #>

                                                                                    <# if( '' !=settings.sa_el_person_instagram ) { #>
                                                                                        <li class="sa-el-person-list-item sa-el-person-instagram"><a href="{{ settings.sa_el_person_instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                                                                        <# } #>

                                                                                            <# if( '' !=settings.sa_el_person_skype) { #>
                                                                                                <li class="sa-el-person-list-item sa-el-person-skype"><a href="{{ settings.sa_el_person_skype }}" target="_blank"><i class="fab fa-skype"></i></a></li>
                                                                                                <# } #>

                                                                                                    <# if( '' !=settings.sa_el_person_pinterest ) { #>
                                                                                                        <li class="sa-el-person-list-item sa-el-person-pinterest"><a href="{{ settings.sa_el_person_pinterest }}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
                                                                                                        <# } #>

                                                                                                            <# if( '' !=settings.sa_el_person_dribbble ) { #>
                                                                                                                <li class="sa-el-person-list-item sa-el-person-dribbble"><a href="{{ settings.sa_el_person_dribbble }}" target="_blank"><i class="fab fa-dribbble"></i></a></li>
                                                                                                                <# } #>

                                                                                                                    <# if( '' !=settings.sa_el_person_behance ) { #>
                                                                                                                        <li class="sa-el-person-list-item sa-el-person-behance"><a href="{{ settings.sa_el_person_behance }}" target="_blank"><i class="fab fa-behance"></i></a></li>
                                                                                                                        <# } #>

                                                                                                                            <# if( '' !=settings.sa_el_person_mail ) { #>
                                                                                                                                <li class="sa-el-person-list-item sa-el-person-mail"><a href="{{ settings.sa_el_person_mail }}" target="_blank"><i class="far fa-envelope"></i></a></li>
                                                                                                                                <# } #>

                                        </ul>
                                        <# } #>
                    </div>
                </div>
            </div>
    <?php
        }
    }
