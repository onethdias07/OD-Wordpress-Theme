// Improved Sticky Header with smooth transitions
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.site-header');
    
    if (!header) return;
    
    let isScrolled = false;
    let ticking = false;
    const scrollThreshold = 50;
    
    // Add initial state to prevent flash
    header.style.transform = 'translateY(0)';
    
    function updateHeader() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const shouldBeScrolled = scrollTop > scrollThreshold;
        
        if (shouldBeScrolled !== isScrolled) {
            isScrolled = shouldBeScrolled;
            
            // Force browser reflow before transition
            header.offsetHeight;
            
            if (isScrolled) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }
        
        ticking = false;
    }
    
    function onScroll() {
        if (!ticking) {
            requestAnimationFrame(updateHeader);
            ticking = true;
        }
    }
    
    // Initial check
    updateHeader();
    
    // Use passive event listener for better performance
    window.addEventListener('scroll', onScroll, { passive: true });
    
    // Handle resize events
    window.addEventListener('resize', updateHeader, { passive: true });
});

// Enhanced Search Form Interactions
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.querySelector('.search-form');
    const searchField = document.querySelector('.search-field');
    const searchButton = document.querySelector('.search-form button');
    
    if (!searchForm || !searchField) return;
    
    // Debounced focus handling
    let focusTimeout;
    
    searchField.addEventListener('focus', function() {
        clearTimeout(focusTimeout);
        searchForm.classList.add('focused');
    });
    
    searchField.addEventListener('blur', function() {
        focusTimeout = setTimeout(() => {
            searchForm.classList.remove('focused');
        }, 150);
    });
    
    // Enhanced button interactions
    if (searchButton) {
        searchButton.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        
        searchButton.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
        
        searchButton.addEventListener('mousedown', function() {
            this.style.transform = 'scale(0.98)';
        });
        
        searchButton.addEventListener('mouseup', function() {
            this.style.transform = 'scale(1.05)';
        });
    }
});

// Navigation Link Enhancements
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.header-nav a');
    
    navLinks.forEach(link => {
        // Add stagger effect for hover animations
        link.addEventListener('mouseenter', function() {
            const siblings = [...this.parentNode.parentNode.children];
            const index = siblings.indexOf(this.parentNode);
            
            siblings.forEach((sibling, i) => {
                if (i !== index) {
                    sibling.querySelector('a').style.transform = 'scale(0.98)';
                    sibling.querySelector('a').style.opacity = '0.7';
                }
            });
        });
        
        link.addEventListener('mouseleave', function() {
            const siblings = [...this.parentNode.parentNode.children];
            
            siblings.forEach(sibling => {
                sibling.querySelector('a').style.transform = '';
                sibling.querySelector('a').style.opacity = '';
            });
        });
    });
});

// Mobile Menu Functionality
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileNavigation = document.querySelector('.main-navigation');
    const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
    const body = document.body;
    
    if (!mobileMenuToggle || !mobileNavigation) return;
    
    let isMenuOpen = false;
    
    function toggleMobileMenu() {
        isMenuOpen = !isMenuOpen;
        
        // Toggle classes
        mobileMenuToggle.classList.toggle('active', isMenuOpen);
        mobileNavigation.classList.toggle('active', isMenuOpen);
        
        // Only use overlay on tablet and larger screens
        if (mobileMenuOverlay && window.innerWidth > 576) {
            mobileMenuOverlay.classList.toggle('active', isMenuOpen);
        }
        
        // Prevent body scroll when menu is open
        if (isMenuOpen) {
            body.style.overflow = 'hidden';
        } else {
            body.style.overflow = '';
        }
        
        // Update ARIA attributes for accessibility
        mobileMenuToggle.setAttribute('aria-expanded', isMenuOpen);
        mobileNavigation.setAttribute('aria-hidden', !isMenuOpen);
    }
    
    function closeMobileMenu() {
        if (isMenuOpen) {
            toggleMobileMenu();
        }
    }
    
    // Toggle menu when button is clicked
    mobileMenuToggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        toggleMobileMenu();
    });
    
    // Close menu when overlay is clicked (only on tablet+)
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', function() {
            if (window.innerWidth > 576) {
                closeMobileMenu();
            }
        });
    }
    
    // Close menu when nav link is clicked
    const navLinks = mobileNavigation.querySelectorAll('.header-nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });
    
    // Close menu on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isMenuOpen) {
            closeMobileMenu();
        }
    });
    
    // Close menu on window resize to desktop size
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024 && isMenuOpen) {
            closeMobileMenu();
        }
        
        // Remove overlay on mobile resize
        if (mobileMenuOverlay && window.innerWidth <= 576) {
            mobileMenuOverlay.classList.remove('active');
        }
    });
    
    // Handle swipe gestures on mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    mobileNavigation.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });
    
    mobileNavigation.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });
    
    function handleSwipe() {
        const swipeThreshold = 100;
        const difference = touchStartX - touchEndX;
        
        // Swipe left to close menu
        if (difference > swipeThreshold && isMenuOpen) {
            closeMobileMenu();
        }
    }
    
    // Initialize ARIA attributes
    mobileMenuToggle.setAttribute('aria-expanded', 'false');
    mobileMenuToggle.setAttribute('aria-controls', 'main-navigation');
    mobileNavigation.setAttribute('aria-hidden', 'true');
    mobileNavigation.setAttribute('id', 'main-navigation');
});

console.log('OD Theme loaded with modern interactions!');