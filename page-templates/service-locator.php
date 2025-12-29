<?php
/**
 * Template Name: Service Locator
 *
 * @package      GoodShepherd
 */

// Enqueue Google Maps & MarkerClusterer
add_action('wp_footer', function() {
    $api_key = get_field('google_maps_api_key', 'option');
    if (!$api_key) {
        $api_key = 'AIzaSyDLizIQzcRNunD-P-YufBK-nS3mwl9V0As'; // Default from reference
    }
    echo '<script defer src="https://maps.googleapis.com/maps/api/js?key=' . esc_attr($api_key) . '&libraries=places,geometry"></script>';
    echo '<script src="https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js"></script>';
});

get_header();

$service_locator_banner = get_field('service_locator_banner', 'option');
$logo = $service_locator_banner['nils_logo']['logo'] ?? null;
$text = $service_locator_banner['nils_logo']['text'] ?? '';
$contacts = $service_locator_banner['contacts'] ?? [];
?>

<main id="primary" class="site-main service_locator">

    <!-- Banner -->
    <div class="service_locator_banner shadow-lg relative z-10" style="background-color: #feedfb; font-family: Arial, Helvetica, sans-serif;">
        <div class="flex flex-col xl:flex-row">
            <div class="logo_block bg-white w-full flex items-center py-8 xl:w-2/5 2xl:w-5/12 2xl:py-8">
                <div class="flex flex-col md:flex-row md:items-center md:divide-x md:divide-solid md:divide-gray-500 w-full">
                    <div class="px-4 md:px-6 md:block md:w-2/5 lg:w-1/3 xl:w-2/5 2xl:w-1/3 lg:px-8 xl:px-4 2xl:px-8">
                        <?php if ($logo) : ?>
                            <img class="nils-logo" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="px-4 pt-6 w-full md:w-3/5 md:px-6 md:py-2 lg:w-2/3 lg:px-8 xl:w-3/5 2xl:w-2/3 xl:px-4 2xl:px-8">
                        <div class="text-base leading-snug xl:text-sm 2xl:text-base text-black">
                            <?php echo wp_kses_post($text); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact_block w-full px-4 py-8 xl:w-3/5 lg:px-8 xl:px-4 xl:flex xl:items-center 2xl:w-7/12 2xl:pl-8 2xl:pr-12 2xl:py-8">
                <div class="flex flex-col gap-y-8 md:flex-row md:gap-y-0 md:gap-x-8 xl:gap-x-6 2xl:gap-x-10 w-full">
                    <?php
                    foreach ($contacts as $contact) {
                        $contact_image_url = $contact['contact_image']['url'] ?? '';
                        $contact_image_alt = $contact['contact_image']['alt'] ?? '';
                        $contact_text = $contact['contact_text'] ?? '';
                    ?>
                        <div class="contact_item flex gap-x-4 items-center md:w-1/3 md:flex-col lg:items-start lg:flex-row 2xl:items-start">
                            <?php if ($contact_image_url) : ?>
                                <div class="contact_image flex-none w-20 mx-auto md:text-center lg:flex-none lg:text-left">
                                    <img src="<?php echo esc_url($contact_image_url); ?>" alt="<?php echo esc_attr($contact_image_alt); ?>" />
                                </div>
                            <?php endif; ?>
                            <?php if ($contact_text) : ?>
                                <div class="text-base leading-snug md:text-center md:pt-4 lg:pt-0 lg:text-left xl:text-sm 2xl:text-base text-black">
                                    <?php echo wp_kses_post($contact_text); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Locator Content -->
    <section class="service_locator-wrap">
        <div class="service_locator-content flex">
            
            <div class="service_locator-sidebar">
                <div class="service_locator-form bg-red py-10 px-8">
                    <h5 class="text-white text-base font-bold mb-4"><?php _e('Find your nearest No Interest Loan provider', 'goodshep-theme'); ?></h5>
                    <div id="service_locator_form" class="relative">
                        
                        <!-- MDC Select -->
                        <div class="mdc-select mdc-select--filled mb-4 w-full">
                            <div class="mdc-select__anchor" role="button" aria-haspopup="listbox" aria-expanded="false" aria-labelledby="service-label select-service-selected-text">
                                <span class="mdc-select__ripple"></span>
                                <span id="service-label" class="mdc-floating-label">Select a service</span>
                                <span class="mdc-select__selected-text-container">
                                    <span id="select-service-selected-text" class="mdc-select__selected-text"></span>
                                </span>
                                <span class="mdc-select__dropdown-icon">
                                    <svg class="mdc-select__dropdown-icon-graphic" viewBox="7 10 10 5" focusable="false">
                                        <polygon class="mdc-select__dropdown-icon-inactive" stroke="none" fill-rule="evenodd" points="7 10 12 15 17 10"></polygon>
                                        <polygon class="mdc-select__dropdown-icon-active" stroke="none" fill-rule="evenodd" points="7 15 12 10 17 15"></polygon>
                                    </svg>
                                </span>
                                <span class="mdc-line-ripple"></span>
                            </div>

                            <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth">
                                <ul class="mdc-list" role="listbox" aria-label="Services listbox">
                                    <?php
                                    $taxonomies = get_terms(array(
                                        'taxonomy' => 'service_provider_category',
                                        'hide_empty' => false,
                                    ));
                                    if (!empty($taxonomies)) : ?>
                                        <li class="mdc-list-item mdc-list-item--selected" aria-selected="true" data-value="" role="option">
                                            <span class="mdc-list-item__ripple"></span>
                                            <span class="mdc-list-item__text"></span>
                                        </li>
                                        <?php foreach ($taxonomies as $category) { ?>
                                            <li class="mdc-list-item" aria-selected="false" data-value="<?php echo esc_attr($category->term_id); ?>" role="option">
                                                <span class="mdc-list-item__ripple"></span>
                                                <span class="mdc-list-item__text"><?php echo esc_html($category->name); ?></span>
                                            </li>
                                        <?php }
                                    endif; ?>
                                </ul>
                            </div>
                        </div>

                        <!-- MDC Text Field -->
                        <label class="mdc-text-field mdc-text-field--filled w-full">
                            <span class="mdc-text-field__ripple"></span>
                            <span class="mdc-floating-label" id="input_postcode-label">Enter your postcode or your suburb</span>
                            <input id="input-postcode" class="mdc-text-field__input" type="text" aria-labelledby="input_postcode-label" placeholder="">
                            <span class="mdc-line-ripple"></span>
                        </label>

                    </div>
                </div>

                <div class="service_locator-view-mode py-8 px-8 text-center">
                    <button id="view-as-list" class="inline-block font-semibold text-purple border border-purple rounded-l-lg py-3 px-5 active" type="button">View as List</button>
                    <button id="view-on-map" class="inline-block font-semibold text-purple border border-purple rounded-r-lg py-3 px-5" type="button">View on Map</button>
                </div>

                <!-- List & Progress Bar -->
                <div role="progressbar" id="provider-list-linear-progress" class="mdc-linear-progress mdc-linear-progress--indeterminate mdc-linear-progress--closed" aria-label="Progress Bar" aria-valuemin="0" aria-valuemax="1" aria-valuenow="0">
                    <div class="mdc-linear-progress__buffer">
                        <div class="mdc-linear-progress__buffer-bar"></div>
                        <div class="mdc-linear-progress__buffer-dots"></div>
                    </div>
                    <div class="mdc-linear-progress__bar mdc-linear-progress__primary-bar">
                        <span class="mdc-linear-progress__bar-inner"></span>
                    </div>
                    <div class="mdc-linear-progress__bar mdc-linear-progress__secondary-bar">
                        <span class="mdc-linear-progress__bar-inner"></span>
                    </div>
                </div>
                <div id="service_locator-info_bar" class="px-8 py-4 border-b text-base"></div>
                <div id="service_locator-list" class="overflow-y-auto"></div>

            </div>

            <!-- Map -->
            <div class="service_locator-map">
                <div id="services-map" class="h-full w-full"></div>
            </div>

        </div>

        <!-- Details Panel -->
        <div class="service_locator-details">
            <div class="service_locator-details_panel shadow-2xl">
                <div class="panel_header w-full absolute h-16 top-0 left-0 right-0 border-b bg-white z-10">
                    <button id="service_locator-close_panel" class="w-full px-8 py-4 leading-8 text-left whitespace-no-wrap focus:outline-none" type="button">
                        <?php echo goodshep_icon(array('icon' => 'navigate-right', 'group' => 'utility', 'size' => 10, 'class' => 'text-default fill-current transform rotate-180 inline-block mr-2')); ?>
                        <span class="inline-block font-semibold">Back to results</span>
                    </button>
                </div>
                
                <div role="progressbar" id="provider-details-linear-progress" class="mdc-linear-progress mdc-linear-progress--indeterminate mdc-linear-progress--closed" aria-label="Service Provider Details" aria-valuemin="0" aria-valuemax="1" aria-valuenow="0">
                    <div class="mdc-linear-progress__buffer">
                        <div class="mdc-linear-progress__buffer-bar"></div>
                        <div class="mdc-linear-progress__buffer-dots"></div>
                    </div>
                    <div class="mdc-linear-progress__bar mdc-linear-progress__primary-bar">
                        <span class="mdc-linear-progress__bar-inner"></span>
                    </div>
                    <div class="mdc-linear-progress__bar mdc-linear-progress__secondary-bar">
                        <span class="mdc-linear-progress__bar-inner"></span>
                    </div>
                </div>

                <div id="panel_content" class="panel_content w-full absolute overflow-y-auto"></div>
                <div id="panel_footer" class="panel_footer w-full absolute h-16 bottom-0 left-0 right-0 px-4 py-3 bg-off-white flex justify-center border-t border-gray-200"></div>
            </div>
            <div class="service_locator-details_overlay"></div>
        </div>

    </section>

</main>

<?php
get_footer();
