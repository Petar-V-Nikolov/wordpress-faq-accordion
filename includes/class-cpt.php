<?php

declare(strict_types=1);

final class Pnscripts_Faq_Accordion_Cpt
{
    public const POST_TYPE = 'faq_item';

    public function register(): void
    {
        add_action('init', [$this, 'registerPostType']);
    }

    public function registerPostType(): void
    {
        register_post_type(self::POST_TYPE, [
            'labels' => [
                'name' => __('FAQs', 'pnscripts-faq-accordion'),
                'singular_name' => __('FAQ', 'pnscripts-faq-accordion'),
                'add_new_item' => __('Add FAQ', 'pnscripts-faq-accordion'),
                'edit_item' => __('Edit FAQ', 'pnscripts-faq-accordion'),
                'search_items' => __('Search FAQs', 'pnscripts-faq-accordion'),
            ],
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_icon' => 'dashicons-editor-help',
            'supports' => ['title', 'editor'],
            'has_archive' => false,
            'rewrite' => false,
        ]);
    }
}
