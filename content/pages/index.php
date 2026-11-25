<?php
/**
 * Home page — the link tree.
 *
 * Text and links live in config/site.php under 'home', so most edits
 * don't need this file. Styles: assets/css/style.css.
 *
 * @var \CarolRyan\Site\Builder $builder
 * @var \CarolRyan\Site\Site $site
 * @var \CarolRyan\Site\Page $page
 */
$page->documentTitle = $site->get('home.document_title');
$page->layout = 'landing';
$page->description = $site->get('home.short_description');
?>
<main class="backdrop">
<div class="column">
<h1 class="title"><?= e($site->get('home.heading')) ?></h1>
<p class="tagline"><?= e($site->get('home.tagline')) ?></p>

<?php if ($social = $site->get('home.social', [])): ?>
<ul class="social">
<?php foreach ($social as $link): ?>
<li><a href="<?= e($site->url($link['url'])) ?>"<?= link_attrs($link['url']) ?>><?= $builder->renderTemplate('partials/icons/' . $link['icon']) ?><span class="visually-hidden"><?= e($link['label']) ?></span></a></li>
<?php endforeach ?>
</ul>
<?php endif ?>

<ul class="buttons">
<?php foreach ($site->get('home.links', []) as $link): ?>
<li><a class="button" href="<?= e($site->url($link['url'])) ?>"<?= link_attrs($link['url']) ?>><?= e($link['label']) ?></a></li>
<?php endforeach ?>
</ul>

<?= $builder->renderTemplate('partials/footer') ?>
</div>
</main>
