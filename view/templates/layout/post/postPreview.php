<div class="postCard">
    <div class="postCard__top">
        <div class="userProfilePhoto"><?= htmlspecialchars(ucfirst($post['author']['username'][0]) ?? 'Unknown')?></div>
        <div class="">
            <a href="index.php?ctrl=post&action=show&id=<?= (string)$post['_id'] ?>">
                <h1 class="postTitle"><?= htmlspecialchars($post['title'])?></h1>
            </a>
            <h6><?= htmlspecialchars($post['author']['username'] ?? 'Unknown author') ?></h6>
        </div>
    </div>
    <p><?= htmlspecialchars(substr($post['content'], 0, 180))?>...</p>
    <div class="postCard__bottom flex">
        
        <div class="flex">
            <object type="image/svg+xml" data="/projet/assets/SVG/like_outline.svg"></object>
            <?= $post['likes'] ?>
        </div>
        <div class="flex">
            <object type="image/svg+xml" data="/projet/assets/SVG/comment_outline.svg"></object>
            <span><?=$post['commentsCounter']?></span>
        </div>
        <div class="flex">
            <div class="userProfilePhoto smallUserProfilePhoto">J</div>
            <span><?= isset($post['createdAt']) ? $post['createdAt']->toDateTime()->format('d-m-Y') : "avant la création de l'univers" ?></span>
        </div>
    </div>
</div>