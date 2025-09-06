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

console.log('OD Theme loaded with modern interactions!');