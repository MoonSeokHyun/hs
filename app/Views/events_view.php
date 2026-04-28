<?php
// ── PHP logic preserved exactly ──────────────────────────────────────────────
$currentPage  = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix   = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle    = ($brand ? $brand . ' 이벤트' : '편의점 이벤트') . "{$pageSuffix} | 편잇";
$pageDesc     = $brand
    ? "{$brand}에서 진행 중인 1+1·2+1 할인 이벤트를 확인하세요."
    : "CU, GS25, 세븐일레븐, 이마트24 편의점 1+1·2+1 할인 이벤트를 한눈에 확인하세요.";
$canonical    = current_url();

// brand → CSS class map
function brandClass(string $b): string {
    return match (trim($b)) {
        'CU'       => 'brand-cu',
        'GS25'     => 'brand-gs25',
        '7-ELEVEn' => 'brand-seven',
        'emart24'  => 'brand-emart',
        default    => 'brand-other',
    };
}

// event_type → CSS class map
function etypeClass(string $t): string {
    return match (trim($t)) {
        '1+1' => 'etype-1p1',
        '2+1' => 'etype-2p1',
        '3+1' => 'etype-3p1',
        default => '',
    };
}
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

  <!-- JSON-LD Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ItemList",
    "name": "<?= $brand ? esc($brand) . ' 이벤트 리스트' : '모든 이벤트 리스트' ?>",
    "description": "<?= $brand ? esc($brand) . '에서 진행 중인 다양한 이벤트를 확인하세요!' : '모든 브랜드의 최신 이벤트 리스트를 한눈에 볼 수 있습니다.' ?>",
    "url": "<?= current_url() ?>",
    "itemListElement": [
      <?php foreach ($events as $index => $event): ?>
      {
        "@type": "ListItem",
        "position": <?= $index + 1 ?>,
        "url": "<?= base_url('/events/detail/' . $event['id']) ?>",
        "name": "<?= esc($event['product_name']) ?>",
        "image": "<?= esc($event['image_url']) ?>",
        "brand": "<?= esc($event['brand']) ?>"
      }<?= $index + 1 < count($events) ? ',' : '' ?>
      <?php endforeach; ?>
    ]
  }
  </script>

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
    <p class="lp-hero-eyebrow">CONVENIENCE STORE</p>
    <h1 class="lp-hero-title"><?= $brand ? esc($brand) . ' 이벤트' : '편의점 이벤트' ?></h1>
    <p class="lp-hero-sub">1+1·2+1 할인 이벤트를 한눈에</p>
  </div>
</section>

<div class="lp-body">
  <div class="container">

    <!-- Brand nav pills -->
    <nav class="brand-nav">
      <a href="/events"        class="<?= !$brand ? 'active' : '' ?>">전체</a>
      <a href="/events/cu"     class="brand-cu  <?= $brand === 'CU'        ? 'active' : '' ?>">CU</a>
      <a href="/events/gs25"   class="brand-gs25 <?= $brand === 'GS25'      ? 'active' : '' ?>">GS25</a>
      <a href="/events/7-ELEVEn" class="brand-seven <?= $brand === '7-ELEVEn' ? 'active' : '' ?>">세븐일레븐</a>
      <a href="/events/emart24"  class="brand-emart <?= $brand === 'emart24'  ? 'active' : '' ?>">이마트24</a>
    </nav>

    <!-- Filters -->
    <form class="lp-filter" method="get" action="<?= current_url() ?>">
      <div class="lp-filter-group">
        <label class="lp-filter-label" for="id_event_type">행사 유형</label>
        <select class="lp-select" name="event_type" id="id_event_type">
          <option value="" <?= $eventType == '' ? 'selected' : '' ?>>행사-전체</option>
          <option value="1+1" <?= $eventType == '1+1' ? 'selected' : '' ?>>1+1</option>
          <option value="2+1" <?= $eventType == '2+1' ? 'selected' : '' ?>>2+1</option>
          <option value="3+1" <?= $eventType == '3+1' ? 'selected' : '' ?>>3+1</option>
        </select>
      </div>
      <div class="lp-filter-group">
        <label class="lp-filter-label" for="id_category">분류</label>
        <select class="lp-select" name="category" id="id_category">
          <option value="" <?= $category == '' ? 'selected' : '' ?>>분류-전체</option>
          <option value="음료" <?= $category == '음료' ? 'selected' : '' ?>>음료</option>
          <option value="식품" <?= $category == '식품' ? 'selected' : '' ?>>식품</option>
          <option value="과자류" <?= $category == '과자류' ? 'selected' : '' ?>>과자류</option>
          <option value="아이스크림" <?= $category == '아이스크림' ? 'selected' : '' ?>>아이스크림</option>
          <option value="생활용품" <?= $category == '생활용품' ? 'selected' : '' ?>>생활용품</option>
        </select>
      </div>
      <div class="lp-filter-group">
        <label class="lp-filter-label" for="id_item">상품수</label>
        <select class="lp-select" name="item" id="id_item">
          <option value="20"  <?= $itemsPerPage == 20  ? 'selected' : '' ?>>20개</option>
          <option value="60"  <?= $itemsPerPage == 60  ? 'selected' : '' ?>>60개</option>
          <option value="100" <?= $itemsPerPage == 100 ? 'selected' : '' ?>>100개</option>
        </select>
      </div>
      <div class="lp-filter-group">
        <label class="lp-filter-label" for="id_sort">정렬</label>
        <select class="lp-select" name="sort" id="id_sort">
          <option value=""  <?= $sort == ''  ? 'selected' : '' ?>>상품명순</option>
          <option value="1" <?= $sort == '1' ? 'selected' : '' ?>>낮은가격순</option>
          <option value="2" <?= $sort == '2' ? 'selected' : '' ?>>높은가격순</option>
        </select>
      </div>
      <div class="lp-filter-group">
        <label class="lp-filter-label" for="id_q">검색</label>
        <input class="lp-filter-search" type="text" name="q" id="id_q" value="<?= esc($query) ?>" placeholder="상품명 검색">
      </div>
      <button type="submit" class="lp-select" style="cursor:pointer;">검색</button>
    </form>

    <!-- Event grid -->
    <?php if (!empty($events)): ?>
    <div class="lp-img-grid">
      <?php foreach ($events as $event): ?>
        <a class="lp-img-card" href="/events/detail/<?= esc($event['id']) ?>">
          <div class="lp-img-card-thumb" style="aspect-ratio:1/1;">
            <img src="<?= esc($event['image_url']) ?>" alt="<?= esc($event['product_name']) ?>" loading="lazy" decoding="async">
          </div>
          <div class="lp-img-card-body">
            <div style="display:flex;gap:4px;flex-wrap:wrap;margin-bottom:4px;">
              <span class="brand-badge <?= brandClass($event['brand']) ?>"><?= esc($event['brand']) ?></span>
              <?php if (!empty($event['event_type'])): ?>
              <span class="etype-badge <?= etypeClass($event['event_type']) ?>"><?= esc($event['event_type']) ?></span>
              <?php endif; ?>
            </div>
            <div class="lp-img-card-title"><?= esc($event['product_name']) ?></div>
            <div class="lp-img-card-meta"><?= number_format($event['price']) ?>원</div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="lp-empty">
      <span style="font-size:2rem;">🔍</span>
      <p>검색 결과가 없습니다</p>
    </div>
    <?php endif; ?>

    <div class="lp-pager">
      <?= $pager->links('default', 'default_full') ?>
    </div>

  </div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
