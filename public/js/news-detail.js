document.addEventListener('DOMContentLoaded', () => {
  const carousel = document.querySelector('[data-related-news]');
  if (!carousel) {
    return;
  }

  const track = carousel.querySelector('.related-news-track');
  const items = Array.from(carousel.querySelectorAll('.related-news-item'));
  const dots = Array.from(carousel.querySelectorAll('.related-news-dot'));

  if (!track || items.length <= 1) {
    return;
  }

  let currentIndex = 0;

  const updateCarousel = () => {
    track.style.transform = `translateX(-${currentIndex * 100}%)`;
    dots.forEach((dot, index) => {
      dot.classList.toggle('active', index === currentIndex);
    });
  };

  updateCarousel();

  window.setInterval(() => {
    currentIndex = (currentIndex + 1) % items.length;
    updateCarousel();
  }, 4000);
});
