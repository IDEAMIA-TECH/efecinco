// Document Ready
$(document).ready(function() {
    // Initialize components
    initBackToTop();
    initTestimonialsSlider();
    initContactForm();
    initScrollSpy();
    initAnimations();
});

// Back to Top Button
function initBackToTop() {
    const backToTop = $('<div class="back-to-top"><i class="fas fa-arrow-up"></i></div>');
    $('body').append(backToTop);
    
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            backToTop.addClass('visible');
        } else {
            backToTop.removeClass('visible');
        }
    });
    
    backToTop.click(function() {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });
}

// Testimonials Slider
function initTestimonialsSlider() {
    if ($('.testimonials-slider').length) {
        $('.testimonials-slider').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            adaptiveHeight: true,
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }
}

// Contact Form Handler
function initContactForm() {
    const contactForm = $('#contactForm');
    
    if (contactForm.length) {
        contactForm.on('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            const submitButton = contactForm.find('button[type="submit"]');
            const originalText = submitButton.text();
            submitButton.html('<span class="spinner-border spinner-border-sm me-2"></span>Enviando...');
            
            // Collect form data
            const formData = new FormData(this);
            
            // Send AJAX request
            $.ajax({
                url: contactForm.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Show success message
                        contactForm.before('<div class="alert alert-success">' + response.message + '</div>');
                        contactForm[0].reset();
                    } else {
                        // Show error message
                        contactForm.before('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function() {
                    // Show error message
                    contactForm.before('<div class="alert alert-danger">Error al enviar el mensaje. Por favor, intente nuevamente.</div>');
                },
                complete: function() {
                    // Reset button state
                    submitButton.html(originalText);
                    
                    // Remove alerts after 5 seconds
                    setTimeout(function() {
                        $('.alert').fadeOut('slow', function() {
                            $(this).remove();
                        });
                    }, 5000);
                }
            });
        });
    }
}

// Scroll Spy
function initScrollSpy() {
    $('body').scrollspy({
        target: '#mainNav',
        offset: 100
    });
    
    // Smooth scrolling
    $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && 
            location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 70
                }, 1000);
            }
        }
    });
}

// Animations
function initAnimations() {
    // Add animation classes on scroll
    $(window).scroll(function() {
        $('.fade-in').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();
            
            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('visible');
            }
        });
    });
    
    // Trigger initial check
    $(window).trigger('scroll');
}

// Form Validation
function validateForm(form) {
    let isValid = true;
    const requiredFields = form.find('[required]');
    
    requiredFields.each(function() {
        if (!$(this).val()) {
            isValid = false;
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
    
    // Email validation
    const emailField = form.find('[type="email"]');
    if (emailField.length && emailField.val()) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailField.val())) {
            isValid = false;
            emailField.addClass('is-invalid');
        }
    }
    
    return isValid;
}

// Image Lazy Loading
function initLazyLoading() {
    if ('loading' in HTMLImageElement.prototype) {
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
            img.src = img.dataset.src;
        });
    } else {
        // Fallback for browsers that don't support lazy loading
        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
        document.body.appendChild(script);
    }
}

// Initialize lazy loading
initLazyLoading(); 