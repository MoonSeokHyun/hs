<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>병원·의료기관 검색 결과 | 편잇</title>
  <meta name="robots" content="noindex, follow">
  <link rel="canonical" href="<?= base_url('hospital') ?>">
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
    <p class="lp-hero-eyebrow">HOSPITAL SEARCH</p>
    <h1 class="lp-hero-title">🏥 의료기관 검색</h1>
    <p class="lp-hero-sub">전국 병원·의원·약국을 검색해보세요</p>
    <form class="lp-search" method="get" action="/hospital/search">
      <input type="text" name="query" placeholder="병원명, 주소, 진료과목 검색" value="<?= esc($searchQuery ?? '') ?>">
      <button type="submit">검색</button>
    </form>
  </div>
</section>

<div class="lp-body">
  <div class="container">

    <?php if (!empty($results)): ?>
    <div class="lp-section-head">
      <div>
        <span class="lp-section-kicker">SEARCH RESULTS</span>
        <p class="lp-section-title">검색 결과 <small style="font-size:14px;font-weight:500;color:#6B7280;"><?= number_format(count($results)) ?>건</small></p>
      </div>
      <a href="/hospital" class="lp-section-more">전체 목록 →</a>
    </div>
    <div class="lp-grid">
      <?php foreach ($results as $result): ?>
        <a class="lp-card" href="/hospital/detail/<?= esc($result['ID']) ?>">
          <div class="lp-card-name"><?= esc($result['BusinessName']) ?></div>
          <div class="lp-card-row">📍 <?= esc($result['FullAddress']) ?></div>
          <?php if (!empty($result['PhoneNumber'])): ?>
          <div class="lp-card-row">📞 <?= esc($result['PhoneNumber']) ?></div>
          <?php endif; ?>
        </a>
      <?php endforeach; ?>
    </div>
    <?php elseif (isset($searchQuery) && $searchQuery !== ''): ?>
    <p class="lp-empty">
      <span class="lp-empty-icon">🔍</span><br>
      <span class="lp-empty-text">"<?= esc($searchQuery) ?>"에 대한 검색 결과가 없습니다.</span>
    </p>
    <?php endif; ?>

  </div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>

<?php
$hostname = $_SERVER['HTTP_HOST'];
if (!preg_match('/^localhost(:[0-9]*)?$/', $hostname)): ?>
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
  if (!wcs_add) var wcs_add = {};
  wcs_add["wa"] = "8adec19974bed8";
  if (window.wcs) wcs_do();
</script>
<?php endif; ?>
</body>
</html>
