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
                        <a class="sortingButton" href="index.php?ctrl=post&action=listPosts&sort=recent&order=<?= $currentOrder ?>&category=<?= $category ?>">Newest</a>
                        <a class="sortingButton" href="index.php?ctrl=post&action=listPosts&sort=views&order=<?= $currentOrder ?>&category=<?= $category ?>">Trending</a>
                        <a class="sortingButton" href="index.php?ctrl=post&action=listPosts&sort=liked&order=<?= $currentOrder ?>&category=<?= $category ?>">Most Liked</a>
                        <a class="sortingButton" href="index.php?ctrl=post&action=listPosts&sort=comments&order=<?= $currentOrder ?>&category=<?= $category ?>">Most Commented</a>
                    </div>
                </div>
                <a href="index.php?ctrl=post&action=listPosts&sort=<?= $sort ?>&order=<?= $nextOrder ?>&category=<?= $category ?>" class="thinButton tertiaryButton">
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
                <a class="thinButton tertiaryButton" href="index.php?ctrl=post&action=listPosts&sort=<?= $sort?>&order=<?= $currentOrder ?>&category=announcement">Announcement</a>
                <a class="thinButton tertiaryButton" href="index.php?ctrl=post&action=listPosts&sort=<?= $sort?>&order=<?= $currentOrder ?>&category=backend">Backend</a>
                <a class="thinButton tertiaryButton" href="index.php?ctrl=post&action=listPosts&sort=<?= $sort?>&order=<?= $currentOrder ?>&category=frontend">Frontend</a>
                <a class="thinButton tertiaryButton" href="index.php?ctrl=post&action=listPosts&sort=<?= $sort?>&order=<?= $currentOrder ?>&category=offtopic">Off topic</a>
                <a class="thinButton tertiaryButton" href="index.php?ctrl=post&action=listPosts&sort=<?= $sort?>&order=<?= $currentOrder ?>&category=devops">Devops</a>
                <a class="thinButton tertiaryButton" href="index.php?ctrl=post&action=listPosts&sort=<?= $sort?>&order=<?= $currentOrder ?>&category=feedback">Feedback</a>
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