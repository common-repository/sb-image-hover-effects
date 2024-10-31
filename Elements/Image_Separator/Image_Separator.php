<?php

namespace SA_EL_ADDONS\Elements\Image_Separator;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Image Scroller
 *
 * @author biplo
 * 
 */
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;
use \Elementor\Widget_Base as Widget_Base;

class Image_Separator extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_image_separator';
    }

    public function get_title() {
        return esc_html__('Image Separator', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-image-box oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }


    protected function _register_controls() {

        /* Start Content Section */
        $this->start_controls_section('sa_el_image_separator_general_settings',
                [
                    'label' => __('Image Settings', SA_EL_ADDONS_TEXTDOMAIN)
                ]
        );

        /* Separator Image */
        $this->add_control('sa_el_image_separator_image',
                [
                    'label' => __('Image', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => ['active' => true],
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'description' => __('Choose the separator image', SA_EL_ADDONS_TEXTDOMAIN),
                    'label_block' => true
                ]
        );

        /* Separator Image Size */
        $this->add_responsive_control('sa_el_image_separator_image_size',
                [
                    'label' => __('Image Size', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', "em"],
                    'default' => [
                        'unit' => 'px',
                        'size' => 200,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 800,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-image-separator-container img' => 'width: {{SIZE}}{{UNIT}};'
                    ]
                ]
        );

        /* Separator Image Gutter */
        $this->add_control('sa_el_image_separator_image_gutter',
                [
                    'label' => __('Image Gutter (%)', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::NUMBER,
                    'default' => -50,
                    'description' => __('-50% is default. Increase to push the image outside or decrease to pull the image inside.', SA_EL_ADDONS_TEXTDOMAIN),
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-image-separator-container' => 'transform: translateY( {{VALUE}}% );'
                    ]
                ]
        );

        $this->add_control('sa_el_image_separator_image_align',
                [
                    'label' => __('Image Alignment', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left'
                        ],
                        'center' => [
                            'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-center'
                        ],
                        'right' => [
                            'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right'
                        ],
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .sa-el-image-separator-container' => 'text-align: {{VALUE}};',
                    ]
                ]
        );


        /* Add Link Switcher */
        $this->add_control('sa_el_image_separator_link_switcher',
                [
                    'label' => __('Link', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __('Add a custom link or select an existing page link', SA_EL_ADDONS_TEXTDOMAIN),
                ]
        );

        $this->add_control('sa_el_image_separator_link_type',
                [
                    'label' => __('Link/URL', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'url' => __('URL', SA_EL_ADDONS_TEXTDOMAIN),
                        'link' => __('Existing Page', SA_EL_ADDONS_TEXTDOMAIN),
                    ],
                    'default' => 'url',
                    'condition' => [
                        'sa_el_image_separator_link_switcher' => 'yes',
                    ],
                    'label_block' => true,
                ]
        );

        $this->add_control('sa_el_image_separator_existing_page',
                [
                    'label' => __('Existing Page', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT2,
                    'options' => $this->sa_el_get_all_post(),
                    'condition' => [
                        'sa_el_image_separator_link_switcher' => 'yes',
                        'sa_el_image_separator_link_type' => 'link',
                    ],
                    'multiple' => false,
                    'label_block' => true,
                ]
        );

        $this->add_control('sa_el_image_separator_image_link',
                [
                    'label' => __('URL', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                        'categories' => [
                            TagsModule::POST_META_CATEGORY,
                            TagsModule::URL_CATEGORY
                        ]
                    ],
                    'condition' => [
                        'sa_el_image_separator_link_switcher' => 'yes',
                        'sa_el_image_separator_link_type' => 'url',
                    ],
                    'label_block' => true
                ]
        );

        $this->add_control('sa_el_image_separator_image_link_text',
                [
                    'label' => __('Image Hovering Title', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::TEXT,
                    'condition' => [
                        'sa_el_image_separator_link_switcher' => 'yes',
                    ],
                    'label_block' => true
                ]
        );

        /* Link Target */
        $this->add_control('sa_el_image_separator_link_target',
                [
                    'label' => __('Link Target', SA_EL_ADDONS_TEXTDOMAIN),
                    'type' => Controls_Manager::SELECT,
                    'description' => __(' Where would you like the link be opened?', SA_EL_ADDONS_TEXTDOMAIN),
                    'options' => [
                        'blank' => ('Blank'),
                        'parent' => ('Parent'),
                        'self' => ('Self'),
                        'top' => ('Top'),
                    ],
                    'default' => __('blank', SA_EL_ADDONS_TEXTDOMAIN),
                    'condition' => [
                        'sa_el_image_separator_link_switcher' => 'yes',
                    ],
                    'label_block' => true,
                ]
        );

        /* End Price Settings Section */
        $this->end_controls_section();

        $this->Sa_El_Support();

        /* Start Style Section */
        $this->start_controls_section('sa_el_image_separator_style',
                [
                    'label' => __('Image', SA_EL_ADDONS_TEXTDOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Css_Filter::get_type(),
                [
                    'name' => 'css_filters',
                    'selector' => '{{WRAPPER}} .sa-el-image-separator-container img',
                ]
        );

        /* End Style Section */
        $this->end_controls_section();
    }

    protected function render() {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();

        $link_type = $settings['sa_el_image_separator_link_type'];

        $link_url = ( 'url' == $link_type ) ? $settings['sa_el_image_separator_image_link'] : get_permalink($settings['sa_el_image_separator_existing_page']);

        $alt = esc_attr(Control_Media::get_image_alt($settings['sa_el_image_separator_image']));
        ?>

        <div class="sa-el-image-separator-container">

            <img class="img-responsive" src="<?php echo $settings['sa_el_image_separator_image']['url']; ?>" alt="<?php echo $alt; ?>">
            <?php if ($settings['sa_el_image_separator_link_switcher'] == 'yes') : ?>
                <a class="sa-el-image-separator-link" href="<?php echo $link_url; ?>" target="_<?php echo $settings['sa_el_image_separator_link_target']; ?>" title="<?php echo $settings['sa_el_image_separator_image_link_text']; ?>">
                </a>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <#
        var linkType = settings.sa_el_image_separator_link_type,

        imgUrl = settings.sa_el_image_separator_image.url,

        linkSwitch = settings.sa_el_image_separator_link_switcher,

        linkTarget = settings.sa_el_image_separator_link_target,

        linkTitle = settings.sa_el_image_separator_image_link_text,

        linkUrl = ( 'url' == linkType ) ? settings.sa_el_image_separator_image_link : settings.sa_el_image_separator_existing_page;
        #>

        <div class="sa-el-image-separator-container">
            <img alt="image separator" class="img-responsive" src="{{ imgUrl }}">
            <#
            if( 'yes' == linkSwitch ) { #>

            <a class="sa-el-image-separator-link" href="{{ linkUrl }}" target="_{{ linkTarget }}" title="{{ linkTitle }}"></a>

            <# }
            #>

            <?php
        }

    }
    