<?php

namespace SA_EL_ADDONS\Elements\Background_Transition;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Background Transition
 *
 * @author biplo
 * 
 */
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Background_Transition extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_background_transition';
    }

    public function get_title() {
        return esc_html__('Background Transition', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return ' eicon-alert  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    public function get_script_depends() {
        return [
            'elementor-waypoints',
        ];
    }

    public function get_keywords() {
        return ['color', 'scroll', 'background', 'transition', 'ea'];
    }

    public function is_reload_preview_required() {
        return true;
    }

    protected function _register_controls() {

        $this->start_controls_section('sections',
                [
                    'label' => __('Content', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $id_repeater = new REPEATER();

        $id_repeater->add_control('section_id',
                [
                    'label' => __('CSS ID', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => ['active' => true],
                ]
        );

        $id_repeater->start_controls_tabs('colors');

        $id_repeater->start_controls_tab('scroll_down',
                [
                    'label' => sprintf('<i class="fa fa-arrow-down sa-el-editor-icon"/>%s', __('Scroll Down', SA_EL_ADDONS_TEXTDOMAIN)),
                ]
        );

        $id_repeater->add_control('scroll_down_type',
                [
                    'label' => __('Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'color' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'image' => __('Image', SA_EL_ADDONS_TEXTDOMAIN)
                    ],
                    'default' => 'color',
                ]
        );

        $id_repeater->add_control('scroll_down_doc',
                [
                    'raw' => __('This color is applied while scrolling down', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::RAW_HTML,
                    'content_classes' => 'editor-sa-el-doc',
                ]
        );

        $id_repeater->add_control('down_color',
                [
                    'label' => __('Select Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'redner_type' => 'template',
                    'selectors' => [
                        '#sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="down"], #sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="up"]' => 'background: {{VALUE}}'
                    ],
                    'condition' => [
                        'scroll_down_type' => 'color'
                    ]
                ]
        );

        $id_repeater->add_control('down_image',
                [
                    'label' => __('Image', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => ['active' => true],
                    'label_block' => true,
                    'selectors' => [
                        '#sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="down"], #sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="up"]' => 'background: transparent; background-image: url("{{URL}}")'
                    ],
                    'condition' => [
                        'scroll_down_type' => 'image'
                    ]
                ]
        );

        $id_repeater->add_responsive_control('down_image_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'auto' => __('Auto', SA_EL_ADDONS_TEXTDOMAIN),
                        'contain' => __('Contain', SA_EL_ADDONS_TEXTDOMAIN),
                        'cover' => __('Cover', SA_EL_ADDONS_TEXTDOMAIN),
                        'custom' => __('Custom', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'auto',
                    'label_block' => true,
                    'condition' => [
                        'scroll_down_type' => 'image',
                    ],
                    'selectors' => [
                        '#sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="down"], #sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="up"]' => 'background-size: {{VALUE}}',
                    ],
                ]
        );

        $id_repeater->add_responsive_control('down_image_size_custom',
                [
                    'label' => __('Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em', '%', 'vw'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'vw' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 100,
                        'unit' => '%',
                    ],
                    'condition' => [
                        'scroll_down_type' => 'image',
                        'down_image_size' => 'custom'
                    ],
                    'selectors' => [
                        '#sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="down"], #sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="up"]' => 'background-size: {{SIZE}}{{UNIT}} auto',
                    ]
                ]
        );


        $id_repeater->add_responsive_control('down_image_position',
                [
                    'label' => __('Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'center center' => __('Center Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'center left' => __('Center Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'center right' => __('Center Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'top center' => __('Top Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'top left' => __('Top Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'top right' => __('Top Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom center' => __('Bottom Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom left' => __('Bottom Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom right' => __('Bottom Right', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'center center',
                    'label_block' => true,
                    'condition' => [
                        'scroll_down_type' => 'image'
                    ],
                    'selectors' => [
                        '#sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="down"], #sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="up"]' => 'background-position: {{VALUE}}',
                    ],
                ]
        );

        $id_repeater->add_responsive_control('down_image_repeat',
                [
                    'label' => __('Repeat', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'repeat' => __('Repeat', SA_EL_ADDONS_TEXTDOMAIN),
                        'no-repeat' => __('No-repeat', SA_EL_ADDONS_TEXTDOMAIN),
                        'repeat-x' => __('Repeat-x', SA_EL_ADDONS_TEXTDOMAIN),
                        'repeat-y' => __('Repeat-y', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'repeat',
                    'label_block' => true,
                    'condition' => [
                        'scroll_down_type' => 'image'
                    ],
                    'selectors' => [
                        '#sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="down"], #sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="up"]' => 'background-repeat: {{VALUE}}',
                    ],
                ]
        );

        $id_repeater->end_controls_tab();

        $id_repeater->start_controls_tab('scroll_up',
                [
                    'label' => sprintf('<i class="fa fa-arrow-up sa-el-editor-icon"/>%s', __('Scroll Up', SA_EL_ADDONS_TEXTDOMAIN)),
                ]
        );

        $id_repeater->add_control('scroll_up_doc',
                [
                    'raw' => __('This color is applied while scrolling up', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::RAW_HTML,
                    'content_classes' => 'editor-sa-el-doc',
                ]
        );

        $id_repeater->add_control('scroll_up_type',
                [
                    'label' => __('Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'color' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                        'image' => __('Image', SA_EL_ADDONS_TEXTDOMAIN)
                    ],
                    'default' => 'color',
                ]
        );

        $id_repeater->add_control('up_color',
                [
                    'label' => __('Select Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '#sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="up"]' => 'background: {{VALUE}}'
                    ],
                    'condition' => [
                        'scroll_up_type' => 'color'
                    ]
                ]
        );

        $id_repeater->add_control('up_image',
                [
                    'label' => __('Image', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => ['active' => true],
                    'label_block' => true,
                    'selectors' => [
                        '#sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="up"]' => 'background: transparent; background-image: url("{{URL}}")'
                    ],
                    'condition' => [
                        'scroll_up_type' => 'image'
                    ]
                ]
        );

        $id_repeater->add_responsive_control('up_image_size',
                [
                    'label' => __('Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'auto' => __('Auto', SA_EL_ADDONS_TEXTDOMAIN),
                        'contain' => __('Contain', SA_EL_ADDONS_TEXTDOMAIN),
                        'cover' => __('Cover', SA_EL_ADDONS_TEXTDOMAIN),
                        'custom' => __('Custom', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'auto',
                    'label_block' => true,
                    'selectors' => [
                        '#sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="up"]' => 'background-size: {{VALUE}}',
                    ],
                    'condition' => [
                        'scroll_up_type' => 'image'
                    ]
                ]
        );

        $id_repeater->add_responsive_control('up_image_size_custom',
                [
                    'label' => __('Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em', '%', 'vw'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'vw' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 100,
                        'unit' => '%',
                    ],
                    'condition' => [
                        'scroll_up_type' => 'image',
                        'up_image_size' => 'custom'
                    ],
                    'selectors' => [
                        '#sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="up"]' => 'background-size: {{SIZE}}{{UNIT}} auto',
                    ]
                ]
        );


        $id_repeater->add_responsive_control('up_image_position',
                [
                    'label' => __('Position', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'center center' => __('Center Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'center left' => __('Center Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'center right' => __('Center Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'top center' => __('Top Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'top left' => __('Top Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'top right' => __('Top Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom center' => __('Bottom Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom left' => __('Bottom Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'bottom right' => __('Bottom Right', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'center center',
                    'label_block' => true,
                    'condition' => [
                        'scroll_up_type' => 'image'
                    ],
                    'selectors' => [
                        '#sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="up"]' => 'background-position: {{VALUE}}',
                    ],
                ]
        );

        $id_repeater->add_responsive_control('up_image_repeat',
                [
                    'label' => __('Repeat', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'repeat' => __('Repeat', SA_EL_ADDONS_TEXTDOMAIN),
                        'no-repeat' => __('No-repeat', SA_EL_ADDONS_TEXTDOMAIN),
                        'repeat-x' => __('Repeat-x', SA_EL_ADDONS_TEXTDOMAIN),
                        'repeat-y' => __('Repeat-y', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'repeat',
                    'label_block' => true,
                    'condition' => [
                        'scroll_up_type' => 'image'
                    ],
                    'selectors' => [
                        '#sa-el-color-transition-{{ID}} {{CURRENT_ITEM}}[data-direction="up"]' => 'background-repeat: {{VALUE}}',
                    ],
                ]
        );

        $id_repeater->end_controls_tab();

        $id_repeater->end_controls_tabs();

        $this->add_control('id_repeater',
                [
                    'label' => __('Elements', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => array_values($id_repeater->get_controls()),
                    'title_field' => '{{{ section_id }}}'
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section('advanced',
                [
                    'label' => __('Advanced Settings', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_responsive_control('duration',
                [
                    'label' => __('Transition Duration', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 3,
                            'step' => 0.1
                        ]
                    ],
                    'selectors' => [
                        '#sa-el-color-transition-{{ID}} .sa-el-color-transition-layer' => 'transition-duration: {{SIZE}}s'
                    ]
                ]
        );

        $this->add_responsive_control('offset',
                [
                    'label' => __('Offset (PX)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'description' => __('Distance between the top of viewport and top of the element, default: 30', SA_EL_ADDONS_TEXTDOMAIN),
                    'min' => 0,
                    'default' => 30
                ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();
    }
    /**
     * Render Grid output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.7.1
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings_for_display();

        $repeater = $settings['id_repeater'];

        $elements = array();

        $down_colors = array();

        $up_colors = array();

        $items_ids = array();

        foreach ($repeater as $element) {

            array_push($elements, $element['section_id']);

            array_push($items_ids, $element['_id']);

            if ('image' === $element['scroll_down_type'] && !empty($element['down_image']['url'])) {

                $element['down_background'] = $element['down_image']['url'];
            } else {
                $element['down_background'] = $element['down_color'];
            }

            if ('image' === $element['scroll_up_type'] && !empty($element['up_image']['url'])) {

                $element['up_background'] = $element['up_image']['url'];
            } else {
                $element['up_background'] = $element['up_color'];
            }

            array_push($down_colors, $element['down_background']);

            array_push($up_colors, $element['up_background']);
        }

        $elements_colors = [
            'elements' => $elements,
            'down_colors' => $down_colors,
            'up_colors' => $up_colors,
            'offset' => $settings['offset'],
            'offset_tablet' => $settings['offset_tablet'],
            'offset_mobile' => $settings['offset_mobile'],
            'itemsIDs' => $items_ids,
            'id' => $this->get_id()
        ];

        $this->add_render_attribute("container", "class", "sa-el-scroll-background");

        $this->add_render_attribute("container", "data-settings", wp_json_encode($elements_colors));
        ?>

        <div <?php echo $this->get_render_attribute_string("container"); ?>></div>

        <?php
    }

}
