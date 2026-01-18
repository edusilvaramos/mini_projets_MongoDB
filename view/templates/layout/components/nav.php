<nav>
    <div>
        <a href="index.php?ctrl=home&action=index">
            <img class="logo" alt="logo" src="assets/SVG/logo.svg" />
        </a>
        <h1>PteroTalk Forum</h1>
    </div>

    <div class="flex spaceBetween">
        <a href="index.php?ctrl=home&action=index">
            <button class="button tertiaryButton">Home</button>
        </a>
        <a href="index.php?ctrl=post&action=listPosts&sort=recent&order=descending&category=all">
            <button class="button tertiaryButton">Posts</button>
        </a>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="index.php?ctrl=post&action=create">
                <button class="button primaryButton">Create Post</button>
            </a>
        <?php endif; ?>
        <?php if (isset($_SESSION['user']) && (($_SESSION['user']['role']) === 'ROLE_ADMIN')): ?>
            <a href="index.php?ctrl=admin&action=userList">
                <button class="button secondaryButton">Users</button>
            </a>
            <a href="index.php?ctrl=admin&action=features">
                <button class="button secondaryButton">Features</button>
            </a>
        <?php endif; ?>
    </div>

    <?php if (!isset($_SESSION['user'])): ?>
        <div>
            <a href="index.php?ctrl=user&action=createUser">
                <button class="button secondaryButton">Sign-up</button>
            </a>
            <a href="index.php?ctrl=user&action=login">
                <button class="button primaryButton">Login</button>
            </a>
        </div>

    <?php else: ?>
        <div class="flex spaceBetween">
            <div class="conectedUser">
                <img
                    class="logo"
                    alt="logo"
                    id="avatarUserConnected"
                    src="assets/images/avatar.jpg" />
                <div id="Userdropdown">
                    <a href="index.php?ctrl=user&action=profil">Profil</a>
                    <hr>
                    <a href="index.php?ctrl=user&action=logout" class="logout-link">Logout</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

</nav>
