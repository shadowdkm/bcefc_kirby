// Lightbox
Array.from(document.querySelectorAll("[data-lightbox]")).forEach(element => {
  element.onclick = (e) => {
    e.preventDefault();
    basicLightbox.create(`<img src="${element.href}">`).show();
  };
});

// Hero background slideshow — shuffles the slides and cross-fades them on a timer
Array.from(document.querySelectorAll("[data-hero-slideshow]")).forEach(bg => {
  const slides = Array.from(bg.querySelectorAll(".block-hero__slide"));
  if (slides.length < 2) return;

  // Fisher–Yates shuffle so the order differs each visit
  for (let i = slides.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [slides[i], slides[j]] = [slides[j], slides[i]];
  }

  let index = 0;
  slides.forEach(slide => slide.classList.remove("is-active"));
  slides[index].classList.add("is-active");

  const interval = parseInt(bg.getAttribute("data-interval"), 10) || 6000;
  setInterval(() => {
    slides[index].classList.remove("is-active");
    index = (index + 1) % slides.length;
    slides[index].classList.add("is-active");
  }, interval);
});
