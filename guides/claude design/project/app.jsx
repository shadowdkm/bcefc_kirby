/* Design canvas — 3 warm homepage directions + inner pages. */
const { useState } = React;

const W = 1280;

function Board({ theme, children }) {
  return <div className={`theme-${theme}`} style={{ width: "100%" }}>{children}</div>;
}

function App() {
  return (
    <DesignCanvas>
      <DCSection id="home" title="首頁 · Homepage" subtitle="A · Sanctuary — 暖砂 + 赤陶 + 金. Drop your own photos into any image slot.">
        <DCArtboard id="home-sand" label="首頁 · Homepage" width={W} height={5270}>
          <Board theme="sand"><HomePage v="sand" /></Board>
        </DCArtboard>
      </DCSection>

      <DCSection id="inner" title="內頁 · Inner Pages" subtitle="About + Worship.">
        <DCArtboard id="about" label="認識我們 · About Us" width={W} height={3685}>
          <Board theme="sand"><AboutPage v="sand" /></Board>
        </DCArtboard>
        <DCArtboard id="worship" label="主日崇拜 · Sunday Worship" width={W} height={3630}>
          <Board theme="sand"><WorshipPage v="sand" /></Board>
        </DCArtboard>
        <DCArtboard id="new" label="新朋友 · New Here" width={W} height={3290}>
          <Board theme="sand"><NewHerePage v="sand" /></Board>
        </DCArtboard>
        <DCArtboard id="ministries" label="事工群體 · Ministries" width={W} height={3815}>
          <Board theme="sand"><MinistriesPage v="sand" /></Board>
        </DCArtboard>
        <DCArtboard id="tpw" label="三人行 · Three-Person Walk" width={W} height={3265}>
          <Board theme="sand"><ThreePersonWalkPage v="sand" /></Board>
        </DCArtboard>
      </DCSection>
    </DesignCanvas>
  );
}

ReactDOM.createRoot(document.getElementById("root")).render(<App />);
