# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.2.10] - 2025-12-26

### Added
- **Navigation:** Implemented standard dropdown menu support alongside the mega menu.
    - Added dynamic `relative`/`static` positioning logic to parent menu items based on submenu type.
    - Configured dropdowns with dynamic width (`min-w-full`) and horizontal scrolling prevention (`whitespace-nowrap`).

## [2.2.9] - 2025-12-26

### Added
- **Mega Menu:** Implemented accessible, full-width mega menu navigation in `template-parts/global/site-navigation.php`.
    - Utilized Tailwind `group` utilities for hover and focus states.
    - Added ARIA attributes for better accessibility.
    - Configured dynamic column layout via ACF repeater fields.
    - Added support for `link-image` submenu type with grid layout and hover effects.

## [2.2.8] - 2025-12-26

### Fixed
- **Dev Environment:** Fixed Vite dev server connection timeout issues by implementing dynamic local IP detection.
    - Added `write-hot-file` plugin to `vite.config.js` to generate a `hot` file containing the correct dev server URL.
    - Updated `inc/enqueues.php` to read the `hot` file, ensuring assets load correctly regardless of `wp-config.php` constants.
    - Added `hot` to `.gitignore`.

## [2.2.7] - 2025-11-29

### Added
- **Typography:** Enqueued Google Fonts (Poppins and Roboto).
- **Tailwind Plugin:** Installed and configured `@tailwindcss/typography` for prose styling.
- **Helper:** Added `preint_r()` debug function (admin-only) to `inc/template-tags.php`.

### Changed
- **Code Style:** Applied Tailwind v4 canonical class names (e.g., `shrink-0` instead of `flex-shrink-0`) and custom theme color classes across all components.

## [2.2.6] - 2025-11-29

### Added
- **Dependencies:** Installed `swiper` and `@fancyapps/ui` via npm for Sliders and Lightboxes.
- **AJAX Handlers:** Implemented `inc/ajax-handlers.php` to handle filtering and pagination for Client Stories.
- **Helpers:** Created `inc/template-tags.php` with:
    - `goodshep_icon()`: Retrieving SVGs from `assets/icons/`.
    - `goodshep_get_block_classes()`: Global block styling helper.
    - `goodshep_slugify()`, `goodshep_get_section_id()`, `goodshep_get_bg_image_style()`.

### Changed
- **Refactor:** Ported and modernized the following components from reference code:
    - `accordion`: Converted to native `<details>`/`<summary>`.
    - `accredited_box`: Cleaned up logic and styles.
    - `buttons`: Modernized loops and inline styles.
    - `client_stories`: Full rewrite using `WP_Query`, AJAX filtering support, and extracted `client_stories_item` template part.
    - `color_text_block_with_image`: Implemented split-screen grid layout with dynamic ordering.
    - `color_text_block`: Refactored text-only layout.
    - `contact_details_cards`: Implemented grid layout with nested repeater for details.
    - `contact_form`: Implemented grid layout with social icons and form shortcode support.
    - `cta_with_image`: Refactored flex layout for image/text split.
    - `donate_now_form`: Refactored centered form container with shadow.
    - `download_pdf_block`: Implemented flexible layout for PDF downloads with icon.
    - `four_card_block`: Implemented 4-column grid with floating icons.
    - `four_logos_block`: Refactored to use `object-contain` for logos in a grid.
    - `frequently_asked_questions`: Implemented FAQ accordion/grid with icon.
    - `full_black_image`: Implemented dark section with background image support.
    - `full_text`: Refactored text block with alignment and width options.
    - `full_width_banner`: Implemented hero banner with optional button.
    - `gallery_block_01`: Refactored grid gallery with info box.
    - `gallery_block_02`: Implemented split gallery with thumbnails and main image.
    - `gallery_slider`: Replaced Splide with Swiper.js implementation.
    - `good_money_application`: Refactored complex stacked CTA and Tick block.
    - `html_block`: Created simple raw HTML output component.
    - `icon_block_cards`: Implemented grid of cards with top-left icons.
    - `image_and_icon_cards`: Refactored image cards with overlay icons.
    - `key_contacts`: Implemented grid of contact cards with image and details.
    - `loan_comparison_cards`: Refactored complex comparison table/card layout.
    - `news_archive`: Implemented latest posts grid with category filter support.
    - `our_board`: Refactored board member grid.
    - `page_form`: Implemented form container with side decoration.
    - `people_blocks`: Implemented dynamic layout switching (CEO/Board/List) based on taxonomy.
    - `rectangle_color_block`: Refactored colored content block.
    - `shortcut_blocks`: Implemented shortcut navigation grid.
    - `small_photo_cards`: Refactored image-top cards.
    - `solid_color_cta`: Implemented colored CTA strip.
    - `step_block_cards`: Implemented numbered step process grid.
    - `subscribe_to_newsletter`: Refactored newsletter block with decorative elements.
    - `testimonial_cards`: Implemented testimonial grid with circular images and color mapping.
    - `text_and_image`: Refactored standard text/image split block.
    - `text_and_logo_block`: Implemented flex layout for text and logo row.
    - `text_block_cards`: Refactored simple text card grid.
    - `text_with_large_quotes`: Implemented text block with featured quote style.
    - `three_card_cta`: Refactored 3-column CTA strip.
    - `tick_block`: Implemented content block with tick-list feature.
    - `twitter_feed`: Implemented shortcode wrapper for Twitter.
    - `two_card_block`: Implemented 2-column feature grid.
    - `two_line_cta`: Refactored horizontal CTA strip.
    - `video_block`: Implemented responsive video grid (1-3 cols) with oEmbed support.
    - `wide_text_and_image`: Refactored wide variation of text/image block.
- **Assets:** Integrated global Fancybox and Swiper initialization in `src/main.js`.
- **Git:** Temporarily ignored `assets/images/` to prevent large binary push failures.

## [2.2.5] - 2025-11-29

### Added
- **Page Builder:** Implemented a dynamic component loader (`inc/page-builder.php`) to handle ACF Flexible Content layouts.
- **Components:** Generated placeholder template parts for 47 ACF layouts in `template-parts/components/`.
- **Page Template:** Updated `page.php` to render the Page Builder components automatically.

### Changed
- **Code Quality:** Alphabetized the ACF layout array in `inc/acf.php` for better maintainability.

## [2.2.4] - 2025-11-29

### Security
- **Sensitive Data:** Removed hardcoded Google Maps API key from `inc/acf.php`. The key must now be defined in `wp-config.php` via the `GOOGLE_MAPS_API_KEY` constant or set in the Theme Settings options page.

## [2.2.3] - 2025-11-29

### Added
- **ACF Configuration:** Created `inc/acf.php` to manage ACF settings.
    - Added **Theme Settings** options page (Header/Footer).
    - Configured **Local JSON** sync point to `acf-json/`.
    - Added **ACF Extended Layout Thumbnails** logic with a streamlined dynamic filter.
    - Implemented Google Maps API key filter with fallback/constant support.
- **Assets:** Included `assets/acf-layouts/` images for flexible content previews.
- **Data:** Included `acf-json/` files for field group synchronization.

## [2.2.2] - 2025-11-29

### Added
- **Custom Post Types:** Registered `Services`, `Service Provider`, `Jobs`, `Media Coverage`, `Publications`, `Events`, and `People` CPTs.
- **Taxonomies:** Registered associated taxonomies for CPTs, including `service_category`, `department`, `publications_type`, etc.
- **Refactor:** Created `inc/post-types.php` with helper functions (`goodshep_register_cpt`, `goodshep_register_tax`) to streamline CPT registration.
- **Fix:** Implemented `goodshep_generate_taxonomy_rewrite_rules` to resolve pagination 404 errors for taxonomies sharing CPT slugs.

## [2.2.1] - 2025-11-29

### Fixed
- **Dev Server:** Enabled network access (`host: true`) and configured CORS to allow external device testing (e.g., mobile).
- **Header Template:** Refactored `template-parts/global/site-header.php` to remove inline PHP functions and improve readability.

### Changed
- **Versioning:** Established policy to update `style.css` version on every changelog entry.
- **Documentation:** Updated `GEMINI.md` with the new versioning rule.

## [2.2.0] - 2025-11-29

### Changed
- **Refactor:** Implemented a modular file structure.
    - Moved PHP logic from `functions.php` to `inc/` directory (`setup.php`, `enqueues.php`).
    - Established separate directories for `page-templates` and `template-parts` (global, content, components).
- **Clean Code:** `functions.php` now acts solely as a loader for the `inc/` modules.

## [2.1.1] - 2025-11-29

### Fixed
- **Dev Proxy:** Resolved BrowserSync infinite redirect loops by enforcing HTTP on port 3005.
- **Asset Enqueueing:** Updated `functions.php` to correctly switch between Vite Dev Server (HMR) and production assets.

### Changed
- **Tech Stack:** Added jQuery support to `functions.php` and documentation.
- **Version Control:** Removed `assets/` from `.gitignore` to allow tracking of built files.

## [2.1.0] - 2025-11-29

### Added
- **Build Tooling:** Initialized Vite v7 environment with Tailwind CSS v4.
- **Live Reload:** Integrated `browser-sync` to proxy local WordPress site (`https://goodshep2025.local`) and watch PHP files.
- **Documentation:** Added `GEMINI.md` for AI context and project guidelines.
- **Dependencies:** Added `vite-plugin-browser-sync` (later replaced with direct `browser-sync` config for better control).

### Changed
- **Architecture:** Complete theme remake (Version 2).
- **Build Output:** Configured Vite to output assets to `assets/css/` and `assets/js/` instead of default `dist/`.
- **Asset Management:** Switched from standard WordPress enqueueing to Vite-bundled asset generation.
