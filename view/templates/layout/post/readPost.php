<?php
require __DIR__ . '/../comment/comment.php';
?>

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
                <?php 
                    /*.*var_dump(array_keys($comments));
                    
                    function renderComments($comments, $usersById, $parentId = null) {
                        if (!isset($comments[$parentId])) return;
                
                        foreach ($comments[$parentId] as $comment) {
                            $author = $usersById[$comment['authorId']] ?? ['firstName'=>'Anonymous','lastName'=>''];
                            $authorName = htmlspecialchars($author['firstName'] . ' ' . $author['lastName']);
                            $timestamp = dateToTimestamp($comment['createdAt']);
                
                            //$author = $usersById[(string) $comment['userId']];
                            include __DIR__ . '/../comment/comment.php';
                        
                            // recursive call for replies
                            renderComments($comments, $usersById, oidToString($comment['_id']));
                        }
                    }

                    renderComments($nestedComments, $usersById);*/
                ?>

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
                        for ($i = 0; $i < 5; $i++) {
                            $recentPost = $recentPosts[$i];
                            include __DIR__ . "/../post/postPreview2.php";
                        }
                        foreach ($recentPosts as $index => $recentPost) {
                            
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