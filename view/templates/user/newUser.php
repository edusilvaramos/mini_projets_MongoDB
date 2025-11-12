<h1>Novo usuário</h1>
<form method="post" action="index.php?ctrl=user&action=newUser">
  <input type="hidden" name="_csrf" value="<?=$csrf?>">
  <div>
    <label>First name</label>
    <input name="firstname" required>
  </div>
  <div>
    <label>Last name</label>
    <input name="lastName" required>
  </div>
  <div>
    <label>Email</label>
    <input type="email" name="email" required>
  </div>
  <div>
    <label>Password</label>
    <input type="password" name="password" required>
  </div>
  <button>create</button>
</form>
