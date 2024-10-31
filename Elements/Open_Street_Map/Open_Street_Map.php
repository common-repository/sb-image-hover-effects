<?php

namespace SA_EL_ADDONS\Elements\Open_Street_Map;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use Elementor\Repeater;

class Open_Street_Map extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_open_street_map';
    }

    public function get_title() {
        return esc_html__('Open Street Map', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-sitemap oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
                'section_content_osmap',
                [
                    'label' => esc_html__('Open Street Map', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control(
                'zoom_control',
                [
                    'label' => esc_html__('Zoom Control', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'zoom',
                [
                    'label' => esc_html__('Zoom', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 15,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 50,
                        ],
                    ],
                ]
        );

        $this->add_responsive_control(
                'open_street_map_height',
                [
                    'label' => esc_html__('Map Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-open-street-map' => 'min-height: {{SIZE}}{{UNIT}}',
                    ],
                ]
        );

        $this->add_responsive_control(
                'search_align',
                [
                    'label' => esc_html__('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
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
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-osmap-search-wrapper' => 'text-align: {{VALUE}};',
                    ],
                    'condition' => [
                        'osmap_geocode' => 'yes',
                    ],
                ]
        );

        $this->add_responsive_control(
                'search_spacing',
                [
                    'label' => esc_html__('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-osmap-search-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'osmap_geocode' => 'yes',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_content_marker',
                [
                    'label' => esc_html__('Marker', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
                'marker_title',
                [
                    'label' => esc_html__('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Marker #1',
                ]
        );
        $repeater->add_control(
                'marker_lat',
                [
                    'label' => esc_html__('Latitude', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'default' => '23.799697',
                ]
        );

        $repeater->add_control(
                'marker_lng',
                [
                    'label' => esc_html__('Longitude', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'default' => '90.358449',
                ]
        );

        $repeater->add_control(
                'marker_content',
                [
                    'label' => esc_html__('Content', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__('Your Business Address Here', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $repeater->add_control(
                'custom_marker',
                [
                    'label' => esc_html__('Custom marker', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => esc_html__('Use max 32x32 px size icon for better result.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => 'https://www.sa-elementor-addons.com/wp-content/uploads/2019/12/location.svg',
                    ]
                ]
        );

        $this->add_control(
                'markers',
                [
                    'type' => Controls_Manager::REPEATER,
                    'fields' => array_values($repeater->get_controls()),
                    'default' => [
                        [
                            'marker_lat' => '24.82391',
                            'marker_lng' => '89.38414',
                            'marker_title' => esc_html__('Marker #1', SA_EL_ADDONS_TEXTDOMAIN),
                            'marker_content' => esc_html__('<strong>Oxilab</strong><br>Mirpur-1,<br>Bangladesh', SA_EL_ADDONS_TEXTDOMAIN),
                        ],
                    ],
                    'title_field' => '{{{ marker_title }}}',
                ]
        );

        $this->end_controls_section();

        $this->Sa_El_Support();

        $this->start_controls_section(
                'section_style_tooltip',
                [
                    'label' => esc_html__('Tooltip', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'marker_tooltip_color',
                [
                    'label' => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .leaflet-popup-content-wrapper' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'marker_tooltip_button_color',
                [
                    'label' => esc_html__('Close Button Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .leaflet-popup-close-button' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'marker_tooltip_button_hover_color',
                [
                    'label' => esc_html__('Close Button Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .leaflet-popup-close-button:hover' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'marker_tooltip_background',
                    'selector' => '{{WRAPPER}} .leaflet-popup-content-wrapper, {{WRAPPER}} .leaflet-popup-tip',
                ]
        );

        $this->add_responsive_control(
                'marker_tooltip_padding',
                [
                    'label' => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .leaflet-popup-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'marker_tooltip_border',
                    'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .leaflet-popup-content-wrapper',
                ]
        );

        $this->add_responsive_control(
                'marker_tooltip_border_radius',
                [
                    'label' => __('Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .leaflet-popup-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'marker_tooltip_shadow',
                    'selector' => '{{WRAPPER}} .leaflet-popup-content-wrapper',
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'marker_tooltip_typography',
                    'selector' => '{{WRAPPER}} .leaflet-popup-content-wrapper',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_zoom_control',
                [
                    'label' => esc_html__('Zoom Control', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'zoom_control' => 'yes'
                    ]
                ]
        );

        $this->add_control(
                'zoom_control_color',
                [
                    'label' => esc_html__('Icon Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .leaflet-touch .leaflet-bar a' => 'color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'zoom_control_background',
                    'selector' => '{{WRAPPER}} .leaflet-touch .leaflet-bar a',
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'zoom_control_border',
                    'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'placeholder' => '1px',
                    'default' => '1px',
                    'selector' => '{{WRAPPER}} .leaflet-touch .leaflet-bar a',
                ]
        );

        $this->add_responsive_control(
                'zoom_control_border_radius',
                [
                    'label' => __('Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .leaflet-touch .leaflet-bar a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'zoom_control_bar_color',
                [
                    'label' => esc_html__('Bar Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .leaflet-touch .leaflet-bar' => 'border-color: {{VALUE}}',
                    ],
                ]
        );

        $this->add_control(
                'zoom_control_bar_width',
                [
                    'label' => __('Bar Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'selectors' => [
                        '{{WRAPPER}} .leaflet-touch .leaflet-bar' => 'border-width: {{SIZE}}{{UNIT}}',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $sa_el_api_settings = get_option('sa-el-open-street-map');
       
        $marker_settings = [];
        $sa_el_counter = 0;

        if (( '' != $sa_el_api_settings)) {
            $map_settings['osmAccessToken'] = $sa_el_api_settings;

            foreach ($settings['markers'] as $marker_item) :

                $marker_settings['lat'] = ( $marker_item['marker_lat'] ) ? $marker_item['marker_lat'] : '';
                $marker_settings['lng'] = ( $marker_item['marker_lng'] ) ? $marker_item['marker_lng'] : '';
                $marker_settings['title'] = ( $marker_item['marker_title'] ) ? $marker_item['marker_title'] : '';
                $marker_settings['iconUrl'] = ( $marker_item['custom_marker']['url'] ) ? $marker_item['custom_marker']['url'] : '#';
                $marker_settings['infoWindow'] = ( $marker_item['marker_content'] ) ? $marker_item['marker_content'] : '';

                $all_markers[] = $marker_settings;

                $sa_el_counter++;

                if (1 === $sa_el_counter) {
                    $map_settings['lat'] = ( $marker_item['marker_lat'] ) ? $marker_item['marker_lat'] : '';
                    $map_settings['lng'] = ( $marker_item['marker_lng'] ) ? $marker_item['marker_lng'] : '';
                }

                $map_settings['zoomControl'] = ( $settings['zoom_control'] ) ? true : false;
                $map_settings['zoom'] = $settings['zoom']['size'];

            endforeach;

            $this->add_render_attribute('open-street-map', 'data-settings', wp_json_encode($map_settings));
            $this->add_render_attribute('open-street-map', 'data-map_markers', wp_json_encode($all_markers));
            ?>
            <div class="sa-el-open-street-map" style="width: auto; height: 400px;" <?php echo $this->get_render_attribute_string('open-street-map'); ?>></div>
            <?php
        } else {
            ?>
            <div class="sa-el-alert-warning" >
                <?php $sa_el_setting_url = esc_url(admin_url('admin.php?page=sa-el-addons')); ?>
                <div><?php printf(__('Please set your open street map accesss token in <a href="%s">element addons settings</a> to show your map correctly.', SA_EL_ADDONS_TEXTDOMAIN), $sa_el_setting_url); ?></div>
            </div>
            <?php
        }
    }

}
