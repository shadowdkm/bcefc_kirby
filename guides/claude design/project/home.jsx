/* Homepage — composed sections. `v` = variant key, used to namespace image slots. */

function Hero({ v }) {
  return (
    <header className="hero">
      <div className="hero-media">
        <image-slot id={`${v}-hero`} shape="rect" fit="cover"
          placeholder="拖入主視覺相片 · Drop a worship / congregation photo"></image-slot>
        <div className="hero-scrim"></div>
        <HeroChurchDivider />
      </div>
      <div className="hero-inner">
        <p className="hero-eyebrow">A Transforming Community · Making Disciples for Jesus Christ</p>
        <h1 className="hero-title">崇敬真神樂團契<br/>謹遵使命發光輝</h1>
        <p className="hero-sub">歡迎來到本立比華人播道會。我們以三種語言一同敬拜，盼望你在這裡找到屬於自己的屬靈大家庭。</p>
        <div className="hero-cta">
          <a href="#" className="btn btn-primary"><Icon name="hands" size={18} />我是新朋友</a>
          <a href="#" className="btn btn-ghost-dark">認識我們<Icon name="arrow" size={18} /></a>
        </div>
      </div>
      <div className="wrap-wide" style={{ position: "relative", zIndex: 3 }}>
        <div className="ribbon">
          <div className="ribbon-cell">
            <span className="ribbon-lang">國語崇拜</span>
            <span className="ribbon-time">9:15 AM</span>
            <span className="ribbon-meta">主日 · 主堂 · 設兒童主日學</span>
          </div>
          <div className="ribbon-cell">
            <span className="ribbon-lang">粵語崇拜</span>
            <span className="ribbon-time">11:00 AM</span>
            <span className="ribbon-meta">主日 · 主堂 &amp; YouTube 直播</span>
          </div>
          <div className="ribbon-cell">
            <span className="ribbon-lang">English Worship</span>
            <span className="ribbon-time">11:00 AM</span>
            <span className="ribbon-meta">Sundays · Grade 9 – College+</span>
          </div>
        </div>
      </div>
    </header>
  );
}

const QUICK = [
  { icon: "hands", title: "我是新朋友", sub: "第一次拜訪的指引", feature: true },
  { icon: "video", title: "本週講道", sub: "重溫信息與直播" },
  { icon: "clock", title: "聚會時間", sub: "掌握主日安排" },
  { icon: "heart", title: "奉獻支持", sub: "參與事工發展" },
];

function QuickLinks() {
  return (
    <section className="section-tight" style={{ marginTop: "64px" }}>
      <div className="wrap-wide">
        <div className="qlinks">
          {QUICK.map((q, i) => (
            <a key={i} href="#" className={`qcard${q.feature ? " feature" : ""}`}>
              <span className="q-ico"><Icon name={q.icon} size={27} /></span>
              <span>
                <div className="q-title">{q.title}</div>
                <div className="q-sub">{q.sub}</div>
              </span>
              <span className="q-go">前往<Icon name="arrow" size={16} /></span>
            </a>
          ))}
        </div>
      </div>
    </section>
  );
}

function Welcome({ v }) {
  return (
    <section className="section welcome">
      <div className="wrap-wide">
        <div className="welcome-grid">
          <div className="welcome-media">
            <image-slot id={`${v}-welcome`} shape="rounded" radius="22"
              placeholder="拖入教會生活相片 · Drop a community photo"></image-slot>
            <div className="welcome-badge">
              <span className="num">35</span>
              <span className="lbl">年來與本立比社區<br/>同行的恩典</span>
            </div>
          </div>
          <div className="welcome-body">
            <p className="eyebrow">Welcome Home · 歡迎回家</p>
            <h2 className="title">無論你在人生的哪一站，<br/>這裡都有你的位置</h2>
            <p>本立比華人播道會自一九九一年成立，是一個跨越語言與世代的屬靈家庭。我們在敬拜中親近神，在團契中彼此扶持，並一同把福音的好消息帶進社區。</p>
            <div className="welcome-scripture">
              <p>「你們要彼此相愛，像我愛你們一樣。」</p>
              <cite>約翰福音 13:34</cite>
            </div>
            <div className="cta-row">
              <a href="#" className="btn btn-primary">計劃你的到訪<Icon name="arrow" size={18} /></a>
              <a href="#" className="textlink">認識我們的故事<Icon name="arrow" size={17} /></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

const SERVICES = [
  {
    lang: "國語崇拜 · MANDARIN", name: "國語崇拜",
    rows: [["clock", "每主日 9:15 AM"], ["pin", "教會主堂 · 實體聚會"], ["users", "同步兒童主日學 (G1–5)"]],
    desc: "融合現代詩歌與傳統聖詩，提供釋經講道，歡迎國語群體一同敬拜。",
    cta: "查看詳情", cls: "",
  },
  {
    lang: "粵語崇拜 · CANTONESE", name: "粵語崇拜", featured: true, badge: "設線上直播",
    rows: [["clock", "每主日 11:00 AM"], ["video", "主堂 & YouTube 直播"], ["globe", "遠方肢體也能同步敬拜"]],
    desc: "粵語崇拜融合傳統聖詩與現代敬拜，設有聖經講道與禱告服事。",
    cta: "線上敬拜入口", cls: "featured",
  },
  {
    lang: "ENGLISH WORSHIP", name: "English Worship",
    rows: [["clock", "Sundays 11:00 AM"], ["pin", "Fellowship Hall"], ["globe", "Grade 9 – College+"]],
    desc: "A contemporary service for the next generation — modern worship and relevant teaching.",
    cta: "Visit Site", cls: "",
  },
];

function WorshipTimes() {
  return (
    <section className="section worship">
      <div className="wrap-wide">
        <div className="sec-head-row">
          <div>
            <p className="eyebrow">Join Us This Sunday</p>
            <h2 className="title" style={{ fontFamily: "var(--font-cjk-serif)", fontWeight: 700, fontSize: "44px", marginTop: "12px" }}>本週聚會時間</h2>
          </div>
          <a href="#" className="textlink">查看完整時間表<Icon name="arrow" size={17} /></a>
        </div>
        <div className="wcards">
          {SERVICES.map((s, i) => (
            <article key={i} className={`wcard ${s.cls}`}>
              {s.badge && <span className="w-badge">{s.badge}</span>}
              <div className="w-lang">{s.lang}</div>
              <div className="w-name">{s.name}</div>
              <div className="w-rows">
                {s.rows.map((r, j) => (
                  <div key={j} className="wrow"><Icon name={r[0]} size={19} />{r[1]}</div>
                ))}
              </div>
              <div className="w-desc">{s.desc}</div>
              <div className="w-foot">
                <a href="#" className={`btn btn-block ${s.featured ? "btn-light" : "btn-outline"}`}>{s.cta}</a>
              </div>
            </article>
          ))}
        </div>
      </div>
    </section>
  );
}

const VM = [
  { no: "01", title: "我們的異象", text: "成為一個生命轉化的群體，使萬民作主耶穌基督的門徒，並影響我們所在的世界。" },
  { no: "02", title: "我們的使命", text: "藉敬拜榮耀神、藉門訓栽培信徒、藉福音接觸社區 — 在愛中一同成長。" },
  { no: "03", title: "三人行", text: "我們獨特的同行事工，將信徒兩三成群配搭，彼此守望，在信仰路上一同前行。", badge: "NEW" },
];

function VisionMission() {
  return (
    <section className="section">
      <div className="wrap-wide">
        <div className="sec-head" style={{ textAlign: "center" }}>
          <p className="eyebrow">Vision &amp; Mission</p>
          <h2 className="title">我們所信，我們所行</h2>
          <p className="sub" style={{ margin: "16px auto 0" }}>四重的目標貫穿我們的生活：敬拜父神、靈命成長、彼此關心、傳揚福音。</p>
        </div>
        <div className="vm-grid">
          {VM.map((c, i) => (
            <article key={i} className="vmcard">
              {c.badge && <span className="vm-badge">{c.badge}</span>}
              <div className="vm-no">{c.no}</div>
              <h3 className="vm-title">{c.title}</h3>
              <p className="vm-text">{c.text}</p>
              <div className="vm-link"><a href="#" className="textlink">了解更多<Icon name="arrow" size={17} /></a></div>
            </article>
          ))}
        </div>
      </div>
    </section>
  );
}

const NEWS = [
  { date: "2025 · 03 · 15", tag: "活動", title: "2025 春季奮興培靈會 — 三晚信息與詩歌敬拜" },
  { date: "2025 · 03 · 01", tag: "報名", title: "中文學校春季班現正接受報名" },
  { date: "2025 · 02 · 28", tag: "重要", title: "家庭營報名截止日期延長至本月底" },
  { date: "2025 · 02 · 20", tag: "", title: "新一季成人及兒童主日學課程開始" },
  { date: "2025 · 02 · 15", tag: "宣教", title: "墨西哥短宣隊最新消息與代禱事項" },
];

function NewsAndEvent({ v }) {
  return (
    <section className="section news">
      <div className="wrap-wide">
        <div className="news-grid">
          <div>
            <div className="sec-head-row" style={{ marginBottom: "32px" }}>
              <div>
                <p className="eyebrow">Latest News</p>
                <h2 className="title" style={{ fontFamily: "var(--font-cjk-serif)", fontWeight: 700, fontSize: "38px", marginTop: "10px" }}>最新消息</h2>
              </div>
              <a href="#" className="textlink">全部消息<Icon name="arrow" size={17} /></a>
            </div>
            <div className="news-list">
              {NEWS.map((n, i) => (
                <a key={i} href="#" className="news-item">
                  <span className="news-date">{n.date}</span>
                  <span className="news-main">
                    {n.tag && <span className="news-tag">{n.tag}</span>}
                    <div className="news-title">{n.title}</div>
                  </span>
                </a>
              ))}
            </div>
          </div>
          <article className="event-card">
            <div className="event-media">
              <image-slot id={`${v}-event`} shape="rect" placeholder="活動相片 · Event photo"></image-slot>
            </div>
            <div className="event-body">
              <div className="event-kicker">Featured Event · 焦點活動</div>
              <h3 className="event-title">35 週年感恩慶典</h3>
              <p className="event-text">三十五年的恩典，一同回顧、感恩與前瞻。誠邀新舊弟兄姊妹回家相聚。</p>
              <div className="event-meta">
                <span><Icon name="calendar" size={17} />2026 年 6 月</span>
                <span><Icon name="pin" size={17} />教會主堂</span>
              </div>
              <a href="#" className="btn btn-light btn-sm">了解詳情與報名<Icon name="arrow" size={16} /></a>
            </div>
          </article>
        </div>
      </div>
    </section>
  );
}

function Band() {
  return (
    <section className="section band">
      <div className="wrap-wide">
        <div className="band-grid">
          <div>
            <p className="eyebrow on-dark">New Here? · 第一次來?</p>
            <h2 className="b-title">我們已為你預留<br/>一個位置</h2>
            <p className="b-text">無論你正在尋索信仰、尋找教會的家，還是純粹好奇，你都被歡迎。這個主日，來與我們一起。</p>
            <div className="b-cta">
              <a href="#" className="btn btn-primary"><Icon name="hands" size={18} />計劃你的到訪</a>
              <a href="#" className="btn btn-ghost-dark"><Icon name="heart" size={18} />奉獻支持事工</a>
            </div>
          </div>
          <div className="give-card">
            <div className="g-row">
              <span className="g-ico"><Icon name="pin" size={22} /></span>
              <span><div className="g-label">地點</div><div className="g-meta">6112 Rumble Street, Burnaby</div></span>
            </div>
            <div className="g-row">
              <span className="g-ico"><Icon name="clock" size={22} /></span>
              <span><div className="g-label">主日聚會</div><div className="g-meta">9:15 AM · 11:00 AM</div></span>
            </div>
            <div className="g-row">
              <span className="g-ico"><Icon name="video" size={22} /></span>
              <span><div className="g-label">線上直播</div><div className="g-meta">YouTube @bcefc · 粵語崇拜</div></span>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

function HomePage({ v }) {
  return (
    <div className="page">
      <Nav active="home" />
      <Hero v={v} />
      <QuickLinks />
      <Welcome v={v} />
      <WorshipTimes />
      <VisionMission />
      <NewsAndEvent v={v} />
      <Band />
      <Footer />
    </div>
  );
}

Object.assign(window, { HomePage, WorshipTimes });
