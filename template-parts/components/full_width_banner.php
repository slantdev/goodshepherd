<?php

/**
 * Component: Full Width Banner
 * Layout: full_width_banner
 */

$content_group = get_sub_field('content');
$heading       = $content_group['heading'] ?? '';
$description   = $content_group['description'] ?? '';
$text_color    = $content_group['text_color'] ?? '';
$button        = $content_group['button'] ?? [];

$btn_link  = $button['button_link'] ?? [];
$btn_color = $button['button_color'] ?? 'primary';

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();

// Custom Text Color override
$text_style = $text_color ? "color: {$text_color};" : '';
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style . $text_style); ?>">
    <div class="container mx-auto px-4">

        <div class="flex py-10 lg:py-20">
            <div class="w-full md:w-1/2 lg:w-3/5">
                <div class="lg:max-w-prose">

                    <?php if ($heading) : ?>
                        <h3 class="font-medium text-3xl lg:text-4xl xl:text-5xl leading-tight mb-6 text-inherit">
                            <?php echo esc_html($heading); ?>
                        </h3>
                    <?php endif; ?>

                    <?php if ($description) : ?>
                        <div class="text-lg lg:text-xl leading-relaxed mb-8 text-inherit opacity-90">
                            <?php echo wp_kses_post($description); ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    if (! empty($btn_link['url'])) :
                        $url    = $btn_link['url'];
                        $target = $btn_link['target'] ?: '_self';
                        $title  = $btn_link['title'];

                        // Button Style
                        $btn_class = ( $btn_color === 'secondary' ) 
                            ? 'bg-transparent border-2 border-current text-inherit hover:opacity-80' 
                            : 'bg-red text-white border-2 border-transparent hover:opacity-90';
                    ?>
                        <div>
                            <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>"
                                class="inline-block py-3 px-8 rounded font-bold transition-opacity no-underline <?php echo esc_attr($btn_class); ?>">
                                <?php echo esc_html($title); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
</section>