<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="google-site-verification" content="vTa0kwUBtDAIFY_RbTOw4p-LpneLpkhxTYAWYqNwAog" />
  <meta name="naver-site-verification" content="7a0d49f3fd680b5f4ab77f8edfd3deb13ee30f11" />
  <title>Car Hub - 정비소, 주유소, 주차장 정보</title>
  <meta name="description" content="Car Hub에서 최신 주차장 정보와 인기 정비소, 주유소 정보를 확인하세요. 사용자 리뷰와 평점을 통해 신뢰도 높은 차량 관리 서비스를 제공합니다.">
  <meta name="keywords" content="정비소, 주유소, 주차장, 차량 관리, 리뷰, 평점">
  <meta name="robots" content="index, follow">
  <meta name="author" content="Car Hub">
  <!-- 네이버맵 API 주석 처리
  <script async src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
  -->
<!-- 구글 애드센스 -->

  <link rel="stylesheet" href="/assets/css/global.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      color: #333;
    }

    .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 20px;
    }

    .page-title {
      font-size: 2em;
      color: var(--main-color, #62D491);
      text-align: center;
      margin-bottom: 20px;
    }

    .menu-bar {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 12px;
      margin-bottom: 20px;
    }

    .menu-bar a {
      padding: 10px 20px;
      background-color: #62D491;
      color: #fff;
      text-decoration: none;
      border-radius: 20px;
      font-weight: bold;
      transition: all 0.2s ease-in-out;
    }

    .menu-bar a:hover {
      background-color: #3eaf7c;
    }

    .search-box {
      text-align: center;
      margin-bottom: 30px;
    }

    .search-box input {
      padding: 10px;
      width: 70%;
      max-width: 400px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .search-box button {
      padding: 10px 20px;
      margin-left: 5px;
      border: none;
      background-color: #3eaf7c;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }

    .section {
      margin-bottom: 40px;
    }

    .section h2 {
      font-size: 1.5rem;
      margin-bottom: 10px;
      color: var(--point-color, #3eaf7c);
      border-left: 4px solid var(--point-color, #3eaf7c);
      padding-left: 10px;
    }

    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    th, td {
      padding: 12px 10px;
      text-align: center;
      border-bottom: 1px solid #eee;
      font-size: 14px;
    }

    th {
      background-color: #62D491;
      color: white;
    }

    .clickable-row {
      cursor: pointer;
    }

    .clickable-row:hover {
      background-color: #f9f9f9;
    }

    .review-card {
      background: #fff;
      border: 1px solid #eee;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 15px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .review-title {
      font-weight: bold;
      font-size: 1rem;
      color: #3eaf7c;
      margin-bottom: 5px;
    }

    .review-rating {
      color: #ff9800;
    }

    .review-text {
      font-size: 0.95rem;
      color: #444;
      margin-bottom: 5px;
    }

    footer {
      background-color: #f1f1f1;
      text-align: center;
      padding: 20px;
      font-size: 0.9em;
      border-top: 1px solid #ddd;
      margin-top: 40px;
    }

    footer a {
      color: #007bff;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
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

      .search-box input,
      .search-box button {
        width: 90%;
        margin-top: 5px;
      }

      th, td {
        font-size: 13px;
        padding: 10px 5px;
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
  <main class="container">

    <div class="search-box">
      <form action="/automobile_repair_shops" method="get">
        <input type="text" name="search" placeholder="정비소 이름 또는 주소 검색">
        <button type="submit">검색</button>
      </form>
    </div>

    <section class="section">
      <h2>최근 추가된 정비소</h2>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>정비소명</th>
              <th>주소</th>
              <th>추가일</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recentRepairShops as $shop): ?>
              <tr class="clickable-row" onclick="window.location.href='/automobile_repair_shop/<?= esc($shop['id']) ?>'">
                <td><?= esc($shop['repair_shop_name']) ?></td>
                <td><?= esc($shop['road_address']) ?></td>
                <td><?= date('Y-m-d') ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>

    <section class="section">
      <h2>인기 정비소</h2>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>정비소명</th>
              <th>정비소 종류</th>
              <th>주소</th>
              <th>전화번호</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($repair_shops)): ?>
              <?php foreach ($repair_shops as $shop): ?>
                <tr class="clickable-row" onclick="window.location.href='/automobile_repair_shop/<?= esc($shop['id']) ?>'">
                  <td><?= esc($shop['repair_shop_name']) ?></td>
                  <td><?= esc($shop['repair_shop_type']) ?>급</td>
                  <td><?= esc($shop['road_address']) ?></td>
                  <td><?= esc($shop['phone_number']) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="4">등록된 정비소가 없습니다.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </section>

    <section class="section">
      <h2>최근 추가된 리뷰</h2>
      <?php foreach ($recentReviews as $review): ?>
        <div class="review-card clickable-row" onclick="window.location.href='/automobile_repair_shop/<?= esc($review['repair_shop_id']) ?>'">
          <div class="review-title">
            <?= esc($review['repair_shop_name']) ?> - <span class="review-rating"><?= esc($review['rating']) ?>점</span>
          </div>
          <div class="review-text"><?= esc($review['comment_text']) ?></div>
          <small>작성일: <?= date('Y-m-d', strtotime($review['created_at'])) ?></small>
        </div>
      <?php endforeach; ?>
    </section>
  </main>

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
