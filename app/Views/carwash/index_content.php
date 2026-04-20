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
            <h1 class="hero-title">🚗 세차장 찾기</h1>
            <p class="hero-subtitle">전국 세차장 위치와 요금 정보를 한눈에</p>
        </div>
    </section>

    <!-- 광고 -->
    <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

    <!-- 최근 추가된 세차장 -->
    <?php if (!empty($recentCarWashes)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">🆕 최근 추가된 세차장</h2>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>세차장명</th>
                        <th>주소</th>
                        <th>추가일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentCarWashes as $carwash): ?>
                        <tr onclick="window.location.href='/carwash/details/<?= esc($carwash['ID']) ?>'" style="cursor: pointer;">
                            <td><strong><?= esc($carwash['Business Name'] ?? '') ?></strong></td>
                            <td><?= esc($carwash['Address (Road Name)'] ?? '') ?>, <?= esc($carwash['City/District'] ?? '') ?></td>
                            <td><?= esc($carwash['Data Reference Date'] ?? '') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php endif; ?>

    <!-- 인기 세차장 -->
    <?php if (!empty($popularCarWashes)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">⭐ 인기 세차장</h2>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>세차장명</th>
                        <th>전화번호</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($popularCarWashes as $carwash): ?>
                        <tr onclick="window.location.href='/carwash/details/<?= esc($carwash['ID']) ?>'" style="cursor: pointer;">
                            <td><strong><?= esc($carwash['Business Name'] ?? '') ?></strong></td>
                            <td><?= esc($carwash['Car Wash Phone Number'] ?? '정보 없음') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php endif; ?>
</div>

<!-- 스타일은 common.css에 포함되어 있습니다 -->
