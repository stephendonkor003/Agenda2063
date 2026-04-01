document.addEventListener('DOMContentLoaded', () => {
  const filterButtons = Array.from(document.querySelectorAll('.filter-btn'));
  const newsCards = Array.from(document.querySelectorAll('.news-event-card'));
  const searchInput = document.getElementById('searchInput');
  const searchBtn = document.querySelector('.search-btn');
  const heroBackgrounds = Array.from(document.querySelectorAll('#pageHero .page-hero-bg'));

  const applyFilters = () => {
    const activeFilter = document.querySelector('.filter-btn.active');
    const category = activeFilter?.dataset.category ?? 'all';
    const query = (searchInput?.value ?? '').trim().toLowerCase();
    let visibleCount = 0;

    newsCards.forEach((card) => {
      const cardCategory = card.dataset.category ?? '';
      const title = card.querySelector('h4')?.textContent.toLowerCase() ?? '';
      const summary = card.querySelector('p')?.textContent.toLowerCase() ?? '';
      const matchesCategory = category === 'all' || cardCategory === category;
      const matchesSearch = query === '' || title.includes(query) || summary.includes(query);

      if (matchesCategory && matchesSearch) {
        card.classList.remove('hidden');
        card.style.animation = 'none';
        window.setTimeout(() => {
          card.style.animation = `fadeInCard 0.5s ease-out ${visibleCount * 0.08}s both`;
        }, 10);
        visibleCount += 1;
      } else {
        card.classList.add('hidden');
      }
    });

    const existingMessage = document.querySelector('.no-results-message');
    if (existingMessage) {
      existingMessage.remove();
    }

    if (visibleCount === 0) {
      const message = document.createElement('div');
      message.className = 'no-results-message';
      message.style.cssText = 'grid-column:1 / -1; text-align:center; padding:60px 20px; color:#64748b; font-size:18px;';
      message.innerHTML = '<i class="fa-solid fa-search" style="font-size:42px; margin-bottom:18px; display:block; color:#cbd5e1;"></i><p style="margin:0; font-weight:700;">No matching stories found</p><p style="margin:10px 0 0 0; font-size:14px;">Try a different keyword or content type.</p>';
      document.querySelector('.news-events-grid')?.appendChild(message);
    }
  };

  filterButtons.forEach((button) => {
    button.addEventListener('click', () => {
      filterButtons.forEach((btn) => btn.classList.remove('active'));
      button.classList.add('active');
      applyFilters();
    });
  });

  searchBtn?.addEventListener('click', applyFilters);
  searchInput?.addEventListener('input', applyFilters);
  searchInput?.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
      event.preventDefault();
      applyFilters();
    }
  });

  if (heroBackgrounds.length > 1) {
    let currentIndex = 0;
    window.setInterval(() => {
      heroBackgrounds[currentIndex]?.classList.remove('active');
      currentIndex = (currentIndex + 1) % heroBackgrounds.length;
      heroBackgrounds[currentIndex]?.classList.add('active');
    }, 5000);
  }

  const cardObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) {
        return;
      }

      entry.target.style.opacity = '0';
      entry.target.style.transform = 'translateY(28px)';

      window.setTimeout(() => {
        entry.target.style.transition = 'all 0.55s ease';
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }, 80);
    });
  }, { threshold: 0.15 });

  newsCards.forEach((card) => cardObserver.observe(card));
});
