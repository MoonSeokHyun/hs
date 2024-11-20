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
        }
        .menu-bar a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .menu-cu { background-color: #28a745; }
        .menu-gs25 { background-color: #007bff; }
        .menu-seven { background-color: #e74c3c; }
        .menu-emart { background-color: #f1c40f; color: #333; }
        .menu-cspace { background-color: #e67e22; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4"><?= $brand ? $brand . ' 이벤트' : '모든 이벤트' ?></h1>

        <!-- Menu Bar -->
        <div class="menu-bar">
            <a href="/events/cu" class="menu-cu">CU</a>
            <a href="/events/gs25" class="menu-gs25">GS25</a>
            <a href="/events/7-ELEVEn" class="menu-seven">세븐일레븐</a>
            <a href="/events/emart24" class="menu-emart">이마트24</a>
            <a href="/events/cspace" class="menu-cspace">씨스페이스</a>
        </div>

        <div class="row">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <small class="float-left font-weight-bold"><?= esc($event['brand']) ?></small>
                                <small class="float-right"><?= esc($event['event_type']) ?></small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="<?= esc($event['image_url']) ?>" class="img-fluid" alt="Product Image">
                                    </div>
                                    <div class="col-8">
                                        <h5 class="card-title"><?= esc($event['product_name']) ?></h5>
                                        <p>
                                            <strong>Price:</strong> <?= number_format($event['price'], 2) ?> 원<br>
                                            <?php if (!empty($event['original_price'])): ?>
                                                <small class="text-muted">Original: <?= number_format($event['original_price'], 2) ?> 원</small><br>
                                            <?php endif; ?>
                                            <?php if (!empty($event['discount_rate'])): ?>
                                                <small class="text-danger">Discount: <?= esc($event['discount_rate']) ?>%</small>
                                            <?php endif; ?>
                                        </p>
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
