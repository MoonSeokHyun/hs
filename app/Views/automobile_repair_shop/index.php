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

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>

    <!-- CSS -->
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

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
            font-size: 2.5em;
        }

        /* Floating menu bar styles */
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

        .section {
            margin-bottom: 40px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            font-size: 1.8em;
            color: #007bff;
            margin-bottom: 15px;
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        .clickable-row {
            cursor: pointer;
        }

        .clickable-row:hover {
            background-color: #f0f0f0;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            background-color: #f1f1f1;
            color: #333;
            border-top: 1px solid #ddd;
            font-size: 0.9em;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* 검색창 스타일 */
        .search-box {
            text-align: center;
            margin: 20px 0;
        }

        .search-box input {
            padding: 10px;
            width: 70%;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-box button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-box button:hover {
            background-color: #0056b3;
        }

        /* 지도 스타일 */
        #map {
            width: 100%;
            height: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Car Hub</h1>

        <!-- Floating menu bar -->
        <div class="menu-bar">
            <a href="/parking" class="menu-parking">주차장</a>
            <a href="/gas_stations" class="menu-gas-stations">주유소</a>
            <a href="/automobile_repair_shops" class="menu-repair-shops">정비소</a>
        </div>

        <!-- 검색창 -->
        <div class="search-box">
            <form action="/automobile_repair_shops" method="get">
                <input type="text" id="search" name="search" placeholder="정비소 이름 또는 주소 검색">
                <button type="submit">검색</button>
            </form>
        </div>

        <!-- 지도 -->

        <!-- 섹션 추가 -->
        <div class="section">
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
        </div>

        <!-- 섹션 추가 -->
        <div class="section">
            <h2>인기 정비소</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>정비소명</th>
                            <th>리뷰 수</th>
                            <th>평점</th>
                            <th>전화번호</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($repair_shops)): ?>
                        <?php foreach ($repair_shops as $shop): ?>
                        <tr class="clickable-row" onclick="window.location.href='/automobile_repair_shop/<?= isset($shop['id']) ? esc($shop['id']) : '' ?>'">
                            <td><?= isset($shop['repair_shop_name']) ? esc($shop['repair_shop_name']) : '정보 없음' ?></td>
                            <td><?= isset($shop['repair_shop_type']) ? esc($shop['repair_shop_type']) . '급' : '정보 없음' ?></td>
                            <td><?= isset($shop['road_address']) ? esc($shop['road_address']) : '주소 없음' ?></td>
                            <td><?= isset($shop['phone_number']) ? esc($shop['phone_number']) : '전화번호 없음' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">등록된 정비소가 없습니다.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                </table>
            </div>
        </div>

        <div class="footer">
            본 데이터는 <a href="https://www.data.go.kr" target="_blank">www.data.go.kr</a>에서 제공한 자료를 기반으로 하였습니다.<br>
            이 웹 사이트는 영리 목적으로 만들어졌습니다.<br>
            잘못된 정보는 <a href="mailto:gjqmaoslwj@naver.com">gjqmaoslwj@naver.com</a>으로 문의해 주세요.
        </div>
    </div>

    <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
    <script>
        if (!wcs_add) var wcs_add = {};
        wcs_add["wa"] = "d453c02d83e61";
        if (window.wcs) wcs_do();
    </script>
</body>
</html>
