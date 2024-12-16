<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Hub - 주유소 정보 및 리뷰</title>
    <meta name="description" content="Car Hub에서 최신 주유소 정보와 사용자 리뷰를 확인하세요. 주유소 위치, 리뷰, 평균 평점을 제공하여 쉽게 원하는 주유소를 찾을 수 있습니다.">
    <meta name="keywords" content="주유소, Car Hub, 주유소 리뷰, 주유소 위치, 주유소 평점, 서울 주유소">

    <!-- 스타일 변경 -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background: linear-gradient(90deg, #28a745, #007bff);
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
            font-size: 2.5em;
        }

        nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 20px 0 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #ffc107;
        }

        .search-box {
            margin: 20px 0;
            text-align: center;
        }

        .search-box input {
            padding: 12px;
            width: 70%;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-box button {
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        .search-box button:hover {
            background-color: #0056b3;
        }

        .section {
            margin-bottom: 40px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            font-size: 1.8rem;
            color: #007bff;
            margin-bottom: 20px;
        }

        .recent-slides {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding: 10px 0;
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

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #007bff;
            color: white;
        }

        .clickable-row {
            cursor: pointer;
            transition: background 0.3s;
        }

        .clickable-row:hover {
            background: #f1f1f1;
        }

        .reviews {
            margin-top: 20px;
        }

        .review-card {
            background: #f9f9f9;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .review-card:hover {
            background: #f1f1f1;
        }

        .review-title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #007bff;
        }

        .review-text {
            font-size: 0.9rem;
            color: #555;
        }

        .review-rating {
            color: #ffc107;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 0.9rem;
            background: #f8f9fa;
            border-top: 1px solid #ddd;
            color: #333;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .menu-bar {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            gap: 15px;
            flex-wrap: wrap;
        }

        .menu-bar a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 1.1em;
            font-weight: bold;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .menu-bar a:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .menu-parking { background-color: #007bff; }
        .menu-gas-stations { background-color: #28a745; }
        .menu-repair-shops { background-color: #e74c3c; }

        @media (max-width: 768px) {
            .menu-bar {
                flex-wrap: wrap;
                gap: 10px;
            }

            .menu-bar a {
                font-size: 0.9em;
                padding: 8px 15px;
            }
        }

    </style>
</head>
<body>
        <h1>Car Hub</h1>



    <div class="menu-bar">
            <a href="/parking" class="menu-parking">주차장</a>
            <a href="/gas_stations" class="menu-gas-stations">주유소</a>
            <a href="/automobile_repair_shops" class="menu-repair-shops">정비소</a>
        </div>

    <div class="container">
        <div class="search-box">
            <form action="<?= base_url('gas_stations/search'); ?>" method="get">
                <input type="text" name="search" placeholder="주유소 이름 검색..." required>
                <button type="submit">검색</button>
            </form>
        </div>

        <section class="section">
            <h2>최근 추가된 주유소</h2>
            <div class="recent-slides">
                <?php foreach ($recentGasStations as $station): ?>
                    <div class="recent-slide" onclick="goToDetail(<?= $station['id']; ?>)">
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

        <div class="pager">
            <?= $pager->links('gasStationsGroup', 'default_full') ?>
        </div>
    </div>

    <footer class="footer">
        <p>본 데이터는 <a href="https://www.data.go.kr" target="_blank">www.data.go.kr</a>에서 데이터 기반으로 만들어진 웹 사이트입니다.</p>
        <p>이 웹 사이트는 영리 목적으로 만들어졌습니다.</p>
        <p>잘못된 정보는 <a href="mailto:gjqmaoslwj@naver.com">gjqmaoslwj@naver.com</a>으로 문의해 주세요.</p>
    </footer>

    <script>
        function goToDetail(id) {
            if (id) {
                window.location.href = '/gas_stations/' + id;
            }
        }
    </script>
</body>
</html>
