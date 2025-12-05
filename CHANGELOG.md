# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
