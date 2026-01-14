<?php if (isset($_SESSION['user'])): ?>

  <div class="admin-page">

    <div class="admin-actions">
      <h1 class="admin-title">Utilisateurs</h1>

      <div style="display: flex; gap: 1rem;">
        <a
          href="index.php?ctrl=user&action=createUser"
          class="button secondaryButton link-as-button">
          Créer un utilisateur
        </a>
        <a
          href="index.php?ctrl=admin&action=features"
          class="button secondaryButton link-as-button"
          style="background: #474747; color: white;">
          Fonctionnalités du projet
        </a>
      </div>
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
                    href="index.php?ctrl=admin&action=userProfile&id=<?= $u->id ?>"
                    class="button thinButton secondaryButton link-as-button">
                    Voir le profil

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

    
    <div class="global-stats" style="margin-top: 2rem; padding: 1.5rem; background: #f5f5f5; border-radius: 8px;">
      <h2 >Statistiques globales</h2>
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
        <div  >
           <div>
            <?= $globalStats['totalUsers'] ?? 0 ?>
          </div>
           <div>Utilisateurs</div>
        </div>
        <div  >
           <div>
            <?= $globalStats['totalPosts'] ?? 0 ?>
          </div>
           <div >Posts</div>
        </div>
        <div  >
           <div>
            <?= $globalStats['totalComments'] ?? 0 ?>
          </div>
           <div >Commentaires</div>
        </div>
        <div  >
           <div>
            <?= $globalStats['totalLikes'] ?? 0 ?>
          </div>
           <div >Likes</div>
        </div>
      </div>
    </div>

  </div>

<?php else: ?>

  <div class="admin-page">
    <p class="notice notice-error">You need permissions to see this page.</p>
  </div>
  

<?php endif; ?>