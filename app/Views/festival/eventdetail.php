<?php
$eventName  = $event['Event_Name'] ?? '공연';
$eventStart = $event['Event_Start_Date'] ?? '';
$eventEnd   = $event['Event_End_Date'] ?? '';
$eventVenue = $event['Venue'] ?? '';
$eventDesc  = $event['Description'] ?? '';
$eventImg   = $event['image_path'] ?? '';

$descFallback = "{$eventName} " . ($eventVenue ? "{$eventVenue}에서 " : '') . "열리는 공연·행사 정보입니다.";
$pageDesc = esc(mb_substr(preg_replace('/\s+/', ' ', strip_tags($eventDesc ?: $descFallback)), 0, 155));
$pageTitle = esc("{$eventName} - 공연·행사 정보 | 편잇");
$canonical = esc(current_url());
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?></title>
  <meta name="description" content="<?= $pageDesc ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= $canonical ?>">
  <meta property="og:title" content="<?= $pageTitle ?>">
  <meta property="og:description" content="<?= $pageDesc ?>">
  <meta property="og:url" content="<?= $canonical ?>">
  <meta property="og:type" content="event">
  <meta property="og:image" content="<?= $eventImg ? esc($eventImg) : base_url('img/logo.png') ?>">
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link rel="preload" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css"></noscript>
  <link rel="stylesheet" href="<?= base_url('css/common.css') ?>?v=<?= filemtime(FCPATH.'css/common.css') ?>">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
  <?php if ($eventName && $eventStart): ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Event",
    "name": "<?= esc($eventName) ?>",
    "startDate": "<?= esc($eventStart) ?>",
    "endDate": "<?= esc($eventEnd) ?>",
    "location": { "@type": "Place", "name": "<?= esc($eventVenue) ?>" },
    "description": "<?= $pageDesc ?>",
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
    <span class="current"><?= esc($eventName) ?></span>
  </nav>

  <div class="detail-hero">
    <h1 class="detail-hero-title">🎭 <?= esc($eventName) ?></h1>
    <?php if ($eventVenue): ?>
    <p class="detail-hero-sub">📍 <?= esc($eventVenue) ?></p>
    <?php endif; ?>
    <div class="dp-chips">
      <?php if ($eventStart || $eventEnd): ?>
      <span class="dp-chip dp-chip-orange">📅 <?= esc($eventStart) ?> ~ <?= esc($eventEnd) ?></span>
      <?php endif; ?>
      <?php if (!empty($event['Website_URL'])): ?>
      <a href="<?= esc($event['Website_URL']) ?>" target="_blank" rel="noopener" class="dp-chip dp-chip-link">🔗 공식 사이트</a>
      <?php endif; ?>
    </div>
  </div>

  <ins class="adsbygoogle ad-slot"
    style="display:block" data-ad-client="ca-pub-6686738239613464"
    data-ad-slot="1204098626" data-ad-format="auto" data-full-width-responsive="true"></ins>

  <?php if ($eventImg): ?>
  <div class="content-card" style="padding:0;overflow:hidden;">
    <img src="<?= esc($eventImg) ?>" alt="<?= esc($eventName) ?> 포스터" loading="lazy" decoding="async"
      style="width:100%;max-height:360px;object-fit:cover;display:block;">
  </div>
  <?php endif; ?>

  <div class="content-card">
    <h2 class="content-card-title">📋 공연 정보</h2>
    <div class="dp-kv">
      <div class="dp-kv-row"><span class="dp-kv-key">공연명</span><span class="dp-kv-val"><?= esc($eventName) ?></span></div>
      <?php if ($eventVenue): ?>
      <div class="dp-kv-row"><span class="dp-kv-key">장소</span><span class="dp-kv-val"><?= esc($eventVenue) ?></span></div>
      <?php endif; ?>
      <?php if ($eventStart || $eventEnd): ?>
      <div class="dp-kv-row"><span class="dp-kv-key">기간</span><span class="dp-kv-val"><?= esc($eventStart) ?> ~ <?= esc($eventEnd) ?></span></div>
      <?php endif; ?>
      <?php if (!empty($event['Website_URL'])): ?>
      <div class="dp-kv-row"><span class="dp-kv-key">웹사이트</span><span class="dp-kv-val"><a href="<?= esc($event['Website_URL']) ?>" target="_blank" rel="noopener"><?= esc($event['Website_URL']) ?></a></span></div>
      <?php endif; ?>
    </div>
  </div>

  <?= view('includes/section_naver_map', [
      'latitude'  => isset($event['Latitude']) && $event['Latitude'] !== '' ? $event['Latitude'] : null,
      'longitude' => isset($event['Longitude']) && $event['Longitude'] !== '' ? $event['Longitude'] : null,
      'title'     => $eventName,
      'address'   => (string) ($event['Road_Address'] ?? $eventVenue ?? ''),
      'mapId'     => 'evt-map-' . (int) ($event['ID'] ?? 0),
      'linkQuery' => $map_link_query ?? '',
  ]) ?>

  <?php if ($eventDesc): ?>
  <div class="content-card">
    <h2 class="content-card-title">📝 공연 설명</h2>
    <p style="font-size:14px;line-height:1.8;color:#374151;margin:0;"><?= esc($eventDesc) ?></p>
  </div>
  <?php endif; ?>

  <ins class="adsbygoogle ad-slot"
    style="display:block" data-ad-client="ca-pub-6686738239613464"
    data-ad-slot="1204098626" data-ad-format="auto" data-full-width-responsive="true"></ins>

  <?php if (!empty($relatedEvents)): ?>
  <div class="lp-section-head">
    <div>
      <span class="lp-section-kicker">RELATED</span>
      <p class="lp-section-title">관련 공연</p>
    </div>
  </div>
  <div class="lp-grid">
    <?php foreach ($relatedEvents as $related): ?>
    <a class="lp-card" href="/festival-info/eventdetail/<?= esc($related['ID']) ?>">
      <?php if (!empty($related['image_path'])): ?>
      <img src="<?= esc($related['image_path']) ?>" alt="<?= esc($related['Event_Name']) ?>" loading="lazy" decoding="async"
        style="width:100%;height:140px;object-fit:cover;border-radius:10px;margin-bottom:10px;">
      <?php endif; ?>
      <div class="lp-card-name"><?= esc($related['Event_Name']) ?></div>
      <?php if (!empty($related['Venue'])): ?>
      <div class="lp-card-row">📍 <?= esc($related['Venue']) ?></div>
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
