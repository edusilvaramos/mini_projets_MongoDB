<section class="main">
    <div class="">
        <div class="flex spaceAround latestPosts">
            <h2>Latest Posts</h2>
            <button class="button secondaryButton">Create Post</button>
        </div>
        <div class="flex spaceAround">
            <div class="flex spaceAround">
                <span>Sort by</span>
                <div class="sortingOptions">
                    <a href="?sort=recent" class="sortingButton">Newest</a>
                    <a href="?sort=views" class="sortingButton">Trending</a>
                    <a href="?sort=likes" class="sortingButton">Most Liked</a>
                    <a href="?sort=comments" class="sortingButton">Most Commented</a>
                </div>
            </div>
            <?php 
                if ($_GET['order'] === "decroissant"){
                    echo "<a href='?order=decroissant' class='thinButton tertiaryButton'>Ordre Décroissante</a>";
                }
                else  {
                    echo "<a href='?order=croissant' class='thinButton tertiaryButton'>Ordre Croissante</a>";
                }
            ?>
                
        </div>
        <div class="postsContainer">
            <?php 
                if (!empty($posts)){
                    foreach ($posts as $post) {
                        include __DIR__ . "/components/postPreview.php";
                    }
                }
                else {
                    echo "<p>Aucun post à voir ici</p>";
                }
            ?>
        </div>
    </div>
</section>
<aside>
    <section>
        <h2>Tags</h2>
        <div class="flex">
                <?php include __DIR__ . "/components/tags.php"; ?>
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