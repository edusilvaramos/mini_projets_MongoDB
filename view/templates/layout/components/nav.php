<nav>
    <div>
        <a href="index.php?ctrl=home&action=index">
            <img class="logo" alt="logo" src="assets/SVG/logo.svg" />
        </a>
        <h1>PteroTalk Forum</h1>
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
            <a href="index.php?ctrl=user&action=newPost">
                <button class="button primaryButton">Create Post</button>
            </a>
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