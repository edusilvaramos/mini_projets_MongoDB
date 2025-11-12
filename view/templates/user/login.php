<h1>Login</h1>
<form method="post" action="index.php?ctrl=user&action=login">
  <input type="hidden" name="_csrf" value="<?=$csrf?>">
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
