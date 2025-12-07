<?php
/**
 * Component: Three Card CTA
 * Layout: three_card_cta
 */

$title = get_sub_field('title');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();

// Construct cards array from flat fields
$cards = [];
for ( $i = 1; $i <= 3; $i++ ) {
    $num = str_pad( $i, 2, '0', STR_PAD_LEFT );
    $cards[] = [
        'img'   => get_sub_field( "card_{$num}_image_source" ),
        'title' => get_sub_field( "card_{$num}_title" ),
        'text'  => get_sub_field( "card_{$num}_text" ),
    ];
}
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <?php if ( $title ) : ?>
            <h2 class="text-3xl lg:text-4xl font-semibold text-red mb-8"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <div class="grid md:grid-cols-3 gap-8 md:gap-0 md:divide-x divide-gray-200">
            <?php foreach ( $cards as $card ) : 
                if ( $card['title'] || $card['text'] ) :
            ?>
                <div class="flex flex-col lg:flex-row items-start py-4 md:px-8 first:pl-0 last:pr-0">
                    
                    <?php if ( $card['img'] ) : ?>
                        <div class="flex-none w-14 h-14 mr-4 lg:mr-8 mb-4 lg:mb-0">
                            <?php 
                            if ( is_array( $card['img'] ) && isset( $card['img']['ID'] ) ) {
                                echo wp_get_attachment_image( $card['img']['ID'], 'medium', false, array( 'class' => 'w-full h-full object-contain' ) );
                            } elseif ( is_numeric( $card['img'] ) ) {
                                echo wp_get_attachment_image( $card['img'], 'medium', false, array( 'class' => 'w-full h-full object-contain' ) );
                            } elseif ( is_string( $card['img'] ) ) {
                                echo '<img src="' . esc_url( $card['img'] ) . '" class="w-full h-full object-contain" alt="">';
                            }
                            ?>
                        </div>
                    <?php endif; ?>

                    <div class="grow">
                        <?php if ( $card['title'] ) : ?>
                            <h3 class="text-2xl font-semibold mb-2"><?php echo esc_html( $card['title'] ); ?></h3>
                        <?php endif; ?>

                        <?php if ( $card['text'] ) : ?>
                            <div class="prose max-w-none text-gray-600">
                                <?php echo wp_kses_post( $card['text'] ); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endif; endforeach; ?>
        </div>

    </div>
</section>