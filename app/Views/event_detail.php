<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
     crossorigin="anonymous"></script>
     <?php
// 브랜드 이름 동적 처리
        $brand = $event['brand'];
        if ($brand === '7-ELEVEn') {
            $brand = '세븐일레븐';
        } elseif ($brand === 'emart24') {
            $brand = '이마트24';
        }
        ?>
        <title><?= esc($event['product_name']) ?> - <?= esc($brand) ?> <?= date('n') ?>월 행사</title>


    <meta name="description" content="<?= esc($event['product_name']) ?> - <?= esc($event['brand']) ?>에서 진행하는 행사로 <?= esc($event['event_type'] ?? 'N/A') ?> 혜택과 가격 <?= number_format($event['price']) ?> 원!">
    <meta name="keywords" content="행사, <?= esc($event['brand']) ?>, <?= esc($event['category']) ?>, <?= esc($event['product_name']) ?>, 이벤트, 할인, <?= esc($event['event_type'] ?? '프로모션') ?>">
    <meta name="author" content="Your Site Name">
    <link rel="canonical" href="<?= current_url() ?>">

    <!-- Open Graph Protocol -->
    <meta property="og:title" content="<?= esc($event['product_name']) ?> - <?= esc($event['brand']) ?> <?= date('n') ?>월 행사">
    <meta property="og:description" content="<?= esc($event['product_name']) ?> - <?= esc($event['brand']) ?>에서 진행하는 행사로 <?= esc($event['event_type'] ?? 'N/A') ?> 혜택과 가격 <?= number_format($event['price']) ?> 원!">
    <meta property="og:image" content="<?= esc($event['image_url']) ?>">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ko_KR">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= esc($event['product_name']) ?> - <?= esc($event['brand']) ?> <?= date('n') ?>월 행사">
    <meta name="twitter:description" content="<?= esc($event['product_name']) ?> - <?= esc($event['brand']) ?>에서 진행하는 행사로 <?= esc($event['event_type'] ?? 'N/A') ?> 혜택과 가격 <?= number_format($event['price']) ?> 원!">
    <meta name="twitter:image" content="<?= esc($event['image_url']) ?>">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "<?= esc($event['product_name']) ?>",
        "brand": "<?= esc($event['brand']) ?>",
        "image": "<?= esc($event['image_url']) ?>",
        "description": "<?= esc($event['product_name']) ?> - <?= esc($event['brand']) ?>에서 진행하는 행사로 <?= esc($event['event_type'] ?? 'N/A') ?> 혜택과 가격 <?= number_format($event['price']) ?> 원!",
        "offers": {
            "@type": "Offer",
            "price": "<?= $event['price'] ?>",
            "priceCurrency": "KRW",
            "availability": "https://schema.org/InStock",
            "url": "<?= current_url() ?>"
        }
    }
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        /* 메뉴바 스타일 */
        .menu-bar {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        .menu-bar a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 1.1em;
            font-weight: bold;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .menu-cu { background-color: #6c757d; }
        .menu-all { background-color: #28a745; }
        .menu-gs25 { background-color: #007bff; }
        .menu-seven { background-color: #e74c3c; }
        .menu-emart { background-color: #f1c40f; color: #333; }
        .menu-cspace { background-color: #e67e22; }
        .menu-recipe { background-color: #FFA07A; }
        .menu-event { background-color: #FF4500; }

        .menu-bar a:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
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
    <!-- 메뉴바 -->


    <div class="container mt-5">
        <h1 class="text-center mb-4"><?= esc($event['product_name']) ?></h1>
        <div class="menu-bar">
        <a href="/events" class="menu-all">전체</a>
        <a href="/events/cu" class="menu-cu">CU</a>
        <a href="/events/gs25" class="menu-gs25">GS25</a>
        <a href="/events/7-ELEVEn" class="menu-seven">세븐일레븐</a>
        <a href="/events/emart24" class="menu-emart">이마트24</a>
        <a href="/events/C·SPACE" class="menu-cspace">씨스페이스</a>
        <a href="/recipes" class="menu-recipe">레시피</a>
        <a href="/event" class="menu-event">이벤트</a>
    </div>
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
