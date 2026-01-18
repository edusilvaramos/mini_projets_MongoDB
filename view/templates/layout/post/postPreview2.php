<?php /*
TACHES
    -ajouter la premiere lettre du user dans le userProfilePhoto
    -ajouter infos du user
*/
?>

<div class="postCard">
    <div class="title">
        <a href="index.php?ctrl=post&action=show&id=<?= (string)$recentPost['_id'] ?>">
            <h3 class="yourPostsTitle"><?= htmlspecialchars($recentPost['title'])?></h3>
        </a>
        <div class="flex">
            <div class="userProfilePhoto smallUserProfilePhoto"><?= htmlspecialchars(ucfirst($post['author']['username'][0]) ?? 'Unknown')?></div>
            <span><?= htmlspecialchars($recentPost['author']['username'] ?? 'Unknown author') ?></span>
            <span class="datePosted"><?= isset($recentPost['createdAt']) ? $recentPost['createdAt']->toDateTime()->format('d-m-Y') : "avant la création de l'univers" ?></span>
        </div>
    </div>
    <p class="yourPostsContent"><?= htmlspecialchars(substr($post['content'], 0, 180))?>...</p>
    <div class="flex flexSpaceBetween">
        <div class="flex postCard__bottom">
            <div class="flex">
                <object type="image/svg+xml" data="/projet/assets/SVG/like_outline.svg"></object>
                <span><?=$recentPost['likes']?></span>
            </div>
            <div class="flex">
                <object type="image/svg+xml" data="/projet/assets/SVG/comment_outline.svg"></object>
                <span class="active"><?=$recentPost['commentsCounter']?></span>
            </div>
        </div>
        <div class="flex">
            <a href="index.php?ctrl=post&action=show&id=<?= (string)$recentPost['_id'] ?>">
            <span>Read more</span>
            </a>
            
            <object type="image/svg+xml" data="/projet/assets/SVG/arrow_right.svg"></object>
        </div>
    </div>
</div>