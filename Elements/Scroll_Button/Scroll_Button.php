<?php

namespace SA_EL_ADDONS\Elements\Scroll_Button;

if (!defined('ABSPATH')) {
    exit;
}


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;


class Scroll_Button extends Widget_Base
{

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name()
    {
        return 'sa_el_scroll_button';
    }

    public function get_title()
    {
        return esc_html__('Scroll Button', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-download-button  oxi-el-admin-icon';
    }

    public function get_categories()
    {
        return ['sa-el-addons'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content_scroll_button',
            [
                'label' => esc_html__('Button', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'duration',
            [
                'label'      => esc_html__('Duration', SA_EL_ADDONS_TEXTDOMAIN),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 100,
                        'max'  => 5000,
                        'step' => 50,
                    ],
                ],
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', SA_EL_ADDONS_TEXTDOMAIN),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => -200,
                        'max'  => 200,
                        'step' => 10,
                    ],
                ],
            ]
        );

        $this->add_control(
            'scroll_button_text',
            [
                'label'       => esc_html__('Button Text', SA_EL_ADDONS_TEXTDOMAIN),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'default'     => esc_html__('Scroll Up', SA_EL_ADDONS_TEXTDOMAIN),
                'placeholder' => esc_html__('Scroll Up', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'section_id',
            [
                'label'       => esc_html__('Section ID', SA_EL_ADDONS_TEXTDOMAIN),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'my-header',
                'description' => esc_html__("By clicking this scroll button, to which section in your page you want to go? Just write that's section ID here such 'my-header'. N.B: No need to add '#'.", SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'scroll_button_position',
            [
                'label'   => __('Scroll Button Position', SA_EL_ADDONS_TEXTDOMAIN),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    ''              => esc_html__('Default', SA_EL_ADDONS_TEXTDOMAIN),
                    'top-left'      => esc_html__('Top Left', SA_EL_ADDONS_TEXTDOMAIN),
                    'top-center'    => esc_html__('Top Center', SA_EL_ADDONS_TEXTDOMAIN),
                    'top-right'     => esc_html__('Top Right', SA_EL_ADDONS_TEXTDOMAIN),
                    'center'        => esc_html__('Center', SA_EL_ADDONS_TEXTDOMAIN),
                    'center-left'   => esc_html__('Center Left', SA_EL_ADDONS_TEXTDOMAIN),
                    'center-right'  => esc_html__('Center Right', SA_EL_ADDONS_TEXTDOMAIN),
                    'bottom-left'   => esc_html__('Bottom Left', SA_EL_ADDONS_TEXTDOMAIN),
                    'bottom-center' => esc_html__('Bottom Center', SA_EL_ADDONS_TEXTDOMAIN),
                    'bottom-right'  => esc_html__('Bottom Right', SA_EL_ADDONS_TEXTDOMAIN),
                ],
            ]
        );

        $this->add_responsive_control(
            'scroll_button_offset',
            [
                'label'     => __('Button Offset', SA_EL_ADDONS_TEXTDOMAIN),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .sa-el-scroll-button-wrapper' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'condition' => [
                    'scroll_button_position!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'scroll_button_align',
            [
                'label'        => esc_html__('Button Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                'type'         => Controls_Manager::CHOOSE,
                'prefix_class' => 'elementor%s-align-',
                'default'      => 'center',
                'options'      => [
                    'left' => [
                        'title' => esc_html__('Left', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon'  => 'fas fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', SA_EL_ADDONS_TEXTDOMAIN),
                        'icon'  => 'fas fa-align-justify',
                    ],
                ],
                'condition' => [
                    'scroll_button_position' => '',
                ],
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label'       => esc_html__('Button Icon', SA_EL_ADDONS_TEXTDOMAIN),
                'type'        => Controls_Manager::ICONS,
                'fa4compatibility' => 'scroll_button_icon',
                'default' => [
                    'value' => 'fas fa-angle-up',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'icon_align',
            [
                'label'   => esc_html__('Icon Position', SA_EL_ADDONS_TEXTDOMAIN),
                'type'    => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'left'  => esc_html__('Before', SA_EL_ADDONS_TEXTDOMAIN),
                    'right' => esc_html__('After', SA_EL_ADDONS_TEXTDOMAIN),
                ],
                'condition' => [
                    'button_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon_indent',
            [
                'label'   => esc_html__('Icon Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 8,
                ],
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'condition' => [
                    'button_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-scroll-button.icon_align_right .sa-el-scroll-button-align-icon-right' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sa-el-scroll-button.icon_align_left .sa-el-scroll-button-align-icon-left'  => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();

        $this->start_controls_section(
            'section_style_scroll_button',
            [
                'label' => esc_html__('Button', SA_EL_ADDONS_TEXTDOMAIN),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_scroll_button_style');

        $this->start_controls_tab(
            'tab_scroll_button_normal',
            [
                'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'scroll_button_text_color',
            [
                'label'     => esc_html__('Button Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-el-scroll-button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sa-el-scroll-button svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'scroll_button_background_color',
            [
                'label'     => esc_html__('Button Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-el-scroll-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'scroll_button_border',
                'label'       => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .sa-el-scroll-button',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label'      => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-el-scroll-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'scroll_button_box_shadow',
                'selector' => '{{WRAPPER}} .sa-el-scroll-button',
            ]
        );

        $this->add_control(
            'scroll_button_padding',
            [
                'label'      => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-el-scroll-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'scroll_button_typography',
                'label'    => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .sa-el-scroll-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_scroll_button_hover',
            [
                'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'scroll_button_hover_color',
            [
                'label'     => esc_html__('Button Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-el-scroll-button:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sa-el-scroll-button:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'scroll_button_background_hover_color',
            [
                'label'     => esc_html__('Button Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-el-scroll-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'scroll_button_hover_border_color',
            [
                'label'     => esc_html__('Button Border Color', SA_EL_ADDONS_TEXTDOMAIN),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'scroll_button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-el-scroll-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'scroll_button_hover_animation',
            [
                'label' => esc_html__('Button Animation', SA_EL_ADDONS_TEXTDOMAIN),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render_text($settings)
    {
        $settings = $this->get_settings();

        $this->add_render_attribute('content-wrapper', 'class', 'sa-el-scroll-button-content-wrapper');
        $this->add_render_attribute('text', 'class', 'sa-el-scroll-button-text');

        if (!isset($settings['scroll_button_icon']) && !Icons_Manager::is_migration_allowed()) {
            // add old default
            $settings['scroll_button_icon'] = 'fas fa-arrow-down';
        }

        $migrated  = isset($settings['__fa4_migrated']['button_icon']);
        $is_new    = empty($settings['scroll_button_icon']) && Icons_Manager::is_migration_allowed();

        ?>
        <span <?php echo $this->get_render_attribute_string('content-wrapper'); ?>>
            <?php if (!empty($settings['button_icon']['value'])) : ?>
                <span class="sa-el-scroll-button-align-icon-<?php echo esc_attr($settings['icon_align']); ?>">

                    <?php if ($is_new || $migrated) :
                                    Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true', 'class' => 'fa-fw']);
                                else : ?>
                        <i class="<?php echo esc_attr($settings['scroll_button_icon']); ?>" aria-hidden="true"></i>
                    <?php endif; ?>

                </span>
            <?php endif; ?>
            <span <?php echo $this->get_render_attribute_string('text'); ?>><?php echo esc_html($settings['scroll_button_text']); ?></span>
        </span>
    <?php
        }

        protected function render()
        {
            $settings = $this->get_settings();

            $this->add_render_attribute(
                'sa-el-scroll-button',
                'class',
                [
                    'sa-el-scroll-button',
                    'sa-el-button',
                    'sa-el-button-primary',
                    'icon_align_' . $settings['icon_align'],
                ]
            );

            //$this->add_render_attribute( 'sa-el-scroll-button', 'sa-el-scroll', '' );

            if ($settings['scroll_button_hover_animation']) {
                $this->add_render_attribute('sa-el-scroll-button', 'class', 'elementor-animation-' . esc_attr($settings['scroll_button_hover_animation']));
            }

            $this->add_render_attribute(
                [
                    'sa-el-scroll-button' => [
                        'data-settings' => [
                            wp_json_encode(array_filter([
                                'duration' => ('' != $settings['duration']['size']) ? $settings['duration']['size'] : '',
                                'offset' => ('' != $settings['offset']['size']) ? $settings['offset']['size'] : '',
                            ]))
                        ]
                    ]
                ]
            );

            if ('' !== $settings['scroll_button_position']) {
                $this->add_render_attribute('sa-el-scroll-wrapper', 'class', ['sa-el-position-fixed', 'sa-el-position-' . $settings['scroll_button_position']]);
            }

            $this->add_render_attribute('sa-el-scroll-button', 'data-selector', '#' . esc_attr($settings['section_id']));

            $this->add_render_attribute('sa-el-scroll-wrapper', 'class', 'sa-el-scroll-button-wrapper');

            ?>
        <div <?php echo $this->get_render_attribute_string('sa-el-scroll-wrapper'); ?>>
            <button <?php echo $this->get_render_attribute_string('sa-el-scroll-button'); ?>>
                <?php $this->render_text($settings); ?>
            </button>
        </div>

<?php
    }
}
