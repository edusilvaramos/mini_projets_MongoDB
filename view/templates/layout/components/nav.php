<nav>
    <div>
        <a href="index.php?ctrl=home&action=index">
        <img class="logo" alt="logo" src="assets/SVG/logo.svg" /></a>
        <h1>PteroTalk Forum</h1>
    </div>
     <?php if (!isset($_SESSION['user'])): ?>
      <div>
        <button class="button secondaryButton">Sign-up</button>
        <button class="button primaryButton"><a href="index.php?ctrl=user&action=login">Login</a></button>
        </div>
     <?php else: ?>
        <div>
            <button class="button primaryButton"><a href="index.php?ctrl=user&action=logout">Logout</a></button>
        </div>
    <?php endif; ?>
</nav>
    