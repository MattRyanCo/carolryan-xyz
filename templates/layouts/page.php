<?php
/**
 * Layout: "page" — title + content in the same photo background and
 * centred column as the home page. Used by inner pages (currently only
 * the 404 page).
 *
 * @var \CarolRyan\Site\Builder $builder
 * @var \CarolRyan\Site\Site $site
 * @var \CarolRyan\Site\Page $page
 */
?>
<!DOCTYPE html>
<html lang="<?= e($site->get('language')) ?>">
<head>
<?= $builder->renderTemplate('partials/head', ['page' => $page]) ?>
</head>
<body>
<main class="backdrop">
<div class="column">
<h1 class="title"><?= e($page->title) ?></h1>
<?= $page->content ?>
<?= $builder->renderTemplate('partials/footer') ?>
</div>
</main>
</body>
</html>
