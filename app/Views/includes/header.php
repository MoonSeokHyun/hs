<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-815Y8D4S5S"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-815Y8D4S5S');
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M4ZQ64R6');</script>
<!-- End Google Tag Manager -->
<style>
/* ── Site Header ── */
#site-header {
  position: sticky;
  top: 0;
  z-index: 999;
  background: rgba(255,255,255,.96);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border-bottom: 1px solid #F3F4F6;
  box-shadow: 0 1px 4px rgba(0,0,0,.06);
}
.hd-wrap {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 24px;
  height: 64px;
  display: flex;
  align-items: center;
  gap: 24px;
}

/* 로고 */
.hd-logo {
  font-size: 24px;
  font-weight: 900;
  letter-spacing: -1.5px;
  color: #111827;
  text-decoration: none;
  flex-shrink: 0;
  line-height: 1;
}
.hd-logo em { color: #F97316; font-style: normal; }

/* 데스크탑 nav */
.hd-nav {
  display: flex;
  align-items: center;
  gap: 2px;
  flex: 1;
}
.hd-nav-item { position: relative; }
.hd-nav-link {
  display: inline-flex;
  align-items: center;
  gap: 3px;
  padding: 8px 12px;
  font-size: 14px;
  font-weight: 600;
  color: #4B5563;
  border-radius: 8px;
  transition: background .15s, color .15s;
  white-space: nowrap;
  cursor: pointer;
  background: none;
  border: none;
}
.hd-nav-link:hover, .hd-nav-link:focus { background: #FFF7ED; color: #EA580C; outline: none; }
.hd-nav-link svg { width: 10px; height: 10px; transition: transform .2s; flex-shrink: 0; }
.hd-nav-item.open .hd-nav-link svg { transform: rotate(180deg); }

/* 드롭다운 */
.hd-drop {
  position: absolute;
  top: calc(100% + 8px);
  left: 0;
  min-width: 200px;
  background: #fff;
  border: 1px solid #E5E7EB;
  border-radius: 16px;
  box-shadow: 0 12px 40px rgba(0,0,0,.12);
  padding: 6px;
  display: none;
  z-index: 100;
}
.hd-nav-item.open .hd-drop { display: block; }
.hd-drop a {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 9px 12px;
  border-radius: 10px;
  font-size: 13px;
  font-weight: 600;
  color: #4B5563;
  transition: background .12s, color .12s;
}
.hd-drop a:hover { background: #FFF7ED; color: #EA580C; }
.hd-drop-icon { font-size: 16px; line-height: 1; }
.hd-drop-divider { height: 1px; background: #F3F4F6; margin: 4px 6px; }

/* CTA */
.hd-cta {
  margin-left: auto;
  padding: 9px 20px;
  background: #F97316;
  color: #fff;
  font-size: 14px;
  font-weight: 700;
  border-radius: 10px;
  transition: background .2s, transform .2s, box-shadow .2s;
  white-space: nowrap;
  flex-shrink: 0;
  box-shadow: 0 4px 14px rgba(249,115,22,.3);
}
.hd-cta:hover { background: #EA580C; color: #fff; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(249,115,22,.4); }

/* 햄버거 */
.hd-burger {
  display: none;
  flex-direction: column;
  gap: 5px;
  background: none;
  border: 1.5px solid #E5E7EB;
  border-radius: 8px;
  padding: 8px 9px;
  cursor: pointer;
  flex-shrink: 0;
}
.hd-burger span {
  display: block;
  width: 20px;
  height: 2px;
  background: #374151;
  border-radius: 2px;
  transition: all .25s;
}
.hd-burger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.hd-burger.open span:nth-child(2) { opacity: 0; }
.hd-burger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

/* 광고 배너 */
.hd-ad { background: #fff; border-bottom: 1px solid #F3F4F6; }
.hd-ad-inner { max-width: 1200px; margin: 0 auto; padding: 6px 24px; }

/* 모바일 드로어 */
.hd-drawer {
  background: #fff;
  border-top: 1px solid #F3F4F6;
  max-height: 0;
  overflow: hidden;
  transition: max-height .3s ease;
}
.hd-drawer.open { max-height: 85vh; overflow-y: auto; }
.hd-drawer-inner { padding: 12px 16px 20px; display: flex; flex-direction: column; gap: 4px; }
.hd-drawer-group { border-radius: 12px; overflow: hidden; border: 1px solid #F3F4F6; margin-bottom: 6px; }
.hd-drawer-label {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 13px 16px;
  font-size: 14px;
  font-weight: 800;
  color: #111827;
  cursor: pointer;
  user-select: none;
  background: #F9FAFB;
}
.hd-drawer-label::after { content: '▾'; font-size: 10px; color: #9CA3AF; transition: transform .2s; }
.hd-drawer-group.open .hd-drawer-label::after { transform: rotate(180deg); }
.hd-drawer-links { display: none; padding: 6px 10px 10px; flex-direction: column; gap: 2px; background: #fff; }
.hd-drawer-group.open .hd-drawer-links { display: flex; }
.hd-drawer-links a {
  padding: 9px 12px;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  color: #4B5563;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: background .12s, color .12s;
}
.hd-drawer-links a:hover { background: #FFF7ED; color: #EA580C; }

@media (max-width: 900px) {
  .hd-nav, .hd-cta { display: none; }
  .hd-burger { display: flex; margin-left: auto; }
}
@media (max-width: 480px) {
  .hd-wrap { padding: 0 16px; }
  .hd-ad-inner { padding: 6px 16px; }
  .hd-logo { font-size: 22px; }
}
</style>

<header id="site-header">
  <div class="hd-wrap">
    <a href="/" class="hd-logo">편잇<em>.</em></a>

    <nav class="hd-nav">
      <div class="hd-nav-item">
        <button class="hd-nav-link">
          편의점
          <svg viewBox="0 0 10 6" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 1l4 4 4-4"/></svg>
        </button>
        <div class="hd-drop">
          <a href="/events"><span class="hd-drop-icon">🏪</span>전체 이벤트</a>
          <a href="/events/cu"><span class="hd-drop-icon">🔵</span>CU</a>
          <a href="/events/gs25"><span class="hd-drop-icon">🟢</span>GS25</a>
          <a href="/events/7-ELEVEn"><span class="hd-drop-icon">🔴</span>세븐일레븐</a>
          <a href="/events/emart24"><span class="hd-drop-icon">🟡</span>이마트24</a>
        </div>
      </div>

      <div class="hd-nav-item">
        <button class="hd-nav-link">
          편의시설
          <svg viewBox="0 0 10 6" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 1l4 4 4-4"/></svg>
        </button>
        <div class="hd-drop">
          <a href="/hospital"><span class="hd-drop-icon">🏥</span>병원</a>
          <a href="/hotel"><span class="hd-drop-icon">🏨</span>숙박</a>
        </div>
      </div>

      <div class="hd-nav-item">
        <button class="hd-nav-link">
          자동차
          <svg viewBox="0 0 10 6" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 1l4 4 4-4"/></svg>
        </button>
        <div class="hd-drop">
          <a href="/parking"><span class="hd-drop-icon">🅿️</span>주차장</a>
          <a href="/automobile_repair_shops"><span class="hd-drop-icon">🔧</span>정비소</a>
          <a href="/gas_stations"><span class="hd-drop-icon">⛽</span>주유소</a>
          <a href="/carwash"><span class="hd-drop-icon">🚿</span>세차장</a>
          <div class="hd-drop-divider"></div>
          <a href="/ev-stations"><span class="hd-drop-icon">⚡</span>전기차 충전소</a>
          <a href="/station"><span class="hd-drop-icon">💨</span>가스 충전소</a>
          <a href="/towed-vehicle-storage"><span class="hd-drop-icon">🚛</span>견인보관소</a>
          <a href="/parking-facilities"><span class="hd-drop-icon">🏙️</span>공영주차장</a>
          <a href="/stores"><span class="hd-drop-icon">🔘</span>타이어판매소</a>
        </div>
      </div>

      <div class="hd-nav-item">
        <button class="hd-nav-link">
          콘텐츠
          <svg viewBox="0 0 10 6" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 1l4 4 4-4"/></svg>
        </button>
        <div class="hd-drop">
          <a href="/event"><span class="hd-drop-icon">🎉</span>이벤트</a>
          <a href="/recipes"><span class="hd-drop-icon">🍜</span>레시피</a>
          <a href="/festival-info"><span class="hd-drop-icon">🎊</span>축제·공연</a>
        </div>
      </div>
    </nav>

    <a href="/events" class="hd-cta">지금 찾기 →</a>

    <button class="hd-burger" id="hd-burger" aria-label="메뉴 열기">
      <span></span><span></span><span></span>
    </button>
  </div>

  <!-- 모바일 드로어 -->
  <div class="hd-drawer" id="hd-drawer">
    <div class="hd-drawer-inner">
      <div class="hd-drawer-group">
        <div class="hd-drawer-label">🏪 편의점</div>
        <div class="hd-drawer-links">
          <a href="/events">전체 이벤트</a>
          <a href="/events/cu">CU</a>
          <a href="/events/gs25">GS25</a>
          <a href="/events/7-ELEVEn">세븐일레븐</a>
          <a href="/events/emart24">이마트24</a>
        </div>
      </div>
      <div class="hd-drawer-group">
        <div class="hd-drawer-label">🏥 편의시설</div>
        <div class="hd-drawer-links">
          <a href="/hospital">병원</a>
          <a href="/hotel">숙박</a>
        </div>
      </div>
      <div class="hd-drawer-group">
        <div class="hd-drawer-label">🚗 자동차</div>
        <div class="hd-drawer-links">
          <a href="/parking">주차장</a>
          <a href="/automobile_repair_shops">정비소</a>
          <a href="/gas_stations">주유소</a>
          <a href="/carwash">세차장</a>
          <a href="/ev-stations">전기차 충전소</a>
          <a href="/towed-vehicle-storage">견인보관소</a>
          <a href="/parking-facilities">공영주차장</a>
          <a href="/stores">타이어판매소</a>
        </div>
      </div>
      <div class="hd-drawer-group">
        <div class="hd-drawer-label">🎉 콘텐츠</div>
        <div class="hd-drawer-links">
          <a href="/event">이벤트</a>
          <a href="/recipes">레시피</a>
          <a href="/festival-info">축제·공연</a>
        </div>
      </div>
      <a href="/events" style="display:block;margin-top:8px;padding:14px;background:#F97316;color:#fff;font-weight:700;font-size:15px;border-radius:12px;text-align:center;">지금 찾기 →</a>
    </div>
  </div>
</header>

<!-- 광고 배너 -->
<div class="hd-ad">
  <div class="hd-ad-inner">
    <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'footer']) ?>
  </div>
</div>

<script>
(function () {
  var burger  = document.getElementById('hd-burger');
  var drawer  = document.getElementById('hd-drawer');
  var navItems = document.querySelectorAll('#site-header .hd-nav-item');
  var drawerGroups = document.querySelectorAll('.hd-drawer-group');

  /* 데스크탑 드롭다운 */
  navItems.forEach(function (item) {
    var btn = item.querySelector('.hd-nav-link');
    if (!btn) return;
    btn.addEventListener('click', function (e) {
      e.stopPropagation();
      var isOpen = item.classList.contains('open');
      navItems.forEach(function (i) { i.classList.remove('open'); });
      if (!isOpen) item.classList.add('open');
    });
  });
  document.addEventListener('click', function () {
    navItems.forEach(function (i) { i.classList.remove('open'); });
  });

  /* 햄버거 */
  if (burger && drawer) {
    burger.addEventListener('click', function () {
      burger.classList.toggle('open');
      drawer.classList.toggle('open');
    });
  }

  /* 모바일 아코디언 */
  drawerGroups.forEach(function (g) {
    var label = g.querySelector('.hd-drawer-label');
    if (!label) return;
    label.addEventListener('click', function () { g.classList.toggle('open'); });
  });
})();
</script>
