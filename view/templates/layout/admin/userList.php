<?php if (isset($_SESSION['user'])): ?>

  <div class="admin-page">

    <div class="admin-actions">
      <h1 class="admin-title">Utilisateurs</h1>

      <a
        href="index.php?ctrl=user&action=createUser"
        class="button secondaryButton link-as-button">
        Créer un utilisateur
      </a>
    </div>

    <?php if (empty($users)): ?>

      <p class="notice">Aucun utilisateur trouvé.</p>

    <?php else: ?>

      <table class="simple-table">
        <thead>
          <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $u): ?>
            <tr>
              <td><?= $u->firstName ?></td>
              <td><?= $u->lastName ?></td>
              <td><?= $u->email ?></td>
              <td>
                <div class="table-actions">
                   <a
                    href="index.php?ctrl=user&action=profil&id=<?= $u->id ?>"
                    class="button thinButton secondaryButton link-as-button">
                    Voir
                  </a>
                  <a
                    href="index.php?ctrl=admin&action=adminEdit&id=<?= $u->id ?>"
                    class="button thinButton secondaryButton link-as-button">
                    Éditer
                  </a>

                  <form
                    action="index.php?ctrl=admin&action=adminDelete"
                    method="post"
                    style="display:inline"
                    onsubmit="return confirm('Supprimer cet utilisateur ?');">
                    <input type="hidden" name="id" value="<?= $u->id ?>">
                    <button class="button thinButton primaryButton" type="submit">
                      Supprimer
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    <?php endif; ?>

  </div>

<?php else: ?>

  <div class="admin-page">
    <p class="notice notice-error">You need permissions to see this page.</p>
  </div>

<?php endif; ?>