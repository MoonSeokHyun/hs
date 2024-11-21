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
            margin-bottom: 20px;
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

        .recommended-section {
            margin-top: 40px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .recommended-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #343a40;
            margin-bottom: 20px;
        }

        .recommended-products {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .recommended-products .card {
            flex: 0 0 auto;
            width: 200px;
        }

        .recommended-products .card img {
            height: 120px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .recommended-title {
                font-size: 1.2rem;
            }

            .recommended-products .card {
                width: 150px;
            }

            .recommended-products .card img {
                height: 100px;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4"><?= esc($event['product_name']) ?></h1>

        <!-- 상품 상세 정보 -->
        <div class="card mx-auto" style="max-width: 600px;">
            <img src="<?= esc($event['image_url']) ?>" class="card-img-top" alt="Product Image">
            <div class="card-body">
                <h5 class="card-title"><?= esc($event['product_name']) ?></h5>
                <p><strong>브랜드:</strong> <?= esc($event['brand']) ?></p>
                <p>
                    <strong>가격:</strong> <?= number_format($event['price']) ?> 원<br>
                    <?php if (!empty($event['original_price'])): ?>
                        <small class="text-muted">원래 가격: <?= number_format($event['original_price']) ?> 원</small><br>
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

        <!-- 추천 상품 섹션 -->
        <div class="recommended-section mt-5">
            <h3 class="text-center recommended-title">비슷한 상품 추천</h3>
            <div class="recommended-products">
                <?php foreach ($recommendedProducts as $recommended): ?>
                    <a href="/events/detail/<?= $recommended['id'] ?>" class="card-link" style="text-decoration: none; color: inherit;">
                        <div class="card">
                            <img src="<?= esc($recommended['image_url']) ?>" class="card-img-top" alt="<?= esc($recommended['product_name']) ?>">
                            <div class="card-body">
                                <h6 class="card-title"><?= esc($recommended['product_name']) ?></h6>
                                <p class="card-text mb-2">
                                    <strong>브랜드:</strong> <?= esc($recommended['brand']) ?><br>
                                    <strong>가격:</strong> <?= number_format($recommended['price']) ?> 원<br>
                                    <strong>행사:</strong> 
                                    <span class="badge <?= $recommended['event_type'] === '1+1' ? 'badge-warning' : ($recommended['event_type'] === '2+1' ? 'badge-danger' : 'badge-info') ?>">
                                        <?= esc($recommended['event_type'] ?? 'N/A') ?>
                                    </span><br>
                                </p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="/events" class="btn btn-secondary">목록으로 돌아가기</a>
        </div>
    </div>
</body>
</html>
