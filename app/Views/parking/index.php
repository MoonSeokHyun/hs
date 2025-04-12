<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>편잇 - 주차장, 정비소, 주유소 정보</title>
  <meta name="description" content="Car Hub에서 최신 주차장, 정비소, 주유소 정보를 확인하세요. 사용자 리뷰와 평점을 통해 신뢰도 높은 차량 관리 서비스를 제공합니다.">
  <meta name="keywords" content="주차장, 정비소, 주유소, 차량 관리, 리뷰, 평점">
  <meta name="robots" content="index, follow">
  <meta name="author" content="Car Hub">
  <link rel="stylesheet" href="/assets/css/global.css">
  <style>
    :root {
      --main-color: #62D491;
      --point-color: #3eaf7c;
      --card-bg: #fff;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f7f8fa;
      color: #333;
    }
    main.container {
      max-width: 1000px;
      margin: auto;
      padding: 2rem 1rem;
    }
    h1 {
      font-size: 2rem;
      text-align: center;
      margin-bottom: 2rem;
    }
    .menu-bar {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 12px;
      margin-bottom: 2rem;
    }
    .menu-bar a {
      background: var(--point-color);
      color: #fff;
      padding: 10px 18px;
      border-radius: 999px;
      font-weight: bold;
      font-size: 1rem;
      text-decoration: none;
      transition: all 0.3s;
    }
    .menu-bar a:hover {
      opacity: 0.85;
      transform: translateY(-3px);
    }
    .section {
      margin-bottom: 2rem;
      background: var(--card-bg);
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .section h2 {
      font-size: 1.5rem;
      color: var(--main-color);
      margin-bottom: 1rem;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.95rem;
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #eee;
      text-align: center;
    }
    th {
      background: #e6f7ff;
      color: var(--point-color);
    }
    .clickable-row:hover {
      background: #f1f1f1;
      cursor: pointer;
    }
    .review-box {
      margin-bottom: 10px;
      padding: 10px;
      background: #f9f9f9;
      border-radius: 5px;
    }
    .footer {
      text-align: center;
      font-size: 0.9rem;
      padding: 2rem 1rem;
      border-top: 1px solid #ddd;
      background: #f1f1f1;
      margin-top: 3rem;
    }
    .footer a {
      color: var(--point-color);
      text-decoration: none;
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

    <div class="section">
      <h2>주차장 검색</h2>
      <form method="get" action="/parking/search">
        <input type="text" name="search" placeholder="주차장 이름 또는 주소" style="width: 70%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        <button type="submit" style="padding: 10px 16px; background: var(--point-color); color: #fff; border: none; border-radius: 5px;">검색</button>
      </form>
    </div>

    <div class="section">
      <h2>최근 추가된 주차장</h2>
      <table>
        <thead>
          <tr><th>주차장명</th><th>주소</th><th>추가일</th></tr>
        </thead>
        <tbody>
          <?php foreach ($recentParkingLots as $lot): ?>
          <tr class="clickable-row" onclick="window.location.href='/parking/detail/<?= esc($lot['id']) ?>'">
            <td><?= esc($lot['name']) ?></td>
            <td><?= esc($lot['address_road']) ?></td>
            <td><?= date('Y-m-d') ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="section">
      <h2>인기 주차장</h2>
      <table>
        <thead>
          <tr><th>주차장명</th><th>리뷰 개수</th><th>평균 포인트</th></tr>
        </thead>
        <tbody>
          <?php foreach ($popularParkingLots as $popularLot): ?>
          <tr class="clickable-row" onclick="window.location.href='/parking/detail/<?= esc($popularLot['id']) ?>'">
            <td><?= esc($popularLot['name']) ?></td>
            <td><?= esc($popularLot['review_count']) ?></td>
            <td><?= number_format($popularLot['average_rating'], 1) ?>점</td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="section">
      <h2>최근 리뷰</h2>
      <?php foreach ($recentReviews as $review): ?>
      <div class="review-box">
        <strong><?= esc($review['parking_lot_name']) ?>:</strong>
        <span style="color: gold;">★ <?= esc($review['rating']) ?>점</span>
        <div><?= esc($review['comment_text']) ?></div>
        <div style="font-size: 0.85rem; color: #666;">작성일: <?= date('Y-m-d', strtotime($review['created_at'])) ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </main>
  <?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>