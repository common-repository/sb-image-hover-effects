<?php

namespace SA_EL_ADDONS\Elements\Table_Press;

if (!defined('ABSPATH')) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

class Table_Press extends Widget_Base
{

	use \SA_EL_ADDONS\Helper\Elementor_Helper;

	public function get_name()
	{
		return 'sa_el_table_press';
	}

	public function get_title()
	{
		return esc_html__('TablePress', SA_EL_ADDONS_TEXTDOMAIN);
	}

	public function get_icon()
	{
		return 'eicon-table  oxi-el-admin-icon';
	}

	public function get_categories()
	{
		return ['sa-el-addons'];
	}

	protected function sa_el_tablepress_table_list()
	{
		if (class_exists('TablePress')) {
			$table_ids          = \TablePress::$model_table->load_all(false);
			$table_options['0'] = esc_html__('Select Table', SA_EL_ADDONS_TEXTDOMAIN);

			foreach ($table_ids as $table_id) {
				// Load table, without table data, options, and visibility settings.
				$table = \TablePress::$model_table->load($table_id, false, false);

				if ('' === trim($table['name'])) {
					$table['name'] = __('(no name)', 'tablepress');
				}

				$table_options[$table['id']] = $table['name'];
			}
		} else {
			$table_options['0'] = esc_html__('No Table Found!', SA_EL_ADDONS_TEXTDOMAIN);
		}

		return $table_options;
	}

	protected function _register_controls()
	{

		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__('Layout', SA_EL_ADDONS_TEXTDOMAIN),
			]
		);
		if (!class_exists('TablePress')) {
			$this->add_control(
				'TablePress_missing_notice',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => sprintf(
						__('Hi, it seems %1$s is missing in your site. Please install and activate %1$s first.', SA_EL_ADDONS_TEXTDOMAIN),
						'<a href="https://wordpress.org/plugins/tablepress/" target="_blank" rel="noopener">TablePress</a>'
					),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				]
			);
			$this->end_controls_section();
			return;
		}
		$this->add_control(
			'table_id',
			[
				'label'   => esc_html__('Select Table', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->sa_el_tablepress_table_list(),
			]
		);


		$this->add_control(
			'header_align',
			[
				'label'   => __('Header Alignment', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress th' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'body_align',
			[
				'label'   => __('Body Alignment', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __('Left', SA_EL_ADDONS_TEXTDOMAIN),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', SA_EL_ADDONS_TEXTDOMAIN),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', SA_EL_ADDONS_TEXTDOMAIN),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress table.tablepress tr td' => 'text-align: {{VALUE}};',
				],
			]
		);

		if (class_exists('TablePress_Responsive_Tables')) {
			$this->add_control(
				'table_responsive',
				[
					'label'   => __('Responsive', SA_EL_ADDONS_TEXTDOMAIN),
					'type'    => Controls_Manager::SELECT,
					'default' => '0',
					'options' => [
						'0'        => __('None', SA_EL_ADDONS_TEXTDOMAIN),
						'flip'     => __('Flip', SA_EL_ADDONS_TEXTDOMAIN),
						'scroll'   => __('Scroll', SA_EL_ADDONS_TEXTDOMAIN),
						'collapse' => __('Collapse', SA_EL_ADDONS_TEXTDOMAIN),
					],
				]
			);
		}

		$this->add_control(
			'navigation_hide',
			[
				'label'     => esc_html__('Navigation Hide', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .dataTables_length' => 'display: none;',
				],
			]
		);

		$this->add_control(
			'search_hide',
			[
				'label'     => esc_html__('Search Hide', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .dataTables_filter' => 'display: none;',
				],
			]
		);

		$this->add_control(
			'footer_info_hide',
			[
				'label'     => esc_html__('Footer Info Hide', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .dataTables_info' => 'display: none;',
				],
			]
		);

		$this->add_control(
			'pagination_hide',
			[
				'label'     => esc_html__('Pagination Hide', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .dataTables_paginate' => 'display: none;',
				],
			]
		);

		$this->end_controls_section();

		$this->Sa_El_Support();

		$this->start_controls_section(
			'section_style_table',
			[
				'label' => __('Table', SA_EL_ADDONS_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'table_text_color',
			[
				'label'     => esc_html__('Global Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .dataTables_length, {{WRAPPER}} .sa-el-tablepress .dataTables_filter, {{WRAPPER}} .sa-el-tablepress .dataTables_info, {{WRAPPER}} .sa-el-tablepress .paginate_button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'table_border_style',
			[
				'label'   => __('Border Style', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'none'   => __('None', SA_EL_ADDONS_TEXTDOMAIN),
					'solid'  => __('Solid', SA_EL_ADDONS_TEXTDOMAIN),
					'double' => __('Double', SA_EL_ADDONS_TEXTDOMAIN),
					'dotted' => __('Dotted', SA_EL_ADDONS_TEXTDOMAIN),
					'dashed' => __('Dashed', SA_EL_ADDONS_TEXTDOMAIN),
					'groove' => __('Groove', SA_EL_ADDONS_TEXTDOMAIN),
				],
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress table.tablepress' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'table_border_width',
			[
				'label'   => __('Border Width', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'min'  => 0,
					'max'  => 20,
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress table.tablepress' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'table_border_color',
			[
				'label'     => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ccc',
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress table.tablepress' => 'border-color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'table_header_tools_gap',
			[
				'label' => __('Pagination/Search Gap', SA_EL_ADDONS_TEXTDOMAIN),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .dataTables_length, {{WRAPPER}} .sa-el-tablepress .dataTables_filter' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'table_footer_tools_gap',
			[
				'label' => __('Footer Text/Navigation Gap', SA_EL_ADDONS_TEXTDOMAIN),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .dataTables_info, {{WRAPPER}} .sa-el-tablepress .dataTables_paginate' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_header',
			[
				'label' => __('Header', SA_EL_ADDONS_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'header_background',
			[
				'label'     => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#dfe3e6',
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress th' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'header_active_background',
			[
				'label'     => __('Hover/Active Background', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ccd3d8',
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress .sorting:hover, {{WRAPPER}} .sa-el-tablepress .tablepress .sorting_asc, {{WRAPPER}} .sa-el-tablepress .tablepress .sorting_desc' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'header_color',
			[
				'label'     => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333',
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress th' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'header_border_style',
			[
				'label'   => __('Border Style', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'none'   => __('None', SA_EL_ADDONS_TEXTDOMAIN),
					'solid'  => __('Solid', SA_EL_ADDONS_TEXTDOMAIN),
					'double' => __('Double', SA_EL_ADDONS_TEXTDOMAIN),
					'dotted' => __('Dotted', SA_EL_ADDONS_TEXTDOMAIN),
					'dashed' => __('Dashed', SA_EL_ADDONS_TEXTDOMAIN),
					'groove' => __('Groove', SA_EL_ADDONS_TEXTDOMAIN),
				],
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress th' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'header_border_width',
			[
				'label'   => __('Border Width', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'min'  => 0,
					'max'  => 20,
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress th' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'header_border_color',
			[
				'label'     => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ccc',
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress th' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'header_padding',
			[
				'label'      => __('Padding', SA_EL_ADDONS_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'    => [
					'top'    => 1,
					'bottom' => 1,
					'left'   => 1,
					'right'  => 1,
					'unit'   => 'em'
				],
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_body',
			[
				'label' => __('Body', SA_EL_ADDONS_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'cell_border_style',
			[
				'label'   => __('Border Style', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'none'   => __('None', SA_EL_ADDONS_TEXTDOMAIN),
					'solid'  => __('Solid', SA_EL_ADDONS_TEXTDOMAIN),
					'double' => __('Double', SA_EL_ADDONS_TEXTDOMAIN),
					'dotted' => __('Dotted', SA_EL_ADDONS_TEXTDOMAIN),
					'dashed' => __('Dashed', SA_EL_ADDONS_TEXTDOMAIN),
					'groove' => __('Groove', SA_EL_ADDONS_TEXTDOMAIN),
				],
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress td' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cell_border_width',
			[
				'label'   => __('Border Width', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'min'  => 0,
					'max'  => 20,
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress td' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cell_padding',
			[
				'label'      => __('Cell Padding', SA_EL_ADDONS_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'    => [
					'top'    => 0.5,
					'bottom' => 0.5,
					'left'   => 1,
					'right'  => 1,
					'unit'   => 'em'
				],
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs('tabs_body_style');

		$this->start_controls_tab(
			'tab_normal',
			[
				'label' => __('Normal', SA_EL_ADDONS_TEXTDOMAIN),
			]
		);

		$this->add_control(
			'normal_background',
			[
				'label'     => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress .odd td' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'normal_color',
			[
				'label'     => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress .odd td' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'normal_border_color',
			[
				'label'     => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ccc',
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress .odd td' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_stripe',
			[
				'label' => __('Stripe', SA_EL_ADDONS_TEXTDOMAIN),
			]
		);

		$this->add_control(
			'stripe_background',
			[
				'label'     => __('Background', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f7f7f7',
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress .even td' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'stripe_color',
			[
				'label'     => __('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress .even td' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'stripe_border_color',
			[
				'label'     => __('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ccc',
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress .even td' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'body_hover_background',
			[
				'label'     => __('Hover Background', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .tablepress .row-hover tr:hover td' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_layout_style',
			[
				'label'      => esc_html__('Navigation/Search', SA_EL_ADDONS_TEXTDOMAIN),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'  => 'navigation_hide',
							'value' => '',
						],
						[
							'name'  => 'search_hide',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'search_icon_color',
			[
				'label'     => esc_html__('Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .dataTables_filter input, {{WRAPPER}} .sa-el-tablepress .dataTables_length select' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'search_background',
			[
				'label'     => esc_html__('Background', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sa-el-tablepress .dataTables_filter input, {{WRAPPER}} .sa-el-tablepress .dataTables_length select' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'search_padding',
			[
				'label'      => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .sa-el-tablepress .dataTables_filter input, {{WRAPPER}} .sa-el-tablepress .dataTables_length select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'search_border',
				'label'       => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .sa-el-tablepress .dataTables_filter input, {{WRAPPER}} .sa-el-tablepress .dataTables_length select',
			]
		);

		$this->add_responsive_control(
			'search_radius',
			[
				'label'      => esc_html__('Radius', SA_EL_ADDONS_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .sa-el-tablepress .dataTables_filter input, {{WRAPPER}} .sa-el-tablepress .dataTables_length select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'search_box_shadow',
				'selector' => '{{WRAPPER}} .sa-el-tablepress .dataTables_filter input, {{WRAPPER}} .sa-el-tablepress .dataTables_length select',
			]
		);

		$this->end_controls_section();
	}


	private function get_shortcode()
	{
		$settings = $this->get_settings();

		if (!$settings['table_id']) {
			return '<div class="sa-el-alert sa-el-alert-warning">' . __('Please select a table from setting!', SA_EL_ADDONS_TEXTDOMAIN) . '</div>';
		}

		if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
			// Load the frontend controller
			\TablePress::load_controller('frontend');
			// class methods aren't static so we need an instance to call them
			$controller = new \TablePress_Frontend_Controller();
			// Register the shortcode
			$controller->init_shortcodes();
		}

		$attributes = [
			'id'         => $settings['table_id'],
			'responsive' => (class_exists('TablePress_Responsive_Tables')) ? $settings['table_responsive'] : '',
		];

		$this->add_render_attribute('shortcode', $attributes);

		$shortcode   = ['<div class="sa-el-tablepress">'];
		$shortcode[] = sprintf('[table %s]', $this->get_render_attribute_string('shortcode'));
		$shortcode[] = '</div>';

		$output = implode("", $shortcode);

		return $output;
	}

	public function render()
	{
		if (class_exists('TablePress')):
		$settings = $this->get_settings();
		echo do_shortcode($this->get_shortcode());

		if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
			?>
			<script type="text/javascript" src="<?php echo plugins_url(); ?>/tablepress/js/jquery.datatables.min.js"></script>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$('#tablepress-<?php echo esc_attr($settings['table_id']); ?>').dataTable({
						"order": [],
						"orderClasses": false,
						"stripeClasses": ["even", "odd"],
						"pagingType": "simple"
					});
				});
			</script>
	<?php
		};
	else:
		echo '<dev class="sa-el-alert sa-el-alert-warning">
            '.sprintf(
                __('Hi, it seems %1$s is missing in your site. Please install and activate %1$s first.', SA_EL_ADDONS_TEXTDOMAIN),
                '<a href="https://wordpress.org/plugins/tablepress/" target="_blank" rel="noopener">TablePress</a>'
            ).'</dev>';
	endif;
	}

	public function render_plain_content()
	{
		echo $this->get_shortcode();
	}
}
