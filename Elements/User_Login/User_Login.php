<?php

namespace SA_EL_ADDONS\Elements\User_Login;

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


class User_Login extends Widget_Base
{

	use \SA_EL_ADDONS\Helper\Elementor_Helper;

	public function get_name()
	{
		return 'sa-el-user-login';
	}

	public function get_title()
	{
		return esc_html__('User Login', SA_EL_ADDONS_TEXTDOMAIN);
	}

	public function get_icon()
	{
		return 'eicon-user-circle-o  oxi-el-admin-icon';
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
				'default' => esc_html__('Log In', SA_EL_ADDONS_TEXTDOMAIN),
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
			'redirect_after_login',
			[
				'label' => esc_html__('Redirect After Login', SA_EL_ADDONS_TEXTDOMAIN),
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
					'redirect_after_login' => 'yes',
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

		if (get_option('users_can_register')) {
			$this->add_control(
				'show_register',
				[
					'label'   => esc_html__('Register', SA_EL_ADDONS_TEXTDOMAIN),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);
		}

		$this->add_control(
			'show_remember_me',
			[
				'label'   => esc_html__('Remember Me', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
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
			'show_avatar_in_button',
			[
				'label'   => esc_html__('Avatar in Button', SA_EL_ADDONS_TEXTDOMAIN),
				'description'   => esc_html__('When user logged in this avatar shown in dropdown/modal button.', SA_EL_ADDONS_TEXTDOMAIN),
				'type'    => Controls_Manager::SWITCHER,
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
			'user_label',
			[
				'label'     => esc_html__('Username Label', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Username or Email', SA_EL_ADDONS_TEXTDOMAIN),
				'condition' => [
					'show_labels'   => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'user_placeholder',
			[
				'label'     => esc_html__('Username Placeholder', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Username or Email', SA_EL_ADDONS_TEXTDOMAIN),
				'condition' => [
					'show_labels'   => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'password_label',
			[
				'label'     => esc_html__('Password Label', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Password', SA_EL_ADDONS_TEXTDOMAIN),
				'condition' => [
					'show_labels'   => 'yes',
					'custom_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'password_placeholder',
			[
				'label'     => esc_html__('Password Placeholder', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Password', SA_EL_ADDONS_TEXTDOMAIN),
				'condition' => [
					'show_labels'   => 'yes',
					'custom_labels' => 'yes',
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
					'#sa-el-user-login{{ID}} .sa-el-field-group:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'links_color',
			[
				'label'     => esc_html__('Links Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-login{{ID}} .sa-el-field-group > a' => 'color: {{VALUE}};',
					'#sa-el-user-login{{ID}} .sa-el-user-login-password a:not(:last-child):after' => 'background-color: {{VALUE}};',
				],
				'scheme' => [
					'type'  => Scheme_Color::get_type(),
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
					'#sa-el-user-login{{ID}} .sa-el-field-group > a:hover' => 'color: {{VALUE}};',
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
					'#sa-el-user-login{{ID}} .sa-el-field-group > label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'label_color',
			[
				'label'     => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-login{{ID}} .sa-el-form-label' => 'color: {{VALUE}};',
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
				'selector' => '#sa-el-user-login{{ID}} .sa-el-form-label',
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
					'#sa-el-user-login{{ID}} .sa-el-field-group .sa-el-input' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_placeholder_color',
			[
				'label'     => esc_html__('Placeholder Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-login{{ID}} .sa-el-field-group .sa-el-input::placeholder'      => 'color: {{VALUE}};',
					'#sa-el-user-login{{ID}} .sa-el-field-group .sa-el-input::-moz-placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_background_color',
			[
				'label'     => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-login{{ID}} .sa-el-field-group .sa-el-input,
					#sa-el-user-login{{ID}} .sa-el-field-group .sa-el-checkbox' => 'background-color: {{VALUE}};',
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
				'selector'    => '#sa-el-user-login{{ID}} .sa-el-field-group .sa-el-input',
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
					'#sa-el-user-login{{ID}} .sa-el-field-group .sa-el-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'field_box_shadow',
				'selector' => '#sa-el-user-login{{ID}} .sa-el-field-group .sa-el-input',
			]
		);

		$this->add_control(
			'field_padding',
			[
				'label'      => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'#sa-el-user-login{{ID}} .sa-el-field-group .sa-el-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; height: auto;',
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
				'selector'  => '#sa-el-user-login{{ID}} .sa-el-field-group .sa-el-input',
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
					'#sa-el-user-login{{ID}} .sa-el-field-group .sa-el-input:focus' => 'border-color: {{VALUE}};',
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
					'#sa-el-user-login{{ID}} .sa-el-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '#sa-el-user-login{{ID}} .sa-el-button',
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
					'#sa-el-user-login{{ID}} .sa-el-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'button_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '#sa-el-user-login{{ID}} .sa-el-button',
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
					'#sa-el-user-login{{ID}} .sa-el-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#sa-el-user-login{{ID}} .sa-el-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#sa-el-user-login{{ID}} .sa-el-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label'     => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-login{{ID}} .sa-el-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#sa-el-user-login{{ID}} .sa-el-button:hover' => 'border-color: {{VALUE}};',
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
			'section_logged_style',
			[
				'label' => esc_html__('Logout Style', SA_EL_ADDONS_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_Logged_style');

		$this->start_controls_tab(
			'tab_Logged_normal',
			[
				'label' => esc_html__('Normal', SA_EL_ADDONS_TEXTDOMAIN),
			]
		);

		$this->add_control(
			'Logged_text_color',
			[
				'label'     => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sa-el-user-logged-out a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'Logged_typography',
				'selector' => '{{WRAPPER}} .sa-el-user-logged-out a',
			]
		);

		$this->add_control(
			'Logged_background_color',
			[
				'label'  => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .sa-el-user-logged-out a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'Logged_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .sa-el-user-logged-out a',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'Logged_border_radius',
			[
				'label'      => esc_html__('Border Radius', SA_EL_ADDONS_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .sa-el-user-logged-out a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'Logged_text_padding',
			[
				'label'      => esc_html__('Padding', SA_EL_ADDONS_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .sa-el-user-logged-out a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_Logged_hover',
			[
				'label' => esc_html__('Hover', SA_EL_ADDONS_TEXTDOMAIN),
			]
		);

		$this->add_control(
			'Logged_hover_color',
			[
				'label'     => esc_html__('Text Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sa-el-user-logged-out a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'Logged_background_hover_color',
			[
				'label'     => esc_html__('Background Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sa-el-user-logged-out a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'Logged_hover_border_color',
			[
				'label'     => esc_html__('Border Color', SA_EL_ADDONS_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sa-el-user-logged-out a:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_border_border!' => '',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

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
					'name' => 'wp-submit',
				],
				'user_label' => [
					'for'   => 'user' . esc_attr($id),
					'class' => [
						'sa-el-form-label',
					]
				],
				'password_label' => [
					'for'   => 'password' . esc_attr($id),
					'class' => [
						'sa-el-form-label',
					]
				],
				'user_input' => [
					'type'        => 'text',
					'name'        => 'log',
					'id'          => 'user' . esc_attr($id),
					'placeholder' => $settings['user_placeholder'],
					'class'       => [
						'sa-el-input',
						'sa-el-form-' . $settings['input_size'],
					],
				],
				'password_input' => [
					'type'        => 'password',
					'name'        => 'pwd',
					'id'          => 'password' . esc_attr($id),
					'placeholder' => $settings['password_placeholder'],
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
				$id          = $this->get_id();

				if ($settings['redirect_after_login'] && !empty($settings['redirect_url']['url'])) {
					$redirect_url = $settings['redirect_url']['url'];
				} else {
					$redirect_url = $current_url;
				}

				if (is_user_logged_in() && !\Elementor\Plugin::instance()->editor->is_edit_mode()) {
					if ($settings['show_logged_in_message']) {
						$current_user = wp_get_current_user();

						?>
				<div class="sa-el-user-login sa-el-text-center">
					<ul class="sa-el-list sa-el-list-divider">
						<li class="sa-el-user-avatar sa-el-margin-large-bottom">
							<?php echo get_avatar($current_user->user_email, 128); ?>
						</li>
						<li class="sa-el-user-name">
							<?php esc_html_e('Name:', SA_EL_ADDONS_TEXTDOMAIN); ?> <a href="<?php echo get_edit_user_link(); ?>" class="sa-el-text-bold"><?php echo $current_user->display_name; ?></a>
						</li>

						<li class="sa-el-user-website">
							<?php esc_html_e('Website:', SA_EL_ADDONS_TEXTDOMAIN); ?> <a href="<?php echo $current_user->user_url; ?>" target="_blank"><?php echo $current_user->user_url; ?></a>
						</li>

						<li class="sa-el-user-bio">
							<?php esc_html_e('Description:', SA_EL_ADDONS_TEXTDOMAIN); ?> <?php echo $current_user->user_description; ?>
						</li>

						<li class="sa-el-user-logged-out">
							<a href="<?php echo wp_logout_url($current_url); ?>" class="sa-el-button sa-el-button-primary"><?php esc_html_e('Logout', SA_EL_ADDONS_TEXTDOMAIN); ?></a>
						</li>
					</ul>

				</div>

		<?php
					}
					return;
				}

				$this->form_fields_render_attributes();

				?>
		<div class="sa-el-user-login sa-el-user-login-skin-default">
			<div class="elementor-form-fields-wrapper">
				<?php $this->user_login_form(); ?>
			</div>
		</div>

	<?php

			$this->user_login_ajax_script();
		}

		public function user_login_form()
		{
			$settings    = $this->get_settings();

			$current_url = remove_query_arg('fake_arg');
			$id          = $this->get_id();

			if ($settings['redirect_after_login'] && !empty($settings['redirect_url']['url'])) {
				$redirect_url = $settings['redirect_url']['url'];
			} else {
				$redirect_url = $current_url;
			}

			?>
		<form id="sa-el-user-login<?php echo esc_attr($id); ?>" class="sa-el-form-stacked sa-el-width-1-1" method="post" action="login" data-class="SA_EL_ADDONS\Elements\User_Login\Files\UserLogin" data-function="sa_el_ajax_login">
			<div class="sa-el-user-login-status"></div>
			<div <?php echo $this->get_render_attribute_string('field-group'); ?>>
				<?php
						if ($settings['show_labels']) {
							echo '<label ' . $this->get_render_attribute_string('user_label') . '>' . $settings['user_label'] . '</label>';
						}
						echo '<div class="sa-el-form-controls">';
						echo '<input ' . $this->get_render_attribute_string('user_input') . ' required>';
						echo '</div>';

						?>
			</div>

			<div <?php echo $this->get_render_attribute_string('field-group'); ?>>
				<?php
						if ($settings['show_labels']) :
							echo '<label ' . $this->get_render_attribute_string('password_label') . '>' . $settings['password_label'] . '</label>';
						endif;
						echo '<div class="sa-el-form-controls">';
						echo '<input ' . $this->get_render_attribute_string('password_input') . ' required>';
						echo '</div>';
						?>
			</div>

			<?php if ($settings['show_remember_me']) : ?>
				<div class="sa-el-field-group sa-el-remember-me">
					<label for="remember-me-<?php echo esc_attr($id); ?>" class="sa-el-form-label">
						<input type="checkbox" id="remember-me-<?php echo esc_attr($id); ?>" class="sa-el-checkbox" name="rememberme" value="forever">
						<?php esc_html_e('Remember Me', SA_EL_ADDONS_TEXTDOMAIN); ?>
					</label>
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
					$show_register      = get_option('users_can_register') && $settings['show_register'];

					if ($show_lost_password || $show_register) : ?>
				<div class="sa-el-field-group sa-el-width-1-1 sa-el-margin-remove-bottom sa-el-user-login-password">

					<?php if ($show_lost_password) : ?>
						<a class="sa-el-lost-password" href="<?php echo wp_lostpassword_url($redirect_url); ?>">
							<?php esc_html_e('Lost password?', SA_EL_ADDONS_TEXTDOMAIN); ?>
						</a>
					<?php endif; ?>

					<?php if ($show_register) : ?>
						<a class="sa-el-register" href="<?php echo wp_registration_url(); ?>">
							<?php esc_html_e('Register', SA_EL_ADDONS_TEXTDOMAIN); ?>
						</a>
					<?php endif; ?>

				</div>
			<?php endif; ?>

			<?php wp_nonce_field('ajax-login-nonce', 'sa-el-user-login-sc'); ?>
			<div class="sa-el-user-message-show"></div>
		</form>
	<?php
		}

		public function user_login_ajax_script()
		{
			$settings    = $this->get_settings();
			$current_url = remove_query_arg('fake_arg');
			$id          = $this->get_id();

			if ($settings['redirect_after_login'] && !empty($settings['redirect_url']['url'])) {
				$redirect_url = $settings['redirect_url']['url'];
			} else {
				$redirect_url = $current_url;
			}

			?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				"use strict";
				var login_form = 'form#sa-el-user-login<?php echo esc_attr($id); ?>';
				$(login_form).on('submit', function(e) {
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
							if (data.loggedin == true) {
								$($This).children('.sa-el-user-message-show').removeClass('sa-el-user-error').addClass('sa-el-user-success').html(data.message);
								document.location.href = '<?php echo esc_url( $redirect_url ); ?>';
							} else {
								$($This).children('.sa-el-user-message-show').removeClass('sa-el-user-success').addClass('sa-el-user-error').html(data.message);
							}
							
						},
						error: function(data) {
							$($This).children('.sa-el-user-message-show').removeClass('sa-el-user-success').addClass('sa-el-user-error').html('Unknown error, make sure access is correct!');
						}
					});
				});

			});
		</script>
<?php
	}
}
