/**
 * Priority+ Navigation Pattern
 * Automatically moves nav items that don't fit into a "More" dropdown
 * 
 * Based on industry best practices for handling 10+ navigation items
 */

(function() {
  'use strict';

  const SELECTORS = {
    headerContainer: '.site-header__container',  // The constrained container
    nav: '.site-header__nav',           // The full nav container
    menu: '.site-header__menu',         // The ul containing menu items
    items: '.site-header__item',
    moreItem: '.site-header__more',
    moreDropdown: '.site-header__more-dropdown',
    actions: '.site-header__actions',   // Language switcher + Giving button
    logo: '.site-header__logo'          // Logo on the left
  };

  let headerContainer, navContainer, menu, moreItem, moreDropdown, actionsArea, logo, allItems;
  let itemWidths = [];  // Individual item widths (not cumulative)
  let isInitialized = false;

  /**
   * Initialize priority navigation
   */
  function init() {
    headerContainer = document.querySelector(SELECTORS.headerContainer);
    navContainer = document.querySelector(SELECTORS.nav);
    menu = document.querySelector(SELECTORS.menu);
    moreItem = document.querySelector(SELECTORS.moreItem);
    moreDropdown = document.querySelector(SELECTORS.moreDropdown);
    actionsArea = document.querySelector(SELECTORS.actions);
    logo = document.querySelector(SELECTORS.logo);

    if (!headerContainer || !navContainer || !menu || !moreItem || !moreDropdown) {
      return;
    }

    // Get all nav items except the "More" item
    allItems = Array.from(menu.querySelectorAll(':scope > ' + SELECTORS.items + ':not(.site-header__more)'));
    
    // Store individual widths (not cumulative)
    measureItems();
    
    isInitialized = true;
    
    // Initial check
    checkNav();

    // Listen for resize
    window.addEventListener('resize', debounce(checkNav, 100));
  }

  /**
   * Measure and store individual item widths
   */
  function measureItems() {
    itemWidths = [];
    
    // Temporarily show all items and hide More button for accurate measurement
    moreItem.style.display = 'none';
    
    allItems.forEach(item => {
      // Temporarily ensure item is visible for measurement
      const wasHidden = item.hasAttribute('data-priority-hidden');
      if (wasHidden) {
        item.style.display = '';
        item.removeAttribute('data-priority-hidden');
      }
      
      // Get computed style for margins
      const style = window.getComputedStyle(item);
      const marginLeft = parseFloat(style.marginLeft) || 0;
      const marginRight = parseFloat(style.marginRight) || 0;
      
      // Store width INCLUDING margins
      itemWidths.push(item.offsetWidth + marginLeft + marginRight);
      
      if (wasHidden) {
        item.style.display = 'none';
        item.setAttribute('data-priority-hidden', 'true');
      }
    });
  }

  /**
   * Check navigation and move items as needed
   */
  function checkNav() {
    if (!isInitialized) return;

    // Only run on desktop (above mobile breakpoint)
    if (window.innerWidth < 1024) {
      // Reset - show all items on mobile (hamburger handles it)
      resetNav();
      moreItem.style.display = 'none';
      return;
    }

    // Calculate available space for the menu:
    // We need to use the CONSTRAINED container width, not the potentially overflowing nav width
    // Available = container width - logo width - actions width - gaps/padding
    const containerWidth = headerContainer.offsetWidth;
    const logoWidth = logo ? logo.offsetWidth : 0;
    const actionsWidth = actionsArea ? actionsArea.offsetWidth : 0;
    
    // Get the gap between elements (from CSS flexbox gap)
    const headerStyle = window.getComputedStyle(headerContainer);
    const containerGap = parseFloat(headerStyle.gap) || 24; // fallback gap
    
    // Calculate space available for menu items
    // Container = Logo + Nav(Menu + Actions)
    // So Menu space = Container - Logo - Actions - gaps - safety padding
    const safetyPadding = 20;
    const availableForMenu = containerWidth - logoWidth - actionsWidth - (containerGap * 2) - safetyPadding;

    // Get the More button's width (measure it while visible)
    moreItem.style.display = '';
    moreItem.style.visibility = 'hidden';
    const moreWidth = moreItem.offsetWidth;
    moreItem.style.visibility = '';
    moreItem.style.display = 'none';

    // Available space for menu items
    const totalAvailable = availableForMenu;

    // First pass: calculate how many items fit WITHOUT the More button
    let runningWidth = 0;
    let itemsThatFitWithoutMore = 0;
    
    for (let i = 0; i < allItems.length; i++) {
      if (runningWidth + itemWidths[i] <= totalAvailable) {
        runningWidth += itemWidths[i];
        itemsThatFitWithoutMore++;
      } else {
        break;
      }
    }

    // If all items fit, no need for More button
    if (itemsThatFitWithoutMore === allItems.length) {
      // Show all items, hide More
      allItems.forEach(item => {
        item.style.display = '';
        item.removeAttribute('data-priority-hidden');
      });
      moreItem.style.display = 'none';
      moreDropdown.innerHTML = '';
      return;
    }

    // Second pass: we need More button, so recalculate with More button space reserved
    const availableWithMore = totalAvailable - moreWidth;
    
    runningWidth = 0;
    let visibleCount = 0;
    let hiddenCount = 0;

    allItems.forEach((item, index) => {
      if (runningWidth + itemWidths[index] <= availableWithMore) {
        // Item fits - show in main nav
        item.style.display = '';
        item.removeAttribute('data-priority-hidden');
        runningWidth += itemWidths[index];
        visibleCount++;
      } else {
        // Item doesn't fit - hide from main nav
        item.style.display = 'none';
        item.setAttribute('data-priority-hidden', 'true');
        hiddenCount++;
      }
    });

    // Update More dropdown with hidden items
    updateMoreDropdown();

    // Show More button with count
    if (hiddenCount > 0) {
      moreItem.style.display = '';
      moreItem.querySelector('.site-header__more-count').textContent = hiddenCount;
    } else {
      moreItem.style.display = 'none';
    }
  }

  /**
   * Update the More dropdown with hidden items
   */
  function updateMoreDropdown() {
    // Clear dropdown
    moreDropdown.innerHTML = '';

    // Add hidden items as clones
    allItems.forEach(item => {
      if (item.hasAttribute('data-priority-hidden')) {
        const clone = item.cloneNode(true);
        clone.style.display = '';
        clone.removeAttribute('data-priority-hidden');
        clone.classList.remove('site-header__item');
        clone.classList.add('site-header__more-item');
        
        // Handle nested dropdowns - flatten them
        const nestedDropdown = clone.querySelector('.site-header__dropdown');
        if (nestedDropdown) {
          nestedDropdown.remove();
        }
        
        moreDropdown.appendChild(clone);
      }
    });
  }

  /**
   * Reset navigation to show all items
   */
  function resetNav() {
    allItems.forEach(item => {
      item.style.display = '';
      item.removeAttribute('data-priority-hidden');
    });
    moreDropdown.innerHTML = '';
  }

  /**
   * Debounce helper
   */
  function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  }

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  // Re-initialize after fonts load (can affect measurements)
  if (document.fonts) {
    document.fonts.ready.then(() => {
      if (isInitialized) {
        measureItems();
        checkNav();
      }
    });
  }

})();
