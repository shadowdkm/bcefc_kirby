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

// Scroll reveal — fades blocks in as they enter the viewport.
// The `js-reveal` class on <html> (set in the head) gates the CSS that hides
// them, so if this script never runs, everything simply stays visible.
(function () {
  const root = document.documentElement;
  if (!root.classList.contains("js-reveal")) return;

  const targets = Array.from(document.querySelectorAll("[data-reveal]"));
  if (targets.length === 0) return;

  const STAGGER_STEP = 80;   // keep in sync with blocks.css
  const CHILD_DURATION = 600;

  // How long this block's staggered children need before the last one lands.
  const settleDelay = (el) => {
    let longest = 0;
    el.querySelectorAll("[data-reveal-stagger]").forEach(group => {
      longest = Math.max(longest, (group.children.length - 1) * STAGGER_STEP);
    });
    return longest + CHILD_DURATION + 100;
  };

  // Once the sequence has played, `is-settled` drops the reveal styles so
  // children get their own hover transitions back, undelayed.
  const reveal = (el) => {
    el.classList.add("is-revealed");
    window.setTimeout(() => el.classList.add("is-settled"), settleDelay(el));
  };

  // Respecting reduced motion: show everything at once, skip the observer.
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
    targets.forEach(el => el.classList.add("is-revealed", "is-settled"));
    return;
  }

  // Index the children of any staggered container so CSS can offset their delays.
  targets.forEach(target => {
    target.querySelectorAll("[data-reveal-stagger]").forEach(group => {
      Array.from(group.children).forEach((child, i) => {
        child.style.setProperty("--reveal-i", i);
      });
    });
  });

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      reveal(entry.target);
      observer.unobserve(entry.target);
    });
  }, {
    // Fire a little before the block reaches the bottom edge, so the motion
    // has finished by the time the visitor is actually looking at it.
    rootMargin: "0px 0px -12% 0px",
    threshold: 0.05
  });

  targets.forEach(target => {
    // Anything already on screen at load reveals immediately — no fade-in for
    // content the visitor can see before they have scrolled at all.
    const box = target.getBoundingClientRect();
    if (box.top < window.innerHeight && box.bottom > 0) {
      reveal(target);
    } else {
      observer.observe(target);
    }
  });
})();
