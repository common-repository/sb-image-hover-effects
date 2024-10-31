<?php
/**
 * Template Library Header Template
 */
?>
<label class="saeladdons-template-library-filter-label">
	<input type="radio" value="{{ slug }}" <# if ( '' === slug ) { #> checked<# } #> name="saeladdons-library-filter">
	<span>{{ title }}</span>
</label>