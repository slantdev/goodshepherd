<?php

/**
 * Component Part: Client Stories Item (Card)
 * 
 * Used in: client_stories.php and AJAX handlers.
 */

$post_id   = get_the_ID();
$slug      = get_post_field('post_name', $post_id);
$modal_id  = 'story-modal-' . $slug;

// Fields
$excerpt   = get_field('excerpt');
$img       = get_field('featured_image');

// Lightbox Content
$lightbox  = get_field('lightbox_content');
$media     = $lightbox['image_video_gallery'] ?? [];
$type      = $media['use_image_video_gallery'] ?? 'image';
$content   = $lightbox['content'] ?? [];
?>

<!-- Card -->
<div class="card flex flex-col rounded-2xl shadow-xl bg-white h-full overflow-hidden transition-all hover:shadow-2xl hover:-translate-y-1 group">

    <!-- Image Area -->
    <div class="h-64 relative">
        <a href="#<?php echo esc_attr($modal_id); ?>" class="block h-full w-full" data-fancybox="stories">
            <?php if ($img) : ?>
                <img class="object-cover h-full w-full transition-transform duration-500 group-hover:scale-105" src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
            <?php endif; ?>
        </a>

        <!-- Icon Overlay -->
        <div class="absolute bottom-0 right-0 -mb-10 mr-8 flex items-center justify-center h-20 w-20 bg-purple rounded-full p-3 z-10">
            <?php echo goodshep_icon( array( 'icon' => 'line-comment', 'group' => 'custom', 'size' => 48, 'class' => 'text-white' ) ); ?>
        </div>
    </div>

    <!-- Content Area -->
    <div class="pt-14 px-8 pb-8 flex flex-col flex-grow">
        <h3 class="text-2xl font-semibold mb-6 text-gray-900">
            <a href="#<?php echo esc_attr( $modal_id ); ?>" class="no-underline hover:text-purple transition-colors" data-fancybox="stories">
                <?php echo esc_html( $excerpt ? $excerpt : get_the_title() ); ?>
            </a>
        </h3>
        
        <div class="mt-auto">
            <a href="#<?php echo esc_attr( $modal_id ); ?>" class="text-red font-medium tracking-wider uppercase inline-flex items-center hover:text-red" data-fancybox="stories">
                <span>Learn More</span>
                <?php echo goodshep_icon( array( 'icon' => 'navigate-right', 'group' => 'utility', 'size' => 10, 'class' => 'inline-block fill-current text-red ml-1' ) ); ?>
            </a>
        </div>
    </div>

</div>

<!-- Hidden Modal Content -->
<div id="<?php echo esc_attr( $modal_id ); ?>" class="hidden w-full max-w-4xl p-0 rounded-xl overflow-hidden bg-white">
    
    <!-- Media Section -->
    <div class="aspect-video w-full bg-black relative">
        <?php if ( $type === 'image' && ! empty( $media['image'] ) ) : ?>
            <img src="<?php echo esc_url( $media['image']['url'] ); ?>" class="w-full h-full object-contain">
        
        <?php elseif ( $type === 'video' && ! empty( $media['video'] ) ) : ?>
            <div class="w-full h-full flex items-center justify-center text-white">
                <?php echo $media['video']; // Output embed code ?>
            </div>

        <?php elseif ( $type === 'gallery' && ! empty( $media['gallery'] ) ) : ?>
            <div class="swiper w-full h-full">
                <div class="swiper-wrapper">
                    <?php foreach ( $media['gallery'] as $slide_img ) : ?>
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url( $slide_img['url'] ); ?>" class="w-full h-full object-cover">
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev text-white"></div>
                <div class="swiper-button-next text-white"></div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Text Content -->
    <div class="p-8 lg:p-12 prose max-w-none">
        <h3 class="text-3xl font-bold text-red mb-4"><?php the_title(); ?></h3>

        <?php if (! empty($content['lead_text'])) : ?>
            <div class="text-lg font-medium text-gray-700 mb-6">
                <?php echo wp_kses_post($content['lead_text']); ?>
            </div>
        <?php endif; ?>

        <?php if (! empty($content['content_text'])) : ?>
            <div class="text-gray-600">
                <?php echo wp_kses_post($content['content_text']); ?>
            </div>
        <?php endif; ?>
    </div>

</div>