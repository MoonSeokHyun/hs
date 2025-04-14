<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>호텔 리스트 - 편잇</title>
  <script async src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
<!-- 구글 애드센스 -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
crossorigin="anonymous"></script>
  <style>
    /* 기본 초기화 */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    html, body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      color: #333;
    }
    /* 메인 콘텐츠 영역 */
    main {
      max-width: 1200px;
      margin: 20px auto;
      padding: 30px;
    }
    /* 검색 바 */
    .search-bar {
      text-align: center;
      margin-bottom: 30px;
    }
    .search-bar input[type="text"] {
      width: 300px;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 1em;
    }
    .search-bar button {
      padding: 10px 20px;
      background-color: #62D491;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1em;
      cursor: pointer;
      margin-left: 10px;
    }
    .search-bar button:hover { background-color: #3eaf7c; }
    /* 최근 추가된 호텔 */
    .recent-hotels {
      margin-bottom: 40px;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .recent-hotels h2 {
      color: #62D491;
      font-size: 1.8em;
      margin-bottom: 20px;
      text-align: center;
    }
    .recent-hotels ul { list-style: none; padding: 0; }
    .recent-hotels li {
      padding: 12px;
      border-bottom: 1px solid #eee;
      transition: background-color 0.2s;
    }
    .recent-hotels li:hover { background-color: #f9f9f9; }
    .recent-hotels a {
      color: #333;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.2s;
    }
    .recent-hotels a:hover { color: #62D491; }
    /* 호텔 카드 스타일 */
    .card-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }
    .hotel-card {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      transition: transform 0.3s, box-shadow 0.3s;
      text-align: center;
    }
    .hotel-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .hotel-card h3 {
      font-size: 1.6em;
      color: #62D491;
      margin-bottom: 10px;
    }
    .hotel-card p {
      font-size: 1em;
      margin: 8px 0;
      color: #555;
    }
    .hotel-card a {
      display: inline-block;
      margin-top: 15px;
      padding: 10px 18px;
      background-color: #62D491;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    .hotel-card a:hover { background-color: #3eaf7c; }
    /* 리스트 제목 */
    h2.page-title {
      text-align: center;
      color: #62D491;
      margin-bottom: 20px;
    }
    /* Pagination */
    .pagination {
      text-align: center;
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <!-- 헤더는 헤더 파일에서 동일한 스타일로 적용됨 -->
  <?php include APPPATH . 'Views/includes/header.php'; ?>
  <main>
    <div class="search-bar">
      <form action="/hotel" method="get">
        <input type="text" name="query" placeholder="검색어를 입력하세요" value="<?= esc($query ?? '') ?>">
        <button type="submit">검색</button>
      </form>
    </div>

    <div class="recent-hotels">
      <h2>최근 추가된 호텔</h2>
      <ul>
        <?php foreach ($recentHotels as $recent): ?>
          <li>
            <a href="/hotel/detail/<?= esc($recent['id']) ?>">
              <?= esc($recent['business_name']) ?> (<?= esc($recent['site_full_address']) ?>)
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <h2 class="page-title">호텔 리스트</h2>
    <div class="card-container">
      <?php foreach ($hotels as $hotel): ?>
        <div class="hotel-card">
          <div class="hotel-card-content">
            <h3><?= esc($hotel['business_name']) ?></h3>
            <p><?= esc($hotel['site_full_address']) ?></p>
            <p>연락처: <?= esc($hotel['contact_number'] ?? '정보 없음') ?></p>
            <a href="/hotel/detail/<?= esc($hotel['id']) ?>">자세히 보기</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>


  </main>

  <?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
