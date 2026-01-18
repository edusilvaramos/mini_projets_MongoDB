<?php ?>

</br>
<div class="gridhome">
    <main class="main">
        <div class="postsContainer">
            <?php include __DIR__ . "/post.php";?>
            <h2>Comments</h2>
            <div class="postCard">
                <h3 class="leaveComment">Leave a Comment</h3>
                <?php include __DIR__ . "/../comment/leaveCommentForm.php";?>
            </div>
            <div id="comments" class="commentContainer postsContainer">
                <div class="commentContainer">
                <?php if (!empty($comments ?? [])) : ?>
                    <?php foreach ($comments as $comment) : ?>
                        <?php
                            $createdAt = $comment['createdAt'] ?? null;
                            if ($createdAt instanceof MongoDB\BSON\UTCDateTime) {
                                $createdAt = $createdAt->toDateTime()->format('d-m-Y H:i');
                            } elseif (is_array($createdAt) && isset($createdAt['$date']['$numberLong'])) {
                                $createdAt = date('d-m-Y H:i', ((int) $createdAt['$date']['$numberLong']) / 1000);
                            } else {
                                $createdAt = '';
                            }

                            $uid = $comment['userId'] ?? null;
                            if ($uid instanceof MongoDB\BSON\ObjectId) {
                                $uid = (string) $uid;
                            } elseif (is_array($uid) && isset($uid['$oid'])) {
                                $uid = (string) $uid['$oid'];
                            } else {
                                $uid = (string) $uid;
                            }
                            $username = isset($usersById[$uid]) ? ($usersById[$uid]->username ?? 'Anonymous') : 'Anonymous';
                        ?>
                        <div class="postCard">
                            <div class="postCard__top comments">
                                <div class="">
                                    <span class="name"><?= htmlspecialchars((string) $username) ?></span></br>
                                    <span class="datePosted"><?= htmlspecialchars($createdAt) ?></span>
                                </div>
                            </div>
                            <p><?= htmlspecialchars((string) ($comment['content'] ?? '')) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No comments yet.</p>
                <?php endif; ?>

                </div>
            </div> 
        </div>
    </main>
    <aside>
        <section>
            <h2>Recent Posts</h2>
            <div class="postsContainer">
                <?php 
                    if (empty($recentPosts)){
                        echo "<p>No posts to see here</p>";
                    }
                    else {
                        $limit = min(5, count($recentPosts));
                        for ($i = 0; $i < $limit; $i++) {
                            $recentPost = $recentPosts[$i];
                            include __DIR__ . "/../post/postPreview.php";
                        }
                    }
                ?>
            </div>
            <a href="index.php?ctrl=home&action=index" class="flex blueLink">
                View more
                <object type="image/svg+xml" data="/projet/assets/SVG/arrow_right_blue.svg"></object>
            </a>
        </section>
        <section>
            <h2>Recent Online Users</h2>
            <div class="flex recentOnlineUsers">
                <?php 
                    include __DIR__ . "/../user/onlineUsers.php";
                ?>
            </div>
        </section>
    </aside>
</div>
