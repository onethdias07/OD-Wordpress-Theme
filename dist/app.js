/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/app.js":
/*!********************!*\
  !*** ./src/app.js ***!
  \********************/
/***/ (() => {

function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
// Improved Sticky Header with smooth transitions
document.addEventListener('DOMContentLoaded', function () {
  var header = document.querySelector('.site-header');
  if (!header) return;
  var isScrolled = false;
  var ticking = false;
  var scrollThreshold = 50;

  // Add initial state to prevent flash
  header.style.transform = 'translateY(0)';
  function updateHeader() {
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    var shouldBeScrolled = scrollTop > scrollThreshold;
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
  window.addEventListener('scroll', onScroll, {
    passive: true
  });

  // Handle resize events
  window.addEventListener('resize', updateHeader, {
    passive: true
  });
});

// Enhanced Search Form Interactions
document.addEventListener('DOMContentLoaded', function () {
  var searchForm = document.querySelector('.search-form');
  var searchField = document.querySelector('.search-field');
  var searchButton = document.querySelector('.search-form button');
  if (!searchForm || !searchField) return;

  // Debounced focus handling
  var focusTimeout;
  searchField.addEventListener('focus', function () {
    clearTimeout(focusTimeout);
    searchForm.classList.add('focused');
  });
  searchField.addEventListener('blur', function () {
    focusTimeout = setTimeout(function () {
      searchForm.classList.remove('focused');
    }, 150);
  });

  // Enhanced button interactions
  if (searchButton) {
    searchButton.addEventListener('mouseenter', function () {
      this.style.transform = 'scale(1.05)';
    });
    searchButton.addEventListener('mouseleave', function () {
      this.style.transform = '';
    });
    searchButton.addEventListener('mousedown', function () {
      this.style.transform = 'scale(0.98)';
    });
    searchButton.addEventListener('mouseup', function () {
      this.style.transform = 'scale(1.05)';
    });
  }
});

// Navigation Link Enhancements
document.addEventListener('DOMContentLoaded', function () {
  var navLinks = document.querySelectorAll('.header-nav a');
  navLinks.forEach(function (link) {
    // Add stagger effect for hover animations
    link.addEventListener('mouseenter', function () {
      var siblings = _toConsumableArray(this.parentNode.parentNode.children);
      var index = siblings.indexOf(this.parentNode);
      siblings.forEach(function (sibling, i) {
        if (i !== index) {
          sibling.querySelector('a').style.transform = 'scale(0.98)';
          sibling.querySelector('a').style.opacity = '0.7';
        }
      });
    });
    link.addEventListener('mouseleave', function () {
      var siblings = _toConsumableArray(this.parentNode.parentNode.children);
      siblings.forEach(function (sibling) {
        sibling.querySelector('a').style.transform = '';
        sibling.querySelector('a').style.opacity = '';
      });
    });
  });
});

// Mobile Menu Functionality
document.addEventListener('DOMContentLoaded', function () {
  var mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
  var mobileNavigation = document.querySelector('.main-navigation');
  var body = document.body;
  if (!mobileMenuToggle || !mobileNavigation) return;
  var isMenuOpen = false;
  function toggleMobileMenu() {
    isMenuOpen = !isMenuOpen;

    // Toggle classes
    mobileMenuToggle.classList.toggle('active', isMenuOpen);
    mobileNavigation.classList.toggle('active', isMenuOpen);

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
  mobileMenuToggle.addEventListener('click', function (e) {
    e.preventDefault();
    e.stopPropagation();
    toggleMobileMenu();
  });

  // Close menu when nav link is clicked
  var navLinks = mobileNavigation.querySelectorAll('.header-nav a');
  navLinks.forEach(function (link) {
    link.addEventListener('click', closeMobileMenu);
  });

  // Close menu on Escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && isMenuOpen) {
      closeMobileMenu();
    }
  });

  // Close menu on window resize to desktop size
  window.addEventListener('resize', function () {
    if (window.innerWidth >= 1024 && isMenuOpen) {
      closeMobileMenu();
    }
  });

  // Handle swipe gestures on mobile
  var touchStartX = 0;
  var touchEndX = 0;
  mobileNavigation.addEventListener('touchstart', function (e) {
    touchStartX = e.changedTouches[0].screenX;
  }, {
    passive: true
  });
  mobileNavigation.addEventListener('touchend', function (e) {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
  }, {
    passive: true
  });
  function handleSwipe() {
    var swipeThreshold = 100;
    var difference = touchStartX - touchEndX;

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

/***/ }),

/***/ "./src/app.scss":
/*!**********************!*\
  !*** ./src/app.scss ***!
  \**********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/dist/app": 0,
/******/ 			"dist/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkod_theme"] = self["webpackChunkod_theme"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["dist/app"], () => (__webpack_require__("./src/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["dist/app"], () => (__webpack_require__("./src/app.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;