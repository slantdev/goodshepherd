<?php

/**
 * Template part for displaying the site header
 */
?>

<header id="masthead" class="site-header bg-white relative">
	<div class="container mx-auto px-4">
		<div class="flex items-center justify-between py-4">

			<!-- Site Branding -->
			<div class="site-branding shrink-0 mr-4">
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

			<!-- Mobile Menu Toggle -->
			<div class="lg:hidden ml-auto">
				<button id="mobile-menu-toggle" class="flex items-center p-2 text-off-black focus:outline-none" aria-label="<?php esc_attr_e('Toggle Menu', 'goodshep-theme'); ?>">
					<?php echo goodshep_icon(array('icon' => 'menu', 'group' => 'utility', 'class' => 'w-8 h-8')); ?>
				</button>
			</div>

			<!-- Header Right (Flags & CTA) - Desktop Only -->
			<div class="secondary_menu hidden lg:flex lg:flex-col items-end justify-between ml-auto">
				<div class="text-right mb-4 flex items-center">
					<div class="flex gap-x-3 items-center mr-8 max-h-9">
						<img class="w-auto h-6" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/flags/AustralianAboriginalFlag.png'); ?>" width="83" height="50" alt="Australian Aboriginal">
						<img class="w-auto h-6" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/flags/TorresStraitIslanderFlag.png'); ?>" width="83" height="50" alt="Torress Strait Island">
						<img class="w-auto h-6" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/flags/ProgressPrideFlag.png'); ?>" width="83" height="50" alt="Prograss Pride">
					</div>
					<div class="text-sm">In an emergency dial <a href="tel:000" class="underline text-body font-bold">000</a></div>
				</div>

				<div class="text-right px-0 gap-0 py-1 flex items-center">
					<a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="inline-block text-purple bg-white border border-solid border-purple leading-none rounded-md text-base font-medium no-underline hover:underline px-6 py-3 mr-4 text-center transition-colors">
						<?php esc_html_e('Contact us', 'goodshep-theme'); ?>
					</a>
					<a href="<?php echo esc_url(home_url('/donate-now/')); ?>" target="_blank" class="inline-block text-white bg-purple border border-purple leading-none rounded-md text-base font-medium no-underline hover:bg-opacity-90 px-6 py-3 mr-4 text-center transition-colors">
						<?php esc_html_e('Donate now', 'goodshep-theme'); ?>
					</a>
					<button id="enable_quick_escape" class="inline-block text-white bg-red border border-red leading-none px-6 py-3 rounded-md text-base font-medium transition-colors hover:bg-opacity-90 text-center">
						<?php esc_html_e('Quick exit', 'goodshep-theme'); ?>
					</button>
				</div>
			</div>

		</div>
	</div>

	<!-- Desktop Navigation -->
	<div class="site-nav hidden md:bg-off-white lg:block z-50 relative">
		<?php get_template_part('template-parts/global/site-navigation'); ?>
	</div>

	<!-- Mobile Menu (Hidden by default) -->
	<div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-100 absolute top-full left-0 right-0 z-50 shadow-lg">
		<div class="container mx-auto px-4 py-4">
			<!-- Mobile Search -->
			<div class="mb-6">
				<?php get_search_form(); ?>
			</div>

			<nav class="mobile-navigation" role="navigation" aria-label="<?php esc_attr_e('Mobile Menu', 'goodshep-theme'); ?>">
				<?php
				wp_nav_menu(array(
					'theme_location' => 'primary',
					'menu_id'        => 'mobile-primary-menu',
					'container'      => false,
					'menu_class'     => 'flex flex-col space-y-4 text-lg font-medium text-off-black',
				));
				?>
			</nav>

			<!-- Mobile CTA Buttons -->
			<div class="mt-8 flex flex-col gap-4">
				<a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="block w-full text-purple bg-white border border-solid border-purple rounded-md text-center py-3 font-medium">
					<?php esc_html_e('Contact us', 'goodshep-theme'); ?>
				</a>
				<a href="<?php echo esc_url(home_url('/donate-now/')); ?>" class="block w-full text-white bg-purple border border-purple rounded-md text-center py-3 font-medium">
					<?php esc_html_e('Donate now', 'goodshep-theme'); ?>
				</a>
				<button class="block w-full text-white bg-red border border-red rounded-md text-center py-3 font-medium quick-exit-mobile">
					<?php esc_html_e('Quick exit', 'goodshep-theme'); ?>
				</button>
			</div>
		</div>
	</div>
</header>