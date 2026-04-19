<?php
/**
 * 브레드크럼 네비게이션 컴포넌트
 * 
 * 사용법:
 * <?= view('includes/breadcrumb', [
 *     'items' => [
 *         ['title' => '홈', 'url' => '/'],
 *         ['title' => '카테고리', 'url' => '/category'],
 *         ['title' => '현재 페이지']
 *     ]
 * ]) ?>
 */

$items = $items ?? [];
if (empty($items)) {
    return;
}
?>

<nav class="breadcrumb-nav" aria-label="Breadcrumb">
    <ol class="breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">
        <?php foreach ($items as $index => $item): ?>
            <li class="breadcrumb-item" 
                itemprop="itemListElement" 
                itemscope 
                itemtype="https://schema.org/ListItem">
                <?php if (isset($item['url']) && $index < count($items) - 1): ?>
                    <a href="<?= esc($item['url']) ?>" 
                       class="breadcrumb-link"
                       itemprop="item">
                        <span itemprop="name"><?= esc($item['title']) ?></span>
                    </a>
                    <meta itemprop="position" content="<?= $index + 1 ?>">
                    <span class="breadcrumb-separator" aria-hidden="true">›</span>
                <?php else: ?>
                    <span class="breadcrumb-current" itemprop="name">
                        <?= esc($item['title']) ?>
                    </span>
                    <meta itemprop="position" content="<?= $index + 1 ?>">
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>

<style>
.breadcrumb-nav {
    background: var(--bg-secondary);
    border-bottom: 1px solid var(--border-color);
    padding: 12px 0;
    margin-bottom: 24px;
}

.breadcrumb-list {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    list-style: none;
    margin-block: 0;
    padding-inline: 0;
    gap: 8px;
}

.breadcrumb-item {
    display: flex;
    align-items: center;
    font-size: 14px;
}

.breadcrumb-link {
    color: var(--text-secondary);
    text-decoration: none;
    transition: color 0.2s ease;
    display: flex;
    align-items: center;
}

.breadcrumb-link:hover {
    color: var(--primary-color);
    text-decoration: underline;
}

.breadcrumb-current {
    color: var(--text-primary);
    font-weight: 500;
}

.breadcrumb-separator {
    margin: 0 8px;
    color: var(--text-muted);
    font-size: 12px;
}

@media (max-width: 768px) {
    .breadcrumb-nav {
        padding: 10px 0;
    }
    
    .breadcrumb-list {
        padding: 0 16px;
        font-size: 13px;
    }
    
    .breadcrumb-separator {
        margin: 0 6px;
    }
}
</style>
