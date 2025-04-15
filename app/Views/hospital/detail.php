<?php
// 안전한 변수 초기화
$storeName = trim(esc($hospital['BusinessName'] ?? ''));
$fullAddress = esc($hospital['FullAddress'] ?? '');
$storeId = esc($hospital['ID'] ?? '');

// 지역명 추출
preg_match('/([가-힣]+구|[가-힣]+읍|[가-힣]+면)/u', $fullAddress, $matches);
$district_name = $matches[0] ?? '';

// 기본값 보정
$storeName = $storeName ?: '편의점';
$districtText = $district_name ?: '인근';
?>

<!DOCTYPE html>
<html lang="ko">
<head>

<!-- 메타태그 시작 -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= $storeName ?> | <?= $districtText ?> 위치, 운영시간, 리뷰 - Ease Hub</title>


<meta name="description" content="<?= $districtText ?>에 위치한 <?= $storeName ?>의 운영시간, 주소, 전화번호, 사용자 리뷰 정보를 확인해보세요.">
<meta name="keywords" content="<?= $storeName ?>, 편의점, <?= $districtText ?> 편의점, 위치, 운영시간, 후기, 정보">
<meta name="robots" content="index, follow">

<!-- Open Graph -->
<meta property="og:title" content="<?= $storeName ?> - <?= $districtText ?> 위치 정보 | Ease Hub">
<meta property="og:description" content="<?= $districtText ?>에 위치한 <?= $storeName ?> 편의점의 지도, 운영시간, 전화번호, 리뷰를 제공합니다.">
<meta property="og:type" content="website">
<meta property="og:url" content="https://easehub.co.kr/store/detail/<?= $storeId ?>">
<meta property="og:image" content="https://easehub.co.kr/assets/img/convenience-default.jpg">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= $storeName ?> - <?= $districtText ?> | Ease Hub">
<meta name="twitter:description" content="<?= $storeName ?>의 위치, 운영시간, 리뷰 정보를 확인하세요.">
<meta name="twitter:image" content="https://easehub.co.kr/assets/img/convenience-default.jpg">

    <!-- Naver 지도 API -->
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
     crossorigin="anonymous"></script>
    <style>
/* ===== 기본 설정 ===== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  height: 100%;
  font-family: 'Helvetica Neue', sans-serif;
  background-color: #f8f9fa;
  color: #333;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.container {
  max-width: 960px;
  margin: 0 auto;
  padding: 20px;
}

h1 {
  font-size: 2.2em;
  color: #007b83;
  text-align: center;
  margin-bottom: 30px;
}

/* ===== 섹션 ===== */
.section {
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  padding: 25px;
  margin-bottom: 25px;
}

.section h2 {
  font-size: 1.4em;
  border-bottom: 2px solid #eee;
  padding-bottom: 10px;
  margin-bottom: 15px;
  color: #007b83;
}

.section p, .section li, .section td {
  font-size: 1em;
  line-height: 1.6;
  margin: 6px 0;
}

/* ===== 버튼 ===== */
button, .btn {
  background-color: #007b83;
  color: #fff;
  border: none;
  padding: 10px 20px;
  font-size: 1em;
  border-radius: 6px;
  cursor: pointer;
  transition: 0.3s;
}

button:hover, .btn:hover {
  background-color: #005f63;
}

/* ===== 리뷰 ===== */
.review-rating {
  color: #f39c12;
  font-size: 1.2em;
}

.review {
  padding: 20px;
  border-bottom: 1px solid #ddd;
}

.review:last-child {
  border-bottom: none;
}

/* ===== 폼 ===== */
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
  width: 100%;
}

/* ===== 테이블 ===== */
.table {
  width: 100%;
  border-collapse: collapse;
}

.table th,
.table td {
  padding: 12px 15px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.table th {
  background-color: #f0f0f0;
  font-weight: bold;
}

.table a {
  color: #007b83;
  text-decoration: none;
  font-weight: bold;
}

.table a:hover {
  text-decoration: underline;
}

/* ===== 지도 ===== */
#map {
  width: 100%;
  height: 300px;
  margin-top: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* ===== 푸터 ===== */
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

/* ===== 반응형 ===== */
@media (max-width: 768px) {
  .container {
    width: 95%;
  }

  h1 {
    font-size: 1.8em;
  }

  .section {
    padding: 15px;
  }

  .add-review-form button {
    font-size: 1em;
  }
}


    </style>
</head>
<body>
<?php
    include APPPATH . 'Views/includes/header.php';
  ?>
    <div class="container">
        <h1><?= esc($hospital['BusinessName']); ?></h1>


<!-- Floating menu bar -->

    <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
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

        <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
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

<?= view_cell('\App\Cells\ExtraInfoCell::render') ?>
  <?php include APPPATH . 'Views/includes/footer.php'; ?>


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
