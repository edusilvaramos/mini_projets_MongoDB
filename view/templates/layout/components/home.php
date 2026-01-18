<?php
    $currentOrder = $order ?? 'descending';
    $nextOrder = ($currentOrder === 'ascending') ? 'descending' : 'ascending';
?>

<body class="gridBody">
    <section class="main">
        <div class="">
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
                        <a class="sortingButton" href="index.php?ctrl=post&action=listPosts&sort=recent&order=<?= $currentOrder ?>">Newest</a>
                        <a class="sortingButton" href="index.php?ctrl=post&action=listPosts&sort=views&order=<?= $currentOrder ?>">Trending</a>
                        <a class="sortingButton" href="index.php?ctrl=post&action=listPosts&sort=liked&order=<?= $currentOrder ?>">Most Liked</a>
                        <a class="sortingButton" href="index.php?ctrl=post&action=listPosts&sort=comments&order=<?= $currentOrder ?>">Most Commented</a>
                    </div>
                </div>
                <a href="index.php?ctrl=post&action=listPosts&sort=<?= $sort ?>&order=<?= $nextOrder ?>" class="thinButton tertiaryButton">
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
    </section>
    <aside>
        <section>
            <h2>Tags</h2>
            <div class="flex">
                    <?php include __DIR__ . "/tags.php"; ?>
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
</body>