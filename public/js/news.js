// News & Events Page JavaScript

document.addEventListener('DOMContentLoaded', () => {
  console.log('News & Events page loaded');

  // Filter Functionality
  const filterButtons = document.querySelectorAll('.filter-btn');
  const newsCards = document.querySelectorAll('.news-event-card');
  const searchInput = document.getElementById('searchInput');
  const searchBtn = document.querySelector('.search-btn');

  // Category Filter
  filterButtons.forEach(button => {
    button.addEventListener('click', () => {
      const category = button.getAttribute('data-category');

      // Update active button
      filterButtons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');

      // Filter cards
      filterCards(category, searchInput.value);
    });
  });

  // Search Functionality
  const performSearch = () => {
    const searchTerm = searchInput.value.toLowerCase();
    const activeCategory = document.querySelector('.filter-btn.active').getAttribute('data-category');
    filterCards(activeCategory, searchTerm);
  };

  searchBtn.addEventListener('click', performSearch);
  
  searchInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
      performSearch();
    }
  });

  // Real-time search
  searchInput.addEventListener('input', () => {
    const activeCategory = document.querySelector('.filter-btn.active').getAttribute('data-category');
    filterCards(activeCategory, searchInput.value);
  });

  // Filter Cards Function
  function filterCards(category, searchTerm = '') {
    let visibleCount = 0;

    newsCards.forEach(card => {
      const cardCategory = card.getAttribute('data-category');
      const cardTitle = card.querySelector('h4').textContent.toLowerCase();
      const cardText = card.querySelector('p').textContent.toLowerCase();
      
      const matchesCategory = category === 'all' || cardCategory === category;
      const matchesSearch = searchTerm === '' || 
                           cardTitle.includes(searchTerm.toLowerCase()) || 
                           cardText.includes(searchTerm.toLowerCase());

      if (matchesCategory && matchesSearch) {
        card.classList.remove('hidden');
        card.style.animation = 'none';
        setTimeout(() => {
          card.style.animation = `fadeInCard 0.5s ease-out ${visibleCount * 0.1}s both`;
        }, 10);
        visibleCount++;
      } else {
        card.classList.add('hidden');
      }
    });

    // Show message if no results
    const existingMessage = document.querySelector('.no-results-message');
    if (existingMessage) {
      existingMessage.remove();
    }

    if (visibleCount === 0) {
      const noResultsMessage = document.createElement('div');
      noResultsMessage.className = 'no-results-message';
      noResultsMessage.style.cssText = `
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        color: #999;
        font-size: 18px;
      `;
      noResultsMessage.innerHTML = `
        <i class="fa-solid fa-search" style="font-size: 48px; margin-bottom: 20px; display: block; color: #ddd;"></i>
        <p style="margin: 0; font-weight: 600;">No results found</p>
        <p style="margin: 10px 0 0 0; font-size: 14px;">Try adjusting your filters or search terms</p>
      `;
      document.querySelector('.news-events-grid').appendChild(noResultsMessage);
    }
  }

  // Load More Functionality
  const loadMoreBtn = document.querySelector('.load-more-btn');
  let isLoading = false;

  if (loadMoreBtn) {
    loadMoreBtn.addEventListener('click', () => {
      if (isLoading) return;
      
      isLoading = true;
      loadMoreBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Loading...';
      
      // Simulate loading more content
      setTimeout(() => {
        // In a real application, this would fetch more data from an API
        alert('More stories would be loaded here from the server!');
        
        loadMoreBtn.innerHTML = '<i class="fa-solid fa-spinner"></i> Load More Stories';
        isLoading = false;
      }, 1500);
    });
  }

  // Newsletter Subscription
  const newsletterForm = document.querySelector('.newsletter-form');
  const subscribeBtn = document.querySelector('.subscribe-btn');

  if (subscribeBtn) {
    subscribeBtn.addEventListener('click', (e) => {
      e.preventDefault();
      const emailInput = newsletterForm.querySelector('input[type="email"]');
      const email = emailInput.value.trim();

      if (!email) {
        alert('Please enter your email address');
        return;
      }

      if (!isValidEmail(email)) {
        alert('Please enter a valid email address');
        return;
      }

      // Simulate subscription
      subscribeBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Subscribing...';
      
      setTimeout(() => {
        alert('Thank you for subscribing! You will now receive updates on Agenda 2063.');
        emailInput.value = '';
        subscribeBtn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Subscribe';
      }, 1000);
    });
  }

  // Email validation
  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  // Card Click Handlers
  const cardLinks = document.querySelectorAll('.card-link');
  
  cardLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      if (link.classList.contains('register-link')) {
        e.preventDefault();
        const card = link.closest('.news-event-card');
        const title = card?.querySelector('h4')?.textContent || 'Event';
        alert(`Registration page for "${title}" would open here!`);
        return;
      }
      // default behavior follows the anchor href to the real detail page
    });
  });

  // Featured News Button
  const readFullBtn = document.querySelector('.read-full-btn');
  
  if (readFullBtn && readFullBtn.getAttribute('href')) {
    // allow default navigation via href; nothing extra needed
  }

  // Hero Background Rotation
  const pageHero = document.getElementById('pageHero');
  if (pageHero) {
    const heroBackgrounds = pageHero.querySelectorAll('.page-hero-bg');
    let currentBgIndex = 0;

    function rotateHeroBackground() {
      heroBackgrounds[currentBgIndex].classList.remove('active');
      currentBgIndex = (currentBgIndex + 1) % heroBackgrounds.length;
      heroBackgrounds[currentBgIndex].classList.add('active');
    }

    setInterval(rotateHeroBackground, 5000);
  }

  // Smooth Scroll for Internal Links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });

  // Lazy Loading for Images
  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.style.opacity = '0';
        img.style.transition = 'opacity 0.5s ease';
        
        setTimeout(() => {
          img.style.opacity = '1';
        }, 100);
        
        observer.unobserve(img);
      }
    });
  }, {
    threshold: 0.1
  });

  document.querySelectorAll('.card-image img, .featured-image img').forEach(img => {
    imageObserver.observe(img);
  });

  // Add animation on scroll for cards
  const cardObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '0';
        entry.target.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
          entry.target.style.transition = 'all 0.6s ease';
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }, 100);
      }
    });
  }, {
    threshold: 0.2
  });

  newsCards.forEach(card => {
    cardObserver.observe(card);
  });

  // Keyboard Navigation for Filters
  document.addEventListener('keydown', (e) => {
    if (e.target.tagName === 'INPUT') return;

    const activeFilter = document.querySelector('.filter-btn.active');
    const allFilters = Array.from(filterButtons);
    const currentIndex = allFilters.indexOf(activeFilter);

    if (e.key === 'ArrowRight' && currentIndex < allFilters.length - 1) {
      allFilters[currentIndex + 1].click();
    } else if (e.key === 'ArrowLeft' && currentIndex > 0) {
      allFilters[currentIndex - 1].click();
    }
  });

  // Share Functionality (for future implementation)
  const addShareButtons = () => {
    newsCards.forEach(card => {
      const cardContent = card.querySelector('.card-content');
      const shareBtn = document.createElement('button');
      shareBtn.className = 'share-btn';
      shareBtn.innerHTML = '<i class="fa-solid fa-share-nodes"></i>';
      shareBtn.style.cssText = `
        position: absolute;
        top: 15px;
        left: 15px;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.95);
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #822b39;
        font-size: 16px;
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 3;
      `;

      card.style.position = 'relative';
      card.appendChild(shareBtn);

      card.addEventListener('mouseenter', () => {
        shareBtn.style.opacity = '1';
      });

      card.addEventListener('mouseleave', () => {
        shareBtn.style.opacity = '0';
      });

      shareBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        const title = card.querySelector('h4').textContent;
        
        if (navigator.share) {
          navigator.share({
            title: title,
            text: 'Check out this article from Agenda 2063',
            url: window.location.href
          }).catch(err => console.log('Error sharing:', err));
        } else {
          alert('Share functionality would be implemented here!');
        }
      });
    });
  };

  addShareButtons();

  // Print Functionality
  const addPrintButton = () => {
    const featuredContent = document.querySelector('.featured-content');
    if (featuredContent) {
      const printBtn = document.createElement('button');
      printBtn.innerHTML = '<i class="fa-solid fa-print"></i> Print Article';
      printBtn.style.cssText = `
        margin-top: 15px;
        padding: 10px 20px;
        background: white;
        border: 2px solid #822b39;
        color: #822b39;
        border-radius: 0;
        cursor: pointer;
        font-weight: 600;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      `;

      printBtn.addEventListener('mouseenter', () => {
        printBtn.style.background = '#822b39';
        printBtn.style.color = 'white';
      });

      printBtn.addEventListener('mouseleave', () => {
        printBtn.style.background = 'white';
        printBtn.style.color = '#822b39';
      });

      printBtn.addEventListener('click', () => {
        window.print();
      });

      featuredContent.appendChild(printBtn);
    }
  };

  addPrintButton();

  console.log('News & Events page interactions initialized');
});
