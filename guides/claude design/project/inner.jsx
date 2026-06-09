/* Inner pages — About + Worship. `v` namespaces image slots. */

function PageBanner({ crumb, title, sub, v, slot }) {
  return (
    <div className="pbanner">
      <image-slot id={`${v}-${slot}`} shape="rect" placeholder="拖入頁面橫幅相片 · Drop a banner photo"></image-slot>
      <div className="hero-scrim"></div>
      <HeroChurchDivider />
      <div className="pbanner-inner">
        <div className="wrap-wide" style={{ padding: 0 }}>
          <div className="crumb"><a href="#">首頁</a> &nbsp;/&nbsp; {crumb}</div>
          <h1 className="pbanner-title">{title}</h1>
          <div className="pbanner-sub">{sub}</div>
        </div>
      </div>
    </div>
  );
}

/* ---------------------------------------------------------------- About -- */
const PURPOSES = [
  { icon: "hands", title: "敬拜父神", text: "藉感恩、詩歌與分享，享受主的同在，包括聖餐與禱告。" },
  { icon: "seed", title: "靈命成長", text: "研讀神的話語，應用聖經原則在生活中，活出基督的品格。" },
  { icon: "users", title: "彼此關心", text: "互相造就與激勵，發揮屬靈恩賜，在愛中彼此服侍。" },
  { icon: "flame", title: "傳揚福音", text: "藉聖經與生活見證，與身邊的人分享福音的好消息。" },
];

const STAFF = [
  { name: "林海鴻牧師", en: "Rev. Sam Lam", role: "帶領牧者兼中文事工牧者",
    bio: "出生於香港，一九九八年決志信主。畢業於播道神學院（道學碩士），於二零一六年加入本立比華人播道會事奉至今，帶領教會方向並牧養中文事工。" },
  { name: "張恩惠傳道", en: "Pastor Grace Chang", role: "兒童事工牧者",
    bio: "生於基督教家庭，自小立志將一生投資在天國的事上。曾於美國萬國兒童佈道團進修，特別喜愛兒童，於二零一三年加入 BCEFC 同心事奉。" },
  { name: "林秀珍傳道", en: "Pastor Jean Lam", role: "少年事工牧者",
    bio: "二零零四年決志信主，蒙召於加拿大華人神學院修讀神學研究碩士，二零二五年畢業後加入本會，牧養少年並關注他們的內在成長。" },
];

function AboutPage({ v }) {
  return (
    <div className="page">
      <Nav active="about" />
      <PageBanner v={v} slot="about-banner" crumb="認識我們" title="教會簡介" sub="Church Introduction" />

      <section className="section">
        <div className="wrap-wide">
          <div className="split">
            <div className="prose">
              <p className="eyebrow">Our Story · 我們的故事</p>
              <h2 style={{ marginTop: "14px" }}>三十五年，一個轉化生命的家</h2>
              <p>在溫哥華華人播道會的帶領下，連同五十多位弟兄姊妹，本立比華人播道會於<strong>一九九一年六月</strong>正式成立。自此，我們在本立比社區傳揚福音，服侍區內居民種種需要。</p>
              <p>今天的我們，是一個跨越國語、粵語與英語的屬靈大家庭 — 在敬拜中親近神，在門訓中彼此建立，並一同把基督的愛帶進社區。</p>
            </div>
            <div>
              <image-slot id={`${v}-about-story`} shape="rounded" radius="22"
                style={{ height: "440px" }} placeholder="教會合照 · Congregation photo"></image-slot>
            </div>
          </div>
        </div>
      </section>

      <section className="section worship">
        <div className="wrap-wide">
          <div className="sec-head" style={{ textAlign: "center" }}>
            <p className="eyebrow">Our Fourfold Purpose · 四重目標</p>
            <h2 className="title">作為基督的身體，我們同奔這召</h2>
          </div>
          <div className="values">
            {PURPOSES.map((p, i) => (
              <div key={i} className="value">
                <span className="v-ico"><Icon name={p.icon} size={25} /></span>
                <span>
                  <div className="v-title">{p.title}</div>
                  <div className="v-text">{p.text}</div>
                </span>
              </div>
            ))}
          </div>
        </div>
      </section>

      <section className="section">
        <div className="wrap-wide">
          <div className="sec-head" style={{ textAlign: "center" }}>
            <p className="eyebrow">Pastoral Staff</p>
            <h2 className="title">牧者與同工</h2>
            <p className="sub" style={{ margin: "16px auto 0" }}>我們的牧者團隊致力於服事神與服事教會，帶領弟兄姊妹在信仰上成長。</p>
          </div>
          <div className="people">
            {STAFF.map((s, i) => (
              <article key={i} className="pcard">
                <image-slot id={`${v}-staff-${i}`} shape="rect" placeholder="牧者相片 · Portrait"></image-slot>
                <div className="p-body">
                  <div className="p-name">{s.name}</div>
                  <div className="p-name-en">{s.en}</div>
                  <div className="p-role">{s.role}</div>
                  <div className="p-bio">{s.bio}</div>
                </div>
              </article>
            ))}
          </div>
        </div>
      </section>

      <section className="section band">
        <div className="wrap-wide">
          <div className="band-grid">
            <div>
              <p className="eyebrow on-dark">Get in Touch</p>
              <h2 className="b-title">我們很想<br/>認識你</h2>
              <p className="b-text">歡迎您來認識我們的教會、我們的信仰與我們的團隊。如有任何問題，隨時與我們聯繫。</p>
              <div className="b-cta">
                <a href="#" className="btn btn-primary"><Icon name="mail" size={18} />聯繫我們</a>
                <a href="#" className="btn btn-ghost-dark">五年計劃與方向<Icon name="arrow" size={18} /></a>
              </div>
            </div>
            <div className="give-card">
              <div className="g-row"><span className="g-ico"><Icon name="pin" size={22} /></span><span><div className="g-label">教會地址</div><div className="g-meta">6112 Rumble Street, Burnaby, BC</div></span></div>
              <div className="g-row"><span className="g-ico"><Icon name="phone" size={22} /></span><span><div className="g-label">電話</div><div className="g-meta">(604) 431-6969</div></span></div>
              <div className="g-row"><span className="g-ico"><Icon name="mail" size={22} /></span><span><div className="g-label">電郵</div><div className="g-meta">info@bcefc.ca</div></span></div>
            </div>
          </div>
        </div>
      </section>

      <Footer />
    </div>
  );
}

/* -------------------------------------------------------------- Worship -- */
const EXPECT = [
  { icon: "clock", title: "提早到達", text: "建議提早 10–15 分鐘到達，招待員會在門口歡迎你並協助入座。" },
  { icon: "users", title: "兒童節目", text: "所有崇拜時段均設有兒童主日學與看顧，讓家長安心敬拜。" },
  { icon: "video", title: "線上同步", text: "粵語崇拜設 YouTube 直播，遠方的肢體也能一同敬拜。" },
];

const MORE = [
  { icon: "book", title: "主日學", text: "成人、青少年及兒童各級聖經課程，循序漸進建立信仰根基。" },
  { icon: "hands", title: "禱告會", text: "每週固定的同心禱告聚會，一同為教會、社區與宣教守望。" },
  { icon: "video", title: "講道重溫", text: "錯過了主日？歷期信息與崇拜直播隨時可在線上重溫。" },
];

function WorshipPage({ v }) {
  return (
    <div className="page">
      <Nav active="worship" />
      <PageBanner v={v} slot="worship-banner" crumb="崇拜與資源" title="主日崇拜" sub="Sunday Worship" />

      <section className="section">
        <div className="wrap-wide">
          <div className="prose" style={{ maxWidth: "720px", margin: "0 auto", textAlign: "center" }}>
            <p className="eyebrow" style={{ justifyContent: "center" }}>Worship With Us</p>
            <h2 style={{ marginTop: "14px" }}>以三種語言，同來敬拜</h2>
            <p>我們提供國語、粵語與英語三種語言的崇拜，服事多元的會眾。每場崇拜包括敬拜、禱告、讀經與聖經教導 — 無論你說哪種語言，這裡都有你的位置。</p>
          </div>
        </div>
      </section>

      <div style={{ marginTop: "-40px" }}>
        <WorshipTimes />
      </div>

      <section className="section">
        <div className="wrap-wide">
          <div className="sec-head" style={{ textAlign: "center" }}>
            <p className="eyebrow">What to Expect · 崇拜須知</p>
            <h2 className="title">第一次來，需要知道的事</h2>
          </div>
          <div className="info-grid">
            {EXPECT.map((e, i) => (
              <div key={i} className="info-card">
                <div className="i-ico"><Icon name={e.icon} size={25} /></div>
                <div className="i-title">{e.title}</div>
                <div className="i-text">{e.text}</div>
              </div>
            ))}
          </div>
        </div>
      </section>

      <section className="section news">
        <div className="wrap-wide">
          <div className="sec-head-row">
            <div>
              <p className="eyebrow">More Ways to Grow</p>
              <h2 className="title" style={{ fontFamily: "var(--font-cjk-serif)", fontWeight: 700, fontSize: "38px", marginTop: "10px" }}>崇拜以外，一同成長</h2>
            </div>
            <a href="#" className="textlink">全部資源<Icon name="arrow" size={17} /></a>
          </div>
          <div className="info-grid">
            {MORE.map((m, i) => (
              <div key={i} className="info-card" style={{ background: "var(--surface)" }}>
                <div className="i-ico"><Icon name={m.icon} size={25} /></div>
                <div className="i-title">{m.title}</div>
                <div className="i-text">{m.text}</div>
              </div>
            ))}
          </div>
        </div>
      </section>

      <section className="section band">
        <div className="wrap-wide" style={{ textAlign: "center" }}>
          <p className="eyebrow on-dark" style={{ justifyContent: "center" }}>New Here?</p>
          <h2 className="b-title" style={{ marginTop: "10px" }}>這個主日，來與我們一起</h2>
          <p className="b-text" style={{ margin: "18px auto 30px" }}>請提早到達，我們的招待員會在門口歡迎你。期待在崇拜中與你相見。</p>
          <div className="b-cta" style={{ justifyContent: "center" }}>
            <a href="#" className="btn btn-primary"><Icon name="hands" size={18} />我是新朋友</a>
            <a href="#" className="btn btn-ghost-dark"><Icon name="video" size={18} />線上敬拜入口</a>
          </div>
        </div>
      </section>

      <Footer />
    </div>
  );
}

Object.assign(window, { AboutPage, WorshipPage, PageBanner });
