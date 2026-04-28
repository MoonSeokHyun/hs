<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 주유소 찾기 | 실시간 유가·위치·리뷰{$pageSuffix} | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 주유소 {$currentPage}페이지 - 지역별 주유소 위치, 실시간 유가, 리뷰와 평점 정보를 확인하세요."
    : "전국 주유소의 실시간 유가, 위치, 리뷰와 평점 정보를 한눈에 확인하세요. 저렴한 주유소를 쉽게 찾아 기름값을 절약할 수 있습니다.";
$canonical = $currentPage > 1 ? base_url('gas_stations') . '?page=' . $currentPage : base_url('gas_stations');
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
    <p class="lp-hero-eyebrow">FUEL STATION</p>
    <h1 class="lp-hero-title">⛽ 전국 주유소</h1>
    <p class="lp-hero-sub">실시간 유가 정보와 위치, 리뷰를 한눈에 확인하세요</p>
    <form class="lp-search" action="<?= base_url('gas_stations/search') ?>" method="get">
      <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="주유소명, 주소 검색">
      <button type="submit">검색</button>
    </form>
    <div class="lp-hero-stats">
      <span class="lp-stat-chip"><strong>1.2만+</strong> 전국 주유소</span>
      <span class="lp-stat-chip"><strong>실시간</strong> 유가 정보</span>
      <span class="lp-stat-chip"><strong>리뷰·평점</strong> 제공</span>
    </div>
  </div>
</section>

<div class="lp-body">
  <div class="container">

    <?php if (!empty($isSearchResult) && !empty($noResultsMessage)): ?>
      <p class="lp-empty"><?= esc($noResultsMessage) ?></p>
    <?php endif; ?>

    <?php if (!empty($gasStations)): ?>
    <section>
      <div class="lp-section-head">
        <div>
          <span class="lp-section-kicker">LIST</span>
          <p class="lp-section-title">⛽ 주유소 목록</p>
        </div>
      </div>
      <div class="lp-grid">
        <?php foreach ($gasStations as $station): ?>
          <a class="lp-card" href="/gas_stations/<?= esc($station['id']) ?>">
            <div class="lp-card-name"><?= esc($station['gas_station_name']) ?></div>
            <div class="lp-card-row">📍 <?= esc($station['road_address']) ?></div>
            <?php if (!empty($station['review_count'])): ?>
            <div class="lp-card-row">💬 리뷰 <?= esc($station['review_count']) ?>개</div>
            <?php endif; ?>
            <?php if (!empty($station['average_rating'])): ?>
            <div class="lp-card-rating">★ <?= number_format($station['average_rating'], 1) ?></div>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($popularGasStations)): ?>
    <section>
      <div class="lp-section-head">
        <div>
          <span class="lp-section-kicker">POPULAR</span>
          <p class="lp-section-title">⭐ 인기 주유소</p>
        </div>
      </div>
      <div class="lp-grid">
        <?php foreach ($popularGasStations as $station): ?>
          <a class="lp-card" href="/gas_stations/<?= esc($station['id']) ?>">
            <div class="lp-card-name"><?= esc($station['gas_station_name']) ?></div>
            <div class="lp-card-row">📍 <?= esc($station['road_address']) ?></div>
            <?php if (!empty($station['review_count'])): ?>
            <div class="lp-card-row">💬 리뷰 <?= esc($station['review_count']) ?>개</div>
            <?php endif; ?>
            <?php if (!empty($station['average_rating'])): ?>
            <div class="lp-card-rating">★ <?= number_format($station['average_rating'], 1) ?></div>
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
