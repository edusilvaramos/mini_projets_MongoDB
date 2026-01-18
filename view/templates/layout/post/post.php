<div class="postCard">
    <a href="index.php?ctrl=home&action=index">
        <div class="flex flexCenter marginBottom">
            <object class="rotate180" type="image/svg+xml" data="/projet/assets/SVG/arrow_right.svg"></object>
            <span class="thinText">Posted by <?= htmlspecialchars($post['author']['username'] ?? 'Unknown')?></span>
        </div>
    </a>
    <div class="postCard__top marginTop">
        <div class="userProfilePhoto"><?= htmlspecialchars(ucfirst($post['author']['username'][0]) ?? 'Unknown')?></div>
        <div class="">
            <span class="name"><?= htmlspecialchars($post['author']['username'] ?? 'Unknown author') ?></span></br>
            <span class="datePosted">
                <?= isset($post['createdAt']) ? $post['createdAt']->toDateTime()->format('d-m-Y') : "avant la création de l'univers" ?>
            </span>
        </div>
    </div> </br>
    <h1 class="postTitle"><?= htmlspecialchars($post["title"]) ?></h1>
    <p><?= nl2br(htmlspecialchars($post["content"])) ?></p>
    <div class="flex flexSpaceBetween">
        <div class="flex postCard__bottom">
            <div class="flex">
                <a href="index.php?ctrl=post&action=like&id=<?= $post['_id'] ?>">
                    <object type="image/svg+xml" data="/projet/assets/SVG/like_outline.svg"></object>
                    <span><?= htmlspecialchars($post["likes"]) ?> Likes</span>
                </a>
            </div>
            <div class="flex">
                <object type="image/svg+xml" data="/projet/assets/SVG/comment_outline.svg"></object>
                <span class="active"><?= htmlspecialchars((string) ($commentsCount ?? ($post["commentsCounter"] ?? 0))) ?> Comments</span>
            </div>
        </div>
        <a href="#comments">
            <div class="flex">
                <object type="image/svg+xml" data="/projet/assets/SVG/reply.svg"></object>
                <span>Reply</span>
            </div>
        </a>
    </div>
</div>
