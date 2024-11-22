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
            margin-top: 10px;
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

        <style>
.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    justify-content: center;
    margin: 20px 0;
}

.pagination li {
    margin: 0 5px;
}

.pagination a {
    text-decoration: none;
    color: #007bff;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.pagination a:hover {
    background-color: #007bff;
    color: #fff;
}

.pagination .active a {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}
</style>

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
            <a href="/recipes" class="menu-recipe">레시피</a>
            <a href="/event" class="menu-event">이벤트</a>
        </div>


        <!-- Filters -->
        <form method="get" action="<?= current_url() ?>" class="mb-4">
            <div class="form-row form-group">
                <div class="col">
                    <select name="event_type" class="form-control" id="id_event_type">
                        <option value="" <?= $eventType == '' ? 'selected' : '' ?>>행사-전체</option>
                        <option value="1+1" <?= $eventType == '1+1' ? 'selected' : '' ?>>1+1</option>
                        <option value="2+1" <?= $eventType == '2+1' ? 'selected' : '' ?>>2+1</option>
                        <option value="3+1" <?= $eventType == '3+1' ? 'selected' : '' ?>>3+1</option>
                    </select>
                </div>
                <div class="col">
                    <select name="category" class="form-control" id="id_category">
                        <option value="" <?= $category == '' ? 'selected' : '' ?>>분류-전체</option>
                        <option value="음료" <?= $category == '음료' ? 'selected' : '' ?>>음료</option>
                        <option value="식품" <?= $category == '식품' ? 'selected' : '' ?>>식품</option>
                        <option value="과자류" <?= $category == '과자류' ? 'selected' : '' ?>>과자류</option>
                        <option value="아이스크림" <?= $category == '아이스크림' ? 'selected' : '' ?>>아이스크림</option>
                        <option value="생활용품" <?= $category == '생활용품' ? 'selected' : '' ?>>생활용품</option>
                    </select>
                </div>
            </div>
            <div class="form-row form-group">
                <div class="col">
                    <select name="item" class="form-control" id="id_item">
                        <option value="20" <?= $itemsPerPage == 20 ? 'selected' : '' ?>>상품수-20개</option>
                        <option value="60" <?= $itemsPerPage == 60 ? 'selected' : '' ?>>60개</option>
                        <option value="100" <?= $itemsPerPage == 100 ? 'selected' : '' ?>>100개</option>
                    </select>
                </div>
                <div class="col">
                    <select name="sort" class="form-control" id="id_sort">
                        <option value="" <?= $sort == '' ? 'selected' : '' ?>>정렬-상품명</option>
                        <option value="1" <?= $sort == '1' ? 'selected' : '' ?>>낮은가격순</option>
                        <option value="2" <?= $sort == '2' ? 'selected' : '' ?>>높은가격순</option>
                    </select>
                </div>
            </div>
            <div class="form-row form-group">
                <div class="col">
                    <input type="number" name="price" class="form-control" placeholder="상품가격" value="<?= esc($price) ?>" id="id_price">
                </div>
                <div class="col">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="상품명 검색" value="<?= esc($query) ?>" id="id_q">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">검색</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Event List -->
        <div class="row row-cols-1 row-cols-md-2">
    <?php if (!empty($events)): ?>
        <?php foreach ($events as $event): ?>
            <?php
            $cardClass = 'card-all';
            $headerClass = 'header-all';
            switch (trim($event['brand'])) {
                case 'CU': $cardClass = 'card-cu'; $headerClass = 'header-cu'; break;
                case 'GS25': $cardClass = 'card-gs25'; $headerClass = 'header-gs25'; break;
                case '7-ELEVEn': $cardClass = 'card-seven'; $headerClass = 'header-seven'; break;
                case 'emart24': $cardClass = 'card-emart'; $headerClass = 'header-emart'; break;
                case 'C·SPACE': $cardClass = 'card-cspace'; $headerClass = 'header-cspace'; break;
            }

            // 이벤트 타입 색상
            $eventTypeClass = 'badge-secondary'; // Default
            switch (trim($event['event_type'])) {
                case '1+1': $eventTypeClass = 'badge-warning'; break; // 노란색
                case '2+1': $eventTypeClass = 'badge-danger'; break;  // 빨간색
                case '3+1': $eventTypeClass = 'badge-info'; break;    // 파란색
                case '4+1': $eventTypeClass = 'badge-success'; break; // 초록색
            }

            // 카테고리 색상
            $categoryClass = 'badge-dark'; // Default
            switch (trim($event['category'])) {
                case '음료': $categoryClass = 'badge-primary'; break; // 파란색
                case '식품': $categoryClass = 'badge-success'; break; // 초록색
                case '과자류': $categoryClass = 'badge-warning'; break; // 노란색
                case '아이스크림': $categoryClass = 'badge-info'; break; // 밝은 파란색
                case '생활용품': $categoryClass = 'badge-secondary'; break; // 회색
            }
            ?>
            <!-- 카드 클릭 시 디테일 페이지로 이동 -->
            <a href="/events/detail/<?= esc($event['id']) ?>" class="text-decoration-none text-reset">
                <div class="col mb-4">
                    <div class="card <?= $cardClass ?> clickable-card">
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
                                        <strong>판매가격:</strong> <?= number_format($event['price']) ?> 원<br>
                                        <?php if (!empty($event['original_price'])): ?>
                                            <small class="text-muted">원래가격: <?= number_format($event['original_price']) ?> 원</small><br>
                                        <?php endif; ?>
                                    </p>
                                    <!-- 이벤트 타입과 카테고리를 한 줄에 배지로 표시 -->
                                    <div class="d-flex gap-2">
                                        <span class="badge <?= $eventTypeClass ?>"><?= esc($event['event_type'] ?? '기타') ?></span>
                                        <span class="badge <?= $categoryClass ?>"><?= esc($event['category'] ?? '기타') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <p class="text-center">검색 결과가 없습니다.</p>
        </div>
    <?php endif; ?>
</div>

<div class="d-flex justify-content-center">
    <?= $pager->links('default', 'default_full') ?>
</div>

    </div>
</body>
</html>
