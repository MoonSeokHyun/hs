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
            <h1 class="hero-title">🏨 숙박시설 찾기</h1>
            <p class="hero-subtitle">전국 호텔, 모텔 위치 정보를 한눈에</p>
        </div>
    </section>

    <!-- 검색 박스 -->
    <section class="search-section card mb-4">
        <div class="card-body">
            <form action="<?= base_url('hotel/search') ?>" method="get" class="search-form">
                <div class="search-input-group">
                    <input type="text" 
                           name="query" 
                           placeholder="호텔명, 지역명 검색..." 
                           class="search-input"
                           value="<?= esc($query ?? '') ?>">
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

    <!-- 최근 추가된 호텔 -->
    <?php if (!empty($recentHotels)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">🆕 최근 추가된 숙박시설</h2>
        </div>
        <div class="card-grid">
            <?php foreach ($recentHotels as $hotel): ?>
                <div class="info-card">
                    <a href="/hotel/detail/<?= esc($hotel['id']) ?>" class="card-link">
                        <div class="card-header">
                            <h3 class="card-title"><?= esc($hotel['business_name'] ?? '숙박시설') ?></h3>
                        </div>
                        <div class="card-body">
                            <p class="card-address">📍 <?= esc($hotel['site_full_address'] ?? '') ?></p>
                            <?php if (isset($hotel['contact_number']) && $hotel['contact_number']): ?>
                                <p class="card-phone">📞 <?= esc($hotel['contact_number']) ?></p>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- 숙박시설 목록 -->
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">📋 숙박시설 목록</h2>
        </div>
        <div class="card-grid">
            <?php if (!empty($hotels)): ?>
                <?php foreach ($hotels as $hotel): ?>
                    <div class="info-card">
                        <a href="/hotel/detail/<?= esc($hotel['id']) ?>" class="card-link">
                            <?php if (isset($hotel['map_image_url'])): ?>
                                <div class="card-image">
                                    <img src="<?= esc($hotel['map_image_url']) ?>" alt="<?= esc($hotel['business_name']) ?>" loading="lazy">
                                </div>
                            <?php endif; ?>
                            <div class="card-header">
                                <h3 class="card-title"><?= esc($hotel['business_name'] ?? '숙박시설') ?></h3>
                            </div>
                            <div class="card-body">
                                <p class="card-address">📍 <?= esc($hotel['site_full_address'] ?? '') ?></p>
                                <?php if (isset($hotel['contact_number']) && $hotel['contact_number']): ?>
                                    <p class="card-phone">📞 <?= esc($hotel['contact_number']) ?></p>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">숙박시설 정보가 없습니다.</p>
            <?php endif; ?>
        </div>
        
        <!-- 페이지네이션 -->
        <?php if (isset($pager)): ?>
            <div class="pagination-wrapper">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    </section>
</div>

<!-- 스타일은 common.css에 포함되어 있습니다 -->
