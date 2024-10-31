<?php

namespace SA_EL_ADDONS\Elements\Social_Share;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

class Social_Share extends Widget_Base
{
	use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name()
    {
        return 'sa_el_social_share';
    }

    public function get_title()
    {
        return esc_html__('Social Share', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-social-icons oxi-el-admin-icon';
    }

    public function get_categories()
    {
        return ['sa-el-addons'];
    }

    protected $_has_template_content = false;

    private static $medias_class = [
        'googleplus' => 'fa fa-google-plus',
        'pocket'     => 'fa fa-get-pocket',
        'email'      => 'fa fa-envelope',
        'vkontakte'  => 'fa fa-vk',
    ];
    private static $medias = [
		'facebook' => [
			'title' => 'Facebook',
			'has_counter' => true,
		],
		'googleplus' => [
			'title' => 'Google+',
		],
		'twitter' => [
			'title' => 'Twitter',
		],
		'pinterest' => [
			'title' => 'Pinterest',
			'has_counter' => true,
		],
		'linkedin' => [
			'title' => 'Linkedin',
			'has_counter' => true,
		],
		'vkontakte' => [
			'title' => 'Vkontakte',
			'has_counter' => true,
		],
		'odnoklassniki' => [
			'title' => 'OK',
			'has_counter' => true,
		],
		'moimir' => [
			'title' => 'Mail.Ru',
			'has_counter' => true,
		],
		'livejournal' => [
			'title' => 'LiveJournal',
		],
		'tumblr' => [
			'title' => 'Tumblr',
			'has_counter' => true,
		],
		'blogger' => [
			'title' => 'Blogger',
		],
		'digg' => [
			'title' => 'Digg',
		],
		'evernote' => [
			'title' => 'Evernote',
		],
		'reddit' => [
			'title' => 'Reddit',
			'has_counter' => true,
		],
		'delicious' => [
			'title' => 'Delicious',
			'has_counter' => true,
		],
		'stumbleupon' => [
			'title' => 'StumbleUpon',
			'has_counter' => true,
		],
		'pocket' => [
			'title' => 'Pocket',
			'has_counter' => true,
		],
		'surfingbird' => [
			'title' => 'Surfingbird',
			'has_counter' => true,
		],
		'liveinternet' => [
			'title' => 'LiveInternet',
		],
		'buffer' => [
			'title' => 'Buffer',
			'has_counter' => true,
		],
		'instapaper' => [
			'title' => 'Instapaper',
		],
		'xing' => [
			'title' => 'Xing',
			'has_counter' => true,
		],
		'wordpress' => [
			'title' => 'Wordpress',
		],
		'baidu' => [
			'title' => 'Baidu',
		],
		'renren' => [
			'title' => 'Renren',
		],
		'weibo' => [
			'title' => 'Weibo',
		],
		// Mobile Device Sharing
		'skype' => [
			'title' => 'Skype',
		],
		'telegram' => [
			'title' => 'Telegram',
		],
		'viber' => [
			'title' => 'Viber',
		],
		'whatsapp' => [
			'title' => 'WhatsApp',
		],
		'line' => [
			'title' => 'LINE',
		],
	];

	public static function get_social_media( $media_name = null ) {
		if ( $media_name ) {
			return isset( self::$medias[ $media_name ] ) ? self::$medias[ $media_name ] : null;
		}

		return self::$medias;
	}
    private static function get_social_media_class($media_name)
    {
        if (isset(self::$medias_class[$media_name])) {
            return self::$medias_class[$media_name];
        }

        return 'fa fa-' . $media_name;
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
			'section_buttons_content',
			[
				'label' => esc_html__( 'Share Buttons', SA_EL_ADDONS_TEXTDOMAIN ),
			]
		);

		$repeater = new Repeater();

		$medias = self::get_social_media();

		$medias_names = array_keys( $medias );

		$repeater->add_control(
			'button',
			[
				'label' => esc_html__( 'Social Media', SA_EL_ADDONS_TEXTDOMAIN ),
				'type' => Controls_Manager::SELECT,
				'options' => array_reduce( $medias_names, function( $options, $media_name ) use ( $medias ) {
					$options[ $media_name ] = $medias[ $media_name ]['title'];

					return $options;
				}, [] ),
				'default' => 'facebook',
			]
		);

		$repeater->add_control(
			'text',
			[
				'label' => esc_html__( 'Custom Label', SA_EL_ADDONS_TEXTDOMAIN ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'share_buttons',
			[
				'type'    => Controls_Manager::REPEATER,
				'fields'  => array_values( $repeater->get_controls() ),
				'default' => [
					[
						'button' => 'facebook',
					],
					[
						'button' => 'googleplus',
					],
					[
						'button' => 'twitter',
					],
					[
						'button' => 'pinterest',
					],
				],
				'title_field' => '{{{ button }}}',
			]
		);

		$this->add_control(
			'view',
			[
				'label'       => esc_html__( 'View', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => false,
				'options'     => [
					'icon-text' => 'Icon & Text',
					'icon'      => 'Icon',
					'text'      => 'Text',
				],
				'default'      => 'icon-text',
				'separator'    => 'before',
				'prefix_class' => 'sa-el-social-share-buttons-view-',
				'render_type'  => 'template',
			]
		);

		$this->add_control(
			'show_label',
			[
				'label'     => esc_html__( 'Label', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'view' => 'icon-text',
				],
			]
		);

		$this->add_control(
			'show_counter',
			[
				'label'     => esc_html__( 'Count', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'view!' => 'icon',
				],
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Style', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'flat'     => esc_html__( 'Flat', SA_EL_ADDONS_TEXTDOMAIN ),
					'framed'   => esc_html__( 'Framed', SA_EL_ADDONS_TEXTDOMAIN ),
					'gradient' => esc_html__( 'Gradient', SA_EL_ADDONS_TEXTDOMAIN ),
					'minimal'  => esc_html__( 'Minimal', SA_EL_ADDONS_TEXTDOMAIN ),
					'boxed'    => esc_html__( 'Boxed Icon', SA_EL_ADDONS_TEXTDOMAIN ),
				],
				'default'      => 'flat',
				'prefix_class' => 'sa-el-social-share-buttons-style-',
			]
		);

		$this->add_control(
			'shape',
			[
				'label'   => esc_html__( 'Shape', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'square'  => esc_html__( 'Square', SA_EL_ADDONS_TEXTDOMAIN ),
					'rounded' => esc_html__( 'Rounded', SA_EL_ADDONS_TEXTDOMAIN ),
					'circle'  => esc_html__( 'Circle', SA_EL_ADDONS_TEXTDOMAIN ),
				],
				'default'      => 'square',
				'prefix_class' => 'sa-el-social-share-buttons-shape-',
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label'   => esc_html__( 'Columns', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => [
					'0' => 'Auto',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'prefix_class' => 'sa-el-ep-grid%s-',
			]
		);

		$this->add_control(
			'alignment',
			[
				'label'   => esc_html__( 'Alignment', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', SA_EL_ADDONS_TEXTDOMAIN ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', SA_EL_ADDONS_TEXTDOMAIN ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', SA_EL_ADDONS_TEXTDOMAIN ),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justify', SA_EL_ADDONS_TEXTDOMAIN ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'sa-el-social-share-buttons-align-',
				'condition'    => [
					'columns' => '0',
				],
			]
		);

		$this->add_control(
			'share_url_type',
			[
				'label'   => esc_html__( 'Target URL', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'current_page' => esc_html__( 'Current Page', SA_EL_ADDONS_TEXTDOMAIN ),
					'custom'       => esc_html__( 'Custom', SA_EL_ADDONS_TEXTDOMAIN ),
				],
				'default'   => 'current_page',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'share_url',
			[
				'label'         => esc_html__( 'URL', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'          => Controls_Manager::URL,
				'show_external' => false,
				'placeholder'   => 'http://your-link.com',
				'condition'     => [
					'share_url_type' => 'custom',
				],
				'show_label'         => false,
			]
		);

		$this->end_controls_section();

		$this->Sa_El_Support();

		$this->start_controls_section(
			'section_buttons_style',
			[
				'label' => esc_html__( 'Share Buttons', SA_EL_ADDONS_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[
				'label'   => esc_html__( 'Columns Gap', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .sa-el-social-share-button' => 'margin-right: calc({{SIZE}}{{UNIT}} / 2); margin-left: calc({{SIZE}}{{UNIT}} / 2);',
					'{{WRAPPER}} .sa-el-ep-grid'             => 'margin-right: calc(-{{SIZE}}{{UNIT}} / 2); margin-left: calc(-{{SIZE}}{{UNIT}} / 2);',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label'   => esc_html__( 'Rows Gap', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .sa-el-social-share-button' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_size',
			[
				'label' => esc_html__( 'Button Size', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0.5,
						'max'  => 2,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sa-el-social-share-button' => 'font-size: calc({{SIZE}}{{UNIT}} * 10);',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'em' => [
						'min'  => 0.5,
						'max'  => 4,
						'step' => 0.1,
					],
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'em',
				],
				'tablet_default' => [
					'unit' => 'em',
				],
				'mobile_default' => [
					'unit' => 'em',
				],
				'size_units' => [ 'em', 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .sa-el-social-share-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'view!' => 'text',
				],
			]
		);

		$this->add_responsive_control(
			'button_height',
			[
				'label' => esc_html__( 'Button Height', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'em' => [
						'min'  => 1,
						'max'  => 7,
						'step' => 0.1,
					],
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'em',
				],
				'tablet_default' => [
					'unit' => 'em',
				],
				'mobile_default' => [
					'unit' => 'em',
				],
				'size_units' => [ 'em', 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .sa-el-social-share-button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_size',
			[
				'label'      => esc_html__( 'Border Size', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default'    => [
					'size' => 2,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
					'em' => [
						'max'  => 2,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sa-el-social-share-button' => 'border-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => [ 'framed', 'boxed' ],
				],
			]
		);

		$this->add_control(
			'color_source',
			[
				'label'       => esc_html__( 'Color', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => false,
				'options'     => [
					'original' => 'Original Color',
					'custom'   => 'Custom Color',
				],
				'default'      => 'original',
				'prefix_class' => 'sa-el-social-share-buttons-color-',
				'separator'    => 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label'     => esc_html__( 'Normal', SA_EL_ADDONS_TEXTDOMAIN ),
				'condition' => [
					'color_source' => 'custom',
				],
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label'     => esc_html__( 'Primary Color', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.sa-el-social-share-buttons-style-flat .sa-el-social-share-button,
					 {{WRAPPER}}.sa-el-social-share-buttons-style-gradient .sa-el-social-share-button,
					 {{WRAPPER}}.sa-el-social-share-buttons-style-boxed .sa-el-social-share-button .sa-el-social-share-icon,
					 {{WRAPPER}}.sa-el-social-share-buttons-style-minimal .sa-el-social-share-button .sa-el-social-share-icon' => 'background-color: {{VALUE}}',
					'{{WRAPPER}}.sa-el-social-share-buttons-style-framed .sa-el-social-share-button,
					 {{WRAPPER}}.sa-el-social-share-buttons-style-minimal .sa-el-social-share-button,
					 {{WRAPPER}}.sa-el-social-share-buttons-style-boxed .sa-el-social-share-button' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'condition' => [
					'color_source' => 'custom',
				],
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label'     => esc_html__( 'Secondary Color', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.sa-el-social-share-buttons-style-flat .sa-el-social-share-icon, 
					 {{WRAPPER}}.sa-el-social-share-buttons-style-flat .sa-el-social-share-text, 
					 {{WRAPPER}}.sa-el-social-share-buttons-style-gradient .sa-el-social-share-icon,
					 {{WRAPPER}}.sa-el-social-share-buttons-style-gradient .sa-el-social-share-text,
					 {{WRAPPER}}.sa-el-social-share-buttons-style-boxed .sa-el-social-share-icon,
					 {{WRAPPER}}.sa-el-social-share-buttons-style-minimal .sa-el-social-share-icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'color_source' => 'custom',
				],
				'separator' => 'after',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label'     => esc_html__( 'Hover', SA_EL_ADDONS_TEXTDOMAIN ),
				'condition' => [
					'color_source' => 'custom',
				],
			]
		);

		$this->add_control(
			'primary_color_hover',
			[
				'label'     => esc_html__( 'Primary Color', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.sa-el-social-share-buttons-style-flat .sa-el-social-share-button:hover,
					 {{WRAPPER}}.sa-el-social-share-buttons-style-gradient .sa-el-social-share-button:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}}.sa-el-social-share-buttons-style-framed .sa-el-social-share-button:hover,
					 {{WRAPPER}}.sa-el-social-share-buttons-style-minimal .sa-el-social-share-button:hover,
					 {{WRAPPER}}.sa-el-social-share-buttons-style-boxed .sa-el-social-share-button:hover' => 'color: {{VALUE}}; border-color: {{VALUE}}',
					'{{WRAPPER}}.sa-el-social-share-buttons-style-boxed .sa-el-social-share-button:hover .sa-el-social-share-icon, 
					 {{WRAPPER}}.sa-el-social-share-buttons-style-minimal .sa-el-social-share-button:hover .sa-el-social-share-icon' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'color_source' => 'custom',
				],
			]
		);

		$this->add_control(
			'secondary_color_hover',
			[
				'label'     => esc_html__( 'Secondary Color', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.sa-el-social-share-buttons-style-flat .sa-el-social-share-button:hover .sa-el-social-share-icon, 
					 {{WRAPPER}}.sa-el-social-share-buttons-style-flat .sa-el-social-share-button:hover .sa-el-social-share-text, 
					 {{WRAPPER}}.sa-el-social-share-buttons-style-gradient .sa-el-social-share-button:hover .sa-el-social-share-icon,
					 {{WRAPPER}}.sa-el-social-share-buttons-style-gradient .sa-el-social-share-button:hover .sa-el-social-share-text,
					 {{WRAPPER}}.sa-el-social-share-buttons-style-boxed .sa-el-social-share-button:hover .sa-el-social-share-icon,
					 {{WRAPPER}}.sa-el-social-share-buttons-style-minimal .sa-el-social-share-button:hover .sa-el-social-share-icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'color_source' => 'custom',
				],
				'separator' => 'after',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'label'    => esc_html__( 'Typography', SA_EL_ADDONS_TEXTDOMAIN ),
				'selector' => '{{WRAPPER}} .sa-el-social-share-title, {{WRAPPER}} .sa-el-social-share-button-counter',
				'exclude'  => [ 'line_height' ],
			]
		);

		$this->add_control(
			'text_padding',
			[
				'label'      => esc_html__( 'Text Padding', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'condition' => [
					'view' => 'text',
				],
			]
		);

		$this->end_controls_section();
	}

	private function has_counter( $media_name ) {
		$settings = $this->get_active_settings();

		return 'icon' !== $settings['view'] && 'yes' === $settings['show_counter'] && ! empty( self::get_social_media( $media_name )['has_counter'] );
	}
	
	public function render() {

		$settings  = $this->get_active_settings();

		if ( empty( $settings['share_buttons'] ) ) {
			return;
		}

		$show_text = 'text' === $settings['view'] ||  $settings['show_label'];
		?>
		<div class="sa-el-social-share sa-el-ep-grid">
			<?php
			foreach ( $settings['share_buttons'] as $button ) {
				$social_name = $button['button'];
				$has_counter = $this->has_counter( $social_name );

				if ( 'custom' === $settings['share_url_type'] ) {
					$this->add_render_attribute( 'social-attrs', 'data-url', esc_url( $settings['share_url']['url'] ), true );
				}

				$this->add_render_attribute(
					[
						'social-attrs' => [
							'class' => [
								'sa-el-social-share-button',
								'sa-el-social-share-button-' . $social_name
							],
							'data-social' => $social_name,
						]
					], '', '', true
				);

				?>
				<div class="sa-el-social-share-item sa-el-ep-grid-item">
					<div <?php echo $this->get_render_attribute_string( 'social-attrs' ); ?>>
						<?php if ( 'icon' === $settings['view'] || 'icon-text' === $settings['view'] ) : ?>
							<span class="sa-el-social-share-icon">
								<i class="<?php echo self::get_social_media_class( $social_name ); ?>"></i>
							</span>
						<?php endif; ?>
						<?php if ( $show_text || $has_counter ) : ?>
							<div class="sa-el-social-share-text sa-el-inline">
								<?php if ( 'yes' === $settings['show_label'] || 'text' === $settings['view'] ) : ?>
									<span class="sa-el-social-share-title">
										<?php echo $button['text'] ? $button['text'] : self::get_social_media( $social_name )['title']; ?>
									</span>
								<?php endif; ?>
								<?php if ( $has_counter ) : ?>
									<span class="sa-el-social-share-counter" data-counter="<?php echo $social_name; ?>"></span>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php
			}
			?>
		</div>

		
		<?php

		
	}

	
}
