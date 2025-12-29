<?php

/**
 * Template part for displaying the site header
 */
?>

<header id="masthead" class="site-header bg-white relative">
	<div class="container mx-auto xl:px-4">

		<div class="flex flex-col xl:flex-row xl:justify-between">
			<!-- Flags & CTA -->
			<div class="px-4 bg-off-white order-1 xl:order-2 xl:px-0 xl:py-4 xl:bg-white">
				<div class="flex flex-col items-center justify-between xl:items-end xl:justify-end xl:ml-auto">
					<div class="text-right flex items-center pt-3 xl:pt-0 xl:mb-4">
						<div class="flex gap-x-3 items-center max-h-9">
							<img class="w-auto h-6" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/flags/AustralianAboriginalFlag.png'); ?>" width="83" height="50" alt="Australian Aboriginal">
							<img class="w-auto h-6" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/flags/TorresStraitIslanderFlag.png'); ?>" width="83" height="50" alt="Torress Strait Island">
							<img class="w-auto h-6" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/flags/ProgressPrideFlag.png'); ?>" width="83" height="50" alt="Prograss Pride">
						</div>
						<div class="hidden text-base md:block md:ml-6 xl:ml-8 xl:text-lg">In an emergency dial <a href="tel:000" class="underline text-body">000</a></div>
					</div>
					<div class="w-full flex flex-nowrap items-center justify-center px-0 py-3 gap-2 xl:py-1 xl:text-right xl:justify-end">
						<a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="inline-block text-purple bg-white border border-purple leading-none rounded-md text-sm font-medium no-underline hover:underline w-1/3 md:w-auto px-2 py-2 md:px-6 xl:py-3 xl:px-8 xl:text-xl text-center">
							<?php esc_html_e('Contact us', 'goodshep-theme'); ?>
						</a>
						<a href="<?php echo esc_url(home_url('/donate-now/')); ?>" target="_blank" class="inline-block text-white bg-purple border border-purple leading-none rounded-md text-sm font-medium no-underline hover:underline w-1/3 md:w-auto px-2 py-2 md:px-6 xl:py-3 xl:px-8 xl:text-xl text-center">
							<?php esc_html_e('Donate now', 'goodshep-theme'); ?>
						</a>
						<button id="enable_quick_escape" class="inline-block w-1/3 text-white bg-red border border-red leading-none px-2 py-2 rounded-md text-sm font-medium transition-colors inactive_quick_escape hover:underline text-center md:w-auto md:px-6 xl:py-3 xl:px-8 xl:text-xl">
							<?php esc_html_e('Quick exit', 'goodshep-theme'); ?>
						</button>
					</div>
				</div>
			</div>

			<!-- Logo & Nav -->
			<div class="flex justify-between py-3 order-2 xl:order-1 xl:py-0 xl:px-0">

				<!-- Mobile Menu Toggle -->
				<div class="mr-4 flex items-center justify-center xl:hidden">
					<button id="mobile-menu-toggle" class="flex items-center p-4 text-off-black focus:outline-none" aria-label="<?php esc_attr_e('Toggle Menu', 'goodshep-theme'); ?>">
						<?php echo goodshep_icon(array('icon' => 'menu', 'group' => 'utility', 'class' => 'w-5 h-5')); ?>
					</button>
				</div>

				<!-- Site Branding -->
				<div class="site-branding xl:mr-4 xl:pt-5">
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

				<div class="header-search relative ml-4 flex items-center justify-center xl:hidden">
					<button class="js-search-toggle flex items-center focus:outline-none hover:text-purple cursor-pointer transition-colors p-4 xl:hidden" aria-expanded="false" aria-controls="header-search-form" aria-label="<?php esc_attr_e('Toggle search', 'goodshep-theme'); ?>">
						<span class="search-icon block">
							<?php echo goodshep_icon(array('icon' => 'search', 'group' => 'utility', 'class' => 'w-5 h-5')); ?>
						</span>
						<span class="close-icon hidden">
							<?php echo goodshep_icon(array('icon' => 'close', 'group' => 'utility', 'class' => 'w-5 h-5')); ?>
						</span>
					</button>
				</div>

			</div>
		</div>

	</div>

	<!-- Desktop Navigation -->
	<div class="site-nav hidden md:bg-off-white xl:block z-50 relative">
		<?php get_template_part('template-parts/global/site-navigation'); ?>
	</div>

	<!-- Global Search Form (Hidden by default) -->
	<div id="header-search-form" class="hidden absolute left-0 right-0 top-full bg-off-white shadow-lg p-4 z-60 border-t border-gray-100 lg:border-t-0 lg:bg-transparent lg:shadow-none lg:p-0 2xl:hidden">
		<div class="container mx-auto px-4 lg:flex lg:justify-end">
			<div class="lg:bg-white lg:border-t lg:border-gray-100 lg:p-4 lg:shadow-lg lg:rounded-b-lg lg:w-72 xl:bg-off-white ">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>

	<!-- Mobile Menu Overlay -->
	<div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 z-65 hidden transition-opacity opacity-0"></div>

	<!-- Mobile Menu Drawer -->
	<div id="mobile-menu-drawer" class="fixed inset-y-0 right-0 z-70 w-full max-w-sm bg-white shadow-xl transform translate-x-full transition-transform duration-300 overflow-y-auto">

		<!-- Drawer Header -->
		<div class="flex items-center justify-between p-4 border-b border-gray-100 sticky top-0 bg-white z-10">
			<span class="text-xl font-bold text-off-black"><?php esc_html_e('Menu', 'goodshep-theme'); ?></span>
			<button id="mobile-menu-close" class="p-2 text-off-black hover:text-red focus:outline-none">
				<?php echo goodshep_icon(array('icon' => 'close', 'group' => 'utility', 'class' => 'w-6 h-6')); ?>
			</button>
		</div>

		<!-- Drawer Content -->
		<div class="p-4">
			<?php if (have_rows('menu_items', 'option')): ?>
				<ul class="flex flex-col space-y-2">
					<?php
					while (have_rows('menu_items', 'option')) : the_row();
						$menu_item = get_sub_field('menu_item');
						if (empty($menu_item)) continue;

						$title = $menu_item['title'] ?? '';
						$url = $menu_item['url'] ?? '#';
						$target = $menu_item['target'] ?? '_self';
						$has_submenu = get_sub_field('has_submenu');
						$submenu_type = get_sub_field('submenu_type') ?? '';
					?>
						<li class="border-b border-gray-50 last:border-0 pb-2">
							<div class="flex items-center justify-between">
								<a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>" class="text-lg font-medium text-off-black py-2 block grow">
									<?php echo esc_html($title); ?>
								</a>
								<?php if ($has_submenu): ?>
									<button class="js-mobile-accordion-toggle p-2 text-gray-400 hover:text-red focus:outline-none transition-transform duration-200" aria-expanded="false">
										<?php echo goodshep_icon(array('icon' => 'chevron-down', 'group' => 'utility', 'class' => 'w-5 h-5')); ?>
									</button>
								<?php endif; ?>
							</div>

							<?php if ($has_submenu): ?>
								<ul class="hidden pl-4 space-y-3 mt-2 mb-4 border-l-2 border-gray-100">

									<?php if ($submenu_type === 'megamenu'):
										$megamenu_items = get_sub_field('megamenu_items');
										$megamenu_submenu_type = $megamenu_items['submenu_type'] ?? '';
										$megamenu_repeater = $megamenu_items['submenu_group'] ?? [];
										$image_grid = $megamenu_items['images_grid_group'] ?? [];

										// Link List Logic
										if ($megamenu_submenu_type === 'link-list' && !empty($megamenu_repeater)):
											foreach ($megamenu_repeater as $col):
												$col_heading = $col['submenu_heading'] ?? '';
												$col_items = $col['submenu_items'] ?? [];
									?>
												<li class="pt-2">
													<?php if ($col_heading): ?>
														<div class="font-semibold text-gray-500 text-sm uppercase tracking-wide mb-2"><?php echo esc_html($col_heading); ?></div>
													<?php endif; ?>

													<?php if (!empty($col_items)): ?>
														<ul class="space-y-2">
															<?php foreach ($col_items as $item):
																$s_link = $item['submenu_link'] ?? [];
															?>
																<li>
																	<a href="<?php echo esc_url($s_link['url'] ?? '#'); ?>" target="<?php echo esc_attr($s_link['target'] ?? '_self'); ?>" class="block text-base text-gray-700 hover:text-red">
																		<?php echo esc_html($s_link['title'] ?? ''); ?>
																	</a>
																</li>
															<?php endforeach; ?>
														</ul>
													<?php endif; ?>
												</li>
											<?php endforeach;
										endif;

										// Image Grid Logic
										if ($megamenu_submenu_type === 'link-image' && !empty($image_grid)):
											foreach ($image_grid as $col):
												$col_heading = $col['submenu_heading'] ?? '';
												$col_items = $col['submenu_items'] ?? [];
											?>
												<li class="pt-2">
													<?php if ($col_heading): ?>
														<div class="font-semibold text-gray-500 text-sm uppercase tracking-wide mb-2"><?php echo esc_html($col_heading); ?></div>
													<?php endif; ?>

													<?php if (!empty($col_items)): ?>
														<ul class="space-y-3">
															<?php foreach ($col_items as $item):
																$s_link = $item['submenu_link'] ?? [];
															?>
																<li>
																	<a href="<?php echo esc_url($s_link['url'] ?? '#'); ?>" target="<?php echo esc_attr($s_link['target'] ?? '_self'); ?>" class="flex items-center text-base text-gray-700 hover:text-red">
																		<?php echo esc_html($s_link['title'] ?? ''); ?>
																	</a>
																</li>
															<?php endforeach; ?>
														</ul>
													<?php endif; ?>
												</li>
									<?php endforeach;
										endif;
									endif; // End Megamenu 
									?>

									<?php if ($submenu_type === 'dropdown'):
										$dropdown_items = get_sub_field('dropdown_menu_items')['submenu_items'] ?? [];
										foreach ($dropdown_items as $item):
											$s_link = $item['submenu_link'] ?? [];
									?>
											<li>
												<a href="<?php echo esc_url($s_link['url'] ?? '#'); ?>" target="<?php echo esc_attr($s_link['target'] ?? '_self'); ?>" class="block text-base text-gray-700 hover:text-red">
													<?php echo esc_html($s_link['title'] ?? ''); ?>
												</a>
											</li>
									<?php endforeach;
									endif; // End Dropdown 
									?>

								</ul>
							<?php endif; ?>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php endif; ?>

			<!-- Mobile CTA Buttons (Optional: Added here for ease of access) -->
			<div class="mt-8 pt-6 border-t border-gray-200 flex flex-col gap-4">
				<a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="block w-full text-purple bg-white border border-solid border-purple rounded-md text-center py-3 font-medium hover:bg-purple hover:text-white transition-colors">
					<?php esc_html_e('Contact us', 'goodshep-theme'); ?>
				</a>
				<a href="<?php echo esc_url(home_url('/donate-now/')); ?>" class="block w-full text-white bg-purple border border-purple rounded-md text-center py-3 font-medium hover:bg-opacity-90 transition-colors">
					<?php esc_html_e('Donate now', 'goodshep-theme'); ?>
				</a>
				<button class="block w-full text-white bg-red border border-red rounded-md text-center py-3 font-medium quick-exit-mobile hover:bg-opacity-90 transition-colors">
					<?php esc_html_e('Quick exit', 'goodshep-theme'); ?>
				</button>
			</div>
		</div>
	</div>

</header>