# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
