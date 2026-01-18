<body class="gridBody">
    <section class="main">
            <div class="postsContainer">
                <?php include __DIR__ . "/post.php";?>
                <h2>Comments</h2>
                <div class="postCard">
                    <h3 class="leaveComment">Leave a Comment</h3>
                    <?php include __DIR__ . "../comment/leaveCommentForm.php";?>
                </div>
                <div id="comments" class="commentContainer postsContainer">
                    <div class="commentContainer">
                        <?php include __DIR__ . "/components/comment.php";?>
                    </div>
                </div> 
            </div>
    </section>
    <aside>
        <section>
            <h2>Recent Posts</h2>
            <div class="postsContainer">
                <?php include __DIR__ . "/components/postPreview2.php";?>
            </div>
            <a href="#" class="flex blueLink">
                View more
                <object type="image/svg+xml" data="/projet/assets/SVG/arrow_right_blue.svg"></object>
            </a>
        </section>
        <section>
            <h2>Recent Online Users</h2>
            <div class="flex recentOnlineUsers">
                <?php include __DIR__ . "/components/onlineUsers.php";?>
            </div>
        </section>
    </aside>
</body>
</html>