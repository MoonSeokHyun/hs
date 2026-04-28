<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 숙박시설·호텔 찾기 | 위치·가격·후기{$pageSuffix} | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 호텔·숙박시설 {$currentPage}페이지 - 지역별 호텔, 모텔, 펜션의 위치, 가격, 후기 정보를 확인하세요."
    : "전국 호텔, 모텔, 펜션 등 숙박시설의 위치, 가격, 사용자 후기 정보를 한눈에 확인하세요.";
$canonical = $currentPage > 1 ? base_url('hotel') . '?page=' . $currentPage : base_url('hotel');
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($pageTitle) ?></title>
  <meta name="description" content="<?= esc($pageDesc) ?>">
  <meta name="robots" content="<?= !empty($isSearchResult) ? 'noindex, follow' : 'index, follow' ?>">
  <link rel="canonical" href="<?= esc($canonical) ?>">
  <meta property="og:title" content="<?= esc($pageTitle) ?>">
  <meta property="og:description" content="<?= esc($pageDesc) ?>">
  <meta property="og:url" content="<?= esc($canonical) ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="<?= base_url('img/logo.png') ?>">
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link rel="preload" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css"></noscript>
  <link rel="stylesheet" href="<?= base_url('css/common.css') ?>?v=<?= filemtime(FCPATH.'css/common.css') ?>">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
</head>
<body>
<?php include APPPATH . 'Views/includes/header.php'; ?>

<section class="lp-hero">
  <div class="lp-hero-inner">
    <p class="lp-hero-eyebrow">HOTEL &amp; STAY</p>
    <h1 class="lp-hero-title">🏨 전국 숙박시설</h1>
    <p class="lp-hero-sub">호텔·모텔·펜션 위치, 가격, 후기 정보를 한번에</p>
    <form class="lp-search" action="/hotel" method="get">
      <input type="text" name="query" value="<?= esc($query ?? '') ?>" placeholder="숙박시설명, 지역명으로 검색">
      <button type="submit">검색</button>
    </form>
    <div class="lp-hero-stats">
      <span class="lp-stat-chip"><strong>호텔·모텔·펜션</strong> 전국 정보</span>
      <span class="lp-stat-chip"><strong>위치·연락처</strong> 제공</span>
      <span class="lp-stat-chip"><strong>매일</strong> 업데이트</span>
    </div>
  </div>
</section>

<div class="lp-body">
  <div class="container">

    <?php if (!empty($recentHotels)): ?>
    <section>
      <div class="lp-section-head">
        <div>
          <span class="lp-section-kicker">NEW</span>
          <p class="lp-section-title">🆕 최근 추가된 숙박시설</p>
        </div>
      </div>
      <div class="lp-grid">
        <?php foreach ($recentHotels as $recent): ?>
          <a class="lp-card" href="/hotel/detail/<?= esc($recent['id']) ?>">
            <div class="lp-card-name"><?= esc($recent['business_name']) ?></div>
            <div class="lp-card-row">📍 <?= esc($recent['site_full_address']) ?></div>
            <?php if (!empty($recent['contact_number'])): ?>
            <div class="lp-card-row">📞 <?= esc($recent['contact_number']) ?></div>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($hotels)): ?>
    <section>
      <div class="lp-section-head">
        <div>
          <span class="lp-section-kicker">LIST</span>
          <p class="lp-section-title">🏨 숙박시설 목록</p>
        </div>
      </div>
      <div class="lp-grid">
        <?php foreach ($hotels as $hotel): ?>
          <a class="lp-card" href="/hotel/detail/<?= esc($hotel['id']) ?>">
            <div class="lp-card-name"><?= esc($hotel['business_name']) ?></div>
            <div class="lp-card-row">📍 <?= esc($hotel['site_full_address']) ?></div>
            <?php if (!empty($hotel['contact_number'])): ?>
            <div class="lp-card-row">📞 <?= esc($hotel['contact_number']) ?></div>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php if (isset($pager)): ?>
    <div class="lp-pager"><?= $pager->links() ?></div>
    <?php endif; ?>

  </div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
