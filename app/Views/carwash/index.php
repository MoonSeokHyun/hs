<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="vTa0kwUBtDAIFY_RbTOw4p-LpneLpkhxTYAWYqNwAog" />
    <meta name="naver-site-verification" content="7a0d49f3fd680b5f4ab77f8edfd3deb13ee30f11" />
    <title>편잇 - 주차장, 정비소, 주유소 정보</title>

    <meta name="description" content="Car Hub에서 최신 세차장 정보와 인기 세차장 정보를 확인하세요. 사용자 리뷰와 평점을 통해 신뢰도 높은 차량 관리 서비스를 제공합니다.">
    <meta name="keywords" content="세차장, 차량 관리, 리뷰, 평점">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Car Hub">

    <!-- Google Ads Script -->
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

        .menu-cu { background-color: #6c757d; }
        .menu-all { background-color: #28a745; }
        .menu-gs25 { background-color: #007bff; }
        .menu-seven { background-color: #e74c3c; }
        .menu-emart { background-color: #f1c40f; color: #333; }
        .menu-cspace { background-color: #e67e22; }
        .menu-recipe { background-color: #FFA07A; } /* 살몬 핑크 */
        .menu-event { background-color: #FF4500; } /* 오렌지 레드 */
        .menu-parking { background-color: #8A2BE2; } /* 오렌지 레드 */
        .menu-accommodation { background-color: #17a2b8; }
        .menu-festival { background-color: #17e2b8; }
        .menu-carwash { background-color: #ff8c00; } /* 세차장 색상 (주황색) */

   
        .menu-carwash { background-color: #00bfff; }

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
    </style>
</head>
<body>
    <div class="container">
        <h1>세차장 메뉴</h1>

        <!-- 메뉴 바 -->
        <div class="menu-bar">
        <a href="/events" class="menu-all">전체</a>
        <a href="/events/cu" class="menu-cu">CU</a>
        <a href="/events/gs25" class="menu-gs25">GS25</a>
        <a href="/events/7-ELEVEn" class="menu-seven">세븐일레븐</a>
        <a href="/events/emart24" class="menu-emart">이마트24</a>
        <a href="/recipes" class="menu-recipe">레시피</a>
        <a href="/event" class="menu-event">이벤트</a>
        <a href="/parking" class="menu-parking">카허브</a>
        <a href="/hotel" class="menu-accommodation">숙박</a>
        <a href="/carwash" class="menu-carwash">세차장</a> <!-- 세차장 메뉴 추가 -->
    </div>

        <!-- 섹션 1: 최근 추가된 세차장 -->
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
                                <td><?= esc($carwash['Business Name']) ?></td> <!-- 'Business Name'으로 수정 -->
                                <td><?= esc($carwash['Address (Road Name)']) ?>, <?= esc($carwash['City/District']) ?></td>
                                <td><?= esc($carwash['Data Reference Date']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 섹션 2: 인기 세차장 -->
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
                                <td><?= esc($carwash['Business Name']) ?></td> <!-- 'Business Name'으로 수정 -->
                                <td>150</td> <!-- 예시로 리뷰 수 표시 -->
                                <td>4.8</td> <!-- 예시로 평점 표시 -->
                                <td><?= esc($carwash['Car Wash Phone Number']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 페이지 하단 -->
        <div class="footer">
            본 데이터는 <a href="https://www.data.go.kr" target="_blank">www.data.go.kr</a>에서 제공한 자료를 기반으로 하였습니다.<br>
            이 웹 사이트는 영리 목적으로 만들어졌습니다.<br>
            잘못된 정보는 <a href="mailto:gjqmaoslwj@naver.com">gjqmaoslwj@naver.com</a>으로 문의해 주세요.
        </div>
    </div>

    <?php
    $hostname = $_SERVER['HTTP_HOST'];

    if (!preg_match('/^localhost(:[0-9]*)?$/', $hostname)) {
    ?>
        <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
        <script type="text/javascript">
            if(!wcs_add) var wcs_add = {};
            wcs_add["wa"] = "8adec19974bed8";
            if(window.wcs) {
                wcs_do();
            }
        </script>
    <?php }
    ?>
</body>
</html>
