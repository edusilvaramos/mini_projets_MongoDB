<?php
$user = $_SESSION['user'] ?? null;
?>

<div class="main">
    <?php if ($user): ?>
        <h1>My profile</h1>

        <section class="profile">
            <div class="profile-info">
                <p><strong>Name:</strong>
                    <?= htmlspecialchars($user['firstName'] . ' ' . $user['lastName']) ?>
                </p>
                <p><strong>Username:</strong>
                    <?= htmlspecialchars($user['userName']) ?>
                </p>
                <p><strong>Email:</strong>
                    <?= htmlspecialchars($user['email']) ?>
                </p>
            </div>

            <div class="profile-actions">
                <a href="index.php?ctrl=user&action=edit">
                    <button class="button primaryButton">
                        Edit my profile
                    </button>
                </a>

                <form action="index.php?ctrl=user&action=delete"
                      method="post"
                      onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                    <button type="submit" class="button primaryButton danger">
                        Delete my account
                    </button>
                </form>
            </div>
        </section>

    <?php else: ?>
        <h1>My profile</h1>
        <p>You are not logged in.</p>
        <a href="index.php?ctrl=security&action=login">
            <button class="button primaryButton">
                Log in
            </button>
        </a>
    <?php endif; ?>
</div>
