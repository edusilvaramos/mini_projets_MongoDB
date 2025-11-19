<div class="gridhome">
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
                    <button class="sortingButton">Newest</button>
                    <button class="sortingButton">Trending</button>
                    <button class="sortingButton">Most Liked</button>
                    <button class="sortingButton">Most Commented</button>
                </div>
            </div>
            <button class="thinButton tertiaryButton">Filter</button>
        </div>
        <div class="postsContainer">
            <?php include __DIR__ . "/../post/postPreview.php"; ?>
        </div>
    </div>
</section>
<aside>
    <section>
        <h2>Tags</h2>
        <div class="flex">
            <button class="thinButton tertiaryButton">Animals</button>
            <button class="thinButton tertiaryButton">Sports</button>
            <button class="thinButton tertiaryButton">Music</button>
            <button class="thinButton tertiaryButton">Movies</button>
            <button class="thinButton tertiaryButton">Programming</button>
            <button class="thinButton tertiaryButton">World Politics</button>
            <button class="thinButton tertiaryButton">Theater</button>
            <button class="thinButton tertiaryButton">Culture</button>
            <button class="thinButton tertiaryButton">Tech</button>
            <button class="thinButton tertiaryButton">Arts</button>
        </div>
    </section>
    <section>
        <h2>Recent Online Users</h2>
        <div class="flex recentOnlineUsers">
            <?php include __DIR__ . "/../user/onlineUsers.php"; ?>
            <?php include __DIR__ . "/../user/onlineUsers.php"; ?>

        </div>
    </section>
</aside>
</div>