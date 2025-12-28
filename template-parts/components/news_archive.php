<?php

/**
 * Component: News Archive
 * Layout: news_archive
 */

$title      = get_sub_field('title');
$categories = get_sub_field('filter_by_categories');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();

// Query Args
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'posts_per_page' => 6, // Reasonable default
);

if ($categories) {
    $args['category__in'] = $categories;
}

$news_query = new WP_Query($args);
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="container mx-auto px-4">

        <?php if ($title) : ?>
            <h2 class="lg:text-4xl font-semibold mb-12"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($news_query->have_posts()) : ?>
            <div class="grid md:grid-cols-3 gap-8">
                <?php
                while ($news_query->have_posts()) : $news_query->the_post();
                    $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    $link      = get_permalink();
                ?>
                    <div class="rounded-2xl shadow-lg hover:shadow-xl transition-shadow h-full overflow-hidden flex flex-col bg-white group">

                        <!-- Image Header -->
                        <div class="relative h-64 flex-none">
                            <?php if ($thumb_url) : ?>
                                <a href="<?php echo esc_url($link); ?>" class="block h-full w-full">
                                    <img class="object-cover h-full w-full transition-transform duration-500 group-hover:scale-105"
                                        src="<?php echo esc_url($thumb_url); ?>"
                                        alt="<?php the_title_attribute(); ?>">
                                </a>
                            <?php endif; ?>

                            <!-- Icon Overlay (News Icon) -->
                            <div class="absolute bottom-0 right-0 -mb-10 mr-8 flex items-center justify-center h-20 w-20 bg-purple rounded-full p-3 z-10">
                                <?php echo goodshep_icon(array('icon' => 'news', 'group' => 'custom', 'class' => 'h-10 w-10 text-white fill-current')); ?>
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="pt-14 px-8 pb-8 flex flex-col grow">

                            <div class="text-base text-gray-500 mb-2">
                                <?php echo get_the_date('d F Y'); ?>
                            </div>

                            <h3 class="text-2xl font-semibold mb-6">
                                <a href="<?php echo esc_url($link); ?>" class="text-gray-900 hover:text-purple transition-colors no-underline">
                                    <?php the_title(); ?>
                                </a>
                            </h3>

                            <div class="mb-8 leading-loose text-default">
                                <?php the_excerpt(); ?>
                            </div>

                            <div class="mt-auto">
                                <a href="<?php echo esc_url($link); ?>" class="text-red font-medium uppercase tracking-wider hover:opacity-80 transition-opacity no-underline">
                                    Read More
                                </a>
                            </div>

                        </div>

                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>

    </div>
</section>