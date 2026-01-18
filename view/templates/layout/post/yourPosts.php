<div class="postCard">
    <div class="title">
        <a href="index.php?ctrl=post&action=show&id=<?= (string)$userPost['_id'] ?>">
            <h3 class="yourPostsTitle"><?=$userPost['title']?></h3>
        </a>
        <div class="flex ">
            <span class="datePosted"><?= $userPost['createdAt']->toDateTime()->format('d/m/Y') ?></span>
        </div>
    </div>
    <p class="yourPostsContent"><?=$userPost['content']?></p>
    <div class="flex flexSpaceBetween">
        <div class="flex postCard__bottom">
            <div class="flex">
                <object type="image/svg+xml" data="/projet/assets/SVG/like_outline.svg"></object>
                <span><?= $userPost['likes'] ?></span>
            </div>
            <div class="flex">
                <object type="image/svg+xml" data="/projet/assets/SVG/comment_outline.svg"></object>
                <span class="active"><?= $userPost['commentsCounter'] ?></span>
            </div>
        </div>
        
    </div>
</div>