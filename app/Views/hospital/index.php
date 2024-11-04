<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="Vg6LnwCg2ciJr3emetShc4yHm1AYLLPKWrg3UdFYpDg" />
    <meta name="naver-site-verification" content="da4595e04224f83fa6c03f3136fc09f0094ef7a7" />
    <title>Ease Hub - 편의시설 정보</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="Ease Hub에서 인기 있는 편의시설, 최근 추가된 시설 및 최신 리뷰를 확인하세요. 서울 지역의 병원 및 편의시설 정보를 제공합니다.">
    <meta name="keywords" content=" 편의시설, Ease Hub 리뷰, 인기 시설, 최근 추가">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Ease Hub">
    
    <!-- Open Graph for social media -->
    <meta property="og:title" content="Ease Hub -  편의시설 정보">
    <meta property="og:description" content="서울 지역  편의시설 정보, 최신 리뷰와 인기 시설을 확인하세요.">
    <meta property="og:image" content="">
    <meta property="og:url" content="https://easehub.co.kr/>
    <meta property="og:type" content="website">

    <!-- Twitter Card for Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Ease Hub - 편의시설 정보">
    <meta name="twitter:description" content="서울 지역  편의시설 정보, 최신 리뷰와 인기 시설을 확인하세요.">
    <meta name="twitter:image" content="YOUR_IMAGE_URL_HERE">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
    crossorigin="anonymous"></script>
    <style>
        /* Body and container styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f9fc;
            color: #333;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 80%;
            max-width: 900px;
        }

        /* 모바일 화면에서 container 너비를 95%로 설정 */
        @media (max-width: 768px) {
            .container {
                width: 95%;
            }
        }

        /* Title styling */
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        /* Section styling */
        .section {
            margin-bottom: 40px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            font-size: 1.5em;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        /* Facility, review, and category item styling */
        .facility, .review, .category-item {
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .facility:hover, .review:hover, .category-item:hover {
            background-color: #f0f8ff;
        }

        .facility h3, .review h3, .category-item h3 {
            margin: 0 0 5px;
            color: #333;
        }

        .facility p, .review p, .category-item p {
            margin: 5px 0;
            color: #666;
            font-size: 0.9em;
        }

        /* Rating color */
        .rating {
            color: #ffc107;
        }

        /* Footer styling */
        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            background-color: #f7f9fc;
            color: #666;
            font-size: 0.9em;
            border-top: 1px solid #ddd;
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
    </style>

    <script>
        function navigateTo(url) {
            window.location.href = url;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Ease Hub</h1>

        <!-- 인기 있는 편의시설 섹션 -->
        <div class="section">
            <h2>인기 있는 편의시설</h2>
            <?php if (!empty($popularFacilities)): ?>
                <?php foreach ($popularFacilities as $facility): ?>
                    <div class="facility" onclick="navigateTo('/hospitals/detail/<?= esc($facility['ID']); ?>')">
                        <h3><?= esc($facility['BusinessName']); ?></h3>
                        <p>주소: <?= isset($facility['FullAddress']) ? esc($facility['FullAddress']) : '주소 정보 없음'; ?></p>
                        <p>평균 평점: <span class="rating"><?= number_format($facility['avg_rating'], 1); ?> / 5</span></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>인기 있는 편의시설이 없습니다.</p>
            <?php endif; ?>
        </div>

        <!-- 최근 등록된 리뷰 섹션 -->
        <div class="section">
            <h2>최근 리뷰</h2>
            <?php if (!empty($latestReviews)): ?>
                <?php foreach ($latestReviews as $review): ?>
                    <div class="review" onclick="navigateTo('/hospitals/detail/<?= esc($review['hospital_id']); ?>')">
                        <h3><?= esc($review['BusinessName']); ?></h3>
                        <p>리뷰어: <?= esc($review['user_name']); ?></p>
                        <p>평점: <span class="rating"><?= esc($review['rating']); ?> / 5</span></p>
                        <p><?= esc($review['comment']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>최근 리뷰가 없습니다.</p>
            <?php endif; ?>
        </div>

        <!-- 최근 추가된 편의시설 섹션 -->
        <div class="section">
            <h2>최근 추가된 편의시설</h2>
            <?php if (!empty($recentlyAddedFacilities)): ?>
                <?php foreach (array_slice($recentlyAddedFacilities, 0, 5) as $facility): ?>
                    <div class="facility" onclick="navigateTo('/hospitals/detail/<?= esc($facility['ID']); ?>')">
                        <h3><?= esc($facility['BusinessName']); ?></h3>
                        <p>주소: <?= isset($facility['FullAddress']) ? esc($facility['FullAddress']) : '주소 정보 없음'; ?></p>
                        <p>추가일: <?= date('Y-m-d', strtotime($facility['PermitDate'])); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>최근 추가된 편의시설이 없습니다.</p>
            <?php endif; ?>
        </div>

        <!-- 편의시설 목록 섹션 -->
        <div class="section">
            <h2>편의시설</h2>
            <?php if (!empty($hospitalsByCategory)): ?>
                <?php foreach ($hospitalsByCategory as $category => $hospitals): ?>
                    <h3><?= esc($category); ?></h3>
                    <?php foreach (array_slice($hospitals, 0, 5) as $hospital): ?>
                        <div class="category-item" onclick="navigateTo('/hospitals/detail/<?= esc($hospital['ID']); ?>')">
                            <h3><?= esc($hospital['BusinessName']); ?></h3>
                            <p><strong>주소:</strong> <?= isset($hospital['FullAddress']) ? esc($hospital['FullAddress']) : '주소 정보 없음'; ?></p>
                            <p>평균 평점: <span class="rating"><?= number_format($hospital['average_rating'], 1); ?> / 5</span> (<?= esc($hospital['review_count']); ?>개 리뷰)</p>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>편의시설 정보가 없습니다.</p>
            <?php endif; ?>
        </div>
        <div class="footer">
            본 데이터는 <a href="https://www.data.go.kr" target="_blank">www.data.go.kr</a>에서 제공한 자료를 기반으로 하였습니다.<br>
            이 웹 사이트는 영리 목적으로 만들어졌습니다.<br>
            잘못된 정보는 <a href="mailto:gjqmaoslwj@naver.com">gjqmaoslwj@naver.com</a>으로 문의해 주세요.
        </div>
    </div>
    	
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
if(!wcs_add) var wcs_add = {};
wcs_add["wa"] = "8adec19974bed8";
if(window.wcs) {
wcs_do();
}
</script>
</body>
</html>
