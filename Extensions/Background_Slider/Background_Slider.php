<?php

namespace SA_EL_ADDONS\Extensions\Background_Slider;

/**
 * Description of SA_Content_Protection
 *
 * @author Jabir
 */
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;

class Background_Slider {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function __construct() {

        add_action('elementor/element/after_section_end', [$this, '_add_controls'], 10, 3);

        add_action('elementor/frontend/element/before_render', [$this, '_before_render'], 10, 1);

        add_action('elementor/frontend/column/before_render', [$this, '_before_render'], 10, 1);
        add_action('elementor/frontend/section/before_render', [$this, '_before_render'], 10, 1);

        add_action('elementor/element/print_template', [$this, '_print_template'], 10, 2);
        add_action('elementor/section/print_template', [$this, '_print_template'], 10, 2);
        add_action('elementor/column/print_template', [$this, '_print_template'], 10, 2);
    }

    public function _add_controls($element, $section_id, $args) {
        if (('section' === $element->get_name() && 'section_background' === $section_id) || ('column' === $element->get_name() && 'section_style' === $section_id)) {

            $element->start_controls_section(
                    '_sa_el_section_bg_slider',
                    [
                        'label' => __('OXI Background Slider', SA_EL_ADDONS_TEXTDOMAIN),
                        'tab' => Controls_Manager::TAB_STYLE
                    ]
            );

            $element->add_control(
                    'sa_el_bg_slider_images',
                    [
                        'label' => __('Add Images', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::GALLERY,
                        'default' => [],
                    ]
            );

            $element->add_group_control(
                    Group_Control_Image_Size::get_type(),
                    [
                        'name' => 'sa_el_thumbnail',
                    ]
            );

            /* $slides_to_show = range( 1, 10 );
              $slides_to_show = array_combine( $slides_to_show, $slides_to_show );

              $element->add_control(
              'slides_to_show',
              [
              'label' => __( 'Slides to Show', SA_EL_ADDONS_TEXTDOMAIN ),
              'type' => Controls_Manager::SELECT,
              'default' => '3',
              'options' => $slides_to_show,
              ]
              ); */
            /* $element->add_control(
              'slide',
              [
              'label' => __( 'Initial Slide', SA_EL_ADDONS_TEXTDOMAIN ),
              'type' => Controls_Manager::TEXT,
              'label_block' => true,
              'placeholder' => __( 'Initial Slide', SA_EL_ADDONS_TEXTDOMAIN ),
              'default' => __( '0', SA_EL_ADDONS_TEXTDOMAIN ),
              ]
              ); */

            $element->add_control(
                    'sa_el_slider_transition',
                    [
                        'label' => __('Transition', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'fade' => __('Fade', SA_EL_ADDONS_TEXTDOMAIN),
                            'fade2' => __('Fade2', SA_EL_ADDONS_TEXTDOMAIN),
                            'slideLeft' => __('slide Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'slideLeft2' => __('Slide Left 2', SA_EL_ADDONS_TEXTDOMAIN),
                            'slideRight' => __('Slide Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'slideRight2' => __('Slide Right 2', SA_EL_ADDONS_TEXTDOMAIN),
                            'slideUp' => __('Slide Up', SA_EL_ADDONS_TEXTDOMAIN),
                            'slideUp2' => __('Slide Up 2', SA_EL_ADDONS_TEXTDOMAIN),
                            'slideDown' => __('Slide Down', SA_EL_ADDONS_TEXTDOMAIN),
                            'slideDown2' => __('Slide Down 2', SA_EL_ADDONS_TEXTDOMAIN),
                            'zoomIn' => __('Zoom In', SA_EL_ADDONS_TEXTDOMAIN),
                            'zoomIn2' => __('Zoom In 2', SA_EL_ADDONS_TEXTDOMAIN),
                            'zoomOut' => __('Zoom Out', SA_EL_ADDONS_TEXTDOMAIN),
                            'zoomOut2' => __('Zoom Out 2', SA_EL_ADDONS_TEXTDOMAIN),
                            'swirlLeft' => __('Swirl Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'swirlLeft2' => __('Swirl Left 2', SA_EL_ADDONS_TEXTDOMAIN),
                            'swirlRight' => __('Swirl Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'swirlRight2' => __('Swirl Right 2', SA_EL_ADDONS_TEXTDOMAIN),
                            'burn' => __('Burn', SA_EL_ADDONS_TEXTDOMAIN),
                            'burn2' => __('Burn 2', SA_EL_ADDONS_TEXTDOMAIN),
                            'blur' => __('Blur', SA_EL_ADDONS_TEXTDOMAIN),
                            'blur2' => __('Blur 2', SA_EL_ADDONS_TEXTDOMAIN),
                            'flash' => __('Flash', SA_EL_ADDONS_TEXTDOMAIN),
                            'flash2' => __('Flash 2', SA_EL_ADDONS_TEXTDOMAIN),
                            'random' => __('Random', SA_EL_ADDONS_TEXTDOMAIN)
                        ],
                        'default' => 'fade',
                    ]
            );
            $element->add_control(
                    'sa_el_slider_animation',
                    [
                        'label' => __('Animation', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'kenburns' => __('Kenburns', SA_EL_ADDONS_TEXTDOMAIN),
                            'kenburnsUp' => __('Kenburns Up', SA_EL_ADDONS_TEXTDOMAIN),
                            'kenburnsDown' => __('Kenburns Down', SA_EL_ADDONS_TEXTDOMAIN),
                            'kenburnsRight' => __('Kenburns Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'kenburnsLeft' => __('Kenburns Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'kenburnsUpLeft' => __('Kenburns Up Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'kenburnsUpRight' => __('Kenburns Up Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'kenburnsDownLeft' => __('Kenburns Down Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'kenburnsDownRight' => __('Kenburns Down Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'random' => __('Random', SA_EL_ADDONS_TEXTDOMAIN),
                            '' => __('None', SA_EL_ADDONS_TEXTDOMAIN)
                        ],
                        'default' => 'kenburns',
                    ]
            );

            $element->add_control(
                    'sa_el_custom_overlay_switcher',
                    [
                        'label' => __('Custom Overlay', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::SWITCHER,
                        'default' => '',
                        'label_on' => __('Show', SA_EL_ADDONS_TEXTDOMAIN),
                        'label_off' => __('Hide', SA_EL_ADDONS_TEXTDOMAIN),
                        'return_value' => 'yes',
                    ]
            );
            /* $element->add_control(
              'custom_overlay',
              [
              'label' => __( 'Overlay Image', SA_EL_ADDONS_TEXTDOMAIN ),
              'type' => Controls_Manager::MEDIA,
              'condition' => [
              'sa_el_custom_overlay_switcher' => 'yes',
              ]
              ]
              ); */
            $element->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'sa_el_slider_custom_overlay',
                        'label' => __('Overlay Image', SA_EL_ADDONS_TEXTDOMAIN),
                        'types' => ['none', 'classic', 'gradient'],
                        'selector' => '{{WRAPPER}} .vegas-overlay',
                        'condition' => [
                            'sa_el_custom_overlay_switcher' => 'yes',
                        ]
                    ]
            );
            $element->add_control(
                    'sa_el_slider_overlay',
                    [
                        'label' => __('Overlay', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            '' => __('None', SA_EL_ADDONS_TEXTDOMAIN),
                            '01' => __('Style 1', SA_EL_ADDONS_TEXTDOMAIN),
                            '02' => __('Style 2', SA_EL_ADDONS_TEXTDOMAIN),
                            '03' => __('Style 3', SA_EL_ADDONS_TEXTDOMAIN),
                            '04' => __('Style 4', SA_EL_ADDONS_TEXTDOMAIN),
                            '05' => __('Style 5', SA_EL_ADDONS_TEXTDOMAIN),
                            '06' => __('Style 6', SA_EL_ADDONS_TEXTDOMAIN),
                            '07' => __('Style 7', SA_EL_ADDONS_TEXTDOMAIN),
                            '08' => __('Style 8', SA_EL_ADDONS_TEXTDOMAIN),
                            '09' => __('Style 9', SA_EL_ADDONS_TEXTDOMAIN)
                        ],
                        'default' => '01',
                        'condition' => [
                            'sa_el_custom_overlay_switcher' => '',
                        ]
                    ]
            );
            $element->add_control(
                    'sa_el_slider_cover',
                    [
                        'label' => __('Cover', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'true' => __('True', SA_EL_ADDONS_TEXTDOMAIN),
                            'false' => __('False', SA_EL_ADDONS_TEXTDOMAIN)
                        ],
                        'default' => 'true',
                    ]
            );
            $element->add_control(
                    'sa_el_slider_delay',
                    [
                        'label' => __('Delay', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'placeholder' => __('Delay', SA_EL_ADDONS_TEXTDOMAIN),
                        'default' => __('5000', SA_EL_ADDONS_TEXTDOMAIN),
                    ]
            );
            $element->add_control(
                    'sa_el_slider_timer_bar',
                    [
                        'label' => __('Timer', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'true' => __('True', SA_EL_ADDONS_TEXTDOMAIN),
                            'false' => __('False', SA_EL_ADDONS_TEXTDOMAIN)
                        ],
                        'default' => 'true',
                    ]
            );
            $element->add_control(
                    'get_sa_el_addons_plugins_url',
                    [
                        'label' => __('Delay', SA_EL_ADDONS_TEXTDOMAIN),
                        'type' => Controls_Manager::HIDDEN,
                        'default' => __(SA_EL_ADDONS_URL, SA_EL_ADDONS_TEXTDOMAIN),
                    ]
            );

            $element->end_controls_section();
        }
    }

    function _before_render(\Elementor\Element_Base $element) {
        add_filter('sael/section/after_render', function ($extensions) {
            $extensions[] = 'sael-background-slider';
            return $extensions;
        });
        if ($element->get_name() != 'section' && $element->get_name() != 'column') {
            return;
        }
        $settings = $element->get_settings();
        //echo '<pre>'; print_r($settings);
        $element->add_render_attribute('_wrapper', 'class', 'has_sa_el_slider');
        $element->add_render_attribute('sa-el-bs-background-slideshow-wrapper', 'class', 'sa-el-bs-background-slideshow-wrapper');

        $element->add_render_attribute('sa-el-bs-backgroundslideshow', 'class', 'sa-el-at-backgroundslideshow');

        $slides = [];

        if (empty($settings['sa_el_bg_slider_images'])) {
            return;
        }

        foreach ($settings['sa_el_bg_slider_images'] as $attachment) {
            $image_url = Group_Control_Image_Size::get_attachment_image_src($attachment['id'], 'sa_el_thumbnail', $settings);
            $slides[] = ['src' => $image_url];
        }

        if (empty($slides)) {
            return;
        }
        ?>

        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery(".elementor-element-<?php echo $element->get_id(); ?>").prepend('<div class="sa-el-section-bs"><div class="sa-el-section-bs-inner"></div></div>');
                var sa_el_plugins_url = '<?php echo $settings["sa_el_slider_custom_overlay_image"]['url']; ?>';
                var bgimage = '<?php echo $settings["sa_el_slider_custom_overlay_image"]['url']; ?>';
                if ('<?php echo $settings["sa_el_custom_overlay_switcher"]; ?>' == 'yes') {

                    //if(bgimage == ''){
                    //    var bgoverlay = '<?php echo $settings["sa_el_slider_custom_overlay_image"]['url']; ?>';
                    //}else{
                    var bgoverlay = '<?php echo SA_EL_ADDONS_URL . "/assets/vendor/vegas/overlays/00.png"; ?>';
                    // }
                } else {
                    if ('<?php echo $settings["sa_el_slider_overlay"]; ?>') {
                        var bgoverlay = '<?php echo SA_EL_ADDONS_URL . "assets/vendor/vegas/overlays/" . $settings["sa_el_slider_overlay"] . ".png"; ?>';
                    } else {
                        var bgoverlay = '<?php echo SA_EL_ADDONS_URL . "assets/vendor/vegas/overlays/00.png"; ?>';
                    }
                }


                jQuery(".elementor-element-<?php echo $element->get_id(); ?>").children('.sa-el-section-bs').children('.sa-el-section-bs-inner').SACUvegas({
                    slides: <?php echo json_encode($slides) ?>,
                    transition: '<?php echo $settings['sa_el_slider_transition']; ?>',
                    animation: '<?php echo $settings['sa_el_slider_animation']; ?>',
                    overlay: bgoverlay,
                    cover: <?php echo $settings['sa_el_slider_cover']; ?>,
                    delay: <?php echo $settings['sa_el_slider_delay']; ?>,
                    timer: <?php echo $settings['sa_el_slider_timer_bar']; ?>
                });
                if ('<?php echo $settings["sa_el_custom_overlay_switcher"]; ?>' == 'yes') {
                    jQuery(".elementor-element-<?php echo $element->get_id(); ?>").children('.sa-el-section-bs').children('.sa-el-section-bs-inner').children('.vegas-overlay').css('background-image', '');
                }
            });
        </script>
        <?php
    }

    function _print_template($template, $widget) {
        if ($widget->get_name() != 'section' && $widget->get_name() != 'column') {
            return $template;
        }

        $old_template = $template;
        ob_start();
        ?>
        <#

        var rand_id = Math.random().toString(36).substring(7);
        var slides_path_string = '';
        var sa_el_plugins_url = settings.get_sa_el_addons_plugins_url;
        var sa_el_transition = settings.sa_el_slider_transition;
        var sa_el_animation = settings.sa_el_slider_animation;
        var sa_el_custom_overlay = settings.sa_el_custom_overlay_switcher;
        var sa_el_overlay = '';
        var sa_el_cover = settings.sa_el_slider_cover;
        var sa_el_delay = settings.sa_el_slider_delay;
        var sa_el_timer = settings.sa_el_slider_timer_bar;

        if(!_.isUndefined(settings.sa_el_bg_slider_images) && settings.sa_el_bg_slider_images.length){
        var slider_data = [];
        slides = settings.sa_el_bg_slider_images;
        for(var i in slides){
        slider_data[i]  = slides[i].url;
        }
        slides_path_string = slider_data.join();
        }

        if(settings.sa_el_custom_overlay_switcher == 'yes'){
        //if(settings.sa_el_slider_custom_overlay_image.url){
        //sa_el_overlay = settings.sa_el_slider_custom_overlay_image.url;
        //}else{
        sa_el_overlay = '00.png';
        //}
        }else{
        if(settings.sa_el_slider_overlay){
        sa_el_overlay = settings.sa_el_slider_overlay + '.png';
        }else{
        sa_el_overlay = '00.png';
        }
        }
        #>

        <div class="sa-el-section-bs">
            <div class="sa-el-section-bs-inner"
                 data-sa_el_plugins_url="{{ sa_el_plugins_url }}"
                 data-sa-el-bg-slider="{{ slides_path_string }}"
                 data-sa-el-bg-slider-transition="{{ sa_el_transition }}"

                 data-sa-el-bg-slider-animation="{{ sa_el_animation }}"
                 data-sa-el-bg-custom-overlay="{{ sa_el_custom_overlay }}"
                 data-sa-el-bg-slider-overlay="{{ sa_el_overlay }}"
                 data-sa-el-bg-slider-cover="{{ sa_el_cover }}"
                 data-sa-el-bs-slider-delay="{{ sa_el_delay }}"
                 data-sa-el-bs-slider-timer="{{ sa_el_timer }}"
                 ></div>
        </div>

        <?php
        $slider_content = ob_get_contents();
        ob_end_clean();
        $template = $slider_content . $old_template;

        return $template;
    }

}
