<h1>users</h1>
<p><a href="index.php?ctrl=user&action=createUser">new</a></p>

<table>
  <thead>
    <tr>
      <th>name</th>
      <th>last name</th>
      <th>Email</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $u): ?>
      <tr>
        <td><?= htmlspecialchars($u['firstname'] ?? '') ?></td>
        <td><?= htmlspecialchars($u['lastName'] ?? '') ?></td>
        <td><?= htmlspecialchars($u['email'] ?? '') ?></td>
        <td>
          <a href="index.php?ctrl=user&action=edit&id=<?= $u['_id'] ?>">edit</a>
          <form action="index.php?ctrl=user&action=delete" method="post" style="display:inline">
            <input type="hidden" name="_csrf" value="<?= $_SESSION['_csrf'] ?? '' ?>">
            <input type="hidden" name="id" value="<?= $u['_id'] ?>">
            <button>delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>