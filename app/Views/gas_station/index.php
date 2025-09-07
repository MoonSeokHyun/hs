<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Hub - 주유소 정보 및 리뷰</title>
    <meta name="description" content="Car Hub에서 최신 주유소 정보와 사용자 리뷰를 확인하세요. 주유소 위치, 리뷰, 평균 평점을 제공하여 쉽게 원하는 주유소를 찾을 수 있습니다.">
    <meta name="keywords" content="주유소, Car Hub, 주유소 리뷰, 주유소 위치, 주유소 평점, 서울 주유소">
    <!-- 네이버맵 API 주석 처리
    <script async src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
    -->
<!-- 구글 애드센스 -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
crossorigin="anonymous"></script>
    <!-- 스타일 변경 -->
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

        /* (2) 최근 주유소 슬라이드 */
        .recent-slides {
          display: flex;
          gap: 10px;
          overflow-x: hidden; /* 스크롤바 숨기기 */
          padding: 10px 0;
          transition: transform 0.5s ease;
        }

        .recent-slide {
          flex: 0 0 300px;
          background: #f8f9fa;
          padding: 15px;
          border-radius: 8px;
          box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
          transition: transform 0.3s;
        }

        .recent-slide:hover {
          transform: translateY(-5px);
          box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .recent-slide h3 {
          font-size: 1.2rem;
          margin: 0 0 10px;
        }

        .recent-slide p {
          margin: 0;
          color: #555;
          font-size: 0.9rem;
        }

        /* 페이지 네비게이션 */
        .pager {
          margin-top: 20px;
          text-align: center;
        }


  </style>
</head>
<body>

<?php
    include APPPATH . 'Views/includes/header.php';
  ?>
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
        <div class="search-box">
            <form action="<?= base_url('gas_stations/search'); ?>" method="get">
                <input type="text" name="search" placeholder="주유소 이름 검색..." required>
                <button type="submit">검색</button>
            </form>
        </div>

        <section class="section">
            <h2>최근 추가된 주유소</h2>
            <div class="recent-slides" id="recentSlides">
                <?php foreach ($recentGasStations as $station): ?>
                    <div class="recent-slide">
                        <h3><?= esc($station['gas_station_name']); ?></h3>
                        <p><?= esc($station['road_address']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>


        <section class="section">
            <h2>인기 주유소</h2>
            <table>
                <thead>
                    <tr>
                        <th>주유소 이름</th>
                        <th>주소</th>
                        <th>리뷰 개수</th>
                        <th>평균 평점</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($popularGasStations as $station): ?>
                        <tr class="clickable-row" onclick="goToDetail(<?= $station['id']; ?>)">
                            <td><?= esc($station['gas_station_name']); ?></td>
                            <td><?= esc($station['road_address']); ?></td>
                            <td><?= esc($station['review_count']); ?></td>
                            <td><?= number_format($station['average_rating'], 1); ?> 점</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

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

        <section class="reviews">
            <h2>최근 리뷰</h2>
            <?php foreach ($recentReviews as $review): ?>
                <div class="review-card" onclick="goToDetail(<?= isset($review['gas_station_id']) ? esc($review['gas_station_id']) : '0'; ?>)">
                    <div class="review-title"> <?= isset($review['gas_station_name']) ? esc($review['gas_station_name']) : '정보 없음'; ?> -
                        <span class="review-rating"> <?= isset($review['rating']) ? esc($review['rating']) : '0'; ?>점</span>
                    </div>
                    <div class="review-text"> <?= isset($review['comment_text']) ? esc($review['comment_text']) : '리뷰 없음'; ?> </div>
                    <small> 작성일: <?= isset($review['created_at']) ? date('Y-m-d', strtotime($review['created_at'])) : '알 수 없음'; ?> </small>
                </div>
            <?php endforeach; ?>
        </section>

        <section class="section">
            <h2>주유소 목록</h2>
            <table>
                <thead>
                    <tr>
                        <th>주유소 이름</th>
                        <th>주소</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gasStations as $station): ?>
                        <tr class="clickable-row" onclick="goToDetail(<?= $station['id']; ?>)">
                            <td><?= esc($station['gas_station_name']); ?></td>
                            <td><?= esc($station['road_address']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

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

    <script>
        function goToDetail(id) {
            if (id) {
                window.location.href = '/gas_stations/' + id;
            }
        }
    </script>

</body>
</html>
