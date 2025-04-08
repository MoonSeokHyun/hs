<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="세차장 상세 페이지. <?= esc($carwash['Business Name']); ?> 세차장의 위치, 서비스, 가격 정보 및 리뷰를 확인하세요.">
    <meta name="keywords" content="세차장, <?= esc($carwash['Business Name']); ?>, 세차 서비스, <?= esc($carwash['City/District']); ?>, 자동차 세차">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= esc($carwash['Address (Road Name)']) ?>, <?= esc($carwash['Business Name']); ?> - 세차장 정보">
    <meta property="og:description" content="<?= esc($carwash['Business Name']); ?>의 위치와 세차 서비스 정보를 확인하고, 리뷰를 남겨보세요.">
    <meta property="og:image" content="URL_TO_IMAGE">
    <meta property="og:url" content="<?= current_url() ?>">
    <title><?= esc($carwash['Address (Road Name)']) ?>, <?= esc($carwash['Business Name']); ?> - 세차장 정보</title>

    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f8f9fa; color: #333; margin: 0; padding: 0; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        h1 { text-align: center; color: #007bff; font-size: 2.5em; margin-bottom: 20px; }
        .back-button { display: inline-block; margin: 20px; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 25px; font-size: 1.1em; transition: transform 0.3s; }
        .back-button:hover { transform: translateY(-5px); background-color: #0056b3; }
        .carwash-detail { background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
        .carwash-detail h2 { color: #007bff; font-size: 1.8em; margin-bottom: 15px; }
        .carwash-detail table { width: 100%; border-collapse: collapse; }
        .carwash-detail th, .carwash-detail td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        .carwash-detail th { background-color: #007bff; color: #fff; }
        .comments-section { margin-top: 40px; padding: 15px; border: 1px solid #007bff; background: #f0f8ff; border-radius: 5px; }
        .comments-list { margin-top: 20px; }
        .comment-item { padding: 15px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 15px; background-color: #f9f9f9; }
        .comment-header { display: flex; justify-content: space-between; font-size: 14px; color: #555; margin-bottom: 8px; }
        .comment-text { font-size: 16px; color: #333; line-height: 1.4; }
        .rating { display: flex; align-items: center; margin-bottom: 10px; }
        .star { font-size: 24px; color: #ddd; cursor: pointer; transition: color 0.3s ease; }
        .star.selected { color: #ffd700; }
        .rating-label { margin-right: 10px; font-weight: bold; color: #007bff; }
        .comment-form { display: flex; flex-direction: column; gap: 10px; margin-top: 10px; }
        .comment-textarea { width: 100%; height: 80px; padding: 10px; border-radius: 5px; border: 1px solid #ddd; resize: none; font-size: 14px; }
        .submit-button { align-self: flex-end; padding: 8px 16px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
        .submit-button:hover { background-color: #0056b3; }
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
        .menu-recipe { background-color: #FFA07A; }
        .menu-event { background-color: #FF4500; }
        .menu-parking { background-color: #8A2BE2; }
        .menu-accommodation { background-color: #17a2b8; }
        .menu-festival { background-color: #17e2b8; }
        .menu-carwash { background-color: #ff8c00; }
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
        #map { 
            width: 100%; 
            height: 400px; 
            margin: 20px 0; 
            border: 1px solid #007bff; 
            border-radius: 5px; 
        }
    </style>

    <!-- 네이버 지도 API 스크립트 추가 -->
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
</head>

<body>

    <h1><?= esc($carwash['Business Name']) ?> 세차장 정보</h1>

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
        <a href="/carwash" class="menu-carwash">세차장</a>
    </div>

    <div class="container">
        <a href="/carwash" class="back-button">세차장 목록으로 돌아가기</a>

        <div class="carwash-detail">
            <h2><?= esc($carwash['Business Name']) ?> 세차장 정보</h2>
            <table>
                <tr><th>주소</th><td><?= esc($carwash['Address (Road Name)']) ?>, <?= esc($carwash['City/District']) ?></td></tr>
                <tr><th>전화번호</th><td><?= esc($carwash['Car Wash Phone Number']) ?></td></tr>
                <tr><th>대표자명</th><td><?= esc($carwash['Representative Name']) ?></td></tr>
                <tr><th>세차 서비스 종류</th><td><?= esc($carwash['Car Wash Type']) ?></td></tr>
                <tr><th>주차장 유무</th><td><?= esc($carwash['Business Type']) ?></td></tr>
                <tr><th>운영 시간</th><td><?= esc($carwash['Weekday Start Time']) ?> ~ <?= esc($carwash['Weekday End Time']) ?></td></tr>
                <tr><th>휴무일</th><td><?= esc($carwash['Day Off']) ?></td></tr>
                <tr><th>세차 요금 정보</th><td><?= esc($carwash['Car Wash Fee Information']) ?></td></tr>
            </table>
        </div>

        <div id="map"></div> <!-- 네이버 지도 -->

        <div class="comments-section">
            <h2>리뷰 남기기 <span>(평균 평점: <?= round($averageRating, 1) ?>)</span></h2>
            <form action="/carwash/saveReview" method="post" class="comment-form" onsubmit="return validateForm()">
                <input type="hidden" name="carwash_id" value="<?= esc($carwash['ID']); ?>">
                <div class="rating" id="star-rating">
                    <span class="rating-label">평점:</span>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="star" data-value="<?= $i; ?>">&#9733;</span>
                    <?php endfor; ?>
                    <input type="hidden" name="rating" id="rating-value">
                </div>
                <textarea name="comment_text" placeholder="리뷰를 등록해주세요!" required class="comment-textarea" id="comment-text"></textarea>
                <button type="submit" class="submit-button">리뷰 등록</button>
            </form>

            <h3>리뷰 목록</h3>
            <div class="comments-list">
                <?php foreach ($reviews as $review): ?>
                    <div class="comment-item">
                        <div class="comment-header">
                            <span class="comment-rating">
                                <?php for ($i = 1; $i <= 5; $i++): 
                                    echo ($i <= $review['rating']) ? '<span class="star selected">&#9733;</span>' : '<span class="star">&#9733;</span>';
                                endfor; ?>
                            </span>
                            <span class="comment-date"><?= date('Y-m-d H:i', strtotime($review['created_at'])); ?></span>
                        </div>
                        <p class="comment-text"><?= esc($review['comment_text']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- 광고 -->
        <div class="nearby-info">
            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6686738239613464" data-ad-slot="1204098626" data-ad-format="auto" data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>

    </div>

    <script type="text/javascript">
        // 네이버 지도 설정
        var map = new naver.maps.Map('map', {
            center: new naver.maps.LatLng(<?= esc($carwash['WGS84 Latitude']); ?>, <?= esc($carwash['WGS84 Longitude']); ?>),
            zoom: 16
        });

        var marker = new naver.maps.Marker({
            position: new naver.maps.LatLng(<?= esc($carwash['WGS84 Latitude']); ?>, <?= esc($carwash['WGS84 Longitude']); ?>),
            map: map,
            title: '<?= esc($carwash['Business Name']); ?>'
        });

        // 별점 선택 기능
        document.querySelectorAll('#star-rating .star').forEach(star => {
            star.addEventListener('click', function() {
                const ratingValue = this.getAttribute('data-value');
                document.getElementById('rating-value').value = ratingValue;
                document.querySelectorAll('#star-rating .star').forEach(s => s.classList.remove('selected'));
                for (let i = 0; i < ratingValue; i++) {
                    document.querySelectorAll('#star-rating .star')[i].classList.add('selected');
                }
            });
        });

        function validateForm() {
            const ratingValue = document.getElementById("rating-value").value;
            const commentText = document.getElementById("comment-text").value.trim();
            return ratingValue && commentText;
        }
    </script>
</body>
</html>
