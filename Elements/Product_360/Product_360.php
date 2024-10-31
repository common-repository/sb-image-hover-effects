<?php

namespace SA_EL_ADDONS\Elements\Product_360;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Product_360
 *
 * @author biplo
 * 
 */
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Product_360 extends Widget_Base {

    public function get_name() {
        return 'sa_el_product_360';
    }

    public function get_title() {
        return esc_html__('360° Product View', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-product-price oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'section_content_layout',
                [
                    'label' => __('Layout', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'source_type',
                [
                    'label' => __('Source Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'local',
                    'label_block' => true,
                    'options' => [
                        'local' => __('Local Images', SA_EL_ADDONS_TEXTDOMAIN),
                        'remote' => __('Remote Images', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'images',
                [
                    'label' => __('Add Images', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::GALLERY,
                    'dynamic' => ['active' => true],
                    'condition' => [
                        'source_type' => 'local'
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbnail',
                    'exclude' => ['custom'],
                    'default' => 'full',
                    'condition' => [
                        'source_type' => 'local'
                    ],
                ]
        );

        $this->add_control(
                'remote_images',
                [
                    'type' => Controls_Manager::URL,
                    'label' => __('Images Source', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_block' => true,
                    'description' => __('You should named all files with same digit serial numeric number, e.g: image-01.jpg, image-35.jpg', SA_EL_ADDONS_TEXTDOMAIN),
                    'show_external' => false,
                    'placeholder' => __('https://example.com/image-{frame}.jpg', SA_EL_ADDONS_TEXTDOMAIN),
                    'dynamic' => ['active' => true],
                    'condition' => [
                        'source_type' => 'remote',
                    ],
                ]
        );

        $this->add_control(
                'digit_number',
                [
                    'label' => esc_html__('File Name Digit Number', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Please select digit number of your file name. Such as if 001.jpg then you have to select 3', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 2,
                    'options' => [
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                        6 => '6',
                    ],
                    'condition' => [
                        'source_type' => 'remote',
                    ],
                ]
        );

        $this->add_control(
                'start_frame',
                [
                    'label' => __('Start Frame', 'elementor-bundle-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 50,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'size' => 1,
                    ],
                    'condition' => [
                        'source_type' => 'remote',
                    ],
                ]
        );

        $this->add_control(
                'end_frame',
                [
                    'label' => __('End Frame', 'elementor-bundle-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 8,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'size' => 12,
                    ],
                    'condition' => [
                        'source_type' => 'remote',
                    ],
                ]
        );

        $this->add_control(
                'width',
                [
                    'label' => __('Width', 'elementor-bundle-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 100,
                            'max' => 1280,
                            'step' => 10,
                        ],
                    ],
                    'default' => [
                        'size' => 480,
                    ],
                ]
        );

        $this->add_control(
                'height',
                [
                    'label' => __('Height', 'elementor-bundle-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 50,
                            'max' => 1000,
                            'step' => 5,
                        ],
                    ],
                    'default' => [
                        'size' => 327,
                    ],
                ]
        );

        $this->add_control(
                'full_screen_button',
                [
                    'label' => __('Fullscreen Button', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'tspv_fb_icon',
                [
                    'label' => __('Button Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'toggle' => false,
                    'options' => [
                        'fas fa-expand' => [
                            'title' => __('Expand', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fas fa-expand',
                        ],
                        'fas fa-plus' => [
                            'title' => __('Plus', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fas fa-plus',
                        ],
                        'fas fa-search' => [
                            'title' => __('Zoom', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fas fa-search',
                        ],
                    ],
                    'default' => 'search',
                    'condition' => [
                        'full_screen_button' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'tspv_fb_icon_position',
                [
                    'label' => __('Icon Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '' => esc_html__('Default', SA_EL_ADDONS_TEXTDOMAIN),
                        'top-left' => esc_html__('Top Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'top-center' => esc_html__('Top Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'top-right' => esc_html__('Top Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'center' => esc_html__('Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'center-left' => esc_html__('Center Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'center-right' => esc_html__('Center Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom-left' => esc_html__('Bottom Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom-center' => esc_html__('Bottom Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom-right' => esc_html__('Bottom Right', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'bottom-left',
                    'condition' => [
                        'full_screen_button' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'tspv_fb_icon_on_hover',
                [
                    'label' => __('Icon On Hover', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'prefix_class' => 'sa-el-tspv-fb-icon-on-hover-',
                    'condition' => [
                        'full_screen_button' => 'yes',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_content_additional',
                [
                    'label' => __('Additional', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'animate',
                [
                    'label' => __('Animate', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => 'yes',
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('Starts the animation automatically on load', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'frame_time',
                [
                    'label' => __('Frame Time', 'elementor-bundle-addons'),
                    'description' => __('Time in ms between updates. e.g. 40 is exactly 25 FPS', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'condition' => [
                        'animate' => 'yes'
                    ],
                ]
        );

        $this->add_control(
                'loop',
                [
                    'label' => __('Loop', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'condition' => [
                        'animate' => 'yes'
                    ],
                ]
        );

        $this->add_control(
                'stop_frame',
                [
                    'label' => __('Stop Frame', 'elementor-bundle-addons'),
                    'description' => __('Stops the animation on that frame if `loop` is false', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'condition' => [
                        'loop!' => 'yes'
                    ]
                ]
        );

        $this->add_control(
                'reverse',
                [
                    'label' => __('Reverse', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('Animation playback is reversed', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'animate' => 'yes'
                    ],
                ]
        );

        $this->add_control(
                'retain_animate',
                [
                    'label' => __('Retain Animate', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => __('Retains the animation after user iser interaction', SA_EL_ADDONS_TEXTDOMAIN),
                    'default' => 'yes',
                    'type' => Controls_Manager::SWITCHER,
                    'separator' => 'after',
                    'condition' => [
                        'animate' => 'yes'
                    ],
                ]
        );

        $this->add_control(
                'mouse_option',
                [
                    'label' => esc_html__('Mouse Option', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'drag',
                    'options' => [
                        '' => esc_html__('None', SA_EL_ADDONS_TEXTDOMAIN),
                        'drag' => esc_html__('Drag', SA_EL_ADDONS_TEXTDOMAIN),
                        'move' => esc_html__('Move', SA_EL_ADDONS_TEXTDOMAIN),
                        'wheel' => esc_html__('Wheel', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_control(
                'sense',
                [
                    'label' => __('Reverse', 'elementor-bundle-addons'),
                    'description' => __('Sensitivity factor for user interaction', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'condition' => [
                        'mouse_option' => ['drag', 'move'],
                    ],
                    'separator' => 'after',
                ]
        );

        $this->add_control(
                'ease',
                [
                    'label' => __('Easing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                ]
        );

        $this->add_control(
                'blur',
                [
                    'label' => __('Blur', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                ]
        );

        // $this->add_control(
        // 	'sub_sampling',
        // 	[
        // 		'label'       => __( 'Detect Sub Sampling', SA_EL_ADDONS_TEXTDOMAIN ),
        // 		'description' => __( 'Tries to detect whether the images are downsampled by the browser', SA_EL_ADDONS_TEXTDOMAIN ),
        // 		'type'        => Controls_Manager::SWITCHER,
        // 	]
        // );
        // $this->add_control(
        // 	'frame',
        // 	[
        // 		'label'       => __('Frame', 'elementor-bundle-addons'),
        // 		'description' => __( 'Initial frame number', SA_EL_ADDONS_TEXTDOMAIN ),
        // 		'type'        => Controls_Manager::NUMBER,
        // 		'default'     => 0,
        // 	]
        // );
        // $this->add_control(
        // 	'wrap',
        // 	[
        // 		'label'       => __( 'Wrap', SA_EL_ADDONS_TEXTDOMAIN ),
        // 		'default'     => 'yes',
        // 		'type'        => Controls_Manager::SWITCHER,
        // 		'description' => __( 'Allows the user to drag the animation beyond the last frame and wrap over to the beginning', SA_EL_ADDONS_TEXTDOMAIN ),
        // 	]
        // );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_icon',
                [
                    'label' => esc_html__('Icon Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'full_screen_button' => 'yes',
                    ],
                ]
        );

        $this->start_controls_tabs('tabs_icon_style');

        $this->start_controls_tab(
                'tab_icon_normal',
                [
                    'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_responsive_control(
                'icon_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 2,
                            'max' => 100,
                            'step' => 10,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon' => 'font-size: {{SIZE}}px;',
                    ],
                ]
        );

        $this->add_control(
                'icon_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'background_color',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'border',
                    'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .sa-el-icon',
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'icon_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'icon_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-icon',
                ]
        );

        $this->add_control(
                'icon_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'tab_icon_hover',
                [
                    'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'hover_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon:hover' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'icon_background_hover_color',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'icon_hover_border_color',
                [
                    'label' => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'border_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-icon:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $image_urls = [];
        $tspv_plugins = [];

        if ('local' == $settings['source_type']) {
            foreach ($settings['images'] as $index => $item) :
                ?>
                <?php $image_urls[] = Group_Control_Image_Size::get_attachment_image_src($item['id'], 'thumbnail', $settings); ?>
                <?php
            endforeach;
        } elseif ('remote' == $settings['source_type']) {
            $image_urls = $settings['remote_images']['url'];
        }

        if (!empty($image_urls)) {

            $tspv_plugins[] = '360';
            $tspv_plugins[] = 'progress';

            if ($settings['mouse_option']) {
                $tspv_plugins[] = $settings['mouse_option'];
            }
            if ($settings['ease']) {
                $tspv_plugins[] = 'ease';
            }
            if ($settings['blur']) {
                $tspv_plugins[] = 'blur';
            }

            $this->add_render_attribute(
                    [
                        'threesixty' => [
                            'data-settings' => [
                                wp_json_encode(array_filter([
                                    "source_type" => $settings["source_type"],
                                    "frame_limit" => ("remote" == $settings["source_type"]) ? [$settings["start_frame"]["size"], $settings["end_frame"]["size"]] : false,
                                    "image_digits" => ("remote" == $settings["source_type"]) ? $settings["digit_number"] : false,
                                    "source" => $image_urls,
                                    "width" => $settings["width"]["size"],
                                    "height" => $settings["height"]["size"],
                                    "animate" => $settings["animate"] ? true : false,
                                    "frameTime" => $settings["frame_time"],
                                    "loop" => $settings["loop"] ? true : false,
                                    "retainAnimate" => $settings["retain_animate"] ? true : false,
                                    "reverse" => $settings["reverse"] ? true : false,
                                    "sense" => ($settings["sense"]) ? -1 : false,
                                    "stopFrame" => $settings["stop_frame"],
                                    "responsive" => true,
                                    "plugins" => $tspv_plugins,
                                ]))
                            ]
                        ]
                    ]
            );

            $this->add_render_attribute('threesixty', 'class', 'sa-el-threesixty-product-viewer');

            if ($settings['full_screen_button']) {
                $this->add_render_attribute('tspv-fb', [
                    'href' => '#',
                    'class' => 'sa-el-tspv-fb ' . $settings['tspv_fb_icon'] . ' sa-el-icon sa-el-position-small sa-el-position-' . $settings['tspv_fb_icon_position'],
                ]);
            }
            ?>
            <div <?php echo $this->get_render_attribute_string('threesixty'); ?>>

                <div class="sa-el-tspv-container"></div>

                <?php if ($settings['full_screen_button']) : ?>
                    <a <?php echo $this->get_render_attribute_string('tspv-fb'); ?>></a>
                <?php endif; ?>

            </div>
            <?php
        } else {
            ?>
            <div class="sa-el-alert-warning" sa-el-alert>
                <a class="sa-el-alert-close" sa-el-close></a>
                <p><?php printf(__('Please choose a set of images or set url.', SA_EL_ADDONS_TEXTDOMAIN)); ?></p>
            </div>
            <?php
        }
    }

}
