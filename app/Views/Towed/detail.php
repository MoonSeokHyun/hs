<?php
// 보관소의 도로명 주소 예시
$road_address = esc($storage['address_road_name']);

// 구 이름이나 읍 이름을 추출하기 위한 정규 표현식
preg_match('/([가-힣]+구|[가-힣]+읍)/', $road_address, $matches);

// 구 또는 읍 이름을 추출
$district_name = isset($matches[0]) ? $matches[0] : '보관소';
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8" />
  <title><?= esc($storage['towed_vehicle_storage_name']); ?> - <?= esc($district_name); ?> 견인차 보관소</title>

  <meta name="description" content="<?= esc($storage['address_road_name'] ?? '') ?> 위치의 견인차 보관소 <?= esc($storage['towed_vehicle_storage_name'] ?? '') ?>의 상세 정보, 전화번호, 보관 요금 등을 확인해보세요.">
  <meta name="keywords" content="견인차 보관소, <?= esc($storage['towed_vehicle_storage_name'] ?? '') ?>, 차량 보관소, 차량 견인, 견인차 보관소 추천, <?= esc($storage['address_road_name'] ?? '') ?>">
  <meta name="author" content="편잇 팀">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="robots" content="index, follow" />

  <!-- Open Graph (SNS 공유 최적화) -->
  <meta property="og:title" content="<?= esc($storage['towed_vehicle_storage_name'] ?? '') ?> - 견인차 보관소 상세 정보">
  <meta property="og:description" content="<?= esc($storage['address_road_name'] ?? '') ?> 위치의 견인차 보관소 정보입니다.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= current_url() ?>">
  <meta property="og:image" content="/static/images/og-default.jpg">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= esc($storage['towed_vehicle_storage_name'] ?? '') ?>">
  <meta name="twitter:description" content="견인차 보관소 상세정보를 확인해보세요.">
  <meta name="twitter:image" content="/static/images/og-default.jpg">

  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
  <script src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>

  <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Place",
  "name": "<?= esc($storage['towed_vehicle_storage_name'] ?? '') ?>",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "<?= esc($storage['address_road_name'] ?? '') ?>",
    "addressLocality": "<?= esc($district_name); ?>",
    "addressCountry": "KR"
  },
  "telephone": "<?= esc($storage['storage_facility_phone_number'] ?? '') ?>",
  "url": "<?= current_url() ?>",
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "<?= esc($storage['latitude']); ?>",
    "longitude": "<?= esc($storage['longitude']); ?>"
  },
  "image": "/static/images/og-default.jpg",
  "description": "<?= esc($storage['towed_vehicle_storage_name'] ?? '') ?> 보관소의 전화번호, 주소 및 보관 요금 등 상세 정보를 확인할 수 있습니다."
}
</script>
</head>
<style>
    /* 기본 초기화 */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f5f5f5;
    }

    /* Hero Section */
    .hero-section {
      background: #fff;
      padding: 2rem;
      text-align: center;
      margin-bottom: 2rem;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .hero-section h2 {
      font-size: 24px;
      margin-bottom: 1rem;
      color: #333;
    }

    .hero-section p {
      font-size: 16px;
      color: #555;
    }

    /* 보관소 상세 Section */
    .detail-section {
      background: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      margin-bottom: 2rem;
    }

    .detail-header {
      margin-bottom: 16px;
      text-align: center;
    }

    .facility-name {
      font-size: 22px;
      font-weight: bold;
      color: #333;
    }

    .facility-type {
      font-size: 16px;
      color: #555;
      margin: 5px 0;
    }

    .sub-info {
      font-size: 14px;
      color: #777;
      margin-bottom: 10px;
    }

    /* 기본 정보 테이블 */
    .info-table {
      margin-top: 20px;
    }

    /* 목록으로 돌아가기 버튼 */
    .back-button {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 15px;
      background-color: #62D491;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      text-align: center;
    }

    .back-button:hover {
      background-color: #4db67d;
    }

    /* 지도 */
    #map {
      width: 100%;
      height: 400px;
      margin-top: 1rem;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* 주변 보관소 테이블 */
    .nearby-table {
      margin-top: 20px;
      width: 100%;
      border-collapse: collapse;
    }

    .nearby-table th, .nearby-table td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .nearby-table th {
      background-color: #f0f0f0;
    }

    .nearby-table tr:hover {
      background-color: #f9f9f9;
    }

    /* 광고 배너 */
    .ad-banner {
      display: block;
      margin: 20px auto;
      text-align: center;
    }

    /* 반응형 */
    @media (max-width: 768px) {
      .facility-name {
        font-size: 18px;
      }

      .facility-type {
        font-size: 14px;
      }

      .info-table th, .info-table td {
        font-size: 14px;
        padding: 8px;
      }

      .nearby-table th, .nearby-table td {
        font-size: 14px;
        padding: 8px;
      }
    }
/* 메인 컨텐츠 영역 */
main {
  width: 70%;            /* 너비 70% */
  margin: 0 auto;        /* 가운데 정렬 */
  padding: 20px;
  background-color: #fff; /* 배경색을 흰색으로 */
  border-radius: 8px;     /* 테두리 둥글게 */
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* 약간의 그림자 추가 */
}

/* 반응형 디자인: 화면이 작을 때 100%로 변경 */
@media (max-width: 768px) {
  main {
    width: 100%;       /* 화면 크기가 작은 경우, 100%로 */
    padding: 15px;     /* 여백 조금 줄이기 */
  }
}

  </style>
<body>
  <?php include APPPATH . 'Views/includes/header.php'; ?>
  
  <!-- 광고 배너 (애드센스 예시) -->
  <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6686738239613464" data-ad-slot="1204098626" data-ad-format="auto" data-full-width-responsive="true"></ins>
  <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
  </script>

  <!-- Hero Section -->
  <section class="hero-section">
    <h1>💡 누구나 쉽게 접근 가능한 편리한 견인차 보관소</h1>
    <p>
      원하는 차량을 빠르게 찾아보세요.
    </p>
  </section>

  <!-- 본문 메인 -->
  <main>
    <!-- (1) 견인차 보관소 상세 Section -->
    <section class="detail-section">
      <div class="detail-card">
        <div class="detail-header">
          <div class="facility-name"><?= esc($storage['towed_vehicle_storage_name']); ?></div>
          <div class="facility-type"><?= esc($storage['management_organization_name']); ?> 관리 보관소</div>
          <div class="sub-info">📍 <?= esc($storage['address_road_name']); ?></div>
        </div>

        <h3 class="section-title">보관소 기본 정보</h3>
        <table class="info-table">
          <tr>
            <th>보관소명</th>
            <td><?= esc($storage['towed_vehicle_storage_name']); ?></td>
          </tr>
          <tr>
            <th>도로명 주소</th>
            <td><?= esc($storage['address_road_name']); ?></td>
          </tr>
          <tr>
            <th>전화번호</th>
            <td><?= esc($storage['storage_facility_phone_number']); ?></td>
          </tr>
          <tr>
            <th>보관 가능 차량 수</th>
            <td><?= esc($storage['number_of_vehicles_that_can_be_stored']); ?></td>
          </tr>
          <tr>
            <th>기본 견인 요금</th>
            <td><?= esc($storage['basic_tow_fee']); ?></td>
          </tr>
          <tr>
            <th>보관 요금</th>
            <td><?= esc($storage['storage_fee']); ?></td>
          </tr>
          <tr>
            <th>관리 조직</th>
            <td><?= esc($storage['management_organization_name']); ?></td>
          </tr>
        </table>

        <!-- 목록으로 돌아가기 버튼 -->
        <a href="<?= site_url('/towed-vehicle-storage') ?>" class="back-button">
          목록으로 돌아가기
        </a>

        <!-- 지도 -->
        <div id="map"></div>
      </div>
    </section>

    <!-- (2) 주변 보관소 Section -->
    <section class="nearby-section">
      <h3 class="section-title">1km 이내 견인차 보관소</h3>
      <table class="nearby-table">
        <thead>
          <tr>
            <th>보관소명</th>
            <th>주소</th>
            <th>전화번호</th>
            <th>거리 (km)</th>
          </tr>
        </thead>
        <tbody>
        <?php if (empty($nearby_storages)) : ?>
          <tr>
            <td colspan="4">근처 보관소 정보가 없습니다.</td>
          </tr>
        <?php else : 
          $limitStorages = array_slice($nearby_storages, 0, 5);
          foreach ($limitStorages as $storage) : ?>
            <tr onclick="window.location.href='/towed-vehicle-storage/detail/<?= esc($storage['id']); ?>'">
              <td><?= esc($storage['towed_vehicle_storage_name']); ?></td>
              <td><?= esc($storage['address_road_name']); ?></td>
              <td><?= esc($storage['storage_facility_phone_number']); ?></td>
              <td><?= round($storage['distance'], 1); ?> km</td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
      </table>
    </section>
    <?= view_cell('\App\Cells\ExtraInfoCell::render') ?>
  </main>

  <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6686738239613464" data-ad-slot="1204098626" data-ad-format="auto" data-full-width-responsive="true"></ins>
  <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
  </script>

  <script>
    // 지도 초기화
    (function() {
      var lat = parseFloat("<?= esc($storage['latitude']); ?>");
      var lng = parseFloat("<?= esc($storage['longitude']); ?>");
      var name = "<?= esc($storage['towed_vehicle_storage_name']); ?>";

      var map = new naver.maps.Map('map', {
        center: new naver.maps.LatLng(lat, lng),
        zoom: 16
      });

      var mainMarker = new naver.maps.Marker({
        position: new naver.maps.LatLng(lat, lng),
        map: map,
        title: name
      });

      // 주변 정비소(5개)
      var nearbyStorages = <?php echo json_encode(array_slice($nearby_storages ?? [], 0, 5)); ?>;
      nearbyStorages.forEach(function(storage) {
        var marker = new naver.maps.Marker({
          position: new naver.maps.LatLng(storage.latitude, storage.longitude),
          map: map,
          title: storage.towed_vehicle_storage_name
        });
        var infoWindow = new naver.maps.InfoWindow({
          content: '<div style="padding:10px; font-size:14px;"><b>' + storage.towed_vehicle_storage_name + '</b><br>' +
                   '주소: ' + storage.address_road_name + '<br>' +
                   '전화: ' + storage.storage_facility_phone_number + '</div>'
        });
        naver.maps.Event.addListener(marker, 'click', function() {
          infoWindow.open(map, marker);
        });
      });
    })();
  </script>

  <?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
