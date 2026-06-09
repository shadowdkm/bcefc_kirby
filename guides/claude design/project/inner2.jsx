/* Inner pages, set 2 — New Here · Ministries · Three-Person Walk. */
const { useState: useState2 } = React;

/* --------------------------------------------------------- New Here ----- */
const NH_STEPS = [
  { no: "1", title: "找到我們", text: "教會位於 Burnaby 6112 Rumble Street，設有免費停車場，鄰近街道亦有車位。" },
  { no: "2", title: "受到歡迎", text: "招待員會在門口迎接你，協助你入座，並為你介紹適合的崇拜場次與兒童節目。" },
  { no: "3", title: "找到歸屬", text: "填寫訪客卡、參加每月新朋友午餐，或加入團契 — 我們樂意幫你找到屬於你的位置。" },
];

const NH_FAQ = [
  { q: "聚會時間是什麼時候？", a: "我們主日設三堂崇拜：國語崇拜上午 9:15；粵語崇拜與 English Worship 上午 11:00。" },
  { q: "我應該穿什麼？", a: "隨意穿著就好！從休閒服到正裝的人都有 — 我們更在意你的到來，而非你的穿著。" },
  { q: "有停車位嗎？", a: "有！我們設有免費停車場，鄰近街道亦有停車位。" },
  { q: "有兒童節目嗎？", a: "有！所有崇拜時段都為嬰幼兒至 12 年級的孩子提供適齡節目，報到處設於大堂。" },
  { q: "聚會用什麼語言？", a: "我們提供國語、粵語與英語崇拜。中文崇拜期間可使用耳機收聽英語即時翻譯。" },
  { q: "我需要奉獻嗎？", a: "完全沒有義務！奉獻是會友的敬拜行為，我們從不期望訪客奉獻。" },
];

function FaqItem({ q, a, open, onClick }) {
  const ref = React.useRef(null);
  return (
    <div className={`faq-item${open ? " open" : ""}`}>
      <button className="faq-q" onClick={onClick}>
        <span>{q}</span>
        <span className="fq-ico"><Icon name="chevron" size={17} /></span>
      </button>
      <div className="faq-a" style={{ maxHeight: open ? (ref.current ? ref.current.scrollHeight + 4 : 400) : 0 }}>
        <div className="faq-a-inner" ref={ref}>{a}</div>
      </div>
    </div>
  );
}

function NewHerePage({ v }) {
  const [open, setOpen] = useState2(0);
  return (
    <div className="page">
      <Nav active="new" />
      <PageBanner v={v} slot="new-banner" crumb="新朋友" title="新朋友？" sub="Welcome · 很高興您找到我們" />

      <section className="section">
        <div className="wrap-wide">
          <div className="prose" style={{ maxWidth: "740px", margin: "0 auto", textAlign: "center" }}>
            <p className="eyebrow" style={{ justifyContent: "center" }}>You Belong Here</p>
            <h2 style={{ marginTop: "14px" }}>無論你在尋索什麼，這裡都歡迎你</h2>
            <p>歡迎來到本立比華人播道會！我們知道第一次走進一間陌生的教會可能會有些緊張 — 所以我們希望讓你的第一次到訪盡可能輕鬆自在。以下是你可以期待的。</p>
          </div>
        </div>
      </section>

      <section className="section worship" style={{ paddingTop: "40px" }}>
        <div className="wrap-wide">
          <div className="sec-head" style={{ textAlign: "center" }}>
            <p className="eyebrow">Your First Visit · 三個簡單步驟</p>
            <h2 className="title">第一次到訪，這樣開始</h2>
          </div>
          <div className="steps">
            {NH_STEPS.map((s, i) => (
              <div key={i} className="step">
                <div className="s-no">{s.no}</div>
                <div className="s-title">{s.title}</div>
                <div className="s-text">{s.text}</div>
              </div>
            ))}
          </div>
        </div>
      </section>

      <section className="section">
        <div className="wrap-wide">
          <div className="sec-head" style={{ textAlign: "center" }}>
            <p className="eyebrow">Good to Know</p>
            <h2 className="title">常見問題</h2>
            <p className="sub" style={{ margin: "16px auto 0" }}>第一次來，這些是大家最常問的問題。</p>
          </div>
          <div className="faq">
            {NH_FAQ.map((f, i) => (
              <FaqItem key={i} q={f.q} a={f.a} open={open === i} onClick={() => setOpen(open === i ? -1 : i)} />
            ))}
          </div>
        </div>
      </section>

      <section className="section band">
        <div className="wrap-wide">
          <div className="band-grid">
            <div>
              <p className="eyebrow on-dark">Let Us Know You're Coming</p>
              <h2 className="b-title">填一張訪客卡，<br/>讓我們先認識你</h2>
              <p className="b-text">提前讓我們知道你要來，這個主日我們會特別為你預備，並在你到達時親自迎接你。</p>
              <div className="b-cta">
                <a href="#" className="btn btn-primary"><Icon name="ticket" size={18} />填寫訪客卡</a>
                <a href="#" className="btn btn-ghost-dark"><Icon name="mail" size={18} />聯繫我們</a>
              </div>
            </div>
            <div className="give-card">
              <div className="g-row"><span className="g-ico"><Icon name="car" size={22} /></span><span><div className="g-label">免費停車</div><div className="g-meta">設停車場 · 鄰近街道亦有車位</div></span></div>
              <div className="g-row"><span className="g-ico"><Icon name="shirt" size={22} /></span><span><div className="g-label">穿著隨意</div><div className="g-meta">舒適自在最重要</div></span></div>
              <div className="g-row"><span className="g-ico"><Icon name="child" size={22} /></span><span><div className="g-label">兒童節目</div><div className="g-meta">嬰幼兒 – 12 年級 · 各場次皆有</div></span></div>
            </div>
          </div>
        </div>
      </section>

      <Footer />
    </div>
  );
}

/* -------------------------------------------------------- Ministries ---- */
const MIN_SECTIONS = [
  {
    zh: "英語事工", en: "English Ministry",
    cards: [
      { icon: "child", title: "兒童事工（一至五年級）", text: "透過適齡的聖經教導與活動，培育孩子的信仰根基。" },
      { icon: "users", title: "SPORTEF（六至九年級）", text: "藉團契、門訓與豐富活動，幫助高小至初中生在身份與信仰中成長。" },
      { icon: "sparkle", title: "Little House Fellows（九年級至大學）", text: "英語青少年事工 — 週六晚 7 時及主日上午 9:30。" },
    ],
  },
  {
    zh: "粵語事工", en: "Cantonese Ministry",
    cards: [
      { icon: "book", title: "宗教教育部", text: "藉讀經運動、主題講座、主日學及逾三千冊藏書的圖書館，推動靈命成長。" },
      { icon: "flame", title: "傳道部", text: "藉個人佈道訓練、福音主日與佈道會，裝備會眾完成大使命。" },
      { icon: "users", title: "團契部", text: "促進教會各團契之間的群體關係與合一精神。" },
      { icon: "heart", title: "關顧部", text: "藉電話、卡片、膳食、長者探訪及新朋友跟進，表達基督的愛。" },
      { icon: "music", title: "崇拜部", text: "讓會友運用恩賜，確保每主日崇拜在聖靈帶領下有意義地進行。" },
      { icon: "shield", title: "總務部", text: "忠心管理教會設施，為會眾提供安全舒適的聚會環境。" },
      { icon: "globe", title: "差傳部", text: "以耶穌基督的福音接觸本地與全球。" },
      { icon: "video", title: "影音科技部", text: "管理音響、電腦與技術系統，支援崇拜及教會日常運作。" },
    ],
  },
  {
    zh: "國語事工", en: "Mandarin Ministry",
    cards: [
      { icon: "seed", title: "國語事工", text: "二零一三年成立，提供每週崇拜、主日學、查經及青少年團契。" },
    ],
  },
];

function MinistriesPage({ v }) {
  return (
    <div className="page">
      <Nav active="ministries" />
      <PageBanner v={v} slot="min-banner" crumb="事工群體" title="教會事工" sub="Ministries · 同心服事神與社群" />

      <section className="section" style={{ paddingBottom: "30px" }}>
        <div className="wrap-wide">
          <div className="prose" style={{ maxWidth: "740px", margin: "0 auto", textAlign: "center" }}>
            <h2 style={{ marginTop: 0 }}>一個身體，許多肢體</h2>
            <p>從兒童到長者、從崇拜到差傳，我們的事工讓每位弟兄姊妹都能運用恩賜，服事神、服事彼此，並服事我們所在的社區。</p>
          </div>
        </div>
      </section>

      {MIN_SECTIONS.map((sec, i) => (
        <section key={i} className="min-band">
          <div className="wrap-wide">
            <div className="min-head">
              <span className="m-zh">{sec.zh}</span>
              <span className="m-en">{sec.en}</span>
              <span className="m-rule"></span>
            </div>
            <div className="mgrid">
              {sec.cards.map((c, j) => (
                <a key={j} href="#" className="mcard">
                  <span className="mc-media">
                    <image-slot id={`min-${i}-${j}`} shape="rect" fit="cover"
                      placeholder="事工相片"></image-slot>
                    <span className="mc-ico"><Icon name={c.icon} size={22} /></span>
                  </span>
                  <span className="mc-body">
                    <span className="mc-title">{c.title}</span>
                    <span className="mc-text">{c.text}</span>
                    <span className="mc-go">了解更多<Icon name="arrow" size={15} /></span>
                  </span>
                </a>
              ))}
            </div>
          </div>
        </section>
      ))}

      <section className="section band">
        <div className="wrap-wide" style={{ textAlign: "center" }}>
          <p className="eyebrow on-dark" style={{ justifyContent: "center" }}>Find Your Place</p>
          <h2 className="b-title" style={{ marginTop: "10px" }}>找到你可以服事的地方</h2>
          <p className="b-text" style={{ margin: "18px auto 30px" }}>無論你的恩賜在哪裡，總有一處事工正需要你。歡迎與我們聯繫，一起服事。</p>
          <div className="b-cta" style={{ justifyContent: "center" }}>
            <a href="#" className="btn btn-primary"><Icon name="hands" size={18} />我想參與服事</a>
            <a href="#" className="btn btn-ghost-dark"><Icon name="mail" size={18} />聯繫同工</a>
          </div>
        </div>
      </section>

      <Footer />
    </div>
  );
}

/* --------------------------------------------------- Three-Person Walk -- */
const TPW_HOW = [
  { icon: "book", title: "研讀聖經", text: "每週經文搭配討論問題" },
  { icon: "users", title: "彼此問責", text: "坦誠分享與互相鼓勵" },
  { icon: "hands", title: "禱告", text: "為彼此與共同關心的事禱告" },
  { icon: "compass", title: "生活應用", text: "在日常生活中實踐信仰" },
];

const TPW_WHY = [
  { q: "三", title: "理想的人數", text: "小到足以深入分享與彼此問責，大到能帶來多元的視角。" },
  { q: "週", title: "每週一小時", text: "三位同性別的信徒每週聚會約一小時，分享生活、查經、一同禱告。" },
  { q: "繩", title: "不易折斷", text: "正如三股合成的繩子 — 當有人軟弱時，另外兩人能扶持守望。" },
];

function ThreePersonWalkPage({ v }) {
  return (
    <div className="page">
      <Nav active="tpw" />
      <PageBanner v={v} slot="tpw-banner" crumb="三人行" title="三人行" sub="Three-Person Walk · 門徒訓練小組" />

      <section className="section tpw-verse">
        <div className="wrap-wide">
          <div className="tpw-three"><span className="tpw-dot"></span><span className="tpw-dot"></span><span className="tpw-dot"></span></div>
          <p className="v-text">「三股合成的繩子<br/>不容易折斷。」</p>
          <p className="v-cite">傳道書 4:12</p>
        </div>
      </section>

      <section className="section">
        <div className="wrap-wide">
          <div className="prose" style={{ maxWidth: "760px", margin: "0 auto", textAlign: "center" }}>
            <h2 style={{ marginTop: 0 }}>三位同行，一段屬靈旅程</h2>
            <p>三人行是我們獨特的門徒訓練模式 — 三位信徒在信仰、問責與成長中彼此同行。透過簡單而穩定的三人關係，我們一起聆聽、代禱、守望，走一段不孤單的屬靈路。</p>
          </div>
        </div>
      </section>

      <section className="section worship" style={{ paddingTop: "30px" }}>
        <div className="wrap-wide">
          <div className="sec-head" style={{ textAlign: "center" }}>
            <p className="eyebrow">How It Works · 核心元素</p>
            <h2 className="title">每次相聚，包含這四件事</h2>
          </div>
          <div className="how-grid">
            {TPW_HOW.map((h, i) => (
              <div key={i} className="how-card">
                <div className="h-ico"><Icon name={h.icon} size={28} /></div>
                <div className="h-title">{h.title}</div>
                <div className="h-text">{h.text}</div>
              </div>
            ))}
          </div>
        </div>
      </section>

      <section className="section">
        <div className="wrap-wide">
          <div className="sec-head" style={{ textAlign: "center" }}>
            <p className="eyebrow">Why Three?</p>
            <h2 className="title">為什麼是三人？</h2>
          </div>
          <div className="bignum-grid">
            {TPW_WHY.map((b, i) => (
              <div key={i} className="bignum">
                <div className="bn-q">{b.q}</div>
                <div className="bn-title">{b.title}</div>
                <div className="bn-text">{b.text}</div>
              </div>
            ))}
          </div>
        </div>
      </section>

      <section className="section band">
        <div className="wrap-wide">
          <div className="band-grid">
            <div>
              <p className="eyebrow on-dark">2026 Registration Open · 現已開放登記</p>
              <h2 className="b-title">2026 年國語<br/>「三人行」重新登記</h2>
              <p className="b-text">教會將於 2026 年 3 月重新啟動國語「三人行」小組。誠邀有興趣的弟兄姊妹填寫登記表，作配對與牧養安排之用。</p>
              <p className="b-text" style={{ fontSize: "14.5px", marginTop: "12px" }}>提交登記並不代表即時分組 — 教會將於稍後進行整體配對與安排。</p>
              <div className="b-cta">
                <a href="#" className="btn btn-primary"><Icon name="users" size={18} />填寫登記表</a>
                <a href="#" className="btn btn-ghost-dark"><Icon name="mail" size={18} />了解更多</a>
              </div>
            </div>
            <div className="give-card">
              <div className="g-row"><span className="g-ico"><Icon name="users" size={22} /></span><span><div className="g-label">三人成組</div><div className="g-meta">同性別 · 彼此守望同行</div></span></div>
              <div className="g-row"><span className="g-ico"><Icon name="clock" size={22} /></span><span><div className="g-label">每週一小時</div><div className="g-meta">分享 · 查經 · 禱告</div></span></div>
              <div className="g-row"><span className="g-ico"><Icon name="calendar" size={22} /></span><span><div className="g-label">2026 年 3 月啟動</div><div className="g-meta">國語小組 · 現正接受登記</div></span></div>
            </div>
          </div>
        </div>
      </section>

      <Footer />
    </div>
  );
}

Object.assign(window, { NewHerePage, MinistriesPage, ThreePersonWalkPage });
