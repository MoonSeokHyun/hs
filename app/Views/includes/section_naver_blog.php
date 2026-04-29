<?php
/**
 * 네이버 블로그 리뷰 블록 (상세 페이지 공통)
 * @var array<int, array<string, mixed>> $blog_posts
 */
$blog_posts = $blog_posts ?? [];
if (empty($blog_posts)) {
    return;
}
?>
<div class="content-card">
  <h2 class="content-card-title">📝 네이버 블로그 리뷰</h2>
  <ul style="list-style:none; margin:0; padding:0; display:flex; flex-direction:column; gap:0;">
    <?php foreach ($blog_posts as $post): ?>
      <?php
        $postTitle = strip_tags($post['title'] ?? '');
        $postDesc  = strip_tags($post['description'] ?? '');
        $postLink  = $post['link'] ?? '#';
        $postDate  = isset($post['postdate'])
          ? substr((string) $post['postdate'], 0, 4) . '.' . substr((string) $post['postdate'], 4, 2) . '.' . substr((string) $post['postdate'], 6, 2)
          : '';
      ?>
      <li style="padding:14px 0; border-bottom:1px solid #F3F4F6;">
        <a href="<?= esc($postLink) ?>" target="_blank" rel="noopener noreferrer"
           style="display:block; font-size:15px; font-weight:700; color:#F97316; margin-bottom:5px; line-height:1.45; text-decoration:none;">
          <?= esc($postTitle) ?>
        </a>
        <?php if ($postDesc): ?>
          <p style="margin:0 0 6px; font-size:13px; color:#6B7280; line-height:1.65;
                     display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
            <?= esc($postDesc) ?>
          </p>
        <?php endif; ?>
        <?php if ($postDate): ?>
          <span style="font-size:12px; font-weight:600; color:#9CA3AF; background:#F9FAFB;
                       border:1px solid #E5E7EB; border-radius:999px; padding:2px 9px;">
            <?= esc($postDate) ?>
          </span>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
