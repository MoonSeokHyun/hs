<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 공영주차장 목록{$pageSuffix} | 요금·운영시간·주차면수 | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 공영주차장 {$currentPage}페이지 - 지역별 공영주차장의 요금, 운영시간, 주차면수 정보를 확인하세요."
    : "전국 공영주차장의 요금, 운영시간, 주차면수, 위치 정보를 지역별로 확인하세요. 가까운 공영주차장을 쉽게 찾고 요금을 미리 비교할 수 있습니다.";
$canonical = $currentPage > 1 ? base_url('parking-facilities') . '?page=' . $currentPage : base_url('parking-facilities');
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?= esc($pageTitle) ?></title>
    <meta name="description" content="<?= esc($pageDesc) ?>">
    <meta name="keywords" content="공영주차장, 주차 요금, 주차면수, 운영시간, 주차장 조회, 편잇">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= esc($canonical) ?>">
    <meta property="og:title" content="<?= esc($pageTitle) ?>">
    <meta property="og:description" content="<?= esc($pageDesc) ?>">
    <meta property="og:url" content="<?= esc($canonical) ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= base_url('img/logo.png') ?>">

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

        .page-title {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
            margin-bottom: 20px;
        }

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
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 24px;
                margin-top: 10px;
            }
            .card-container {
                grid-template-columns: 1fr;
                width: 90%;
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
<h1 class="page-title">공영주차장 목록을 확인해보세요!</h1>

<div class="card-container">
    <?php foreach($facilities as $f): ?>
    <div class="card" onclick="window.location='<?= site_url('parking-facilities/'.$f['id']) ?>'">
        <h3>🚗 <?= esc($f['FCLTY_NM']) ?></h3>
        <p>📍 <?= esc($f['RDNMADR_NM'] ?? '주소 정보 없음') ?></p>
        <p>📞 <?= esc($f['TEL_NO'] ?? '연락처 없음') ?></p>
    </div>
    <?php endforeach; ?>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>

</body>
</html>
