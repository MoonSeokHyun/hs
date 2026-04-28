<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 세차장 찾기 | 위치·리뷰·평점{$pageSuffix} | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 세차장 {$currentPage}페이지 - 셀프세차·자동세차·스팀세차장의 위치, 전화번호, 리뷰 정보를 확인하세요."
    : "전국 세차장의 위치, 전화번호, 서비스 종류와 사용자 리뷰를 한눈에 확인하세요.";
$canonicalBase = base_url('carwash');
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
    <p class="lp-hero-eyebrow">CAR WASH</p>
    <h1 class="lp-hero-title">🚿 전국 세차장</h1>
    <p class="lp-hero-sub">내 주변 셀프·자동·스팀 세차장 위치와 리뷰를 확인하세요</p>
    <div class="lp-hero-stats">
      <span class="lp-stat-chip"><strong>셀프세차</strong> 전국 검색</span>
      <span class="lp-stat-chip"><strong>자동·스팀</strong> 세차장 포함</span>
      <span class="lp-stat-chip"><strong>리뷰·평점</strong> 제공</span>
    </div>
  </div>
</section>

<div class="lp-body">
  <div class="container">

    <?php if (!empty($recentCarWashes)): ?>
    <section>
      <div class="lp-section-head">
        <div>
          <span class="lp-section-kicker">NEW</span>
          <p class="lp-section-title">🆕 최근 추가된 세차장</p>
        </div>
      </div>
      <div class="lp-grid">
        <?php foreach ($recentCarWashes as $carwash): ?>
          <a class="lp-card" href="/carwash/details/<?= esc($carwash['ID']) ?>">
            <div class="lp-card-name"><?= esc($carwash['Business Name']) ?></div>
            <div class="lp-card-row">📍 <?= esc($carwash['Address (Road Name)'] ?? '') ?></div>
            <?php if (!empty($carwash['review_count'])): ?>
            <div class="lp-card-row">💬 리뷰 <?= esc($carwash['review_count']) ?>개</div>
            <?php endif; ?>
            <?php if (!empty($carwash['average_rating'])): ?>
            <div class="lp-card-rating">★ <?= number_format($carwash['average_rating'], 1) ?></div>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($popularCarWashes)): ?>
    <section>
      <div class="lp-section-head">
        <div>
          <span class="lp-section-kicker">POPULAR</span>
          <p class="lp-section-title">⭐ 인기 세차장</p>
        </div>
      </div>
      <div class="lp-grid">
        <?php foreach ($popularCarWashes as $carwash): ?>
          <a class="lp-card" href="/carwash/details/<?= esc($carwash['ID']) ?>">
            <div class="lp-card-name"><?= esc($carwash['Business Name']) ?></div>
            <div class="lp-card-row">📍 <?= esc($carwash['Address (Road Name)'] ?? '') ?></div>
            <?php if (!empty($carwash['review_count'])): ?>
            <div class="lp-card-row">💬 리뷰 <?= esc($carwash['review_count']) ?>개</div>
            <?php endif; ?>
            <?php if (!empty($carwash['average_rating'])): ?>
            <div class="lp-card-rating">★ <?= number_format($carwash['average_rating'], 1) ?></div>
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
