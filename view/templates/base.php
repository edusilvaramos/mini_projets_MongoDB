<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'PteroTalk Forum' ?></title>
    <link href="assets/styles/reset.css" rel="stylesheet" />
    <link href="assets/styles/styles.css" rel="stylesheet" />
    <link href="assets/styles/typo.css" rel="stylesheet" />
</head>
<body>
    <?php include __DIR__ . '/layout/components/nav.php'; ?>

    <!-- content da view -->
    <?= $content ?? '' ?>

</body>
</html>
