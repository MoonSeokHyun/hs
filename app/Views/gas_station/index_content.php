<?php
// 브레드크럼
if (isset($breadcrumb)) {
    echo view('includes/breadcrumb', ['items' => $breadcrumb]);
}
?>

<div class="container">
    <!-- 히어로 섹션 -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">⛽ 주유소 찾기</h1>
            <p class="hero-subtitle">전국 주유소 위치와 유가 정보를 한눈에</p>
        </div>
    </section>

    <!-- 검색 박스 -->
    <section class="search-section card mb-4">
        <div class="card-body">
            <form action="<?= base_url('gas_stations/search') ?>" method="get" class="search-form">
                <div class="search-input-group">
                    <input type="text" 
                           name="search" 
                           placeholder="주유소 이름 검색..." 
                           class="search-input"
                           value="<?= esc($searchQuery ?? '') ?>"
                           required>
                    <button type="submit" class="btn btn-primary">검색</button>
                </div>
            </form>
        </div>
    </section>

    <!-- 광고 -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

    <!-- 최근 추가된 주유소 -->
    <?php if (!empty($recentGasStations)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">🆕 최근 추가된 주유소</h2>
        </div>
        <div class="card-slider">
            <?php foreach ($recentGasStations as $station): ?>
                <div class="info-card">
                    <a href="/gas_stations/<?= esc($station['id']) ?>" class="card-link">
                        <div class="card-header">
                            <h3 class="card-title"><?= esc($station['gas_station_name'] ?? '주유소') ?></h3>
                        </div>
                        <div class="card-body">
                            <p class="card-address">📍 <?= esc($station['road_address'] ?? '') ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- 인기 주유소 -->
    <?php if (!empty($popularGasStations)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">⭐ 인기 주유소</h2>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>주유소 이름</th>
                        <th>주소</th>
                        <th>리뷰 개수</th>
                        <th>평균 평점</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($popularGasStations as $station): ?>
                        <tr onclick="window.location.href='/gas_stations/<?= esc($station['id']) ?>'" style="cursor: pointer;">
                            <td>
                                <strong><?= esc($station['gas_station_name'] ?? '') ?></strong>
                            </td>
                            <td><?= esc($station['road_address'] ?? '') ?></td>
                            <td><?= number_format($station['review_count'] ?? 0) ?>개</td>
                            <td>
                                <span class="rating-badge">
                                    <?= str_repeat('★', min(5, (int)($station['average_rating'] ?? 0))) ?>
                                    <?= number_format($station['average_rating'] ?? 0, 1) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php endif; ?>

    <!-- 최근 리뷰 -->
    <?php if (!empty($recentReviews)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">💬 최근 리뷰</h2>
        </div>
        <div class="review-list">
            <?php foreach ($recentReviews as $review): ?>
                <div class="review-item">
                    <div class="review-header">
                        <strong><?= esc($review['gas_station_name'] ?? '주유소') ?></strong>
                        <span class="review-rating">
                            <?= str_repeat('★', (int)($review['rating'] ?? 0)) ?>
                        </span>
                    </div>
                    <p class="review-text"><?= esc($review['comment_text'] ?? '') ?></p>
                    <a href="/gas_stations/<?= esc($review['gas_station_id'] ?? '') ?>" class="review-link">
                        주유소 보기 →
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- 주유소 목록 -->
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">📋 주유소 목록</h2>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>주유소 이름</th>
                        <th>주소</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($gasStations)): ?>
                        <?php foreach ($gasStations as $station): ?>
                            <tr onclick="window.location.href='/gas_stations/<?= esc($station['id']) ?>'" style="cursor: pointer;">
                                <td><strong><?= esc($station['gas_station_name'] ?? '') ?></strong></td>
                                <td><?= esc($station['road_address'] ?? '') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-center">주유소 정보가 없습니다.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- 페이지네이션 -->
        <?php if (isset($pager)): ?>
            <div class="pagination-wrapper">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    </section>

    <!-- 광고 -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>

<!-- 스타일은 common.css에 포함되어 있습니다 -->
