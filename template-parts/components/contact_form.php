<?php

/**
 * Component: Contact Form Block
 * Layout: contact_form
 */

$title     = get_sub_field('title');
$text      = get_sub_field('text');
$shortcode = get_sub_field('form_shortcode');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();

// Social Icons (Placeholder links per legacy reference)
// TODO: Connect these to Theme Settings options page
$socials = [
    'facebook'  => '#',
    'instagram' => '#',
    'twitter'   => '#',
    'youtube'   => '#',
];
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="container mx-auto px-4">

        <div class="grid md:grid-cols-2 gap-10 lg:gap-32">

            <!-- Left Column: Text & Socials -->
            <div class="mb-12 md:mb-0">

                <?php if ($title) : ?>
                    <h2 class="text-red-600 font-semibold text-3xl mb-6">
                        <?php echo esc_html($title); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="prose max-w-none mb-8 text-lg text-default">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                <?php endif; ?>

                <div class="flex space-x-4">
                    <?php foreach ($socials as $network => $url) : ?>
                        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer"
                            class="text-purple hover:text-gray-900 transition-colors"
                            aria-label="<?php echo esc_attr(ucfirst($network)); ?>">
                            <?php
                            echo goodshep_icon(array(
                                'icon'  => $network,
                                'group' => 'social',
                                'size'  => 30,
                                'class' => 'fill-current'
                            ));
                            ?>
                        </a>
                    <?php endforeach; ?>
                </div>

            </div>

            <!-- Right Column: Form -->
            <div class="w-full">
                <?php
                if ($shortcode) {
                    echo do_shortcode($shortcode);
                } elseif (is_user_logged_in()) {
                    echo '<p class="p-4 bg-gray-100 border border-dashed text-gray-500 text-center">Select a form in the editor to display it here.</p>';
                }
                ?>
            </div>

        </div>

    </div>
</section>