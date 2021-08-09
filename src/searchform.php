<form role="search" ' . $aria_label . 'method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ); ?></span>
	</label>

	<input 
		type="search" 
		class="search-field" 
		value="<?php echo get_search_query(); ?>"  name="s" />

	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
</form>
