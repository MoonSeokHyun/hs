<?php
$hospitalId = (int) ($hospital['ID'] ?? 0);
$hospitalName = trim((string) ($hospital['BusinessName'] ?? '의료기관'));
$openServiceName = trim((string) ($hospital['OpenServiceName'] ?? '의료기관'));
$businessStatus = trim((string) ($hospital['BusinessStatusName'] ?? '정보 없음'));
$permitDate = trim((string) ($hospital['PermitDate'] ?? ''));
$phoneNumber = trim((string) ($hospital['PhoneNumber'] ?? ''));
$fullAddress = trim((string) ($hospital['FullAddress'] ?? ''));
$roadAddress = trim((string) ($hospital['RoadNameFullAddress'] ?? ''));
$postalCode = trim((string) ($hospital['PostalCode'] ?? ''));
$district = '인근';
if ($fullAddress !== '' && preg_match('/([가-힣]+구|[가-힣]+읍|[가-힣]+면)/u', $fullAddress, $matches)) {
    $district = $matches[0];
}
$canonicalUrl = $canonicalUrl ?? base_url('hospital/detail/' . $hospitalId);
$pageTitle = $hospitalName . ' | ' . $district . ' 위치, 운영시간, 리뷰 - 편잇';
$pageDescription = $district . '에 위치한 ' . $hospitalName . '의 운영시간, 주소, 전화번호, 사용자 리뷰 정보를 확인해보세요.';
$reviewCount = is_array($reviews ?? null) ? count($reviews) : 0;
$avgRating = 0.0;
if (isset($ratingSummary['avg_rating']) && is_numeric($ratingSummary['avg_rating'])) {
    $avgRating = round((float) $ratingSummary['avg_rating'], 1);
}
$jsonLd = [
    '@context' => 'https://schema.org',
    '@type' => 'MedicalClinic',
    'name' => $hospitalName,
    'url' => $canonicalUrl,
    'telephone' => $phoneNumber,
    'address' => ['@type'=>'PostalAddress','streetAddress'=>$roadAddress !== '' ? $roadAddress : $fullAddress,'addressLocality'=>$district,'postalCode'=>$postalCode,'addressCountry'=>'KR'],
];
if (!empty($latitude) && !empty($longitude)) {
    $jsonLd['geo'] = ['@type'=>'GeoCoordinates','latitude'=>(float)$latitude,'longitude'=>(float)$longitude];
}
if ($reviewCount > 0 && $avgRating > 0) {
    $jsonLd['aggregateRating'] = ['@type'=>'AggregateRating','ratingValue'=>$avgRating,'reviewCount'=>$reviewCount];
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($pageTitle) ?></title>
  <meta name="description" content="<?= esc($pageDescription) ?>">
  <meta name="keywords" content="<?= esc($hospitalName) ?>, 의료기관, <?= esc($district) ?> 병원, 위치, 운영시간, 후기">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= esc($canonicalUrl) ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= esc($pageTitle) ?>">
  <meta property="og:description" content="<?= esc($pageDescription) ?>">
  <meta property="og:url" content="<?= esc($canonicalUrl) ?>">
  <meta property="og:image" content="<?= esc(base_url('img/logo.png')) ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= esc($pageTitle) ?>">
  <meta name="twitter:description" content="<?= esc($pageDescription) ?>">
  <meta name="twitter:image" content="<?= esc(base_url('img/logo.png')) ?>">
  <script type="application/ld+json"><?= json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link rel="preload" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css"></noscript>
  <link rel="stylesheet" href="<?= base_url('css/common.css') ?>?v=<?= filemtime(FCPATH . 'css/common.css') ?>">
</head>
<body>
<?php include APPPATH . 'Views/includes/header.php'; ?>

<div class="main-content">
<div class="container" style="max-width:960px;">

  <!-- 브레드크럼 -->
  <nav class="dp-breadcrumb" aria-label="breadcrumb">
    <a href="/">홈</a>
    <span class="sep">/</span>
    <a href="/hospital">병원 찾기</a>
    <span class="sep">/</span>
    <span class="current"><?= esc($hospitalName) ?></span>
  </nav>

  <!-- 히어로 -->
  <div class="detail-hero">
    <h1 class="detail-hero-title">🏥 <?= esc($hospitalName) ?></h1>
    <p class="detail-hero-sub"><?= esc($district) ?> 위치 · <?= esc($openServiceName) ?></p>
    <div class="dp-chips">
      <span class="dp-chip <?= $businessStatus === '영업' ? 'dp-chip-green' : 'dp-chip-red' ?>">
        <?= esc($businessStatus) ?>
      </span>
      <?php if ($phoneNumber !== ''): ?>
        <a class="dp-chip dp-chip-link" href="tel:<?= esc($phoneNumber) ?>">
          📞 <?= esc($phoneNumber) ?>
        </a>
      <?php endif; ?>
      <span class="dp-chip dp-chip-orange"><?= esc($openServiceName) ?></span>
    </div>
  </div>

  <!-- 광고 1 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 기본 정보 -->
  <div class="content-card">
    <h2 class="content-card-title">📋 기본 정보</h2>
    <dl class="dp-kv">
      <div class="dp-kv-row">
        <dt class="dp-kv-key">기관명</dt>
        <dd class="dp-kv-val"><?= esc($hospitalName) ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">서비스분류</dt>
        <dd class="dp-kv-val"><?= esc($openServiceName !== '' ? $openServiceName : '정보 없음') ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">전화번호</dt>
        <dd class="dp-kv-val">
          <?php if ($phoneNumber !== ''): ?>
            <a href="tel:<?= esc($phoneNumber) ?>"><?= esc($phoneNumber) ?></a>
          <?php else: ?>
            정보 없음
          <?php endif; ?>
        </dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">영업상태</dt>
        <dd class="dp-kv-val"><?= esc($businessStatus !== '' ? $businessStatus : '정보 없음') ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">주소</dt>
        <dd class="dp-kv-val"><?= esc($fullAddress !== '' ? $fullAddress : '정보 없음') ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">도로명주소</dt>
        <dd class="dp-kv-val"><?= esc($roadAddress !== '' ? $roadAddress : '정보 없음') ?></dd>
      </div>
    </dl>
  </div>

  <!-- 근처 의료기관 -->
  <div class="content-card">
    <h2 class="content-card-title">📍 근처 의료기관</h2>
    <?php if (!empty($nearbyFacilities)): ?>
      <div class="table-responsive">
        <table class="nearby-table">
          <thead>
            <tr>
              <th>시설명</th>
              <th>주소</th>
              <th>전화번호</th>
              <th>거리</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($nearbyFacilities as $facility): ?>
              <tr>
                <td>
                  <a href="/hospital/detail/<?= esc((string)($facility['ID'] ?? '')) ?>">
                    <?= esc($facility['BusinessName'] ?? '의료기관') ?>
                  </a>
                </td>
                <td><?= esc($facility['FullAddress'] ?? '') ?></td>
                <td><?= esc($facility['PhoneNumber'] ?? '') ?></td>
                <td>
                  <?= isset($facility['distance'])
                      ? esc(number_format((float)$facility['distance'], 2)) . ' km'
                      : '-' ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-muted">근처 의료기관 정보가 없습니다.</p>
    <?php endif; ?>
  </div>

  <!-- 광고 2 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 이용 후기 -->
  <div class="content-card">
    <h2 class="content-card-title">⭐ 이용 후기</h2>
    <div class="review-summary">
      평균 <strong><?= esc(number_format($avgRating, 1)) ?></strong>점
      &nbsp;·&nbsp; 리뷰 <strong><?= esc((string)$reviewCount) ?></strong>개
    </div>
    <?php if (!empty($reviews)): ?>
      <div class="review-list">
        <?php foreach ($reviews as $review): ?>
          <div class="review-item">
            <div class="review-header">
              <span class="review-author"><?= esc($review['user_name'] ?? '익명') ?></span>
              <span class="review-rating">
                <?= str_repeat('★', min(5, max(0, (int)($review['rating'] ?? 0)))) ?>
              </span>
            </div>
            <p class="review-text"><?= esc($review['comment'] ?? '') ?></p>
            <time class="review-date"><?= esc($review['created_at'] ?? '') ?></time>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="text-muted">아직 리뷰가 없습니다.</p>
    <?php endif; ?>
  </div>

  <!-- 리뷰 쓰기 -->
  <div class="content-card">
    <h2 class="content-card-title">✏️ 리뷰 쓰기</h2>
    <form class="review-form" action="/hospital/addReview" method="post">
      <input type="hidden" name="hospital_id" value="<?= esc((string)$hospitalId) ?>">
      <input class="form-input" type="text" name="user_name" placeholder="이름" required>
      <div class="star-row" role="group" aria-label="별점 선택">
        <?php for ($i = 5; $i >= 1; $i--): ?>
          <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" class="star" <?= $i === 5 ? 'checked' : '' ?>>
          <label for="star<?= $i ?>" class="star-label" title="<?= $i ?>점">★</label>
        <?php endfor; ?>
      </div>
      <textarea class="form-textarea" name="comment" rows="4" placeholder="리뷰를 작성해주세요." required></textarea>
      <button class="form-submit" type="submit">리뷰 등록하기</button>
    </form>
  </div>

  <!-- 광고 3 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <?= view_cell('\App\Cells\ExtraInfoCell::render') ?>

  <a href="/hospital" class="back-btn">← 병원 목록으로</a>

</div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
