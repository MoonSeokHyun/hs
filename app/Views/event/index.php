<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
     crossorigin="anonymous"></script>
    <title>편의점 이벤트 - 편잇</title>
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


        .card-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 한 줄에 4개 */
            gap: 15px;
        }

        .card {
            display: flex;
            flex-direction: column;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: #fff;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 150px;
            object-fit: cover;
        }

        .card-body {
            padding: 10px;
            text-align: center;
        }

        .card-title {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .status {
            font-weight: bold;
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .status-ongoing {
            background-color: #28a745;
            color: white;
        }

        .status-ended {
            background-color: #e74c3c;
            color: white;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .pagination a {
            text-decoration: none;
            margin: 0 5px;
            padding: 5px 10px;
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

        @media (max-width: 1024px) {
            .card-container {
                grid-template-columns: repeat(3, 1fr); /* 태블릿: 한 줄에 3개 */
            }
        }

        @media (max-width: 768px) {
            .card-container {
                grid-template-columns: repeat(2, 1fr); /* 모바일: 한 줄에 2개 */
            }
        }

        @media (max-width: 576px) {
            .card-container {
                grid-template-columns: 1fr; /* 작은 화면: 한 줄에 1개 */
            }
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
        <!-- 이벤트 카드 -->
        <div class="card-container">
            <?php if (!empty($allEvents)): ?>
                <?php foreach ($allEvents as $event): ?>
                    <a href="/event/<?= esc($event['id']) ?>" class="card-link">
                        <div class="card">
                            <img src="<?= esc($event['image_url']) ?>" class="card-img-top" alt="<?= esc($event['title']) ?>">
                            <div class="card-body">
                                <span class="status <?= $event['status'] === '진행중' ? 'status-ongoing' : 'status-ended' ?>">
                                    <?= $event['status'] === '진행중' ? '[진행]' : '[종료]' ?>
                                </span>
                                <h5 class="card-title"><?= esc($event['title']) ?></h5>
                                <p class="card-text">
                                    <strong>기간:</strong> <?= esc($event['event_period']) ?><br>
                                    <strong>브랜드:</strong> <?= esc($event['brand']) ?>
                                </p>
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

    <?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
