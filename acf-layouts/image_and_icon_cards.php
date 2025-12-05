<?php
/*
 * https://www.acf-extended.com/features/fields/flexible-content
 *
 * @array   $layout Layout settings (without values)
 * @array   $field Flexible content field settings
 * @bool    $is_preview True during AJAX preview
 */

?>

<div class="acf-layout px-12 <?php echo ($is_preview) ? 'is-preview' : ''; ?>">

    <?php display_photo_and_icon_cards(get_photo_and_icon_cards_content()); ?>

</div>