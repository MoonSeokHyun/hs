<?php
// 안전 초기화
foreach($facility as $k => $v) {
    $facility[$k] = esc($v);
}
preg_match('/([가-힣]+구|[가-힣]+읍|[가-힣]+면)/', $facility['RDNMADR_NM'] ?? '', $m);
$district = $m[0] ?? '';
// SEO 최적화
$titleSeo = "{$facility['FCLTY_NM']} {$district} 공영주차장 안내 | 공영주차장 정보 검색";
$descSeo  = "{$district} {$facility['RDNMADR_NM']}에 위치한 {$facility['FCLTY_NM']} 공영주차장 정보. 요금, 운영시간, 주차면수 등 상세 안내.";
$keywordsSeo = implode(',', [$district, '공영주차장', $facility['FCLTY_NM'], '주차요금', '주차장조회']);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- SEO 최적화 -->
  <title><?= $titleSeo ?></title>
  <meta name="description" content="<?= $descSeo ?>" />
  <meta name="keywords" content="<?= $keywordsSeo ?>" />
  <link rel="canonical" href="<?= current_url() ?>" />
  <!-- JSON-LD 구조화 데이터 (LocalBusiness) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "<?= $facility['FCLTY_NM'] ?> 공영주차장",
    "image": "[여기에_대표이미지_URL]",
    "@id": "<?= current_url() ?>",
    "url": "<?= current_url() ?>",
    "telephone": "<?= $facility['TEL_NO'] ?? '' ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?= $facility['RDNMADR_NM'] ?>",
      "addressRegion": "<?= $district ?>"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": <?= $facility['FCLTY_LA'] ?>,
      "longitude": <?= $facility['FCLTY_LO'] ?>
    },
    "openingHoursSpecification": [
      {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
        "opens": "<?= $facility['WORKDAY_OPN_BSNS_TIME'] ?>",
        "closes": "<?= $facility['WORKDAY_CLOS_TIME'] ?>"
      }
    ],
    "priceRange": "<?= $facility['BASS_PRICE'] ?>원~"
  }
  </script>
  <!-- Open Graph -->
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?= $titleSeo ?>" />
  <meta property="og:description" content="<?= $descSeo ?>" />
  <meta property="og:url" content="<?= current_url() ?>" />
  <meta property="og:image" content="[여기에_대표이미지_URL]" />
  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= $titleSeo ?>" />
  <meta name="twitter:description" content="<?= $descSeo ?>" />
  <meta name="robots" content="index,follow" />
  <script src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
  crossorigin="anonymous"></script>
  
  <style>
    body{background:#f5f5f5;font-family:'Noto Sans KR',sans-serif;margin:0;padding:0;color:#333}
    .container{max-width:900px;margin:2rem auto;padding:0 1rem}
    .back{display:inline-block;margin:1rem;color:#0078ff;text-decoration:none}
    .section{background:#fff;margin-bottom:1.5rem;padding:1.5rem;border-radius:8px;box-shadow:0 1px 4px rgba(0,0,0,0.1)}
    .section h2{font-size:1.2rem;margin-bottom:1rem;color:#0078ff;border-left:4px solid #0078ff;padding-left:.5rem}
    .detail-list{list-style:none;padding:0;margin:0}
    .detail-item{display:flex;justify-content:space-between;padding:.75rem 0;border-bottom:1px solid #eee}
    .detail-item:last-child{border-bottom:none}
    .label{font-weight:600}
    .value{text-align:right;word-break:break-all;max-width:60%}
    #map{width:100%;height:300px;border-radius:8px;margin-top:1rem}
  </style>
</head>
<body>
  <?php include APPPATH . 'Views/includes/header.php'; ?>
  <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
  <div class="container">
    <a href="<?= site_url('parking-facilities') ?>" class="back">← 목록으로 돌아가기</a>

    <div class="section"><h2>분류 정보</h2><ul class="detail-list">
      <li class="detail-item"><span class="label">상세분류</span><span class="value"><?= $facility['LCLAS_NM'] ?></span></li>
      <li class="detail-item"><span class="label">대분류</span><span class="value"><?= $facility['MLSFC_NM'] ?></span></li>
      <li class="detail-item"><span class="label">유형</span><span class="value"><?= $facility['TY_NM'] ?></span></li>
    </ul></div>

    <div class="section"><h2>위치 정보</h2><ul class="detail-list">
      <li class="detail-item"><span class="label">시도</span><span class="value"><?= $facility['CTPRVN_NM'] ?></span></li>
      <li class="detail-item"><span class="label">시군구</span><span class="value"><?= $facility['SIGNGU_NM'] ?></span></li>
      <li class="detail-item"><span class="label">법정동</span><span class="value"><?= $facility['LEGALDONG_NM'] ?></span></li>
      <li class="detail-item"><span class="label">행정동</span><span class="value"><?= $facility['ADSTRD_NM'] ?></span></li>
      <li class="detail-item"><span class="label">우편번호</span><span class="value"><?= $facility['ZIP_NO'] ?></span></li>
      <li class="detail-item"><span class="label">도로명주소</span><span class="value"><?= $facility['RDNMADR_NM'] ?></span></li>
    </ul></div>
    <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

    <div class="section"><h2>주차 면수</h2><ul class="detail-list">
      <li class="detail-item"><span class="label">주차면수</span><span class="value"><?= $facility['PARKNG_SPCE_CO'] ?></span></li>
      <li class="detail-item"><span class="label">이용제한 여부</span><span class="value"><?= $facility['UTILIIZA_LMTT_FLAG_NM'] ?></span></li>
    </ul></div>

    <div class="section"><h2>운영 시간</h2><ul class="detail-list">
      <li class="detail-item"><span class="label">평일 개장</span><span class="value"><?= $facility['WORKDAY_OPN_BSNS_TIME'] ?></span></li>
      <li class="detail-item"><span class="label">평일 폐장</span><span class="value"><?= $facility['WORKDAY_CLOS_TIME'] ?></span></li>
      <li class="detail-item"><span class="label">토요일 개장</span><span class="value"><?= $facility['SAT_OPN_BSNS_TIME'] ?></span></li>
      <li class="detail-item"><span class="label">토요일 폐장</span><span class="value"><?= $facility['SAT_CLOS_TIME'] ?></span></li>
      <li class="detail-item"><span class="label">일요일 개장</span><span class="value"><?= $facility['SUN_OPN_BSNS_TIME'] ?></span></li>
      <li class="detail-item"><span class="label">일요일 폐장</span><span class="value"><?= $facility['SUN_CLOS_TIME'] ?></span></li>
    </ul></div>

    <div class="section"><h2>요금 정보</h2><ul class="detail-list">
      <li class="detail-item"><span class="label">기본시간</span><span class="value"><?= $facility['BASS_TIME'] ?>분</span></li>
      <li class="detail-item"><span class="label">기본요금</span><span class="value"><?= $facility['BASS_PRICE'] ?>원</span></li>
      <li class="detail-item"><span class="label">추가단위 시간</span><span class="value"><?= $facility['ADIT_UNIT_TIME'] ?>분</span></li>
      <li class="detail-item"><span class="label">추가단위 요금</span><span class="value"><?= $facility['ADIT_UNIT_PRICE'] ?>원</span></li>
      <li class="detail-item"><span class="label">1일 주차 가능 시간</span><span class="value"><?= $facility['ONE_DAY_PARKNG_VLM_TIME'] ?>분</span></li>
      <li class="detail-item"><span class="label">1일 주차 요금</span><span class="value"><?= $facility['ONE_DAY_PARKNG_VLM_PRICE'] ?>원</span></li>
      <li class="detail-item"><span class="label">월정액 요금</span><span class="value"><?= $facility['MT_FDRM_PRICE'] ?>원</span></li>
    </ul></div>

    <div class="section"><h2>결제/할인</h2><ul class="detail-list">
      <li class="detail-item"><span class="label">결제수단</span><span class="value"><?= $facility['SETLE_MTH_CN'] ?></span></li>
      <li class="detail-item"><span class="label">추가할인</span><span class="value"><?= $facility['ADIT_DC'] ?></span></li>
    </ul></div>
    <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
    <div class="section"><h2>관리/제공 기관</h2><ul class="detail-list">
      <li class="detail-item"><span class="label">관리기관</span><span class="value"><?= $facility['MANAGE_INSTT_NM'] ?></span></li>
      <li class="detail-item"><span class="label">제공기관</span><span class="value"><?= $facility['PROVD_INSTT_NM'] ?></span></li>
      <li class="detail-item"><span class="label">데이터 기준일자</span><span class="value"><?= $facility['데이터기준일자'] ?></span></li>
    </ul></div>

    <div class="section"><h2>기타 메타</h2><ul class="detail-list">
      <li class="detail-item"><span class="label">관리번호</span><span class="value"><?= $facility['MANAGE_NO'] ?></span></li>
      <li class="detail-item"><span class="label">GID 코드</span><span class="value"><?= $facility['GID_CD'] ?></span></li>
     <li class="detail-item"><span class="label">기준일자</span><span class="value"><?= $facility['BASE_DE'] ?></span></li>
      <li class="detail-item"><span class="label">최종변경일자</span><span class="value"><?= $facility['LAST_CHG_DE'] ?></span></li>
    </ul></div>
    <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
    <div class="section">
      <h2>지도</h2>
      <div id="map"></div>
    </div>
    <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
  </div>
  <?= view_cell('\App\Cells\ExtraInfoCell::render') ?>
  <?php include APPPATH . 'Views/includes/footer.php'; ?>
  <script>
    (function(){
      var map = new naver.maps.Map('map',{center:new naver.maps.LatLng(parseFloat("<?= $facility['FCLTY_LA'] ?>"),parseFloat("<?= $facility['FCLTY_LO'] ?>")),zoom:16});
      new naver.maps.Marker({position:map.getCenter(),map:map,title:"<?= $facility['FCLTY_NM'] ?>"});
    })();
  </script>
</body>
</html>
