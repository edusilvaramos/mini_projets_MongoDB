<div class="admin-user-profile">
    <h1>User profile: <?= htmlspecialchars($user->userName) ?></h1>
    <p class="subtitle">Admin view – statistics for this account.</p>

    <section>
        <h2>Summary</h2>
        <ul>
            <li>Posts created: <?= $globalStats['postsCount'] ?? 0 ?></li>
            <li>Comments written: <?= $globalStats['commentsCount'] ?? 0 ?></li>
            <li>Likes given: <?= $globalStats['likesGiven'] ?? 0 ?></li>
            <li>Likes received on own posts: <?= $globalStats['likesReceived'] ?? 0 ?></li>
        </ul>
    </section>

    <section>
        <h2>User Posts</h2>

        <?php if (empty($postsStats)): ?>
            <p>This user has not created any Posts yet.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Tags</th>
                        <th>Comments</th>
                        <th>Likes</th>
                        <th>Users involved</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($postsStats as $post): ?>
                        <tr>
                            <td><?= htmlspecialchars($post['title'] ?? '') ?></td>
                            <td><?= htmlspecialchars($post['category'] ?? '') ?></td>
                            <td>
                                <?php
                                $tags = $post['tags'] ?? [];
                                if (!empty($tags) && is_array($tags)) {
                                    echo htmlspecialchars(implode(', ', $tags));
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                            <td><?= $post['commentsCount'] ?? 0 ?></td>
                            <td><?= $post['likesCount'] ?? 0 ?></td>
                            <td><?= $post['participantsCount'] ?? 0 ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>
    </section>
      

    <p>
        <a href="index.php?ctrl=admin&action=userList" class="back-link">
            Back to user list
        </a>
    </p>
</div>
