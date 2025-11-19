<h1>edit user</h1>
<form method="post" action="index.php?ctrl=user&action=update">
  {# <input type="hidden" name="_csrf" value="<?=$csrf?>"> #}
  <input type="hidden" name="id" value="<?=$user['_id']?>">
  <div>
    <label>First name</label>
    <input name="firstName" value="<?=htmlspecialchars($user['firstName'] ?? '')?>" required>
  </div>
  <div>
    <label>Last name</label>
    <input name="lastName" value="<?=htmlspecialchars($user['lastName'] ?? '')?>" required>
  </div>
  <div>
    <label>Email</label>
    <input type="email" name="email" value="<?=htmlspecialchars($user['email'] ?? '')?>" required>
  </div>
  <div>
    <label>Password </label>
    <input type="password" name="password" placeholder="keep empty to keep the current password">
  </div>
  <button>update</button>
</form>
