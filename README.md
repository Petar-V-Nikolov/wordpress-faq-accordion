# PN FAQ Accordion

Classic WordPress plugin by [PN Scripts](https://pnscripts.com). It registers an FAQ custom post type and renders an accessible accordion with the `[pnscripts_faq]` shortcode. The first item is open. There is no WooCommerce and no checkout.

This repository is the plugin folder. Copy it into `wp-content/plugins/`. It is not a full WordPress install.

## What it does

- CPT `faq_item`: question is the title, answer is the content
- Shortcode `[pnscripts_faq]` outputs buttons + regions (keyboard friendly, vanilla JS)
- First item starts expanded
- No payment, no cart, no WooCommerce

## Requirements

- PHP 8.1+
- WordPress 6.0+

## Install

1. Copy this folder into `wp-content/plugins/pnscripts-faq-accordion`.
2. Activate **PN FAQ Accordion**.
3. Add FAQ items (question = title, answer = editor).
4. Put `[pnscripts_faq]` in a page.

Files are distributed on GitHub, or later on CodeCanyon. [pnscripts.com](https://pnscripts.com) does not take payment for this plugin.

## Tests

```bash
composer install
composer test
```

Shortcode sanitizing is a plain PHP unit. Rendering still needs a WordPress site to click through.

## License

MIT.
