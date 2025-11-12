<h1><?= htmlspecialchars($title ?? 'Posts') ?></h1>

<?php if (empty($posts)): ?>
  <p>Nenhum post ainda.</p>
<?php else: ?>
  <?php foreach ($posts as $p): ?>
    <article style="margin-bottom:1rem;border-bottom:1px solid #ddd;padding-bottom:1rem;">
     
     <p>todos os posts da app</p>
      </small>
    </article>
  <?php endforeach; ?>
<?php endif; ?>
