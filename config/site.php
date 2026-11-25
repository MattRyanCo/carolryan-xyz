<?php

declare(strict_types=1);

/**
 * Site configuration — the one place for names, links and menus.
 *
 * Everything here is available in templates and content files via
 * $site->get('key') / $site->get('nested.key'). See docs/CONTENT.md.
 */
return [
    'name' => 'CarolRyan.xyz',
    'language' => 'en-US',

    // Absolute URL of the published site, no trailing slash. Used for
    // canonical links, robots.txt and sitemap.xml. The GitHub Actions
    // workflow overrides this automatically with the real Pages URL
    // (currently https://carolryan.xyz — see docs/DEPLOYMENT.md).
    'site_url' => 'https://carolryan.xyz',

    // Path prefix the site is served under. "/" for local preview or a
    // custom domain; "/<repo>/" for a GitHub project page. The workflow
    // overrides this automatically.
    'base_path' => '/',

    // Custom domain for GitHub Pages (writes a CNAME file), e.g.
    // 'carolryan.xyz'. Leave null while using the github.io address.
    'cname' => 'carolryan.xyz',

    // Home page ("link tree").
    'home' => [
        'document_title' => 'CarolRyan.xyz – Link Tree',
        'heading' => 'CarolRyan.xyz',
        'tagline' => 'Renew & Reuse Creative',
        'short_description' => 'New or Gently Used—Now Renewed. To create whatever my mind can imagine. I can sew, glue, cut, color, twist, paint, nail things and so much more.',
        'links_heading' => 'Links',
        // url may be absolute, site-relative ("about/") or "mailto:".
        'links' => [
            ['label' => 'revivalcreations.com', 'url' => 'https://revivalcreations.com'],
            ['label' => 'Instagram', 'url' => 'https://instagram.com/caryan1001'],
            ['label' => 'ilovetophotographflowers.com', 'url' => 'https://ilovetophotographflowers.com'],
            ['label' => 'Contact', 'url' => 'mailto:contact@carolryan.xyz'],
        ],
    ],

    // Favicons (paths inside assets/).
    'icons' => [
        'small' => 'images/favicon-150.png',
        'large' => 'images/favicon-192.png',
    ],
];
