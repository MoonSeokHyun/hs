<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($hospital['BusinessName']); ?> 정보</title>

    <!-- SEO 메타태그 -->
    <meta name="description" content="<?= esc($hospital['BusinessName']); ?>에 대한 병원 정보 및 리뷰를 제공합니다. 병원 위치, 운영 상태, 의료 기관 유형, 연락처 등 상세 정보 확인.">
    <meta name="keywords" content="<?= esc($hospital['BusinessName']); ?>, 병원 정보, 의료기관, 리뷰, 연락처, 주소">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph for social media -->
    <meta property="og:title" content="Ease Hub - <?= esc($hospital['BusinessName']); ?> 정보">
    <meta property="og:description" content="<?= esc($hospital['BusinessName']); ?>에 대한 병원 정보 및 리뷰. 위치, 운영 상태, 의료 기관 유형, 연락처 등 상세 정보 제공.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://easehub.co.kr/hospital/detail/<?= esc($hospital['ID']); ?>">
    <meta property="og:image" content="https://easehub.co.kr/hospital-project/public/img/logo.png">

    <!-- Twitter Card for Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Ease Hub - <?= esc($hospital['BusinessName']); ?> 정보">
    <meta name="twitter:description" content="<?= esc($hospital['BusinessName']); ?> 병원 정보 및 리뷰 확인">
    <meta name="twitter:image" content="https://easehub.co.kr/hospital-project/public/img/logo.png">

    <!-- Naver 지도 API -->
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
     crossorigin="anonymous"></script>
    <style>
        /* 기본 스타일 */
        body {
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: #333333;
        }

        /* 컨테이너 스타일 */
        .container {
            width: 80%;
            max-width: 800px;
        }

        /* 모바일 화면에서 컨테이너 너비를 95%로 설정 */
        @media (max-width: 768px) {
            .container {
                width: 95%;
            }
        }

        h1 {
            text-align: center;
            color: #007b83;
            font-size: 2.2em;
            margin-bottom: 20px;
        }

        .hospital-details, .review-section, .nearby-facilities, .add-review-form {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }

        .card, .review {
            padding: 20px;
            margin-top: 10px;
            border-bottom: 1px solid #ddd;
        }

        .card h2, .review h2 {
            font-size: 1.3em;
            color: #007b83;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #ddd;
        }

        .card p, .review p {
            margin: 8px 0;
            line-height: 1.5;
        }

        .review-rating {
            color: #f39c12;
            font-size: 1.2em;
        }

        #map {
            width: 100%;
            height: 300px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .add-review-form input[type="text"],
        .add-review-form select,
        .add-review-form textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            width: 98%;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .add-review-form button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007b83;
            color: #ffffff;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-review-form button:hover {
            background-color: #005f63;
        }

        /* Nearby facilities table */
        .nearby-facilities table {
            width: 100%;
            border-collapse: collapse;
        }

        .nearby-facilities th,
        .nearby-facilities td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .nearby-facilities th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .nearby-facilities a {
            color: #007b83;
            text-decoration: none;
            font-weight: bold;
        }

        .nearby-facilities a:hover {
            text-decoration: underline;
        }

        /* Footer styling */
        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            font-size: 0.9em;
            color: #666;
            border-top: 1px solid #ddd;
            background-color: #f7f9fc;
            border-radius: 8px;
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1);
        }

        .footer a {
            color: #007b83;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
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
    <div class="container">
        <h1><?= esc($hospital['BusinessName']); ?></h1>


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
        <div class="hospital-details">
            <div class="card">
                <h2>기본 정보</h2>
                <p><strong>서비스명:</strong> <?= esc($hospital['OpenServiceName']); ?></p>
            </div>
            
            <div class="card">
                <h2>운영 상태</h2>
                <p><strong>영업 상태:</strong> <?= esc($hospital['BusinessStatusName']); ?></p>
                <p><strong>허가일자:</strong> <?= esc($hospital['PermitDate']); ?></p>
            </div>
            
            <div class="card">
                <h2>연락처 및 위치</h2>
                <p><strong>전화번호:</strong> <?= esc($hospital['PhoneNumber']); ?></p>
                <p><strong>주소:</strong> <?= esc($hospital['FullAddress']); ?></p>
                <p><strong>도로명 주소:</strong> <?= esc($hospital['RoadNameFullAddress']); ?></p>
                <p><strong>우편번호:</strong> <?= esc($hospital['PostalCode']); ?></p>
            </div>
        </div>

        <div id="map"></div>

        <div class="nearby-facilities">
            <h2>근처 편의시설 (5km 이내)</h2>
            <table>
                <thead>
                    <tr>
                        <th>시설명</th>
                        <th>주소</th>
                        <th>전화번호</th>
                        <th>거리 (km)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($nearbyFacilities)): ?>
                        <?php foreach ($nearbyFacilities as $facility): ?>
                            <tr>
                                <td><a href="/hospitals/detail/<?= esc($facility['ID']); ?>"><?= esc($facility['BusinessName']); ?></a></td>
                                <td><?= esc($facility['FullAddress']); ?></td>
                                <td><?= esc($facility['PhoneNumber']); ?></td>
                                <td><?= number_format($facility['distance'], 2); ?> km</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">근처에 편의시설이 없습니다.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="review-section">
            <h2>리뷰 및 평점</h2>
            <?php if ($reviews): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review">
                        <p><strong><?= esc($review['user_name']); ?></strong> - <span class="review-rating"><?= str_repeat('★', $review['rating']); ?></span></p>
                        <p><?= esc($review['comment']); ?></p>
                        <p><small><?= esc($review['created_at']); ?></small></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>아직 리뷰가 없습니다.</p>
            <?php endif; ?>
        </div>

        <div class="add-review-form">
            <h2>리뷰 작성</h2>
            <form action="/hospital/addReview" method="post">
                <input type="hidden" name="hospital_id" value="<?= esc($hospital['ID']); ?>">
                <label for="user_name">이름:</label>
                <input type="text" name="user_name" required>
                
                <label for="rating">평점:</label>
                <select name="rating" required>
                    <option value="5">★★★★★</option>
                    <option value="4">★★★★</option>
                    <option value="3">★★★</option>
                    <option value="2">★★</option>
                    <option value="1">★</option>
                </select>
                
                <label for="comment">댓글:</label>
                <textarea name="comment" rows="4" required></textarea>
                
                <button type="submit">리뷰 작성</button>
            </form>
        </div>
        <div class="social-share" style="text-align: center; margin-top: 20px;">
    <p>이 편의시설 정보를 공유하세요:</p>
    
    <!-- Facebook 공유 버튼 -->
    <a href="https://facebook.com/sharer/sharer.php?u=https://easehub.co.kr/hospital/detail/<?= esc($hospital['ID']); ?>" target="_blank" style="display: inline-block; margin-right: 10px;">
        <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook 공유" style="width: 40px; height: 40px;">
    </a>
    
    <!-- Twitter 공유 버튼 -->
    <a href="https://twitter.com/share?url=https://easehub.co.kr/hospital/detail/<?= esc($hospital['ID']); ?>" target="_blank" style="display: inline-block;">
        <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter 공유" style="width: 40px; height: 40px;">
    </a>
</div>


        <div class="footer">
            본 데이터는 <a href="https://www.data.go.kr" target="_blank">www.data.go.kr</a>에서 제공한 자료를 기반으로 하였습니다.<br>
            이 웹 사이트는 영리 목적으로 만들어졌습니다.<br>
            잘못된 정보는 <a href="mailto:gjqmaoslwj@naver.com">gjqmaoslwj@naver.com</a>으로 문의해 주세요.
        </div>
    </div>

    <script>
        var latitude = <?= json_encode($latitude); ?>;
        var longitude = <?= json_encode($longitude); ?>;

        var mapOptions = {
            center: new naver.maps.LatLng(latitude, longitude),
            zoom: 16
        };

        var map = new naver.maps.Map('map', mapOptions);

        var marker = new naver.maps.Marker({
            position: new naver.maps.LatLng(latitude, longitude),
            map: map,
            icon: {
                url: 'https://example.com/path/to/custom-marker-icon.png',
                size: new naver.maps.Size(30, 40),
                origin: new naver.maps.Point(0, 0),
                anchor: new naver.maps.Point(15, 40)
            }
        });

        var infoWindow = new naver.maps.InfoWindow({
            content: `<div style="padding:10px;font-size:14px;color:#333;"><strong><?= esc($hospital['BusinessName']); ?></strong></div>`
        });

        naver.maps.Event.addListener(marker, 'click', function() {
            if (infoWindow.getMap()) {
                infoWindow.close();
            } else {
                infoWindow.open(map, marker);
            }
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
