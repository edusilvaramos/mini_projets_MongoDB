<?php /*
TACHES
    -ajouter la premiere lettre du user dans le userProfilePhoto
    -ajouter infos du user
*/
?>

<div class="postCard">
    <div class="title">
        <h3 class="yourPostsTitle"><?= htmlspecialchars($post['title'])?></h3>
        <div class="flex ">
            <div class="userProfilePhoto smallUserProfilePhoto">J</div>
            <span>John Smith</span>
            <span class="datePosted"><?= isset($post['createdAt']) ? $post['createdAt']->toDateTime()->format('d-m-Y') : "avant la création de l'univers" ?></span>
        </div>
    </div>
    <p class="yourPostsContent"><?= nl2br(htmlspecialchars($post['content']))?></p>
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
            <span>Read more</span>
            <object type="image/svg+xml" data="/projet/assets/SVG/arrow_right.svg"></object>
        </div>
    </div>
</div>