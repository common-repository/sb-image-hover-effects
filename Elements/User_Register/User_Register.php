<?php

namespace SA_EL_ADDONS\Elements\User_Register;

if (!defined('ABSPATH')) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;


class User_Register extends Widget_Base
{

	use \SA_EL_ADDONS\Helper\Elementor_Helper;

	public function get_name()
	{
		return 'sa-el-user-register';
	}

	public function get_title()
	{
		return esc_html__('User Register', SA_EL_ADDONS_TEXTDOMAIN);
	}

	public function get_icon()
	{
		return 'eicon-lock-user oxi-el-admin-icon';
	}

	public function get_categories()
	{
		return ['sa-el-addons'];
	}
	protected function _register_controls()
	{
		$this->start_controls_section(
			'section_forms_layout',
			[
				'label' => esc_html__('Forms Layout', SA_EL_ADDONS_TEXTDOMAIN),
			]
		);

		$this->add_control(
			'labels_title',
			[
				'label'     => esc_html__('Labels', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label'   => esc_html__('Label', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'fields_title',
			[
				'label' => esc_html__('Fields', SA_EL_ADDONS_TEXTDOMAIN),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'input_size',
			[
				'label'   => esc_html__('Input Size', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'small'   => esc_html__('Small', SA_EL_ADDONS_TEXTDOMAIN),
					'default' => esc_html__('Default', SA_EL_ADDONS_TEXTDOMAIN),
					'large'   => esc_html__('Large', SA_EL_ADDONS_TEXTDOMAIN),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'button_title',
			[
				'label'     => esc_html__('Submit Button', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'   => esc_html__('Text', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__('Register', SA_EL_ADDONS_TEXTDOMAIN),
			]
		);

		$this->add_control(
			'button_size',
			[
				'label'   => esc_html__('Size', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'small' => esc_html__('Small', SA_EL_ADDONS_TEXTDOMAIN),
					''      => esc_html__('Default', SA_EL_ADDONS_TEXTDOMAIN),
					'large' => esc_html__('Large', SA_EL_ADDONS_TEXTDOMAIN),
				],
				'default' => '',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'   => esc_html__('Alignment', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', SA_EL_ADDONS_TEXTDOMAIN),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', SA_EL_ADDONS_TEXTDOMAIN),
						'icon'  => 'fa fa-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', SA_EL_ADDONS_TEXTDOMAIN),
						'icon'  => 'fa fa-align-right',
					],
					'stretch' => [
						'title' => esc_html__('Justified', SA_EL_ADDONS_TEXTDOMAIN),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-button-align-',
				'default'      => '',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_forms_additional_options',
			[
				'label' => esc_html__('Additional Options', SA_EL_ADDONS_TEXTDOMAIN),
			]
		);

		$this->add_control(
			'redirect_after_register',
			[
				'label' => esc_html__('Redirect After Register', SA_EL_ADDONS_TEXTDOMAIN),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'redirect_url',
			[
				'type'          => Controls_Manager::URL,
				'show_label'    => false,
				'show_external' => false,
				'separator'     => false,
				'placeholder'   => 'http://your-link.com/',
				'description'   => esc_html__('Note: Because of security reasons, you can ONLY use your current domain here.', SA_EL_ADDONS_TEXTDOMAIN),
				'condition'     => [
					'redirect_after_register' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_lost_password',
			[
				'label'   => esc_html__('Lost your password?', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);


		$this->add_control(
			'show_login',
			[
				'label' => esc_html__('Login', SA_EL_ADDONS_TEXTDOMAIN),
				'type'  => Controls_Manager::SWITCHER,
			]
		);


		$this->add_control(
			'show_logged_in_message',
			[
				'label'   => esc_html__('Logged in Message', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'custom_labels',
			[
				'label'     => esc_html__('Custom Label', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'show_labels' => 'yes',
				],
			]
		);


		$this->add_control(
			'first_name_label',
			[
				'label'     => esc_html__('First Name Label', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('First Name', SA_EL_ADDONS_TEXTDOMAIN),
				'condition' => [
					'show_labels'   => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);


		$this->add_control(
			'first_name_placeholder',
			[
				'label'     => esc_html__('First Name Placeholder', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('John', SA_EL_ADDONS_TEXTDOMAIN),
				'condition' => [
					'show_labels'   => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'last_name_label',
			[
				'label'     => esc_html__('Last Name Label', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Last Name', SA_EL_ADDONS_TEXTDOMAIN),
				'condition' => [
					'show_labels'   => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'last_name_placeholder',
			[
				'label'     => esc_html__('Last Name Placeholder', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Doe', SA_EL_ADDONS_TEXTDOMAIN),
				'condition' => [
					'show_labels'   => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'email_label',
			[
				'label'     => esc_html__('Email Label', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Email', SA_EL_ADDONS_TEXTDOMAIN),
				'condition' => [
					'show_labels' => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'email_placeholder',
			[
				'label'     => esc_html__('Email Placeholder', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('example@email.com', SA_EL_ADDONS_TEXTDOMAIN),
				'condition' => [
					'show_labels'   => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);


		$this->add_control(
			'show_additional_message',
			[
				'label' => esc_html__('Additional Bottom Message', SA_EL_ADDONS_TEXTDOMAIN),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'additional_message',
			[
				'label'     => esc_html__('Additional Message', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Note: Your password will be generated automatically and sent to your email address.', SA_EL_ADDONS_TEXTDOMAIN),
				'condition' => [
					'show_additional_message' => 'yes',
				],
			]
		);

		$this->end_controls_section();
		$this->Sa_El_Support();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__('Form Style', SA_EL_ADDONS_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'row_gap',
			[
				'label'   => esc_html__('Rows Gap', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => '15',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'selectors' => [
					'#sa-el-user-register{{ID}} .sa-el-field-group:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'links_color',
			[
				'label'     => esc_html__('Links Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-register{{ID}} .sa-el-field-group > a'                                 => 'color: {{VALUE}};',
					'#sa-el-user-register{{ID}} .sa-el-user-register-password a:not(:last-child):after' => 'background-color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
			]
		);

		$this->add_control(
			'links_hover_color',
			[
				'label'     => esc_html__('Links Hover Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-register{{ID}} .sa-el-field-group > a:hover' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_labels',
			[
				'label'     => esc_html__('Label', SA_EL_ADDONS_TEXTDOMAIN),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_labels!' => '',
				],
			]
		);

		$this->add_control(
			'label_spacing',
			[
				'label' => esc_html__('Spacing', SA_EL_ADDONS_TEXTDOMAIN),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'#sa-el-user-register{{ID}} .sa-el-field-group > label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'label_color',
			[
				'label'     => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-register{{ID}} .sa-el-form-label' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'selector' => '#sa-el-user-register{{ID}} .sa-el-form-label',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_field_style',
			[
				'label' => esc_html__('Fields', SA_EL_ADDONS_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_field_style');

		$this->start_controls_tab(
			'tab_field_normal',
			[
				'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN),
			]
		);

		$this->add_control(
			'field_text_color',
			[
				'label'     => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-register{{ID}} .sa-el-field-group .sa-el-input' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_placeholder_color',
			[
				'label'     => esc_html__('Placeholder Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-register{{ID}} .sa-el-field-group .sa-el-input::placeholder'      => 'color: {{VALUE}};',
					'#sa-el-user-register{{ID}} .sa-el-field-group .sa-el-input::-moz-placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_background_color',
			[
				'label'     => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-register{{ID}} .sa-el-field-group .sa-el-input,
							#sa-el-user-register{{ID}} .sa-el-field-group .sa-el-checkbox' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'field_border',
				'label'       => esc_html__('Border', SA_EL_ADDONS_TEXTDOMAIN),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '#sa-el-user-register{{ID}} .sa-el-field-group .sa-el-input',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'field_border_radius',
			[
				'label'      => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'#sa-el-user-register{{ID}} .sa-el-field-group .sa-el-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'field_box_shadow',
				'selector' => '#sa-el-user-register{{ID}} .sa-el-field-group .sa-el-input',
			]
		);

		$this->add_control(
			'field_padding',
			[
				'label'      => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'#sa-el-user-register{{ID}} .sa-el-field-group .sa-el-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; height: auto;',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'field_typography',
				'label'     => esc_html__('Typography', SA_EL_ADDONS_TEXTDOMAIN),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
				'selector'  => '#sa-el-user-register{{ID}} .sa-el-field-group .sa-el-input',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_field_hover',
			[
				'label' => esc_html__('Focus', SA_EL_ADDONS_TEXTDOMAIN),
			]
		);

		$this->add_control(
			'field_hover_border_color',
			[
				'label'     => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'field_border_border!' => '',
				],
				'selectors' => [
					'#sa-el-user-register{{ID}} .sa-el-field-group .sa-el-input:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_submit_button_style',
			[
				'label' => esc_html__('Submit Button', SA_EL_ADDONS_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-register{{ID}} .sa-el-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '#sa-el-user-register{{ID}} .sa-el-button',
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label'  => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'#sa-el-user-register{{ID}} .sa-el-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'button_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '#sa-el-user-register{{ID}} .sa-el-button',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'      => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'#sa-el-user-register{{ID}} .sa-el-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_text_padding',
			[
				'label'      => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'#sa-el-user-register{{ID}} .sa-el-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-register{{ID}} .sa-el-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label'     => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-register{{ID}} .sa-el-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-register{{ID}} .sa-el-button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_border_border!' => '',
				],
			]
		);

		$this->add_control(
			'button_hover_animation',
			[
				'label' => esc_html__('Animation', SA_EL_ADDONS_TEXTDOMAIN),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_style',
			[
				'label'     => esc_html__('Additional', SA_EL_ADDONS_TEXTDOMAIN),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_additional_message!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'additional_text_typography',
				'label'     => esc_html__('Additional Message Typography', SA_EL_ADDONS_TEXTDOMAIN),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
				'selector'  => '#sa-el-user-register{{ID}} .sa-el-register-additional-message',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}


	public function form_fields_render_attributes()
	{
		$settings = $this->get_settings();
		$id       = $this->get_id();

		if (!empty($settings['button_size'])) {
			$this->add_render_attribute('button', 'class', 'sa-el-button-' . $settings['button_size']);
		}

		if ($settings['button_hover_animation']) {
			$this->add_render_attribute('button', 'class', 'elementor-animation-' . $settings['button_hover_animation']);
		}

		$this->add_render_attribute(
			[
				'wrapper' => [
					'class' => [
						'elementor-form-fields-wrapper',
					],
				],
				'field-group' => [
					'class' => [
						'sa-el-field-group',
						'sa-el-width-1-1',
					],
				],
				'submit-group' => [
					'class' => [
						'elementor-field-type-submit',
						'sa-el-field-group',
						'sa-el-flex',
					],
				],

				'button' => [
					'class' => [
						'elementor-button',
						'sa-el-button',
						'sa-el-button-primary',
					],
					'name' => 'submit',
				],
				'first_name_label' => [
					'for'   => 'first_name' . esc_attr($id),
					'class' => [
						'sa-el-form-label',
					]
				],
				'last_name_label' => [
					'for'   => 'last_name' . esc_attr($id),
					'class' => [
						'sa-el-form-label',
					]
				],
				'email_label' => [
					'for'   => 'user_email' . esc_attr($id),
					'class' => [
						'sa-el-form-label',
					]
				],
				'first_name_input' => [
					'type'        => 'text',
					'name'        => 'first_name',
					'id'          => 'first_name' . esc_attr($id),
					'placeholder' => $settings['first_name_placeholder'],
					'class'       => [
						'sa-el-input',
						'sa-el-form-' . $settings['input_size'],
					],
				],
				'last_name_input' => [
					'type'        => 'text',
					'name'        => 'last_name',
					'id'          => 'last_name' . esc_attr($id),
					'placeholder' => $settings['last_name_placeholder'],
					'class'       => [
						'sa-el-input',
						'sa-el-form-' . $settings['input_size'],
					],
				],
				'email_address_input' => [
					'type'        => 'email',
					'name'        => 'user_email',
					'id'          => 'user_email' . esc_attr($id),
					'placeholder' => $settings['email_placeholder'],
					'class'       => [
						'sa-el-input',
						'sa-el-form-' . $settings['input_size'],
					],
				],
			]
		);

		if (!$settings['show_labels']) {
			$this->add_render_attribute('label', 'class', 'elementor-screen-only');
		}

		$this->add_render_attribute('field-group', 'class', 'elementor-field-required')
			->add_render_attribute('input', 'required', true)
			->add_render_attribute('input', 'aria-required', 'true');
	}

	public function render()
	{
		$settings    = $this->get_settings();
		$current_url = remove_query_arg('fake_arg');

		if (is_user_logged_in() && !\Elementor\Plugin::instance()->editor->is_edit_mode()) {
			if ($settings['show_logged_in_message']) {
				$current_user = wp_get_current_user();

				echo '<div class="sa-el-user-register">' .
					sprintf(__('You are Logged in as %1$s (<a href="%2$s">Logout</a>)', SA_EL_ADDONS_TEXTDOMAIN), $current_user->display_name, wp_logout_url($current_url)) .
					'</div>';
			}

			return;
		} elseif (!get_option('users_can_register')) {
			?>
			<div class="sa-el-alert sa-el-alert-warning" sa-el-alert>
				<a class="sa-el-alert-close" sa-el-close></a>
				<p><?php esc_html_e('Registration option not enbled in your general settings.', SA_EL_ADDONS_TEXTDOMAIN); ?></p>
			</div>
		<?php
					return;
				}

				$this->form_fields_render_attributes();

				?>
		<div class="sa-el-user-register sa-el-user-register-skin-default">
			<div class="elementor-form-fields-wrapper">
				<?php $this->user_register_form(); ?>
			</div>
		</div>

	<?php

			$this->user_register_ajax_script();
		}

		public function user_register_form()
		{
			$settings    = $this->get_settings();

			$id          = $this->get_id();
			$current_url = remove_query_arg('fake_arg');

			if ($settings['redirect_after_register'] && !empty($settings['redirect_url']['url'])) {
				$redirect_url = $settings['redirect_url']['url'];
			} else {
				$redirect_url = $current_url;
			}

			?>
		<form id="sa-el-user-register<?php echo esc_attr($id); ?>" class="sa-el-form-stacked sa-el-width-1-1" method="post" action="<?php echo wp_registration_url(); ?>" data-class="SA_EL_ADDONS\Elements\User_Register\Files\UserRegister" data-function="sa_el_ajax_register">
			<div <?php echo $this->get_render_attribute_string('field-group'); ?>>
				<?php
						if ($settings['show_labels']) {
							echo '<label ' . $this->get_render_attribute_string('first_name_label') . '>' . $settings['first_name_label'] . '</label>';
						}
						echo '<div class="sa-el-form-controls">';
						echo '<input ' . $this->get_render_attribute_string('first_name_input') . ' required>';
						echo '</div>';

						?>
			</div>

			<div <?php echo $this->get_render_attribute_string('field-group'); ?>>
				<?php
						if ($settings['show_labels']) {
							echo '<label ' . $this->get_render_attribute_string('last_name_label') . '>' . $settings['last_name_label'] . '</label>';
						}
						echo '<div class="sa-el-form-controls">';
						echo '<input ' . $this->get_render_attribute_string('last_name_input') . ' required>';
						echo '</div>';

						?>
			</div>

			<div <?php echo $this->get_render_attribute_string('field-group'); ?>>
				<?php
						if ($settings['show_labels']) :
							echo '<label ' . $this->get_render_attribute_string('email_label') . '>' . $settings['email_label'] . '</label>';
						endif;
						echo '<div class="sa-el-form-controls">';
						echo '<input ' . $this->get_render_attribute_string('email_address_input') . ' required>';
						echo '</div>';
						?>
			</div>

			<?php if ($settings['show_additional_message']) : ?>
				<div <?php echo $this->get_render_attribute_string('field-group'); ?>>
					<span class="sa-el-register-additional-message"><?php echo $settings['additional_message']; ?></span>
				</div>
			<?php endif; ?>

			<div <?php echo $this->get_render_attribute_string('submit-group'); ?>>
				<button type="submit" <?php echo $this->get_render_attribute_string('button'); ?>>
					<?php if (!empty($settings['button_text'])) : ?>
						<span><?php echo $settings['button_text']; ?></span>
					<?php endif; ?>
				</button>
			</div>

			<?php
					$show_lost_password = $settings['show_lost_password'];
					$show_login         = $settings['show_login'];

					if ($show_lost_password || $show_login) : ?>
				<div class="sa-el-field-group sa-el-width-1-1 sa-el-margin-remove-bottom sa-el-user-register-password">

					<?php if ($show_lost_password) : ?>
						<a class="sa-el-lost-password" href="<?php echo wp_lostpassword_url($redirect_url); ?>">
							<?php esc_html_e('Lost your password?', SA_EL_ADDONS_TEXTDOMAIN); ?>
						</a>
					<?php endif; ?>

					<?php if ($show_login) : ?>
						<a class="sa-el-login" href="<?php echo wp_login_url(); ?>">
							<?php esc_html_e('Login', SA_EL_ADDONS_TEXTDOMAIN); ?>
						</a>
					<?php endif; ?>

				</div>
			<?php endif; ?>

			<?php wp_nonce_field('ajax-login-nonce', 'sa-el-user-register-sc'); ?>
			<div class="sa-el-user-message-show"></div>
		</form>
	<?php
		}

		public function user_register_ajax_script()
		{
			$settings = $this->get_settings();
			$id       = $this->get_id();

			?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				"use strict";
				var register_form = 'form#sa-el-user-register<?php echo esc_attr($id); ?>';

				$(register_form).on('submit', function(e) {
					e.preventDefault();
					var $This = $(this);
					var args = $This.serialize();
					var classs = $This.data("class");
					var functions = $This.data("function");
					$.ajax({
						url: sa_el_addons_loader.ajaxurl,
						type: 'POST',
						dataType: 'json',
						data: {
							action: "sa_el_addons_loader",
							_wpnonce: sa_el_addons_loader.nonce,
							class: classs,
							function: functions,
							args: args
						},
						success: function(data) {
							if (data.registered == true) {
								$($This).children('.sa-el-user-message-show').removeClass('sa-el-user-error').addClass('sa-el-user-success').html(data.message);
								<?php if ( $settings['redirect_after_register'] && ! empty( $settings['redirect_url']['url'] ) ) : ?>
									<?php $redirect_url = $settings['redirect_url']['url']; ?>
			                    	document.location.href = '<?php echo esc_url( $redirect_url ); ?>';
			                	<?php endif; ?>
							} else {
								$($This).children('.sa-el-user-message-show').removeClass('sa-el-user-success').addClass('sa-el-user-error').html(data.message);
							}

						},
					});
				});

			});
		</script>
<?php
	}
}
