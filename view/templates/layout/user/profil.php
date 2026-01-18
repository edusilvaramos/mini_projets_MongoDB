<div class="main">
    <h1>My profile</h1>

    <section class="profile">
        <div class="profile-info">
            <p><strong>Name:</strong>
                <?= htmlspecialchars($user->firstName . ' ' . $user->lastName) ?>
            </p>
            <p><strong>Username:</strong>
                <?= $user->username ?>
            </p>
            <p><strong>Email:</strong>
                <?= $user->email ?>
            </p>
        </div>
        <div class="profile-actions">

            <?php if ($_SESSION['user']['id'] == $user->id): ?>
                    <a href="index.php?ctrl=user&action=edit">
                    <button class="button primaryButton">
                        Edit my profile
                    </button>
                </a>
                <form action="index.php?ctrl=user&action=deleteSelf"
                    method="post"
                    onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                    <button type="submit" class="button primaryButton danger">
                        Delete my account
                    </button>
                    <?php endif; ?>
                </form>
        </div>
    </section>
</div>