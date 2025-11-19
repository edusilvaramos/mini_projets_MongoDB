<nav>
    <div>
        <a href="index.php?ctrl=home&action=index">
            <img class="logo" alt="logo" src="assets/SVG/logo.svg" /></a>
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
        <div>
            <button class="button primaryButton"><a href="index.php?ctrl=user&action=logout">Logout</a></button>
        </div>
    <?php endif; ?>
</nav>