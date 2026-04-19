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
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => $roadAddress !== '' ? $roadAddress : $fullAddress,
        'addressLocality' => $district,
        'postalCode' => $postalCode,
        'addressCountry' => 'KR',
    ],
];

if (!empty($latitude) && !empty($longitude)) {
    $jsonLd['geo'] = [
        '@type' => 'GeoCoordinates',
        'latitude' => (float) $latitude,
        'longitude' => (float) $longitude,
    ];
}

if ($reviewCount > 0 && $avgRating > 0) {
    $jsonLd['aggregateRating'] = [
        '@type' => 'AggregateRating',
        'ratingValue' => $avgRating,
        'reviewCount' => $reviewCount,
    ];
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($pageTitle) ?></title>
  <meta name="description" content="<?= esc($pageDescription) ?>">
  <meta name="keywords" content="<?= esc($hospitalName) ?>, 의료기관, <?= esc($district) ?> 병원, 위치, 운영시간, 후기, 정보">
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

  <style>
    :root {
      --main-color: #62d491;
      --point-color: #3eaf7c;
      --bg-color: #f7f8fa;
      --card-bg: #ffffff;
      --border-color: #dfe4ea;
      --text-color: #253238;
      --sub-text: #5f6b72;
    }

    * { box-sizing: border-box; }
    body {
      margin: 0;
      background: var(--bg-color);
      color: var(--text-color);
      font-family: "Pretendard", "Noto Sans KR", Arial, sans-serif;
      line-height: 1.6;
    }

    .page-wrap {
      max-width: 1080px;
      margin: 24px auto 40px;
      padding: 0 16px;
    }

    .hero-card,
    .content-card {
      background: var(--card-bg);
      border: 1px solid var(--border-color);
      border-radius: 14px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      padding: 24px;
      margin-bottom: 16px;
    }

    .ad-card {
      background: #fff;
      border: 1px solid var(--border-color);
      border-radius: 12px;
      padding: 10px;
      margin-bottom: 16px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.04);
    }

    .hero-title {
      margin: 0 0 8px;
      font-size: 30px;
      line-height: 1.3;
      color: #1f2d33;
    }

    .hero-subtitle {
      margin: 0;
      color: var(--sub-text);
      font-size: 15px;
    }

    .status-row {
      margin-top: 14px;
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }

    .status-chip {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 999px;
      font-size: 13px;
      border: 1px solid #d1f0df;
      background: #f0fdf8;
      color: #24694c;
    }

    .section-title {
      margin: 0 0 14px;
      font-size: 20px;
      color: var(--point-color);
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 14px;
    }

    .info-box {
      border: 1px solid var(--border-color);
      border-radius: 10px;
      padding: 14px;
      background: #fbfdfc;
    }

    .info-label {
      font-size: 12px;
      color: var(--sub-text);
      margin-bottom: 6px;
    }

    .info-value {
      font-size: 15px;
      color: var(--text-color);
      word-break: break-word;
    }

    .nearby-table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 10px;
      border: 1px solid var(--border-color);
    }

    .nearby-table th,
    .nearby-table td {
      border-bottom: 1px solid var(--border-color);
      padding: 11px 10px;
      text-align: left;
      font-size: 14px;
      vertical-align: top;
    }

    .nearby-table th {
      background: #eefaf4;
      color: #2c5f49;
      font-weight: 700;
    }

    .nearby-table tr:last-child td {
      border-bottom: none;
    }

    .nearby-table a {
      color: #24754f;
      text-decoration: none;
      font-weight: 600;
    }

    .nearby-table a:hover {
      text-decoration: underline;
    }

    .review-summary {
      margin-bottom: 14px;
      padding: 12px 14px;
      border-radius: 10px;
      background: #f6fcf9;
      border: 1px solid #d8efe3;
      color: #285b46;
      font-size: 14px;
    }

    .review-item {
      border: 1px solid var(--border-color);
      border-radius: 10px;
      background: #fff;
      padding: 14px;
      margin-bottom: 10px;
    }

    .review-head {
      display: flex;
      justify-content: space-between;
      gap: 10px;
      margin-bottom: 8px;
      font-size: 14px;
    }

    .review-author {
      font-weight: 700;
    }

    .review-rating {
      color: #f2a11b;
      font-weight: 700;
    }

    .review-date {
      color: var(--sub-text);
      font-size: 12px;
      margin-top: 8px;
    }

    .review-form {
      display: grid;
      gap: 10px;
    }

    .review-form input[type="text"],
    .review-form select,
    .review-form textarea {
      width: 100%;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      padding: 10px 11px;
      font-size: 14px;
      background: #fff;
    }

    .review-form button {
      border: none;
      border-radius: 8px;
      background: var(--main-color);
      color: #fff;
      font-weight: 700;
      padding: 12px;
      cursor: pointer;
      transition: background-color .2s ease;
    }

    .review-form button:hover {
      background: var(--point-color);
    }

    .share-row {
      margin-top: 16px;
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .share-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 1px solid var(--border-color);
      background: #fff;
    }

    .share-btn img {
      width: 22px;
      height: 22px;
      display: block;
    }

    @media (max-width: 768px) {
      .hero-title { font-size: 24px; }
      .info-grid { grid-template-columns: 1fr; }
      .nearby-table th, .nearby-table td { font-size: 13px; padding: 9px 8px; }
      .hero-card, .content-card { padding: 16px; }
    }
  </style>
</head>
<body>
<?php include APPPATH . 'Views/includes/header.php'; ?>

<main class="page-wrap">
  <section class="hero-card">
    <h1 class="hero-title"><?= esc($hospitalName) ?></h1>
    <p class="hero-subtitle"><?= esc($district) ?> 위치 의료기관 상세 정보, 주변 시설, 리뷰를 확인하세요.</p>
    <div class="status-row">
      <span class="status-chip">서비스: <?= esc($openServiceName) ?></span>
      <span class="status-chip">상태: <?= esc($businessStatus) ?></span>
      <?php if ($permitDate !== ''): ?>
        <span class="status-chip">허가일: <?= esc($permitDate) ?></span>
      <?php endif; ?>
    </div>
  </section>

  <div class="ad-card">
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
  </div>

  <section class="content-card">
    <h2 class="section-title">기본 정보</h2>
    <div class="info-grid">
      <div class="info-box">
        <div class="info-label">의료기관명</div>
        <div class="info-value"><?= esc($hospitalName) ?></div>
      </div>
      <div class="info-box">
        <div class="info-label">서비스 분류</div>
        <div class="info-value"><?= esc($openServiceName) ?></div>
      </div>
      <div class="info-box">
        <div class="info-label">전화번호</div>
        <div class="info-value"><?= esc($phoneNumber !== '' ? $phoneNumber : '정보 없음') ?></div>
      </div>
      <div class="info-box">
        <div class="info-label">영업 상태</div>
        <div class="info-value"><?= esc($businessStatus) ?></div>
      </div>
      <div class="info-box">
        <div class="info-label">주소</div>
        <div class="info-value"><?= esc($fullAddress !== '' ? $fullAddress : '정보 없음') ?></div>
      </div>
      <div class="info-box">
        <div class="info-label">도로명 주소</div>
        <div class="info-value"><?= esc($roadAddress !== '' ? $roadAddress : '정보 없음') ?></div>
      </div>
    </div>
  </section>

  <section class="content-card">
    <h2 class="section-title">근처 의료기관</h2>
    <?php if (!empty($nearbyFacilities)): ?>
      <table class="nearby-table">
        <thead>
          <tr>
            <th>시설명</th>
            <th>주소</th>
            <th>전화번호</th>
            <th>거리 (km)</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($nearbyFacilities as $facility): ?>
            <tr>
              <td><a href="/hospital/detail/<?= esc($facility['ID'] ?? '') ?>"><?= esc($facility['BusinessName'] ?? '의료기관') ?></a></td>
              <td><?= esc($facility['FullAddress'] ?? '') ?></td>
              <td><?= esc($facility['PhoneNumber'] ?? '') ?></td>
              <td><?= isset($facility['distance']) ? esc(number_format((float) $facility['distance'], 2)) . ' km' : '-' ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>근처 의료기관 정보가 없습니다.</p>
    <?php endif; ?>
  </section>

  <div class="ad-card">
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
  </div>

  <section class="content-card">
    <h2 class="section-title">리뷰 및 평점</h2>
    <div class="review-summary">
      평균 평점: <strong><?= esc(number_format($avgRating, 1)) ?></strong> / 5 · 리뷰 <strong><?= esc((string) $reviewCount) ?></strong>개
    </div>

    <?php if (!empty($reviews)): ?>
      <?php foreach ($reviews as $review): ?>
        <article class="review-item">
          <div class="review-head">
            <span class="review-author"><?= esc($review['user_name'] ?? '익명') ?></span>
            <span class="review-rating"><?= str_repeat('★', (int) ($review['rating'] ?? 0)) ?></span>
          </div>
          <div><?= esc($review['comment'] ?? '') ?></div>
          <div class="review-date"><?= esc($review['created_at'] ?? '') ?></div>
        </article>
      <?php endforeach; ?>
    <?php else: ?>
      <p>아직 등록된 리뷰가 없습니다.</p>
    <?php endif; ?>
  </section>

  <section class="content-card">
    <h2 class="section-title">리뷰 작성</h2>
    <form class="review-form" action="/hospital/addReview" method="post">
      <input type="hidden" name="hospital_id" value="<?= esc((string) $hospitalId) ?>">
      <input type="text" name="user_name" placeholder="이름" required>
      <select name="rating" required>
        <option value="5">★★★★★ (5점)</option>
        <option value="4">★★★★ (4점)</option>
        <option value="3">★★★ (3점)</option>
        <option value="2">★★ (2점)</option>
        <option value="1">★ (1점)</option>
      </select>
      <textarea name="comment" rows="4" placeholder="리뷰를 작성해주세요." required></textarea>
      <button type="submit">리뷰 작성</button>
    </form>

    <div class="share-row">
      <span>이 페이지 공유:</span>
      <a class="share-btn" href="https://facebook.com/sharer/sharer.php?u=<?= urlencode($canonicalUrl) ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook 공유">
        <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="">
      </a>
      <a class="share-btn" href="https://twitter.com/share?url=<?= urlencode($canonicalUrl) ?>" target="_blank" rel="noopener noreferrer" aria-label="X 공유">
        <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="">
      </a>
    </div>
  </section>

  <div class="ad-card">
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
  </div>

  <?= view_cell('\App\Cells\ExtraInfoCell::render') ?>
</main>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
