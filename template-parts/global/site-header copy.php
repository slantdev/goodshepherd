<?php

/**
 * Template part for displaying the site header
 */
?>

<header id="masthead" class="site-header bg-white relative">
	<div class="container mx-auto xl:px-4">

		<!-- Flags & CTA -->
		<div class="px-4 bg-off-white xl:px-0">
			<div class="flex flex-col items-center justify-between xl:items-end xl:ml-auto">
				<div class="text-right flex items-center pt-3 xl:pt-0 xl:mb-4">
					<div class="flex gap-x-3 items-center max-h-9">
						<img class="w-auto h-6" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/flags/AustralianAboriginalFlag.png'); ?>" width="83" height="50" alt="Australian Aboriginal">
						<img class="w-auto h-6" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/flags/TorresStraitIslanderFlag.png'); ?>" width="83" height="50" alt="Torress Strait Island">
						<img class="w-auto h-6" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/flags/ProgressPrideFlag.png'); ?>" width="83" height="50" alt="Prograss Pride">
					</div>
					<div class="hidden text-base md:block md:ml-6 xl:ml-8 xl:text-xl">In an emergency dial <a href="tel:000" class="underline text-body">000</a></div>
				</div>
				<div class="w-full flex flex-nowrap items-center justify-center px-0 py-3 gap-2 xl:py-1 xl:text-right">
					<a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="inline-block text-purple bg-white border border-purple leading-none rounded-md text-sm font-medium no-underline hover:underline w-1/3 md:w-auto px-2 py-2 md:px-6 lg:py-4 lg:px-8 lg:text-xl text-center">
						<?php esc_html_e('Contact us', 'goodshep-theme'); ?>
					</a>
					<a href="<?php echo esc_url(home_url('/donate-now/')); ?>" target="_blank" class="inline-block text-white bg-purple border border-purple leading-none rounded-md text-sm font-medium no-underline hover:underline w-1/3 md:w-auto px-2 py-2 md:px-6 lg:py-4 lg:px-8 lg:text-xl text-center">
						<?php esc_html_e('Donate now', 'goodshep-theme'); ?>
					</a>
					<button id="enable_quick_escape" class="inline-block w-1/3 text-white bg-red border border-red leading-none px-2 py-2 rounded-md text-sm font-medium transition-colors inactive_quick_escape hover:underline text-center md:w-auto md:px-6 lg:mr-4 lg:py-4 lg:px-8 lg:text-xl">
						<?php esc_html_e('Quick exit', 'goodshep-theme'); ?>
					</button>
				</div>
			</div>
		</div>

		<div class="flex justify-between py-3 xl:py-0 xl:px-0">

			<!-- Mobile Menu Toggle -->
			<div class="mr-4 flex items-center justify-center lg:hidden">
				<button id="mobile-menu-toggle" class="flex items-center p-4 text-off-black focus:outline-none" aria-label="<?php esc_attr_e('Toggle Menu', 'goodshep-theme'); ?>">
					<?php echo goodshep_icon(array('icon' => 'menu', 'group' => 'utility', 'class' => 'w-5 h-5')); ?>
				</button>
			</div>

			<!-- Site Branding -->
			<div class="site-branding xl:mr-4">
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

			<div class="header-search relative ml-4 lg:hidden">
				<button id="search-toggle" class="flex items-center focus:outline-none hover:text-purple cursor-pointer transition-colors p-4 xl:hidden" aria-expanded="false" aria-controls="header-search-form" aria-label="<?php esc_attr_e('Toggle search', 'goodshep-theme'); ?>">
					<span class="search-icon block">
						<?php echo goodshep_icon(array('icon' => 'search', 'group' => 'utility', 'class' => 'w-5 h-5')); ?>
					</span>
					<span class="close-icon hidden">
						<?php echo goodshep_icon(array('icon' => 'close', 'group' => 'utility', 'class' => 'w-5 h-5')); ?>
					</span>
				</button>

				<div id="header-search-form" class="hidden absolute right-0 left-0 top-full bg-off-white shadow-lg p-4 z-50 w-full rounded-b-lg">
					<?php get_search_form(); ?>
				</div>
			</div>

		</div>

		<div class="hidden items-center justify-between py-4">

			<!-- Mobile Menu Toggle -->
			<div class="lg:hidden mr-auto">
				<button id="mobile-menu-toggle" class="flex items-center p-2 text-off-black focus:outline-none" aria-label="<?php esc_attr_e('Toggle Menu', 'goodshep-theme'); ?>">
					<?php echo goodshep_icon(array('icon' => 'menu', 'group' => 'utility', 'class' => 'w-6 h-6')); ?>
				</button>
			</div>

			<!-- Site Branding -->
			<div class="site-branding shrink-0 xl:mr-4">
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

			<!-- Header Right (Flags & CTA) - Desktop Only -->
			<div class="secondary_menu lg:flex lg:flex-col items-end justify-between ml-auto">
				<div class="text-right mb-4 flex items-center">
					<div class="flex gap-x-3 items-center mr-8 max-h-9">
						<img class="w-auto h-6" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/flags/AustralianAboriginalFlag.png'); ?>" width="83" height="50" alt="Australian Aboriginal">
						<img class="w-auto h-6" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/flags/TorresStraitIslanderFlag.png'); ?>" width="83" height="50" alt="Torress Strait Island">
						<img class="w-auto h-6" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/flags/ProgressPrideFlag.png'); ?>" width="83" height="50" alt="Prograss Pride">
					</div>
					<div>In an emergency dial <a href="tel:000" class="underline text-body">000</a></div>
				</div>

				<div class="text-right px-0 gap-0 py-1 flex items-center">
					<a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="inline-block text-purple bg-white border border-solid border-purple leading-none rounded-md text-xl font-medium no-underline hover:underline px-6 py-3 mr-4 text-center transition-colors">
						<?php esc_html_e('Contact us', 'goodshep-theme'); ?>
					</a>
					<a href="<?php echo esc_url(home_url('/donate-now/')); ?>" target="_blank" class="inline-block text-white bg-purple border border-purple leading-none rounded-md text-xl font-medium no-underline hover:bg-opacity-90 hover:underline px-6 py-3 mr-4 text-center transition-colors">
						<?php esc_html_e('Donate now', 'goodshep-theme'); ?>
					</a>
					<button id="enable_quick_escape" class="inline-block text-white bg-red border border-red leading-none px-6 py-3 rounded-md text-xl font-medium transition-colors hover:bg-opacity-90 hover:underline cursor-pointer text-center">
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

</header>