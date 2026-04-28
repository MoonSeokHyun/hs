<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 주차장 찾기 | 요금·위치·리뷰{$pageSuffix} | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 주차장 {$currentPage}페이지 - 지역별 주차장 요금, 운영시간, 위치 및 사용자 리뷰를 확인하세요."
    : "전국 주차장 목록과 요금, 운영시간, 위치 정보를 한눈에 확인하세요. 실제 이용자 리뷰와 평점으로 신뢰할 수 있는 주차장을 찾아보세요.";
$canonicalBase = base_url('parking');
$canonical = $currentPage > 1 ? $canonicalBase . '?page=' . $currentPage : $canonicalBase;
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
    <p class="lp-hero-eyebrow">PARKING</p>
    <h1 class="lp-hero-title">🅿️ 전국 주차장</h1>
    <p class="lp-hero-sub">주차장 위치, 요금, 운영시간 정보를 한눈에 확인하세요</p>
    <form class="lp-search" action="/parking/search" method="get">
      <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="주차장명, 주소 검색">
      <button type="submit">검색</button>
    </form>
    <div class="lp-hero-stats">
      <span class="lp-stat-chip"><strong>6만+</strong> 전국 주차장</span>
      <span class="lp-stat-chip"><strong>실시간</strong> 정보 업데이트</span>
      <span class="lp-stat-chip"><strong>요금·운영시간</strong> 상세 안내</span>
    </div>
  </div>
</section>

<div class="lp-body">
  <div class="container">

    <?php if (!empty($isSearchResult)): ?>
    <section>
      <div class="lp-section-head">
        <div>
          <span class="lp-section-kicker">SEARCH RESULTS</span>
          <p class="lp-section-title">검색 결과</p>
        </div>
      </div>
      <?php if (!empty($noResultsMessage)): ?>
        <p class="lp-empty"><?= esc($noResultsMessage) ?></p>
      <?php elseif (!empty($parkingLots)): ?>
        <div class="lp-grid">
          <?php foreach ($parkingLots as $lot): ?>
            <a class="lp-card" href="/parking/detail/<?= esc($lot['id']) ?>">
              <div class="lp-card-name"><?= esc($lot['name']) ?></div>
              <div class="lp-card-row">📍 <?= esc($lot['address_road']) ?></div>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>
    <?php endif; ?>

    <?php if (!empty($recentParkingLots)): ?>
    <section>
      <div class="lp-section-head">
        <div>
          <span class="lp-section-kicker">NEW</span>
          <p class="lp-section-title">🆕 최근 추가된 주차장</p>
        </div>
      </div>
      <div class="lp-grid">
        <?php foreach ($recentParkingLots as $lot): ?>
          <a class="lp-card" href="/parking/detail/<?= esc($lot['id']) ?>">
            <div class="lp-card-name"><?= esc($lot['name']) ?></div>
            <div class="lp-card-row">📍 <?= esc($lot['address_road']) ?></div>
          </a>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($popularParkingLots)): ?>
    <section>
      <div class="lp-section-head">
        <div>
          <span class="lp-section-kicker">POPULAR</span>
          <p class="lp-section-title">⭐ 인기 주차장</p>
        </div>
      </div>
      <div class="lp-grid">
        <?php foreach ($popularParkingLots as $popularLot): ?>
          <a class="lp-card" href="/parking/detail/<?= esc($popularLot['id']) ?>">
            <div class="lp-card-name"><?= esc($popularLot['name']) ?></div>
            <div class="lp-card-row">📍 <?= esc($popularLot['address_road'] ?? '') ?></div>
            <div class="lp-card-row">💬 리뷰 <?= esc($popularLot['review_count']) ?>개</div>
            <div class="lp-card-rating">★ <?= number_format($popularLot['average_rating'], 1) ?></div>
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
