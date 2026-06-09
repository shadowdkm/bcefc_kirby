/* Shared chrome — Nav + Footer. Active prop highlights current page. */

const NAV_ITEMS = [
  { label: "首頁", key: "home" },
  { label: "認識我們", key: "about", caret: true },
  { label: "新朋友", key: "new" },
  { label: "崇拜與資源", key: "worship", caret: true },
  { label: "事工群體", key: "ministries" },
  { label: "三人行", key: "tpw" },
  { label: "最新消息", key: "news" },
];

function Nav({ active }) {
  return (
    <nav className="nav">
      <a className="brand" href="#">
        <span>
          <div className="brand-name">本立比華人播道會</div>
          <div className="brand-sub">Burnaby Chinese Evangelical Free Church</div>
        </span>
      </a>
      <div className="nav-links">
        {NAV_ITEMS.map((it) => (
          <a key={it.key} href="#" className={active === it.key ? "active" : ""}>
            {it.label}
            {it.caret && <span className="caret"><Icon name="arrow" size={13} /></span>}
          </a>
        ))}
      </div>
      <div className="nav-right">
        <span className="lang"><Icon name="translate" size={17} />粵語</span>
        <a href="#" className="btn btn-primary btn-sm"><Icon name="heart" size={16} />奉獻支持</a>
      </div>
    </nav>
  );
}

function Footer() {
  return (
    <footer className="foot">
      <div className="wrap foot-top">
        <div>
          <a className="brand" href="#">
            <ChurchMark size={46} className="brand-emblem foot-emblem" />
            <span>
              <div className="brand-name" style={{ fontSize: "20px" }}>本立比華人播道會</div>
              <div className="brand-sub">BCEFC · Since 1991</div>
            </span>
          </a>
          <p className="foot-about">致力於建立一個生命轉化的屬靈大家庭，帶領萬民作主耶穌基督的門徒。</p>
          <div className="foot-social">
            <a href="#" aria-label="Facebook"><Icon name="facebook" size={19} /></a>
            <a href="#" aria-label="YouTube"><Icon name="youtube" size={19} /></a>
            <a href="#" aria-label="Instagram"><Icon name="instagram" size={19} /></a>
          </div>
        </div>
        <div>
          <h4>快速連結</h4>
          <ul>
            <li><a href="#">主日崇拜時間</a></li>
            <li><a href="#">線上直播 Livestream</a></li>
            <li><a href="#">最新消息與活動</a></li>
            <li><a href="#">中文學校</a></li>
            <li><a href="#">奉獻支持 Giving</a></li>
          </ul>
        </div>
        <div>
          <h4>聯絡資料</h4>
          <div className="foot-contact">
            <div className="c-row"><Icon name="pin" size={18} /><span>6112 Rumble Street<br/>Burnaby, BC V5J 2C7</span></div>
            <div className="c-row"><Icon name="phone" size={18} /><span>(604) 431-6969</span></div>
            <div className="c-row"><Icon name="mail" size={18} /><span>info@bcefc.ca</span></div>
            <div className="c-row"><Icon name="clock" size={18} /><span>辦公時間 週二至週五 9AM–5PM</span></div>
          </div>
        </div>
        <div>
          <h4>主日聚會</h4>
          <ul>
            <li><a href="#">國語崇拜 · 9:15 AM</a></li>
            <li><a href="#">粵語崇拜 · 11:00 AM</a></li>
            <li><a href="#">English Worship · 11:00 AM</a></li>
            <li><a href="#">兒童及青少年主日學</a></li>
          </ul>
        </div>
      </div>
      <div className="foot-bottom">© 2026 本立比華人播道會 Burnaby Chinese Evangelical Free Church · All Rights Reserved.</div>
    </footer>
  );
}

Object.assign(window, { Nav, Footer, NAV_ITEMS });
