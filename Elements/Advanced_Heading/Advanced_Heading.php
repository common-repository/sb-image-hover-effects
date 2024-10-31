<?php

namespace SA_EL_ADDONS\Elements\Advanced_Heading;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Advanced_Heading
 *
 * @author biplo
 * 
 */
use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Widget_Base as Widget_Base;
use \SA_EL_ADDONS\Classes\Bootstrap;

class Advanced_Heading extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_advanced_heading';
    }

    public function get_title() {
        return esc_html__('Advanced Heading', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-heading  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {

        /**
         * Advanced Heading Content Settings
         */
        $this->start_controls_section(
                'sa_el_section_dch_content_settings', [
            'label' => esc_html__('Content Settings', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_control(
                'sa_el_dch_type', [
            'label' => esc_html__('Content Style', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SELECT,
            'default' => 'dch-icon-on-top',
            'label_block' => false,
            'options' => [
                'dch-default' => esc_html__('Default', SA_EL_ADDONS_TEXTDOMAIN),
                'dch-icon-on-top' => esc_html__('Icon on top', SA_EL_ADDONS_TEXTDOMAIN),
                'dch-icon-subtext-on-top' => esc_html__('Icon &amp; sub-text on top', SA_EL_ADDONS_TEXTDOMAIN),
                'dch-subtext-on-top' => esc_html__('Sub-text on top', SA_EL_ADDONS_TEXTDOMAIN),
            ],
                ]
        );

        $this->add_control(
                'sa_el_show_dch_icon_content', [
            'label' => __('Show Icon', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
            'label_on' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
            'label_off' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
            'return_value' => 'yes',
            'separator' => 'after',
                ]
        );
        /**
         * Condition: 'sa_el_show_dch_icon_content' => 'yes'
         */
        $this->add_control(
                'sa_el_dch_icon', [
            'label' => esc_html__('Icon', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => $this->Sa_El_Icon_Type(),
            'default' => $this->Sa_El_Default_Icon('fa fa-briefcase', 'fa-solid', 'fa fa-briefcase'),
            'condition' => [
                'sa_el_show_dch_icon_content' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'sa_el_dch_first_title', [
            'label' => esc_html__('Title ( First Part )', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => esc_html__('Advanced Heading', SA_EL_ADDONS_TEXTDOMAIN),
            'dynamic' => ['action' => true]
                ]
        );

        $this->add_control(
                'sa_el_dch_last_title', [
            'label' => esc_html__('Title ( Last Part )', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => esc_html__('Example', SA_EL_ADDONS_TEXTDOMAIN),
            'dynamic' => ['action' => true]
                ]
        );

        $this->add_control(
                'sa_el_dch_subtext', [
            'label' => esc_html__('Sub Text', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::WYSIWYG,
            'label_block' => true,
            'default' => esc_html__('Insert a meaningful line to evaluate the headline.', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        $this->add_responsive_control(
                'sa_el_dch_content_alignment', [
            'label' => esc_html__('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::CHOOSE,
            'label_block' => true,
            'options' => [
                'left' => [
                    'title' => esc_html__('Left', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'fa fa-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'fa fa-align-center',
                ],
                'right' => [
                    'title' => esc_html__('Right', SA_EL_ADDONS_TEXTDOMAIN),
                    'icon' => 'fa fa-align-right',
                ],
            ],
            'default' => 'center',
            'prefix_class' => 'sa_el_advance_header-content-align-'
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();
        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style ( Dual Heading Style )
         * -------------------------------------------
         */
        $this->start_controls_section(
                'sa_el_section_dch_style_settings', [
            'label' => esc_html__('Dual Heading Style', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE
                ]
        );

        $this->add_control(
                'sa_el_dch_bg_color', [
            'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .sa_el_advance_header' => 'background-color: {{VALUE}};',
            ],
                ]
        );

        $this->add_responsive_control(
                'sa_el_dch_container_padding', [
            'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa_el_advance_header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->add_responsive_control(
                'sa_el_dch_container_margin', [
            'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa_el_advance_header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(), [
            'name' => 'sa_el_dch_border',
            'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
            'selector' => '{{WRAPPER}} .sa_el_advance_header',
                ]
        );

        $this->add_control(
                'sa_el_dch_border_radius', [
            'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .sa_el_advance_header' => 'border-radius: {{SIZE}}px;',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(), [
            'name' => 'sa_el_dch_shadow',
            'selector' => '{{WRAPPER}} .sa_el_advance_header',
                ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Icon Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
                'sa_el_section_dch_icon_style_settings', [
            'label' => esc_html__('Icon Style', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'sa_el_show_dch_icon_content' => 'yes'
            ]
                ]
        );

        $this->add_control(
                'sa_el_dch_icon_size', [
            'label' => __('Icon Size', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => 36,
            ],
            'range' => [
                'px' => [
                    'min' => 20,
                    'max' => 100,
                    'step' => 1,
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} .sa_el_advance_header i' => 'font-size: {{SIZE}}px;',
            ],
                ]
        );

        $this->add_control(
                'sa_el_dch_icon_color', [
            'label' => esc_html__('Icon Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '#4d4d4d',
            'selectors' => [
                '{{WRAPPER}} .sa_el_advance_header i' => 'color: {{VALUE}};',
            ],
                ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Title Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
                'sa_el_section_dch_title_style_settings', [
            'label' => esc_html__('Color &amp; Typography', SA_EL_ADDONS_TEXTDOMAIN),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'sa_el_dch_title_heading', [
            'label' => esc_html__('Title Style', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::HEADING,
                ]
        );
        $this->start_controls_tabs('sa_el_dch_title_heading_tabs');

        $this->start_controls_tab('sa_el_dch_title_heading_tabs_primary', ['label' => esc_html__('Primary', SA_EL_ADDONS_TEXTDOMAIN)]);
        $this->add_control(
                'sa_el_dch_dual_title_color', [
            'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '#1f87dd',
            'selectors' => [
                '{{WRAPPER}} .sa_el_advance_header .title span.lead' => 'color: {{VALUE}};',
            ],
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'sa_el_dch_first_title_typography',
            'selector' => '{{WRAPPER}} .sa_el_advance_header .title span.lead',
                ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('sa_el_dch_title_heading_tabs_secondary', ['label' => esc_html__('Secondary', SA_EL_ADDONS_TEXTDOMAIN)]);

        $this->add_control(
                'sa_el_dch_base_title_color', [
            'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '#4d4d4d',
            'selectors' => [
                '{{WRAPPER}} .sa_el_advance_header .title span' => 'color: {{VALUE}};',
            ],
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'sa_el_dch_secondary_title_typography',
            'selector' => '{{WRAPPER}} .sa_el_advance_header .title span',
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_responsive_control(
                'sa_el_dch_first_title_margin', [
            'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .sa_el_advance_header .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'sa_el_dch_sub_title_headi;ng', [
            'label' => esc_html__('Sub-title Style ', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before'
                ]
        );

        $this->add_control(
                'sa_el_dch_subtext_color', [
            'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
            'type' => Controls_Manager::COLOR,
            'default' => '#4d4d4d',
            'selectors' => [
                '{{WRAPPER}} .sa_el_advance_header .subtext' => 'color: {{VALUE}};',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'sa_el_dch_subtext_typography',
            'selector' => '{{WRAPPER}} .sa_el_advance_header .subtext',
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        ?>
        <?php if ('dch-default' == $settings['sa_el_dch_type']) : ?>
            <div class="sa_el_advance_header">
                <h2 class="title"><span class="lead"><?php esc_html_e($settings['sa_el_dch_first_title'], SA_EL_ADDONS_TEXTDOMAIN); ?></span> <span><?php esc_html_e($settings['sa_el_dch_last_title'], SA_EL_ADDONS_TEXTDOMAIN); ?></span></h2>
                <span class="subtext"><?php echo $settings['sa_el_dch_subtext']; ?></span>
                <?php
                if ('yes' == $settings['sa_el_show_dch_icon_content']) :
                    echo $this->Sa_El_Icon_Render($settings['sa_el_dch_icon']);
                endif;
                ?>
            </div>
        <?php endif; ?>

        <?php if ('dch-icon-on-top' == $settings['sa_el_dch_type']) : ?>
            <div class="sa_el_advance_header">
                <?php
                if ('yes' == $settings['sa_el_show_dch_icon_content']) :
                    echo $this->Sa_El_Icon_Render($settings['sa_el_dch_icon']);
                endif;
                ?>
                <h2 class="title"><span class="lead"><?php esc_html_e($settings['sa_el_dch_first_title'], SA_EL_ADDONS_TEXTDOMAIN); ?></span> <span><?php esc_html_e($settings['sa_el_dch_last_title'], SA_EL_ADDONS_TEXTDOMAIN); ?></span></h2>
                <span class="subtext"><?php echo $settings['sa_el_dch_subtext']; ?></span>
            </div>
        <?php endif; ?>

        <?php if ('dch-icon-subtext-on-top' == $settings['sa_el_dch_type']) : ?>
            <div class="sa_el_advance_header">
                <?php
                if ('yes' == $settings['sa_el_show_dch_icon_content']) :
                    echo $this->Sa_El_Icon_Render($settings['sa_el_dch_icon']);
                endif;
                ?>
                <span class="subtext"><?php echo $settings['sa_el_dch_subtext']; ?></span>
                <h2 class="title"><span class="lead"><?php esc_html_e($settings['sa_el_dch_first_title'], SA_EL_ADDONS_TEXTDOMAIN); ?></span> <span><?php esc_html_e($settings['sa_el_dch_last_title'], SA_EL_ADDONS_TEXTDOMAIN); ?></span></h2>
            </div>
        <?php endif; ?>

        <?php if ('dch-subtext-on-top' == $settings['sa_el_dch_type']) : ?>
            <div class="sa_el_advance_header">
                <span class="subtext"><?php echo $settings['sa_el_dch_subtext']; ?></span>
                <h2 class="title"><span class="lead"><?php esc_html_e($settings['sa_el_dch_first_title'], SA_EL_ADDONS_TEXTDOMAIN); ?></span> <span><?php esc_html_e($settings['sa_el_dch_last_title'], SA_EL_ADDONS_TEXTDOMAIN); ?></span></h2>
                <?php
                if ('yes' == $settings['sa_el_show_dch_icon_content']) :
                    echo $this->Sa_El_Icon_Render($settings['sa_el_dch_icon']);
                endif;
                ?>
            </div>
        <?php endif; ?>

        <?php
    }

    protected function content_template() {
        
    }

}
