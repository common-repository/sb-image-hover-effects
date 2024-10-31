<?php

namespace SA_EL_ADDONS\Elements\Buddypress_Group;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;

class Buddypress_Group extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_buddypress_group';
    }

    public function get_title() {
        return esc_html__('Buddypress Group', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-person  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'section_content_layout',
                [
                    'label' => esc_html__('Layout', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );
        if (!is_plugin_active('buddypress/bp-loader.php')) {
            $this->add_control(
                    'buddypress_missing_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => sprintf(
                                __('Hi, it seems %1$s is missing in your site. Please install and activate %1$s first.', SA_EL_ADDONS_TEXTDOMAIN),
                                '<a href="https://wordpress.org/plugins/buddypress/" target="_blank" rel="noopener">Buddypress</a>'
                        ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    ]
            );
            $this->end_controls_section();
            return;
        }

        $this->add_control(
                'groups_type',
                [
                    'label' => esc_html__('Groups Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'newest',
                    'options' => [
                        'newest' => esc_html__('Newest', SA_EL_ADDONS_TEXTDOMAIN),
                        'popular' => esc_html__('Popular', SA_EL_ADDONS_TEXTDOMAIN),
                        'active' => esc_html__('Active', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                ]
        );

        $this->add_responsive_control(
                'max_groups',
                [
                    'label' => esc_html__('Max Groups', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 5,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 20,
                            'step' => 1,
                        ],
                    ],
                ]
        );

        $this->add_responsive_control(
                'columns',
                [
                    'label' => esc_html__('Columns', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => '6',
                    'tablet_default' => '4',
                    'mobile_default' => '2',
                    'options' => [
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        'auto' => 'Auto',
                    ],
                ]
        );

        $this->add_responsive_control(
                'column_gap',
                [
                    'label' => esc_html__('Column Gap', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 15,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 5,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-buddypress-groups .sa-el-grid' => 'margin-left: -{{SIZE}}px',
                        '{{WRAPPER}} .sa-el-buddypress-groups .sa-el-grid > *' => 'padding-left: {{SIZE}}px',
                    ],
                ]
        );

        $this->add_responsive_control(
                'row_gap',
                [
                    'label' => esc_html__('Row Gap', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 15,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 5,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-buddypress-groups .sa-el-grid' => 'margin-top: -{{SIZE}}px',
                        '{{WRAPPER}} .sa-el-buddypress-groups .sa-el-grid > *' => 'margin-top: {{SIZE}}px',
                    ],
                ]
        );

        $this->add_control(
                'align',
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
                    'default' => 'center',
                ]
        );

        $this->add_control(
                'show_avatar',
                [
                    'label' => esc_html__('Show Avatar', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'show_title',
                [
                    'label' => esc_html__('Show Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'show_meta_as_tooltip',
                [
                    'label' => esc_html__('Show Meta as Tooltip', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->end_controls_section();
        $this->Sa_El_Support();
        $this->start_controls_section(
                'section_style_avatar',
                [
                    'label' => esc_html__('Avatar', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_avatar' => 'yes',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'avatar_border',
                    'label' => __('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .sa-el-bp-group-avatar img',
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'avatar_border_radius',
                [
                    'label' => __('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-bp-group-avatar img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    ],
                ]
        );

        $this->add_control(
                'avatar_opacity',
                [
                    'label' => __('Opacity (%)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 1,
                    ],
                    'range' => [
                        'px' => [
                            'max' => 1,
                            'min' => 0.10,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-bp-group-avatar img' => 'opacity: {{SIZE}};',
                    ],
                ]
        );

        $this->add_control(
                'avatar_spacing',
                [
                    'label' => __('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-bp-group-avatar img' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_title',
                [
                    'label' => __('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_title' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'title_color',
                [
                    'label' => __('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-bp-group-title a' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .sa-el-bp-group-title a',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                ]
        );

        $this->end_controls_section();
    }

    public function render() {
        if (is_plugin_active('buddypress/bp-loader.php')) :

            $settings = $this->get_settings_for_display();
            $type = $settings['groups_type'];

            $groups_args = array(
                'user_id' => 0,
                'type' => esc_attr($type),
                'per_page' => esc_attr($settings['max_groups']['size']),
                'max' => esc_attr($settings['max_groups']['size']),
            );

            if (bp_is_active('groups') and bp_has_groups($groups_args)) :
                ?>

                <div class="sa-el-buddypress-groups">
                    <div class="sa-el-grid sa-el-grid-small sa-el-text-<?php echo esc_attr($settings['align']); ?> sa-el-flex-<?php echo esc_attr($settings['align']); ?>" sa-el-grid>


                <?php while (bp_groups()) : bp_the_group(); ?>

                    <?php
                    $this->add_render_attribute('bp-group', 'class', 'sa-el-bp-group sa-el-custom-tooltip');

                    if ('auto' !== $settings['columns']) {
                        $this->add_render_attribute('bp-group', 'class', 'sa-el-width-1-' . $settings['columns_mobile']);
                        $this->add_render_attribute('bp-group', 'class', 'sa-el-width-1-' . $settings['columns_tablet'] . '@s');
                        $this->add_render_attribute('bp-group', 'class', 'sa-el-width-1-' . $settings['columns'] . '@m');
                    } else {
                        $this->add_render_attribute('bp-group', 'class', 'sa-el-width-auto');
                    }
                    ?>

                            <?php if ($settings['show_meta_as_tooltip']) : ?>
                                <?php if ('active' === $type) : ?>
                                    <?php $this->add_render_attribute('bp-group', 'data-custom-tooltip', bp_get_group_last_active(), true); ?>
                                <?php elseif ('newest' === $type) : ?>
                                    <?php $this->add_render_attribute('bp-group', 'data-custom-tooltip', bp_get_group_date_created(), true); ?>
                                <?php elseif ('popular' === $type) : ?>
                                    <?php $this->add_render_attribute('bp-group', 'data-custom-tooltip', bp_get_group_member_count(), true); ?>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div <?php echo $this->get_render_attribute_string('bp-group'); ?>>
                            <?php if ($settings['show_avatar']) : ?>
                                    <div class="sa-el-bp-group-avatar">
                                        <a href="<?php bp_group_permalink() ?>"><?php bp_group_avatar_thumb() ?></a>
                                    </div>
                    <?php endif; ?>

                                <?php if ($settings['show_title']) : ?>
                                    <div class="sa-el-bp-group-title"><?php bp_group_link(); ?></div>
                    <?php endif; ?>
                            </div>
                            <?php endwhile; ?>
                    </div>
                </div>

                        <?php else : ?>
                <div class="sa-el-alert-warning" sa-el-alert>No groups matched the current filter or group not active. </div>
                    <?php
                    endif;

                else :
                    echo '<dev class="sa-el-alert sa-el-alert-warning">
        ' . sprintf(
                            __('Hi, it seems %1$s is missing in your site. Please install and activate %1$s first.', SA_EL_ADDONS_TEXTDOMAIN),
                            '<a href="https://wordpress.org/plugins/buddypress/" target="_blank" rel="noopener">Buddypress</a>'
                    ) . '</dev>';
                endif;
            }

        }
        