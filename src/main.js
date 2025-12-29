import './style.css';
import './css/global.css';
import './css/components.css';

// Import Fancybox
import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

// Import Swiper
import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// Initialize Fancybox
Fancybox.bind("[data-fancybox]", {
  // Your custom options
});

// Initialize Swiper
document.addEventListener('DOMContentLoaded', () => {
    // Swiper
    const swipers = document.querySelectorAll('.swiper');
    swipers.forEach(el => {
        new Swiper(el, {
            modules: [Navigation, Pagination],
            loop: true,
            pagination: {
                el: el.querySelector('.swiper-pagination'),
                clickable: true,
            },
            navigation: {
                nextEl: el.querySelector('.swiper-button-next'),
                prevEl: el.querySelector('.swiper-button-prev'),
            },
        });
    });

    // Search Toggle Logic
    const searchToggles = document.querySelectorAll('.js-search-toggle');
    const searchFormContainer = document.getElementById('header-search-form');
    
    if (searchToggles.length > 0 && searchFormContainer) {
        const searchInput = searchFormContainer.querySelector('input.search-field');

        const toggleSearch = (show) => {
            const isShowing = show !== undefined ? show : searchFormContainer.classList.contains('hidden');
            
            if (isShowing) {
                // Show
                searchFormContainer.classList.remove('hidden');
                
                // Update all toggles
                searchToggles.forEach(btn => {
                    btn.setAttribute('aria-expanded', 'true');
                    btn.querySelector('.search-icon')?.classList.add('hidden');
                    btn.querySelector('.close-icon')?.classList.remove('hidden');
                });

                if (searchInput) {
                    setTimeout(() => searchInput.focus(), 50);
                }
            } else {
                // Hide
                searchFormContainer.classList.add('hidden');
                
                // Update all toggles
                searchToggles.forEach(btn => {
                    btn.setAttribute('aria-expanded', 'false');
                    btn.querySelector('.search-icon')?.classList.remove('hidden');
                    btn.querySelector('.close-icon')?.classList.add('hidden');
                });
            }
        };

        // Click Handler for all toggles
        searchToggles.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                toggleSearch();
            });
        });

        // Close on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !searchFormContainer.classList.contains('hidden')) {
                toggleSearch(false);
                // Focus the first visible toggle button
                const visibleToggle = Array.from(searchToggles).find(btn => btn.offsetParent !== null);
                if (visibleToggle) visibleToggle.focus();
            }
        });

        // Close on Click Outside
        document.addEventListener('click', (e) => {
            if (!searchFormContainer.classList.contains('hidden') && 
                !searchFormContainer.contains(e.target)) {
                
                // Check if the click target is NOT one of the toggle buttons
                let isToggleClick = false;
                searchToggles.forEach(btn => {
                    if (btn.contains(e.target)) isToggleClick = true;
                });

                if (!isToggleClick) {
                    toggleSearch(false);
                }
            }
        });
    }

    // Mobile Menu Drawer Logic
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const mobileMenuDrawer = document.getElementById('mobile-menu-drawer');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

    if (mobileMenuToggle && mobileMenuDrawer && mobileMenuOverlay) {
        const openMenu = () => {
            mobileMenuDrawer.classList.remove('translate-x-full');
            mobileMenuOverlay.classList.remove('hidden');
            // Small delay to allow display:block to apply before opacity transition
            setTimeout(() => {
                mobileMenuOverlay.classList.remove('opacity-0');
            }, 10);
            document.body.style.overflow = 'hidden'; // Prevent scrolling
            mobileMenuToggle.setAttribute('aria-expanded', 'true');
        };

        const closeMenu = () => {
            mobileMenuDrawer.classList.add('translate-x-full');
            mobileMenuOverlay.classList.add('opacity-0');
            setTimeout(() => {
                mobileMenuOverlay.classList.add('hidden');
            }, 300); // Match transition duration
            document.body.style.overflow = '';
            mobileMenuToggle.setAttribute('aria-expanded', 'false');
        };

        mobileMenuToggle.addEventListener('click', (e) => {
            e.preventDefault();
            openMenu();
        });

        if (mobileMenuClose) {
            mobileMenuClose.addEventListener('click', (e) => {
                e.preventDefault();
                closeMenu();
            });
        }

        mobileMenuOverlay.addEventListener('click', closeMenu);

        // Accordion Logic
        const accordionToggles = mobileMenuDrawer.querySelectorAll('.js-mobile-accordion-toggle');
        accordionToggles.forEach(toggle => {
            toggle.addEventListener('click', (e) => {
                e.preventDefault();
                const parentLi = toggle.closest('li');
                const submenu = parentLi.querySelector('ul');
                const isExpanded = toggle.getAttribute('aria-expanded') === 'true';

                if (isExpanded) {
                    // Collapse
                    submenu.classList.add('hidden');
                    toggle.classList.remove('rotate-180');
                    toggle.setAttribute('aria-expanded', 'false');
                } else {
                    // Expand
                    submenu.classList.remove('hidden');
                    toggle.classList.add('rotate-180');
                    toggle.setAttribute('aria-expanded', 'true');
                }
            });
        });
    }

    // Page Anchor Dropdown Logic (Floating Label Style)
    const anchorSelects = document.querySelectorAll('.js-anchor-select');
    anchorSelects.forEach(select => {
        const trigger = select.querySelector('.js-anchor-select-trigger');
        const dropdown = select.querySelector('.js-anchor-select-dropdown');
        const label = select.querySelector('.js-anchor-label');
        const selectedText = select.querySelector('.js-anchor-selected-text');
        const icon = trigger.querySelector('svg');
        const items = select.querySelectorAll('.js-anchor-item');
        let hasSelection = false;

        const updateLabelState = (isOpen) => {
            if (isOpen || hasSelection) {
                // Float Label (Top Left, Small)
                label.classList.remove('top-1/2', '-translate-y-1/2', 'scale-100');
                label.classList.add('top-2', 'scale-75', 'translate-y-0');
            } else {
                // Center Label (Default)
                label.classList.add('top-1/2', '-translate-y-1/2', 'scale-100');
                label.classList.remove('top-2', 'scale-75', 'translate-y-0');
            }
        };

        const toggleDropdown = (open) => {
            const isOpen = open !== undefined ? open : dropdown.classList.contains('hidden');
            
            if (isOpen) {
                // Open
                dropdown.classList.remove('hidden');
                setTimeout(() => dropdown.classList.remove('opacity-0'), 10);
                trigger.setAttribute('aria-expanded', 'true');
                icon.classList.add('rotate-180');
                updateLabelState(true);
            } else {
                // Close
                dropdown.classList.add('opacity-0');
                setTimeout(() => dropdown.classList.add('hidden'), 200);
                trigger.setAttribute('aria-expanded', 'false');
                icon.classList.remove('rotate-180');
                updateLabelState(false);
            }
        };

        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            toggleDropdown();
        });

        items.forEach(item => {
            item.addEventListener('click', (e) => {
                // Set text and state
                selectedText.textContent = item.textContent.trim();
                selectedText.classList.remove('opacity-0');
                hasSelection = true;
                toggleDropdown(false);
            });
        });

        // Close on click outside
        document.addEventListener('click', (e) => {
            if (!select.contains(e.target)) {
                toggleDropdown(false);
            }
        });
        
        // Initial state check (in case browser preserved state, though unlikely on reload)
        // Ensure label starts centered
        label.classList.add('top-1/2', '-translate-y-1/2', 'scale-100');
    });
});

console.log('Main JS Loaded');