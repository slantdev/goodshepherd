<?php
/**
 * Component: Client Stories
 * Layout: client_stories
 */

$heading      = get_sub_field('section_heading');
$show_filter  = get_sub_field('show_filter');
$section_id   = goodshep_get_section_id();
$block_class  = goodshep_get_block_classes('bg-gray-50'); // Default bg
$bg_style     = goodshep_get_bg_image_style();

// Query Arguments
$args = array(
    'post_type'      => 'client-story',
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'posts_per_page' => -1,
);
$stories_query = new WP_Query( $args );
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_class ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <!-- Header & Filter -->
        <div class="mb-12 flex flex-col gap-y-4 md:flex-row md:justify-between md:items-end">
            <?php if ( $heading ) : ?>
                <h2 class="text-red-600 font-semibold text-3xl"><?php echo esc_html( $heading ); ?></h2>
            <?php endif; ?>

            <?php if ( $show_filter ) : 
                $terms = get_terms( array( 'taxonomy' => 'story-category', 'hide_empty' => false ) );
                if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) :
            ?>
                <div>
                    <select id="stories-filter" class="xl:text-xl font-bold min-w-[300px] bg-transparent rounded-none border-x-0 border-t-0 border-b-2 border-gray-900 pl-0 py-2 focus:outline-none focus:border-red-600 transition-colors cursor-pointer">
                        <option value="all">All stories</option>
                        <?php foreach ( $terms as $term ) : ?>
                            <option value="<?php echo esc_attr( $term->term_id ); ?>"><?php echo esc_html( $term->name ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; endif; ?>
        </div>

        <!-- Stories Grid -->
        <div class="stories-container relative">
            <?php if ( $stories_query->have_posts() ) : ?>
                <div class="grid gap-8 lg:grid-cols-3 stories-grid">
                    <?php 
                    while ( $stories_query->have_posts() ) : 
                        $stories_query->the_post();
                        get_template_part( 'template-parts/components/client_stories_item' );
                    endwhile; 
                    wp_reset_postdata(); 
                    ?>
                </div>
            <?php else : ?>
                <p class="text-center text-gray-500">No stories found.</p>
            <?php endif; ?>
            
            <!-- Loading Overlay (Hidden by default) -->
            <div class="blocker absolute inset-0 bg-white/60 z-10 hidden transition-opacity duration-300 flex items-center justify-center">
                <div class="animate-spin rounded-full h-12 w-12 border-4 border-red-600 border-t-transparent"></div>
            </div>
        </div>

    </div>
</section>
