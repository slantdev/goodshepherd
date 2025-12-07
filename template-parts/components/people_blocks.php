<?php
/**
 * Component: People Blocks
 * Layout: people_blocks
 */

$title = get_sub_field('title');
$text  = get_sub_field('section_description');
$term  = get_sub_field('choose_the_content'); // Taxonomy Object

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();

if ( ! $term ) return;

// Determine Layout Type based on Term Name (Legacy Logic)
$layout_type = 'list'; // Default
$term_name   = $term->name;

if ( stripos( $term_name, 'CEO' ) !== false || stripos( $term_name, 'Main' ) !== false ) {
    $layout_type = 'split'; // Single feature
} elseif ( stripos( $term_name, 'Board' ) !== false ) {
    $layout_type = 'grid'; // Grid of cards
}

// Query
$args = array(
    'post_type'      => 'people',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'tax_query'      => array(
        array(
            'taxonomy' => 'people_role',
            'field'    => 'term_id',
            'terms'    => $term->term_id,
        ),
    ),
);
$people_query = new WP_Query( $args );
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <?php if ( $title ) : ?>
            <h2 class="font-semibold mb-6 text-3xl text-red"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <?php if ( $text ) : ?>
            <div class="mb-12 prose max-w-none text-lg text-gray-700 md:w-1/2">
                <?php echo wp_kses_post( $text ); ?>
            </div>
        <?php endif; ?>

        <?php if ( $people_query->have_posts() ) : ?>
            
            <!-- Layout: Split (CEO/Main) -->
            <?php if ( $layout_type === 'split' ) : ?>
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <?php while ( $people_query->have_posts() ) : $people_query->the_post(); 
                        $img  = get_field('profile_photo'); // Array
                        $name = get_field('people_name');
                        $desc = get_field('people_description'); // Full text for modal
                        $exc  = get_the_excerpt();
                    ?>
                        <!-- Image -->
                        <div class="mb-8 md:mb-0">
                            <?php if ( $img ) : ?>
                                <img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $name ); ?>" class="rounded-lg w-full object-cover h-auto shadow-md">
                            <?php endif; ?>
                        </div>
                        
                        <!-- Text -->
                        <div>
                            <h3 class="text-2xl font-semibold mb-4"><?php echo esc_html( $name ); ?></h3>
                            <div class="prose max-w-none text-gray-700 mb-6">
                                <?php echo wp_kses_post( $exc ); ?>
                            </div>
                            <button type="button" class="text-red font-medium uppercase tracking-wider hover:opacity-80">Read More</button>
                        </div>
                    <?php endwhile; ?>
                </div>

            <!-- Layout: Grid (Board) -->
            <?php elseif ( $layout_type === 'grid' ) : ?>
                <div class="grid md:grid-cols-3 gap-x-8 gap-y-16">
                    <?php while ( $people_query->have_posts() ) : $people_query->the_post(); 
                        $img  = get_field('profile_photo');
                        $name = get_field('people_name');
                        $pos  = get_field('people_position');
                        $exc  = get_the_excerpt();
                    ?>
                        <div>
                            <?php if ( $img ) : ?>
                                <div class="h-64 mb-6 rounded-lg overflow-hidden">
                                    <img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $name ); ?>" class="w-full h-full object-cover">
                                </div>
                            <?php endif; ?>
                            
                            <h3 class="text-xl font-medium mb-1"><?php echo esc_html( $name ); ?></h3>
                            
                            <?php if ( $pos ) : ?>
                                <p class="text-gray-500 mb-4"><?php echo esc_html( $pos ); ?></p>
                            <?php endif; ?>

                            <?php if ( $exc ) : ?>
                                <div class="border-t border-gray-200 pt-4 text-gray-600 text-sm">
                                    <?php echo wp_kses_post( $exc ); ?>
                                </div>
                            <?php endif; ?>
                            
                            <button type="button" class="text-red font-medium uppercase tracking-wider hover:opacity-80 mt-4 text-sm">Read More</button>
                        </div>
                    <?php endwhile; ?>
                </div>

            <!-- Layout: List (Executive/Sisters) -->
            <?php else : ?>
                <div class="grid md:grid-cols-2 gap-10">
                    <?php while ( $people_query->have_posts() ) : $people_query->the_post(); 
                        $img   = get_field('profile_photo');
                        $name  = get_field('people_name');
                        $pos   = get_field('people_position');
                        $email = get_field('people_email');
                        $exc   = get_the_excerpt();
                    ?>
                        <div class="flex flex-col sm:flex-row gap-6">
                            <?php if ( $img ) : ?>
                                <div class="w-32 h-32 shrink-0 rounded-lg overflow-hidden">
                                    <img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $name ); ?>" class="w-full h-full object-cover">
                                </div>
                            <?php endif; ?>
                            
                            <div>
                                <h3 class="text-xl font-medium mb-1"><?php echo esc_html( $name ); ?></h3>
                                
                                <?php if ( $pos ) : ?>
                                    <p class="text-gray-900 mb-2 font-medium"><?php echo esc_html( $pos ); ?></p>
                                <?php endif; ?>

                                <?php if ( $exc ) : ?>
                                    <div class="text-gray-600 text-sm mb-3">
                                        <?php echo wp_kses_post( $exc ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ( $email ) : ?>
                                    <a href="mailto:<?php echo esc_attr( $email ); ?>" class="text-purple text-sm block mb-2"><?php echo esc_html( $email ); ?></a>
                                <?php endif; ?>

                                <button type="button" class="text-red font-medium uppercase tracking-wider hover:opacity-80 text-sm">Read More</button>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

        <?php wp_reset_postdata(); endif; ?>

    </div>
</section>
