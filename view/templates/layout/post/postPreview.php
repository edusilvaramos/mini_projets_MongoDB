<?php /*
TACHES
    -ajouter la premiere lettre du user dans le userProfilePhoto
    -ajouter infos du user
    -ajouter likes
*/
?>

<div class="postCard">
    <div class="postCard__top">
        <div class="userProfilePhoto">J</div>
        <div class="">
            <h1 class="postTitle"><?= htmlspecialchars($post['title'])?></h1>
            <h6>John Smith</h6>
        </div>
    </div>
    <p><?= nl2br(htmlspecialchars($post['content']))?></p>
    <div class="postCard__bottom flex">
        <div class="flex">  
        <form method="post" action="like.php">
            <input type="hidden" name="postId" value="<?= $post['_id'] ?>">
            <button type="submit">
                <object type="image/svg+xml" data="/projet/assets/SVG/like_outline.svg"></object>
                <?= $post['likes'] ?>
            </button>
        </form>
            
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