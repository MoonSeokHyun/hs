<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($event['title']) ?> - 편의점 할인 정보 & 이벤트 | 편잇</title>
    <meta name="description" content="<?= esc($event['title']) ?>에 대한 상세 정보와 할인 이벤트 기간, 브랜드, 상태 등을 확인하세요. 편의점 할인 정보와 레시피는 편잇에서 확인하세요!">
    <meta name="keywords" content="편의점 할인, <?= esc($event['brand']) ?>, <?= esc($event['title']) ?>, 1+1 이벤트, 2+1 할인, 편의점 이벤트">
    <meta name="robots" content="index, follow">
    <meta name="author" content="편잇">
    <meta property="og:title" content="<?= esc($event['title']) ?> - 편의점 할인 정보 & 이벤트 | 편잇">
    <meta property="og:description" content="<?= esc($event['title']) ?>에 대한 상세 정보와 할인 이벤트 기간, 브랜드, 상태 등을 확인하세요.">
    <meta property="og:image" content="<?= esc($event['image_url']) ?>">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= esc($event['title']) ?> - 편의점 할인 정보 & 이벤트 | 편잇">
    <meta name="twitter:description" content="<?= esc($event['title']) ?>에 대한 상세 정보와 할인 이벤트 기간, 브랜드, 상태 등을 확인하세요.">
    <meta name="twitter:image" content="<?= esc($event['image_url']) ?>">

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
     crossorigin="anonymous"></script>
     
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

        .detail-container {
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .event-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .event-title {
            font-size: 2em;
            font-weight: bold;
            color: #333;
            margin: 20px 0;
        }

        .event-info {
            margin-bottom: 20px;
        }

        .event-info p {
            margin: 5px 0;
            font-size: 1.1em;
        }

        .event-description {
            font-size: 1.2em;
            line-height: 1.6;
            color: #555;
        }
    </style>
</head>
<body>
<?php
    include APPPATH . 'Views/includes/header.php';
  ?>

    <div class="container">

        <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

        <div class="detail-container">
            <img src="<?= esc($event['image_url']) ?>" alt="<?= esc($event['title']) ?>" class="event-image">
            <h1 class="event-title"><?= esc($event['title']) ?></h1>

            <div class="event-info">
                <p><strong>기간:</strong> <?= esc($event['event_period']) ?></p>
                <p><strong>브랜드:</strong> <?= esc($event['brand']) ?></p>
                <p><strong>상태:</strong> <?= esc($event['status']) ?></p>
            </div>

            <div class="event-description">
                <p><?= esc($event['description'] ?? '이벤트 설명이 없습니다.') ?></p>
            </div>
        </div>
    </div>

    <?= view_cell('\App\Cells\ExtraInfoCell::render') ?>
    <?php include APPPATH . 'Views/includes/footer.php'; ?>


</body>
</html>
