/* Icon set — simple, consistent line icons. Stroke inherits currentColor. */
const ICONS = {
  clock: <><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></>,
  book: <><path d="M4 5a2 2 0 0 1 2-2h7v16H6a2 2 0 0 0-2 2z"/><path d="M13 3h5a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1h-5"/></>,
  users: <><circle cx="9" cy="8" r="3.2"/><path d="M3.5 19a5.5 5.5 0 0 1 11 0"/><path d="M16 5.2a3.2 3.2 0 0 1 0 6"/><path d="M17 13.5a5.5 5.5 0 0 1 3.5 5.1"/></>,
  calendar: <><rect x="3.5" y="5" width="17" height="15" rx="2.5"/><path d="M3.5 9.5h17M8 3v4M16 3v4"/></>,
  heart: <path d="M12 20s-7-4.6-9.2-9C1.4 8.2 2.6 5 5.8 5c2 0 3.2 1.4 4.2 2.6C11 6.4 12.2 5 14.2 5 17.4 5 18.6 8.2 17.2 11 15 15.4 12 20 12 20z"/>,
  pin: <><path d="M12 21s7-6.2 7-11a7 7 0 0 0-14 0c0 4.8 7 11 7 11z"/><circle cx="12" cy="10" r="2.6"/></>,
  video: <><rect x="3" y="6" width="13" height="12" rx="2.5"/><path d="M16 10.5l5-3v9l-5-3z"/></>,
  globe: <><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.6 2.5 15.4 0 18M12 3c-2.5 2.6-2.5 15.4 0 18"/></>,
  phone: <path d="M5 4h3.5l1.5 4-2 1.5a12 12 0 0 0 5 5L19.5 16l1.5 4H17a13 13 0 0 1-12-12z"/>,
  mail: <><rect x="3" y="5" width="18" height="14" rx="2.5"/><path d="m4 7 8 6 8-6"/></>,
  arrow: <path d="M5 12h14m-6-6 6 6-6 6"/>,
  arrowUR: <path d="M7 17 17 7M9 7h8v8"/>,
  translate: <><path d="M4 5h9M8.5 5v2.5M11 5c-.6 5-3.4 8.5-8 10"/><path d="M5.5 11c1.8 1.8 4 3 7 3.5"/><path d="m13 19 3.5-8 3.5 8M14.3 16.2h4.4"/></>,
  cross: <path d="M10 3h4v5h5v4h-5v9h-4v-9H5V8h5z"/>,
  flame: <path d="M12 3c1 3-2 4-2 7a2 2 0 0 0 4 0c0-1 .8 1.5 .8 3a4.8 4.8 0 1 1-9.6 0C5.2 8.5 10 7 12 3z"/>,
  hands: <path d="M12 21c4 0 7-3 7-7v-4a1.5 1.5 0 0 0-3 0V6a1.5 1.5 0 0 0-3 0 1.5 1.5 0 0 0-3 0v.5A1.5 1.5 0 0 0 7 7v5l-1.5-1.5a1.6 1.6 0 0 0-2.3 2.3L7 18"/>,
  seed: <><path d="M12 21v-7"/><path d="M12 14c0-3-2.5-5-6-5 0 3 2.5 5 6 5z"/><path d="M12 12c0-3 2.5-5 6-5 0 3-2.5 5-6 5z"/></>,
  compass: <><circle cx="12" cy="12" r="9"/><path d="m15.5 8.5-2 5-5 2 2-5z"/></>,
  chevron: <path d="m6 9 6 6 6-6"/>,
  child: <><circle cx="12" cy="6" r="2.5"/><path d="M12 8.5V15M8 11h8M9 20l3-5 3 5"/></>,
  music: <><circle cx="8" cy="17" r="2.5"/><circle cx="18" cy="15" r="2.5"/><path d="M10.5 17V6l8-1.5V15"/></>,
  shield: <path d="M12 3 5 6v5c0 4.5 3 7.5 7 9 4-1.5 7-4.5 7-9V6z"/>,
  sparkle: <path d="M12 3l1.8 5.4L19 10l-5.2 1.6L12 17l-1.8-5.4L5 10l5.2-1.6z"/>,
  car: <><path d="M5 16v2M19 16v2M4 12l1.5-4.5A2 2 0 0 1 7.4 6h9.2a2 2 0 0 1 1.9 1.5L20 12"/><rect x="3.5" y="12" width="17" height="5" rx="1.5"/><circle cx="7.5" cy="14.5" r="0" /></>,
  shirt: <path d="M8 4 4 7l2 2 1-1v11h10V8l1 1 2-2-4-3-2 2a3 3 0 0 1-4 0z"/>,
  ticket: <path d="M4 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2 2 2 0 0 0 0 4 2 2 0 0 1-2 2H6a2 2 0 0 1-2-2 2 2 0 0 0 0-4z"/>,
  facebook: <path d="M14 8.5h2.2V5.3H14c-2.1 0-3.3 1.3-3.3 3.5v1.9H8.5v3.2h2.2V21h3.3v-7.1h2.4l.5-3.2h-2.9V9.2c0-.5.3-.7.9-.7z"/>,
  youtube: <><rect x="3" y="6" width="18" height="12" rx="3.5"/><path d="m10.5 9.3 4.5 2.7-4.5 2.7z"/></>,
  instagram: <><rect x="4" y="4" width="16" height="16" rx="4.5"/><circle cx="12" cy="12" r="3.4"/><circle cx="16.7" cy="7.3" r="1.1" fill="currentColor" stroke="none"/></>,
};

function Icon({ name, size, fill }) {
  return (
    <svg viewBox="0 0 24 24" width={size||24} height={size||24}
      fill="none" stroke="currentColor" strokeWidth="1.7"
      strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
      {ICONS[name]}
    </svg>
  );
}

Object.assign(window, { Icon, ICONS });
