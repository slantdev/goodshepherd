import { Fancybox } from "@fancyapps/ui";
import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import ScrollMagic from 'scrollmagic';

export function initTimeline() {
    // Only run if timeline exists
    if (!document.querySelector('.timeline-section')) {
        return;
    }

    // ScrollMagic
    const controller = new ScrollMagic.Controller();
    const sections = document.querySelectorAll('.timeline-section');
    
    sections.forEach(section => {
        const postid = section.getAttribute('data-postid');
        new ScrollMagic.Scene({
            triggerElement: section,
            triggerHook: 0.8,
        })
        .setClassToggle('#img-' + postid, 'active')
        .addTo(controller);
    });

    const entries = document.querySelectorAll('.period-entry, .timeline-entry, .gs-heart');
    entries.forEach(entry => {
        new ScrollMagic.Scene({
            triggerElement: entry,
            triggerHook: 1,
            offset: 50,
        })
        .setClassToggle(entry, 'animated')
        .addTo(controller);
    });

    // Fancybox
    Fancybox.bind('[data-fancybox]', {
        hideScrollbar: true,
    });

    // Spacer Height Calculation
    const spacers = document.querySelectorAll('.period-spacer');
    spacers.forEach(spacer => {
        const timelineContent = spacer.closest('.timeline-content');
        if (timelineContent) {
            const periodEntry = timelineContent.querySelector('.period-entry');
            if (periodEntry) {
                spacer.style.height = `${periodEntry.offsetHeight}px`;
            }
        }
    });

    // Swiper
    const timelineNav = new Swiper('#timeline-nav', {
        modules: [Navigation],
        slidesPerView: 'auto',
        spaceBetween: 0,
        loop: false,
        watchOverflow: true,
        navigation: {
            nextEl: '.timeline-nav--button-next',
            prevEl: '.timeline-nav--button-prev',
        },
    });

    // Scroll Animation Variable
    window.addEventListener('scroll', setScrollVar);
    window.addEventListener('resize', setScrollVar);
    setScrollVar(); // Initial call
}

function setScrollVar() {
    const htmlElement = document.documentElement;
    const percentOfScreenHeightScrolled = htmlElement.scrollTop / htmlElement.clientHeight;
    htmlElement.style.setProperty(
        '--scroll',
        Math.min(percentOfScreenHeightScrolled * 100, 100)
    );
}