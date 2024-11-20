<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .menu-bar {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .menu-bar a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .menu-bar a:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .menu-all { background-color: #6c757d; }
        .menu-cu { background-color: #28a745; }
        .menu-gs25 { background-color: #007bff; }
        .menu-seven { background-color: #e74c3c; }
        .menu-emart { background-color: #f1c40f; color: #333; }
        .menu-cspace { background-color: #e67e22; }

        .card {
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-all { border: 2px solid #6c757d; }
        .card-cu { border: 2px solid #28a745; }
        .card-gs25 { border: 2px solid #007bff; }
        .card-seven { border: 2px solid #e74c3c; }
        .card-emart { border: 2px solid #f1c40f; }
        .card-cspace { border: 2px solid #e67e22; }

        .header-all { background-color: #6c757d; color: white; }
        .header-cu { background-color: #28a745; color: white; }
        .header-gs25 { background-color: #007bff; color: white; }
        .header-seven { background-color: #e74c3c; color: white; }
        .header-emart { background-color: #f1c40f; color: #333; }
        .header-cspace { background-color: #e67e22; color: white; }

        .badge-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
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

        .event-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 50%;
            background-color: #ff4757;
            color: white;
            font-size: 0.9em;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .menu-bar {
                gap: 10px;
            }

            .menu-bar a {
                font-size: 0.9em;
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4"><?= $brand ? $brand . ' 이벤트' : '모든 이벤트' ?></h1>

        <!-- Menu Bar -->
        <div class="menu-bar">
            <a href="/events" class="menu-all">전체</a>
            <a href="/events/cu" class="menu-cu">CU</a>
            <a href="/events/gs25" class="menu-gs25">GS25</a>
            <a href="/events/7-ELEVEn" class="menu-seven">세븐일레븐</a>
            <a href="/events/emart24" class="menu-emart">이마트24</a>
            <a href="/events/C·SPACE" class="menu-cspace">씨스페이스</a>
        </div>

        <div class="row row-cols-1 row-cols-md-2">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <?php
                    // Determine the card and header class based on the brand
                    $cardClass = 'card-all';
                    $headerClass = 'header-all';
                    switch (trim($event['brand'])) {
                        case 'CU':
                            $cardClass = 'card-cu';
                            $headerClass = 'header-cu';
                            break;
                        case 'GS25':
                            $cardClass = 'card-gs25';
                            $headerClass = 'header-gs25';
                            break;
                        case '7-ELEVEn':
                            $cardClass = 'card-seven';
                            $headerClass = 'header-seven';
                            break;
                        case 'emart24':
                            $cardClass = 'card-emart';
                            $headerClass = 'header-emart';
                            break;
                        case 'C·SPACE':
                            $cardClass = 'card-cspace';
                            $headerClass = 'header-cspace';
                            break;
                    }

                    // Determine category badge class
                    $categoryClass = 'category-etc'; // Default
                    if (isset($event['category'])) {
                        if ($event['category'] === '식품') $categoryClass = 'category-food';
                        elseif ($event['category'] === '음료') $categoryClass = 'category-drink';
                    }
                    ?>
                    <div class="col mb-4">
                        <div class="card <?= $cardClass ?>">
                            <div class="card-header <?= $headerClass ?>">
                                <small class="float-left font-weight-bold"><?= esc($event['brand']) ?></small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="<?= esc($event['image_url']) ?>" class="img-fluid" alt="Product Image">
                                    </div>
                                    <div class="col-8">
                                        <h5 class="card-title"><?= esc($event['product_name']) ?></h5>
                                        <p>
                                            <strong>가격:</strong> <?= number_format($event['price']) ?> 원<br>
                                            <?php if (!empty($event['original_price'])): ?>
                                                <small class="text-muted">개당 가격: <?= number_format($event['original_price']) ?> 원</small><br>
                                            <?php endif; ?>
                                        </p>
                                        <div class="badge-row">
                                            <?php if (!empty($event['event_type'])): ?>
                                                <div class="event-badge"><?= esc($event['event_type']) ?></div>
                                            <?php endif; ?>
                                            <span class="category-badge <?= $categoryClass ?>"><?= esc($event['category'] ?? '기타') ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">No events available.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="d-flex justify-content-center">
            <?= $pager ?>
        </div>
    </div>
</body>
</html>
