<nav>
  <a href="index.php?ctrl=home&action=index"><strong>logo</strong></a>
  <a href="index.php?ctrl=user&action=createUser">Create account</a>
  <a href="index.php?ctrl=user&action=login">Login</a>
  <a href="index.php?ctrl=user&action=index">list users</a>

  <?php if (isset($_SESSION['user'])): ?>
    <p>Logged in as: <?= $_SESSION['user']['email'] ?></p>
    <a href="index.php?ctrl=user&action=logout">Logout</a>
  <?php endif; ?>

</nav>
