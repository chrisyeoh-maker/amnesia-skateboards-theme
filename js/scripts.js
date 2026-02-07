/**
 * Amnesia Skateboards Theme Scripts
 */

(function($) {
    'use strict';
    
    // Mobile Menu Toggle
    $('.mobile-menu-toggle').on('click', function() {
        $('.main-navigation').toggleClass('active');
        $(this).toggleClass('active');
    });
    
    // Close mobile menu when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.header-container').length) {
            $('.main-navigation').removeClass('active');
            $('.mobile-menu-toggle').removeClass('active');
        }
    });
    
    // Smooth scroll for anchor links
    $('a[href*="#"]').on('click', function(e) {
        var target = $(this.hash);
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 500);
        }
    });
    
})(jQuery);
