<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 전기차 충전소·급속충전기{$pageSuffix} | 위치·요금 | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 전기차 충전소 {$currentPage}페이지 - 지역별 충전기 위치와 이용 정보를 확인하세요."
    : "전국 전기차 급속·완속 충전소의 위치, 운영 시간, 요금 정보를 한눈에 확인하세요. 가까운 충전소를 지역별로 검색할 수 있습니다.";
$canonical = $currentPage > 1 ? base_url('station') . '?page=' . $currentPage : base_url('station');
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle) ?></title>
    <meta name="description" content="<?= esc($pageDesc) ?>">
    <meta name="keywords" content="전기차 충전소, 급속 충전기, 완속 충전기, EV 충전, 전기차 요금, 편잇">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= esc($canonical) ?>">
    <meta property="og:title" content="<?= esc($pageTitle) ?>">
    <meta property="og:description" content="<?= esc($pageDesc) ?>">
    <meta property="og:url" content="<?= esc($canonical) ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= base_url('img/logo.png') ?>">
  
    <!-- 네이버 지도 API 주석 처리 (필요 없으시면 제거) -->
    <!-- <script src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script> -->
  
    <!-- 광고 스크립트 -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        .main-nav {
            background-color: #e6f7ef;
            padding: 0.7rem;
            text-align: center;
        }

        /* 제목 스타일 */
        .page-title {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        /* 카드 그리드 */
        .card-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
            width: 80%;
            margin: 0 auto;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card h3 {
            margin: 10px 0;
            color: #333;
        }

        .card p {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
        }

        /* 페이징 */
        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 16px;
            margin: 0 5px;
            background-color: #62D491;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }

        .pagination a:hover {
            background-color: #55b379;
        }

        .pagination .active {
            background-color: #4e9e68;
        }

        /* 모바일 최적화 */
        @media (max-width: 768px) {
            .page-title {
                font-size: 24px;
                margin-top: 10px;
            }

            .card-container {
                grid-template-columns: repeat(auto-fill, minmax(100%, 1fr));
            }

            .pagination a {
                padding: 6px 12px;
            }
        }
    </style>

</head>
<body>

<?php include APPPATH . 'Views/includes/header.php'; ?>

<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

<h1 class="page-title">Charging Stations</h1>

<!-- 카드 레이아웃 -->
<div class="card-container">
    <?php foreach ($stations as $station): ?>
    <div class="card" onclick="window.location='<?= site_url('station/detail/' . $station['id']) ?>'">
        <h3><?= esc($station['Company']) ?> 🔌</h3>
        <p>주소: <?= esc($station['FullAddress']) ?> 🏠</p>
        <p>주요 충전기: <?= esc($station['Service']) ?> </p>
    </div>
    <?php endforeach; ?>
</div>

<!-- 중간 광고 배치 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

<!-- 하단 광고 배치 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

<!-- 페이징 -->

<?php include APPPATH . 'Views/includes/footer.php'; ?>

</body>
</html>
