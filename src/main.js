import "./style.css";
import "./css/global.css";
import "./css/components.css";

// Import Fancybox
import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

// Import Swiper
import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

import { initTimeline } from './js/page-timeline.js';
import { initServiceLocator } from './js/page-service-locator.js';

// Initialize Fancybox
Fancybox.bind("[data-fancybox]", {
  // Your custom options
});

// Initialize Swiper
document.addEventListener('DOMContentLoaded', () => {
    // Timeline
    initTimeline();
    
    // Service Locator
    initServiceLocator();

    // Swiper
    const swipers = document.querySelectorAll('.swiper');
  swipers.forEach((el) => {
    new Swiper(el, {
      modules: [Navigation, Pagination],
      loop: true,
      pagination: {
        el: el.querySelector(".swiper-pagination"),
        clickable: true,
      },
      navigation: {
        nextEl: el.querySelector(".swiper-button-next"),
        prevEl: el.querySelector(".swiper-button-prev"),
      },
    });
  });

  // Search Toggle Logic
  const searchToggles = document.querySelectorAll(".js-search-toggle");
  const searchFormContainer = document.getElementById("header-search-form");

  if (searchToggles.length > 0 && searchFormContainer) {
    const searchInput = searchFormContainer.querySelector("input.search-field");

    const toggleSearch = (show) => {
      const isShowing =
        show !== undefined
          ? show
          : searchFormContainer.classList.contains("hidden");

      if (isShowing) {
        // Show
        searchFormContainer.classList.remove("hidden");

        // Update all toggles
        searchToggles.forEach((btn) => {
          btn.setAttribute("aria-expanded", "true");
          btn.querySelector(".search-icon")?.classList.add("hidden");
          btn.querySelector(".close-icon")?.classList.remove("hidden");
        });

        if (searchInput) {
          setTimeout(() => searchInput.focus(), 50);
        }
      } else {
        // Hide
        searchFormContainer.classList.add("hidden");

        // Update all toggles
        searchToggles.forEach((btn) => {
          btn.setAttribute("aria-expanded", "false");
          btn.querySelector(".search-icon")?.classList.remove("hidden");
          btn.querySelector(".close-icon")?.classList.add("hidden");
        });
      }
    };

    // Click Handler for all toggles
    searchToggles.forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        toggleSearch();
      });
    });

    // Close on Escape
    document.addEventListener("keydown", (e) => {
      if (
        e.key === "Escape" &&
        !searchFormContainer.classList.contains("hidden")
      ) {
        toggleSearch(false);
        // Focus the first visible toggle button
        const visibleToggle = Array.from(searchToggles).find(
          (btn) => btn.offsetParent !== null
        );
        if (visibleToggle) visibleToggle.focus();
      }
    });

    // Close on Click Outside
    document.addEventListener("click", (e) => {
      if (
        !searchFormContainer.classList.contains("hidden") &&
        !searchFormContainer.contains(e.target)
      ) {
        // Check if the click target is NOT one of the toggle buttons
        let isToggleClick = false;
        searchToggles.forEach((btn) => {
          if (btn.contains(e.target)) isToggleClick = true;
        });

        if (!isToggleClick) {
          toggleSearch(false);
        }
      }
    });
  }

  // Mobile Menu Drawer Logic
  const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
  const mobileMenuClose = document.getElementById("mobile-menu-close");
  const mobileMenuDrawer = document.getElementById("mobile-menu-drawer");
  const mobileMenuOverlay = document.getElementById("mobile-menu-overlay");

  if (mobileMenuToggle && mobileMenuDrawer && mobileMenuOverlay) {
    const openMenu = () => {
      mobileMenuDrawer.classList.remove("translate-x-full");
      mobileMenuOverlay.classList.remove("hidden");
      // Small delay to allow display:block to apply before opacity transition
      setTimeout(() => {
        mobileMenuOverlay.classList.remove("opacity-0");
      }, 10);
      document.body.style.overflow = "hidden"; // Prevent scrolling
      mobileMenuToggle.setAttribute("aria-expanded", "true");
    };

    const closeMenu = () => {
      mobileMenuDrawer.classList.add("translate-x-full");
      mobileMenuOverlay.classList.add("opacity-0");
      setTimeout(() => {
        mobileMenuOverlay.classList.add("hidden");
      }, 300); // Match transition duration
      document.body.style.overflow = "";
      mobileMenuToggle.setAttribute("aria-expanded", "false");
    };

    mobileMenuToggle.addEventListener("click", (e) => {
      e.preventDefault();
      openMenu();
    });

    if (mobileMenuClose) {
      mobileMenuClose.addEventListener("click", (e) => {
        e.preventDefault();
        closeMenu();
      });
    }

    mobileMenuOverlay.addEventListener("click", closeMenu);

    // Accordion Logic
    const accordionToggles = mobileMenuDrawer.querySelectorAll(
      ".js-mobile-accordion-toggle"
    );
    accordionToggles.forEach((toggle) => {
      toggle.addEventListener("click", (e) => {
        e.preventDefault();
        const parentLi = toggle.closest("li");
        const submenu = parentLi.querySelector("ul");
        const isExpanded = toggle.getAttribute("aria-expanded") === "true";

        if (isExpanded) {
          // Collapse
          submenu.classList.add("hidden");
          toggle.classList.remove("rotate-180");
          toggle.setAttribute("aria-expanded", "false");
        } else {
          // Expand
          submenu.classList.remove("hidden");
          toggle.classList.add("rotate-180");
          toggle.setAttribute("aria-expanded", "true");
        }
      });
    });
  }

  // Page Anchor Dropdown Logic (Floating Label Style with Clear)
  const anchorSelects = document.querySelectorAll(".js-anchor-select");
  anchorSelects.forEach((select) => {
    const trigger = select.querySelector(".js-anchor-select-trigger");
    const dropdown = select.querySelector(".js-anchor-select-dropdown");
    const label = select.querySelector(".js-anchor-label");
    const selectedText = select.querySelector(".js-anchor-selected-text");
    const clearBtn = select.querySelector(".js-anchor-clear");
    const icon = trigger.querySelector(".svg-icon"); // Target the caret icon specifically if possible, or assume last svg
    // Since clear btn also has an icon, trigger.querySelector('svg') might target the clear btn icon if it appears first in DOM order or CSS selector
    // The structure is Trigger > Span > Text... AND Trigger > Div > ClearBtn > SVG AND Caret > SVG
    // Caret is the last child of the flex container or in the Div.
    // Let's rely on specific class or position. In template-tags, caret is last.
    // Better: trigger.querySelectorAll('svg')[1] or similar if not classed.
    // Actually, the caret has class 'transition-transform'. I'll target that.
    const caretIcon = trigger.querySelector(".transition-transform");

    const items = select.querySelectorAll(".js-anchor-item");
    let hasSelection = false;

    const updateLabelState = (isOpen) => {
      if (isOpen || hasSelection) {
        // Float Label
        label.classList.remove("-translate-y-1/2", "scale-100");
        label.classList.add("scale-75", "-translate-y-full");
      } else {
        // Center Label
        label.classList.add("-translate-y-1/2", "scale-100");
        label.classList.remove("scale-75", "-translate-y-full");
      }

      // Toggle Clear Button
      if (hasSelection) {
        clearBtn.classList.remove("hidden");
      } else {
        clearBtn.classList.add("hidden");
      }
    };

    const toggleDropdown = (open) => {
      const isOpen =
        open !== undefined ? open : dropdown.classList.contains("hidden");

      if (isOpen) {
        // Open
        dropdown.classList.remove("hidden");
        setTimeout(() => dropdown.classList.remove("opacity-0"), 10);
        trigger.setAttribute("aria-expanded", "true");
        if (caretIcon) caretIcon.classList.add("rotate-180");
        updateLabelState(true);
      } else {
        // Close
        dropdown.classList.add("opacity-0");
        setTimeout(() => dropdown.classList.add("hidden"), 200);
        trigger.setAttribute("aria-expanded", "false");
        if (caretIcon) caretIcon.classList.remove("rotate-180");
        updateLabelState(false);
      }
    };

    trigger.addEventListener("click", (e) => {
      // Prevent toggle if clicking the clear button
      if (e.target.closest(".js-anchor-clear")) return;

      e.preventDefault();
      toggleDropdown();
    });

    items.forEach((item) => {
      item.addEventListener("click", (e) => {
        // Set text and state
        selectedText.textContent = item.textContent.trim();
        selectedText.classList.remove("opacity-0");
        hasSelection = true;
        toggleDropdown(false);
      });
    });

    if (clearBtn) {
      clearBtn.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation(); // Stop bubbling to trigger

        // Reset State
        selectedText.textContent = "";
        selectedText.classList.add("opacity-0");
        hasSelection = false;

        // Close dropdown if open, or just reset label
        toggleDropdown(false);
      });
    }

    // Close on click outside
    document.addEventListener("click", (e) => {
      if (!select.contains(e.target)) {
        toggleDropdown(false);
      }
    });

    // Initial state check
    label.classList.add("top-1/2", "-translate-y-1/2", "scale-100");
  });

  // Featured with Filter Logic (Swiper)
  const filterSections = document.querySelectorAll(".js-featured-filter-section");
  filterSections.forEach((section) => {
    const sliderEl = section.querySelector(".featured-filter-slider");
    if (!sliderEl) return;

    // Initialize Swiper
    const swiper = new Swiper(sliderEl, {
      modules: [Navigation, Pagination],
      slidesPerView: 1,
      spaceBetween: 30,
      pagination: {
        el: sliderEl.querySelector(".swiper-pagination"),
        clickable: true,
      },
      navigation: {
        nextEl: sliderEl.querySelector(".swiper-button-next"),
        prevEl: sliderEl.querySelector(".swiper-button-prev"),
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });

    // Filtering
    const filterBtns = section.querySelectorAll(".js-featured-filter-btn");
    filterBtns.forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        const filter = btn.getAttribute("data-filter");

        // Update Active Button
        filterBtns.forEach((b) => {
          b.classList.remove("bg-purple", "text-white");
          b.classList.add("text-purple");
        });
        btn.classList.add("bg-purple", "text-white");
        btn.classList.remove("text-purple");

        // Filter Slides
        // Swiper stores slides in swiper.slides
        // We can hide/show them by manipulating the DOM element directly
        // Then call swiper.update()
        
        let hasMatches = false;
        
        swiper.slides.forEach((slide) => {
            const categoriesStr = slide.getAttribute("data-categories") || "";
            const categories = categoriesStr.split(" ");
            
            if (filter === "all" || categories.includes(filter)) {
                slide.style.display = ""; // Show
                hasMatches = true;
            } else {
                slide.style.display = "none"; // Hide
            }
        });

        // If no matches, maybe show a message? (Optional)
        
        // Important: Update Swiper to re-calculate layout
        swiper.update();
        swiper.slideTo(0); // Reset to first slide
      });
    });
  });
});

console.log("Main JS Loaded");
