<?php

/**
 * Plugin Name: PN FAQ Accordion
 * Plugin URI: https://pnscripts.com
 * Description: FAQ custom post type and an accessible [pnscripts_faq] accordion. No WooCommerce. No payment.
 * Version: 1.0.0
 * Requires at least: 6.0
 * Requires PHP: 8.1
 * Author: Petar Nikolov
 * Author URI: https://pnscripts.com
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 * Text Domain: pnscripts-faq-accordion
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

define('PNSCRIPTS_FAQ_ACCORDION_FILE', __FILE__);
define('PNSCRIPTS_FAQ_ACCORDION_DIR', plugin_dir_path(__FILE__));
define('PNSCRIPTS_FAQ_ACCORDION_URL', plugin_dir_url(__FILE__));

require_once PNSCRIPTS_FAQ_ACCORDION_DIR . 'includes/class-plugin.php';
require_once PNSCRIPTS_FAQ_ACCORDION_DIR . 'includes/class-cpt.php';
require_once PNSCRIPTS_FAQ_ACCORDION_DIR . 'includes/class-shortcode.php';

Pnscripts_Faq_Accordion_Plugin::instance()->register();
