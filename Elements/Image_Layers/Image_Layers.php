<?php

namespace SA_EL_ADDONS\Elements\Image_Layers;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;

class Image_Layers extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_image_layers';
    }

    public function get_title() {
        return esc_html__('Image Layers', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-image-rollover oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    public function get_script_depends() {
        return [
            'elementor-waypoints',
        ];
    }

    protected function _register_controls() {
        $this->start_controls_section('sa_el_img_layers_content', [
            'label' => __('Images', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('sa_el_img_layers_notice', [
            'raw' => __('NEW: Now you can position, resize layers from the preview area', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::RAW_HTML,
            'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control('sa_el_img_layers_image', [
            'label' => __('Upload Image', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::MEDIA,
            'dynamic' => ['active' => true],
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $repeater->add_control('sa_el_img_layers_alt', [
            'label' => __('Alt', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'dynamic' => ['active' => true],
            'placeholder' => 'Elementor Addons Image Layers',
            'label_block' => true,
                ]
        );

        $repeater->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'thumbnail',
            'default' => 'full',
                ]
        );

        $repeater->add_control('sa_el_img_layers_position', [
            'label' => __('Position', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::HIDDEN,
            'options' => [
                'relative' => __('Relative', SA_EL_ADDONS_TEXTDOMAIN),
                'absolute' => __('Absolute', SA_EL_ADDONS_TEXTDOMAIN),
            ]
                ]
        );

        $repeater->add_responsive_control('sa_el_img_layers_hor_position', [
            'label' => __('Horizontal Offset', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'description' => __('Mousemove Interactivity works only with pixels', SA_EL_ADDONS_TEXTDOMAIN),
            'size_units' => ['px', '%'],
            'range' => [
                'px' => [
                    'min' => -200,
                    'max' => 300,
                ],
                '%' => [
                    'min' => -50,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}}.absolute' => 'left: {{SIZE}}{{UNIT}};'
            ],
                ]
        );

        $repeater->add_responsive_control('sa_el_img_layers_ver_position', [
            'label' => __('Vertical Offset', SA_EL_ADDONS_TEXTDOMAIN),
            'description' => __('Mousemove Interactivity works only with pixels', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => [
                    'min' => -200,
                    'max' => 300,
                ],
                '%' => [
                    'min' => -50,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}}.absolute' => 'top: {{SIZE}}{{UNIT}};'
            ]
                ]
        );

        $repeater->add_responsive_control('sa_el_img_layers_width', [
            'label' => __('Width', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', '%', "vw"],
            'range' => [
                'px' => [
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};'
            ],
            'separator' => 'after',
                ]
        );

        $repeater->add_control('sa_el_img_layers_link_switcher', [
            'label' => __('Link', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
                ]
        );

        $repeater->add_control('sa_el_img_layers_link_selection', [
            'label' => __('Link Type', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'url' => __('URL', SA_EL_ADDONS_TEXTDOMAIN),
                'link' => __('Existing Page', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'default' => 'url',
            'label_block' => true,
            'condition' => [
                'sa_el_img_layers_link_switcher' => 'yes'
            ]
                ]
        );

        $repeater->add_control('sa_el_img_layers_link', [
            'label' => __('Link', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::URL,
            'dynamic' => ['active' => true],
            'default' => [
                'url' => '#',
            ],
            'placeholder' => 'https://elementoraddons.com/',
            'label_block' => true,
            'separator' => 'after',
            'condition' => [
                'sa_el_img_layers_link_switcher' => 'yes',
                'sa_el_img_layers_link_selection' => 'url'
            ]
                ]
        );

        $repeater->add_control('sa_el_img_layers_existing_link', [
            'label' => __('Existing Page', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT2,
            'options' => $this->sa_el_get_all_post(),
            'condition' => [
                'sa_el_img_layers_link_switcher' => 'yes',
                'sa_el_img_layers_link_selection' => 'link',
            ],
            'multiple' => false,
            'separator' => 'after',
            'label_block' => true,
                ]
        );

        $repeater->add_control('sa_el_img_layers_rotate', [
            'label' => __('Rotate', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
                ]
        );

        $repeater->add_control('sa_el_img_layers_rotatex', [
            'label' => __('Degrees', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::NUMBER,
            'description' => __('Set rotation value in degress', SA_EL_ADDONS_TEXTDOMAIN),
            'min' => -180,
            'max' => 180,
            'condition' => [
                'sa_el_img_layers_rotate' => 'yes'
            ],
            'separator' => 'after',
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}}' => '-webkit-transform: rotate({{VALUE}}deg); -moz-transform: rotate({{VALUE}}deg); -o-transform: rotate({{VALUE}}deg); transform: rotate({{VALUE}}deg);'
            ],
                ]
        );

        $repeater->add_control('sa_el_img_layers_animation_switcher', [
            'label' => __('Animation', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
                ]
        );

        $repeater->add_control('sa_el_img_layers_animation', [
            'label' => __('Entrance Animation', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::ANIMATION,
            'default' => '',
            'label_block' => false,
            'frontend_available' => true,
            'condition' => [
                'sa_el_img_layers_animation_switcher' => 'yes'
            ],
            'frontend_available' => true,
                ]
        );

        $repeater->add_control('sa_el_img_layers_animation_duration', [
            'label' => __('Animation Duration', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'options' => [
                'slow' => __('Slow', SA_EL_ADDONS_TEXTDOMAIN),
                '' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                'fast' => __('Fast', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'condition' => [
                'sa_el_img_layers_animation_switcher' => 'yes',
                'sa_el_img_layers_animation!' => '',
            ],
                ]
        );

        $repeater->add_control('sa_el_img_layers_animation_delay', [
            'label' => __('Animation Delay', SA_EL_ADDONS_TEXTDOMAIN) . ' (s)',
            'type' => Controls_Manager::NUMBER,
            'default' => '',
            'min' => 0,
            'step' => 0.1,
            'condition' => [
                'sa_el_img_layers_animation_switcher' => 'yes',
                'sa_el_img_layers_animation!' => '',
            ],
            'frontend_available' => true,
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}}.animated' => '-webkit-animation-delay:{{VALUE}}s; -moz-animation-delay: {{VALUE}}s; -o-animation-delay: {{VALUE}}s; animation-delay: {{VALUE}}s;'
            ]
                ]
        );

        $repeater->add_control('sa_el_img_layers_mouse', [
            'label' => __('Mousemove Interactivity', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'description' => __('Enable or disable mousemove interaction', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $repeater->add_control('sa_el_img_layers_mouse_type', [
            'label' => __('Interactivity Style', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'parallax' => __('Mouse Parallax', SA_EL_ADDONS_TEXTDOMAIN),
                'tilt' => __('Tilt', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'default' => 'parallax',
            'label_block' => true,
            'condition' => [
                'sa_el_img_layers_mouse' => 'yes'
            ]
                ]
        );

        $repeater->add_control('sa_el_img_layers_rate', [
            'label' => __('Rate', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::NUMBER,
            'default' => -10,
            'min' => -20,
            'max' => 20,
            'step' => 1,
            'description' => __('Choose the movement rate for the layer image, default: -10', SA_EL_ADDONS_TEXTDOMAIN),
            'separator' => 'after',
            'condition' => [
                'sa_el_img_layers_mouse' => 'yes',
                'sa_el_img_layers_mouse_type' => 'parallax'
            ]
                ]
        );

        $repeater->add_control('sa_el_img_layers_scroll_effects', [
            'label' => __('Scroll Effects', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER
                ]
        );

        $conditions = array(
            'sa_el_img_layers_scroll_effects' => 'yes'
        );

        $repeater->add_control('sa_el_img_layers_opacity', [
            'label' => __('Scroll Fade', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'condition' => $conditions
                ]
        );

        $repeater->add_control('sa_el_img_layers_opacity_effect', [
            'label' => __('Direction', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'down' => __('Fade In', SA_EL_ADDONS_TEXTDOMAIN),
                'up' => __('Fade Out', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'default' => 'down',
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_opacity' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_opacity_level', [
            'label' => __('Opacity Level', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 10,
            ],
            'range' => [
                'px' => [
                    'max' => 10,
                    'step' => 0.1,
                ],
            ],
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_opacity' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_opacity_view', [
            'label' => __('Viewport', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'sizes' => [
                    'start' => 0,
                    'end' => 100,
                ],
                'unit' => '%',
            ],
            'labels' => [
                __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                __('Top', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'scales' => 1,
            'handles' => 'range',
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_opacity' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_vscroll', [
            'label' => __('Vertical Parallax', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'condition' => $conditions
                ]
        );

        $repeater->add_control('sa_el_img_layers_vscroll_direction', [
            'label' => __('Direction', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'up' => __('Up', SA_EL_ADDONS_TEXTDOMAIN),
                'down' => __('Down', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'default' => 'down',
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_vscroll' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_vscroll_speed', [
            'label' => __('Speed', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 4,
            ],
            'range' => [
                'px' => [
                    'max' => 10,
                    'step' => 0.1,
                ],
            ],
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_vscroll' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_vscroll_view', [
            'label' => __('Viewport', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'sizes' => [
                    'start' => 0,
                    'end' => 100,
                ],
                'unit' => '%',
            ],
            'labels' => [
                __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                __('Top', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'scales' => 1,
            'handles' => 'range',
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_vscroll' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_hscroll', [
            'label' => __('Horizontal Parallax', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'condition' => $conditions
                ]
        );

        $repeater->add_control('sa_el_img_layers_hscroll_direction', [
            'label' => __('Direction', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'up' => __('To Left', SA_EL_ADDONS_TEXTDOMAIN),
                'down' => __('To Right', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'default' => 'down',
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_hscroll' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_hscroll_speed', [
            'label' => __('Speed', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 4,
            ],
            'range' => [
                'px' => [
                    'max' => 10,
                    'step' => 0.1,
                ],
            ],
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_hscroll' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_hscroll_view', [
            'label' => __('Viewport', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'sizes' => [
                    'start' => 0,
                    'end' => 100,
                ],
                'unit' => '%',
            ],
            'labels' => [
                __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                __('Top', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'scales' => 1,
            'handles' => 'range',
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_hscroll' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_blur', [
            'label' => __('Blur', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'condition' => $conditions
                ]
        );

        $repeater->add_control('sa_el_img_layers_blur_effect', [
            'label' => __('Direction', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'down' => __('Decrease Blur', SA_EL_ADDONS_TEXTDOMAIN),
                'up' => __('Increase Blur', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'default' => 'down',
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_blur' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_blur_level', [
            'label' => __('Blur Level', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 10,
            ],
            'range' => [
                'px' => [
                    'max' => 10,
                    'step' => 0.1,
                ],
            ],
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_blur' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_blur_view', [
            'label' => __('Viewport', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'sizes' => [
                    'start' => 0,
                    'end' => 100,
                ],
                'unit' => '%',
            ],
            'labels' => [
                __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                __('Top', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'scales' => 1,
            'handles' => 'range',
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_blur' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_rscroll', [
            'label' => __('Rotate', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'condition' => $conditions
                ]
        );

        $repeater->add_control('sa_el_img_layers_rscroll_direction', [
            'label' => __('Direction', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'up' => __('Counter Clockwise', SA_EL_ADDONS_TEXTDOMAIN),
                'down' => __('Clockwise', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'default' => 'down',
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_rscroll' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_rscroll_speed', [
            'label' => __('Speed', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 3,
            ],
            'range' => [
                'px' => [
                    'max' => 10,
                    'step' => 0.1,
                ],
            ],
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_rscroll' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_rscroll_view', [
            'label' => __('Viewport', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'sizes' => [
                    'start' => 0,
                    'end' => 100,
                ],
                'unit' => '%',
            ],
            'labels' => [
                __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                __('Top', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'scales' => 1,
            'handles' => 'range',
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_rscroll' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_scale', [
            'label' => __('Scale', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'condition' => $conditions
                ]
        );

        $repeater->add_control('sa_el_img_layers_scale_direction', [
            'label' => __('Scale', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'up' => __('Shrink', SA_EL_ADDONS_TEXTDOMAIN),
                'down' => __('Scale', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'default' => 'down',
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_scale' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_scale_speed', [
            'label' => __('Speed', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 3,
            ],
            'range' => [
                'px' => [
                    'max' => 10,
                    'step' => 0.1,
                ],
            ],
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_scale' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_scale_view', [
            'label' => __('Viewport', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'sizes' => [
                    'start' => 0,
                    'end' => 100,
                ],
                'unit' => '%',
            ],
            'labels' => [
                __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                __('Top', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'scales' => 1,
            'handles' => 'range',
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_scale' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_gray', [
            'label' => __('Gray Scale', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'condition' => $conditions
                ]
        );

        $repeater->add_control('sa_el_img_layers_gray_effect', [
            'label' => __('Effect', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'up' => __('Increase', SA_EL_ADDONS_TEXTDOMAIN),
                'down' => __('Decrease', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'default' => 'down',
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_gray' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_gray_level', [
            'label' => __('Speed', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 10,
            ],
            'range' => [
                'px' => [
                    'max' => 10,
                    'step' => 0.1,
                ],
            ],
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_gray' => 'yes'
            ]),
                ]
        );

        $repeater->add_control('sa_el_img_layers_gray_view', [
            'label' => __('Viewport', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'sizes' => [
                    'start' => 0,
                    'end' => 100,
                ],
                'unit' => '%',
            ],
            'labels' => [
                __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                __('Top', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'scales' => 1,
            'handles' => 'range',
            'condition' => array_merge($conditions, [
                'sa_el_img_layers_gray' => 'yes'
            ]),
                ]
        );

        $repeater->add_responsive_control('sa_el_img_layerstransform_origin_x', [
            'label' => __('X Anchor Point', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::CHOOSE,
            'default' => 'center',
            'options' => [
                'left' => [
                    'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-h-align-left',
                ],
                'center' => [
                    'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-h-align-center',
                ],
                'right' => [
                    'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-h-align-right',
                ],
            ],
            'conditions' => [
                'terms' => [
                    [
                        'name' => 'sa_el_img_layers_scroll_effects',
                        'value' => 'yes',
                    ],
                    [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'sa_el_img_layers_rscroll',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'sa_el_img_layers_scale',
                                'value' => 'yes'
                            ]
                        ],
                    ]
                ]
            ],
            'label_block' => false,
            'toggle' => false,
            'render_type' => 'ui',
                ]
        );

        $repeater->add_responsive_control('sa_el_img_layerstransform_origin_y', [
            'label' => __('Y Anchor Point', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::CHOOSE,
            'default' => 'center',
            'options' => [
                'top' => [
                    'title' => __('Top', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-v-align-top',
                ],
                'center' => [
                    'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-v-align-middle',
                ],
                'bottom' => [
                    'title' => __('Bottom', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'eicon-v-align-bottom',
                ],
            ],
            'conditions' => [
                'terms' => [
                    [
                        'name' => 'sa_el_img_layers_scroll_effects',
                        'value' => 'yes',
                    ],
                    [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'sa_el_img_layers_rscroll',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'sa_el_img_layers_scale',
                                'value' => 'yes'
                            ]
                        ],
                    ]
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}}.sa-el-img-layers-list-item' => 'transform-origin: {{sa_el_img_layerstransform_origin_x.VALUE}} {{VALUE}}',
            ],
            'label_block' => false,
            'toggle' => false
                ]
        );

        $repeater->add_control('sa_el_img_layers_zindex', [
            'label' => __('z-index', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::NUMBER,
            'default' => 1,
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}}.sa-el-img-layers-list-item' => 'z-index: {{VALUE}};'
            ],
                ]
        );

        $repeater->add_control('sa_el_img_layers_class', [
            'label' => __('CSS Classes', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'description' => __('Separate class with spaces', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('sa_el_img_layers_images_repeater', [
            'type' => Controls_Manager::REPEATER,
            'fields' => array_values($repeater->get_controls()),
            'title_field' => '{{{ sa_el_img_layers_alt }}}',
                ]
        );

        $this->add_control('sa_el_parallax_layers_devices', [
            'label' => __('Apply Scroll Effects On', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT2,
            'options' => [
                'desktop' => __('Desktop', SA_EL_ADDONS_TEXTDOMAIN),
                'tablet' => __('Tablet', SA_EL_ADDONS_TEXTDOMAIN),
                'mobile' => __('Mobile', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'default' => ['desktop', 'tablet', 'mobile'],
            'multiple' => true,
            'label_block' => true
        ]);

        $this->end_controls_section();

        $this->start_controls_section('sa_el_img_layers_container', [
            'label' => __('Container', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_responsive_control('sa_el_img_layers_height', [
            'label' => __('Minimum Height', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', "em", "vh"],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 800,
                ],
                'em' => [
                    'min' => 1,
                    'max' => 80,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa-el-img-layers-wrapper' => 'min-height: {{SIZE}}{{UNIT}}'
            ],
                ]
        );

        $this->add_responsive_control('sa_el_img_layers_overflow', [
            'label' => __('Overflow', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'auto' => __('Auto', SA_EL_ADDONS_TEXTDOMAIN),
                'visible' => __('Visible', SA_EL_ADDONS_TEXTDOMAIN),
                'hidden' => __('Hidden', SA_EL_ADDONS_TEXTDOMAIN),
                'scroll' => __('Scroll', SA_EL_ADDONS_TEXTDOMAIN),
            ],
            'default' => 'visible',
            'selectors' => [
                '{{WRAPPER}} .sa-el-img-layers-wrapper' => 'overflow: {{VALUE}}'
            ]
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();

        $this->start_controls_section('sa_el_img_layers_images_style', [
            'label' => __('Image', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control('sa_el_img_layers_images_background', [
            'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sa-el-img-layers-list-item .sa-el-img-layers-image' => 'background-color: {{VALUE}};',
            ]
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(), [
            'name' => 'sa_el_img_layers_images_border',
            'selector' => '{{WRAPPER}} .sa-el-img-layers-list-item .sa-el-img-layers-image'
                ]
        );

        $this->add_responsive_control('sa_el_img_layers_images_border_radius', [
            'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-img-layers-list-item .sa-el-img-layers-image' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
            ]
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(), [
            'name' => 'sa_el_img_layers_images_shadow',
            'selector' => '{{WRAPPER}} .sa-el-img-layers-list-item .sa-el-img-layers-image'
                ]
        );

        $this->add_responsive_control('sa_el_img_layers_margin', [
            'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-img-layers-list-item .sa-el-img-layers-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
                ]
        );

        $this->add_responsive_control('sa_el_img_layers_padding', [
            'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-img-layers-list-item .sa-el-img-layers-image' => 'padding:  {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('sa_el_img_layers_container_style', [
            'label' => __('Container', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control('sa_el_img_layers_container_background', [
            'label' => __('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sa-el-img-layers-wrapper' => 'background-color: {{VALUE}};',
            ]
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(), [
            'name' => 'sa_el_img_layers_container_border',
            'selector' => '{{WRAPPER}} .sa-el-img-layers-wrapper'
                ]
        );

        $this->add_responsive_control('sa_el_img_layers_container_radius', [
            'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-img-layers-wrapper' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
            ]
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(), [
            'name' => 'sa_el_img_layers_container_shadow',
            'selector' => '{{WRAPPER}} .sa-el-img-layers-wrapper'
                ]
        );

        $this->add_responsive_control('sa_el_img_layers_container_margin', [
            'label' => __('Margin', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-img-layers-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
                ]
        );

        $this->add_responsive_control('sa_el_img_layers_container_padding', [
            'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa-el-img-layers-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('container', [
            'id' => 'sa-el-img-layers-wrapper',
            'class' => 'sa-el-img-layers-wrapper',
        ]);

        $scroll_effects = isset($settings['sa_el_parallax_layers_devices']) ? $settings['sa_el_parallax_layers_devices'] : array();

        $this->add_render_attribute('container', 'data-devices', wp_json_encode($scroll_effects));
        ?>

        <div <?php echo $this->get_render_attribute_string('container'); ?>>
            <ul class="sa-el-img-layers-list-wrapper">
        <?php
        $animation_arr = array();
        foreach ($settings['sa_el_img_layers_images_repeater'] as $index => $image) :
            array_push($animation_arr, $image['sa_el_img_layers_animation_switcher']);
            if ('yes' == $animation_arr[$index]) {
                $animation_class = $image['sa_el_img_layers_animation'];
                if ('' != $image['sa_el_img_layers_animation_duration']) {
                    $animation_dur = 'animated-' . $image['sa_el_img_layers_animation_duration'];
                } else {
                    $animation_dur = 'animated-';
                }
            } else {
                $animation_class = '';
                $animation_dur = '';
            }

            $list_item_key = 'img_layer_' . $index;

            $position = !empty($image['sa_el_img_layers_position']) ? $image['sa_el_img_layers_position'] : 'absolute';

            $this->add_render_attribute($list_item_key, 'class', [
                'sa-el-img-layers-list-item',
                $position,
                esc_attr($image['sa_el_img_layers_class']),
                'elementor-repeater-item-' . $image['_id']
                    ]
            );

            $this->add_render_attribute($list_item_key, 'data-layer-animation', [
                $animation_class,
                $animation_dur,
                    ]
            );

            if ('yes' == $image['sa_el_img_layers_scroll_effects']) {

                $this->add_render_attribute($list_item_key, 'data-scrolls', 'true');

                if ('yes' == $image['sa_el_img_layers_vscroll']) {

                    $speed = !empty($image['sa_el_img_layers_vscroll_speed']['size']) ? $image['sa_el_img_layers_vscroll_speed']['size'] : 4;

                    $this->add_render_attribute($list_item_key, 'data-vscroll', 'true');

                    $this->add_render_attribute($list_item_key, 'data-vscroll-speed', $speed);

                    $this->add_render_attribute($list_item_key, 'data-vscroll-dir', $image['sa_el_img_layers_vscroll_direction']);

                    $this->add_render_attribute($list_item_key, 'data-vscroll-start', $image['sa_el_img_layers_vscroll_view']['sizes']['start']);
                    $this->add_render_attribute($list_item_key, 'data-vscroll-end', $image['sa_el_img_layers_vscroll_view']['sizes']['end']);
                }

                if ('yes' == $image['sa_el_img_layers_hscroll']) {

                    $speed = !empty($image['sa_el_img_layers_hscroll_speed']['size']) ? $image['sa_el_img_layers_hscroll_speed']['size'] : 4;

                    $this->add_render_attribute($list_item_key, 'data-hscroll', 'true');

                    $this->add_render_attribute($list_item_key, 'data-hscroll-speed', $speed);

                    $this->add_render_attribute($list_item_key, 'data-hscroll-dir', $image['sa_el_img_layers_hscroll_direction']);

                    $this->add_render_attribute($list_item_key, 'data-hscroll-start', $image['sa_el_img_layers_hscroll_view']['sizes']['start']);
                    $this->add_render_attribute($list_item_key, 'data-hscroll-end', $image['sa_el_img_layers_hscroll_view']['sizes']['end']);
                }

                if ('yes' == $image['sa_el_img_layers_opacity']) {

                    $level = !empty($image['sa_el_img_layers_opacity_level']['size']) ? $image['sa_el_img_layers_opacity_level']['size'] : 10;

                    $this->add_render_attribute($list_item_key, 'data-oscroll', 'true');

                    $this->add_render_attribute($list_item_key, 'data-oscroll-level', $level);

                    $this->add_render_attribute($list_item_key, 'data-oscroll-effect', $image['sa_el_img_layers_opacity_effect']);

                    $this->add_render_attribute($list_item_key, 'data-oscroll-start', $image['sa_el_img_layers_opacity_view']['sizes']['start']);
                    $this->add_render_attribute($list_item_key, 'data-oscroll-end', $image['sa_el_img_layers_opacity_view']['sizes']['end']);
                }

                if ('yes' == $image['sa_el_img_layers_blur']) {

                    $level = !empty($image['sa_el_img_layers_blur_level']['size']) ? $image['sa_el_img_layers_blur_level']['size'] : 10;

                    $this->add_render_attribute($list_item_key, 'data-bscroll', 'true');

                    $this->add_render_attribute($list_item_key, 'data-bscroll-level', $level);

                    $this->add_render_attribute($list_item_key, 'data-bscroll-effect', $image['sa_el_img_layers_blur_effect']);

                    $this->add_render_attribute($list_item_key, 'data-bscroll-start', $image['sa_el_img_layers_blur_view']['sizes']['start']);
                    $this->add_render_attribute($list_item_key, 'data-bscroll-end', $image['sa_el_img_layers_blur_view']['sizes']['end']);
                }

                if ('yes' == $image['sa_el_img_layers_rscroll']) {

                    $speed = !empty($image['sa_el_img_layers_rscroll_speed']['size']) ? $image['sa_el_img_layers_rscroll_speed']['size'] : 3;

                    $this->add_render_attribute($list_item_key, 'data-rscroll', 'true');

                    $this->add_render_attribute($list_item_key, 'data-rscroll-speed', $speed);

                    $this->add_render_attribute($list_item_key, 'data-rscroll-dir', $image['sa_el_img_layers_rscroll_direction']);

                    $this->add_render_attribute($list_item_key, 'data-rscroll-start', $image['sa_el_img_layers_rscroll_view']['sizes']['start']);
                    $this->add_render_attribute($list_item_key, 'data-rscroll-end', $image['sa_el_img_layers_rscroll_view']['sizes']['end']);
                }

                if ('yes' == $image['sa_el_img_layers_scale']) {

                    $speed = !empty($image['sa_el_img_layers_scale_speed']['size']) ? $image['sa_el_img_layers_scale_speed']['size'] : 3;

                    $this->add_render_attribute($list_item_key, 'data-scale', 'true');

                    $this->add_render_attribute($list_item_key, 'data-scale-speed', $speed);

                    $this->add_render_attribute($list_item_key, 'data-scale-dir', $image['sa_el_img_layers_scale_direction']);

                    $this->add_render_attribute($list_item_key, 'data-scale-start', $image['sa_el_img_layers_scale_view']['sizes']['start']);
                    $this->add_render_attribute($list_item_key, 'data-scale-end', $image['sa_el_img_layers_scale_view']['sizes']['end']);
                }

                if ('yes' == $image['sa_el_img_layers_gray']) {

                    $level = !empty($image['sa_el_img_layers_gray_level']['size']) ? $image['sa_el_img_layers_gray_level']['size'] : 10;

                    $this->add_render_attribute($list_item_key, 'data-gscale', 'true');

                    $this->add_render_attribute($list_item_key, 'data-gscale-level', $level);

                    $this->add_render_attribute($list_item_key, 'data-gscale-effect', $image['sa_el_img_layers_gray_effect']);

                    $this->add_render_attribute($list_item_key, 'data-gscale-start', $image['sa_el_img_layers_gray_view']['sizes']['start']);
                    $this->add_render_attribute($list_item_key, 'data-gscale-end', $image['sa_el_img_layers_gray_view']['sizes']['end']);
                }
            }

            if ('yes' == $image['sa_el_img_layers_mouse']) {

                $this->add_render_attribute($list_item_key, 'data-' . $image['sa_el_img_layers_mouse_type'], 'true');

                $this->add_render_attribute($list_item_key, 'data-rate', !empty($image['sa_el_img_layers_rate']) ? $image['sa_el_img_layers_rate'] : -10 );
            }

            if ('url' == $image['sa_el_img_layers_link_selection']) {
                $image_url = $image['sa_el_img_layers_link']['url'];
            } else {
                $image_url = get_permalink($image['sa_el_img_layers_existing_link']);
            }

            $list_item_link = 'img_link_' . $index;
            if ('yes' == $image['sa_el_img_layers_link_switcher']) {
                $this->add_render_attribute($list_item_link, 'class', 'sa-el-img-layers-link');

                $this->add_render_attribute($list_item_link, 'href', $image_url);

                if (!empty($image['sa_el_img_layers_link']['is_external'])) {
                    $this->add_render_attribute($list_item_link, 'target', '_blank');
                }
                if (!empty($image['sa_el_img_layers_link']['nofollow'])) {
                    $this->add_render_attribute($list_item_link, 'rel', 'nofollow');
                }
            }
            ?>

                    <li <?php echo $this->get_render_attribute_string($list_item_key); ?>>
                    <?php
                    $image_src = $image['sa_el_img_layers_image'];

                    $image_src_size = Group_Control_Image_Size::get_attachment_image_src($image_src['id'], 'thumbnail', $image);

                    if (empty($image_src_size)) : $image_src_size = $image_src['url'];
                    else: $image_src_size = $image_src_size;
                    endif;
                    ?>

                        <img src="<?php echo $image_src_size; ?>" class="sa-el-img-layers-image" alt="<?php echo esc_attr($image['sa_el_img_layers_alt']); ?>">
                    <?php if ($image['sa_el_img_layers_link_switcher'] == 'yes') : ?>
                            <a <?php echo $this->get_render_attribute_string($list_item_link); ?>></a>
                    <?php endif; ?>

                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

            <?php
            }

            protected function _content_template() {
                ?>

        <#

        view.addRenderAttribute( 'container', 'id', 'sa-el-img-layers-wrapper' );
        view.addRenderAttribute( 'container', 'class', 'sa-el-img-layers-wrapper' );

        view.addRenderAttribute( 'container', 'data-devices', JSON.stringify( settings.sa_el_parallax_layers_devices ) );


        #>

        <div {{{ view.getRenderAttributeString('container') }}}>
            <ul class="sa-el-img-layers-list-wrapper">

                <# var animationClass, animationDur, listItemKey, imageUrl, animationArr = [];

                _.each( settings.sa_el_img_layers_images_repeater, function( image, index ) {

                animationArr.push( image.sa_el_img_layers_animation_switcher );

                if( 'yes' == animationArr[index] ) {

                animationClass = image.sa_el_img_layers_animation;

                if( '' != image.sa_el_img_layers_animation_duration ) {

                animationDur = 'animated-' + image.sa_el_img_layers_animation_duration;

                } else {
                animationDur = 'animated-';
                }
                } else {

                animationClass = '';

                animationDur = '';

                }

                listItemKey = 'img_layer_' + index;

                var position = '' !== image.sa_el_img_layers_position ? image.sa_el_img_layers_position : 'absolute';

                view.addRenderAttribute( listItemKey, 'class',
                [
                'sa-el-img-layers-list-item',
                position,
                image.sa_el_img_layers_class,
                'elementor-repeater-item-' + image._id
                ]
                );

                view.addRenderAttribute( listItemKey, 'data-layer-animation',
                [
                animationClass,
                animationDur,
                ]
                );

                if( 'yes' == image.sa_el_img_layers_mouse ) {

                var rate = '' != image.sa_el_img_layers_rate ? image.sa_el_img_layers_rate : -10;

                view.addRenderAttribute( listItemKey, 'data-' + image.sa_el_img_layers_mouse_type , 'true' );

                view.addRenderAttribute( listItemKey, 'data-rate', rate );

                }

                if( 'yes' == image.sa_el_img_layers_scroll_effects ) {

                view.addRenderAttribute( listItemKey, 'data-scrolls', 'true' );

                if( 'yes' == image.sa_el_img_layers_vscroll ) {

                var speed = '' !== image.sa_el_img_layers_vscroll_speed.size ? image.sa_el_img_layers_vscroll_speed.size : 4;

                view.addRenderAttribute( listItemKey, 'data-vscroll', 'true' );

                view.addRenderAttribute( listItemKey, 'data-vscroll-speed', speed );

                view.addRenderAttribute( listItemKey, 'data-vscroll-dir', image.sa_el_img_layers_vscroll_direction );

                view.addRenderAttribute( listItemKey, 'data-vscroll-start', image.sa_el_img_layers_vscroll_view.sizes.start );

                view.addRenderAttribute( listItemKey, 'data-vscroll-end', image.sa_el_img_layers_vscroll_view.sizes.end );

                }

                if( 'yes' == image.sa_el_img_layers_hscroll ) {

                var speed = '' !== image.sa_el_img_layers_hscroll_speed.size ? image.sa_el_img_layers_hscroll_speed.size : 4;

                view.addRenderAttribute( listItemKey, 'data-hscroll', 'true' );

                view.addRenderAttribute( listItemKey, 'data-hscroll-speed', speed );

                view.addRenderAttribute( listItemKey, 'data-hscroll-dir', image.sa_el_img_layers_hscroll_direction );

                view.addRenderAttribute( listItemKey, 'data-hscroll-start', image.sa_el_img_layers_hscroll_view.sizes.start );

                view.addRenderAttribute( listItemKey, 'data-hscroll-end', image.sa_el_img_layers_hscroll_view.sizes.end );

                }

                if( 'yes' == image.sa_el_img_layers_opacity ) {

                var level = '' !== image.sa_el_img_layers_opacity_level.size ? image.sa_el_img_layers_opacity_level.size : 4;

                view.addRenderAttribute( listItemKey, 'data-oscroll', 'true' );

                view.addRenderAttribute( listItemKey, 'data-oscroll-level', level );

                view.addRenderAttribute( listItemKey, 'data-oscroll-effect', image.sa_el_img_layers_opacity_effect );

                view.addRenderAttribute( listItemKey, 'data-oscroll-start', image.sa_el_img_layers_opacity_view.sizes.start );

                view.addRenderAttribute( listItemKey, 'data-oscroll-end', image.sa_el_img_layers_opacity_view.sizes.end );

                }

                if( 'yes' == image.sa_el_img_layers_blur ) {

                var level = '' !== image.sa_el_img_layers_blur_level.size ? image.sa_el_img_layers_blur_level.size : 4;

                view.addRenderAttribute( listItemKey, 'data-bscroll', 'true' );

                view.addRenderAttribute( listItemKey, 'data-bscroll-level', level );

                view.addRenderAttribute( listItemKey, 'data-bscroll-effect', image.sa_el_img_layers_blur_effect );

                view.addRenderAttribute( listItemKey, 'data-bscroll-start', image.sa_el_img_layers_blur_view.sizes.start );

                view.addRenderAttribute( listItemKey, 'data-bscroll-end', image.sa_el_img_layers_blur_view.sizes.end );

                }

                if( 'yes' == image.sa_el_img_layers_rscroll ) {

                var speed = '' !== image.sa_el_img_layers_rscroll_speed.size ? image.sa_el_img_layers_rscroll_speed.size : 3;

                view.addRenderAttribute( listItemKey, 'data-rscroll', 'true' );

                view.addRenderAttribute( listItemKey, 'data-rscroll-speed', speed );

                view.addRenderAttribute( listItemKey, 'data-rscroll-dir', image.sa_el_img_layers_rscroll_direction );

                view.addRenderAttribute( listItemKey, 'data-rscroll-start', image.sa_el_img_layers_rscroll_view.sizes.start );

                view.addRenderAttribute( listItemKey, 'data-rscroll-end', image.sa_el_img_layers_rscroll_view.sizes.end );

                }

                if( 'yes' == image.sa_el_img_layers_scale ) {

                var speed = '' !== image.sa_el_img_layers_scale_speed.size ? image.sa_el_img_layers_scale_speed.size : 3;

                view.addRenderAttribute( listItemKey, 'data-scale', 'true' );

                view.addRenderAttribute( listItemKey, 'data-scale-speed', speed );

                view.addRenderAttribute( listItemKey, 'data-scale-dir', image.sa_el_img_layers_scale_direction );

                view.addRenderAttribute( listItemKey, 'data-scale-start', image.sa_el_img_layers_scale_view.sizes.start );

                view.addRenderAttribute( listItemKey, 'data-scale-end', image.sa_el_img_layers_scale_view.sizes.end );

                }

                if( 'yes' == image.sa_el_img_layers_gray ) {

                var level = '' !== image.sa_el_img_layers_gray_level.size ? image.sa_el_img_layers_gray_level.size : 10;

                view.addRenderAttribute( listItemKey, 'data-gscale', 'true' );

                view.addRenderAttribute( listItemKey, 'data-gscale-level', level );

                view.addRenderAttribute( listItemKey, 'data-gscale-effect', image.sa_el_img_layers_gray_effect );

                view.addRenderAttribute( listItemKey, 'data-gscale-start', image.sa_el_img_layers_gray_view.sizes.start );

                view.addRenderAttribute( listItemKey, 'data-gscale-end', image.sa_el_img_layers_gray_view.sizes.end );

                }

                }

                if( 'url' == image.sa_el_img_layers_link_selection ) {

                imageUrl = image.sa_el_img_layers_link.url;

                } else {

                imageUrl = image.sa_el_img_layers_existing_link;

                } 

                var imageObj = {
                id: image.sa_el_img_layers_image.id,
                url: image.sa_el_img_layers_image.url,
                size: image.thumbnail_size,
                dimension: image.thumbnail_custom_dimension,
                model: view.getEditModel()
                },

                image_url = elementor.imagesManager.getImageUrl( imageObj );

                #>

                <li {{{ view.getRenderAttributeString(listItemKey) }}}>
                    <img src="{{ image_url }}" class="sa-el-img-layers-image" alt="{{ image.sa_el_img_layers_alt }}">
                    <# if( 'yes' == image.sa_el_img_layers_link_switcher ) { #>
                    <a class="sa-el-img-layers-link" href="{{ imageUrl }}"></a>
                    <# } #>
                </li>

                <# } );

                #>

            </ul>
        </div>

        <?php
    }

}
