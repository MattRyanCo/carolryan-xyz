<?php
/**
 * Copyright line at the bottom of every page. The year is the build year.
 *
 * @var \CarolRyan\Site\Site $site
 */
?>
<footer class="footer">
<p>Copyright © <?= date('Y') ?> · <?= e($site->get('name')) ?> · All Rights Reserved.</p>
</footer>
