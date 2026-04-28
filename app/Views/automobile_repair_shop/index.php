<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 자동차 정비소 찾기 | 위치·리뷰{$pageSuffix} | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 자동차 정비소 {$currentPage}페이지 - 지역별 정비소 위치, 전화번호, 리뷰와 평점 정보를 확인하세요."
    : "전국 자동차 정비소의 위치, 전화번호, 서비스 정보와 실제 이용자 리뷰를 확인하세요. 차량정비·엔진오일 교체·수리까지 한 번에 비교할 수 있습니다.";
$canonicalBase = base_url('automobile_repair_shops');
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
    <p class="lp-hero-eyebrow">AUTO REPAIR</p>
    <h1 class="lp-hero-title">🔧 전국 자동차 정비소</h1>
    <p class="lp-hero-sub">정비소 위치, 서비스 정보와 실제 이용자 리뷰를 확인하세요</p>
    <form class="lp-search" action="<?= base_url('automobile_repair_shops/search') ?>" method="get">
      <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="정비소명, 주소 검색">
      <button type="submit">검색</button>
    </form>
    <div class="lp-hero-stats">
      <span class="lp-stat-chip"><strong>전국</strong> 정비소 정보</span>
      <span class="lp-stat-chip"><strong>1·2·3급</strong> 정비소 구분</span>
      <span class="lp-stat-chip"><strong>리뷰·평점</strong> 제공</span>
    </div>
  </div>
</section>

<div class="lp-body">
  <div class="container">

    <?php if (!empty($recentRepairShops)): ?>
    <section>
      <div class="lp-section-head">
        <div>
          <span class="lp-section-kicker">LIST</span>
          <p class="lp-section-title">🔧 자동차 정비소 목록</p>
        </div>
      </div>
      <div class="lp-grid">
        <?php foreach ($recentRepairShops as $shop): ?>
          <a class="lp-card" href="/automobile_repair_shop/<?= esc($shop['id']) ?>">
            <div class="lp-card-name"><?= esc($shop['repair_shop_name']) ?></div>
            <?php if (!empty($shop['repair_shop_type'])): ?>
            <div class="lp-card-row"><span class="lp-card-badge"><?= esc($shop['repair_shop_type']) ?>급 정비소</span></div>
            <?php endif; ?>
            <div class="lp-card-row">📍 <?= esc($shop['road_address']) ?></div>
            <?php if (!empty($shop['phone_number'])): ?>
            <div class="lp-card-row">📞 <?= esc($shop['phone_number']) ?></div>
            <?php endif; ?>
            <?php if (!empty($shop['average_rating'])): ?>
            <div class="lp-card-rating">★ <?= number_format($shop['average_rating'], 1) ?></div>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($noResultsMessage)): ?>
    <p class="lp-empty"><?= esc($noResultsMessage) ?></p>
    <?php endif; ?>

    <?php if (isset($pager)): ?>
    <div class="lp-pager"><?= $pager->links() ?></div>
    <?php endif; ?>

  </div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
