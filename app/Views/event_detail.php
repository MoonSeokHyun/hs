<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Detail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .category-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.9em;
            font-weight: bold;
            color: white;
        }
        .category-food { background-color: #f1c40f; }
        .category-drink { background-color: #3498db; }
        .category-etc { background-color: #95a5a6; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4"><?= esc($event['product_name']) ?></h1>

        <div class="card mx-auto" style="max-width: 600px;">
            <img src="<?= esc($event['image_url']) ?>" class="card-img-top" alt="Product Image">
            <div class="card-body">
                <h5 class="card-title"><?= esc($event['product_name']) ?></h5>
                <p><strong>브랜드:</strong> <?= esc($event['brand']) ?></p>
                <p>
                    <strong>가격:</strong> <?= number_format($event['price']) ?> 원<br>
                    <?php if (!empty($event['original_price'])): ?>
                        <small class="text-muted">개당 가격: <?= number_format($event['original_price']) ?> 원</small><br>
                    <?php endif; ?>
                </p>
                <p>
                    <strong>행사:</strong> 
                    <span class="badge badge-pill badge-primary"><?= esc($event['event_type'] ?? 'N/A') ?></span>
                </p>
                <p>
                    <strong>카테고리:</strong> 
                    <span class="category-badge <?= $event['category'] === '식품' ? 'category-food' : ($event['category'] === '음료' ? 'category-drink' : 'category-etc') ?>">
                        <?= esc($event['category'] ?? '기타') ?>
                    </span>
                </p>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="/events" class="btn btn-secondary">목록으로 돌아가기</a>
        </div>
    </div>
</body>
</html>
