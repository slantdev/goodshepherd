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

$info_boxes_groups = get_sub_field('info_boxes') ?? [];

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
            foreach ($info_boxes_groups as $group) : 
                $filter_slug = $group['assigned_filter_slug'] ?? '';
                $boxes = $group['info_box'] ?? [];
                
                foreach ($boxes as $box) :
                    $icon = $box['icon'] ?? '';
                    $icon_color = $box['icon_color'] ?? '#002F56';
                    $title = $box['title'] ?? '';
                    $desc = $box['description'] ?? '';
                    $link = $box['button_link'] ?? null;
            ?>
                <div class="js-featured-filter-item flex flex-col h-full bg-white rounded-xl shadow-lg p-8 border border-gray-100 transition-all duration-300" 
                     data-category="<?php echo esc_attr($filter_slug); ?>">
                    
                    <?php if ($icon) : ?>
                        <div class="mb-6 w-12 h-12 flex items-center justify-center rounded-lg" style="background-color: <?php echo esc_attr($icon_color); ?>20;">
                            <?php echo goodshep_icon(array('icon' => $icon, 'group' => 'custom', 'class' => 'w-8 h-8 fill-current', 'style' => "color: {$icon_color};")); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($title) : ?>
                        <h3 class="text-xl font-bold mb-4 text-gray-900"><?php echo esc_html($title); ?></h3>
                    <?php endif; ?>

                    <?php if ($desc) : ?>
                        <div class="text-base leading-relaxed text-gray-600 mb-6 grow">
                            <?php echo wp_kses_post($desc); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($link) : ?>
                        <div class="mt-auto">
                            <a href="<?php echo esc_url($link['url']); ?>" 
                               target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
                               class="inline-flex items-center text-red font-semibold uppercase tracking-wider text-sm hover:underline">
                                <span><?php echo esc_html($link['title']); ?></span>
                                <?php echo goodshep_icon(array('icon' => 'navigate-right', 'group' => 'utility', 'class' => 'w-3 h-3 ml-2 fill-current')); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php 
                endforeach; 
            endforeach; 
            ?>
        </div>

    </div>
</section>