<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($title ?? 'App', ENT_QUOTES) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>

  </style>
</head>
<body>
  <?php include __DIR__ . '/header.php'; ?>

  <main>
    <?php include $contentView; ?>
  </main>

  <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
