<?php

/**
 * Template part for displaying the site header
 */
?>

<header id="masthead" class="site-header bg-white">
	<div class="container mx-auto px-4">
		<div class="flex items-center justify-between">

			<!-- Site Branding -->
			<div class="site-branding">
				<?php
				if (has_custom_logo()) :
					the_custom_logo();
				else :
				?>
					<h1 class="site-title text-2xl font-bold">
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="text-gray-900 no-underline">
							<?php bloginfo('name'); ?>
						</a>
					</h1>
				<?php
				endif;
				?>
			</div><!-- .site-branding -->

			<!-- Header Right (Flags & CTA) -->
			<div class="secondary_menu pt-4 pb-4 items-end justify-between ml-auto bg-white hidden lg:flex lg:flex-col">
				<div class="text-right mb-4 flex items-center">
					<div class="flex gap-x-3 items-center mr-8 max-h-9">
						<img class="w-auto h-6" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/flags/AustralianAboriginalFlag.png'); ?>" width="83" height="50" alt="Australian Aboriginal">
						<img class="w-auto h-6" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/flags/TorresStraitIslanderFlag.png'); ?>" width="83" height="50" alt="Torress Strait Island">
						<img class="w-auto h-6" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/flags/ProgressPrideFlag.png'); ?>" width="83" height="50" alt="Prograss Pride">
					</div>
					<div class="">In an emergency dial <a href="tel:000" class="underline text-body">000</a></div>
				</div>

				<div class="text-right px-0 gap-0 py-1">
					<a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="inline-block text-purple bg-white border border-solid border-purple leading-none rounded-md text-xl font-medium no-underline hover:underline w-1/2 md:w-auto px-6 py-3 lg:mr-4 xl:py-3 xl:px-6 text-center">
						<?php esc_html_e('Contact us', 'goodshep'); ?>
					</a>
					<a href="<?php echo esc_url(home_url('/donate-now/')); ?>" target="_blank" class="inline-block text-white bg-purple border border-purple leading-none rounded-md text-xl font-medium no-underline hover:underline w-1/2 md:w-auto px-6 py-3 lg:mr-4 xl:py-3 xl:px-6 text-center">
						<?php esc_html_e('Donate now', 'goodshep'); ?>
					</a>
					<button id="enable_quick_escape" class="inline-block w-1/2 text-white bg-red border border-red leading-none px-6 py-3 rounded-md text-xl font-medium transition-colors inactive_quick_escape text-center hover:underline lg:w-auto xl:py-3 xl:px-6">
						<?php esc_html_e('Quick exit', 'goodshep'); ?>
					</button>
				</div>
			</div>

		</div>
	</div>

	<div class="container mx-auto px-4">
		<!-- Navigation -->
		<nav id="site-navigation" class="main-navigation hidden md:block">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'container'      => false,
					'menu_class'     => 'flex space-x-6',
					'fallback_cb'    => false, // Do not fallback to wp_page_menu
				)
			);
			?>
		</nav><!-- #site-navigation -->

		<!-- Mobile Menu Button (Placeholder) -->
		<div class="md:hidden">
			<button class="text-gray-500 hover:text-gray-900 focus:outline-none">
				<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
				</svg>
			</button>
		</div>
	</div>
</header>