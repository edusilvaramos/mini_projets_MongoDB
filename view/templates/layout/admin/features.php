<div class="admin-page">
  
  <div class="flex spaceAround">
    <h1>Fonctionnalités du système</h1>
    <a href="index.php?ctrl=admin&action=userList" class="button secondaryButton link-as-button">
      Retour
    </a>
  </div>

  <p><strong>Note:</strong> Page dédiée au professeur pour visualiser l'avancement du projet.</p>

  <div>
    <h3>Ajouter une fonctionnalité</h3>
    <form action="index.php?ctrl=admin&action=featureCreate" method="POST">
      <div>
        <label>Nom</label>
        <input type="text" name="name" required>
      </div>
      <div>
        <label>Description</label>
        <input type="text" name="description" required>
      </div>
      <div>
        <label>Auteur</label>
        <input type="text" name="author">
      </div>
      <div>
        <label>Catégorie</label>
        <select name="category" required>
          <option value="" disabled selected>Choisir une catégorie</option>
          <option value="expected_not_developed">Attendues dans le sujet</option>
          <option value="personal">Fonctionnalités personnelles</option>
        </select>
      </div>
      <div>
        <label>Statut</label>
        <select name="status">
          <option value="Non développée">Non développée</option>
          <option value="Partielle">Partielle</option>
          <option value="Finalisée">Finalisée</option>
        </select>
      </div>
      <button type="submit" class="button primaryButton">Ajouter</button>
    </form>
  </div>

  <table class="simple-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Fonctionnalité</th>
        <th>Description</th>
        <th>Auteur</th>
        <th>Catégorie</th>
        <th>Statut</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($features as $feature): ?>
        <tr <?php if ($feature['name'] === 'Ajouter une fonctionnalité') echo 'style="background-color: #e0e0e0;"'; ?>>
          <td><?= $feature['id'] ?></td>
          <td><?= htmlspecialchars($feature['name']) ?></td>
          <td><?= htmlspecialchars($feature['description']) ?></td>
          <td><?= htmlspecialchars($feature['author']) ?></td>
          <td><?= htmlspecialchars($feature['category'] ?? '-') ?></td>
          <td><?= htmlspecialchars($feature['status']) ?></td>
          <td>
            <form action="index.php?ctrl=admin&action=featureDelete" method="POST" 
                  onsubmit="return confirm('Supprimer ?');">
              <input type="hidden" name="id" value="<?= $feature['id'] ?>">
              <button type="submit" class="button thinButton primaryButton">
                Supprimer
              </button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
