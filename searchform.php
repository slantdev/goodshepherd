<?php
/**
 * Search form
 */
?>

<form role="search" method="get" class="search-form relative flex items-center" action="<?php echo esc_url(home_url('/')); ?>">
	<label for="search-field-<?php echo uniqid(); ?>" class="sr-only"><?php echo _x( 'Search for:', 'label', 'goodshep-theme' ); ?></label>
	<input type="search" id="search-field-<?php echo uniqid(); ?>" class="search-field w-full py-2 pl-4 pr-12 border border-gray-300 rounded-md focus:outline-none focus:border-purple transition-colors" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'goodshep-theme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit absolute right-3 top-1/2 -translate-y-1/2 p-1 text-gray-500 hover:text-purple focus:text-purple transition-colors" aria-label="<?php echo esc_attr_x( 'Submit search', 'submit button', 'goodshep-theme' ); ?>">
		<?php echo goodshep_icon(array('icon' => 'search', 'group' => 'utility', 'class' => 'w-5 h-5')); ?>
	</button>
</form>