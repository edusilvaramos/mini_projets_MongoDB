<?php
    $currentOrder = $order ?? 'descending';
    $nextOrder = ($currentOrder === 'ascending') ? 'descending' : 'ascending';
?>
</br>
<div class="gridhome">
    <main class="main">
        <div>
            <div class="flex spaceAround latestPosts">
                <h2>Latest Posts</h2>
                <a class="button secondaryButton" href="index.php?ctrl=post&action=create">
                    Create Post
                </a>
            </div>
            <div class="flex spaceAround">
                <div class="flex spaceAround">
                    <span>Sort by</span>
                    <div class="sortingOptions">
                        <a class="sortingButton" href="index.php?ctrl=post&action=listPosts&sort=recent&order=<?= $currentOrder ?>&tag=<?= $tag ?>">Newest</a>
                        <a class="sortingButton" href="index.php?ctrl=post&action=listPosts&sort=views&order=<?= $currentOrder ?>&tag=<?= $tag ?>">Trending</a>
                        <a class="sortingButton" href="index.php?ctrl=post&action=listPosts&sort=liked&order=<?= $currentOrder ?>&tag=<?= $tag ?>">Most Liked</a>
                        <a class="sortingButton" href="index.php?ctrl=post&action=listPosts&sort=comments&order=<?= $currentOrder ?>&tag=<?= $tag ?>">Most Commented</a>
                    </div>
                </div>
                <a href="index.php?ctrl=post&action=listPosts&sort=<?= $sort ?>&order=<?= $nextOrder ?>&tag=<?= $tag ?>" class="thinButton tertiaryButton">
                    <?= ucfirst($currentOrder); ?> Order
                </a>

            </div>
            <div class="postsContainer">
                <?php
                    if (empty($posts)){
                        echo "<p>No posts to see here</p>";
                    }
                    else {
                        foreach ($posts as $index => $post) {
                            include __DIR__ . "/../post/postPreview.php";
                        }
                    }
                ?>
            </div>
        </div>
    </main>
    <aside class="aside">
        <section>
            <h2>Categories</h2>
            <div class="flex">
                <a class="thinButton tertiaryButton" href="index.php?ctrl=post&action=listPosts&sort=<?= $sort?>&order=<?= $currentOrder ?>&tag=announcement">Announcement</a>
                <a class="thinButton tertiaryButton" href="index.php?ctrl=post&action=listPosts&sort=<?= $sort?>&order=<?= $currentOrder ?>&tag=backend">Backend</a>
                <a class="thinButton tertiaryButton" href="index.php?ctrl=post&action=listPosts&sort=<?= $sort?>&order=<?= $currentOrder ?>&tag=frontend">Frontend</a>
                <a class="thinButton tertiaryButton" href="index.php?ctrl=post&action=listPosts&sort=<?= $sort?>&order=<?= $currentOrder ?>&tag=offtopic">Off topic</a>
                <a class="thinButton tertiaryButton" href="index.php?ctrl=post&action=listPosts&sort=<?= $sort?>&order=<?= $currentOrder ?>&tag=devops">Devops</a>
                <a class="thinButton tertiaryButton" href="index.php?ctrl=post&action=listPosts&sort=<?= $sort?>&order=<?= $currentOrder ?>&tag=feedback">Feedback</a>
            </div>
        </section>
        <section>
            <h2>Recent Online Users</h2>
            <div class="flex recentOnlineUsers">
                <?php 
                    if (!empty($onlineUsers)){
                        foreach ($users as $user) {
                            include __DIR__ . "/components/onlineUsers.php";
                        }
                    }
                    else {
                        echo "<p>Aucune personne à voir ici</p>";
                    }
                ?>
            </div>
        </section>
    </aside>
</div>