<?php
/**
 * Component: Featured with Filter
 * Layout: featured_with_filter
 */

$intro = get_sub_field('section_intro');
$headline = $intro['headline'] ?? '';
$description = $intro['description'] ?? '';

$filter_group = get_sub_field('filters');
$enable_filter = $filter_group['enable_filter'] ?? false;
$filters = $filter_group['filters'] ?? [];

// Updated repeater name to 'featured_content'
$featured_content_groups = get_sub_field('featured_content') ?? [];

// Wrapper Attributes
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes('relative');
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?> js-featured-filter-section" style="<?php echo esc_attr($bg_style); ?>">
    <div class="container mx-auto px-4">

        <!-- Intro Content -->
        <?php if ($headline || $description) : ?>
            <div class="max-w-3xl mb-12">
                <?php if ($headline) : ?>
                    <h2 class="text-3xl lg:text-4xl font-semibold mb-6"><?php echo esc_html($headline); ?></h2>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <div class="prose max-w-none text-lg leading-relaxed text-default">
                        <?php echo wp_kses_post($description); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Filters -->
        <?php if ($enable_filter && !empty($filters)) : ?>
            <div class="mb-12 flex flex-wrap gap-4 border-b border-gray-200 pb-6">
                <button type="button" 
                        class="js-featured-filter-btn px-6 py-2 rounded-full border border-purple bg-purple text-white text-base font-semibold transition-colors hover:bg-purple-700 active" 
                        data-filter="all">
                    <?php _e('All', 'goodshep-theme'); ?>
                </button>
                <?php foreach ($filters as $f) : 
                    $f_text = $f['filter_text'] ?? '';
                    $f_slug = $f['filter_slug'] ?? '';
                    if (!$f_text) continue;
                ?>
                    <button type="button" 
                            class="js-featured-filter-btn px-6 py-2 rounded-full border border-purple text-purple text-base font-semibold transition-colors hover:bg-purple hover:text-white" 
                            data-filter="<?php echo esc_attr($f_slug); ?>">
                        <?php echo esc_html($f_text); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Items Grid -->
        <div class="featured-filter-grid grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php 
            foreach ($featured_content_groups as $group) : 
                $filter_slug = $group['assigned_filter_slug'] ?? '';
                $posts = $group['content_cards'] ?? []; // Relationship field
                
                if ($posts) :
                    foreach ($posts as $post_obj) :
                        $p_id = $post_obj->ID;
                        $p_title = get_the_title($p_id);
                        $p_link = get_permalink($p_id);
                        $p_excerpt = get_the_excerpt($p_id);
                        $p_thumb = get_the_post_thumbnail_url($p_id, 'large');
            ?>
                <div class="js-featured-filter-item flex flex-col h-full bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 transition-all duration-300 group" 
                     data-category="<?php echo esc_attr($filter_slug); ?>">
                    
                    <!-- Image -->
                    <div class="relative h-56 overflow-hidden">
                        <?php if ($p_thumb) : ?>
                            <img src="<?php echo esc_url($p_thumb); ?>" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                                 alt="<?php echo esc_attr($p_title); ?>">
                        <?php else : ?>
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-300">
                                <?php echo goodshep_icon(['icon' => 'search', 'class' => 'w-12 h-12']); // Fallback icon ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Content -->
                    <div class="p-8 flex flex-col grow">
                        <h3 class="text-xl font-bold mb-4 text-gray-900 group-hover:text-purple transition-colors">
                            <a href="<?php echo esc_url($p_link); ?>" class="no-underline">
                                <?php echo esc_html($p_title); ?>
                            </a>
                        </h3>

                        <?php if ($p_excerpt) : ?>
                            <div class="text-base leading-relaxed text-gray-600 mb-6 grow line-clamp-3">
                                <?php echo wp_kses_post($p_excerpt); ?>
                            </div>
                        <?php endif; ?>

                        <div class="mt-auto">
                            <a href="<?php echo esc_url($p_link); ?>" 
                               class="inline-flex items-center text-red font-bold uppercase tracking-wider text-xs hover:underline">
                                <span><?php _e('Learn More', 'goodshep-theme'); ?></span>
                                <?php echo goodshep_icon(array('icon' => 'navigate-right', 'group' => 'utility', 'class' => 'w-3 h-3 ml-2 fill-current')); ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php 
                    endforeach; 
                endif;
            endforeach; 
            ?>
        </div>

    </div>
</section>