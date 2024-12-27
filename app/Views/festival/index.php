<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
    <title>편의점 이벤트 - 편잇</title>
    <style>
        /* 기본 스타일 리셋 */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
            font-size: 2.5em;
            font-weight: 600;
        }

        /* 메뉴바 */
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
            padding: 12px 25px;
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

        /* 각 메뉴 스타일 */
        .menu-cu { background-color: #6c757d; }
        .menu-all { background-color: #28a745; }
        .menu-gs25 { background-color: #007bff; }
        .menu-seven { background-color: #e74c3c; }
        .menu-emart { background-color: #f1c40f; color: #333; }
        .menu-cspace { background-color: #e67e22; }
        .menu-recipe { background-color: #FFA07A; }
        .menu-event { background-color: #FF4500; }
        .menu-parking { background-color: #8A2BE2; }
        .menu-accommodation { background-color: #17a2b8; }
        .menu-festival { background-color: #17e2b8; }

        /* 카드 컨테이너 */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        /* 카드 스타일 */
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            flex: 0 0 calc(33.333% - 20px);
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-img-top img {
            height: 200px;
            object-fit: cover;
            width: 100%;
            border-bottom: 2px solid #ddd;
        }

        .card-body {
            padding: 15px;
            background-color: #fff;
        }

        .card-title {
            font-size: 1.3em;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1em;
            color: #555;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        /* 상태 스타일 */
        .status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            margin-top: 10px;
            display: inline-block;
        }

        .status-ongoing {
            background-color: #28a745;
            color: white;
        }

        .status-ended {
            background-color: #e74c3c;
            color: white;
        }

        /* 페이징 스타일 */
        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .pagination a {
            text-decoration: none;
            margin: 0 5px;
            padding: 8px 16px;
            border: 1px solid #ddd;
            color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .pagination a:hover {
            background-color: #007bff;
            color: white;
        }

        .pagination .active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        /* 모바일 최적화 */
        @media (max-width: 768px) {
            .menu-bar a {
                font-size: 1em;
                padding: 10px 20px;
            }

            .card {
                flex: 0 0 100%;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .card {
                flex: 0 0 calc(50% - 20px);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>각종 공연 및 행사 정보는 편잇!</h1>

        <!-- Floating menu bar -->
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
            <a href="/festival-info" class="menu-festival">행사/공연</a>
        </div>

        <!-- 이벤트 카드 -->
        <div class="card-container">
            <?php
            function fetchPixabayImage($query) {
                $apiKey = '47860392-10aec8c46b9a9243d45daefcf';
                $query = urlencode($query);
                $url = "https://pixabay.com/api/?key=$apiKey&q=$query&image_type=photo";

                $response = file_get_contents($url);
                $data = json_decode($response, true);

                if (!empty($data['hits'][0]['webformatURL'])) {
                    return $data['hits'][0]['webformatURL'];
                }
                return 'https://via.placeholder.com/300x200';
            }
            ?>

            <?php if (!empty($festivals)): ?>
                <?php foreach (array_slice($festivals, 0, 9) as $festival): ?>
                    <?php $imageUrl = fetchPixabayImage($festival['Festival_Name']); ?>
                    <a href="/festival-info/<?= esc($festival['id']) ?>" class="card-link">
                        <div class="card">
                            <div class="card-img-top">
                                <img src="<?= $imageUrl ?>" alt="<?= esc($festival['Festival_Name']) ?>">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($festival['Festival_Name']) ?></h5>
                                <p class="card-text">
                                    <strong>기간:</strong> <?= esc($festival['Start_Date']) ?> ~ <?= esc($festival['End_Date']) ?><br>
                                    <strong>장소:</strong> <?= esc($festival['Venue']) ?><br>
                                    <strong>주최 기관:</strong> <?= esc($festival['Organizing_Agency']) ?><br>
                                    <strong>웹사이트:</strong> <a href="<?= esc($festival['Website_URL']) ?>" target="_blank"><?= esc($festival['Website_URL']) ?></a><br>
                                </p>
                                <span class="status status-ongoing">진행 중</span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>현재 이벤트가 없습니다.</p>
            <?php endif; ?>
        </div>

        <!-- 페이징 -->
        <?= $pager->links() ?>
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
