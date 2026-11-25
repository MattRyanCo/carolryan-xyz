# Styles

All styles live in one hand-written file, `assets/css/style.css` (about 4 KB),
loaded by both layouts through `templates/partials/head.php`.

The design copies the original WordPress (Kadence theme) home page at
https://carolryan.xyz/: the full-screen pink wood and flowers photo, white
headings in The Girl Next Door, and white pill buttons with a pink border
and text that turn pink on hover. The values (colours, font sizes, button
padding, radius, spacing) were taken from the Kadence CSS on the live site
and checked side by side in screenshots at 1440 px and 390 px wide. No
WordPress, Kadence or block-editor class names are used.

One deliberate difference: Kadence fixed the buttons at 350 px, which
overflows narrow phones. Here they are `width: 350px; max-width: 100%`.

## Sections of `style.css`

| Section | What it covers |
|---------|----------------|
| Font | `@font-face` for The Girl Next Door (`assets/fonts/`) |
| `:root` | Design tokens (colours, font stack, column width) |
| Base | Box sizing, `body`, margins, links, focus ring, `.visually-hidden` |
| Layout | `.backdrop` (photo background) and `.column` (480 px centred column) |
| Text | `.title`, `.tagline`, `.text` |
| Social | `.social`: icon-only links |
| Buttons | `.buttons` list and `.button` pill links, small-phone size |
| Footer | `.footer` copyright line |

## Design tokens

| Token | Value | Use |
|-------|-------|-----|
| `--color-pink` | `#D86C97` | Button text, border and hover fill; fallback behind the photo |
| `--color-white` | `#FFFFFF` | Headings and text on the photo, button background |
| `--color-cream` | `#F6F2EF` | `body` background (only seen if the photo fails) |
| `--color-blush` | `#F7DEDE` | Spare palette colour from the WordPress theme |
| `--color-ink` | `#333333` | Default text colour off the photo |
| `--font-body` | The Girl Next Door | Everything |
| `--column-width` | `480px` | Width of the centred column |
| `--edge-padding` | `1.5rem` | Side padding of the column |

To change a colour site-wide, change its token.

## Type scale

| Element | Size | Weight |
|---------|------|--------|
| `body` | 17px, line height 1.6 | 400 |
| `.title` | `clamp(2.5rem, 1.456rem + 3.26vw, 4rem)`, line height 1.5 | 700 |
| `.tagline` | 28px, line height 1.5 | 700 |
| `.button` | 1.35rem (1.1rem under 380 px) | 400 |
| `.footer` | `clamp(0.8rem, 0.73rem + 0.217vw, 0.9rem)` | 400 |

## Font

| File | Family / weight |
|------|-----------------|
| `assets/fonts/TheGirlNextDoor-Regular.ttf` | The Girl Next Door 400 (licence: `assets/fonts/OFL.txt`) |

The family has only a regular weight. The bold title and tagline use the
browser's synthesised bold, the same as on the WordPress site (Google Fonts
served only the regular file there too).

## Markup

Home page (`content/pages/index.php`):

```
main.backdrop                    full-screen photo background, white text
└── div.column                   480px centred flex column
    ├── h1.title
    ├── p.tagline
    ├── ul.social > li > a > svg + span.visually-hidden
    ├── ul.buttons > li > a.button
    └── footer.footer > p        partials/footer.php
```

Inner pages (`templates/layouts/page.php`) use the same `main.backdrop >
div.column`, with `h1.title`, the page content and the footer. Content can use
`p.text` for paragraphs and `a.button` for a pill link.

## Notes

- Image and font URLs in `style.css` are relative (`../images/…`), so they
  work under any base path.
- Keyboard focus shows a white outline (`:focus-visible`) as well as the
  button hover colours.
