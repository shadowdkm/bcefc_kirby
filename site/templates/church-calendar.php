<?php
$lang = $kirby->language() ? $kirby->language()->code() : 'en';

$categoryColors = [
  'worship'    => '#BC5630',
  'fellowship' => '#B6852F',
  'youth'      => '#4A7EB5',
  'children'   => '#5A9E6F',
  'special'    => '#7E6AAE',
  'general'    => '#8C7E72',
];

$fcEvents = [];
foreach ($page->children()->listed() as $event) {
  $cat   = (string)$event->category() ?: 'general';
  $color = $categoryColors[$cat] ?? '#8C7E72';
  $allDay = $event->all_day()->toBool();

  $e = [
    'id'    => $event->slug(),
    'title' => (string)$event->title(),
    'start' => $event->date_start()->toDate('c'),
    'color' => $color,
    'extendedProps' => [
      'location'    => (string)$event->location(),
      'category'    => $cat,
      'description' => strip_tags((string)$event->description()->toBlocks()),
    ],
  ];

  if ($event->date_end()->isNotEmpty()) {
    $e['end'] = $event->date_end()->toDate('c');
  }

  if ($allDay) {
    $e['allDay'] = true;
    // Strip time from start/end for all-day events
    $e['start'] = $event->date_start()->toDate('Y-m-d');
    if ($event->date_end()->isNotEmpty()) {
      // FullCalendar all-day end is exclusive, add 1 day
      $e['end'] = date('Y-m-d', strtotime($event->date_end()->toDate('Y-m-d') . ' +1 day'));
    }
  }

  $fcEvents[] = $e;
}

$eventsJson = json_encode($fcEvents, JSON_UNESCAPED_UNICODE);

$categoryLabels = [
  'worship'    => t('cal.cat.worship',    '崇拜'),
  'fellowship' => t('cal.cat.fellowship', '團契'),
  'youth'      => t('cal.cat.youth',      '青少年'),
  'children'   => t('cal.cat.children',  '兒童'),
  'special'    => t('cal.cat.special',   '特別活動'),
  'general'    => t('cal.cat.general',   '一般'),
];
?>
<?php snippet('header') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css">

<section class="cal-hero">
  <div class="container">
    <h1><?= $page->title()->esc() ?></h1>
  </div>
</section>

<section class="cal-wrap">
  <div class="container">

    <!-- Legend -->
    <div class="cal-legend">
      <?php foreach ($categoryColors as $key => $color): ?>
      <span class="cal-legend-item">
        <span class="cal-legend-dot" style="background:<?= esc($color) ?>"></span>
        <?= $categoryLabels[$key] ?? $key ?>
      </span>
      <?php endforeach ?>
    </div>

    <div id="bcefc-calendar"></div>

    <!-- Event detail popover -->
    <div id="cal-popover" class="cal-popover" hidden>
      <button class="cal-popover__close" id="cal-popover-close" aria-label="Close">×</button>
      <p class="cal-popover__cat" id="cal-popover-cat"></p>
      <h3 class="cal-popover__title" id="cal-popover-title"></h3>
      <p class="cal-popover__time" id="cal-popover-time"></p>
      <p class="cal-popover__loc" id="cal-popover-loc"></p>
      <p class="cal-popover__desc" id="cal-popover-desc"></p>
    </div>

  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script>
(function () {
  var lang = <?= json_encode($lang) ?>;
  var fcLang = lang === 'zh-tw' ? 'zh-tw' : lang === 'zh-cn' ? 'zh-cn' : 'en';
  var events = <?= $eventsJson ?>;

  var popover   = document.getElementById('cal-popover');
  var popTitle  = document.getElementById('cal-popover-title');
  var popCat    = document.getElementById('cal-popover-cat');
  var popTime   = document.getElementById('cal-popover-time');
  var popLoc    = document.getElementById('cal-popover-loc');
  var popDesc   = document.getElementById('cal-popover-desc');
  var popClose  = document.getElementById('cal-popover-close');

  var catLabels = <?= json_encode($categoryLabels, JSON_UNESCAPED_UNICODE) ?>;

  function formatEventTime(info) {
    if (info.event.allDay) return fcLang === 'en' ? 'All Day' : '全天';
    var opts = { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    var s = info.event.start ? info.event.start.toLocaleString(fcLang === 'en' ? 'en-CA' : fcLang, opts) : '';
    var e = info.event.end   ? info.event.end.toLocaleString(fcLang === 'en' ? 'en-CA' : fcLang, opts) : '';
    return e ? s + ' – ' + e : s;
  }

  var cal = new FullCalendar.Calendar(document.getElementById('bcefc-calendar'), {
    locale: fcLang,
    initialView: 'dayGridMonth',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,listMonth'
    },
    events: events,
    height: 'auto',
    eventClick: function(info) {
      info.jsEvent.preventDefault();
      var ep = info.event.extendedProps;
      popCat.textContent  = catLabels[ep.category] || ep.category;
      popCat.style.color  = info.event.backgroundColor;
      popTitle.textContent = info.event.title;
      popTime.textContent  = formatEventTime(info);
      popLoc.textContent   = ep.location || '';
      popLoc.hidden        = !ep.location;
      popDesc.textContent  = ep.description || '';
      popDesc.hidden       = !ep.description;
      popover.hidden = false;
    },
  });

  cal.render();

  popClose.addEventListener('click', function() { popover.hidden = true; });
  document.addEventListener('keydown', function(e) { if (e.key === 'Escape') popover.hidden = true; });
})();
</script>

<?php snippet('footer') ?>
