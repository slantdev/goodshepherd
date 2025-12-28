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
});

console.log('Main JS Loaded');