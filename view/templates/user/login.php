<h1>Login</h1>
<form method="post" action="index.php?ctrl=user&action=login">

<div>
    <label>Email</label>
    <input type="email" name="email" required>
  </div>
  <div>
    <label>Password</label>
    <input type="password" name="password" required>
  </div>
  <button>Login</button>

</form>
<?php if (isset($error)): ?>
<P><?= $error ?></P>
<?php endif; ?>