<?php

// echo "<pre>";
// print_r($users);
// echo "</pre>";
?>

<h1>Espace admin – Statistiques simples</h1>

<form method="get" action="index.php" style="margin-bottom: 20px;">
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
            <option value="<?=  $id?>"
                <?= $id === $selectedUserId ? 'selected' : '' ?>>
                <?=  $label ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Voir</button>
</form>


<?php if (!$selectedUserId): ?>

    <p>Choisissez un utilisateur et cliquez sur "Voir".</p>

<?php else: ?>

    <h2>Statistiques pour cet utilisateur</h2>

    <p>Nombre de sujets : <strong> test</strong></p>
    <p>Nombre total de commentaires : <strong>test</strong></p>
    <?php // n de que ?? ?>
    <p>Nombre d'utilisateurs : <strong>test</strong></p>


    <hr>

    <h3>Liste des sujets</h3>

    <?php if (empty($topics)): ?>
        <p>Aucun sujet trouvé pour cet utilisateur.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Titre du sujet</th>
                    <th>Nombre de commentaires</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topics as $topic): ?>
                    <tr>
                        <td> title</td>
                        <td>n comment</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

<?php endif; ?>