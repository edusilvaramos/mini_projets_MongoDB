<div class="postCard">
    <div class="flex flexCenter marginBottom">
        <object class="rotate180" type="image/svg+xml" data="/projet/assets/SVG/arrow_right.svg"></object>
        <span class="thinText">Posted by John Smith</span>
    </div>
    <div class="postCard__top marginTop">
        <div class="userProfilePhoto">J</div>
        <div class="">
            <span class="name">name</span></br>
            <span class="datePosted"><?= date('d/m/Y H:i', strtotime($post["createdAt"] ?? 'now')) ?></span>
        </div>
    </div> </br>
    <h1 class="postTitle"><?= htmlspecialchars($post["title"]) ?></h1>
    <p><?= nl2br(htmlspecialchars($post["content"])) ?></p>
    <div class="flex flexSpaceBetween">
        <div class="flex postCard__bottom">
            <div class="flex">
                <object type="image/svg+xml" data="/projet/assets/SVG/like_outline.svg"></object>
                <span><?= htmlspecialchars($post["likes"]) ?> Likes</span>
            </div>
            <div class="flex">
                <object type="image/svg+xml" data="/projet/assets/SVG/comment_outline.svg"></object>
                <span class="active"><?= htmlspecialchars($post["commentsCounter"]) ?> Comments</span>
            </div>
        </div>
        <div class="flex">
            <object type="image/svg+xml" data="/projet/assets/SVG/reply.svg"></object>
            <span>Reply</span>
        </div>
    </div>
</div>