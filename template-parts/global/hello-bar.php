<?php
/**
 * Template part for displaying the Hello Bar (Announcement Bar)
 */

$hello_bar = get_field('hello_bar', 'option');

if (empty($hello_bar) || empty($hello_bar['set_active'])) {
    return;
}

$text_group = $hello_bar['hello_bar_text'] ?? [];
$heading = $text_group['heading'] ?? '';
$link = $text_group['link'] ?? '';

$settings = $hello_bar['hello_bar_settings'] ?? [];
$closeable = $settings['closeable'] ?? false;
$bg_color = $settings['background_color'] ?? '';
$text_color = $settings['text_color'] ?? '';

$style_attr = '';
if ($bg_color) {
    $style_attr .= "background-color: " . esc_attr($bg_color) . ";";
}
if ($text_color) {
    $style_attr .= "color: " . esc_attr($text_color) . ";";
}
?>

<div id="hello-bar" class="hello-bar hidden" style="<?php echo $style_attr; ?>">
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center justify-between gap-4">
            
            <div class="flex-grow text-center lg:text-left">
                <?php if ($heading): ?>
                    <span class="text-base font-medium">
                        <?php echo wp_kses_post($heading); ?>
                        
                        <?php if ($link): 
                            $link_url = $link['url'] ?? '#';
                            $link_title = $link['title'] ?? __('Learn more', 'goodshep-theme');
                            $link_target = $link['target'] ?? '_self';
                        ?>
                            <a href="<?php echo esc_url($link_url); ?>" 
                               target="<?php echo esc_attr($link_target); ?>" 
                               class="underline hover:no-underline ml-2 font-bold"
                               style="<?php echo $text_color ? 'color:' . esc_attr($text_color) : ''; ?>">
                                <?php echo esc_html($link_title); ?>
                            </a>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>
            </div>

            <?php if ($closeable): ?>
                <button id="close-hello-bar" class="flex-none focus:outline-none opacity-80 hover:opacity-100 transition-opacity" aria-label="<?php esc_attr_e('Close notification', 'goodshep-theme'); ?>">
                    <?php echo goodshep_icon(array('icon' => 'close', 'group' => 'utility', 'class' => 'w-4 h-4 fill-current')); ?>
                </button>
            <?php endif; ?>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const helloBar = document.getElementById('hello-bar');
    const closeBtn = document.getElementById('close-hello-bar');
    
    if (helloBar) {
        // Check session storage
        if (sessionStorage.getItem('goodshep_hello_bar_closed') !== 'true') {
            helloBar.classList.remove('hidden');
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                helloBar.classList.add('hidden');
                sessionStorage.setItem('goodshep_hello_bar_closed', 'true');
            });
        }
    }
});
</script>