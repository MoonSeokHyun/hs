<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="google-site-verification" content="Vg6LnwCg2ciJr3emetShc4yHm1AYLLPKWrg3UdFYpDg" />
  <meta name="naver-site-verification" content="da4595e04224f83fa6c03f3136fc09f0094ef7a7" />
  <title>편잇 — 생활 편의시설 통합 플랫폼</title>
  <meta name="description" content="편의점 할인부터 병원·주유소·주차장까지, 대한민국 생활 편의 정보를 한 곳에서.">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= base_url() ?>">
  <meta property="og:title" content="편잇 — 생활 편의시설 통합 플랫폼">
  <meta property="og:description" content="편의점 할인부터 병원·주유소·주차장까지, 대한민국 생활 편의 정보를 한 곳에서.">
  <meta property="og:url" content="<?= base_url() ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="<?= base_url('img/logo.png') ?>">
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link rel="preload" as="style" crossorigin
    href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css"
    onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css"></noscript>
  <link rel="stylesheet" href="<?= base_url('css/common.css') ?>?v=<?= filemtime(FCPATH.'css/common.css') ?>">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>

<style>
/* =====================================================
   INDEX PAGE — 2025 Editorial Layout
   ===================================================== */

/* ── HERO ── */
.hero {
  background: #fff;
  padding: 88px 24px 80px;
  position: relative;
  overflow: hidden;
}
/* 배경 오렌지 원형 블롭 */
.hero::before {
  content: '';
  position: absolute;
  top: -160px; right: -120px;
  width: 600px; height: 600px;
  background: radial-gradient(circle, rgba(249,115,22,.1) 0%, transparent 65%);
  border-radius: 50%;
  pointer-events: none;
}
.hero::after {
  content: '';
  position: absolute;
  bottom: -100px; left: -80px;
  width: 420px; height: 420px;
  background: radial-gradient(circle, rgba(249,115,22,.06) 0%, transparent 65%);
  border-radius: 50%;
  pointer-events: none;
}
.hero-inner {
  max-width: 1200px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr 420px;
  gap: 64px;
  align-items: center;
  position: relative;
}
/* 왼쪽 텍스트 */
.hero-left {}
.hero-chip {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 5px 14px 5px 8px;
  background: #FFF7ED;
  border: 1px solid #FED7AA;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 700;
  color: #C2410C;
  margin-bottom: 28px;
}
.hero-chip-dot {
  width: 6px; height: 6px;
  background: #F97316;
  border-radius: 50%;
  animation: pulse 2s infinite;
}
@keyframes pulse {
  0%, 100% { opacity: 1; transform: scale(1); }
  50%       { opacity: .5; transform: scale(.8); }
}
.hero-title {
  font-size: 64px;
  font-weight: 900;
  letter-spacing: -3px;
  line-height: 1.1;
  color: #111827;
  margin-bottom: 20px;
}
.hero-title .hl {
  color: #F97316;
  position: relative;
  display: inline-block;
}
.hero-title .hl::after {
  content: '';
  position: absolute;
  left: 0; bottom: 2px;
  width: 100%; height: 6px;
  background: rgba(249,115,22,.2);
  border-radius: 3px;
  z-index: -1;
}
.hero-sub {
  font-size: 17px;
  color: #6B7280;
  line-height: 1.75;
  margin-bottom: 40px;
  max-width: 460px;
}

/* 히어로 검색바 */
.hero-search {
  display: flex;
  align-items: center;
  background: #fff;
  border: 2px solid #E5E7EB;
  border-radius: 16px;
  padding: 6px 6px 6px 18px;
  box-shadow: 0 8px 32px rgba(0,0,0,.08);
  transition: border-color .2s, box-shadow .2s;
  max-width: 520px;
  margin-bottom: 24px;
}
.hero-search:focus-within {
  border-color: #F97316;
  box-shadow: 0 8px 32px rgba(249,115,22,.14);
}
.hero-search input {
  flex: 1; min-width: 0;
  border: none; outline: none;
  font-size: 15px; font-family: var(--font);
  color: #111827; background: transparent;
}
.hero-search input::placeholder { color: #9CA3AF; }
.hero-search button {
  padding: 11px 22px;
  background: #F97316;
  color: #fff; border: none;
  border-radius: 11px;
  font-size: 14px; font-weight: 700;
  cursor: pointer; font-family: var(--font);
  white-space: nowrap;
  transition: background .2s;
  flex-shrink: 0;
}
.hero-search button:hover { background: #EA580C; }

/* 빠른 이동 링크 */
.hero-quick {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
.hero-quick a {
  padding: 7px 14px;
  border: 1.5px solid #E5E7EB;
  border-radius: 999px;
  font-size: 13px;
  font-weight: 600;
  color: #4B5563;
  background: #fff;
  transition: all .15s;
}
.hero-quick a:hover {
  border-color: #F97316;
  color: #EA580C;
  background: #FFF7ED;
}

/* 오른쪽 스탯 카드 */
.hero-right {
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.stat-card {
  background: #111827;
  border-radius: 20px;
  padding: 22px 24px;
  color: #fff;
  display: flex;
  align-items: center;
  gap: 18px;
  transition: transform .2s;
}
.stat-card:hover { transform: translateX(-4px); }
.stat-icon {
  width: 48px; height: 48px;
  background: rgba(249,115,22,.15);
  border-radius: 14px;
  display: grid;
  place-items: center;
  font-size: 22px;
  flex-shrink: 0;
}
.stat-info {}
.stat-num {
  font-size: 26px;
  font-weight: 900;
  letter-spacing: -1px;
  line-height: 1;
  margin-bottom: 3px;
}
.stat-num span { color: #FB923C; }
.stat-label {
  font-size: 12px;
  color: #9CA3AF;
  font-weight: 500;
}

/* ── 카테고리 섹션 ── */
.sec-cats {
  background: #111827;
  padding: 72px 0;
}
.sec-head {
  margin-bottom: 36px;
}
.sec-kicker {
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  margin-bottom: 8px;
  display: block;
}
.sec-cats .sec-kicker { color: #F97316; }
.sec-cats .sec-title  { color: #fff; }
.sec-title {
  font-size: 32px;
  font-weight: 900;
  letter-spacing: -1.5px;
  line-height: 1.2;
}

.cat-grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 12px;
}
.cat-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
  padding: 28px 12px;
  background: #1F2937;
  border: 1px solid #374151;
  border-radius: 20px;
  text-decoration: none;
  color: #D1D5DB;
  transition: all .2s;
}
.cat-card:hover {
  background: #F97316;
  border-color: #F97316;
  color: #fff;
  transform: translateY(-5px);
  box-shadow: 0 16px 40px rgba(249,115,22,.3);
}
.cat-icon {
  width: 54px; height: 54px;
  background: #374151;
  border-radius: 16px;
  display: grid;
  place-items: center;
  font-size: 26px;
  transition: background .2s;
}
.cat-card:hover .cat-icon { background: rgba(255,255,255,.2); }
.cat-name {
  font-size: 13px;
  font-weight: 700;
  text-align: center;
  line-height: 1.4;
}

/* ── 피처 벤토 ── */
.sec-features { padding: 80px 0; background: #F9FAFB; }
.sec-features .sec-kicker { color: #F97316; }
.sec-features .sec-title  { color: #111827; }
.sec-features-head {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  margin-bottom: 36px;
}

.bento {
  display: grid;
  grid-template-columns: repeat(12, 1fr);
  grid-template-rows: auto auto;
  gap: 14px;
}
.bento-card {
  background: #fff;
  border: 1px solid #E5E7EB;
  border-radius: 24px;
  padding: 32px 28px;
  transition: all .22s;
  position: relative;
  overflow: hidden;
}
.bento-card:hover {
  border-color: #F97316;
  box-shadow: 0 16px 48px rgba(249,115,22,.12);
  transform: translateY(-3px);
}
.bento-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, #FB923C, #F97316);
  opacity: 0;
  transition: opacity .22s;
}
.bento-card:hover::before { opacity: 1; }

/* 벤토 크기 배치 */
.bento-lg { grid-column: span 5; }
.bento-md { grid-column: span 4; }
.bento-sm { grid-column: span 3; }

.bento-icon {
  font-size: 40px;
  line-height: 1;
  margin-bottom: 20px;
}
.bento-title {
  font-size: 18px;
  font-weight: 800;
  color: #111827;
  letter-spacing: -.5px;
  margin-bottom: 10px;
}
.bento-desc {
  font-size: 14px;
  color: #6B7280;
  line-height: 1.7;
}
.bento-tag {
  display: inline-block;
  margin-top: 16px;
  padding: 5px 12px;
  background: #FFF7ED;
  color: #EA580C;
  font-size: 12px;
  font-weight: 700;
  border-radius: 999px;
}

/* ── 이벤트/레시피 섹션 ── */
.sec-content {
  padding: 72px 0;
  background: #fff;
}
.sec-content.alt { background: #F9FAFB; }
.sec-content-head {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  margin-bottom: 32px;
}
.sec-content-head .sec-kicker { color: #F97316; }
.sec-content-head .sec-title  { color: #111827; }
.sec-more {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  font-size: 14px;
  font-weight: 600;
  color: #F97316;
  margin-bottom: 4px;
  transition: gap .2s;
}
.sec-more:hover { gap: 8px; color: #EA580C; }

.content-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 18px;
}
.ccard {
  display: block;
  background: #fff;
  border: 1.5px solid #E5E7EB;
  border-radius: 18px;
  overflow: hidden;
  text-decoration: none;
  color: inherit;
  transition: all .2s;
}
.ccard:hover {
  border-color: #F97316;
  box-shadow: 0 12px 36px rgba(249,115,22,.14);
  transform: translateY(-4px);
  color: inherit;
}
.ccard-img {
  width: 100%;
  aspect-ratio: 4/3;
  overflow: hidden;
  background: #F3F4F6;
}
.ccard-img img {
  width: 100%; height: 100%;
  object-fit: cover;
  transition: transform .4s;
}
.ccard:hover .ccard-img img { transform: scale(1.07); }
.ccard-body { padding: 16px; }
.ccard-title {
  font-size: 14px;
  font-weight: 700;
  color: #111827;
  line-height: 1.45;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* ── CTA 배너 ── */
.sec-cta {
  padding: 80px 24px;
  background: linear-gradient(135deg, #FB923C 0%, #F97316 45%, #EA580C 100%);
  position: relative;
  overflow: hidden;
}
.sec-cta::before {
  content: '';
  position: absolute;
  inset: 0;
  background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='40' cy='40' r='36' fill='none' stroke='rgba(255,255,255,.07)' stroke-width='1'/%3E%3C/svg%3E") 0 0/80px 80px;
  pointer-events: none;
}
.sec-cta-inner {
  max-width: 680px;
  margin: 0 auto;
  text-align: center;
  position: relative;
}
.sec-cta h2 {
  font-size: 40px;
  font-weight: 900;
  letter-spacing: -2px;
  color: #fff;
  line-height: 1.2;
  margin-bottom: 14px;
  text-shadow: 0 2px 12px rgba(0,0,0,.12);
}
.sec-cta p {
  font-size: 16px;
  color: rgba(255,255,255,.82);
  margin-bottom: 36px;
  line-height: 1.7;
}
.cta-search {
  display: flex;
  align-items: center;
  background: #fff;
  border-radius: 16px;
  padding: 6px 6px 6px 20px;
  box-shadow: 0 16px 48px rgba(0,0,0,.2);
  max-width: 560px;
  margin: 0 auto;
  gap: 8px;
}
.cta-search input {
  flex: 1; min-width: 0;
  border: none; outline: none;
  font-size: 15px; font-family: var(--font);
  color: #111827; background: transparent;
}
.cta-search input::placeholder { color: #9CA3AF; }
.cta-search button {
  padding: 12px 24px;
  background: #111827;
  color: #fff; border: none;
  border-radius: 12px;
  font-size: 14px; font-weight: 700;
  cursor: pointer; font-family: var(--font);
  white-space: nowrap;
  transition: background .2s;
  flex-shrink: 0;
}
.cta-search button:hover { background: #1F2937; }

/* ── 광고 ── */
.sec-ad { padding: 8px 0; background: #fff; }
.sec-ad.dark { background: #F9FAFB; }

/* ── 반응형 ── */
@media (max-width: 1100px) {
  .hero-inner { grid-template-columns: 1fr; gap: 48px; }
  .hero-title { font-size: 52px; }
  .hero-right { display: grid; grid-template-columns: repeat(2, 1fr); }
  .stat-card:hover { transform: translateY(-3px); }
  .bento-lg { grid-column: span 6; }
  .bento-md { grid-column: span 6; }
  .bento-sm { grid-column: span 6; }
  .content-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 860px) {
  .cat-grid { grid-template-columns: repeat(4, 1fr); }
  .bento-lg, .bento-md, .bento-sm { grid-column: span 6; }
  .content-grid { grid-template-columns: repeat(2, 1fr); }
  .sec-cta h2 { font-size: 30px; }
}
@media (max-width: 640px) {
  .hero { padding: 60px 16px 56px; }
  .hero-title { font-size: 38px; letter-spacing: -2px; }
  .hero-title .hl::after { height: 4px; }
  .hero-sub { font-size: 15px; }
  .hero-right { grid-template-columns: 1fr; }
  .cat-grid { grid-template-columns: repeat(3, 1fr); gap: 8px; }
  .cat-card { padding: 20px 8px; gap: 8px; }
  .cat-icon { width: 46px; height: 46px; font-size: 22px; }
  .cat-name { font-size: 12px; }
  .bento-lg, .bento-md, .bento-sm { grid-column: span 12; }
  .content-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
  .sec-features-head, .sec-content-head { flex-direction: column; align-items: flex-start; gap: 4px; }
  .sec-cats, .sec-features, .sec-content { padding: 52px 0; }
  .sec-cta { padding: 56px 16px; }
  .sec-cta h2 { font-size: 26px; letter-spacing: -1px; }
}
@media (max-width: 400px) {
  .cat-grid { grid-template-columns: repeat(3, 1fr); }
  .content-grid { grid-template-columns: 1fr 1fr; }
}
</style>
</head>
<body>

<?php include APPPATH . 'Views/includes/header.php'; ?>

<!-- ══════════════════════════════════════
  HERO
══════════════════════════════════════ -->
<section class="hero">
  <div class="hero-inner">
    <div class="hero-left">
      <div class="hero-chip">
        <span class="hero-chip-dot"></span>
        대한민국 편의시설 통합 플랫폼
      </div>
      <h1 class="hero-title">
        생활 정보,<br>
        <span class="hl">한 곳에서.</span>
      </h1>
      <p class="hero-sub">
        편의점 할인부터 병원·주유소·주차장·정비소까지<br>
        필요한 모든 정보를 편잇에서 바로 찾아보세요.
      </p>
      <form class="hero-search" method="get" action="/events">
        <input
          type="text" name="q"
          placeholder="편의점 상품 검색 (예: 삼각김밥, 비빔밥...)"
          value="<?= esc($query ?? '') ?>"
          autocomplete="off">
        <button type="submit">검색</button>
      </form>
      <div class="hero-quick">
        <a href="/hospital">🏥 병원</a>
        <a href="/parking">🅿️ 주차장</a>
        <a href="/gas_stations">⛽ 주유소</a>
        <a href="/carwash">🚿 세차장</a>
        <a href="/hotel">🏨 숙박</a>
        <a href="/recipes">🍜 레시피</a>
      </div>
    </div>

    <div class="hero-right">
      <div class="stat-card">
        <div class="stat-icon">🏥</div>
        <div class="stat-info">
          <div class="stat-num"><span>10</span>만+ 곳</div>
          <div class="stat-label">전국 의료기관 정보</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">⛽</div>
        <div class="stat-info">
          <div class="stat-num"><span>1.2</span>만+ 곳</div>
          <div class="stat-label">실시간 주유소 현황</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">🅿️</div>
        <div class="stat-info">
          <div class="stat-num"><span>6</span>만+ 곳</div>
          <div class="stat-label">전국 주차장 정보</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">🏪</div>
        <div class="stat-info">
          <div class="stat-num">매일 <span>업데이트</span></div>
          <div class="stat-label">편의점 할인 이벤트</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
  AD
══════════════════════════════════════ -->
<div class="sec-ad">
  <div class="container">
    <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>
  </div>
</div>

<!-- ══════════════════════════════════════
  CATEGORIES
══════════════════════════════════════ -->
<section class="sec-cats">
  <div class="container">
    <div class="sec-head">
      <span class="sec-kicker">SERVICES</span>
      <h2 class="sec-title">원하는 정보,<br>바로 찾아보세요</h2>
    </div>
    <div class="cat-grid">
      <a href="/events" class="cat-card">
        <span class="cat-icon">🏪</span>
        <span class="cat-name">편의점<br>이벤트</span>
      </a>
      <a href="/hospital" class="cat-card">
        <span class="cat-icon">🏥</span>
        <span class="cat-name">병원<br>찾기</span>
      </a>
      <a href="/hotel" class="cat-card">
        <span class="cat-icon">🏨</span>
        <span class="cat-name">숙박<br>시설</span>
      </a>
      <a href="/gas_stations" class="cat-card">
        <span class="cat-icon">⛽</span>
        <span class="cat-name">주유소</span>
      </a>
      <a href="/parking" class="cat-card">
        <span class="cat-icon">🅿️</span>
        <span class="cat-name">주차장</span>
      </a>
      <a href="/automobile_repair_shops" class="cat-card">
        <span class="cat-icon">🔧</span>
        <span class="cat-name">자동차<br>정비소</span>
      </a>
      <a href="/carwash" class="cat-card">
        <span class="cat-icon">🚿</span>
        <span class="cat-name">세차장</span>
      </a>
      <a href="/ev-stations" class="cat-card">
        <span class="cat-icon">⚡</span>
        <span class="cat-name">전기차<br>충전소</span>
      </a>
      <a href="/festival-info" class="cat-card">
        <span class="cat-icon">🎊</span>
        <span class="cat-name">축제·<br>공연</span>
      </a>
      <a href="/recipes" class="cat-card">
        <span class="cat-icon">🍜</span>
        <span class="cat-name">편의점<br>레시피</span>
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
  FEATURES BENTO
══════════════════════════════════════ -->
<section class="sec-features">
  <div class="container">
    <div class="sec-features-head">
      <div>
        <span class="sec-kicker">WHY 편잇</span>
        <h2 class="sec-title">편잇이 다른 이유</h2>
      </div>
    </div>
    <div class="bento">
      <div class="bento-card bento-lg">
        <div class="bento-icon">🏪</div>
        <p class="bento-title">편의점 할인, 한눈에</p>
        <p class="bento-desc">CU·GS25·세븐일레븐·이마트24 1+1·2+1 이벤트를 브랜드별로 모아서 비교하세요. 매일 업데이트됩니다.</p>
        <span class="bento-tag">매일 업데이트</span>
      </div>
      <div class="bento-card bento-md">
        <div class="bento-icon">🚗</div>
        <p class="bento-title">자동차 편의시설</p>
        <p class="bento-desc">주유소·세차장·정비소·전기차 충전소까지, 내 근처 시설을 빠르게 찾아보세요.</p>
      </div>
      <div class="bento-card bento-sm">
        <div class="bento-icon">🏥</div>
        <p class="bento-title">전국 의료기관</p>
        <p class="bento-desc">10만+ 병원·의원·약국 정보.</p>
        <span class="bento-tag">10만+ 등록</span>
      </div>
      <div class="bento-card bento-sm">
        <div class="bento-icon">🏨</div>
        <p class="bento-title">숙박 정보</p>
        <p class="bento-desc">전국 숙박시설 정보.</p>
      </div>
      <div class="bento-card bento-md">
        <div class="bento-icon">🎉</div>
        <p class="bento-title">이벤트·축제</p>
        <p class="bento-desc">전국 축제·공연·이벤트 정보를 지역별로 확인하세요. 놓치기 아까운 일정들.</p>
      </div>
      <div class="bento-card bento-lg">
        <div class="bento-icon">🍜</div>
        <p class="bento-title">편의점 꿀조합 레시피</p>
        <p class="bento-desc">편의점 재료만으로 만드는 간단하고 맛있는 레시피를 모아봤습니다. 혼밥족 필수 북마크.</p>
        <span class="bento-tag">인기 급상승</span>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
  CTA BANNER
══════════════════════════════════════ -->
<section class="sec-cta">
  <div class="sec-cta-inner">
    <h2>생활 정보,<br>편잇에서 한번에</h2>
    <p>전국 편의점 할인부터 병원·주유소·주차장까지.<br>찾고 싶은 걸 바로 검색해보세요.</p>
    <form class="cta-search" method="get" action="/events">
      <input type="text" name="q" placeholder="상품명, 시설 이름으로 검색..." autocomplete="off">
      <button type="submit">검색하기</button>
    </form>
  </div>
</section>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
