<?php /*
TACHES
    -ajouter la premiere lettre du user dans le userProfilePhoto
    -ajouter infos du user
*/
?>

<div class="postCard">
    <div class="title">
        <a href="index.php?ctrl=post&action=show&id=<?= (string)$post['_id'] ?>">
            <h3 class="yourPostsTitle"><?= htmlspecialchars($post['title'])?></h3>
        </a>
        <div class="flex">
            <div class="userProfilePhoto smallUserProfilePhoto"><?= htmlspecialchars(ucfirst($post['author']['username'][0]) ?? 'Unknown')?></div>
            <span><?= htmlspecialchars($post['author']['username'] ?? 'Unknown author') ?></span>
            <span class="datePosted"><?= isset($post['createdAt']) ? $post['createdAt']->toDateTime()->format('d-m-Y') : "avant la création de l'univers" ?></span>
        </div>
    </div>
    <p class="yourPostsContent"><?= htmlspecialchars(substr($post['content'], 0, 180))?>...</p>
    <div class="flex flexSpaceBetween">
        <div class="flex postCard__bottom">
            <div class="flex">
                <object type="image/svg+xml" data="/projet/assets/SVG/like_outline.svg"></object>
                <span><?=$post['likes']?></span>
            </div>
            <div class="flex">
                <object type="image/svg+xml" data="/projet/assets/SVG/comment_outline.svg"></object>
                <span class="active"><?=$post['commentsCounter']?></span>
            </div>
        </div>
        <div class="flex">
            <a href="index.php?ctrl=post&action=show&id=<?= (string)$post['_id'] ?>">
            <span>Read more</span>
            </a>
            
            <object type="image/svg+xml" data="/projet/assets/SVG/arrow_right.svg"></object>
        </div>
    </div>
</div>