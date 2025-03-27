<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= esc($hotel['business_name']); ?>의 상세 정보 및 근처 맛집과 관광지">
    <meta name="keywords" content="호텔, 관광지, 맛집, <?= esc($hotel['business_name']); ?>, 숙박 정보">
    <meta name="robots" content="index, follow">
    <meta name="author" content="호텔허브">
    <meta property="og:title" content="<?= esc($hotel['business_name']); ?> - 호텔허브">
    <meta property="og:description" content="<?= esc($hotel['business_name']); ?>의 상세 정보와 근처 맛집 및 관광지를 확인하세요.">
    <meta property="og:image" content="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAATgAAAChCAMAAABkv1NnAAAA">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:type" content="website">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
    <!-- Naver 지도 API -->
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
    <title><?= esc($hotel['business_name']); ?> - 호텔허브</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
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

        .detail-container {
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 1.5em;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            margin-top: 20px;
            margin-bottom: 15px;
        }

        .card-slider {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding: 10px;
        }

        .card {
            flex: 0 0 auto;
            width: 200px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            padding: 15px;
        }

        .card img {
            width: 100%;
            height: 120px;
            border-radius: 5px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .card h3 {
            font-size: 1.2em;
            margin-bottom: 5px;
            color: #007bff;
        }

        .card p {
            font-size: 0.9em;
            margin: 3px 0;
            color: #555;
        }

        .map-container {
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #map {
            width: 100%;
            height: 400px;
        }


        .menu-all { background-color: #28a745; } /* 초록색 */
        .menu-cu { background-color: #6c757d; } /* 회색 */
        .menu-gs25 { background-color: #007bff; } /* 파란색 */
        .menu-seven { background-color: #e74c3c; } /* 빨간색 */
        .menu-emart { background-color: #f1c40f; color: #333; } /* 노란색 */
        .menu-recipe { background-color: #FFA07A; } /* 살몬 핑크 */
        .menu-event { background-color: #FF4500; } /* 오렌지 레드 */
        .menu-parking { background-color: #8A2BE2; } /* 보라색 */
        .menu-accommodation { background-color: #17a2b8; } /* 청록색 */
        .menu-festival { background-color: #17e2b8; }

    </style>
</head>
<body>
    <div class="container">
        <h1><?= esc($hotel['business_name']); ?></h1>

        <!-- 메뉴바 -->
        <div class="menu-bar">
            <a href="/events" class="menu-all">전체</a>
            <a href="/events/cu" class="menu-cu">CU</a>
            <a href="/events/gs25" class="menu-gs25">GS25</a>
            <a href="/events/7-ELEVEn" class="menu-seven">세븐일레븐</a>
            <a href="/events/emart24" class="menu-emart">이마트24</a>
            <a href="/parking" class="menu-parking">카허브</a>
            <a href="/accommodation" class="menu-accommodation">숙박</a>
        </div>

        <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
        <!-- 호텔 정보 -->
        <div class="detail-container">
            <h2 class="section-title">호텔 정보</h2>
            <p><strong>주소:</strong> <?= esc($hotel['site_full_address']); ?></p>
            <p><strong>연락처:</strong> <?= esc($hotel['contact_number']); ?></p>
            <p><strong>체크인 시간:</strong> 15:00</p>
            <p><strong>체크아웃 시간:</strong> 11:00</p>
            <p><strong>객실 정보:</strong> 한실 <?= esc($hotel['han_room_count'] ?? '정보 없음'); ?>개, 양실 <?= esc($hotel['western_room_count'] ?? '정보 없음'); ?>개</p>
            <p><strong>건물 층수:</strong> 지상 <?= esc($hotel['building_above_ground'] ?? '정보 없음'); ?>층, 지하 <?= esc($hotel['building_below_ground'] ?? '정보 없음'); ?>층</p>
        </div>

        <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
        <!-- 근처 맛집 -->
        <div class="detail-container">
            <h2 class="section-title">근처 맛집</h2>
            <div class="card-slider">
                <?php foreach ($results_food as $item): ?>
                    <div class="card">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAATgAAAChCAMAAABkv1NnAAAA" alt="이미지">
                        <h3><?= esc($item['title']); ?></h3>
                        <p><?= esc($item['roadAddress']); ?></p>
                        <p><?= esc($item['telephone'] ?? '정보 없음'); ?></p>
                        <a href="<?= esc($item['link']); ?>" target="_blank">자세히 보기</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
        <!-- 주변 관광지 -->
        <div class="detail-container">
            <h2 class="section-title">주변 관광지</h2>
            <div class="card-slider">
                <?php foreach ($results_tour as $item): ?>
                    <div class="card">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAATgAAAChCAMAAABkv1NnAAAA" alt="이미지">
                        <h3><?= esc($item['title']); ?></h3>
                        <p><?= esc($item['roadAddress']); ?></p>
                        <p><?= esc($item['telephone'] ?? '정보 없음'); ?></p>
                        <a href="<?= esc($item['link']); ?>" target="_blank">자세히 보기</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- 지도 -->
        <div class="map-container">
            <h2 class="section-title">지도</h2>
            <div id="map"></div>
        </div>
    </div>

    <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
    <script>
        // Naver 지도 초기화
        var map = new naver.maps.Map('map', {
            center: new naver.maps.LatLng(<?= esc($hotel['coordinate_y']); ?>, <?= esc($hotel['coordinate_x']); ?>),
            zoom: 15
        });

        // 마커 추가
        var marker = new naver.maps.Marker({
            position: new naver.maps.LatLng(<?= esc($hotel['coordinate_y']); ?>, <?= esc($hotel['coordinate_x']); ?>),
            map: map,
            title: "<?= esc($hotel['business_name']); ?>"
        });
    </script>
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
