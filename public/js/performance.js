// Performance Page JavaScript

document.addEventListener('DOMContentLoaded', () => {
  console.log('Performance page loaded');

  // Regional Tabs Functionality
  const tabButtons = document.querySelectorAll('.tab-btn');
  const regionalPanels = document.querySelectorAll('.regional-panel');

  tabButtons.forEach(button => {
    button.addEventListener('click', () => {
      const region = button.getAttribute('data-region');

      // Remove active class from all tabs
      tabButtons.forEach(btn => btn.classList.remove('active'));
      
      // Add active class to clicked tab
      button.classList.add('active');

      // Hide all panels
      regionalPanels.forEach(panel => {
        panel.classList.remove('active');
      });

      // Show selected panel
      const targetPanel = document.querySelector(`[data-panel="${region}"]`);
      if (targetPanel) {
        targetPanel.classList.add('active');
        
        // Smooth scroll to panel
        targetPanel.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // Animate metrics on panel activation
  const animateMetrics = (panel) => {
    const metricFills = panel.querySelectorAll('.metric-fill');
    
    metricFills.forEach(fill => {
      const width = fill.style.width;
      fill.style.width = '0%';
      
      setTimeout(() => {
        fill.style.width = width;
      }, 100);
    });
  };

  // Observe panel changes
  const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      if (mutation.target.classList.contains('active')) {
        animateMetrics(mutation.target);
      }
    });
  });

  regionalPanels.forEach(panel => {
    observer.observe(panel, {
      attributes: true,
      attributeFilter: ['class']
    });
  });

  // Animate initial panel
  const activePanel = document.querySelector('.regional-panel.active');
  if (activePanel) {
    setTimeout(() => {
      animateMetrics(activePanel);
    }, 300);
  }

  // Interactive Map Regions (for continental view)
  const mapRegions = document.querySelectorAll('.region');
  
  mapRegions.forEach(region => {
    region.addEventListener('click', () => {
      const regionClass = region.classList[1]; // Get the second class (e.g., 'north-africa')
      
      // Map region classes to tab data-region values
      const regionMap = {
        'north-africa': 'amu',
        'west-africa': 'ecowas',
        'central-africa': 'eccas',
        'east-africa': 'eac',
        'southern-africa': 'sadc'
      };

      const targetRegion = regionMap[regionClass];
      
      if (targetRegion) {
        const targetTab = document.querySelector(`[data-region="${targetRegion}"]`);
        if (targetTab) {
          targetTab.click();
        }
      }
    });

    // Add hover effect
    region.addEventListener('mouseenter', () => {
      region.style.cursor = 'pointer';
    });
  });

  // View Details Button Functionality
  const viewDetailsButtons = document.querySelectorAll('.view-details-btn');
  
  viewDetailsButtons.forEach(button => {
    button.addEventListener('click', () => {
      const panel = button.closest('.regional-panel');
      const regionName = panel.querySelector('.region-header h2').textContent;
      
      // In a real application, this would navigate to a detailed report page
      alert(`Detailed report for ${regionName} will be available soon!`);
    });
  });

  // News Card Click Functionality
  const newsLinks = document.querySelectorAll('.news-link');
  
  newsLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const newsCard = link.closest('.news-card');
      const newsTitle = newsCard.querySelector('h4').textContent;
      
      // In a real application, this would navigate to the full news article
      console.log(`Opening news article: ${newsTitle}`);
    });
  });

  // Country Item Click Functionality
  const countryItems = document.querySelectorAll('.country-item');
  
  countryItems.forEach(item => {
    item.addEventListener('click', () => {
      const countryName = item.textContent.trim();
      
      // Add visual feedback
      item.style.background = '#822b39';
      item.style.color = 'white';
      
      setTimeout(() => {
        item.style.background = '';
        item.style.color = '';
      }, 300);
      
      // In a real application, this would show country-specific data
      console.log(`Country selected: ${countryName}`);
    });
  });

  // Smooth scroll for tab navigation
  const smoothScrollToTop = () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  };

  // Add keyboard navigation for tabs
  document.addEventListener('keydown', (e) => {
    const activeTab = document.querySelector('.tab-btn.active');
    const allTabs = Array.from(tabButtons);
    const currentIndex = allTabs.indexOf(activeTab);

    if (e.key === 'ArrowRight' && currentIndex < allTabs.length - 1) {
      allTabs[currentIndex + 1].click();
    } else if (e.key === 'ArrowLeft' && currentIndex > 0) {
      allTabs[currentIndex - 1].click();
    }
  });

  // Performance metrics animation on scroll
  const observeMetrics = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const metricFills = entry.target.querySelectorAll('.metric-fill');
        metricFills.forEach(fill => {
          const width = fill.style.width;
          fill.style.width = '0%';
          setTimeout(() => {
            fill.style.width = width;
          }, 100);
        });
      }
    });
  }, {
    threshold: 0.5
  });

  const performanceMetricsSections = document.querySelectorAll('.performance-metrics');
  performanceMetricsSections.forEach(section => {
    observeMetrics.observe(section);
  });

  // Add loading animation for stats
  const statCards = document.querySelectorAll('.stat-card');
  statCards.forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    
    setTimeout(() => {
      card.style.transition = 'all 0.5s ease';
      card.style.opacity = '1';
      card.style.transform = 'translateY(0)';
    }, index * 100);
  });

  // Hero background rotation (same as about page)
  const pageHero = document.getElementById('pageHero');
  if (pageHero) {
    const heroBackgrounds = pageHero.querySelectorAll('.page-hero-bg');
    let currentBgIndex = 0;

    function rotateHeroBackground() {
      heroBackgrounds[currentBgIndex].classList.remove('active');
      currentBgIndex = (currentBgIndex + 1) % heroBackgrounds.length;
      heroBackgrounds[currentBgIndex].classList.add('active');
    }

    // Rotate background every 5 seconds
    setInterval(rotateHeroBackground, 5000);
  }

  // Print functionality for reports
  const addPrintButton = () => {
    const infos = document.querySelectorAll('.info-section');
    infos.forEach(info => {
      const printBtn = document.createElement('button');
      printBtn.innerHTML = '<i class="fa-solid fa-print"></i> Print Report';
      printBtn.className = 'print-btn';
      printBtn.style.cssText = `
        margin-top: 15px;
        padding: 10px 20px;
        background: white;
        border: 2px solid #822b39;
        color: #822b39;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
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
      
      info.appendChild(printBtn);
    });
  };

  addPrintButton();

  console.log('Performance page interactions initialized');
});
