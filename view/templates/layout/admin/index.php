<div class="admin-page">

    <h1 class="admin-title">Espace admin – Statistiques simples</h1>
    <a href="index.php?ctrl=admin&action=userList">
        <button class="button secondaryButton thinButton">Users</button>
    </a>

    <form method="get" action="index.php">
        <input type="hidden" name="ctrl" value="admin">
        <input type="hidden" name="action" value="index">

        <label for="userId">Utilisateur :</label>
        <select name="userId" id="userId">
            <option value="">-- choisir un utilisateur --</option>

            <?php foreach ($users as $user): ?>
                <?php
                $id = $user->id;
                $label = $user->userName ?: $user->email;
                ?>
                <option value="<?= $id ?>" <?= $id === $selectedUserId ? 'selected' : '' ?>>
                    <?= htmlspecialchars($label) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="button primaryButton thinButton">Voir</button>
    </form>

    <?php if (!$selectedUserId): ?>

        <p class="notice">Choisissez un utilisateur et cliquez sur "Voir".</p>

    <?php else: ?>

        <h2>Statistiques pour cet utilisateur</h2>

        <p>Nombre de sujets : <strong>test</strong></p>
        <p>Nombre total de commentaires : <strong>test</strong></p>
        <p>Nombre d'utilisateurs : <strong>test</strong></p>

        <h3>Liste des sujets</h3>

        <?php if (empty($topics)): ?>
            <p class="notice">Aucun sujet trouvé pour cet utilisateur.</p>
        <?php else: ?>
            <table class="simple-table">
                <thead>
                    <tr>
                        <th>Titre du sujet</th>
                        <th>Nombre de commentaires</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($topics as $topic): ?>
                        <tr>
                            <td>title</td>
                            <td>n comment</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    <?php endif; ?>

</div>