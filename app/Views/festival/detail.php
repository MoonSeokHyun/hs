<?php
$fname    = $festival['Festival_Name'] ?? '축제';
$fvenue   = $festival['Venue'] ?? '';
$fstart   = $festival['Start_Date'] ?? '';
$fend     = $festival['End_Date'] ?? '';
$fdescRaw = trim((string)($festival['Description'] ?? ''));
if ($fdescRaw === '') {
    $periodTxt = ($fstart && $fend) ? " {$fstart}부터 {$fend}까지" : '';
    $venueTxt  = $fvenue ? " {$fvenue}에서" : '';
    $fdescRaw  = "{$fname}{$venueTxt}{$periodTxt} 개최되는 공연·행사 정보입니다. 일정, 장소, 주최기관 등 상세 내용을 확인하세요.";
}
$festivalDesc = mb_substr(preg_replace('/\s+/', ' ', strip_tags($fdescRaw)), 0, 155);

$pageTitle = esc("{$fname} - 축제·공연 일정·장소 정보 | 편잇");
$canonical = esc(current_url());
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?></title>
  <meta name="description" content="<?= esc($festivalDesc) ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= $canonical ?>">
  <meta property="og:title" content="<?= $pageTitle ?>">
  <meta property="og:description" content="<?= esc($festivalDesc) ?>">
  <meta property="og:url" content="<?= $canonical ?>">
  <meta property="og:type" content="event">
  <meta property="og:image" content="<?= base_url('img/logo.png') ?>">
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link rel="preload" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css"></noscript>
  <link rel="stylesheet" href="<?= base_url('css/common.css') ?>?v=<?= filemtime(FCPATH.'css/common.css') ?>">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
  <?php if ($fname && $fstart): ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Event",
    "name": "<?= esc($fname) ?>",
    "startDate": "<?= esc($fstart) ?>",
    "endDate": "<?= esc($fend) ?>",
    "location": {
      "@type": "Place",
      "name": "<?= esc($fvenue) ?>",
      "address": "<?= esc($festival['Address_Road'] ?? $fvenue) ?>"
    },
    "description": "<?= esc($festivalDesc) ?>",
    "url": "<?= $canonical ?>"
  }
  </script>
  <?php endif; ?>
</head>
<body>
<?php include APPPATH . 'Views/includes/header.php'; ?>

<div class="main-content">
<div class="container" style="max-width:960px;">

  <nav class="dp-breadcrumb" aria-label="breadcrumb">
    <a href="/">홈</a><span class="sep">/</span>
    <a href="/festival-info">축제·공연</a><span class="sep">/</span>
    <span class="current"><?= esc($fname) ?></span>
  </nav>

  <div class="detail-hero">
    <h1 class="detail-hero-title">🎊 <?= esc($fname) ?></h1>
    <?php if ($fvenue): ?>
    <p class="detail-hero-sub">📍 <?= esc($fvenue) ?></p>
    <?php endif; ?>
    <div class="dp-chips">
      <?php if ($fstart || $fend): ?>
      <span class="dp-chip dp-chip-orange">📅 <?= esc($fstart) ?> ~ <?= esc($fend) ?></span>
      <?php endif; ?>
      <?php if (!empty($festival['Contact_Number'])): ?>
      <a href="tel:<?= esc($festival['Contact_Number']) ?>" class="dp-chip dp-chip-link">📞 <?= esc($festival['Contact_Number']) ?></a>
      <?php endif; ?>
    </div>
  </div>

  <ins class="adsbygoogle ad-slot"
    style="display:block" data-ad-client="ca-pub-6686738239613464"
    data-ad-slot="1204098626" data-ad-format="auto" data-full-width-responsive="true"></ins>

  <div class="content-card">
    <h2 class="content-card-title">📋 행사 정보</h2>
    <div class="dp-kv">
      <div class="dp-kv-row"><span class="dp-kv-key">행사명</span><span class="dp-kv-val"><?= esc($fname) ?></span></div>
      <?php if ($fvenue): ?>
      <div class="dp-kv-row"><span class="dp-kv-key">장소</span><span class="dp-kv-val"><?= esc($fvenue) ?></span></div>
      <?php endif; ?>
      <?php if ($fstart || $fend): ?>
      <div class="dp-kv-row"><span class="dp-kv-key">기간</span><span class="dp-kv-val"><?= esc($fstart) ?> ~ <?= esc($fend) ?></span></div>
      <?php endif; ?>
      <?php if (!empty($festival['Address_Road'])): ?>
      <div class="dp-kv-row"><span class="dp-kv-key">도로명</span><span class="dp-kv-val"><?= esc($festival['Address_Road']) ?></span></div>
      <?php endif; ?>
      <?php if (!empty($festival['Address_Land'])): ?>
      <div class="dp-kv-row"><span class="dp-kv-key">지번</span><span class="dp-kv-val"><?= esc($festival['Address_Land']) ?></span></div>
      <?php endif; ?>
      <?php if (!empty($festival['Organizing_Agency'])): ?>
      <div class="dp-kv-row"><span class="dp-kv-key">주최</span><span class="dp-kv-val"><?= esc($festival['Organizing_Agency']) ?></span></div>
      <?php endif; ?>
      <?php if (!empty($festival['Hosting_Agency'])): ?>
      <div class="dp-kv-row"><span class="dp-kv-key">주관</span><span class="dp-kv-val"><?= esc($festival['Hosting_Agency']) ?></span></div>
      <?php endif; ?>
      <?php if (!empty($festival['Supporting_Agency'])): ?>
      <div class="dp-kv-row"><span class="dp-kv-key">후원</span><span class="dp-kv-val"><?= esc($festival['Supporting_Agency']) ?></span></div>
      <?php endif; ?>
      <?php if (!empty($festival['Contact_Number'])): ?>
      <div class="dp-kv-row"><span class="dp-kv-key">연락처</span><span class="dp-kv-val"><a href="tel:<?= esc($festival['Contact_Number']) ?>"><?= esc($festival['Contact_Number']) ?></a></span></div>
      <?php endif; ?>
      <?php if (!empty($festival['Website_URL'])): ?>
      <div class="dp-kv-row"><span class="dp-kv-key">웹사이트</span><span class="dp-kv-val"><a href="<?= esc($festival['Website_URL']) ?>" target="_blank" rel="noopener"><?= esc($festival['Website_URL']) ?></a></span></div>
      <?php endif; ?>
      <?php if (!empty($festival['Provider_Name'])): ?>
      <div class="dp-kv-row"><span class="dp-kv-key">제공기관</span><span class="dp-kv-val"><?= esc($festival['Provider_Name']) ?></span></div>
      <?php endif; ?>
    </div>
  </div>

  <?= view('includes/section_naver_map', [
      'latitude'  => isset($festival['Latitude']) && $festival['Latitude'] !== '' ? $festival['Latitude'] : null,
      'longitude' => isset($festival['Longitude']) && $festival['Longitude'] !== '' ? $festival['Longitude'] : null,
      'title'     => $fname,
      'address'   => (string) ($festival['Address_Road'] ?? $fvenue),
      'mapId'     => 'fest-map-' . (int) ($festival['id'] ?? 0),
      'linkQuery' => $map_link_query ?? '',
  ]) ?>

  <?php if (!empty($festival['Description'])): ?>
  <div class="content-card">
    <h2 class="content-card-title">📝 행사 설명</h2>
    <p style="font-size:14px;line-height:1.8;color:#374151;margin:0;"><?= esc($festival['Description']) ?></p>
  </div>
  <?php endif; ?>

  <?php if (!empty($festival['Related_Information'])): ?>
  <div class="content-card">
    <h2 class="content-card-title">ℹ️ 기타 정보</h2>
    <p style="font-size:14px;line-height:1.8;color:#374151;margin:0;"><?= esc($festival['Related_Information']) ?></p>
  </div>
  <?php endif; ?>

  <ins class="adsbygoogle ad-slot"
    style="display:block" data-ad-client="ca-pub-6686738239613464"
    data-ad-slot="1204098626" data-ad-format="auto" data-full-width-responsive="true"></ins>

  <?php if (!empty($relatedFestivals)): ?>
  <div class="lp-section-head">
    <div>
      <span class="lp-section-kicker">RELATED</span>
      <p class="lp-section-title">다른 축제도 살펴보세요</p>
    </div>
  </div>
  <div class="lp-grid">
    <?php foreach ($relatedFestivals as $related): ?>
    <a class="lp-card" href="/festival-info/<?= esc($related['id']) ?>">
      <div class="lp-card-name"><?= esc($related['Festival_Name']) ?></div>
      <?php if (!empty($related['Address_Road'])): ?>
      <div class="lp-card-row">📍 <?= esc($related['Address_Road']) ?></div>
      <?php endif; ?>
    </a>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <ins class="adsbygoogle ad-slot"
    style="display:block" data-ad-client="ca-pub-6686738239613464"
    data-ad-slot="1204098626" data-ad-format="auto" data-full-width-responsive="true"></ins>

  <?= view('includes/section_naver_blog', ['blog_posts' => $blog_posts ?? []]) ?>

  <a href="/festival-info" class="back-btn">← 목록으로 돌아가기</a>

</div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>

<?php if (!preg_match('/^localhost(:[0-9]*)?$/', $_SERVER['HTTP_HOST'])): ?>
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
  if (!wcs_add) var wcs_add = {};
  wcs_add["wa"] = "8adec19974bed8";
  if (window.wcs) wcs_do();
</script>
<?php endif; ?>
</body>
</html>
