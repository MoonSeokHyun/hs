<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "편의점 레시피 모음{$pageSuffix} | 간편 꿀조합·따라하기 | 편잇";
$pageDesc    = $currentPage > 1
    ? "편의점 레시피 {$currentPage}페이지 - 편의점 제품으로 만드는 간편 레시피와 꿀조합을 확인하세요."
    : "편의점 제품으로 만드는 간편 레시피와 인기 꿀조합을 모아놓았습니다. CU, GS25, 세븐일레븐 상품으로 누구나 쉽게 따라할 수 있는 레시피를 만나보세요.";
$canonical = $currentPage > 1 ? base_url('recipes') . '?page=' . $currentPage : base_url('recipes');
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($pageTitle) ?></title>
  <meta name="description" content="<?= esc($pageDesc) ?>">
  <meta name="robots" content="index, follow">
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
    <p class="lp-hero-eyebrow">RECIPE</p>
    <h1 class="lp-hero-title">🍜 편의점 레시피</h1>
    <p class="lp-hero-sub">편의점 재료로 만드는 꿀조합 레시피</p>
  </div>
</section>

<div class="lp-body">
  <div class="container">

    <?php if (!empty($recipes)): ?>
    <div class="lp-img-grid">
      <?php foreach ($recipes as $recipe): ?>
        <a class="lp-img-card" href="/recipes/<?= esc($recipe['id']) ?>">
          <div class="lp-img-card-thumb">
            <img src="<?= esc($recipe['image_url']) ?>" alt="<?= esc($recipe['title']) ?>" loading="lazy" decoding="async">
          </div>
          <div class="lp-img-card-body">
            <div class="lp-img-card-title"><?= esc($recipe['title']) ?></div>
            <div class="lp-img-card-meta">작성자: <?= esc($recipe['author']) ?></div>
            <div class="lp-img-card-meta">조회수: <?= esc($recipe['views']) ?></div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <p class="lp-empty">레시피가 없습니다.</p>
    <?php endif; ?>

    <?php if (isset($pager)): ?>
    <div class="lp-pager"><?= $pager->links() ?></div>
    <?php endif; ?>

  </div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
