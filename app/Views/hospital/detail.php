<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ease Hub - <?= esc($hospital['BusinessName']); ?> 정보</title>

    <!-- SEO 메타태그 -->
    <meta name="description" content="<?= esc($hospital['BusinessName']); ?>에 대한 병원 정보 및 리뷰를 제공합니다. 병원 위치, 운영 상태, 의료 기관 유형, 연락처 등 상세 정보 확인.">
    <meta name="keywords" content="<?= esc($hospital['BusinessName']); ?>, 병원 정보, 의료기관, 리뷰, 연락처, 주소">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Ease Hub - <?= esc($hospital['BusinessName']); ?> 정보">
    <meta property="og:description" content="<?= esc($hospital['BusinessName']); ?>에 대한 병원 정보 및 리뷰. 위치, 운영 상태, 의료 기관 유형, 연락처 등 상세 정보 제공.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://easehub.co.kr/hospital/detail/<?= esc($hospital['ID']); ?>">
    <meta property="og:image" content="https://easehub.co.kr/images/hospital.jpg"> <!-- 이미지 URL 예시 -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Ease Hub - <?= esc($hospital['BusinessName']); ?> 정보">
    <meta name="twitter:description" content="<?= esc($hospital['BusinessName']); ?> 병원 정보 및 리뷰 확인">

    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>

    <style>
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
        
        h1 {
            text-align: center;
            color: #007b83;
            font-size: 2.2em;
            margin-bottom: 20px;
        }

        .hospital-details, .review-section, .nearby-facilities, .add-review-form {
            max-width: 800px;
            width: 100%;
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
            height: 400px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .add-review-form input[type="text"],
        .add-review-form select,
        .add-review-form textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            width: 100%;
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
    </style>
</head>
<body>
    <h1><?= esc($hospital['BusinessName']); ?></h1>

    <div class="hospital-details">
        <div class="card">
            <h2>기본 정보</h2>
            <p><strong>서비스명:</strong> <?= esc($hospital['OpenServiceName']); ?></p>
            <p><strong>의료기관 유형:</strong> <?= esc($hospital['MedicalInstitutionType']); ?></p>
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
        <h2>근처 편의시설 (2km 이내)</h2>
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
                            <td><a href="/facility/detail/<?= esc($facility['ID']); ?>"><?= esc($facility['BusinessName']); ?></a></td>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var coordinateX = <?= json_encode($hospital['Coordinate_X']); ?>;
            var coordinateY = <?= json_encode($hospital['Coordinate_Y']); ?>;
            
            if (coordinateX && coordinateY) {
                var mapOptions = {
                    center: new naver.maps.LatLng(coordinateX, coordinateY),
                    zoom: 16
                };
                
                var map = new naver.maps.Map('map', mapOptions);

                var markerOptions = {
                    position: new naver.maps.LatLng(coordinateX, coordinateY),
                    map: map
                };
                
                var marker = new naver.maps.Marker(markerOptions);
            } else {
                console.error("Coordinates are missing.");
            }
        });
    </script>
</body>
</html>
