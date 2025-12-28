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
    const searchToggle = document.getElementById('search-toggle');
    const searchFormContainer = document.getElementById('header-search-form');
    
    if (searchToggle && searchFormContainer) {
        const searchIcon = searchToggle.querySelector('.search-icon');
        const closeIcon = searchToggle.querySelector('.close-icon');
        const searchInput = searchFormContainer.querySelector('input.search-field');

        const toggleSearch = (show) => {
            const isShowing = show !== undefined ? show : searchFormContainer.classList.contains('hidden');
            
            if (isShowing) {
                // Show
                searchFormContainer.classList.remove('hidden');
                searchToggle.setAttribute('aria-expanded', 'true');
                searchIcon?.classList.add('hidden');
                closeIcon?.classList.remove('hidden');
                if (searchInput) {
                    setTimeout(() => searchInput.focus(), 50);
                }
            } else {
                // Hide
                searchFormContainer.classList.add('hidden');
                searchToggle.setAttribute('aria-expanded', 'false');
                searchIcon?.classList.remove('hidden');
                closeIcon?.classList.add('hidden');
            }
        };

        // Click Handler
        searchToggle.addEventListener('click', (e) => {
            e.preventDefault();
            toggleSearch();
        });

        // Close on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !searchFormContainer.classList.contains('hidden')) {
                toggleSearch(false);
                searchToggle.focus();
            }
        });

        // Close on Click Outside
        document.addEventListener('click', (e) => {
            if (!searchFormContainer.classList.contains('hidden') && 
                !searchFormContainer.contains(e.target) && 
                !searchToggle.contains(e.target)) {
                toggleSearch(false);
            }
        });
    }
});

console.log('Main JS Loaded');