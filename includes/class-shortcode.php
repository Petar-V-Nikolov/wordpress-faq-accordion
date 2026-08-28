<?php

declare(strict_types=1);

final class Pnscripts_Faq_Accordion_Shortcode
{
    public function register(): void
    {
        add_shortcode('pnscripts_faq', [$this, 'render']);
        add_action('wp_enqueue_scripts', [$this, 'registerAssets']);
    }

    public function registerAssets(): void
    {
        $url = defined('PNSCRIPTS_FAQ_ACCORDION_URL')
            ? PNSCRIPTS_FAQ_ACCORDION_URL
            : '';

        wp_register_style(
            'pnscripts-faq-accordion',
            $url . 'assets/css/accordion.css',
            [],
            '1.0.0',
        );

        wp_register_script(
            'pnscripts-faq-accordion',
            $url . 'assets/js/accordion.js',
            [],
            '1.0.0',
            true,
        );
    }

    /**
     * @param  array<string, mixed>|string  $atts
     */
    public function render($atts = []): string
    {
        $items = $this->publishedItems();
        $items = self::sanitize_items($items);

        if ($items === []) {
            return '';
        }

        wp_enqueue_style('pnscripts-faq-accordion');
        wp_enqueue_script('pnscripts-faq-accordion');

        $html = '<div class="pnscripts-faq" data-pnscripts-faq>';

        foreach ($items as $index => $item) {
            $open = $index === 0;
            $buttonId = 'pnscripts-faq-button-' . $index;
            $panelId = 'pnscripts-faq-panel-' . $index;
            $expanded = $open ? 'true' : 'false';
            $hidden = $open ? '' : ' hidden';

            $html .= '<div class="pnscripts-faq__item">';
            $html .= '<h3 class="pnscripts-faq__heading">';
            $html .= '<button type="button" class="pnscripts-faq__button" id="' . $this->esc($buttonId) . '"';
            $html .= ' aria-expanded="' . $expanded . '" aria-controls="' . $this->esc($panelId) . '">';
            $html .= $this->esc($item['question']);
            $html .= '</button></h3>';
            $html .= '<div class="pnscripts-faq__panel" id="' . $this->esc($panelId) . '" role="region"';
            $html .= ' aria-labelledby="' . $this->esc($buttonId) . '"' . $hidden . '>';
            $html .= '<div class="pnscripts-faq__answer">' . $item['answer'] . '</div>';
            $html .= '</div></div>';
        }

        $html .= '</div>';

        return $html;
    }

    /**
     * Drop empty questions. Safe to call without a WordPress bootstrap.
     *
     * @param  list<array<string, mixed>>  $items
     * @return list<array{question: string, answer: string}>
     */
    public static function sanitize_items(array $items): array
    {
        $out = [];

        foreach ($items as $item) {
            if (! is_array($item)) {
                continue;
            }

            $question = self::sanitize_question((string) ($item['question'] ?? ''));
            if ($question === '') {
                continue;
            }

            $out[] = [
                'question' => $question,
                'answer' => self::sanitize_answer((string) ($item['answer'] ?? '')),
            ];
        }

        return $out;
    }

    public static function sanitize_question(string $question): string
    {
        $question = trim(strip_tags($question));

        if (function_exists('wp_strip_all_tags')) {
            $question = trim(wp_strip_all_tags($question));
        }

        return $question;
    }

    public static function sanitize_answer(string $answer): string
    {
        $answer = trim($answer);

        if (function_exists('wp_kses_post')) {
            return wp_kses_post($answer);
        }

        return $answer;
    }

    /**
     * @return list<array{question: string, answer: string}>
     */
    private function publishedItems(): array
    {
        if (! function_exists('get_posts')) {
            return [];
        }

        $posts = get_posts([
            'post_type' => Pnscripts_Faq_Accordion_Cpt::POST_TYPE,
            'post_status' => 'publish',
            'numberposts' => -1,
            'orderby' => 'menu_order date',
            'order' => 'ASC',
        ]);

        $items = [];

        foreach ($posts as $post) {
            $items[] = [
                'question' => (string) $post->post_title,
                'answer' => (string) apply_filters('the_content', (string) $post->post_content),
            ];
        }

        return $items;
    }

    private function esc(string $value): string
    {
        if (function_exists('esc_attr')) {
            return esc_attr($value);
        }

        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
