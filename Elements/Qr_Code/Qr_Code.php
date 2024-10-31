<?php

namespace SA_EL_ADDONS\Elements\Qr_Code;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Description of Image Accordion
 *
 * @author biplo
 * 
 */
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Qr_Code extends Widget_Base {

	use \SA_EL_ADDONS\Helper\Elementor_Helper;
	
    public function get_name() {
        return 'sa_el_qr_code';
    }

    public function get_title() {
        return esc_html__('QrCode', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-handle oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
			'section_content_qrcode',
			[
				'label' => esc_html__( 'QR Code', SA_EL_ADDONS_TEXTDOMAIN ),
			]
		);

		$this->add_control(
			'text',
			[
				'label'       => esc_html__( 'Content', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => 'http://oxilab.org',
				'default'     => 'http://oxilab.org',
				'condition'   => ['site_link!' => 'yes'],
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'site_link',
			[
				'label' => esc_html__( 'This Page Link', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'label_type',
			[
				'label'   => esc_html__( 'Label Type', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => [
					'none'  => esc_html__( 'None', SA_EL_ADDONS_TEXTDOMAIN ),
					'text'  => esc_html__( 'Text', SA_EL_ADDONS_TEXTDOMAIN ),
					'image' => esc_html__( 'Image', SA_EL_ADDONS_TEXTDOMAIN ),
				]
			]
		);

		$this->add_control(
			'label',
			[
				'label'       => esc_html__( 'Text', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => 'Oxilab',
				'default'     => 'Oxilab',
				'condition'   => [
					'label_type' => 'text',
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label'     => __( 'Choose Image', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => [
					'label_type' => 'image',
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'mode',
			[
				'label'   => esc_html__( 'Mode', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => 2,
				'options' => [
					1 => esc_html__( 'Strip', SA_EL_ADDONS_TEXTDOMAIN ),
					2 => esc_html__( 'Box', SA_EL_ADDONS_TEXTDOMAIN ),
				],
				'condition'   => [
					'label_type!' => 'none',
				],
			]
		);

		$this->add_responsive_control(
			'align',
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
				],
				'default'      => 'center',
				'prefix_class' => 'elementor-align%s-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_qr_code_additional',
			[
				'label' => esc_html__( 'Additional', SA_EL_ADDONS_TEXTDOMAIN ),
			]
		);

		$this->add_control(
			'size',
			[
				'label'   => esc_html__( 'Size', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 300,
				],
				'range' => [
					'px' => [
						'min'  => 100,
						'max'  => 1000,
						'step' => 50,
					],
				],
			]
		);

		$this->add_control(
			'mSize',
			[
				'label'   => esc_html__( 'Label Size', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 11,
				],
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 40,
						'step' => 1,
					],
				],
				'condition' => [
					'label_type!' => 'none',
				],
			]
		);

		$this->add_control(
			'mPosX',
			[
				'label'   => esc_html__( 'Label POS X:', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
				],
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'condition' => [
					'label_type!' => 'none',
				],
			]
		);

		$this->add_control(
			'mPosY',
			[
				'label'   => esc_html__( 'Label POS Y:', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
				],
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'condition' => [
					'label_type!' => 'none',
				],
			]
		);

		$this->add_control(
			'minVersion',
			[
				'label'   => esc_html__( 'Min Version', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 6,
				],
				'range' => [
					'px' => [
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					],
				],
			]
		);

		$this->add_control(
			'ecLevel',
			[
				'label'   => esc_html__( 'Error Correction Level', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'H',
				'options' => [
					'L' => esc_html__( 'Low (7%)', SA_EL_ADDONS_TEXTDOMAIN ),
					'M' => esc_html__( 'Medium (15%)', SA_EL_ADDONS_TEXTDOMAIN ),
					'Q' => esc_html__( 'Quartile (25%)', SA_EL_ADDONS_TEXTDOMAIN ),
					'H' => esc_html__( 'High (30%)', SA_EL_ADDONS_TEXTDOMAIN ),
				],
			]
		);

		$this->end_controls_section();	
		
		$this->Sa_El_Support();

		$this->start_controls_section(
			'section_style_qrcode',
			[
				'label' => esc_html__( 'QR Code', SA_EL_ADDONS_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'fill',
			[
				'label'   => esc_html__( 'Code Color', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#333333',
			]
		);

		$this->add_control(
			'fontcolor',
			[
				'label'     => esc_html__( 'Label Color', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff9818',
				'condition' => [
					'label_type' => 'text',
				],
			]
		);

		$this->add_control(
			'radius',
			[
				'label'   => esc_html__( 'Code Radius', SA_EL_ADDONS_TEXTDOMAIN ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 10,
					],
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings   = $this->get_settings();
		$id         = 'sa-el-qrcode' . $this->get_id();
		$image_src  = wp_get_attachment_image_src( $settings['image']['id'], 'full' );
		$image      = ($image_src) ? $image_src[0] : Utils::get_placeholder_image_src();
		$qr_content = $settings['text'];
		
		if ($settings['site_link']) {
			$qr_content =  get_permalink();
		}

		 if( 'none' == $settings['label_type'] ){
			$mode = 0;
		 } elseif( 'text' == $settings['label_type'] ){
		 	$mode = $settings['mode'];
		 } elseif( '' != $settings['image'] ){
		 	 $mode = $settings['mode'] + 2;
		 } else {
		 	$mode = 0;
		 }

		 $this->add_render_attribute(
		 	[
		 		'qrcode' => [
		 			'data-settings' => [
		 				wp_json_encode(array_filter([
		 					"render"     => "canvas",
		 					"ecLevel"    => $settings["ecLevel"],
		 					"minVersion" => $settings["minVersion"]["size"],
		 					"fill"       => $settings["fill"],
		 					"text"       => $qr_content,
		 					"size"       => $settings["size"]["size"],
		 					"radius"     => $settings["radius"]["size"] * 0.01,
		 					"mode"       => $mode,
		 					"mSize"      => $settings["mSize"]["size"] * 0.01,
		 					"mPosX"      => $settings["mPosX"]["size"] * 0.01,
		 					"mPosY"      => $settings["mPosY"]["size"] * 0.01,
		 					"label"      => $settings["label"],
		 					"fontcolor"  => $settings["fontcolor"],
		 		        ]))
		 			]
		 		]
		 	]
		 );

		?>
		<div class="sa-el-qrcode" <?php echo $this->get_render_attribute_string( 'qrcode' ); ?>></div>

		<?php if ('image' === $settings['label_type'] and !empty($image)) : ?>
			<img src="<?php echo esc_url($image); ?>" class="sa-el-hidden sa-el-qrcode-image" alt="<?php echo esc_html($settings["label"]); ?>">
		<?php endif;
    }

    protected function backup_content_template() {
    	?>
    	<#
			

			var image = {
				id: settings.image.id,
				url: settings.image.url,
				size: settings.image_size,
				dimension: settings.image_custom_dimension,
				model: view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl( image );

			var $mode = 0;
			 if( 'none' == settings.label_type ) {
				$mode      = 0;
			 } else if( 'text' == settings.label_type ){
			 	$mode      = settings.mode;
			 } else if( '' != settings.image ) {
			 	 $mode      = settings.mode + 2;
			 } else {
			 	$mode = 0;
			 }

			view.addRenderAttribute( 'qrcode', 'data-eclevel', settings.ecLevel );

			view.addRenderAttribute( 'qrcode', 'data-minversion', settings.minVersion.size );
			view.addRenderAttribute( 'qrcode', 'data-fill', settings.fill );
			view.addRenderAttribute( 'qrcode', 'data-text', settings.text );
			view.addRenderAttribute( 'qrcode', 'data-size', settings.size.size );
			view.addRenderAttribute( 'qrcode', 'data-radius', settings.radius.size * 0.01 );					
			view.addRenderAttribute( 'qrcode', 'data-mode', $mode );
			view.addRenderAttribute( 'qrcode', 'data-msize', settings.mSize.size * 0.01 );
			view.addRenderAttribute( 'qrcode', 'data-mposx', settings.mPosX.size * 0.01 );
			view.addRenderAttribute( 'qrcode', 'data-mposy', settings.mPosY.size * 0.01 );					
			view.addRenderAttribute( 'qrcode', 'data-label', settings.label );
			view.addRenderAttribute( 'qrcode', 'data-fontcolor', settings.fontcolor );
		#>

		<div class="sa-el-qrcode" <# print( view.getRenderAttributeString( 'qrcode' ) ); #>></div>

		<# if ('image' === settings.label_type && image_url) { #>
			<img src="{{image_url}}" class="sa-el-hidden sa-el-qrcode-image" alt="">
		<# } #>


    	<?php 
    }
}