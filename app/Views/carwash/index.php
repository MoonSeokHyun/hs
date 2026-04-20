<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 세차장 찾기{$pageSuffix} | 셀프·자동·스팀세차 위치/리뷰 | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 세차장 {$currentPage}페이지 - 셀프세차·자동세차·스팀세차장의 위치, 전화번호, 리뷰 정보를 확인하세요."
    : "전국 세차장의 위치, 전화번호, 서비스 종류와 사용자 리뷰를 한눈에 확인하세요. 셀프세차, 자동세차, 스팀세차장 정보까지 비교할 수 있습니다.";
$canonicalBase = base_url('carwash');
$canonical = $currentPage > 1 ? $canonicalBase . '?page=' . $currentPage : $canonicalBase;
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="google-site-verification" content="vTa0kwUBtDAIFY_RbTOw4p-LpneLpkhxTYAWYqNwAog" />
  <meta name="naver-site-verification" content="7a0d49f3fd680b5f4ab77f8edfd3deb13ee30f11" />
  <title><?= esc($pageTitle) ?></title>

  <meta name="description" content="<?= esc($pageDesc) ?>">
  <meta name="keywords" content="세차장, 셀프세차, 자동세차, 스팀세차, 세차장 리뷰, 편잇">
  <meta name="robots" content="<?= !empty($isSearchResult) ? 'noindex, follow' : 'index, follow' ?>">
  <link rel="canonical" href="<?= esc($canonical) ?>">
  <meta property="og:title" content="<?= esc($pageTitle) ?>">
  <meta property="og:description" content="<?= esc($pageDesc) ?>">
  <meta property="og:url" content="<?= esc($canonical) ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="<?= base_url('img/logo.png') ?>">
  <meta name="author" content="편잇">

  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
crossorigin="anonymous"></script>
<!-- 네이버맵 API 주석 처리
<script src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
-->
  <link rel="stylesheet" href="/assets/css/global.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f8f9fa;
      color: #333;
    }

    .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 20px;
    }

    .page-title {
      font-size: 2em;
      text-align: center;
      margin-bottom: 20px;
      color: #62D491;
    }

    .menu-bar {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
      margin-bottom: 30px;
    }

    .menu-bar a {
      padding: 8px 15px;
      border-radius: 20px;
      font-size: 14px;
      text-decoration: none;
      color: white;
      font-weight: bold;
    }

    .menu-all { background: #28a745; }
    .menu-cu { background: #6c757d; }
    .menu-gs25 { background: #007bff; }
    .menu-seven { background: #e74c3c; }
    .menu-emart { background: #f1c40f; color: #333; }
    .menu-recipe { background: #FFA07A; }
    .menu-event { background: #FF4500; }
    .menu-parking { background: #8A2BE2; }
    .menu-accommodation { background: #17a2b8; }
    .menu-carwash { background: #00bfff; }

    .section {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 40px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .section h2 {
      font-size: 20px;
      color: #3eaf7c;
      margin-bottom: 16px;
    }

    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    th {
      background: #62D491;
      color: white;
    }

    .clickable-row {
      cursor: pointer;
    }

    .clickable-row:hover {
      background-color: #f1f1f1;
    }

    .footer {
      text-align: center;
      padding: 20px;
      font-size: 0.9em;
      color: #666;
      background: #f1f1f1;
      border-top: 1px solid #ccc;
    }

    @media (max-width: 768px) {
      .page-title {
        font-size: 1.5em;
      }
      .menu-bar {
        flex-direction: column;
        align-items: center;
      }
      .menu-bar a {
        width: 90%;
        text-align: center;
      }
    }
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
    <div class="section">
      <h2>최근 추가된 세차장</h2>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>세차장명</th>
              <th>주소</th>
              <th>추가일</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recentCarWashes as $carwash): ?>
            <tr class="clickable-row" onclick="window.location.href='/carwash/details/<?= esc($carwash['ID']) ?>'">
              <td><?= esc($carwash['Business Name']) ?></td>
              <td><?= esc($carwash['Address (Road Name)']) ?>, <?= esc($carwash['City/District']) ?></td>
              <td><?= esc($carwash['Data Reference Date']) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="section">
      <h2>인기 세차장</h2>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>세차장명</th>
              <th>리뷰 수</th>
              <th>평점</th>
              <th>전화번호</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($popularCarWashes as $carwash): ?>
            <tr class="clickable-row" onclick="window.location.href='/carwash/details/<?= esc($carwash['ID']) ?>'">
              <td><?= esc($carwash['Business Name']) ?></td>
              <td>150</td>
              <td>4.8</td>
              <td><?= esc($carwash['Car Wash Phone Number']) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- 중간 광고 배치 -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

    <!-- 하단 광고 배치 -->
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
<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
