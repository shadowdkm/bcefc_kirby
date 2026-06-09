/* BCEFC church emblem — faithful vector recreation of the building-outline
   logo (church silhouette + cross + olive sprig + figure). Building stroke
   inherits currentColor so it reads on both light and dark backgrounds;
   foliage + figure keep the brand greens / terracotta. */

function ChurchMark({ size = 48, className = "" }) {
  const w = size, h = Math.round(size * 74 / 116);
  return (
    <svg className={className} width={w} height={h} viewBox="6 10 116 74"
      fill="none" aria-hidden="true">
      {/* church building — outline, traced pixel-exact from the real logo */}
      <g stroke="currentColor" strokeWidth="5" strokeLinejoin="round" strokeLinecap="round" fill="none">
        <path d="M12,77.5 L12,49.6 L18.4,49.1 L43.3,16 L55.5,34.6 L61.9,34.6 L63.6,28.2 L73.5,31.7 L114.7,27 L115.8,65.3 L115.8,77.5" />
      </g>
      {/* free-standing cross to the right */}
      <g stroke="currentColor" strokeWidth="4.5" strokeLinecap="round">
        <line x1="101.5" y1="42" x2="101.5" y2="62" />
        <line x1="95" y1="49.5" x2="108" y2="49.5" />
      </g>
      {/* olive / laurel sprig — two-tone green */}
      {/* (figure + sprig removed) */}
    </svg>
  );
}

Object.assign(window, { ChurchMark });

/* Hero church-silhouette divider — traced pixel-exact from the church's own
   header-top.png (steep left gable, raised mid-section, long swoosh + the
   free-standing cross). Filled with `fill` (default page bg) so it reads as a
   knockout on the hero photo and blends into the content below. */
function HeroChurchDivider({ fill = "var(--bg)" }) {
  return (
    <div className="hero-divider" aria-hidden="true">
      <svg viewBox="0 0 1280 147" preserveAspectRatio="none">
        <path fill={fill}
          d="M0,147 L0,144 L32,141 L33,99 L44,98 L87,41 L108,73 L119,73 L122,62 L139,68 L210,60 L212,126 L347,118 L479,113 L583,111 L783,112 L909,116 L1025,122 L1161,132 L1279,144 L1279,147 Z" />
        {/* free-standing cross on the right of the building */}
        <g fill="#9A8C7C">
          <rect x="186" y="88" width="6" height="31" rx="1.5" />
          <rect x="179" y="96" width="20" height="6" rx="1.5" />
        </g>
      </svg>
    </div>
  );
}

Object.assign(window, { ChurchMark, HeroChurchDivider });
