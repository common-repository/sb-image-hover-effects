<?php

namespace SA_EL_ADDONS\Elements\Google_Map;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Background as Group_Control_Background;
use \Elementor\Scheme_Typography as Scheme_Typography;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Utils as Utils;
use \Elementor\Widget_Base as Widget_Base;

class Google_Map extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_google_map';
    }

    public function get_title() {
        return esc_html__('Google Map', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-barcode  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {
        /**
         * Google Map General Settings
         */
        $this->start_controls_section(
                'sa_el_section_google_map_settings',
                [
                    'label' => esc_html__('General Settings', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );
        $this->add_control(
                'sa_el_google_map_type',
                [
                    'label' => esc_html__('Google Map Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'basic',
                    'label_block' => false,
                    'options' => [
                        'basic' => esc_html__('Basic', SA_EL_ADDONS_TEXTDOMAIN),
                        'marker' => esc_html__('Multiple Marker', SA_EL_ADDONS_TEXTDOMAIN),
                        'static' => esc_html__('Static', SA_EL_ADDONS_TEXTDOMAIN),
                        'polyline' => esc_html__('Polyline', SA_EL_ADDONS_TEXTDOMAIN),
                        'polygon' => esc_html__('Polygon', SA_EL_ADDONS_TEXTDOMAIN),
                        'overlay' => esc_html__('Overlay', SA_EL_ADDONS_TEXTDOMAIN),
                        'routes' => esc_html__('With Routes', SA_EL_ADDONS_TEXTDOMAIN),
                        'panorama' => esc_html__('Panorama', SA_EL_ADDONS_TEXTDOMAIN),
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_address_type',
                [
                    'label' => __('Address Type', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'address' => [
                            'title' => __('Address', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-map',
                        ],
                        'coordinates' => [
                            'title' => __('Coordinates', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-map-marker',
                        ],
                    ],
                    'default' => 'address',
                    'condition' => [
                        'sa_el_google_map_type' => ['basic']
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_addr',
                [
                    'label' => esc_html__('Geo Address', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__('Marina Bay, Singapore', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_google_map_address_type' => ['address'],
                        'sa_el_google_map_type' => ['basic']
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_lat',
                [
                    'label' => esc_html__('Latitude', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'default' => esc_html__('28.948790', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_google_map_type!' => ['routes'],
                        'sa_el_google_map_address_type' => ['coordinates']
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_lng',
                [
                    'label' => esc_html__('Longitude', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'default' => esc_html__('-81.298843', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_google_map_type!' => ['routes'],
                        'sa_el_google_map_address_type' => ['coordinates']
                    ]
                ]
        );
        // Only for static
        $this->add_control(
                'sa_el_google_map_static_lat',
                [
                    'label' => esc_html__('Latitude', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'default' => esc_html__('28.948790', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_google_map_type' => ['static'],
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_static_lng',
                [
                    'label' => esc_html__('Longitude', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'default' => esc_html__('-81.298843', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_google_map_type' => ['static'],
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_resolution_title',
                [
                    'label' => __('Map Image Resolution', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'sa_el_google_map_type' => 'static'
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_static_width',
                [
                    'label' => esc_html__('Static Image Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 610
                    ],
                    'range' => [
                        'px' => [
                            'max' => 1400,
                        ],
                    ],
                    'condition' => [
                        'sa_el_google_map_type' => 'static'
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_static_height',
                [
                    'label' => esc_html__('Static Image Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 300
                    ],
                    'range' => [
                        'px' => [
                            'max' => 700,
                        ],
                    ],
                    'condition' => [
                        'sa_el_google_map_type' => 'static'
                    ]
                ]
        );
        // Only for Overlay
        $this->add_control(
                'sa_el_google_map_overlay_lat',
                [
                    'label' => esc_html__('Latitude', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'default' => esc_html__('28.948790', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_google_map_type' => ['overlay'],
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_overlay_lng',
                [
                    'label' => esc_html__('Longitude', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'default' => esc_html__('-81.298843', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_google_map_type' => ['overlay'],
                    ]
                ]
        );
        // Only for panorama
        $this->add_control(
                'sa_el_google_map_panorama_lat',
                [
                    'label' => esc_html__('Latitude', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'default' => esc_html__('28.948790', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_google_map_type' => ['panorama'],
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_panorama_lng',
                [
                    'label' => esc_html__('Longitude', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'default' => esc_html__('-81.298843', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_google_map_type' => ['panorama'],
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_overlay_content',
                [
                    'label' => esc_html__('Overlay Content', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => True,
                    'default' => esc_html__('Add your content here', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_google_map_type' => 'overlay'
                    ]
                ]
        );
        $this->end_controls_section();
        /**
         * Map Settings (With Marker only for Basic)
         */
        $this->start_controls_section(
                'sa_el_section_google_map_basic_marker_settings',
                [
                    'label' => esc_html__('Map Marker Settings', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_google_map_type' => ['basic']
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_basic_marker_title',
                [
                    'label' => esc_html__('Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__('Google Map Title', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );
        $this->add_control(
                'sa_el_google_map_basic_marker_content',
                [
                    'label' => esc_html__('Content', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'default' => esc_html__('Google map content', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );
        $this->add_control(
                'sa_el_google_map_basic_marker_icon_enable',
                [
                    'label' => __('Custom Marker Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                ]
        );
        $this->add_control(
                'sa_el_google_map_basic_marker_icon',
                [
                    'label' => esc_html__('Marker Icon', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                    // 'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'sa_el_google_map_basic_marker_icon_enable' => 'yes'
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_basic_marker_icon_width',
                [
                    'label' => esc_html__('Marker Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 32
                    ],
                    'range' => [
                        'px' => [
                            'max' => 150,
                        ],
                    ],
                    'condition' => [
                        'sa_el_google_map_basic_marker_icon_enable' => 'yes'
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_basic_marker_icon_height',
                [
                    'label' => esc_html__('Marker Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 32
                    ],
                    'range' => [
                        'px' => [
                            'max' => 150,
                        ],
                    ],
                    'condition' => [
                        'sa_el_google_map_basic_marker_icon_enable' => 'yes'
                    ]
                ]
        );
        $this->end_controls_section();
        /**
         * Map Settings (With Marker)
         */
        $this->start_controls_section(
                'sa_el_section_google_map_marker_settings',
                [
                    'label' => esc_html__('Map Marker Settings', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_google_map_type' => ['marker', 'polyline', 'routes', 'static']
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_markers',
                [
                    'type' => Controls_Manager::REPEATER,
                    'seperator' => 'before',
                    'default' => [
                        ['sa_el_google_map_marker_title' => esc_html__('Map Marker 1', SA_EL_ADDONS_TEXTDOMAIN)],
                    ],
                    'fields' => [
                        [
                            'name' => 'sa_el_google_map_marker_lat',
                            'label' => esc_html__('Latitude', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::TEXT,
                            'label_block' => true,
                            'default' => esc_html__('28.948790', SA_EL_ADDONS_TEXTDOMAIN),
                        ],
                        [
                            'name' => 'sa_el_google_map_marker_lng',
                            'label' => esc_html__('Longitude', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::TEXT,
                            'label_block' => true,
                            'default' => esc_html__('-81.298843', SA_EL_ADDONS_TEXTDOMAIN),
                        ],
                        [
                            'name' => 'sa_el_google_map_marker_title',
                            'label' => esc_html__('Title', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::TEXT,
                            'label_block' => true,
                            'default' => esc_html__('Marker Title', SA_EL_ADDONS_TEXTDOMAIN),
                        ],
                        [
                            'name' => 'sa_el_google_map_marker_content',
                            'label' => esc_html__('Content', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::TEXTAREA,
                            'label_block' => true,
                            'default' => esc_html__('Marker Content. You can put html here.', SA_EL_ADDONS_TEXTDOMAIN),
                        ],
                        [
                            'name' => 'sa_el_google_map_marker_icon_color',
                            'label' => esc_html__('Default Icon Color', SA_EL_ADDONS_TEXTDOMAIN),
                            'description' => esc_html__('(Works only on Static mode)', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#e23a47',
                        ],
                        [
                            'name' => 'sa_el_google_map_marker_icon_enable',
                            'label' => __('Use Custom Icon', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::SWITCHER,
                            'default' => 'no',
                            'label_on' => __('Yes', SA_EL_ADDONS_TEXTDOMAIN),
                            'label_off' => __('No', SA_EL_ADDONS_TEXTDOMAIN),
                            'return_value' => 'yes',
                        ],
                        [
                            'name' => 'sa_el_google_map_marker_icon',
                            'label' => esc_html__('Custom Icon', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::MEDIA,
                            'default' => [
                            // 'url' => Utils::get_placeholder_image_src(),
                            ],
                            'condition' => [
                                'sa_el_google_map_marker_icon_enable' => 'yes'
                            ]
                        ],
                        [
                            'name' => 'sa_el_google_map_marker_icon_width',
                            'label' => esc_html__('Icon Width', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::NUMBER,
                            'default' => esc_html__('32', SA_EL_ADDONS_TEXTDOMAIN),
                            'condition' => [
                                'sa_el_google_map_marker_icon_enable' => 'yes'
                            ]
                        ],
                        [
                            'name' => 'sa_el_google_map_marker_icon_height',
                            'label' => esc_html__('Icon Height', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::NUMBER,
                            'default' => esc_html__('32', SA_EL_ADDONS_TEXTDOMAIN),
                            'condition' => [
                                'sa_el_google_map_marker_icon_enable' => 'yes'
                            ]
                        ]
                    ],
                    'title_field' => '{{sa_el_google_map_marker_title}}',
                ]
        );
        $this->end_controls_section();


        /**
         * Polyline Coordinates Settings (Polyline)
         */
        $this->start_controls_section(
                'sa_el_section_google_map_polyline_settings',
                [
                    'label' => esc_html__('Coordinate Settings', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_google_map_type' => ['polyline', 'polygon']
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_polylines',
                [
                    'type' => Controls_Manager::REPEATER,
                    'seperator' => 'before',
                    'default' => [
                        ['sa_el_google_map_polyline_title' => esc_html__('#1', SA_EL_ADDONS_TEXTDOMAIN)],
                    ],
                    'fields' => [
                        [
                            'name' => 'sa_el_google_map_polyline_title',
                            'label' => esc_html__('Title', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::TEXT,
                            'label_block' => true,
                            'default' => esc_html__('#', SA_EL_ADDONS_TEXTDOMAIN),
                        ],
                        [
                            'name' => 'sa_el_google_map_polyline_lat',
                            'label' => esc_html__('Latitude', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::TEXT,
                            'label_block' => true,
                            'default' => esc_html__('28.948790', SA_EL_ADDONS_TEXTDOMAIN),
                        ],
                        [
                            'name' => 'sa_el_google_map_polyline_lng',
                            'label' => esc_html__('Longitude', SA_EL_ADDONS_TEXTDOMAIN),
                            'type' => Controls_Manager::TEXT,
                            'label_block' => true,
                            'default' => esc_html__('-81.298843', SA_EL_ADDONS_TEXTDOMAIN),
                        ],
                    ],
                    'title_field' => '{{sa_el_google_map_polyline_title}}',
                ]
        );
        $this->end_controls_section();

        /**
         * Routes Coordinates Settings (Routes)
         */
        $this->start_controls_section(
                'sa_el_section_google_map_routes_settings',
                [
                    'label' => esc_html__('Routes Coordinate Settings', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_google_map_type' => ['routes']
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_routes_origin',
                [
                    'label' => esc_html__('Origin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                ]
        );
        $this->add_control(
                'sa_el_google_map_routes_origin_lat',
                [
                    'label' => esc_html__('Latitude', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'default' => esc_html__('28.948790', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );
        $this->add_control(
                'sa_el_google_map_routes_origin_lng',
                [
                    'label' => esc_html__('Longitude', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'default' => esc_html__('-81.298843', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );
        $this->add_control(
                'sa_el_google_map_routes_dest',
                [
                    'label' => esc_html__('Destination', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                ]
        );
        $this->add_control(
                'sa_el_google_map_routes_dest_lat',
                [
                    'label' => esc_html__('Latitude', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'default' => esc_html__('1.2833808', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );
        $this->add_control(
                'sa_el_google_map_routes_dest_lng',
                [
                    'label' => esc_html__('Longitude', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'default' => esc_html__('103.8585377', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );
        $this->add_control(
                'sa_el_google_map_routes_travel_mode',
                [
                    'label' => esc_html__('Travel Mode', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'walking',
                    'label_block' => false,
                    'options' => [
                        'walking' => esc_html__('Walking', SA_EL_ADDONS_TEXTDOMAIN),
                        'bicycling' => esc_html__('Bicycling', SA_EL_ADDONS_TEXTDOMAIN),
                        'driving' => esc_html__('Driving', SA_EL_ADDONS_TEXTDOMAIN),
                    ]
                ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
                'section_map_controls',
                [
                    'label' => esc_html__('Map Controls', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );
        $this->add_control(
                'sa_el_google_map_zoom',
                [
                    'label' => esc_html__('Zoom Level', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'label_block' => false,
                    'default' => esc_html__('14', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );
        $this->add_control(
                'sa_el_map_streeview_control',
                [
                    'label' => esc_html__('Street View Controls', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'true',
                    'label_on' => __('On', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('Off', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'true',
                ]
        );
        $this->add_control(
                'sa_el_map_type_control',
                [
                    'label' => esc_html__('Map Type Control', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'label_on' => __('On', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('Off', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                ]
        );
        $this->add_control(
                'sa_el_map_zoom_control',
                [
                    'label' => esc_html__('Zoom Control', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'label_on' => __('On', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('Off', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                ]
        );
        $this->add_control(
                'sa_el_map_fullscreen_control',
                [
                    'label' => esc_html__('Fullscreen Control', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'label_on' => __('On', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('Off', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                ]
        );
        $this->add_control(
                'sa_el_map_scroll_zoom',
                [
                    'label' => esc_html__('Scroll Wheel Zoom', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'label_on' => __('On', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_off' => __('Off', SA_EL_ADDONS_TEXTDOMAIN),
                    'return_value' => 'yes',
                ]
        );
        $this->end_controls_section();

        /**
         * Map Theme Settings
         */
        $this->start_controls_section(
                'sa_el_section_google_map_theme_settings',
                [
                    'label' => esc_html__('Map Theme', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_google_map_type!' => ['static', 'panorama']
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_theme_source',
                [
                    'label' => __('Theme Source', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'gstandard' => [
                            'title' => __('Google Standard', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-map',
                        ],
                        'snazzymaps' => [
                            'title' => __('Snazzy Maps', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-map-marker',
                        ],
                        'custom' => [
                            'title' => __('Custom', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-edit',
                        ],
                    ],
                    'default' => 'gstandard'
                ]
        );
        $this->add_control(
                'sa_el_google_map_gstandards',
                [
                    'label' => esc_html__('Google Themes', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'standard',
                    'options' => [
                        'standard' => __('Standard', SA_EL_ADDONS_TEXTDOMAIN),
                        'silver' => __('Silver', SA_EL_ADDONS_TEXTDOMAIN),
                        'retro' => __('Retro', SA_EL_ADDONS_TEXTDOMAIN),
                        'dark' => __('Dark', SA_EL_ADDONS_TEXTDOMAIN),
                        'night' => __('Night', SA_EL_ADDONS_TEXTDOMAIN),
                        'aubergine' => __('Aubergine', SA_EL_ADDONS_TEXTDOMAIN)
                    ],
                    'description' => sprintf('<a href="https://mapstyle.withgoogle.com/" target="_blank">%1$s</a> %2$s', __('Click here', SA_EL_ADDONS_TEXTDOMAIN), __('to generate your own theme and use JSON within Custom style field.', SA_EL_ADDONS_TEXTDOMAIN)),
                    'condition' => [
                        'sa_el_google_map_theme_source' => 'gstandard'
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_snazzymaps',
                [
                    'label' => esc_html__('SnazzyMaps Themes', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default' => 'colorful',
                    'options' => [
                        'default' => __('Default', SA_EL_ADDONS_TEXTDOMAIN),
                        'simple' => __('Simple', SA_EL_ADDONS_TEXTDOMAIN),
                        'colorful' => __('Colorful', SA_EL_ADDONS_TEXTDOMAIN),
                        'complex' => __('Complex', SA_EL_ADDONS_TEXTDOMAIN),
                        'dark' => __('Dark', SA_EL_ADDONS_TEXTDOMAIN),
                        'greyscale' => __('Greyscale', SA_EL_ADDONS_TEXTDOMAIN),
                        'light' => __('Light', SA_EL_ADDONS_TEXTDOMAIN),
                        'monochrome' => __('Monochrome', SA_EL_ADDONS_TEXTDOMAIN),
                        'nolabels' => __('No Labels', SA_EL_ADDONS_TEXTDOMAIN),
                        'twotone' => __('Two Tone', SA_EL_ADDONS_TEXTDOMAIN)
                    ],
                    'description' => sprintf('<a href="https://snazzymaps.com/explore" target="_blank">%1$s</a> %2$s', __('Click here', SA_EL_ADDONS_TEXTDOMAIN), __('to explore more themes and use JSON within custom style field.', SA_EL_ADDONS_TEXTDOMAIN)),
                    'condition' => [
                        'sa_el_google_map_theme_source' => 'snazzymaps'
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_custom_style',
                [
                    'label' => __('Custom Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'description' => sprintf('<a href="https://mapstyle.withgoogle.com/" target="_blank">%1$s</a> %2$s', __('Click here', SA_EL_ADDONS_TEXTDOMAIN), __('to get JSON style code to style your map', SA_EL_ADDONS_TEXTDOMAIN)),
                    'type' => Controls_Manager::TEXTAREA,
                    'condition' => [
                        'sa_el_google_map_theme_source' => 'custom',
                    ],
                ]
        );
        $this->end_controls_section();
        /**
         * -------------------------------------------
         * Tab Style Google Map Style
         * -------------------------------------------
         */
        $this->start_controls_section(
                'sa_el_section_google_map_style_settings',
                [
                    'label' => esc_html__('General Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_responsive_control(
                'sa_el_google_map_max_width',
                [
                    'label' => __('Max Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 1140,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1400,
                            'step' => 10,
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-google-map' => 'max-width: {{SIZE}}{{UNIT}};',
                    ]
                ]
        );
        $this->add_responsive_control(
                'sa_el_google_map_max_height',
                [
                    'label' => __('Max Height', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 400,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1400,
                            'step' => 10,
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-google-map' => 'height: {{SIZE}}{{UNIT}};',
                    ]
                ]
        );

        $this->add_responsive_control(
                'sa_el_google_map_margin',
                [
                    'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-google-map' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style Google Map Style
         * -------------------------------------------
         */
        $this->start_controls_section(
                'sa_el_section_google_map_overlay_style_settings',
                [
                    'label' => esc_html__('Overlay Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'sa_el_google_map_type' => ['overlay']
                    ]
                ]
        );
        $this->add_responsive_control(
                'sa_el_google_map_overlay_width',
                [
                    'label' => __('Width', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 200,
                        'unit' => 'px',
                    ],
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1100,
                            'step' => 10,
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-gmap-overlay' => 'width: {{SIZE}}{{UNIT}};',
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_overlay_bg_color',
                [
                    'label' => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-gmap-overlay' => 'background-color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_responsive_control(
                'sa_el_google_mapoverlay_padding',
                [
                    'label' => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-gmap-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_responsive_control(
                'sa_el_google_map_overlay_margin',
                [
                    'label' => esc_html__('Margin', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-gmap-overlay' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sa_el_google_map_overlay_border',
                    'label' => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
                    'selector' => '{{WRAPPER}} .sa-el-gmap-overlay',
                ]
        );
        $this->add_responsive_control(
                'sa_el_google_map_overlay_border_radius',
                [
                    'label' => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-gmap-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'sa_el_google_map_overlay_box_shadow',
                    'selector' => '{{WRAPPER}} .sa-el-gmap-overlay',
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sa_el_google_map_overlay_typography',
                    'selector' => '{{WRAPPER}} .sa-el-gmap-overlay',
                ]
        );
        $this->add_control(
                'sa_el_google_map_overlay_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#222',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-gmap-overlay' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style Google Map Stroke Style
         * -------------------------------------------
         */
        $this->start_controls_section(
                'sa_el_section_google_map_stroke_style_settings',
                [
                    'label' => esc_html__('Stroke Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'sa_el_google_map_type' => ['polyline', 'polygon', 'routes']
                    ]
                ]
        );
        $this->add_control(
                'sa_el_google_map_stroke_color',
                [
                    'label' => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#e23a47',
                ]
        );
        $this->add_responsive_control(
                'sa_el_google_map_stroke_opacity',
                [
                    'label' => __('Opacity', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0.8,
                    ],
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0.2,
                            'max' => 1,
                            'step' => 0.1,
                        ]
                    ],
                ]
        );
        $this->add_responsive_control(
                'sa_el_google_map_stroke_weight',
                [
                    'label' => __('Weight', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 4,
                    ],
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 10,
                            'step' => 1,
                        ]
                    ],
                ]
        );
        $this->add_control(
                'sa_el_google_map_stroke_fill_color',
                [
                    'label' => esc_html__('Fill Color', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#e23a47',
                    'condition' => [
                        'sa_el_google_map_type' => ['polygon']
                    ]
                ]
        );
        $this->add_responsive_control(
                'sa_el_google_map_stroke_fill_opacity',
                [
                    'label' => __('Fill Opacity', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0.4,
                    ],
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0.2,
                            'max' => 1,
                            'step' => 0.1,
                        ]
                    ],
                    'condition' => [
                        'sa_el_google_map_type' => ['polygon']
                    ]
                ]
        );
        $this->end_controls_section();
    }

    protected function sa_el_get_map_theme($settings) {

        if ($settings['sa_el_google_map_theme_source'] == 'custom') {
            return strip_tags($settings['sa_el_google_map_custom_style']);
        } else {
            $themes = include('gmap-themes.php');
            if (isset($themes[$settings['sa_el_google_map_theme_source']][$settings['sa_el_google_map_gstandards']])) {
                return $themes[$settings['sa_el_google_map_theme_source']][$settings['sa_el_google_map_gstandards']];
            } elseif (isset($themes[$settings['sa_el_google_map_theme_source']][$settings['sa_el_google_map_snazzymaps']])) {
                return $themes[$settings['sa_el_google_map_theme_source']][$settings['sa_el_google_map_snazzymaps']];
            } else {
                return '';
            }
        }
    }

    protected function map_render_data_attributes($settings) {
        return [
            'data-map_type' => esc_attr($settings['sa_el_google_map_type']),
            'data-map_address_type' => esc_attr($settings['sa_el_google_map_address_type']),
            'data-map_lat' => esc_attr($settings['sa_el_google_map_lat']),
            'data-map_lng' => esc_attr($settings['sa_el_google_map_lng']),
            'data-map_addr' => esc_attr($settings['sa_el_google_map_addr']),
            'data-map_basic_marker_title' => esc_attr($settings['sa_el_google_map_basic_marker_title']),
            'data-map_basic_marker_content' => esc_attr($settings['sa_el_google_map_basic_marker_content']),
            'data-map_basic_marker_icon_enable' => esc_attr($settings['sa_el_google_map_basic_marker_icon_enable']),
            'data-map_basic_marker_icon' => esc_attr($settings['sa_el_google_map_basic_marker_icon']['url']),
            'data-map_basic_marker_icon_width' => esc_attr($settings['sa_el_google_map_basic_marker_icon_width']['size']),
            'data-map_basic_marker_icon_height' => esc_attr($settings['sa_el_google_map_basic_marker_icon_height']['size']),
            'data-map_zoom' => esc_attr($settings['sa_el_google_map_zoom']),
            'data-map_marker_content' => isset($settings['sa_el_google_map_marker_content']) ? esc_attr($settings['sa_el_google_map_marker_content']) : '',
            'data-map_markers' => urlencode(json_encode($settings['sa_el_google_map_markers'])),
            'data-map_static_width' => esc_attr($settings['sa_el_google_map_static_width']['size']),
            'data-map_static_height' => esc_attr($settings['sa_el_google_map_static_height']['size']),
            'data-map_static_lat' => esc_attr($settings['sa_el_google_map_static_lat']),
            'data-map_static_lng' => esc_attr($settings['sa_el_google_map_static_lng']),
            'data-map_polylines' => urlencode(json_encode($settings['sa_el_google_map_polylines'])),
            'data-map_stroke_color' => esc_attr($settings['sa_el_google_map_stroke_color']),
            'data-map_stroke_opacity' => esc_attr($settings['sa_el_google_map_stroke_opacity']['size']),
            'data-map_stroke_weight' => esc_attr($settings['sa_el_google_map_stroke_weight']['size']),
            'data-map_stroke_fill_color' => esc_attr($settings['sa_el_google_map_stroke_fill_color']),
            'data-map_stroke_fill_opacity' => esc_attr($settings['sa_el_google_map_stroke_fill_opacity']['size']),
            'data-map_overlay_content' => esc_attr($settings['sa_el_google_map_overlay_content']),
            'data-map_routes_origin_lat' => esc_attr($settings['sa_el_google_map_routes_origin_lat']),
            'data-map_routes_origin_lng' => esc_attr($settings['sa_el_google_map_routes_origin_lng']),
            'data-map_routes_dest_lat' => esc_attr($settings['sa_el_google_map_routes_dest_lat']),
            'data-map_routes_dest_lng' => esc_attr($settings['sa_el_google_map_routes_dest_lng']),
            'data-map_routes_travel_mode' => esc_attr($settings['sa_el_google_map_routes_travel_mode']),
            'data-map_panorama_lat' => esc_attr($settings['sa_el_google_map_panorama_lat']),
            'data-map_panorama_lng' => esc_attr($settings['sa_el_google_map_panorama_lng']),
            'data-map_theme' => urlencode(json_encode($this->sa_el_get_map_theme($settings))),
            'data-map_streeview_control' => ($settings['sa_el_map_streeview_control'] ? 'true' : 'false'),
            'data-map_type_control' => ($settings['sa_el_map_type_control'] ? 'true' : 'false'),
            'data-map_zoom_control' => ($settings['sa_el_map_zoom_control'] ? 'true' : 'false'),
            'data-map_fullscreen_control' => ($settings['sa_el_map_fullscreen_control'] ? 'true' : 'false'),
            'data-map_scroll_zoom' => ($settings['sa_el_map_scroll_zoom'] ? 'true' : 'false')
        ];
    }

    protected function get_map_render_data_attribute_string($settings) {

        $data_attributes = $this->map_render_data_attributes($settings);
        $data_string = '';

        foreach ($data_attributes as $key => $value) {
            if (isset($key) && !empty($value)) {
                $data_string .= ' ' . $key . '="' . $value . '"';
            }
        }

        return $data_string;
    }

    protected function render() {

        $settings = $this->get_settings();

        $this->add_render_attribute('sa_el_google_map_wrap', [
            'class' => ['sa-el-google-map'],
            'id' => 'sa-el-google-map-' . esc_attr($this->get_id()),
            'data-id' => esc_attr($this->get_id())
        ]);
        ?>

        <?php if (!empty($settings['sa_el_google_map_type'])) : ?>
            <div <?php echo $this->get_render_attribute_string('sa_el_google_map_wrap'), $this->get_map_render_data_attribute_string($settings); ?>></div>
        <?php endif; ?>
        <div class="google-map-notice"></div>
        <?php
    }

    protected function content_template() {
        
    }

}
