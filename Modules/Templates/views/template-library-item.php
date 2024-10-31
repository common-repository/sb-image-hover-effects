<?php
/**
 * Template item
 */
?>
<# var activeTab = window.ElementorAddonsLibreryData.tabs[ type ]; #>
<div class="elementor-template-library-template-body">
	<# if ( 'saeladdons-local' !== source ) { #>
	<div class="elementor-template-library-template-screenshot">
		<# if ( 'saeladdons-local' !== source ) { #>
		<div class="elementor-template-library-template-preview">
			<i class="fa fa-search-plus"></i>
		</div>
		<# } #>
		<img src="{{ thumbnail }}" alt="">
	</div>
	<# } #>
</div>
<div class="elementor-template-library-template-controls">
	<# if ( 'pro' != package ) { #>
		<button class="elementor-template-library-template-action saeladdons-template-library-template-insert elementor-button elementor-button-success">
			<i class="eicon-file-download"></i>
			<span class="elementor-button-title"><?php esc_html_e( 'Insert', 'saeladdons' ); ?></span>
		</button>
	<# } else { #>
		<a class="elementor-template-library-template-action elementor-button saeladdons-template-library-template-go-pro" href="https://www.oxilab.org/downloads/elementor-addons/" target="_blank">
			<i class="eicon-heart"></i><span class="elementor-button-title"><?php
				esc_html_e( 'Go Pro', 'saeladdons' );
			?></span>
		</a>
	<# } #>
</div>
<# if ( 'saeladdons-local' === source || true == activeTab.settings.show_title ) { #>
<div class="elementor-template-library-template-name">{{{ title }}}</div>
<# } else { #>
<div class="elementor-template-library-template-name-holder"></div>
<# } #>
<# if ( 'saeladdons-local' === source ) { #>
<div class="elementor-template-library-template-type">
	<?php esc_html_e( 'Type:', 'saeladdons' ); ?> {{{ typeLabel }}}
</div>
<# } #>