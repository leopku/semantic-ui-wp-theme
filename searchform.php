<?php
/**
 * The template for displaying search forms in semantic-ui-wp-theme
 *
 * @package semantic-ui-wp-theme
 */
?>
<form role="search" method="get" class="ui form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="ui mini action input">
		<input type="text" placeholder="<?php echo __('Search') . '...' ?>">
		<div class="ui button"><?php echo __('Search') ?></div>
	</div>
</form>
