<?php

namespace SA_EL_ADDONS\Extensions\Section_Particle;

/**
 * Description of Particle_Section
 *
 * @author Jabir
 */
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Elementor_Base;
use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Widget_Base;
use Elementor\Repeater;
use SA_EL_ADDONS\Classes\Build_API;

class Section_Particle extends Build_API {

    public function config() {
        $this->prefix = 'particle';
        add_action('elementor/frontend/section/before_render', array($this, 'before_render'));
        add_action('elementor/element/section/section_layout/after_section_end', array($this, 'register_controls'), 10);
        add_action('elementor/frontend/section/after_render', array($this, 'after_render'));
    }

    public function register_controls($element) {

        $element->start_controls_section(
                'sa_el_particles_section',
                [
                    'label' => 'OXI Particle',
                    'tab' => Controls_Manager::TAB_LAYOUT
                ]
        );

        $element->add_control(
                'sa_el_particle_switch',
                [
                    'label' => __('Enable Particles', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                ]
        );

        $element->add_control(
                'sa_el_particle_area_zindex',
                [
                    'label' => __('Z-index', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'default' => -1,
                    'condition' => [
                        'sa_el_particle_switch' => 'yes'
                    ]
                ]
        );

        $element->add_control(
                'sa_el_particle_theme_from',
                [
                    'label' => __('Theme Source', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'presets' => [
                            'title' => __('Defaults', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-list',
                        ],
                        'custom' => [
                            'title' => __('Custom', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-edit',
                        ],
                    ],
                    'condition' => [
                        'sa_el_particle_switch' => 'yes'
                    ],
                    'default' => 'presets'
                ]
        );

        $element->add_control(
                'sa_el_particle_preset_themes',
                [
                    'label' => esc_html__('Preset Themes', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => true,
                    'options' => [
                        'default' => __('Default', SA_EL_ADDONS_TEXTDOMAIN),
                        'nasa' => __('Nasa', SA_EL_ADDONS_TEXTDOMAIN),
                        'bubble' => __('Bubble', SA_EL_ADDONS_TEXTDOMAIN),
                        'snow' => __('Snow', SA_EL_ADDONS_TEXTDOMAIN),
                        'nyan_cat' => __('Nyan Cat', SA_EL_ADDONS_TEXTDOMAIN)
                    ],
                    'default' => 'default',
                    'condition' => [
                        'sa_el_particle_theme_from' => 'presets',
                        'sa_el_particle_switch' => 'yes'
                    ]
                ]
        );

        $element->add_control(
                'sa_el_particles_custom_style',
                [
                    'label' => __('Custom Style', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXTAREA,
                    'description' => __('You can generate custom particles JSON code from <a href="http://vincentgarreau.com/particles.js/#default" target="_blank">Here!</a>. Simply just past the JSON code above. For more queries <a href="https://www.sa-elementor-addons.com/docs/" target="_blank">Click Here!</a>', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_particle_theme_from' => 'custom',
                        'sa_el_particle_switch' => 'yes'
                    ]
                ]
        );

        $element->add_control(
                'sa_el_particle_section_notice',
                [
                    'raw' => __('You need to configure a <strong style="color:green">Background Type</strong> to see this in full effect. You can do this by switching to the <strong style="color:green">Style</strong> Tab.', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::RAW_HTML,
                    'condition' => [
                        'sa_el_particle_theme_from' => 'custom',
                        'sa_el_particle_switch' => 'yes'
                    ]
                ]
        );

        $element->end_controls_section();
    }

    public function before_render($element) {

        add_filter('sael/section/after_render', function ($extensions) {
            $extensions[] = 'sael-section-particle';
            return $extensions;
        });
        $settings = $element->get_settings();


        if ($settings['sa_el_particle_switch'] !== 'yes') {
            $element->add_render_attribute('_wrapper', 'data-sa_particle_enable', 'false');
        }

        if ($settings['sa_el_particle_switch'] == 'yes') {
            $element->add_render_attribute(
                    '_wrapper',
                    [
                        'id' => 'sa-el-section-particles-' . $element->get_id(),
                        'data-sa_el_ptheme_source' => $settings['sa_el_particle_theme_from'],
                        'data-sa_el_preset_theme' => ($settings['sa_el_particle_theme_from'] == 'presets' ? $settings['sa_el_particle_preset_themes'] : ''),
                        'data-sa_el_custom_style' => ($settings['sa_el_particle_theme_from'] == 'custom' ? $settings['sa_el_particles_custom_style'] : ''),
                    ]
            );
        }
    }

    public function after_render($element) {

        $data = $element->get_data();
        $settings = $element->get_settings_for_display();
        $type = $data['elType'];
        $zindex = !empty($settings['sa_el_particle_area_zindex']) ? $settings['sa_el_particle_area_zindex'] : 0;

        if (('section' == $type) && ($element->get_settings('sa_el_particle_switch') == 'yes')) {
            add_filter('sael/section/after_render', [$this, 'sa_el_section_after_render']);
            ?>
            <style>
                .elementor-element-<?php echo $element->get_id(); ?>.sa-el-particles-section > canvas{
                    z-index: <?php echo $zindex; ?>;
                    position: absolute;
                    top:0;
                }
            </style>
            <?php
        }
    }

    public function sa_el_section_after_render($extensions) {
        $extensions[] = 'section-particles';

        return $extensions;
    }

    public function get_particle_render() {
        $object = [
            'default' => '{"particles":{"number":{"value":160,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true}',
            'nasa' => '{"particles":{"number":{"value":250,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":1,"random":true,"anim":{"enable":true,"speed":1,"opacity_min":0,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":4,"size_min":0.3,"sync":false}},"line_linked":{"enable":false,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":1,"direction":"none","random":true,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":600}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"bubble"},"onclick":{"enable":true,"mode":"repulse"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":250,"size":0,"duration":2,"opacity":0,"speed":3},"repulse":{"distance":400,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true}',
            'bubble' => '{"particles":{"number":{"value":15,"density":{"enable":true,"value_area":800}},"color":{"value":"#1b1e34"},"shape":{"type":"polygon","stroke":{"width":0,"color":"#000"},"polygon":{"nb_sides":6},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.3,"random":true,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":50,"random":false,"anim":{"enable":true,"speed":10,"size_min":40,"sync":false}},"line_linked":{"enable":false,"distance":200,"color":"#ffffff","opacity":1,"width":2},"move":{"enable":true,"speed":8,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":false,"mode":"grab"},"onclick":{"enable":false,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true}',
            'snow' => '{"particles":{"number":{"value":450,"density":{"enable":true,"value_area":800}},"color":{"value":"#fff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":true,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":5,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":false,"distance":500,"color":"#ffffff","opacity":0.4,"width":2},"move":{"enable":true,"speed":6,"direction":"bottom","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"bubble"},"onclick":{"enable":true,"mode":"repulse"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":0.5}},"bubble":{"distance":400,"size":4,"duration":0.3,"opacity":1,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true}',
            'nyan_cat' => '{"particles":{"number":{"value":150,"density":{"enable":false,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"star","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"http://wiki.lexisnexis.com/academic/images/f/fb/Itunes_podcast_icon_300.jpg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":4,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":false,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":14,"direction":"left","random":false,"straight":true,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":false,"mode":"grab"},"onclick":{"enable":true,"mode":"repulse"},"resize":true},"modes":{"grab":{"distance":200,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true}',
        ];
        return json_encode($object);
    }

}
