// Lightbox
Array.from(document.querySelectorAll("[data-lightbox]")).forEach(element => {
  element.onclick = (e) => {
    e.preventDefault();
    basicLightbox.create(`<img src="${element.href}">`).show();
  };
});

// Hero background — fades the first photo in once it has actually decoded, then
// loads the remaining slides and cross-fades them on a timer.
//
// The slide order is shuffled server-side (site/snippets/blocks/hero.php); only
// the first slide ships with a src, so the browser spends all its bandwidth on
// the photo that is actually about to be shown.
(function () {
  const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  // Resolves once the image has pixels. A cached image is already `complete`
  // before this script runs, so its load event never fires — hence the check.
  const ready = (img) => new Promise(resolve => {
    if (img.dataset.src) {
      if (img.dataset.srcset) img.srcset = img.dataset.srcset;
      img.src = img.dataset.src;
      delete img.dataset.src;
      delete img.dataset.srcset;
    }
    if (img.complete && img.naturalWidth > 0) return resolve(img);
    img.addEventListener("load", () => resolve(img), { once: true });
    img.addEventListener("error", () => resolve(img), { once: true });
  });

  // Two frames: the first guarantees the browser has painted the slide at
  // opacity 0, so the fade also plays for a cached image instead of popping.
  const show = (img) => requestAnimationFrame(() => requestAnimationFrame(() => {
    img.classList.add("is-active");
  }));

  Array.from(document.querySelectorAll("[data-hero-slideshow]")).forEach(bg => {
    const slides = Array.from(bg.querySelectorAll(".block-hero__slide"));
    if (slides.length === 0) return;

    ready(slides[0]).then(() => show(slides[0]));

    // Hard cuts every few seconds are worse than no slideshow at all for
    // anyone who asked for less motion — leave them on the first photo.
    if (slides.length < 2 || reduceMotion) return;

    const rotate = () => {
      let index = 0;
      const interval = parseInt(bg.getAttribute("data-interval"), 10) || 6000;
      setInterval(() => {
        slides[index].classList.remove("is-active");
        index = (index + 1) % slides.length;
        slides[index].classList.add("is-active");
      }, interval);
    };

    // Fetch the remaining photos one at a time — in parallel they would just
    // throttle each other — and only start rotating once they can all cross-fade
    // instantly.
    const start = () => slides
      .slice(1)
      .reduce((chain, img) => chain.then(() => ready(img)), Promise.resolve())
      .then(rotate);

    // Pull the other photos in only after everything else has landed, so they
    // never compete with the first paint.
    if (document.readyState === "complete") {
      start();
    } else {
      window.addEventListener("load", start, { once: true });
    }
  });
})();

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
