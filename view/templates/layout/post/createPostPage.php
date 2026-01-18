</br>
<div class="gridhome">
    <main class="main">
        <div class="">
            <h2>Create Post</h2>
            <?php include __DIR__ . "/createPostForm.php";?>
    </main>
    <aside>
        <section>
            <h2>Your Posts</h2>
            <div class="postsContainer">
            <?php 
                foreach ($userPosts as $userPost) {
                    include __DIR__ . "/yourPosts.php";
                }
            ?>
            </div>
        </section>
        <section>
            <h2>Recent Online Users</h2>
            <div class="flex recentOnlineUsers">
                <?php include __DIR__ . "/../user/onlineUsers.php";?>
                <?php include __DIR__ . "/../user/onlineUsers.php";?>
            </div>
        </section>
    </aside>
</div>